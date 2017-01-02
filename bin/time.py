#-*- coding:utf-8 -*-
from astrotiempo import *

#GET THE TIME
utc=dt.datetime.utcnow()
#utc=dt.datetime.strptime("01/01/2017 00:00:00","%m/%d/%Y %H:%M:%S")
print>>stderr, "UTC: ",utc

ut=calendar.timegm(utc.timetuple())
print>>stderr, "UNIX: ",ut
ut_m=ut*1000

#GET ASTRONOMY TIME
sdate=utc.strftime("%m/%d/%y %H:%M:%S UTC")

et=spy.str2et(sdate)
print>>stderr, "ET: ",et

dt=spy.deltet(et,"ET")
print>>stderr, "DT: ",dt
dt_m=dt*1000
et_m=ut_m+dt_m

etcal=spy.etcal(et,100)
print>>stderr, "ET cal:",etcal

jdb=spy.unitim(et,"ET","JDTDB");
print>>stderr, "JDB: %.9f"%jdb

jdt=spy.unitim(et,"ET","JDTDT");
print>>stderr, "JDT: %.9f"%jdt

jd=jdb-dt/DAY
print>>stderr, "JD: %.8f"%jd

tai=spy.unitim(et,"ET","TAI");
print>>stderr, "TAI: ",tai
tai_m=ut_m+(tai-(et-dt))*1000

taical=spy.etcal(tai,100)
print>>stderr, "TAI cal: ",taical

tdb=spy.unitim(et,"ET","TDB");
print>>stderr, "TDB: ",tdb
tdb_m=et_m+(tdb-et)*1000

tdbcal=spy.etcal(tdb,100)
print>>stderr, "TDB cal: ",tdbcal

tdt=spy.unitim(et,"ET","TDT");
print>>stderr, "TDT:",tdt
tdt_m=et_m+(tdt-et)*1000

tdtcal=spy.etcal(tdt,100)
print>>stderr, "TDT cal: ",tdtcal

print """{"UTC":%d,"DT":%.6f,"ET":%d,"TAI":%d,"TDB":%d,"TDT":%d,"JD":%.9f,"JDB":%.9f,"JDT":%.9f,"UNIX":%d}"""%(ut_m,dt_m,et_m,tai_m,tdb_m,tdt_m,jd,jdb,jdt,ut_m)
