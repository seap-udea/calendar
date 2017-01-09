#!/bin/bash
# Master source: https://svs.gsfc.nasa.gov/4537

# Moon info
# Year
"""
year=2011
syear=3800
iyear=3810
#"""
"""
year=2012
syear=3800
iyear=3894
#"""
"""
year=2013
syear=4000
iyear=4000
#"""
"""
year=2014
syear=4100
iyear=4118
#"""
"""
year=2015
syear=4200
iyear=4236
#"""
#"""
year=2016
syear=4400
iyear=4404
#"""
"""
year=2017
syear=4500
iyear=4537
#"""

dir="https://svs.gsfc.nasa.gov/vis/a000000/a00$syear/a00$iyear/mooninfo/"
cd mooninfo.$year
for i in $(seq 1 8760)
do
    num=$(printf "%04d\n" $i)
    if [ ! -e mooninfo.$num.js ];then 
	wget $dir/mooninfo.$num.js
    fi
    #sleep $[ ( $RANDOM % 3 )  + 1 ]s
done
cd -
