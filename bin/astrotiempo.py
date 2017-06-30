#######################################################################
#EXTERNAL MODULES
#######################################################################
from spiceypy import wrapper as spy
import spiceypy.support_types as spytypes
from sys import argv,exit,stderr,stdout
import numpy as np
from scipy.optimize import minimize_scalar as minimize,brentq as zeros
from scipy.misc import derivative
from scipy.optimize import brentq as _zero
from scipy.optimize import minimize_scalar as _minim
import datetime as dt
import time,calendar
from scipy.interpolate import interp1d
import os
np.set_printoptions(threshold='nan')	

#######################################################################
#CONSTANTS AND MACROS
#######################################################################

#//////////////////////////////
#SPICE KERNELS
#//////////////////////////////
spy.furnsh("bin/kernels/naif0012.tls")
spy.furnsh("bin/kernels/de421.bsp")
spy.furnsh("bin/kernels/earth_assoc_itrf93.tf")
spy.furnsh("bin/kernels/earth_fixed.tf")
spy.furnsh("bin/kernels/earth_070425_370426_predict.bpc")
spy.furnsh("bin/kernels/earth_720101_070426.bpc")
spy.furnsh("bin/kernels/pck00010.tpc")
spy.furnsh("bin/kernels/frame.tk")

#//////////////////////////////
#BODIES
#//////////////////////////////
SSB=0
SUN=10
EMB=3
EARTH=399
MOON=301

#//////////////////////////////
#MACROS
#//////////////////////////////
QUARTER=['New Moon','First Quarter','Full Moon','Third Quarter']

#//////////////////////////////
#NUMERICAL CONSTANTS
#//////////////////////////////
DEG=np.pi/180
RAD=1/DEG

#//////////////////////////////
#PHYSICAL CONSTANTS
#//////////////////////////////
HOUR=3600.0
DAY=86400.0
YEAR=365*DAY
MUSUN=132712440040.944000 #mu_Sun for DE421

REARTH=6378.1366
FEARTH=0.0033528131084554717

#DIFFERENTIAL RATES OF TCG AND TCB, SEE USNO CIRCULAR 179, OCT 2006
#TDB TIME AT 01/01/01 1977 00:00:00 TAI, 01/01/01 1977 00:00:32.184 TDB, 12/31/1976 23:59:45 UTC
T0=-725803167.816
LG=6.969290134e-10
LB=1.55e-8

#######################################################################
#FUNCTIONS
#######################################################################
def distanceBodies(et,body=EARTH,wrt=SUN):
    x,l=spy.spkgps(body,et,"ECLIPJ2000",wrt)
    r=spy.vnorm(x)
    return r

def stateBody(et,body=EARTH,wrt=SUN,rf="ECLIPJ2000"):
    x,l=spy.spkgeo(body,et,rf,wrt)
    return x

def positionBody(et,body=EARTH,wrt=SUN,rf="ECLIPJ2000"):
    x,l=spy.spkgps(body,et,"ECLIPJ2000",wrt)
    return x

def dec2sex(dec,sep=None,day=False):
    if day:fac=24
    else:fac=60
    H=np.floor(dec)
    mm=(dec-H)*fac
    M=np.floor(mm)
    ss=(mm-M)*60;
    S=np.floor(ss);

    if not sep is None:
        return "%02d%s%02d%s%02.3f"%(int(H),sep[0],int(M),sep[1],ss)
    return H,M,ss

def sex2dec(sex,sep=':'):
    if sep==":":
        sex=[float(s) for s in sex.split(":")]
    dec=sex[0]+sex[1]/60.0+sex[2]/3600.
    return dec

def roundTime(dt=None, roundTo=60):
   """Round a datetime object to any time laps in seconds
   dt : datetime.datetime object, default now.
   roundTo : Closest number of seconds to round to, default 1 minute.
   Author: Thierry Husson 2012 - Use it as you want but don't blame me.
   """
   import datetime
   if dt == None : dt = datetime.datetime.now()
   seconds = (dt.replace(tzinfo=None) - dt.min).seconds
   rounding = (seconds+roundTo/2) // roundTo * roundTo
   return dt + datetime.timedelta(0,rounding-seconds,-dt.microsecond)

