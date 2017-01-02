#######################################################################
#EXTERNAL MODULES
#######################################################################
from spiceypy import wrapper as spy
from sys import argv,exit,stderr,stdout
import numpy as np
from scipy.optimize import minimize_scalar as minimize
import datetime as dt
import time,calendar

#######################################################################
#CONSTANTS AND MACROS
#######################################################################

#//////////////////////////////
#SPICE KERNELS
#//////////////////////////////
spy.furnsh("bin/kernels/naif0011.tls")
spy.furnsh("bin/kernels/de421.bsp")
spy.furnsh("bin/kernels/earth_assoc_itrf93.tf")
spy.furnsh("bin/kernels/earth_fixed.tf")
spy.furnsh("bin/kernels/earth_070425_370426_predict.bpc")
spy.furnsh("bin/kernels/earth_720101_070426.bpc")
spy.furnsh("bin/kernels/frame.tk")

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

REARTH=6378.1366
FEARTH=0.0033528131084554717

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

def dec2sex(dec):
    H=np.floor(dec);
    mm=(dec-H)*60
    M=np.floor(mm);
    ss=(mm-M)*60;
    S=np.floor(ss);

    #return "%02d:%02d:%02.3f"%(H,M,ss)
    return H,M,ss
