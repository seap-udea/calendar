#-*- coding:utf-8 -*-
from astrotiempo import *

today=dt.datetime.utcnow()
sdate=today.strftime("%m/%d/%y %H:%M:%S UTC")
#sdate=today.strftime("01/03/2016 19:00:00 UTC")
et=spy.str2et(sdate)

state=stateBody(et,EARTH,SUN)
r=state[:3]
v=state[3:]

distance=spy.vnorm(r)
speed=spy.vnorm(v)

print """{"distance":"%.3f","speed":"%.8f"}"""%(distance,speed)
