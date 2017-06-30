#-*- coding:utf-8 -*-
from astrotiempo import *

# ############################################################
# INPUT
# ############################################################
lat=float(argv[1])
lon=float(argv[2])
date=argv[3]

# ############################################################
# OBSERVER POSITION
# ############################################################
obs=spy.jobsini('EARTH',lon,lat,0.0)

# ############################################################
# BASIC ROUTINES
# ############################################################
# Computes angular distance between the Sun and the Moon
def angDist(t,obs):
    return spy.jangdis('MOON','SUN',t,obs)
# Compute the contact function
def contactFunction(t,obs,k):
    return spy.jangdis('MOON','SUN',t,obs,k=k)

# ############################################################
# CALCULATION
# ############################################################

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# MAXIMUM ECLIPSE
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
t1=spy.str2et(date+' 00:00:00 UTC')
t2=spy.str2et(date+' 23:59:59 UTC')
tecl=spy.jminim(angDist,(t1,t2),method='brent',args=(obs,),tol=1e-13).x
cal_max=spy.timout(tecl,'MM/DD/YYYY HR:MN:SC.# +000',100)

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# EPHEMERIS SUN-MOON
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
mat=spy.jrotmat(tecl)
ephem_sun=spy.jephem('SUN',tecl,obs,mat)
ephem_moon=spy.jephem('MOON',tecl,obs,mat)
size_sun=ephem_sun["angsize"]/60.0
size_moon=ephem_moon["angsize"]/60.0
el_max=ephem_sun["el"]*RAD
dist=angDist(tecl,obs)*RAD*60
ratio=size_moon/size_sun

# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
# EVALUATE ECLIPSE
# %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
qtipo=1
tipo="Parcial"
duracion=0.0
cal_c1=cal_max
cal_c4=cal_max
mag=0.0
obsc=0.0
el_c1=0.0
el_c4=0.0

if dist<(size_sun+size_moon)/2:

    # %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    # ECLIPSE HAPPENS!
    # %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

    # ====================
    # CONTACT TIMES 
    # ====================
    tc1=spy.jzero(contactFunction,t1,tecl,args=(obs,+1))
    cal_c1=spy.timout(tc1,'MM/DD/YYYY HR:MN:SC.# +000',100)
    mat=spy.jrotmat(tc1)
    ephem_sun=spy.jephem('SUN',tc1,obs,mat)
    el_c1=ephem_sun["el"]*RAD

    # Determine if the eclipse is total or partial
    try:
        tc2=spy.jzero(contactFunction,t1,tecl,args=(obs,-1))
        tipo="Total"
        tc3=spy.jzero(contactFunction,tecl,t2,args=(obs,-1))
        duracion=dec2sex((tc3-tc2)/3600.0,sep=[":",":"])
        qtipo=2
    except:
        pass

    tc4=spy.jzero(contactFunction,tecl,t2,args=(obs,+1))
    cal_c4=spy.timout(tc4,'MM/DD/YYYY HR:MN:SC.# +000',100)
    mat=spy.jrotmat(tc4)
    ephem_sun=spy.jephem('SUN',tc4,obs,mat)
    el_c4=ephem_sun["el"]*RAD

    if el_c1<0:
        # %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        # NO ECLIPSE
        # %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
        qtipo=-1 # No se puede ver la Luna y el Sol 
        tipo="No visible"
        cal_max=date+" 00:00:00.0 +000"
        cal_c1=cal_max
        cal_c4=cal_max
        mag=0.0
        obsc=0.0
        el_max=0.0
        el_c1=0.0
        el_c4=0.0
        dist=0.0
    else:
        # ====================
        # MAGNIT. & OSCURAT.
        # ====================
        # See: http://www.cosmicriver.net/blog/solar-eclipses-magnitude-and-obscuration
        R=size_moon/2
        r=size_sun/2
        OA=dist
        
        # Magnitude
        mag=100*(R+r-OA)/(2*r)
        
        # Obscuring
        if qtipo!=2:
            a=(R**2-r**2+OA**2)/(2*OA)
            alpha=2*np.arccos((OA-a)/r)
            beta=2*np.arccos(a/R)
            area1=0.5*R**2*(beta-np.sin(beta))
            area2=0.5*r**2*(alpha-np.sin(alpha))
            obsc=100*(area1+area2)/(np.pi*r**2)
            duracion=dec2sex((tc4-tc1)/3600.0,sep=[":",":"])
        else:
            obsc=100.0
else:
    # %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    # NO ECLIPSE
    # %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
    qtipo=0 # Se puede ver la Luna y el Sol pero no el eclipse
    tipo="No eclipse"
    cal_max=date+" 00:00:00.0 +000"
    el_max=0.0
    cal_c1=cal_max
    cal_c4=cal_max
    
    dist=0.0

# ############################################################
# RESULTS
# ############################################################
print """{"qtipo":%d,"type":"%s","size_sun":%.3f,"size_moon":%.3f,"dist":%.3f,"tc1":"%s","el_c1":%.5f,"tcmax":"%s","el_max":%.5f,"tc4":"%s","el_c4":%.5f,"mag":%.2f,"obs":%.2f,"ratio":%.7f,"duracion":"%s"}"""%\
    (qtipo,
     tipo,
     size_sun,
     size_moon,
     dist,
     cal_c1,
     el_c1,
     cal_max,
     el_max,
     cal_c4,
     el_c4,
     mag,
     obsc,
     ratio,
     duracion)

