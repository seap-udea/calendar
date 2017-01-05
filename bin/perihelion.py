#-*- coding:utf-8 -*-
from astrotiempo import *

today=dt.date.today()
sdate=today.strftime("%m/%d/%Y %H:%M:%S")
#sdate="01/03/2019 08:00:00"

# Find perihelio for future
etini=spy.str2et(sdate)

while True:
    sol=minimize(distanceBodies,(etini-0.0*DAY,etini+360*DAY),tol=1e-10,args=(EARTH,SUN))
    tper=sol.x
    #print (etini-tper)/(DAY/4)
    if (etini-tper)<(DAY/4):break
    etini+=DAY/2

dt=spy.deltet(tper,"et");
dper=spy.et2utc(tper,'ISOC',0,100)

print dper

