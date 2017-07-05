#-*- coding:utf-8 -*-
from astrotiempo import *
from matplotlib import use
use('Agg')
import matplotlib.pyplot as plt

# ############################################################
# INPUT
# ############################################################
lat=float(argv[1])
lon=float(argv[2])
date=argv[3]
session=argv[4]
try:
    if argv[5]=="infinitos":
        luzvel=1e10
        lstring="infinitos"
    else:
        luzvel=float(argv[5])
        lstring="%.0f"%luzvel
except:
    luzvel=spy.clight()
    lstring="%.0f"%luzvel

dname="sessions/%s/"%session
if not os.path.isdir(dname):os.system("mkdir -p %s"%dname)

# ############################################################
# BASIC ROUTINES
# ############################################################
# Computes angular distance between the Sun and the Moon
def angDist(t,obs):
    return spy.jangdis('MOON','SUN',t,obs,cspeed=luzvel)
# Compute the contact function
def contactFunction(t,obs,k):
    return spy.jangdis('MOON','SUN',t,obs,k=k,cspeed=luzvel)

# ############################################################
# ECLIPSE TIMES
# ############################################################

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# OBSERVER POSITION
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
obs=spy.jobsini('EARTH',lon,lat,0.0)

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# MAXIMUM ECLIPSE
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
t1=spy.str2et(date+' 00:00:00 UTC')
t2=spy.str2et(date+' 23:59:59 UTC')
sol=spy.jminim(angDist,(t1,t2),method='brent',args=(obs,),tol=1e-13)
tecl=sol.x

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# EPHEMERIS SUN-MOON
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
mat=spy.jrotmat(tecl)
ephem_sun=spy.jephem('SUN',tecl,obs,mat,cspeed=luzvel)
ephem_moon=spy.jephem('MOON',tecl,obs,mat,cspeed=luzvel)
size_sun=ephem_sun["angsize"]/60.0
size_moon=ephem_moon["angsize"]/60.0
dist=angDist(tecl,obs)*RAD*60

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# EVALUATE ECLIPSE
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if dist>(size_sun+size_moon)/2:
    print "No eclipse"
    exit(0)

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# CONTACT TIMES
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
tc1=spy.jzero(contactFunction,t1,tecl,args=(obs,+1))
tc4=spy.jzero(contactFunction,tecl,t2,args=(obs,+1))

# ############################################################
# ECLIPSE TIMES
# ############################################################
dt=1*60
fname="magnitud-lat%.5f_lon%.5f-t%.0f-c%s"%(lat,lon,t1,lstring)
f=open("%s/%s.dat"%(dname,fname),"w")
f.write("%-15s%-15s%-15s%-15s%-15s\n"%("#HH:MM:SS","t(s)","Dist (arcmin)","Mag.(%)","P(o)"))
ts=np.arange(tc1,tc4+dt,dt)
for t in ts:
    cal=spy.timout(t,'HR:MN:SC.#',100)
    mat=spy.jrotmat(t)
    ephem_sun=spy.jephem('SUN',t,obs,mat,cspeed=luzvel)
    ephem_moon=spy.jephem('MOON',t,obs,mat,cspeed=luzvel)
    dist=spy.jgcdist(ephem_sun["RA"],ephem_moon["RA"],
                     ephem_sun["DEC"],ephem_moon["DEC"])
    RAs=ephem_sun["RA"];DECs=ephem_sun["DEC"];
    RAm=ephem_moon["RA"];DECm=ephem_moon["DEC"];
    P=positionAngle(RAs,RAm,DECs,DECm)*RAD
    R=size_moon/2
    r=size_sun/2
    OA=dist*RAD*60
    mag=100*(R+r-OA)/(2*r)
    if mag<0:mag=0
    f.write("%-15s%-15.2f%-15.3f%-15.2f%-15.2f\n"%(cal,t,OA,mag,P))
f.close()
