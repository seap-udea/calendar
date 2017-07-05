#-*- coding:utf-8 -*-
#############################################################
#EXTERNAL MODULES
#############################################################
from astrotiempo import *

from matplotlib import use
use('Agg')
import matplotlib.pyplot as plt
from matplotlib.colors import LogNorm
from mpl_toolkits.basemap import Basemap as map,shiftgrid
import matplotlib.patches as patches
from matplotlib.collections import PatchCollection
import matplotlib.cm as cm

#############################################################
#CONFIGURATION
#############################################################
#LOAD CONFIGURATION
try:
    confile=argv[1]
    CONF=loadconf(confile)
except:
    print "You must provide a configuration file..."
    exit(1)

try:
    confile=argv[2]
    P=loadconf(confile)
except:
    print "You must provide a configuration file for country..."
    exit(1)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#COUNTRY
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
COUNTRY=P.COUNTRY
CODE=P.CODE
TZ=P.TZ

MAGS=P.MAGS
MAGINI=P.MAGINI
DMAG=P.DMAG

DT_INI=P.DT_INI
HINI_INI=P.HINI_INI
DELTAT_INI=P.DELTAT_INI
MAXT_INI=P.MAXT_INI

DT_FIN=P.DT_FIN
HINI_FIN=P.HINI_FIN
DELTAT_FIN=P.DELTAT_FIN
MAXT_FIN=P.MAXT_FIN

LOCATION=P.LOCATION

latmin_m=P.latmin_m
latmax_m=P.latmax_m
lonmin_m=P.lonmin_m
lonmax_m=P.lonmax_m

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#BEHAVIOR
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
COUNTRIES=1
EXT="pdf"
PARMER=0
QLOAD=1
NLAT=120
NLON=120

"""
NLAT=5
NLON=5
#"""

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MAP
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
latmean=(latmin_m+latmax_m)/2
lonmean=(lonmin_m+lonmax_m)/2
dlat=latmax_m-latmin_m
dlon=lonmax_m-lonmin_m
limits=[latmean,lonmean,dlat,dlon]

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#ASTRONOMICAL
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
DATE="8/21/2017"

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MACROS
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
PI=np.pi
Polygon=patches.Polygon

#############################################################
#PREPARATION
#############################################################
fig,axs=subPlots(plt,[1])
ax=axs[0]

#############################################################
#CREATE MAP
#############################################################

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MAP PROPERTIES
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
qlatmean=limits[0]
qlonmean=limits[1]
dlat=limits[2]*PI/180*6371.0e3
dlon=limits[3]*PI/180*6371.0e3
fpardict=dict(labels=[True,True,False,False],
              fontsize=10,zorder=10,linewidth=0.5,fmt=lat2str)
fmerdict=dict(labels=[False,False,False,True],
              fontsize=10,zorder=10,linewidth=0.5,fmt=lon2str)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#CREATE MAP
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
m=map(projection="aea",resolution='l',width=dlon,height=dlat,
      lat_0=qlatmean,lon_0=qlonmean,ax=ax)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#DRAW DECORATION
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
m.drawmapboundary(fill_color=CONF.COLORWATER)
m.fillcontinents(color=CONF.COLORLAND,lake_color=CONF.COLORWATER)

if PARMER:
    m.drawparallels(np.arange(-90,90,5),**fpardict)
    mers=m.drawmeridians(np.arange(-180,180,5),**fmerdict)
    #Change values of longitude
    for lon in mers.keys():
        mer=mers[lon]
        try:
            mertxt=mer[1][0]
            val=float(mertxt.get_text())
            mod=np.mod(val,360)-360
            mertxt.set_text("%.0f"%mod)
        except:
            pass

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#DRAW COUNTRIES BOUNDARIES
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
if COUNTRIES:
    #Source of countries division:
    #https://github.com/nvkelso/natural-earth-vector/tree/master/10m_cultural
    m.readshapefile('bin/kernels/ne_10m_admin_0_countries_lakes',
                    'units',color=CONF.COLORBOUND,linewidth=.4)
    i=0
    for info, shape in zip(m.units_info, m.units):
        i+=1
        if i<100:continue
        if i>2:break
        print "Unit %d..."%i
        iso3 = info['ADM0_A3']
        color='none'
        patches = [Polygon(np.array(shape),True)]
        pc = PatchCollection(patches)
        pc.set_facecolor(color)
        ax.add_collection(pc)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#LOAD RESULTS
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
TOTALITY=np.loadtxt("data/TOTALITY")
LATS=np.loadtxt("data/LATS")
LONS=np.loadtxt("data/LONS")
QTIPO=np.loadtxt("data/QTIPO")
DIST=np.loadtxt("data/DIST")
TC1=np.loadtxt("data/TC1")
TECL=np.loadtxt("data/TECL")
TC4=np.loadtxt("data/TC4")
MAG=np.loadtxt("data/MAG")
OBSC=np.loadtxt("data/OBSC")
DURACION=np.loadtxt("data/DURACION")

