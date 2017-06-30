#-*- coding:utf-8 -*-
#############################################################
#EXTERNAL MODULES
#############################################################
from astrotiempo import *

from matplotlib import use
use('Agg')
import matplotlib.pyplot as plt
from matplotlib.colors import LogNorm
from mpl_toolkits.basemap import Basemap as map,shiftgrid
import matplotlib.patches as patches
from matplotlib.collections import PatchCollection
import matplotlib.cm as cm

print spy.clight()
exit(0)
#############################################################
#CONSTANTS
#############################################################

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#BEHAVIOR
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

PLOT="magfin"
PLOT="magini"
PLOT="magmax"
PLOT="oscmax"

EXT="png"
COUNTRIES=0
PARMER=0
QLOAD=1
NLAT=120
NLON=120

COLORWATER="darkblue"
COLORLAND="darkgreen"
COLORGRID="white"

"""
NLAT=5
NLON=5
#"""

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MAP
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#ORIGINAL
latmin_m=-5.0
latmax_m=30.0
lonmin_m=-110.0
lonmax_m=-50.0

#MAP
latmin_m=-5.0
latmax_m=35.0
lonmin_m=-110.0
lonmax_m=-50.0

latmean=(latmin_m+latmax_m)/2
lonmean=(lonmin_m+lonmax_m)/2
dlat=latmax_m-latmin_m
dlon=lonmax_m-lonmin_m
limits=[latmean,lonmean,dlat,dlon]

#CALCULATION 
latmin=latmin_m-5
latmax=latmax_m+5
lonmin=lonmin_m-5
lonmax=lonmax_m+5

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#ASTRONOMICAL
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
DATE="8/21/2017"

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MACROS
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
PI=np.pi
Polygon=patches.Polygon

#############################################################
# ROUTINES
#############################################################
# Computes angular distance between the Sun and the Moon
def angDist(t,obs):
    return spy.jangdis('MOON','SUN',t,obs)
# Compute the contact function
def contactFunction(t,obs,k):
    return spy.jangdis('MOON','SUN',t,obs,k=k)

def eclipseProps(lat,lon,vv=0):
    """
    #PARCIAL
    props=eclipseProps(6.2,-75.3,vv=1)

    #TOTAL
    props=eclipseProps(36.2,-86.3,vv=1)
    
    #NO ECLIPSE
    props=eclipseProps(-36.2,-86.3,vv=1)

    #NO VISIBLE
    props=eclipseProps(+36,+0.0,vv=1)
    """
    obs=spy.jobsini('EARTH',lon,lat,0.0)

    #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    #MAXIMUM ECLIPSE
    #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    t1=spy.str2et(DATE+' 00:00:00 UTC')
    tm=t1
    t2=spy.str2et(DATE+' 23:59:59 UTC')
    tecl=spy.jminim(angDist,(t1,t2),method='brent',args=(obs,),tol=1e-13).x

    #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    #EPHEMERIS SUN-MOON
    #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    mat=spy.jrotmat(tecl)
    ephem_sun=spy.jephem('SUN',tecl,obs,mat)
    ephem_moon=spy.jephem('MOON',tecl,obs,mat)
    size_sun=ephem_sun["angsize"]/60.0
    size_moon=ephem_moon["angsize"]/60.0
    el_max=ephem_sun["el"]*RAD
    dist=angDist(tecl,obs)*RAD*60
    ratio=size_moon/size_sun

    #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    #EVALUATE ECLIPSE
    #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    qtipo=1
    tipo="Parcial"
    duracion=0.0
    tc1=tecl
    tc4=tecl
    mag=0.0
    obsc=0.0

    if dist<(size_sun+size_moon)/2:
        if vv:print "El eclipse se podría ver"

        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        #ECLIPSE HAPPENS!
        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        #====================
        #CONTACT TIMES 
        #====================
        tc1=spy.jzero(contactFunction,t1,tecl,args=(obs,+1))
        mat=spy.jrotmat(tc1)
        ephem_sun=spy.jephem('SUN',tc1,obs,mat)
        el_c1=ephem_sun["el"]*RAD

        #Determine if the eclipse is total or partial
        try:
            tc2=spy.jzero(contactFunction,t1,tecl,args=(obs,-1))
            tipo="Total"
            tc3=spy.jzero(contactFunction,tecl,t2,args=(obs,-1))
            duracion=(tc3-tc2)/3600.0
            qtipo=2
            if vv:print "El eclipse sería total"
        except:
            if vv:print "El eclipse sería parcial"
            pass

        tc4=spy.jzero(contactFunction,tecl,t2,args=(obs,+1))
        mat=spy.jrotmat(tc4)
        ephem_sun=spy.jephem('SUN',tc4,obs,mat)
        el_c4=ephem_sun["el"]*RAD

        if el_c1<0:
            #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            #NO ECLIPSE
            #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
            if vv:print "El eclipse no se puede ver"
            qtipo=-1 #No se puede ver la Luna y el Sol 
            tipo="No visible"
            tecl=tm
            tc1=tecl
            tc4=tecl
            mag=0.0
            obsc=0.0
            dist=size_sun/2
        else:
            #====================
            #MAGNIT. & OSCURAT.
            #====================
            #See: http://www.cosmicriver.net/blog/solar-eclipses-magnitude-and-obscuration
            R=size_moon/2
            r=size_sun/2
            OA=dist

            #Magnitude
            mag=100*(R+r-OA)/(2*r)

            #Obscuring
            if qtipo!=2:
                a=(R**2-r**2+OA**2)/(2*OA)
                alpha=2*np.arccos((OA-a)/r)
                beta=2*np.arccos(a/R)
                area1=0.5*R**2*(beta-np.sin(beta))
                area2=0.5*r**2*(alpha-np.sin(alpha))
                obsc=100*(area1+area2)/(np.pi*r**2)
                duracion=(tc4-tc1)/3600.0
            else:
                obsc=100.0
    else:
        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        #NO ECLIPSE
        #%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        if vv:print "No hay eclipse"
        qtipo=0 #Se puede ver la Luna y el Sol pero no el eclipse
        tipo="No eclipse"
        tecl=tm
        tc1=tecl
        tc4=tecl
        dist=size_sun/2

    return qtipo,tipo,dist,(tc1-tm)/3600.0,(tecl-tm)/3600,(tc4-tm)/3600,mag,obsc,duracion

