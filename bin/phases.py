#-*- coding:utf-8 -*-
from astrotiempo import *

#######################################################################
#ARGUMENTS
#######################################################################
try:
    when=argv[1]
except:
    print>>stderr,"You must indicate when do you want the time: 'now', 'manual'"
    exit(1)

#######################################################################
#GET THE PRESENT TIME
#######################################################################
if when=="now":
    utc=dt.datetime.utcnow()
else:
    try:
        fecha=argv[2]
    except:
        print>>stderr,"You must provide a valid date: MM/DD/CCYY HH:MM:SS"
        exit(2)
    utc=dt.datetime.strptime(fecha,"%m/%d/%Y %H:%M:%S")

sdate=utc.strftime("%m/%d/%Y %H:%M:%S UTC")
print>>stderr,sdate

#######################################################################
#MAIN SCRIPT
#######################################################################
# Next quarter
et=spy.str2et(sdate)

tp,tq=moonNextQuarter(et,qtype="quarter",sign=-1)
print>>stderr,"Previous Quarter:",utcal(tp)
print>>stderr,"Phase:",moonPhase(tp)
print>>stderr,"Type of quarter:",tq

tp,tq=moonNextQuarter(et,qtype="quarter",sign=+1)
print>>stderr,"Next Quarter:",utcal(tp)
print>>stderr,"Phase:",moonPhase(tp)
print>>stderr,"Type of quarter:",tq

tp,tq=moonNextQuarter(et,qtype="full",sign=+1)
print>>stderr,"Next Full:",utcal(tp)
print>>stderr,"Phase:",moonPhase(tp)
print>>stderr,"Type of quarter:",tq

ts,tqs=moonPhases(et)
cals=[utcal(t) for t in ts]
print>>stderr,"Dates of quarters:",cals
print>>stderr,"Type of quarters:",tqs

# Output
scals="{}".format(cals).replace("'","\"")
stypes="{}".format(tqs.tolist())
print """{"dates":%s,"types":%s}"""%(scals,stypes)
