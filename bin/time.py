#-*- coding:utf-8 -*-
from astrotiempo import *

#GET THE TIME
now=dt.datetime.now()
now=dt.datetime.strptime("01/01/2017 00:00:00","%m/%d/%y %H:%M:%S")

sdate=now.strftime("%m/%d/%y %H:%M:%S")
print sdate

#GET THE EPHEMERIS TIME
et=spy.str2et(sdate)
print et

dt=spy.deltet(et,"ET")
print dt

jed=spy.unitim(et,"ET","JED");
print jed

jd=jed-dt/DAY
print jd

tai=spy.unitim(et,"ET","TAI");
print tai

tdb=spy.unitim(et,"ET","TDB");
print tdb

tdt=spy.unitim(et,"ET","TDT");
print tdt

jdb=spy.unitim(et,"ET","JDTDB");
print jdb

jdt=spy.unitim(et,"ET","JDTDT");
print jdt

ut=time.mktime(now.timetuple())
print ut
