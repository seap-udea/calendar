from spiceypy import wrapper as spy
from sys import argv,exit
import numpy as np
from scipy.optimize import minimize_scalar as minimize

spy.furnsh("bin/kernels/naif0011.tls")
spy.furnsh("bin/kernels/de421.bsp")

#############################################################
#CONSTANTS AND MACROS
#############################################################
DAY=86400.0
CYEAR=365*DAY
MUSUN=132712440040.944000 #mu_Sun for DE421

DEG=np.pi/180
RAD=1/DEG

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MACROS
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
SSB=0
SUN=10
EMB=3
EARTH=399

#############################################################
#ROUTINES
#############################################################

#############################################################
#FUNCTIONS
#############################################################
def test():
    et=spy.str2et("01/04/2017 02:00:00")
    dt=spy.deltet(et,"et");
    ut=et-dt
    utc=spy.etcal(ut+CYEAR,100)
    print utc

def distanceEarth(et,body=3,wrt=0):
    x,l=spy.spkgeo(body,et,"ECLIPJ2000",wrt)
    r=spy.vnorm(x[:3])
    return r

def positionEarth(et,body=3,wrt=0):
    x,l=spy.spkgps(body,et,"ECLIPJ2000",wrt)
    return x

def stateEarth(et,body=3,wrt=0):
    x,l=spy.spkgeo(body,et,"ECLIPJ2000",wrt)
    return x

def dminEarth(et,etref=0,body=EARTH,wrt=SUN):

    args=(body,wrt)

    #POSITION
    pos1=positionEarth(et,*args)
    pos2=positionEarth(etref,*args)

    dif=pos1-pos2
    
    dist=spy.vnorm(dif)
    return dist
    
def getDistance(year,body=EARTH,wrt=SUN):

    #GET YEAR
    args=(body,wrt)

    nyear=year+1

    date1="01/01/%s 00:00:00"%year
    date2="01/01/%s 00:00:00"%nyear
    et1=spy.str2et(date1)
    et2=spy.str2et(date2)
    
    pos1=stateEarth(et1,*args)
    el1=spy.oscelt(pos1,et1,MUSUN)
    pos2=stateEarth(et2,*args)
    el2=spy.oscelt(pos2,et2,MUSUN)
    print year,el1[5]*RAD
    print nyear,el2[5]*RAD

    #POSITION
    dist=dminEarth(et1,et2,*args)
    print dist/1e6

    args=(et1,body,wrt)
    sol=minimize(dminEarth,(et2-10*DAY,et2+10*DAY),tol=1e-10,args=args)
    print sol

    tmin=sol.x

    print (tmin-et1)/DAY

    dt=spy.deltet(tmin,"et");
    utc=spy.etcal(tmin-dt,100)

    print utc

    dist=dminEarth(tmin,*args)
    print dist

def getPerihelionDate(year,body=EARTH,wrt=SUN):
    
    #GET YEAR
    args=(body,wrt)

    #GUESS DATE
    date="01/01/%s 02:00:00"%year
    et=spy.str2et(date)

    #SOLUTION
    sol=minimize(distanceEarth,(et,et+100*DAY),tol=1e-10,args=args)
    tper=sol.x
    dt=spy.deltet(tper,"et");

    #DATE
    utc=spy.etcal(tper-dt,100)
    print "Date of perihelion:",utc

    #MINIMUM DISTANCE
    rmin=distanceEarth(tper,*args)
    print "Distance to perihelion:",rmin
    
    pmin=positionEarth(tper,*args)
    print "Position:",pmin

    return tper,pmin

def getDistancePerihelia(year,body=EARTH,wrt=SUN):

    args=(body,wrt)

    #GUESS DATE 1
    date="01/01/%s 02:00:00"%year
    et=spy.str2et(date)

    #SOLUTION1
    sol=minimize(distanceEarth,(et,et+100*DAY),tol=1e-10,args=args)
    et1=sol.x

    #GUESS DATE 2
    nyear=year+1
    date="01/01/%s 02:00:00"%nyear
    et2=spy.str2et(date)

    #SOLUTION1
    sol=minimize(distanceEarth,(et2,et2+100*DAY),tol=1e-10,args=args)
    et2=sol.x

    print et1,et2

    args=(et1,body,wrt)
    dist=dminEarth(et2,*args)
    print dist/1e6

#############################################################
#EXECUTE
#############################################################
try:
    function=argv[1]
    func=function+"()"
    eval(func)
except:
    print "You need to choose a valid function name."
    exit(1)


