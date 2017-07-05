#-*- coding:utf-8 -*-
from astrotiempo import *

# ############################################################
# INPUT
# ############################################################
lats=argv[1]
lons=argv[2]
lats=[float(lat) for lat in lats.split(",")]
lons=[float(lon) for lon in lons.split(",")]
date=argv[3]
obj=argv[4]

# ############################################################
# TIME
# ############################################################
t=spy.str2et(date+" UTC")
mat=spy.jrotmat(t)

# ############################################################
# OBSERVER POSITION
# ############################################################
obs1=spy.jobsini('EARTH',lons[0],lats[0],0.0)
obs2=spy.jobsini('EARTH',lons[1],lats[1],0.0)
dobs=obs2["pos"]-obs1["pos"]
dobs=spy.mxv(mat["ITRF93toEJ2000"],dobs)
distancia=spy.vnorm(dobs)

# ############################################################
# EPHEMERIS OBJECT
# ############################################################
ephem_moon=spy.jephem(obj,t,obs1,mat)
obj=ephem_moon["targetOBSEJ2000"]

# ############################################################
# ANGLE
# ############################################################
try:
    cosq=spy.vdot(dobs,obj)/(distancia*spy.vnorm(obj))
    q=np.arccos(cosq)*RAD
except:
    q=-1

# ############################################################
# SALIDAS
# ############################################################
print """{"distancia":%.3f,"angulo":%.3f}"""%\
    (distancia,q)
