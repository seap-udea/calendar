#-*- coding:utf-8 -*-
from astrotiempo import *

today=dt.date.today()
sdate=today.strftime("%m/%d/%y %H:%M:%S")
#sdate="01/06/2017 00:00:00"

# Find perihelio for future
et=spy.str2et(sdate)
sol=minimize(distanceBodies,(et-1*DAY,et+364*DAY),tol=1e-10,args=(EARTH,SUN))
tper=sol.x
dt=spy.deltet(tper,"et");
dper=spy.et2utc(tper,'ISOC',0,100)

print dper

