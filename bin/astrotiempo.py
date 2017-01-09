#######################################################################
#EXTERNAL MODULES
#######################################################################
from spiceypy import wrapper as spy
from sys import argv,exit,stderr,stdout
import numpy as np
from scipy.optimize import minimize_scalar as minimize,brentq as zeros
from scipy.misc import derivative
import datetime as dt
import time,calendar
from scipy.interpolate import interp1d
import os

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

