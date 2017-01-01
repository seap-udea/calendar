#-*- coding:utf-8 -*-
from astrotiempo import *

try:
    year=int(argv[1])
except:
    print "You must provide an initial year."
    exit(1)

# Find perihelio for reference year
date="01/01/%s 02:00:00"%year
et=spy.str2et(date)
sol=minimize(distanceBodies,(et,et+100*DAY),tol=1e-10,args=(EARTH,SUN))
tper_old=sol.x

print """<table border='2px' style='border-collapse:collapse'>
<tr>
<td><b>Año</b></td>
<td><b>Fecha del perihelio (UTC)</b></td>
<td><b>Distancia Tierra-Sol (km)</b></td>
<td><b>Tiempo último perihelio (días)</b></td>
</tr>
"""
for dy in xrange(1,10):
    nyear=year+dy

    date="01/01/%s 02:00:00"%nyear
    et=spy.str2et(date)

    # Find perihelion
    sol=minimize(distanceBodies,(et,et+100*DAY),tol=1e-10,args=(EARTH,SUN))
    tper=sol.x
    dt=spy.deltet(tper,"et");
    dper=spy.etcal(tper-dt,100)

    # Distance
    dmin=distanceBodies(tper,EARTH,SUN)

    # Time since last perihelion
    dtper=(tper-tper_old)/DAY

    tper_old=tper;
    print """<tr>
<td class='w3-center'>%d</td>
<td class='w3-center'>%s</td>
<td class='w3-center'>%.0f</td>
<td class='w3-center'>%.4f</td>
</tr>"""%(nyear,dper,dmin,dtper)
    
print """</table>"""
