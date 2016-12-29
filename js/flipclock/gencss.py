#!/usr/bin/env python

fi=1.0
wc=650*fi+20
fwr=11*fi
fcm=36*fi
mg=5*fi
wd=60*fi
hg=90*fi
fs=80*fi
lh=87*fi
br=6*fi
wp=200*fi
ta=44*fi
ha=3*fi
blr=6*fi
fsi=70*fi
wdv=20*fi
hdv=100*fi

dcw=10*fi
dsh=5*fi

dt=1.5*fi
dr=86*fi
dmr=88*fi
dsr=91*fi
cdt=30*fi

f=open("flipclock.resize.css","w")
f.write("""
/* Get the bourbon mixin from http://bourbon.io */
/* Reset */
.flip-container{
    width:%.1fpx;
}
.flip-clock-wrapper * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    -o-backface-visibility: hidden;
    backface-visibility: hidden;
}

.flip-clock-wrapper a {
  cursor: pointer;
  text-decoration: none;
  color: #ccc; }

.flip-clock-wrapper a:hover {
  color: #fff; }

.flip-clock-wrapper ul {
  list-style: none; }

.flip-clock-wrapper.clearfix:before,
.flip-clock-wrapper.clearfix:after {
  content: " ";
  display: table; }

.flip-clock-wrapper.clearfix:after {
  clear: both; }

.flip-clock-wrapper.clearfix {
  *zoom: 1; }

/* Main */
.flip-clock-wrapper {
  font: normal %dpx "Helvetica Neue", Helvetica, sans-serif;
  -webkit-user-select: none; }

.flip-clock-meridium {
  background: none !important;
  box-shadow: 0 0 0 !important;
  font-size: %dpx !important; }

.flip-clock-meridium a { color: #313333; }

.flip-clock-wrapper {
  text-align: center;
  position: relative;
  margin: 1em;
  width: 100%%;
}

.flip-clock-wrapper:before,
.flip-clock-wrapper:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}
.flip-clock-wrapper:after {
    clear: both;
}

/* Skeleton */
.flip-clock-wrapper ul {
  position: relative;
  float: left;
  margin: %dpx;
  width: %dpx;
  height: %dpx;
  font-size: %dpx;
  font-weight: bold;
  line-height: %dpx;
  border-radius: %dpx;
  background: #000;
}

.flip-clock-wrapper ul li {
  z-index: 1;
  position: absolute;
  left: 0;
  top: 0;
  width: 100%%;
  height: 100%%;
  line-height: %dpx;
  text-decoration: none !important;
}

.flip-clock-wrapper ul li:first-child {
  z-index: 2; }

.flip-clock-wrapper ul li a {
  display: block;
  height: 100%%;
  -webkit-perspective: %dpx;
  -moz-perspective: %dpx;
  perspective: %dpx;
  margin: 0 !important;
  overflow: visible !important;
  cursor: default !important; }

.flip-clock-wrapper ul li a div {
  z-index: 1;
  position: absolute;
  left: 0;
  width: 100%%;
  height: 50%%;
  font-size: %dpx;
  overflow: hidden; 
  outline: 1px solid transparent; }

.flip-clock-wrapper ul li a div .shadow {
  position: absolute;
  width: 100%%;
  height: 100%%;
  z-index: 2; }

.flip-clock-wrapper ul li a div.up {
  -webkit-transform-origin: 50%% 100%%;
  -moz-transform-origin: 50%% 100%%;
  -ms-transform-origin: 50%% 100%%;
  -o-transform-origin: 50%% 100%%;
  transform-origin: 50%% 100%%;
  top: 0; }

.flip-clock-wrapper ul li a div.up:after {
  content: "";
  position: absolute;
  top: %dpx;
  left: 0;
  z-index: 5;
  width: 100%%;
  height: %dpx;
  background-color: #000;
  background-color: rgba(0, 0, 0, 0.4); }

.flip-clock-wrapper ul li a div.down {
  -webkit-transform-origin: 50%% 0;
  -moz-transform-origin: 50%% 0;
  -ms-transform-origin: 50%% 0;
  -o-transform-origin: 50%% 0;
  transform-origin: 50%% 0;
  bottom: 0;
  border-bottom-left-radius: %dpx;
  border-bottom-right-radius: %dpx;
}

.flip-clock-wrapper ul li a div div.inn {
  position: absolute;
  left: 0;
  z-index: 1;
  width: 100%%;
  height: 200%%;
  color: #ccc;
  text-shadow: 0 1px 2px #000;
  text-align: center;
  background-color: #333;
  border-radius: %dpx;
  font-size: %dpx; }

.flip-clock-wrapper ul li a div.up div.inn {
  top: 0; }

.flip-clock-wrapper ul li a div.down div.inn {
  bottom: 0; }

/* PLAY */
.flip-clock-wrapper ul.play li.flip-clock-before {
  z-index: 3; }

.flip-clock-wrapper .flip {   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.7); }

.flip-clock-wrapper ul.play li.flip-clock-active {
  -webkit-animation: asd 0.5s 0.5s linear both;
  -moz-animation: asd 0.5s 0.5s linear both;
  animation: asd 0.5s 0.5s linear both;
  z-index: 5; }

.flip-clock-divider {
  float: left;
  display: inline-block;
  position: relative;
  width: %dpx;
  height: %dpx; }

.flip-clock-divider:first-child {
  width: 0; }

.flip-clock-dot {
  display: block;
  background: #323434;
  width: %dpx;
  height: %dpx;
  position: absolute;
  border-radius: 50%%;
  box-shadow: 0 0 %dpx rgba(0, 0, 0, 0.5);
  left: %dpx; }

.flip-clock-divider .flip-clock-label {
  position: absolute;
  top: -%.1fem;
  right: -%dpx;
  color: white;
  font-size:10px;
  text-shadow: none; }

.flip-clock-divider.minutes .flip-clock-label {
  right: -%dpx; }

.flip-clock-divider.seconds .flip-clock-label {
  right: -%dpx; }

.flip-clock-dot.top {
  top: %dpx; }

.flip-clock-dot.bottom {
  bottom: %dpx; }

@-webkit-keyframes asd {
  0%% {
    z-index: 2; }

  20%% {
    z-index: 4; }

  100%% {
    z-index: 4; } }

@-moz-keyframes asd {
  0%% {
    z-index: 2; }

  20%% {
    z-index: 4; }

  100%% {
    z-index: 4; } }

@-o-keyframes asd {
  0%% {
    z-index: 2; }

  20%% {
    z-index: 4; }

  100%% {
    z-index: 4; } }

@keyframes asd {
  0%% {
    z-index: 2; }

  20%% {
    z-index: 4; }

  100%% {
    z-index: 4; } }

.flip-clock-wrapper ul.play li.flip-clock-active .down {
  z-index: 2;
  -webkit-animation: turn 0.5s 0.5s linear both;
  -moz-animation: turn 0.5s 0.5s linear both;
  animation: turn 0.5s 0.5s linear both; }

@-webkit-keyframes turn {
  0%% {
    -webkit-transform: rotateX(90deg); }

  100%% {
    -webkit-transform: rotateX(0deg); } }

@-moz-keyframes turn {
  0%% {
    -moz-transform: rotateX(90deg); }

  100%% {
    -moz-transform: rotateX(0deg); } }

@-o-keyframes turn {
  0%% {
    -o-transform: rotateX(90deg); }

  100%% {
    -o-transform: rotateX(0deg); } }

@keyframes turn {
  0%% {
    transform: rotateX(90deg); }

  100%% {
    transform: rotateX(0deg); } }

.flip-clock-wrapper ul.play li.flip-clock-before .up {
  z-index: 2;
  -webkit-animation: turn2 0.5s linear both;
  -moz-animation: turn2 0.5s linear both;
  animation: turn2 0.5s linear both; }

@-webkit-keyframes turn2 {
  0%% {
    -webkit-transform: rotateX(0deg); }

  100%% {
    -webkit-transform: rotateX(-90deg); } }

@-moz-keyframes turn2 {
  0%% {
    -moz-transform: rotateX(0deg); }

  100%% {
    -moz-transform: rotateX(-90deg); } }

@-o-keyframes turn2 {
  0%% {
    -o-transform: rotateX(0deg); }

  100%% {
    -o-transform: rotateX(-90deg); } }

@keyframes turn2 {
  0%% {
    transform: rotateX(0deg); }

  100%% {
    transform: rotateX(-90deg); } }

.flip-clock-wrapper ul li.flip-clock-active {
  z-index: 3; }

/* SHADOW */
.flip-clock-wrapper ul.play li.flip-clock-before .up .shadow {
  background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%%, black 100%%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%%, rgba(0, 0, 0, 0.1)), color-stop(100%%, black));
  background: linear, top, rgba(0, 0, 0, 0.1) 0%%, black 100%%;
  background: -o-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%%, black 100%%);
  background: -ms-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%%, black 100%%);
  background: linear, to bottom, rgba(0, 0, 0, 0.1) 0%%, black 100%%;
  -webkit-animation: show 0.5s linear both;
  -moz-animation: show 0.5s linear both;
  animation: show 0.5s linear both; }

.flip-clock-wrapper ul.play li.flip-clock-active .up .shadow {
  background: -moz-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%%, black 100%%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%%, rgba(0, 0, 0, 0.1)), color-stop(100%%, black));
  background: linear, top, rgba(0, 0, 0, 0.1) 0%%, black 100%%;
  background: -o-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%%, black 100%%);
  background: -ms-linear-gradient(top, rgba(0, 0, 0, 0.1) 0%%, black 100%%);
  background: linear, to bottom, rgba(0, 0, 0, 0.1) 0%%, black 100%%;
  -webkit-animation: hide 0.5s 0.3s linear both;
  -moz-animation: hide 0.5s 0.3s linear both;
  animation: hide 0.5s 0.3s linear both; }

/*DOWN*/
.flip-clock-wrapper ul.play li.flip-clock-before .down .shadow {
  background: -moz-linear-gradient(top, black 0%%, rgba(0, 0, 0, 0.1) 100%%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%%, black), color-stop(100%%, rgba(0, 0, 0, 0.1)));
  background: linear, top, black 0%%, rgba(0, 0, 0, 0.1) 100%%;
  background: -o-linear-gradient(top, black 0%%, rgba(0, 0, 0, 0.1) 100%%);
  background: -ms-linear-gradient(top, black 0%%, rgba(0, 0, 0, 0.1) 100%%);
  background: linear, to bottom, black 0%%, rgba(0, 0, 0, 0.1) 100%%;
  -webkit-animation: show 0.5s linear both;
  -moz-animation: show 0.5s linear both;
  animation: show 0.5s linear both; }

.flip-clock-wrapper ul.play li.flip-clock-active .down .shadow {
  background: -moz-linear-gradient(top, black 0%%, rgba(0, 0, 0, 0.1) 100%%);
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%%, black), color-stop(100%%, rgba(0, 0, 0, 0.1)));
  background: linear, top, black 0%%, rgba(0, 0, 0, 0.1) 100%%;
  background: -o-linear-gradient(top, black 0%%, rgba(0, 0, 0, 0.1) 100%%);
  background: -ms-linear-gradient(top, black 0%%, rgba(0, 0, 0, 0.1) 100%%);
  background: linear, to bottom, black 0%%, rgba(0, 0, 0, 0.1) 100%%;
  -webkit-animation: hide 0.5s 0.3s linear both;
  -moz-animation: hide 0.5s 0.3s linear both;
  animation: hide 0.5s 0.2s linear both; }

@-webkit-keyframes show {
  0%% {
    opacity: 0; }

  100%% {
    opacity: 1; } }

@-moz-keyframes show {
  0%% {
    opacity: 0; }

  100%% {
    opacity: 1; } }

@-o-keyframes show {
  0%% {
    opacity: 0; }

  100%% {
    opacity: 1; } }

@keyframes show {
  0%% {
    opacity: 0; }

  100%% {
    opacity: 1; } }

@-webkit-keyframes hide {
  0%% {
    opacity: 1; }

  100%% {
    opacity: 0; } }

@-moz-keyframes hide {
  0%% {
    opacity: 1; }

  100%% {
    opacity: 0; } }

@-o-keyframes hide {
  0%% {
    opacity: 1; }

  100%% {
    opacity: 0; } }

@keyframes hide {
  0%% {
    opacity: 1; }

  100%% {
    opacity: 0; } }
"""%(wc,
     fwr,fcm,
     mg,wd,hg,fs,lh,br,
     lh,
     wp,wp,wp,
     fs,ta,ha,blr,blr,blr,fsi,
     wdv,hdv,
     dcw,dcw,dsh,dsh,
     dt,dr,
     dmr,dsr,cdt,cdt))
f.close()
