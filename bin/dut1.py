#-*- coding:utf-8 -*-
from astrotiempo import *

print "Analysing all deltas since 1972..."
f=open("bin/delpred.dat")

GPSmUTC=0
tais=[]
dgps=[]
daut1s=[]
for line in f:
    i=0
    line=line.strip("\n")
    if line=="" or "#" in line:continue
    parts=line.split()
    
    #FECHA 
    fecha=parts[0]
    comps=fecha.split("-")
    fecha="%s/%s/%s 00:00:00"%(comps[1],comps[2],comps[0])

    #TAI-UTC
    i+=1
    if parts[i]!="\"" and parts[i]!="?" and parts[i]!="-" and parts[i]!="(pred)" :
        TAImUTC=float(parts[1])

    #GPS-UTC
    i+=1
    if parts[i]!="\"" and parts[i]!="?" and parts[i]!="-" and parts[i]!="(pred)" :
        GPSmUTC=float(parts[2])

    #TT - UT1
    i+=1
    if parts[i]!="\"" and parts[i]!="?" and parts[i]!="-" and parts[i]!="(pred)" :
        TTmUT1=float(parts[3])

    #UT1-UTC
    i+=1
    if parts[i]!="\"" and parts[i]!="?" and parts[i]!="-" and parts[i]!="(pred)" :
        UT1mUTC=float(parts[4])
        
    #TAI
    et=spy.str2et(fecha)
    #print et
    tai=spy.unitim(et,"ET","TAI");
    tais+=[tai]

    #DELTAT = TT - UTC
    TTmUTC=spy.deltet(et,"ET")
    #print deltat

    #TAImUT1
    daut1s+=[TAImUTC-UT1mUTC]
    
    #print fecha,tai,TAImUTC,GPSmUTC,TTmUT1,TTmUTC,TTmUT1+UT1mUTC,UT1mUTC
    
"""
data=np.vstack((tais[::1],daut1s[::1])).transpose()
np.savetxt("bin/kernels/daut1-2.txt",data)
exit(0)
"""

print "Analysing daut1 since 2001..."
f=open("bin/dut1.dat")
for line in f:
    line=line.strip("\n")
    if line=="" or "#" in line:break
    parts=line.split()

    #DUT1
    dut1=float(parts[3])

    #FECHA 
    fecha=parts[0]
    comps=fecha.split("-")
    fecha="%s/%s/%s 00:00:00"%(comps[1],comps[2],comps[0])

    #print fecha
    utc=dt.datetime.strptime(fecha,"%m/%d/%Y %H:%M:%S")

    #TAI
    et=spy.str2et(fecha)
    #print et
    tai=spy.unitim(et,"ET","TAI");
    tais+=[tai]

    #DELTAT = TT - UTC
    deltat=spy.deltet(et,"ET")
    #print deltat

    #DELTAAT = TAI - UTC
    deltaat=float("%.0f"%(tai-(et-deltat)))

    #DAUT1 = DAT - DUT1
    daut1=deltaat-dut1
    daut1s+=[daut1]
    
tais=np.array(tais)
daut1s=np.array(daut1s)

iargs=tais.argsort()

data=np.vstack((tais[iargs],daut1s[iargs])).transpose()
np.savetxt("bin/kernels/daut1.txt",data)
