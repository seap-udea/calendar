#-*- coding:utf-8 -*-
from calendar import *

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

print """<table>
<th>
<td>Año</td>
<td>Fecha del perihelio (UTC)</td>
<td>Tiempo desde el último (días)</td>
</th>
"""
for dy in xrange(1,5):
    nyear=year+dy

    date="01/01/%s 02:00:00"%nyear
    et=spy.str2et(date)

    # Find perihelion
    sol=minimize(distanceBodies,(et,et+100*DAY),tol=1e-10,args=(EARTH,SUN))
    tper=sol.x
    dt=spy.deltet(tper,"et");
    dper=spy.etcal(tper-dt,100)

    # Time since last perihelion
    dtper=(tper-tper_old)/DAY

    print """<tr>
<td>%d</td>
<td>%s</td>
<td>%.4f</td>
</tr>"""%(nyear,dper,dtper)

    
print """</table>"""
