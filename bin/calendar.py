#######################################################################
#EXTERNAL MODULES
#######################################################################
from spiceypy import wrapper as spy
from sys import argv,exit
import numpy as np
from scipy.optimize import minimize_scalar as minimize

#######################################################################
#CONSTANTS AND MACROS
#######################################################################

#//////////////////////////////
#SPICE KERNELS
#//////////////////////////////
spy.furnsh("bin/kernels/naif0011.tls")
spy.furnsh("bin/kernels/de421.bsp")

#//////////////////////////////
#BODIES
#//////////////////////////////
SSB=0
SUN=10
EMB=3
EARTH=399

#//////////////////////////////
#NUMERICAL CONSTANTS
#//////////////////////////////
DEG=np.pi/180
RAD=1/DEG

#//////////////////////////////
#PHYSICAL CONSTANTS
#//////////////////////////////
DAY=86400.0
YEAR=365*DAY
MUSUN=132712440040.944000 #mu_Sun for DE421

#######################################################################
#FUNCTIONS
#######################################################################
def distanceBodies(et,body=EARTH,wrt=SUN):
    x,l=spy.spkgps(body,et,"ECLIPJ2000",wrt)
    r=spy.vnorm(x)
    return r

def stateBody(et,body=EARTH,wrt=SUN):
    x,l=spy.spkgeo(body,et,"ECLIPJ2000",wrt)
    return x

def positionBody(et,body=EARTH,wrt=SUN):
    x,l=spy.spkgps(body,et,"ECLIPJ2000",wrt)
    return x