#############################################################
#PREPARATION
#############################################################
fig,axs=subPlots(plt,[1])
ax=axs[0]

#############################################################
#CREATE MAP
#############################################################

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MAP PROPERTIES
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
qlatmean=limits[0]
qlonmean=limits[1]
dlat=limits[2]*PI/180*6371.0e3
dlon=limits[3]*PI/180*6371.0e3
fpardict=dict(labels=[True,True,False,False],
              fontsize=10,zorder=10,linewidth=0.5,fmt=lat2str)
fmerdict=dict(labels=[False,False,False,True],
              fontsize=10,zorder=10,linewidth=0.5,fmt=lon2str)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#CREATE MAP
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
m=map(projection="aea",resolution='l',width=dlon,height=dlat,
      lat_0=qlatmean,lon_0=qlonmean,ax=ax)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#DRAW DECORATION
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
m.drawmapboundary(fill_color=COLORWATER)
m.fillcontinents(color=COLORLAND,lake_color=COLORWATER)

if PARMER:
    m.drawparallels(np.arange(-90,90,5),**fpardict)
    mers=m.drawmeridians(np.arange(-180,180,5),**fmerdict)
    #Change values of longitude
    for lon in mers.keys():
        mer=mers[lon]
        try:
            mertxt=mer[1][0]
            val=float(mertxt.get_text())
            mod=np.mod(val,360)-360
            mertxt.set_text("%.0f"%mod)
        except:
            pass

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#DRAW COUNTRIES BOUNDARIES
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if COUNTRIES:
    #Source of countries division:
    #https://github.com/nvkelso/natural-earth-vector/tree/master/10m_cultural
    m.readshapefile('bin/kernels/ne_10m_admin_0_countries_lakes',
                    'units',color=COLORWATER,linewidth=.4)
    i=0
    for info, shape in zip(m.units_info, m.units):
        i+=1
        if i<100:continue
        if i>2:break
        print "Unit %d..."%i
        iso3 = info['ADM0_A3']
        color='none'
        patches = [Polygon(np.array(shape),True)]
        pc = PatchCollection(patches)
        pc.set_facecolor(color)
        ax.add_collection(pc)

#############################################################
#ECLIPSE CALCULATION
#############################################################
if not QLOAD:
    num=NLAT*NLON
    lats=np.linspace(latmin,latmax,NLAT)
    lons=np.linspace(lonmin,lonmax,NLON)
    LATS,LONS=np.meshgrid(lats,lons)

    #MATRICES
    QTIPO=np.zeros_like(LATS)
    DIST=np.zeros_like(LATS)
    TC1=np.zeros_like(LATS)
    TECL=np.zeros_like(LATS)
    TC4=np.zeros_like(LATS)
    MAG=np.zeros_like(LATS)
    OBSC=np.zeros_like(LATS)
    DURACION=np.zeros_like(LATS)
    TOTALITY=[]

    k=0
    i=0
    for lon in lons:
        j=0
        for lat in lats:
            if (k%10)==0:print "Calculando propiedades para punto (%d/%d): lat=%f,lon=%f"%(k,num,lat,lon)
            qtipo,tipo,dist,tc1,tecl,tc4,mag,obsc,duracion=eclipseProps(lat,lon)

            if qtipo==2:
                TOTALITY+=[[lon,lat]]
                qtipo=0
            if qtipo==-1:qtipo=0

            QTIPO[i,j]=qtipo
            DIST[i,j]=dist
            TC1[i,j]=tc1
            TECL[i,j]=tecl
            TC4[i,j]=tc4
            MAG[i,j]=mag
            OBSC[i,j]=obsc 
            DURACION[i,j]=duracion
            j+=1

            #PLOT PUNTO
            x,y=m(lon,lat)
            if qtipo==0:color="yellow"
            if qtipo==1:color="blue"
            if qtipo==2:color="red"
            if qtipo==-1:color="white"
            ax.plot(x,y,'o',color=color,ms=5,mec='none')
            k+=1
        i+=1

    #SAVE RESULTS
    np.savetxt("data/TOTALITY",TOTALITY)
    np.savetxt("data/LATS",LATS)
    np.savetxt("data/LONS",LONS)
    np.savetxt("data/QTIPO",QTIPO)
    np.savetxt("data/DIST",DIST)
    np.savetxt("data/TC1",TC1)
    np.savetxt("data/TECL",TECL)
    np.savetxt("data/TC4",TC4)
    np.savetxt("data/MAG",MAG)
    np.savetxt("data/OBSC",OBSC)
    np.savetxt("data/DURACION",DURACION)

