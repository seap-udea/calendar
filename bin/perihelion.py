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
    
def getPerihelionDate(year,body=EMB,wrt=SSB):
    
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