def utcal(t):
    dt=spy.deltet(t,"ET")
    cal=spy.etcal(t-dt,100)
    return cal

def moonPhaseAngle(t):
    ms=positionBody(t,SUN,MOON,"ECLIPJ2000")
    me=positionBody(t,EARTH,MOON,"ECLIPJ2000")
    ums=ms/spy.vnorm(ms)
    ume=me/spy.vnorm(me)
    cosms=spy.vdot(ums,ume)
    return cosms

def dmoonPhaseAngle(t):
    d=derivative(moonPhaseAngle,t)
    return d

def moonPhase(t):
    cosms=moonPhaseAngle(t)
    phase=0.5*(1+cosms)*100
    return phase

def moonNextQuarter(t,sign=+1,qtype="quarter"):

    if qtype=="quarter":
        function=moonPhaseAngle
        dq=0
    else:
        function=dmoonPhaseAngle
        dq=1

    tn=t+sign*DAY
    while(True):
        try:
            tqua=zeros(function,t,tn,rtol=1e-10)
            if sign*function(t)>sign*function(tn):tq=3-dq
            else:tq=1-dq
            break
        except:
            t=tn
            tn=t+sign*DAY
    return tqua,tq

def moonPhases(t):
    ts=np.zeros(4)
    tqs=np.zeros(4)
    tquar,tq=moonNextQuarter(t,qtype="quarter")
    tfull,tf=moonNextQuarter(t,qtype="full")
    if tfull<tquar:
        ts[0]=tfull;tqs[0]=tf
        ts[1]=tquar;tqs[1]=tq
        tfull,tf=moonNextQuarter(tquar,qtype="full")
        tquar,tq=moonNextQuarter(tfull,qtype="quarter")
        ts[2]=tfull;tqs[2]=tf
        ts[3]=tquar;tqs[3]=tq
    else:
        ts[0]=tquar;tqs[0]=tq
        ts[1]=tfull;tqs[1]=tf
        tquar,tq=moonNextQuarter(tfull,qtype="quarter")
        tfull,tf=moonNextQuarter(tquar,qtype="full")
        ts[2]=tquar;tqs[2]=tq
        ts[3]=tfull;tqs[3]=tf
    return ts,tqs

def genString(N):
    import random,string
    cadena=''.join(random.SystemRandom().choice(string.ascii_lowercase + string.digits) for _ in range(N))
    return cadena

#############################################################
#CONSTANTS
#############################################################
spy.IDENTITY=np.identity(3)
spy.RAD=180/np.pi
spy.DEG=1/spy.RAD

#############################################################
#ROUTINES
#############################################################
def _utcnow():
    utc=datetime.datetime.utcnow()
    now=utc.strftime("%m/%d/%y %H:%M:%S.%f UTC")
    return now
spy.jutcnow=_utcnow

def _locnow():
    loc=datetime.datetime.now()
    now=loc.strftime("%m/%d/%y %H:%M:%S.%f")
    return now
spy.jlocnow=_locnow

def _etnow():
    return spy.str2et(spy.jlocnow())
spy.jetnow=_etnow

def _et2str(et):
    deltet=spy.deltet(et,"ET")
    cal=spy.etcal(et-deltet,100)
    return cal
spy.jet2str=_et2str

def _dec2sex(dec,sep=None,day=False):
    if day:fac=24
    else:fac=60
    sgn=np.sign(dec)
    dec=np.abs(dec)
    H=np.floor(dec)
    mm=(dec-H)*fac
    M=np.floor(mm)
    ss=(mm-M)*60;
    S=np.floor(ss);
    H=sgn*H
    if not sep is None:
        return "%02d%s%02d%s%02.3f"%(int(H),sep[0],int(M),sep[1],ss)
    return [H,M,ss]