#LOAD RESULTS
TOTALITY=np.loadtxt("data/TOTALITY")
LATS=np.loadtxt("data/LATS")
LONS=np.loadtxt("data/LONS")
QTIPO=np.loadtxt("data/QTIPO")
DIST=np.loadtxt("data/DIST")
TC1=np.loadtxt("data/TC1")
TECL=np.loadtxt("data/TECL")
TC4=np.loadtxt("data/TC4")
MAG=np.loadtxt("data/MAG")
OBSC=np.loadtxt("data/OBSC")
DURACION=np.loadtxt("data/DURACION")

#CONTOUR CARTESIAN GRID
X,Y=m(LONS,LATS)

#############################################################
#MAPA DATOS
#############################################################
if PLOT=="magmax":
    TPROXY=TECL
    TINI=17
    TEND=24
    HS=[18,19,20]
    HLS=[18,19,20]

    QUANT=MAG
    ZLEVEL=0.5
    ax.set_title(u"Eclipse de Sol del 21 de Agosto de 2017\nMagnitud y hora del eclipse máximo",
                 position=(0.5,1.02),fontsize=12)
    IMGNAME="mapa-magnitud-maximo"

if PLOT=="oscmax":
    TPROXY=TECL
    TINI=17
    TEND=24
    HS=[18,19,20]
    HLS=[18,19,20]

    QUANT=OBSC
    ZLEVEL=0.08
    ax.set_title(u"Eclipse de Sol del 21 de Agosto de 2017\nOscurescimiento y hora del eclipse máximo",
                 position=(0.5,1.02),fontsize=12)
    IMGNAME="mapa-oscurecimiento-maximo"

if PLOT=="magini":
    TPROXY=TC1
    TINI=18
    TEND=24
    HS=[16,17,18,19]
    HLS=[17]

    QUANT=MAG
    ZLEVEL=0.5
    ax.set_title(u"Eclipse de Sol del 21 de Agosto de 2017\nMagnitud y hora de inicio del eclipse",
                 position=(0.5,1.02),fontsize=12)
    IMGNAME="mapa-magnitud-inicio"

if PLOT=="magfin":
    TPROXY=TC4
    TINI=18
    TEND=24
    HS=[19,20,21,22]
    HLS=[21]

    QUANT=MAG
    ZLEVEL=0.5
    ax.set_title(u"Eclipse de Sol del 21 de Agosto de 2017\nMagnitud y hora de fin del eclipse",
                 position=(0.5,1.02),fontsize=12)
    IMGNAME="mapa-magnitud-fin"

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#TIME GRID
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
levels=np.arange(TINI,TEND,10/60.0) # Cada 10 minutos
cs=m.contour(X,Y,TPROXY,levels,zorder=10,
             colors=[COLORGRID],linestyles='solid',linewidths=0.2)

#LINEAS DE HORA
for H in HS:
    cs=m.contour(X,Y,TPROXY,[H],zorder=10,colors=[COLORGRID],linestyles='solid')
    if H in HLS:
        print "Label for %d..."%H
        ax.clabel(cs,inline=1,fontsize=8,fmt=r"%d$^{\rm h}$ UTC"%H,zorder=100,color=COLORGRID)
    cs=m.contour(X,Y,TPROXY,[H+0.5],zorder=10,colors=[COLORGRID],
                 linestyles='dashed',linewidths=0.5)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MAGNITUDE GRID
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
levels=[25,75,50]
cs=m.contour(X,Y,QUANT,levels,
             zorder=100,colors=[COLORGRID],
             linestyles='solid',linewidths=1)
ax.clabel(cs,inline=1,
          fontsize=10,fmt="%.1f%%",zorder=100,color=COLORGRID)

levels=np.arange(5,95+10,5) # Cada 10%
cs=m.contour(X,Y,QUANT,levels,
             zorder=100,colors=[COLORGRID],
             linestyles='solid',linewidths=0.2)

levels=[ZLEVEL]
cs=m.contour(X,Y,QUANT,levels,zorder=10,colors=COLORGRID,linewidths=4)

levels=[100.0]
cs=m.contour(X,Y,MAG,levels,zorder=10,colors=COLORGRID,linewidths=3)
ax.clabel(cs,inline=1,
          fontsize=8,fmt="Totalidad",zorder=100,color=COLORGRID)

fig.savefig(IMGNAME+"."+EXT,bbox_inches='tight')