#CONTOUR CARTESIAN GRID
X,Y=m(LONS,LATS)

#############################################################
#MAPA DATOS
#############################################################
if CONF.PLOT=="magini":
    TPROXY=TC1
    TINI=16;TEND=24
    HS=HINI_INI+np.arange(0,MAXT_INI/60.,DELTAT_INI/60.)
    DT=DT_INI
    QUANT=MAG
    ZLEVEL=0.5
    ax.set_title(u"Eclipse de Sol del 21 de Agosto de 2017\nHora de inicio del eclipse en "+COUNTRY,
                 position=(0.5,1.02),fontsize=12)
    IMGNAME="mapa-magnitud-inicio"

if CONF.PLOT=="magfin":
    TPROXY=TC4
    TINI=18;TEND=22
    HS=HINI_FIN+np.arange(0,MAXT_FIN/60.,DELTAT_FIN/60.)
    DT=DT_FIN
    QUANT=MAG
    ZLEVEL=0.5
    ax.set_title(u"Eclipse de Sol del 21 de Agosto de 2017\nHora de fin del eclipse en "+COUNTRY,
                 position=(0.5,1.02),fontsize=12)
    IMGNAME="mapa-magnitud-fin"

print "Plotting ",CONF.PLOT,"(image %s)"%IMGNAME

ax.text(0.01,-0.01,"Astrotiempo @AstronomiaUdeA",color='k',
        fontsize=8,transform=ax.transAxes,va='top')

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#TIME GRID
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
levels=np.arange(TINI,TEND,DT/60.0) # Cada 10 minutos
for H in HS:levels=np.extract(np.abs(levels-H)>1e-5,levels)
cs=m.contour(X,Y,TPROXY,levels,zorder=10,
             colors=[CONF.COLORGRID],linestyles='solid',linewidths=0.2)

#LINEAS DE HORA
lw=1
dss=[(0,(2, 1)),
     (0,(6, 1)),
     (0,(12, 1))]
il=0
for H in HS:
    hora=dec2sex(H-TZ,sep=[":",":"],secfmt="%02.0f")
    print "Contorno de la hora ",H
    cs=m.contour(X,Y,TPROXY,[H],zorder=10,colors=[CONF.COLORGRID],
                 linestyles='--',linewidths=lw)
    for c in cs.collections:c.set_dashes([dss[il%3]])
    ax.plot([],[],color=CONF.COLORGRID,ls='--',dashes=dss[il%3][1],
            label=r"%s"%hora,lw=lw)
    il+=1

# LEGEND
legend=ax.legend(loc=LOCATION,prop=dict(size=8),handlelength=3)
frame=legend.get_frame()
frame.set_facecolor(CONF.COLORLAND)
frame.set_alpha(0.5)
frame.set_edgecolor('none')
for t in legend.get_texts():t.set_color(CONF.COLORGRID)

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#MAGNITUDE GRID
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
tlevels=MAGS
cs=m.contour(X,Y,QUANT,tlevels,
             zorder=100,colors=[CONF.COLORGRID],
             linestyles='solid',linewidths=1)
ax.clabel(cs,inline=1,
          fontsize=10,fmt="%.1f%%",zorder=100,color=CONF.COLORGRID)

levels=np.arange(MAGINI,95+10,DMAG) # Cada 10%
for l in tlevels:levels=np.extract(np.abs(levels-l)>1e-5,levels)
cs=m.contour(X,Y,QUANT,levels,
             zorder=100,colors=[CONF.COLORGRID],
             linestyles='solid',linewidths=0.2)

levels=[ZLEVEL]
cs=m.contour(X,Y,QUANT,levels,zorder=10,colors=CONF.COLORGRID,linewidths=4)

levels=[100.0]
cs=m.contour(X,Y,MAG,levels,zorder=10,colors=CONF.COLORGRID,linewidths=3)
ax.clabel(cs,inline=1,
          fontsize=8,fmt="Totalidad",zorder=100,color=CONF.COLORGRID)

fname="data/"+IMGNAME+"-"+CONF.SUF+"-"+CODE+"."+EXT
print "\tSaving %s."%fname
fig.savefig(fname,bbox_inches='tight')
fname="data/"+IMGNAME+"-"+CONF.SUF+"-"+CODE+".png"
print "\tSaving %s."%fname
fig.savefig(fname,bbox_inches='tight')
