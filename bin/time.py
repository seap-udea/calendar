#-*- coding:utf-8 -*-
from astrotiempo import *

try:
    when=argv[1]
except:
    print "You must indicate when do you want the time: 'now', 'manual'"
    exit(1)

#GET THE PRESENT TIME
if when=="now":
    utc=dt.datetime.utcnow()
else:
    try:
        fecha=argv[2]
    except:
        print "You must provide a valid date: MM/DD/CCYY HH:MM:SS"
        exit(2)
    utc=dt.datetime.strptime(fecha,"%m/%d/%Y %H:%M:%S")

# ######################################################################
# UTC TIME
# ######################################################################
print>>stderr, "UTC: ",utc
utc_mil=float("%.3f"%(utc.microsecond/1e6))*1000

# ######################################################################
# GREGORIAN DATE
# ######################################################################
sdate=utc.strftime("%m/%d/%y %H:%M:%S UTC")

# ######################################################################
# UNIX TIME
# ######################################################################
ut=calendar.timegm(utc.timetuple())
print>>stderr, "UNIX: ",ut
ut_m=ut*1000+utc_mil

# ######################################################################
# EPHEMERIS TIME ( = TDB)
# ######################################################################
et=spy.str2et(sdate)
print>>stderr, "ET: ",et

dtt=spy.deltet(et,"ET")
print>>stderr, "DT: ",dtt
dt_m=dtt*1000
et_m=ut_m+dt_m

etcal=spy.etcal(et,100)
print>>stderr, "ET cal:",etcal

# ######################################################################
# JULIAN DATE
# ######################################################################
jdb=spy.unitim(et,"ET","JDTDB");
print>>stderr, "JDB: %.9f"%jdb

jd=jdb-dtt/DAY
print>>stderr, "JD: %.8f"%jd

# ######################################################################
# ATOMIC TIME
# ######################################################################
tai=spy.unitim(et,"ET","TAI");
print>>stderr, "TAI: ",tai
tai_m=ut_m+(tai-(et-dtt))*1000

taical=spy.etcal(tai,100)
print>>stderr, "TAI cal: ",taical

# ######################################################################
# UNIVERSAL TIME RELATIVE TO EARTH ROTATION, UT1
# ######################################################################
"""
For dates < 09/01/2016 values are interpolated
Values available only for dates > 01/01/1972
"""
data=np.loadtxt("bin/kernels/daut1.txt")
daut1_func=interp1d(data[:,0],data[:,1],kind='slinear')
try:
    daut1=daut1_func(tai)
except ValueError:
    tmin=spy.etcal(data[0,0],100)
    tmax=spy.etcal(data[-1,0],100)
    print "We can only calculate time between %s and %s"%(tmin,tmax)
    exit(3)

ut1=tai-daut1
print>>stderr,"UT1: ",ut1
ut1_m=tai_m-daut1*1000
ut1cal=spy.etcal(ut1,100)
print>>stderr,"UT1 cal: ",ut1cal

# ######################################################################
# BARYCENTRIC DYNAMICAL TIME
# ######################################################################
tdb=spy.unitim(et,"ET","TDB");
print>>stderr, "TDB: ",tdb
tdb_m=et_m+(tdb-et)*1000

tdbcal=spy.etcal(tdb,100)
print>>stderr, "TDB cal: ",tdbcal

# ######################################################################
# DYNAMICAL TERRESTRIAL TIME
# ######################################################################
tdt=spy.unitim(et,"ET","TDT");
print>>stderr, "TDT:",tdt
tdt_m=et_m+(tdt-et)*1000

tdtcal=spy.etcal(tdt,100)
print>>stderr, "TDT cal: ",tdtcal

# ######################################################################
# GEOCENTRIC COORDINATED TIME, TCG
# ######################################################################
tcg=(tdt-LG*T0)/(1-LG)
print>>stderr, "TCG:",tcg
tcg_m=et_m+(tcg-et)*1000
tcgcal=spy.etcal(tcg,100)
print>>stderr, "TCG cal: ",tcgcal

# ######################################################################
# BARYCENTRIC COORDINATED TIME, TCB
# ######################################################################
tcb=(tdt-LB*T0)/(1-LB)
print>>stderr, "TCB:",tcb
tcb_m=et_m+(tcb-et)*1000
tcbcal=spy.etcal(tcb,100)
print>>stderr, "TCB cal: ",tcbcal

# ######################################################################
# SIDEREAL TIME
# ######################################################################
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

# ######################################################################
# TRUE SOLAR TIME
# ######################################################################
gmt=utc.strftime("%H:%M:%S.%f")
tst=spy.et2lst(et,399,0*DEG,"PLANETOGRAPHIC",100,100)
print>>stderr,"TST sex:",tst
tst_d=sex2dec(tst[3],sep=":")
print>>stderr,"TST time:",tst_d
gmt_d=sex2dec(gmt,sep=":")
tstmil=float("%.0f"%((tst[2]-int(tst[2]))*1000))
tstd=dt.datetime.strptime("%02d/%02d/%d %02d:%02d:%02.6f"%(utc.month,utc.day,utc.year,
                                                           tst[0],tst[1],tst[2]),
                          "%m/%d/%Y %H:%M:%S.%f")
utst=calendar.timegm(tstd.timetuple())
tst_m=utst*1000+tstmil
print>>stderr,"TST: %d"%tst_m
print>>stderr,"TST cal: ",tstd

# ######################################################################
# EQUATION OF TIME
# ######################################################################
eot=(tst_d-gmt_d)*60
if np.abs(eot)>30:
    if (tst_d-gmt_d)*60>30:eot=(tst_d-(gmt_d+24))*60
    elif (tst_d-gmt_d)*60<-30:eot=((tst_d+24)-gmt_d)*60
print>>stderr,"EOT (min) = ",eot

# ######################################################################
# JSON OUTPUT
# ######################################################################
print """{"UTC":%d,"DT":%.6f,"ET":%d,"TAI":%d,"TDB":%d,"TDT":%d,"JD":%.9f,"JDB":%.9f,"UNIX":%d,"LMT":%d,"MST":%d,"TST":%d,"LAST":%d,"GAST":%d,"UTAI":%d,"UT1":%d,"TCG":%d,"TCB":%d}"""%(ut_m,dt_m,et_m,tai_m,tdb_m,tdt_m,jd,jdb,ut_m,ut_m,ut_m,tst_m,lst_m,gst_m,tai*1e3,ut1_m,tcg_m,tcb_m)