spy.jdec2sex=_dec2sex

def _rad():return 180/np.pi
spy.jrad=_rad

def _deg():return np.pi/180
spy.jdeg=_deg

def _obsini(body,lon,lat,alt):
    """
    lon: longitude in degree
    lat: latitude in degree
    alt: altitude in meters
    obs: observer dictionary:
       lat,lon (radians)
       alt (kilometers)
       pos (cartesian position with respect to ellipsoid ITRF93)
       norm (normal vector wrt ellipoid)
       radii (a, b, c, fe)
       LOCALtoITRF93, ITRF93toLOCAL (transformation matrices)
    """
    obs=dict(
        ITRF93toLOCAL=np.zeros((3,3)),
        LOCALtoITRF93=np.zeros((3,3)),
        radii=np.zeros(3),
        pos=np.zeros(3),
        norm=np.zeros(3),
    )
    obs["lon"]=lon*spy.DEG
    obs["lat"]=lat*spy.DEG
    obs["alt"]=alt/1000.0
    obs["body"]=body

    # Body properties
    n,obs["radii"]=spy.bodvrd(body,"RADII",3)
    obs["radii"]=np.append(obs["radii"],
                           [(obs["radii"][0]-obs["radii"][2])/obs["radii"][0]])
    obs["radii"]=np.append(obs["radii"],
                           [(obs["radii"][0]+obs["radii"][2])/2])
    
    # Position in the ellipsoid
    obs["pos"]=spy.georec(obs["lon"],obs["lat"],obs["alt"],
                          obs["radii"][0],obs["radii"][3])

    # Normal vector to location
    obs["norm"]=spy.surfnm(obs["radii"][0],obs["radii"][1],obs["radii"][2],obs["pos"])

    # Vectors
    uz=[0,0,1]
    uy=spy.ucrss(obs["norm"],uz)
    uz=obs["norm"]
    ux=spy.ucrss(uy,uz)

    # Matrices
    obs["ITRF93toLOCAL"]=np.array([ux,uy,uz])
    obs["LOCALtoITRF93"]=spy.invert(obs["ITRF93toLOCAL"]);

    return obs
spy.jobsini=_obsini

def _rotmat(t):
    mat=dict(
        ITRF93toEJ2000=np.zeros((3,3)),
        EJ2000toJ2000=np.zeros((3,3)),
        J2000toEpoch=np.zeros((3,3)),
        J2000toITRF93=np.zeros((3,3)),
    )
    mat["ITRF93toEJ2000"]=spy.pxform("ITRF93","ECLIPJ2000",t)
    mat["EJ2000toJ2000"]=spy.pxform("ECLIPJ2000","J2000",t)
    mat["J2000toEpoch"]=spy.pxform("J2000","EARTHTRUEEPOCH",t)
    mat["J2000toITRF93"]=spy.pxform("J2000","ITRF93",t)
    return mat
spy.jrotmat=_rotmat

