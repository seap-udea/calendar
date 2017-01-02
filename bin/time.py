#-*- coding:utf-8 -*-
from astrotiempo import *

#GET THE TIME
utc=dt.datetime.utcnow()
#utc=dt.datetime.strptime("01/01/2017 00:00:00","%m/%d/%Y %H:%M:%S")
print>>stderr, "UTC: ",utc

utc_mil=float("%.3f"%(utc.microsecond/1e6))*1000

ut=calendar.timegm(utc.timetuple())
print>>stderr, "UNIX: ",ut
ut_m=ut*1000+utc_mil

#GET ASTRONOMY TIME
sdate=utc.strftime("%m/%d/%y %H:%M:%S UTC")

et=spy.str2et(sdate)
print>>stderr, "ET: ",et

dtt=spy.deltet(et,"ET")
print>>stderr, "DT: ",dtt
dt_m=dtt*1000
et_m=ut_m+dt_m

etcal=spy.etcal(et,100)
print>>stderr, "ET cal:",etcal

jdb=spy.unitim(et,"ET","JDTDB");
print>>stderr, "JDB: %.9f"%jdb

jdt=spy.unitim(et,"ET","JDTDT");
print>>stderr, "JDT: %.9f"%jdt

jd=jdb-dtt/DAY
print>>stderr, "JD: %.8f"%jd

tai=spy.unitim(et,"ET","TAI");
print>>stderr, "TAI: ",tai
tai_m=ut_m+(tai-(et-dtt))*1000

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

# SIDEREAL TIME
p=spy.mxv(spy.pxform("J2000","EARTHTRUEEPOCH",et),spy.mxv(spy.pxform("ITRF93","J2000",et),np.array([REARTH,0,0])))
gst=np.mod(np.arctan2(p[1],p[0])*RAD/15,24)
gst=dec2sex(gst)
print>>stderr,"GST: ",gst
gstmil=float("%.0f"%((gst[2]-int(gst[2]))*1000))
gstd=dt.datetime.strptime("%02d/%02d/%d %02d:%02d:%02.6f"%(utc.month,utc.day,utc.year,
                                                           gst[0],gst[1],gst[2]),
                          "%m/%d/%Y %H:%M:%S.%f")
ugst=calendar.timegm(gstd.timetuple())
gst_m=ugst*1000+gstmil
lst_m=gst_m

print """{"UTC":%d,"DT":%.6f,"ET":%d,"TAI":%d,"TDB":%d,"TDT":%d,"JD":%.9f,"JDB":%.9f,"JDT":%.9f,"UNIX":%d,"LMT":%d,"LMST":%d,"LST":%d,"GST":%d}"""%(ut_m,dt_m,et_m,tai_m,tdb_m,tdt_m,jd,jdb,jdt,ut_m,ut_m,ut_m,lst_m,gst_m)

