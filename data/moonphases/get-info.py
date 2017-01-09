#!/usr/bin/env python
import numpy as np

data=[]
years=[2011,2012,2013,2014,2015,2016,2017]
years=[2016,2017]
for year in years:
    print "Reading data from year %d..."%year
    for i in xrange(1,8761):
        fname="mooninfo.%d/mooninfo.%04d.js"%(year,i)
        if (i%1000)==0:
            print "Reading %s..."%fname
        f=open(fname)
        row=[]
        for line in f:
            line=line.strip("\n")
            if not "\"" in line:continue
            if "Phase" in line:
                parts=line.split("<td>")
                comps=parts[1]
                parts=comps.split("%")
                phase=float(parts[0])
                try:
                    age=parts[1].strip()
                    age=age.split("(")[1].split(")")[0]
                    age=age.replace("d ",":")
                    age=age.replace("h ",":")
                    age=age.replace("m","").split(":")
                    dage=float(age[0])+float(age[1])/60.0+float(age[1])/3600.0
                except:
                    dage=0
                row+=[phase,dage]
            if "Diameter" in line:
                parts=line.split("<td>")
                comps=parts[1]
                diameter=float(comps.split(" arc")[0])
                row+=[diameter]
            if "Subsolar" in line:
                parts=line.split("<td>")
                comps=parts[1]
                coords=comps.split("</td>")[0]
                coords=coords.replace("&deg;","").split(", ")
                lon=float(coords[0])
                lat=float(coords[1])
                row+=[lon,lat]
            if "Position Angle" in line:
                parts=line.split("<td>")
                comps=parts[1]
                coords=comps.split("</td>")[0]
                coords=coords.replace("&deg;","")
                posang=float(coords)
                row+=[posang]
                data+=[row]
                if len(row)!=6:
                    print "Cuidado"
                    exit(0)

data=np.array(data)
header="1:phase(%)		 2:age(days)		  3:diameter(arcsec)	    4:lon(deg)		     5:lat(deg)		      6:pos.angle (deg)"
np.savetxt("mooninfo.dat",data,header=header)