def _ephem(target,t,obs,mat,depth='epoch'):
    """
    Parameters:
    body: string for target body
    t: ephemeris time
    obs: observer dictionary
    mat: rotation matrices
    
    Return:
    ephem: dictionary with ephemeris
    obsSSBEJ2000: Coordinate of the Observer wrt SSB in ELIPJ2000
    targetSSBEJ2000: Coordinate of the target wrt SSB in ECLIPJ2000
    targetSSBJ2000: Coordinate of the target wrt SSB in J2000
    targetOBSEJ2000: Coordinate of the target wrt observer in ECLIPJ2000
    targetOBSJ2000: Coordinate of the target wrt observer in J2000
    targetOBST: Coordinate of the target wrt observer at Epoch
    targetOBSITRF93: Coordinate of the target wrt observer in ITRF93
    targetOBSLOCAL: Coordinate of the target wrt observer in Local coordinates

    distance: distance from target to observer

    RA (radians): J2000
    DEC (radians): J2000

    RAt (radians): at epoch
    DECt (radians): at epoch

    az (radians): Azimuth
    el (radians): elevation

    """
    ephem=dict(
        target=target,
        targetSSBEJ2000=np.zeros([0,0,0]),
        targetOBSEJ2000=np.zeros([0,0,0]),
        targetOBSJ2000=np.zeros([0,0,0]),
        distance=0,
        RAJ2000=0,
        DECJ2000=0,
    )
    
    bodySSBEJ2000,ltmp=spy.spkezr(obs["body"],t,
                                  "ECLIPJ2000","NONE","SOLAR SYSTEM BARYCENTER")

    obsEJ2000=spy.mxv(mat["ITRF93toEJ2000"],obs["pos"])
    ephem["obsSSBEJ2000"]=spy.vadd(bodySSBEJ2000[:3],obsEJ2000)

    n,ephem["radii"]=spy.bodvrd(target,"RADII",3)
    ephem["radii"]=np.append(ephem["radii"],
                           [(ephem["radii"][0]-ephem["radii"][2])/ephem["radii"][0]])
    ephem["radii"]=np.append(ephem["radii"],
                           [(ephem["radii"][0]+ephem["radii"][2])/2])

    # Position of target corrected by light-time
    lt=1;ltold=0
    while np.abs((lt-ltold)/lt)>=1e-10:
        ltold=lt
        ephem["targetSSBEJ2000"],ltmp=spy.spkezr(target,t-lt,"ECLIPJ2000","NONE",
                                                 "SOLAR SYSTEM BARYCENTER")
        ephem["targetOBSEJ2000"]=spy.vsub(ephem["targetSSBEJ2000"][:3],
                                          ephem["obsSSBEJ2000"])
        lt=spy.vnorm(ephem["targetOBSEJ2000"])/spy.clight()

    # Ecliptic coordinates at J2000
    ephem["distance"],ephem["eclon"],ephem["eclat"]=spy.recrad(ephem["targetOBSEJ2000"])

    # Equator J2000
    ephem["targetOBSJ2000"]=spy.mxv(mat["EJ2000toJ2000"],ephem["targetOBSEJ2000"])

    # Coordinates at J2000
    ephem["distance"],ephem["RA"],ephem["DEC"]=spy.recrad(ephem["targetOBSJ2000"])
    ephem["angsize"]=2*(ephem["radii"][4]/ephem["distance"])*spy.jrad()*3600

    # Coordinates at Epoch
    ephem["targetOBST"]=spy.mxv(mat["J2000toEpoch"],ephem["targetOBSJ2000"])
    d,ephem["RAt"],ephem["DECt"]=spy.recrad(ephem["targetOBST"])

    # Topocentric coordinates
    ephem["targetOBSITRF93"]=spy.mxv(mat["J2000toITRF93"],ephem["targetOBSJ2000"])
    ephem["targetOBSLOCAL"]=spy.mxv(obs["ITRF93toLOCAL"],ephem["targetOBSITRF93"])
    udir,mag=spy.unorm(ephem["targetOBSLOCAL"])
    udir[1]*=-1
    d,az,el=spy.reclat(udir)
    if(az<0):az+=2*np.pi
    ephem["el"]=el
    ephem["z"]=np.pi/2-ephem["el"]
    ephem["az"]=az

    return ephem
spy.jephem=_ephem

# Find zeros
spy.jzero=_zero
spy.jminim=_minim

# Angular distance
def _gcdist(lam1,lam2,phi1,phi2):
  sf=np.sin((phi2-phi1)/2)
  sl=np.sin((lam2-lam1)/2)
  d=2*np.arcsin((sf*sf+np.cos(phi1)*np.cos(phi2)*sl*sl)**0.5)
  return d
spy.jgcdist=_gcdist

