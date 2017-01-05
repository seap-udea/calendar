#-*- coding:utf-8 -*-
from astrotiempo import *

today=dt.datetime.utcnow()
#sdate=today.strftime("%m/%d/%y %H:%M:%S UTC")
sdate=today.strftime("10/01/2016 19:00:00 UTC")
et=spy.str2et(sdate)

print sdate,distanceBodies(et,EARTH,SUN)
v=stateBody(et,EARTH,SUN)[3:]
print spy.vnorm(v)
