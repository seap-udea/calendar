#-*- coding:utf-8 -*-
from astrotiempo import *

try:
    target=argv[1]
    center=argv[2]
except:
    target="EARTH"
    center="SUN"

today=dt.datetime.utcnow()
sdate=today.strftime("%m/%d/%y %H:%M:%S UTC")
et=spy.str2et(sdate)

state=eval("stateBody(et,%s,%s)"%(target,center))
r=state[:3]
v=state[3:]

distance=spy.vnorm(r)
speed=spy.vnorm(v)

print """{"distance":"%.3f","speed":"%.8f"}"""%(distance,speed)
