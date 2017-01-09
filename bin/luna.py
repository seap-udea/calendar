#-*- coding:utf-8 -*-
from astrotiempo import *

#######################################################################
#ARGUMENTS
#######################################################################
try:
    when=argv[1]
except:
    print>>stderr, "You must indicate when do you want the time: 'now', 'manual'"
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
        print>>stderr, "You must provide a valid date: MM/DD/CCYY HH:MM:SS"
        exit(2)
    utc=dt.datetime.strptime(fecha,"%m/%d/%Y %H:%M:%S")

#######################################################################
#ROUTINES
#######################################################################
# Calculate the generalized distance: phase, lon, lat
def distance(pha,lon,lat,pha0,lon0,lat0):
    d2=((pha-pha0)/100.0)**2+((lon-lon0)/180.0)**2+((lat-lat0)/90.0)**2
    return d2**0.5

DATA=[
    #dict(year=2011,syear=3800,iyear=3810,),
    #dict(year=2012,syear=3800,iyear=3894,),
    #dict(year=2013,syear=4000,iyear=4000,),
    #dict(year=2014,syear=4100,iyear=4118,),
    #dict(year=2015,syear=4200,iyear=4236,),
    dict(year=2016,syear=4400,iyear=4404,),
    dict(year=2017,syear=4500,iyear=4537,),
] 
URLMOON="https://svs.gsfc.nasa.gov/vis/a000000/a00[syear]/a00[iyear]/"

def imageToUse(i):
    """Calculate image to display
    i: position of image in series (i=0 first image, i=8759 last image
    first year)
    """
    iyear=int(np.floor(i/8760))
    ipos=(i%8760)+1
    dyear=DATA[iyear]
    year=dyear["year"]
    url=URLMOON.\
         replace("[syear]","%s"%dyear["syear"]).\
         replace("[iyear]","%s"%dyear["iyear"])+\
         "frames/730x730_1x1_30p/moon.%04d.jpg"%ipos
    return url

"""
i=0
url=imageToUse(i)
print>>stderr, url
exit(0)
"""

#######################################################################
#MAIN SCRIPT
#######################################################################
# Round to closes hour
print>>stderr, "Date:",utc
utc=roundTime(utc,60*60)
sdate=utc.strftime("%m/%d/%Y %H:%M:%S UTC")
print>>stderr, "Rounded date:",sdate

# Ephemeris Time
et=spy.str2et(sdate)
print>>stderr, "TDB = ",et
etcal=spy.etcal(et,100)
print>>stderr, "TDB (cal.):",etcal

# Position vector of the moon
x=stateBody(et,MOON,EARTH,"ECLIPJ2000")
d=spy.vnorm(x[:3])
print>>stderr, "Distance:",d

# Phase
fi=moonPhase(et)
print>>stderr, "Phase (%): ",fi

# Sub solar point on the moon
n,Rm=spy.bodvrd("MOON","RADII",3)
fm=(Rm[2]-Rm[0])/Rm[0]
sm,te,so=spy.subslr("Near point: ellipsoid","MOON",et,"IAU_MOON","LT+S","MOON")
mlon,mlat,malt=spy.recpgr("MARS",sm,Rm[0],fm)
mlon=np.mod(360-mlon*RAD,360.0) #Convert to lunar convention: East positive
mlon=np.mod(mlon+180,360)-180 #Convert from 0 to 360 to -180 to 180
mlat=mlat*RAD
print>>stderr, "Subsolar point (lon,lat):",mlon,mlat

# Diameter
diam=2*np.arctan(Rm[0]/d)*RAD*3600
print>>stderr, "Diameter (arcsec): ",diam

# Latest new moon
tq=2
tm=et
while tq==2:
    tm,tq=moonNextQuarter(tm-12*HOUR,sign=-1,qtype="full")
print>>stderr, "Latest New Moon: ",utcal(tm)

age=(et-tm)/DAY
dage=dec2sex(age,day=True,sep=("d ","h "))
print>>stderr, "Age (d:h:m): ",age,dage

# Load moondata
data=np.loadtxt("data/moonphases/mooninfo.dat")
ies=np.arange(0,len(data))
fis=data[:,0]
diams=data[:,2]
mlons=data[:,3]
mlats=data[:,4]
posas=data[:,5]

# Get the closest images by phase
cond=np.abs(fi-fis)<0.1
pies=ies[cond]
pfis=fis[cond]
pdiams=diams[cond]
plons=mlons[cond]
plats=mlats[cond]
pposas=posas[cond]

# Sort by generalized distance
ds=distance(fi,mlon,mlat,pfis,plons,plats)
isort=ds.argsort()

# Get the characteristic values
ii=pies[isort[0]]
fii=pfis[isort[0]]
diami=pdiams[isort[0]]
loni=plons[isort[0]]
lati=plats[isort[0]]
posai=pposas[isort[0]]

print>>stderr, "Closest image:",ii
print>>stderr, "Closest point (phase,diam,lon,lat,posang):",fii,diami,loni,lati,posai

# Get image
url=imageToUse(ii)
print>>stderr, "URL:",url

# Output
print """{"url":"%s","phase":"%.1f%%","age":"%s"}"""%(url,fi,dage)
