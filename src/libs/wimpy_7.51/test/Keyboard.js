/*JBEEB::Keyboard 1.0

     __ __                __     
    |__|  |__ _____ _____|  |__ 
    |  |  =  |  =__|  =__|  =  |
   _|  |_____|_____|_____|_____|
  |___/


Copyright (c) 2014 Plaino, LLC.
http://jbeeb.com

MIT License
*/
;this.jbeeb=this.jbeeb||{},function(){"use strict";var e=function(e){this.a(e)},n=e.prototype;n.addEventListener=null,n.removeEventListener=null,n.removeAllEventListeners=null,n.dispatchEvent=null,n.hasEventListener=null,jbeeb.EventDispatcher.initialize(n),e.code={0:48,1:49,2:50,3:51,4:52,5:53,6:54,7:55,8:56,9:57,A:65,B:66,C:67,D:68,E:69,F:70,G:71,H:72,I:73,J:74,K:75,L:76,M:77,N:78,O:79,P:80,Q:81,R:82,S:83,T:84,U:85,V:86,W:87,X:88,Y:89,Z:90,BACKSPACE:8,TAB:9,CLEAR:12,ENTER:13,SHIFT:16,CONTROL:17,ALT:18,CAPS_LOCK:20,ESC:27,SPACEBAR:32,PAGE_UP:33,PAGE_DOWN:34,END:35,HOME:36,ARROW_LEFT:37,ARROW_UP:38,ARROW_RIGHT:39,ARROW_DOWN:40,INSERT:45,DELETE:46,HELP:47,NUM_0:96,NUM_1:97,NUM_2:98,NUM_3:99,NUM_4:100,NUM_5:101,NUM_6:102,NUM_7:103,NUM_8:104,NUM_9:105,NUM_MULTIPLY:106,NUM_ADD:107,NUM_ENTER:108,NUM_SUBTRACT:109,NUM_DECIMAL:110,NUM_DIVIDE:111,F1:112,F2:113,F3:114,F4:115,F5:116,F6:117,F7:118,F8:119,F9:120,F10:121,F11:122,F12:123,F13:124,F14:125,F15:126,NUM_LOCK:144,TILDA:192,SEMI_COLON:186,EQUAL:187,DASH:189,FWD_SLASH:191,BRACKET_LEFT:219,PIPE:220,BRACKET_RIGHT:221,QUOTE:222},n.keycode=null,e.j=null,n.h=null,n.g=null,n.f=null,n.blockAll=!1,n.a=function(n){e.j||(e.j=[]),n=n||window,this.f=n,this.h=this.d.bind(this),this.g=this.b.bind(this),jbeeb.Utils.bindEvent(n,"keydown",this.h),jbeeb.Utils.bindEvent(n,"keyup",this.g)},n.d=function(e){this.blockAll&&this.block(e),this.c(e,"keydown")},n.b=function(e){this.blockAll&&this.block(e),this.c(e,"keyup")},n.c=function(n,t){var i=n.which||n.keyCode,l=e.j.indexOf(i);"keyup"==t?l>-1&&e.j.splice(l,1):l<0&&e.j.push(i),this.dispatchEvent(t,n,i,t),this.keycode=i},n.block=function(e){e.preventDefault&&e.preventDefault(),e.stopPropagation&&e.stopPropagation()},n.isDown=function(n){var t;return t="string"==typeof n?e.j.indexOf(e.code[String(n).toUpperCase()]):e.j.indexOf(n),t>-1?1:0},n.alphaNumeric=function(e){return!!this.numeric(e)||(e>64&&e<91||173==e||189==e)},n.navigate=function(e){return 8==e||13==e||e>36&&e<41||46==e},n.numeric=function(e){if(this.navigate(e))return!0;for(var n=[16,17,18,224],t=n.length;t--;)if(this.isDown(n[t]))return!1;return 109==e||110==e||173==e||189==e||190==e||e>47&&e<58||e>95&&e<106},n.getCode=function(n){return e.code[String(n).toUpperCase()]},n.destroy=function(){jbeeb.Utils.unbindEvent(this.f,"keydown",this.h),jbeeb.Utils.unbindEvent(this.f,"keyup",this.g),this.f=null},n.type="Keyboard",jbeeb.Keyboard=e}();
