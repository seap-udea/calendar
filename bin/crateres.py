#-*- coding:utf-8 -*-
from astrotiempo import *

#######################################################################
#ARGUMENTS
#######################################################################
iarg=1
try:
    when=argv[iarg];iarg+=1
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
        fecha=argv[iarg];iarg+=1
    except:
        print>>stderr, "You must provide a valid date: MM/DD/CCYY HH:MM:SS"
        exit(2)
    utc=dt.datetime.strptime(fecha,"%m/%d/%Y %H:%M:%S")

try:
    sessid=argv[iarg];iarg+=1
except:
    sessid=genString(26)

#######################################################################
#MAIN SCRIPT
#######################################################################
# Round to closes hour
print>>stderr, "Date:",utc
utc=roundTime(utc,60*60)
sdate=utc.strftime("%m/%d/%Y %H:%M:%S UTC")
print>>stderr, "Rounded date:",sdate

# Get year 
year=utc.year

# Video
video="data/moonphases/phases.%d/phases.%d.mp4"%(year,year)

# Calculate time
utcone=dt.datetime.strptime("01/01/%d 00:00:00"%year,"%m/%d/%Y %H:%M:%S")
dt=(utc-utcone).total_seconds()/HOUR

# fps
fps=30.0
t=(dt/fps)/3600.0
ss=dec2sex(t,sep=(":",":"))
print>>stderr,"Video time:",ss

# ffmpeg
image="tmp/out.%s.png"%sessid
cmd="ffmpeg -y -ss %s -i %s -vframes 1 %s 2> tmp/ffmpeg.log"%(ss,video,image)
os.system(cmd)

# Output
print """{"image":"%s"}"""%image