def _angdis(body1,body2,t,obs,k=0):
    """Calculate the angular distance of the contact-function (fk) of two
    objects as observed from observatory obs

    Parameters:
    body1: Body 1 string (largest body)
    body2: Body 2 string
    t: ephemeris time
    obs: observer dictionary
    k: k-parameter of the contact-function. k=0 (angular distance),
       k=+1 (external contact), k=-1 (internal contact)

    Returns:
    if k==0: Angular distance
    if k!=0: angdist-rad1-k*rad2
    """
    mat=spy.jrotmat(t)
    ephem1=spy.jephem(body1,t,obs,mat)
    ephem2=spy.jephem(body2,t,obs,mat)
    angdist=spy.jgcdist(ephem1["RA"],ephem2["RA"],ephem1["DEC"],ephem2["DEC"])
    if k==0:
        return angdist
    else:
        rad1=ephem1["angsize"]/2
        rad2=ephem2["angsize"]/2
        fk=angdist*spy.jrad()*3600.0-rad1-k*rad2
        return fk
spy.jangdis=_angdis

def subPlots(plt,panels,l=0.1,b=0.1,w=0.8,dh=None,fac=2.0):
    """
    Subplots
    """
    import numpy
    npanels=len(panels)
    spanels=sum(panels)

    # GET SIZE OF PANELS
    b=b/npanels
    if dh is None:dh=[b/2]*npanels
    elif type(dh) is not list:dh=[dh]*npanels
    else:
        dh+=[0]

    # EFFECTIVE PLOTTING REGION
    hall=(1-fac*b-sum(dh))
    hs=(hall*numpy.array(panels))/spanels
    fach=(1.0*max(panels))/spanels

    # CREATE AXES
    fig=plt.figure(figsize=(8,6/fach))
    axs=[]
    for i in xrange(npanels):
        axs+=[fig.add_axes([l,b,w,hs[i]])]
        b+=hs[i]+dh[i]
    return fig,axs

def lat2str(lat):
    return "%g"%lat

def lon2str(lon):
    if lon>270:lon-=360
    return "%g"%lon

def scatterMap(ax,qlat,qlon,
               m=None,
               resolution='c',
               limits=None,
               pardict=dict(),
               merdict=dict(),
               zoom=1,
               **formats):
    """
    Create a scatter 
    """
    from mpl_toolkits.basemap import Basemap as map
    import numpy
    PI=numpy.pi

    if m is None:
        if limits is None:
            qlatmin=min(qlat)
            qlatmax=max(qlat)
            qlonmin=min(qlon)
            qlonmax=max(qlon)
            qlonmean=(qlonmax+qlonmin)/2
            qlatmean=(qlatmax+qlatmin)/2
            dlat=zoom*abs(qlatmax-qlatmin)*PI/180*6371.0e3
            dlon=zoom*abs(qlonmax-qlonmin)*PI/180*6371.0e3
            if dlat==0:dlat=1E5
            if dlon==0:dlon=1E5
        else:
            qlatmean=limits[0]
            qlonmean=limits[1]
            dlat=limits[2]*PI/180*6371.0e3
            dlon=limits[3]*PI/180*6371.0e3

        # ############################################################
        # MAP OPTIONS
        # ############################################################
        fpardict=dict(labels=[True,True,False,False],
                      fontsize=10,zorder=10,linewidth=0.5,fmt=lat2str)
        fmerdict=dict(labels=[False,False,True,True],
                      fontsize=10,zorder=10,linewidth=0.5,fmt=lon2str)

        fpardict.update(pardict)
        fmerdict.update(merdict)

        # ############################################################
        # PREPARE FIGURE
        # ############################################################
        m=map(projection="aea",resolution=resolution,width=dlon,height=dlat,
              lat_0=qlatmean,lon_0=qlonmean,ax=ax)

        m.drawlsmask(alpha=0.5)
        m.etopo(zorder=-10)
        m.drawparallels(numpy.arange(-45,45,5),**fpardict)
        m.drawmeridians(numpy.arange(-90,90,5),**fmerdict)

    # ############################################################
    # PLOT
    # ############################################################
    x,y=m(qlon,qlat)
    ax.plot(x,y,**formats)

    return m
