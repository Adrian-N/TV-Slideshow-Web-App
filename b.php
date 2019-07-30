<?php
	//Show php errors.
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	//PHP to find and retrieve slides.
	include 'scripts/engine.php';
?>
<html>
	<head>
		<title>TV Slideshow Web App</title>
		<meta content='width=device-width, initial-scale=1.0' name='viewport' />
		
		<!-- JavaScript Slideshow Engine Source: http://www.aaronvanderzwan.com/maximage/-->
		<style type="text/css" media="screen">
		.mc-hide-scrolls{overflow:hidden}body .mc-cycle{height:100%;left:0;overflow:hidden;position:fixed;top:0;width:100%;z-index:-1}div.mc-image{-webkit-transition:opacity 1s ease-in-out;-moz-transition:opacity 1s ease-in-out;-o-transition:opacity 1s ease-in-out;transition:opacity 1s ease-in-out;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;background-position:center center;background-repeat:no-repeat;height:100%;overflow:hidden;width:100%}.mc-old-browser .mc-image{overflow:hidden}
		</style>
	</head>
	<body>
		<div id="maximage">
			<!--Display images fetched by php script.-->
			<?php echo $output ?>
		</div>
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		
		<!-- JavaScript Slideshow Engine Source: http://www.aaronvanderzwan.com/maximage/-->
<script>
(function($,undefined){var ver='2.9998';if($.support==undefined){$.support={opacity:!($.browser.msie)}}
function debug(s){$.fn.cycle.debug&&log(s)}
function log(){window.console&&console.log&&console.log('[cycle] '+Array.prototype.join.call(arguments,' '))}
$.expr[':'].paused=function(el){return el.cyclePause}
$.fn.cycle=function(options,arg2){var o={s:this.selector,c:this.context};if(this.length===0&&options!='stop'){if(!$.isReady&&o.s){log('DOM not ready, queuing slideshow');$(function(){$(o.s,o.c).cycle(options,arg2)});return this}
log('terminating; zero elements found by selector'+($.isReady?'':' (DOM not ready)'));return this}
return this.each(function(){var opts=handleArguments(this,options,arg2);if(opts===!1)
return;opts.updateActivePagerLink=opts.updateActivePagerLink||$.fn.cycle.updateActivePagerLink;if(this.cycleTimeout)
clearTimeout(this.cycleTimeout);this.cycleTimeout=this.cyclePause=0;var $cont=$(this);var $slides=opts.slideExpr?$(opts.slideExpr,this):$cont.children();var els=$slides.get();var opts2=buildOptions($cont,$slides,els,opts,o);if(opts2===!1)
return;if(els.length<2){log('terminating; too few slides: '+els.length);return}
var startTime=opts2.continuous?10:getTimeout(els[opts2.currSlide],els[opts2.nextSlide],opts2,!opts2.backwards);if(startTime){startTime+=(opts2.delay||0);if(startTime<10)
startTime=10;debug('first timeout: '+startTime);this.cycleTimeout=setTimeout(function(){go(els,opts2,0,!opts.backwards)},startTime)}})};function triggerPause(cont,byHover,onPager){var opts=$(cont).data('cycle.opts');var paused=!!cont.cyclePause;if(paused&&opts.paused)
opts.paused(cont,opts,byHover,onPager);else if(!paused&&opts.resumed)
opts.resumed(cont,opts,byHover,onPager)}
function handleArguments(cont,options,arg2){if(cont.cycleStop==undefined)
cont.cycleStop=0;if(options===undefined||options===null)
options={};if(options.constructor==String){switch(options){case 'destroy':case 'stop':var opts=$(cont).data('cycle.opts');if(!opts)
return!1;cont.cycleStop++;if(cont.cycleTimeout)
clearTimeout(cont.cycleTimeout);cont.cycleTimeout=0;opts.elements&&$(opts.elements).stop();$(cont).removeData('cycle.opts');if(options=='destroy')
destroy(opts);return!1;case 'toggle':cont.cyclePause=(cont.cyclePause===1)?0:1;checkInstantResume(cont.cyclePause,arg2,cont);triggerPause(cont);return!1;case 'pause':cont.cyclePause=1;triggerPause(cont);return!1;case 'resume':cont.cyclePause=0;checkInstantResume(!1,arg2,cont);triggerPause(cont);return!1;case 'prev':case 'next':var opts=$(cont).data('cycle.opts');if(!opts){log('options not found, "prev/next" ignored');return!1}
$.fn.cycle[options](opts);return!1;default:options={fx:options}};return options}
else if(options.constructor==Number){var num=options;options=$(cont).data('cycle.opts');if(!options){log('options not found, can not advance slide');return!1}
if(num<0||num>=options.elements.length){log('invalid slide index: '+num);return!1}
options.nextSlide=num;if(cont.cycleTimeout){clearTimeout(cont.cycleTimeout);cont.cycleTimeout=0}
if(typeof arg2=='string')
options.oneTimeFx=arg2;go(options.elements,options,1,num>=options.currSlide);return!1}
return options;function checkInstantResume(isPaused,arg2,cont){if(!isPaused&&arg2===!0){var options=$(cont).data('cycle.opts');if(!options){log('options not found, can not resume');return!1}
if(cont.cycleTimeout){clearTimeout(cont.cycleTimeout);cont.cycleTimeout=0}
go(options.elements,options,1,!options.backwards)}}};function removeFilter(el,opts){if(!$.support.opacity&&opts.cleartype&&el.style.filter){try{el.style.removeAttribute('filter')}
catch(smother){}}};function destroy(opts){if(opts.next)
$(opts.next).unbind(opts.prevNextEvent);if(opts.prev)
$(opts.prev).unbind(opts.prevNextEvent);if(opts.pager||opts.pagerAnchorBuilder)
$.each(opts.pagerAnchors||[],function(){this.unbind().remove()});opts.pagerAnchors=null;if(opts.destroy)
opts.destroy(opts)};function buildOptions($cont,$slides,els,options,o){var startingSlideSpecified;var opts=$.extend({},$.fn.cycle.defaults,options||{},$.metadata?$cont.metadata():$.meta?$cont.data():{});var meta=$.isFunction($cont.data)?$cont.data(opts.metaAttr):null;if(meta)
opts=$.extend(opts,meta);if(opts.autostop)
opts.countdown=opts.autostopCount||els.length;var cont=$cont[0];$cont.data('cycle.opts',opts);opts.$cont=$cont;opts.stopCount=cont.cycleStop;opts.elements=els;opts.before=opts.before?[opts.before]:[];opts.after=opts.after?[opts.after]:[];if(!$.support.opacity&&opts.cleartype)
opts.after.push(function(){removeFilter(this,opts)});if(opts.continuous)
opts.after.push(function(){go(els,opts,0,!opts.backwards)});saveOriginalOpts(opts);if(!$.support.opacity&&opts.cleartype&&!opts.cleartypeNoBg)
clearTypeFix($slides);if($cont.css('position')=='static')
$cont.css('position','relative');if(opts.width)
$cont.width(opts.width);if(opts.height&&opts.height!='auto')
$cont.height(opts.height);if(opts.startingSlide!=undefined){opts.startingSlide=parseInt(opts.startingSlide,10);if(opts.startingSlide>=els.length||opts.startSlide<0)
opts.startingSlide=0;else startingSlideSpecified=!0}
else if(opts.backwards)
opts.startingSlide=els.length-1;else opts.startingSlide=0;if(opts.random){opts.randomMap=[];for(var i=0;i<els.length;i++)
opts.randomMap.push(i);opts.randomMap.sort(function(a,b){return Math.random()-0.5});if(startingSlideSpecified){for(var cnt=0;cnt<els.length;cnt++){if(opts.startingSlide==opts.randomMap[cnt]){opts.randomIndex=cnt}}}
else{opts.randomIndex=1;opts.startingSlide=opts.randomMap[1]}}
else if(opts.startingSlide>=els.length)
opts.startingSlide=0;opts.currSlide=opts.startingSlide||0;var first=opts.startingSlide;$slides.css({position:'absolute',top:0,left:0}).hide().each(function(i){var z;if(opts.backwards)
z=first?i<=first?els.length+(i-first):first-i:els.length-i;else z=first?i>=first?els.length-(i-first):first-i:els.length-i;$(this).css('z-index',z)});$(els[first]).css('opacity',1).show();removeFilter(els[first],opts);if(opts.fit){if(!opts.aspect){if(opts.width)
$slides.width(opts.width);if(opts.height&&opts.height!='auto')
$slides.height(opts.height)}else{$slides.each(function(){var $slide=$(this);var ratio=(opts.aspect===!0)?$slide.width()/$slide.height():opts.aspect;if(opts.width&&$slide.width()!=opts.width){$slide.width(opts.width);$slide.height(opts.width/ratio)}
if(opts.height&&$slide.height()<opts.height){$slide.height(opts.height);$slide.width(opts.height*ratio)}})}}
if(opts.center&&((!opts.fit)||opts.aspect)){$slides.each(function(){var $slide=$(this);$slide.css({"margin-left":opts.width?((opts.width-$slide.width())/2)+"px":0,"margin-top":opts.height?((opts.height-$slide.height())/2)+"px":0})})}
if(opts.center&&!opts.fit&&!opts.slideResize){$slides.each(function(){var $slide=$(this);$slide.css({"margin-left":opts.width?((opts.width-$slide.width())/2)+"px":0,"margin-top":opts.height?((opts.height-$slide.height())/2)+"px":0})})}
var reshape=opts.containerResize&&!$cont.innerHeight();if(reshape){var maxw=0,maxh=0;for(var j=0;j<els.length;j++){var $e=$(els[j]),e=$e[0],w=$e.outerWidth(),h=$e.outerHeight();if(!w)w=e.offsetWidth||e.width||$e.attr('width');if(!h)h=e.offsetHeight||e.height||$e.attr('height');maxw=w>maxw?w:maxw;maxh=h>maxh?h:maxh}
if(maxw>0&&maxh>0)
$cont.css({width:maxw+'px',height:maxh+'px'})}
var pauseFlag=!1;if(opts.pause)
$cont.hover(function(){pauseFlag=!0;this.cyclePause++;triggerPause(cont,!0)},function(){pauseFlag&&this.cyclePause--;triggerPause(cont,!0)});if(supportMultiTransitions(opts)===!1)
return!1;var requeue=!1;options.requeueAttempts=options.requeueAttempts||0;$slides.each(function(){var $el=$(this);this.cycleH=(opts.fit&&opts.height)?opts.height:($el.height()||this.offsetHeight||this.height||$el.attr('height')||0);this.cycleW=(opts.fit&&opts.width)?opts.width:($el.width()||this.offsetWidth||this.width||$el.attr('width')||0);if($el.is('img')){var loadingIE=($.browser.msie&&this.cycleW==28&&this.cycleH==30&&!this.complete);var loadingFF=($.browser.mozilla&&this.cycleW==34&&this.cycleH==19&&!this.complete);var loadingOp=($.browser.opera&&((this.cycleW==42&&this.cycleH==19)||(this.cycleW==37&&this.cycleH==17))&&!this.complete);var loadingOther=(this.cycleH==0&&this.cycleW==0&&!this.complete);if(loadingIE||loadingFF||loadingOp||loadingOther){if(o.s&&opts.requeueOnImageNotLoaded&&++options.requeueAttempts<100){log(options.requeueAttempts,' - img slide not loaded, requeuing slideshow: ',this.src,this.cycleW,this.cycleH);setTimeout(function(){$(o.s,o.c).cycle(options)},opts.requeueTimeout);requeue=!0;return!1}
else{log('could not determine size of image: '+this.src,this.cycleW,this.cycleH)}}}
return!0});if(requeue)
return!1;opts.cssBefore=opts.cssBefore||{};opts.cssAfter=opts.cssAfter||{};opts.cssFirst=opts.cssFirst||{};opts.animIn=opts.animIn||{};opts.animOut=opts.animOut||{};$slides.not(':eq('+first+')').css(opts.cssBefore);$($slides[first]).css(opts.cssFirst);if(opts.timeout){opts.timeout=parseInt(opts.timeout,10);if(opts.speed.constructor==String)
opts.speed=$.fx.speeds[opts.speed]||parseInt(opts.speed,10);if(!opts.sync)
opts.speed=opts.speed/2;var buffer=opts.fx=='none'?0:opts.fx=='shuffle'?500:250;while((opts.timeout-opts.speed)<buffer)
opts.timeout+=opts.speed}
if(opts.easing)
opts.easeIn=opts.easeOut=opts.easing;if(!opts.speedIn)
opts.speedIn=opts.speed;if(!opts.speedOut)
opts.speedOut=opts.speed;opts.slideCount=els.length;opts.currSlide=opts.lastSlide=first;if(opts.random){if(++opts.randomIndex==els.length)
opts.randomIndex=0;opts.nextSlide=opts.randomMap[opts.randomIndex]}
else if(opts.backwards)
opts.nextSlide=opts.startingSlide==0?(els.length-1):opts.startingSlide-1;else opts.nextSlide=opts.startingSlide>=(els.length-1)?0:opts.startingSlide+1;if(!opts.multiFx){var init=$.fn.cycle.transitions[opts.fx];if($.isFunction(init))
init($cont,$slides,opts);else if(opts.fx!='custom'&&!opts.multiFx){log('unknown transition: '+opts.fx,'; slideshow terminating');return!1}}
var e0=$slides[first];if(!opts.skipInitializationCallbacks){if(opts.before.length)
opts.before[0].apply(e0,[e0,e0,opts,!0]);if(opts.after.length)
opts.after[0].apply(e0,[e0,e0,opts,!0])}
if(opts.next)
$(opts.next).bind(opts.prevNextEvent,function(){return advance(opts,1)});if(opts.prev)
$(opts.prev).bind(opts.prevNextEvent,function(){return advance(opts,0)});if(opts.pager||opts.pagerAnchorBuilder)
buildPager(els,opts);exposeAddSlide(opts,els);return opts};function saveOriginalOpts(opts){opts.original={before:[],after:[]};opts.original.cssBefore=$.extend({},opts.cssBefore);opts.original.cssAfter=$.extend({},opts.cssAfter);opts.original.animIn=$.extend({},opts.animIn);opts.original.animOut=$.extend({},opts.animOut);$.each(opts.before,function(){opts.original.before.push(this)});$.each(opts.after,function(){opts.original.after.push(this)})};function supportMultiTransitions(opts){var i,tx,txs=$.fn.cycle.transitions;if(opts.fx.indexOf(',')>0){opts.multiFx=!0;opts.fxs=opts.fx.replace(/\s*/g,'').split(',');for(i=0;i<opts.fxs.length;i++){var fx=opts.fxs[i];tx=txs[fx];if(!tx||!txs.hasOwnProperty(fx)||!$.isFunction(tx)){log('discarding unknown transition: ',fx);opts.fxs.splice(i,1);i--}}
if(!opts.fxs.length){log('No valid transitions named; slideshow terminating.');return!1}}
else if(opts.fx=='all'){opts.multiFx=!0;opts.fxs=[];for(p in txs){tx=txs[p];if(txs.hasOwnProperty(p)&&$.isFunction(tx))
opts.fxs.push(p)}}
if(opts.multiFx&&opts.randomizeEffects){var r1=Math.floor(Math.random()*20)+30;for(i=0;i<r1;i++){var r2=Math.floor(Math.random()*opts.fxs.length);opts.fxs.push(opts.fxs.splice(r2,1)[0])}
debug('randomized fx sequence: ',opts.fxs)}
return!0};function exposeAddSlide(opts,els){opts.addSlide=function(newSlide,prepend){var $s=$(newSlide),s=$s[0];if(!opts.autostopCount)
opts.countdown++;els[prepend?'unshift':'push'](s);if(opts.els)
opts.els[prepend?'unshift':'push'](s);opts.slideCount=els.length;if(opts.random){opts.randomMap.push(opts.slideCount-1);opts.randomMap.sort(function(a,b){return Math.random()-0.5})}
$s.css('position','absolute');$s[prepend?'prependTo':'appendTo'](opts.$cont);if(prepend){opts.currSlide++;opts.nextSlide++}
if(!$.support.opacity&&opts.cleartype&&!opts.cleartypeNoBg)
clearTypeFix($s);if(opts.fit&&opts.width)
$s.width(opts.width);if(opts.fit&&opts.height&&opts.height!='auto')
$s.height(opts.height);s.cycleH=(opts.fit&&opts.height)?opts.height:$s.height();s.cycleW=(opts.fit&&opts.width)?opts.width:$s.width();$s.css(opts.cssBefore);if(opts.pager||opts.pagerAnchorBuilder)
$.fn.cycle.createPagerAnchor(els.length-1,s,$(opts.pager),els,opts);if($.isFunction(opts.onAddSlide))
opts.onAddSlide($s);else $s.hide()}}
$.fn.cycle.resetState=function(opts,fx){fx=fx||opts.fx;opts.before=[];opts.after=[];opts.cssBefore=$.extend({},opts.original.cssBefore);opts.cssAfter=$.extend({},opts.original.cssAfter);opts.animIn=$.extend({},opts.original.animIn);opts.animOut=$.extend({},opts.original.animOut);opts.fxFn=null;$.each(opts.original.before,function(){opts.before.push(this)});$.each(opts.original.after,function(){opts.after.push(this)});var init=$.fn.cycle.transitions[fx];if($.isFunction(init))
init(opts.$cont,$(opts.elements),opts)};function go(els,opts,manual,fwd){if(manual&&opts.busy&&opts.manualTrump){debug('manualTrump in go(), stopping active transition');$(els).stop(!0,!0);opts.busy=0}
if(opts.busy){debug('transition active, ignoring new tx request');return}
var p=opts.$cont[0],curr=els[opts.currSlide],next=els[opts.nextSlide];if(p.cycleStop!=opts.stopCount||p.cycleTimeout===0&&!manual)
return;if(!manual&&!p.cyclePause&&!opts.bounce&&((opts.autostop&&(--opts.countdown<=0))||(opts.nowrap&&!opts.random&&opts.nextSlide<opts.currSlide))){if(opts.end)
opts.end(opts);return}
var changed=!1;if((manual||!p.cyclePause)&&(opts.nextSlide!=opts.currSlide)){changed=!0;var fx=opts.fx;curr.cycleH=curr.cycleH||$(curr).height();curr.cycleW=curr.cycleW||$(curr).width();next.cycleH=next.cycleH||$(next).height();next.cycleW=next.cycleW||$(next).width();if(opts.multiFx){if(fwd&&(opts.lastFx==undefined||++opts.lastFx>=opts.fxs.length))
opts.lastFx=0;else if(!fwd&&(opts.lastFx==undefined||--opts.lastFx<0))
opts.lastFx=opts.fxs.length-1;fx=opts.fxs[opts.lastFx]}
if(opts.oneTimeFx){fx=opts.oneTimeFx;opts.oneTimeFx=null}
$.fn.cycle.resetState(opts,fx);if(opts.before.length)
$.each(opts.before,function(i,o){if(p.cycleStop!=opts.stopCount)return;o.apply(next,[curr,next,opts,fwd])});var after=function(){opts.busy=0;$.each(opts.after,function(i,o){if(p.cycleStop!=opts.stopCount)return;o.apply(next,[curr,next,opts,fwd])});if(!p.cycleStop){queueNext()}};debug('tx firing('+fx+'); currSlide: '+opts.currSlide+'; nextSlide: '+opts.nextSlide);opts.busy=1;if(opts.fxFn)
opts.fxFn(curr,next,opts,after,fwd,manual&&opts.fastOnEvent);else if($.isFunction($.fn.cycle[opts.fx]))
$.fn.cycle[opts.fx](curr,next,opts,after,fwd,manual&&opts.fastOnEvent);else $.fn.cycle.custom(curr,next,opts,after,fwd,manual&&opts.fastOnEvent)}
else{queueNext()}
if(changed||opts.nextSlide==opts.currSlide){opts.lastSlide=opts.currSlide;if(opts.random){opts.currSlide=opts.nextSlide;if(++opts.randomIndex==els.length){opts.randomIndex=0;opts.randomMap.sort(function(a,b){return Math.random()-0.5})}
opts.nextSlide=opts.randomMap[opts.randomIndex];if(opts.nextSlide==opts.currSlide)
opts.nextSlide=(opts.currSlide==opts.slideCount-1)?0:opts.currSlide+1}
else if(opts.backwards){var roll=(opts.nextSlide-1)<0;if(roll&&opts.bounce){opts.backwards=!opts.backwards;opts.nextSlide=1;opts.currSlide=0}
else{opts.nextSlide=roll?(els.length-1):opts.nextSlide-1;opts.currSlide=roll?0:opts.nextSlide+1}}
else{var roll=(opts.nextSlide+1)==els.length;if(roll&&opts.bounce){opts.backwards=!opts.backwards;opts.nextSlide=els.length-2;opts.currSlide=els.length-1}
else{opts.nextSlide=roll?0:opts.nextSlide+1;opts.currSlide=roll?els.length-1:opts.nextSlide-1}}}
if(changed&&opts.pager)
opts.updateActivePagerLink(opts.pager,opts.currSlide,opts.activePagerClass);function queueNext(){var ms=0,timeout=opts.timeout;if(opts.timeout&&!opts.continuous){ms=getTimeout(els[opts.currSlide],els[opts.nextSlide],opts,fwd);if(opts.fx=='shuffle')
ms-=opts.speedOut}
else if(opts.continuous&&p.cyclePause)
ms=10;if(ms>0)
p.cycleTimeout=setTimeout(function(){go(els,opts,0,!opts.backwards)},ms)}};$.fn.cycle.updateActivePagerLink=function(pager,currSlide,clsName){$(pager).each(function(){$(this).children().removeClass(clsName).eq(currSlide).addClass(clsName)})};function getTimeout(curr,next,opts,fwd){if(opts.timeoutFn){var t=opts.timeoutFn.call(curr,curr,next,opts,fwd);while(opts.fx!='none'&&(t-opts.speed)<250)
t+=opts.speed;debug('calculated timeout: '+t+'; speed: '+opts.speed);if(t!==!1)
return t}
return opts.timeout};$.fn.cycle.next=function(opts){advance(opts,1)};$.fn.cycle.prev=function(opts){advance(opts,0)};function advance(opts,moveForward){var val=moveForward?1:-1;var els=opts.elements;var p=opts.$cont[0],timeout=p.cycleTimeout;if(timeout){clearTimeout(timeout);p.cycleTimeout=0}
if(opts.random&&val<0){opts.randomIndex--;if(--opts.randomIndex==-2)
opts.randomIndex=els.length-2;else if(opts.randomIndex==-1)
opts.randomIndex=els.length-1;opts.nextSlide=opts.randomMap[opts.randomIndex]}
else if(opts.random){opts.nextSlide=opts.randomMap[opts.randomIndex]}
else{opts.nextSlide=opts.currSlide+val;if(opts.nextSlide<0){if(opts.nowrap)return!1;opts.nextSlide=els.length-1}
else if(opts.nextSlide>=els.length){if(opts.nowrap)return!1;opts.nextSlide=0}}
var cb=opts.onPrevNextEvent||opts.prevNextClick;if($.isFunction(cb))
cb(val>0,opts.nextSlide,els[opts.nextSlide]);go(els,opts,1,moveForward);return!1};function buildPager(els,opts){var $p=$(opts.pager);$.each(els,function(i,o){$.fn.cycle.createPagerAnchor(i,o,$p,els,opts)});opts.updateActivePagerLink(opts.pager,opts.startingSlide,opts.activePagerClass)};$.fn.cycle.createPagerAnchor=function(i,el,$p,els,opts){var a;if($.isFunction(opts.pagerAnchorBuilder)){a=opts.pagerAnchorBuilder(i,el);debug('pagerAnchorBuilder('+i+', el) returned: '+a)}
else a='<a href="#">'+(i+1)+'</a>';if(!a)
return;var $a=$(a);if($a.parents('body').length===0){var arr=[];if($p.length>1){$p.each(function(){var $clone=$a.clone(!0);$(this).append($clone);arr.push($clone[0])});$a=$(arr)}
else{$a.appendTo($p)}}
opts.pagerAnchors=opts.pagerAnchors||[];opts.pagerAnchors.push($a);var pagerFn=function(e){e.preventDefault();opts.nextSlide=i;var p=opts.$cont[0],timeout=p.cycleTimeout;if(timeout){clearTimeout(timeout);p.cycleTimeout=0}
var cb=opts.onPagerEvent||opts.pagerClick;if($.isFunction(cb))
cb(opts.nextSlide,els[opts.nextSlide]);go(els,opts,1,opts.currSlide<i)}
if(/mouseenter|mouseover/i.test(opts.pagerEvent)){$a.hover(pagerFn,function(){})}
else{$a.bind(opts.pagerEvent,pagerFn)}
if(!/^click/.test(opts.pagerEvent)&&!opts.allowPagerClickBubble)
$a.bind('click.cycle',function(){return!1});var cont=opts.$cont[0];var pauseFlag=!1;if(opts.pauseOnPagerHover){$a.hover(function(){pauseFlag=!0;cont.cyclePause++;triggerPause(cont,!0,!0)},function(){pauseFlag&&cont.cyclePause--;triggerPause(cont,!0,!0)})}};$.fn.cycle.hopsFromLast=function(opts,fwd){var hops,l=opts.lastSlide,c=opts.currSlide;if(fwd)
hops=c>l?c-l:opts.slideCount-l;else hops=c<l?l-c:l+opts.slideCount-c;return hops};function clearTypeFix($slides){debug('applying clearType background-color hack');function hex(s){s=parseInt(s,10).toString(16);return s.length<2?'0'+s:s};function getBg(e){for(;e&&e.nodeName.toLowerCase()!='html';e=e.parentNode){var v=$.css(e,'background-color');if(v&&v.indexOf('rgb')>=0){var rgb=v.match(/\d+/g);return'#'+hex(rgb[0])+hex(rgb[1])+hex(rgb[2])}
if(v&&v!='transparent')
return v}
return'#ffffff'};$slides.each(function(){$(this).css('background-color',getBg(this))})};$.fn.cycle.commonReset=function(curr,next,opts,w,h,rev){$(opts.elements).not(curr).hide();if(typeof opts.cssBefore.opacity=='undefined')
opts.cssBefore.opacity=1;opts.cssBefore.display='block';if(opts.slideResize&&w!==!1&&next.cycleW>0)
opts.cssBefore.width=next.cycleW;if(opts.slideResize&&h!==!1&&next.cycleH>0)
opts.cssBefore.height=next.cycleH;opts.cssAfter=opts.cssAfter||{};opts.cssAfter.display='none';$(curr).css('zIndex',opts.slideCount+(rev===!0?1:0));$(next).css('zIndex',opts.slideCount+(rev===!0?0:1))};$.fn.cycle.custom=function(curr,next,opts,cb,fwd,speedOverride){var $l=$(curr),$n=$(next);var speedIn=opts.speedIn,speedOut=opts.speedOut,easeIn=opts.easeIn,easeOut=opts.easeOut;$n.css(opts.cssBefore);if(speedOverride){if(typeof speedOverride=='number')
speedIn=speedOut=speedOverride;else speedIn=speedOut=1;easeIn=easeOut=null}
var fn=function(){$n.animate(opts.animIn,speedIn,easeIn,function(){cb()})};$l.animate(opts.animOut,speedOut,easeOut,function(){$l.css(opts.cssAfter);if(!opts.sync)
fn()});if(opts.sync)fn()};$.fn.cycle.transitions={fade:function($cont,$slides,opts){$slides.not(':eq('+opts.currSlide+')').css('opacity',0);opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts);opts.cssBefore.opacity=0});opts.animIn={opacity:1};opts.animOut={opacity:0};opts.cssBefore={top:0,left:0}}};$.fn.cycle.ver=function(){return ver}

// override these globally if you like (they are all optional)
$.fn.cycle.defaults = {
	activePagerClass: 'activeSlide', // class name used for the active pager link
	after:		   null,  // transition callback (scope set to element that was shown):  function(currSlideElement, nextSlideElement, options, forwardFlag)
	allowPagerClickBubble: false, // allows or prevents click event on pager anchors from bubbling
	animIn:		   null,  // properties that define how the slide animates in
	animOut:	   null,  // properties that define how the slide animates out
	aspect:		   false,  // preserve aspect ratio during fit resizing, cropping if necessary (must be used with fit option)
	autostop:	   0,	  // true to end slideshow after X transitions (where X == slide count)
	autostopCount: 0,	  // number of transitions (optionally used with autostop to define X)
	backwards:     false, // true to start slideshow at last slide and move backwards through the stack
	before:		   null,  // transition callback (scope set to element to be shown):	 function(currSlideElement, nextSlideElement, options, forwardFlag)
	center: 	   null,  // set to true to have cycle add top/left margin to each slide (use with width and height options)
	cleartype:	   !$.support.opacity,  // true if clearType corrections should be applied (for IE)
	cleartypeNoBg: false, // set to true to disable extra cleartype fixing (leave false to force background color setting on slides)
	containerResize: 1,	  // resize container to fit largest slide
	continuous:	   0,	  // true to start next transition immediately after current one completes
	cssAfter:	   null,  // properties that defined the state of the slide after transitioning out
	cssBefore:	   null,  // properties that define the initial state of the slide before transitioning in
	delay:		   0,	  // additional delay (in ms) for first transition (hint: can be negative)
	easeIn:		   null,  // easing for "in" transition
	easeOut:	   null,  // easing for "out" transition
	easing:		   null,  // easing method for both in and out transitions
	end:		   null,  // callback invoked when the slideshow terminates (use with autostop or nowrap options): function(options)
	fastOnEvent:   0,	  // force fast transitions when triggered manually (via pager or prev/next); value == time in ms
	fit:		   0,	  // force slides to fit container
	fx:			  'fade', // name of transition effect (or comma separated names, ex: 'fade,scrollUp,shuffle')
	fxFn:		   null,  // function used to control the transition: function(currSlideElement, nextSlideElement, options, afterCalback, forwardFlag)
	height:		  'auto', // container height (if the 'fit' option is true, the slides will be set to this height as well)
	manualTrump:   true,  // causes manual transition to stop an active transition instead of being ignored
	metaAttr:     'cycle',// data- attribute that holds the option data for the slideshow
	next:		   null,  // element, jQuery object, or jQuery selector string for the element to use as event trigger for next slide
	nowrap:		   0,	  // true to prevent slideshow from wrapping
	onPagerEvent:  null,  // callback fn for pager events: function(zeroBasedSlideIndex, slideElement)
	onPrevNextEvent: null,// callback fn for prev/next events: function(isNext, zeroBasedSlideIndex, slideElement)
	pager:		   null,  // element, jQuery object, or jQuery selector string for the element to use as pager container
	pagerAnchorBuilder: null, // callback fn for building anchor links:  function(index, DOMelement)
	pagerEvent:	  'click.cycle', // name of event which drives the pager navigation
	pause:		   0,	  // true to enable "pause on hover"
	pauseOnPagerHover: 0, // true to pause when hovering over pager link
	prev:		   null,  // element, jQuery object, or jQuery selector string for the element to use as event trigger for previous slide
	prevNextEvent:'click.cycle',// event which drives the manual transition to the previous or next slide
	random:		   0,	  // true for random, false for sequence (not applicable to shuffle fx)
	randomizeEffects: 1,  // valid when multiple effects are used; true to make the effect sequence random
	requeueOnImageNotLoaded: true, // requeue the slideshow if any image slides are not yet loaded
	requeueTimeout: 250,  // ms delay for requeue
	rev:		   0,	  // causes animations to transition in reverse (for effects that support it such as scrollHorz/scrollVert/shuffle)
	shuffle:	   null,  // coords for shuffle animation, ex: { top:15, left: 200 }
	skipInitializationCallbacks: false, // set to true to disable the first before/after callback that occurs prior to any transition
	slideExpr:	   null,  // expression for selecting slides (if something other than all children is required)
	slideResize:   1,     // force slide width/height to fixed size before every transition
	speed:		   <?php echo $speed;?>,  // speed of the transition (any valid fx speed value)
	speedIn:	   null,  // speed of the 'in' transition
	speedOut:	   null,  // speed of the 'out' transition
	startingSlide: 0,	  // zero-based index of the first slide to be displayed
	sync:		   1,	  // true if in/out transitions should occur simultaneously
	timeout:	   <?php echo $time;?>,  // milliseconds between slide transitions (0 to disable auto advance)
	timeoutFn:     null,  // callback for determining per-slide timeout value:  function(currSlideElement, nextSlideElement, options, forwardFlag)
	updateActivePagerLink: null, // callback fn invoked to update the active pager link (adds/removes activePagerClass style)
	width:         null   // container width (if the 'fit' option is true, the slides will be set to this width as well)
};

})(jQuery);

(function($){$.fn.cycle.transitions.none=function($cont,$slides,opts){opts.fxFn=function(curr,next,opts,after){$(next).show();$(curr).hide();after()}};$.fn.cycle.transitions.fadeout=function($cont,$slides,opts){$slides.not(':eq('+opts.currSlide+')').css({display:'block','opacity':1});opts.before.push(function(curr,next,opts,w,h,rev){$(curr).css('zIndex',opts.slideCount+(!rev===!0?1:0));$(next).css('zIndex',opts.slideCount+(!rev===!0?0:1))});opts.animIn.opacity=1;opts.animOut.opacity=0;opts.cssBefore.opacity=1;opts.cssBefore.display='block';opts.cssAfter.zIndex=0};$.fn.cycle.transitions.scrollUp=function($cont,$slides,opts){$cont.css('overflow','hidden');opts.before.push($.fn.cycle.commonReset);var h=$cont.height();opts.cssBefore.top=h;opts.cssBefore.left=0;opts.cssFirst.top=0;opts.animIn.top=0;opts.animOut.top=-h};$.fn.cycle.transitions.scrollDown=function($cont,$slides,opts){$cont.css('overflow','hidden');opts.before.push($.fn.cycle.commonReset);var h=$cont.height();opts.cssFirst.top=0;opts.cssBefore.top=-h;opts.cssBefore.left=0;opts.animIn.top=0;opts.animOut.top=h};$.fn.cycle.transitions.scrollLeft=function($cont,$slides,opts){$cont.css('overflow','hidden');opts.before.push($.fn.cycle.commonReset);var w=$cont.width();opts.cssFirst.left=0;opts.cssBefore.left=w;opts.cssBefore.top=0;opts.animIn.left=0;opts.animOut.left=0-w};$.fn.cycle.transitions.scrollRight=function($cont,$slides,opts){$cont.css('overflow','hidden');opts.before.push($.fn.cycle.commonReset);var w=$cont.width();opts.cssFirst.left=0;opts.cssBefore.left=-w;opts.cssBefore.top=0;opts.animIn.left=0;opts.animOut.left=w};$.fn.cycle.transitions.scrollHorz=function($cont,$slides,opts){$cont.css('overflow','hidden').width();opts.before.push(function(curr,next,opts,fwd){if(opts.rev)
fwd=!fwd;$.fn.cycle.commonReset(curr,next,opts);opts.cssBefore.left=fwd?(next.cycleW-1):(1-next.cycleW);opts.animOut.left=fwd?-curr.cycleW:curr.cycleW});opts.cssFirst.left=0;opts.cssBefore.top=0;opts.animIn.left=0;opts.animOut.top=0};$.fn.cycle.transitions.scrollVert=function($cont,$slides,opts){$cont.css('overflow','hidden');opts.before.push(function(curr,next,opts,fwd){if(opts.rev)
fwd=!fwd;$.fn.cycle.commonReset(curr,next,opts);opts.cssBefore.top=fwd?(1-next.cycleH):(next.cycleH-1);opts.animOut.top=fwd?curr.cycleH:-curr.cycleH});opts.cssFirst.top=0;opts.cssBefore.left=0;opts.animIn.top=0;opts.animOut.left=0};$.fn.cycle.transitions.slideX=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$(opts.elements).not(curr).hide();$.fn.cycle.commonReset(curr,next,opts,!1,!0);opts.animIn.width=next.cycleW});opts.cssBefore.left=0;opts.cssBefore.top=0;opts.cssBefore.width=0;opts.animIn.width='show';opts.animOut.width=0};$.fn.cycle.transitions.slideY=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$(opts.elements).not(curr).hide();$.fn.cycle.commonReset(curr,next,opts,!0,!1);opts.animIn.height=next.cycleH});opts.cssBefore.left=0;opts.cssBefore.top=0;opts.cssBefore.height=0;opts.animIn.height='show';opts.animOut.height=0};$.fn.cycle.transitions.shuffle=function($cont,$slides,opts){var i,w=$cont.css('overflow','visible').width();$slides.css({left:0,top:0});opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!0,!0,!0)});if(!opts.speedAdjusted){opts.speed=opts.speed/2;opts.speedAdjusted=!0}
opts.random=0;opts.shuffle=opts.shuffle||{left:-w,top:15};opts.els=[];for(i=0;i<$slides.length;i++)
opts.els.push($slides[i]);for(i=0;i<opts.currSlide;i++)
opts.els.push(opts.els.shift());opts.fxFn=function(curr,next,opts,cb,fwd){if(opts.rev)
fwd=!fwd;var $el=fwd?$(curr):$(next);$(next).css(opts.cssBefore);var count=opts.slideCount;$el.animate(opts.shuffle,opts.speedIn,opts.easeIn,function(){var hops=$.fn.cycle.hopsFromLast(opts,fwd);for(var k=0;k<hops;k++)
fwd?opts.els.push(opts.els.shift()):opts.els.unshift(opts.els.pop());if(fwd){for(var i=0,len=opts.els.length;i<len;i++)
$(opts.els[i]).css('z-index',len-i+count);}
else{var z=$(curr).css('z-index');$el.css('z-index',parseInt(z,10)+1+count)}
$el.animate({left:0,top:0},opts.speedOut,opts.easeOut,function(){$(fwd?this:curr).hide();if(cb)cb()})})};$.extend(opts.cssBefore,{display:'block',opacity:1,top:0,left:0})};$.fn.cycle.transitions.turnUp=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!0,!1);opts.cssBefore.top=next.cycleH;opts.animIn.height=next.cycleH;opts.animOut.width=next.cycleW});opts.cssFirst.top=0;opts.cssBefore.left=0;opts.cssBefore.height=0;opts.animIn.top=0;opts.animOut.height=0};$.fn.cycle.transitions.turnDown=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!0,!1);opts.animIn.height=next.cycleH;opts.animOut.top=curr.cycleH});opts.cssFirst.top=0;opts.cssBefore.left=0;opts.cssBefore.top=0;opts.cssBefore.height=0;opts.animOut.height=0};$.fn.cycle.transitions.turnLeft=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!1,!0);opts.cssBefore.left=next.cycleW;opts.animIn.width=next.cycleW});opts.cssBefore.top=0;opts.cssBefore.width=0;opts.animIn.left=0;opts.animOut.width=0};$.fn.cycle.transitions.turnRight=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!1,!0);opts.animIn.width=next.cycleW;opts.animOut.left=curr.cycleW});$.extend(opts.cssBefore,{top:0,left:0,width:0});opts.animIn.left=0;opts.animOut.width=0};$.fn.cycle.transitions.zoom=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!1,!1,!0);opts.cssBefore.top=next.cycleH/2;opts.cssBefore.left=next.cycleW/2;$.extend(opts.animIn,{top:0,left:0,width:next.cycleW,height:next.cycleH});$.extend(opts.animOut,{width:0,height:0,top:curr.cycleH/2,left:curr.cycleW/2})});opts.cssFirst.top=0;opts.cssFirst.left=0;opts.cssBefore.width=0;opts.cssBefore.height=0};$.fn.cycle.transitions.fadeZoom=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!1,!1);opts.cssBefore.left=next.cycleW/2;opts.cssBefore.top=next.cycleH/2;$.extend(opts.animIn,{top:0,left:0,width:next.cycleW,height:next.cycleH})});opts.cssBefore.width=0;opts.cssBefore.height=0;opts.animOut.opacity=0};$.fn.cycle.transitions.blindX=function($cont,$slides,opts){var w=$cont.css('overflow','hidden').width();opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts);opts.animIn.width=next.cycleW;opts.animOut.left=curr.cycleW});opts.cssBefore.left=w;opts.cssBefore.top=0;opts.animIn.left=0;opts.animOut.left=w};$.fn.cycle.transitions.blindY=function($cont,$slides,opts){var h=$cont.css('overflow','hidden').height();opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts);opts.animIn.height=next.cycleH;opts.animOut.top=curr.cycleH});opts.cssBefore.top=h;opts.cssBefore.left=0;opts.animIn.top=0;opts.animOut.top=h};$.fn.cycle.transitions.blindZ=function($cont,$slides,opts){var h=$cont.css('overflow','hidden').height();var w=$cont.width();opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts);opts.animIn.height=next.cycleH;opts.animOut.top=curr.cycleH});opts.cssBefore.top=h;opts.cssBefore.left=w;opts.animIn.top=0;opts.animIn.left=0;opts.animOut.top=h;opts.animOut.left=w};$.fn.cycle.transitions.growX=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!1,!0);opts.cssBefore.left=this.cycleW/2;opts.animIn.left=0;opts.animIn.width=this.cycleW;opts.animOut.left=0});opts.cssBefore.top=0;opts.cssBefore.width=0};$.fn.cycle.transitions.growY=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!0,!1);opts.cssBefore.top=this.cycleH/2;opts.animIn.top=0;opts.animIn.height=this.cycleH;opts.animOut.top=0});opts.cssBefore.height=0;opts.cssBefore.left=0};$.fn.cycle.transitions.curtainX=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!1,!0,!0);opts.cssBefore.left=next.cycleW/2;opts.animIn.left=0;opts.animIn.width=this.cycleW;opts.animOut.left=curr.cycleW/2;opts.animOut.width=0});opts.cssBefore.top=0;opts.cssBefore.width=0};$.fn.cycle.transitions.curtainY=function($cont,$slides,opts){opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!0,!1,!0);opts.cssBefore.top=next.cycleH/2;opts.animIn.top=0;opts.animIn.height=next.cycleH;opts.animOut.top=curr.cycleH/2;opts.animOut.height=0});opts.cssBefore.height=0;opts.cssBefore.left=0};$.fn.cycle.transitions.cover=function($cont,$slides,opts){var d=opts.direction||'left';var w=$cont.css('overflow','hidden').width();var h=$cont.height();opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts);if(d=='right')
opts.cssBefore.left=-w;else if(d=='up')
opts.cssBefore.top=h;else if(d=='down')
opts.cssBefore.top=-h;else opts.cssBefore.left=w});opts.animIn.left=0;opts.animIn.top=0;opts.cssBefore.top=0;opts.cssBefore.left=0};$.fn.cycle.transitions.uncover=function($cont,$slides,opts){var d=opts.direction||'left';var w=$cont.css('overflow','hidden').width();var h=$cont.height();opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!0,!0,!0);if(d=='right')
opts.animOut.left=w;else if(d=='up')
opts.animOut.top=-h;else if(d=='down')
opts.animOut.top=h;else opts.animOut.left=-w});opts.animIn.left=0;opts.animIn.top=0;opts.cssBefore.top=0;opts.cssBefore.left=0};$.fn.cycle.transitions.toss=function($cont,$slides,opts){var w=$cont.css('overflow','visible').width();var h=$cont.height();opts.before.push(function(curr,next,opts){$.fn.cycle.commonReset(curr,next,opts,!0,!0,!0);if(!opts.animOut.left&&!opts.animOut.top)
$.extend(opts.animOut,{left:w*2,top:-h/2,opacity:0});else opts.animOut.opacity=0});opts.cssBefore.left=0;opts.cssBefore.top=0;opts.animIn.left=0};$.fn.cycle.transitions.wipe=function($cont,$slides,opts){var w=$cont.css('overflow','hidden').width();var h=$cont.height();opts.cssBefore=opts.cssBefore||{};var clip;if(opts.clip){if(/l2r/.test(opts.clip))
clip='rect(0px 0px '+h+'px 0px)';else if(/r2l/.test(opts.clip))
clip='rect(0px '+w+'px '+h+'px '+w+'px)';else if(/t2b/.test(opts.clip))
clip='rect(0px '+w+'px 0px 0px)';else if(/b2t/.test(opts.clip))
clip='rect('+h+'px '+w+'px '+h+'px 0px)';else if(/zoom/.test(opts.clip)){var top=parseInt(h/2,10);var left=parseInt(w/2,10);clip='rect('+top+'px '+left+'px '+top+'px '+left+'px)'}}
opts.cssBefore.clip=opts.cssBefore.clip||clip||'rect(0px 0px 0px 0px)';var d=opts.cssBefore.clip.match(/(\d+)/g);var t=parseInt(d[0],10),r=parseInt(d[1],10),b=parseInt(d[2],10),l=parseInt(d[3],10);opts.before.push(function(curr,next,opts){if(curr==next)return;var $curr=$(curr),$next=$(next);$.fn.cycle.commonReset(curr,next,opts,!0,!0,!1);opts.cssAfter.display='block';var step=1,count=parseInt((opts.speedIn/13),10)-1;(function f(){var tt=t?t-parseInt(step*(t/count),10):0;var ll=l?l-parseInt(step*(l/count),10):0;var bb=b<h?b+parseInt(step*((h-b)/count||1),10):h;var rr=r<w?r+parseInt(step*((w-r)/count||1),10):w;$next.css({clip:'rect('+tt+'px '+rr+'px '+bb+'px '+ll+'px)'});(step++<=count)?setTimeout(f,13):$curr.css('display','none')})()});$.extend(opts.cssBefore,{display:'block',opacity:1,top:0,left:0});opts.animIn={left:0};opts.animOut={left:0}}})(jQuery);(function($){"use strict";$.fn.maximage=function(settings,helperSettings){var config;if(typeof settings=='object'||settings===undefined)config=$.extend($.fn.maximage.defaults,settings||{});if(typeof settings=='string')config=$.fn.maximage.defaults;$.Body=$('body');$.Window=$(window);$.Scroll=$('html, body');$.Events={RESIZE:'resize'};this.each(function(){var $self=$(this),preload_count=0,imageCache=[];var Modern={setup:function(){if($.Slides.length>0){for(var i in $.Slides){var $img=$.Slides[i];$self.append('<div class="mc-image '+$img.theclass+'" title="'+$img.alt+'" style="background-image:url(\''+$img.url+'\');'+$img.style+'" data-href="'+$img.datahref+'">'+$img.content+'</div>')}
Modern.preload(0);Modern.resize()}},preload:function(n){var $img=$('<img/>');$img.load(function(){if(preload_count==0){Cycle.setup();config.onFirstImageLoaded()}
if(preload_count==($.Slides.length-1)){config.onImagesLoaded($self)}else{preload_count++;Modern.preload(preload_count)}});$img[0].src=$.Slides[n].url;imageCache.push($img[0])},resize:function(){$.Window.bind($.Events.RESIZE,function(){$.Scroll.addClass('mc-hide-scrolls');$.Window.data('h',Utils.sizes().h).data('w',Utils.sizes().w);$self.height($.Window.data('h')).width($.Window.data('w')).children().height($.Window.data('h')).width($.Window.data('w'));$self.children().each(function(){this.cycleH=$.Window.data('h');this.cycleW=$.Window.data('w')});$($.Scroll).removeClass('mc-hide-scrolls')})}}
var Old={setup:function(){var c,t,$div;if($.BrowserTests.msie&&!config.overrideMSIEStop){document.execCommand("Stop",!1)}
$self.html('');$.Body.addClass('mc-old-browser');if($.Slides.length>0){$.Scroll.addClass('mc-hide-scrolls');$.Window.data('h',Utils.sizes().h).data('w',Utils.sizes().w);$('body').append($("<div></div>").attr("class","mc-loader").css({'position':'absolute','left':'-9999px'}));for(var j in $.Slides){if($.Slides[j].content.length==0){c='<img src="'+$.Slides[j].url+'" />'}else{c=$.Slides[j].content}
$div=$("<div>"+c+"</div>").attr("class","mc-image mc-image-n"+j+" "+$.Slides[j].theclass);$self.append($div);if($('.mc-image-n'+j).children('img').length==0){}else{$('div.mc-loader').append($('.mc-image-n'+j).children('img').first().clone().addClass('not-loaded'))}}
Old.preload();Old.windowResize()}},preload:function(){var t=setInterval(function(){$('.mc-loader').children('img').each(function(i){var $img=$(this);if($img.hasClass('not-loaded')){if($img.height()>0){$(this).removeClass('not-loaded');var $img1=$('div.mc-image-n'+i).children('img').first();$img1
.data('h',$img.height()).data('w',$img.width()).data('ar',($img.width()/$img.height()));Old.onceLoaded(i)}}});if($('.not-loaded').length==0){$('.mc-loader').remove();clearInterval(t)}},1000)},onceLoaded:function(m){Old.maximage(m);if(m==0){$self.css({'visibility':'visible'});config.onFirstImageLoaded()}else if(m==$.Slides.length-1){Cycle.setup();$($.Scroll).removeClass('mc-hide-scrolls');config.onImagesLoaded($self);if(config.debug){debug(' - Final Maximage - ');debug($self)}}},maximage:function(p){$('div.mc-image-n'+p).height($.Window.data('h')).width($.Window.data('w')).children('img').first().each(function(){Adjust.maxcover($(this))})},windowResize:function(){$.Window.bind($.Events.RESIZE,function(){clearTimeout(this.id);this.id=setTimeout(Old.doneResizing,200)})},doneResizing:function(){$($.Scroll).addClass('mc-hide-scrolls');$.Window.data('h',Utils.sizes().h).data('w',Utils.sizes().w);$self.height($.Window.data('h')).width($.Window.data('w'))
$self.find('.mc-image').each(function(n){Old.maximage(n)});var curr_opts=$self.data('cycle.opts');if(curr_opts!=undefined){curr_opts.height=$.Window.data('h');curr_opts.width=$.Window.data('w');jQuery.each(curr_opts.elements,function(index,item){item.cycleW=$.Window.data('w');item.cycleH=$.Window.data('h')})}
$($.Scroll).removeClass('mc-hide-scrolls')}}
var Cycle={setup:function(){var h,w;$self.addClass('mc-cycle');$.Window.data('h',Utils.sizes().h).data('w',Utils.sizes().w);jQuery.easing.easeForCSSTransition=function(x,t,b,c,d,s){return b+c};var cycleOptions=$.extend({fit:1,containerResize:0,height:$.Window.data('h'),width:$.Window.data('w'),slideResize:!1,easing:($.BrowserTests.cssTransitions&&config.cssTransitions?'easeForCSSTransition':'swing')},config.cycleOptions);$self.cycle(cycleOptions)}}
var Adjust={center:function($item){if(config.verticalCenter){$item.css({marginTop:(($item.height()-$.Window.data('h'))/2)*-1})}
if(config.horizontalCenter){$item.css({marginLeft:(($item.width()-$.Window.data('w'))/2)*-1})}},fill:function($item){var $storageEl=$item.is('object')?$item.parent().first():$item;if(typeof config.backgroundSize=='function'){config.backgroundSize($item)}else if(config.backgroundSize=='cover'){if($.Window.data('w')/$.Window.data('h')<$storageEl.data('ar')){$item.height($.Window.data('h')).width(($.Window.data('h')*$storageEl.data('ar')).toFixed(0))}else{$item.height(($.Window.data('w')/$storageEl.data('ar')).toFixed(0)).width($.Window.data('w'))}}else if(config.backgroundSize=='contain'){if($.Window.data('w')/$.Window.data('h')<$storageEl.data('ar')){$item.height(($.Window.data('w')/$storageEl.data('ar')).toFixed(0)).width($.Window.data('w'))}else{$item.height($.Window.data('h')).width(($.Window.data('h')*$storageEl.data('ar')).toFixed(0))}}else{debug('The backgroundSize option was not recognized for older browsers.')}},maxcover:function($item){Adjust.fill($item);Adjust.center($item)},maxcontain:function($item){Adjust.fill($item);Adjust.center($item)}}
var Utils={browser_tests:function(){var $div=$('<div />')[0],vendor=['Moz','Webkit','Khtml','O','ms'],p='transition',obj={cssTransitions:!1,cssBackgroundSize:("backgroundSize" in $div.style&&config.cssBackgroundSize),html5Video:!1,msie:!1};if(config.cssTransitions){if(typeof $div.style[p]=='string'){obj.cssTransitions=!0}
p=p.charAt(0).toUpperCase()+p.substr(1);for(var i=0;i<vendor.length;i++){if(vendor[i]+p in $div.style){obj.cssTransitions=!0}}}
if(!!document.createElement('video').canPlayType){obj.html5Video=!0}
obj.msie=(Utils.msie()!==undefined);if(config.debug){debug(' - Browser Test - ');debug(obj)}
return obj},construct_slide_object:function(){var obj=new Object(),arr=new Array(),temp='';$self.children().each(function(i){var $img=$(this).is('img')?$(this).clone():$(this).find('img').first().clone();obj={};obj.url=$img.attr('src');obj.title=$img.attr('title')!=undefined?$img.attr('title'):'';obj.alt=$img.attr('alt')!=undefined?$img.attr('alt'):'';obj.theclass=$img.attr('class')!=undefined?$img.attr('class'):'';obj.styles=$img.attr('style')!=undefined?$img.attr('style'):'';obj.orig=$img.clone();obj.datahref=$img.attr('data-href')!=undefined?$img.attr('data-href'):'';obj.content="";if($(this).find('img').length>0){if($.BrowserTests.cssBackgroundSize){$(this).find('img').first().remove()}
obj.content=$(this).html()}
$img[0].src="";if($.BrowserTests.cssBackgroundSize){$(this).remove()}
arr.push(obj)});if(config.debug){debug(' - Slide Object - ');debug(arr)}
return arr},msie:function(){var undef,v=3,div=document.createElement('div'),all=div.getElementsByTagName('i');while(div.innerHTML='<!--[if gt IE '+(++v)+']><i></i><![endif]-->',all[0]);return v>4?v:undef},sizes:function(){var sizes={h:0,w:0};if(config.fillElement=="window"){sizes.h=$.Window.height();sizes.w=$.Window.width()}else{var $fillElement=$self.parents(config.fillElement).first();if($fillElement.height()==0||$fillElement.data('windowHeight')==!0){$fillElement.data('windowHeight',!0);sizes.h=$.Window.height()}else{sizes.h=$fillElement.height()}
if($fillElement.width()==0||$fillElement.data('windowWidth')==!0){$fillElement.data('windowWidth',!0);sizes.w=$.Window.width()}else{sizes.w=$fillElement.width()}}
return sizes}}
$.BrowserTests=Utils.browser_tests();if(typeof settings=='string'){if($.BrowserTests.html5Video||!$self.is('video')){var to,$storageEl=$self.is('object')?$self.parent().first():$self;if(!$.Body.hasClass('mc-old-browser'))
$.Body.addClass('mc-old-browser');$.Window.data('h',Utils.sizes().h).data('w',Utils.sizes().w);$storageEl.data('h',$self.height()).data('w',$self.width()).data('ar',$self.width()/$self.height());$.Window.bind($.Events.RESIZE,function(){$.Window.data('h',Utils.sizes().h).data('w',Utils.sizes().w);to=$self.data('resizer');clearTimeout(to);to=setTimeout(Adjust[settings]($self),200);$self.data('resizer',to)});Adjust[settings]($self)}}else{$.Slides=Utils.construct_slide_object();if($.BrowserTests.cssBackgroundSize){if(config.debug)debug(' - Using Modern - ');Modern.setup()}else{if(config.debug)debug(' - Using Old - ');Old.setup()}}});function debug($obj){if(window.console&&window.console.log){window.console.log($obj)}}}
$.fn.maximage.defaults={debug:!1,cssBackgroundSize:!0,cssTransitions:!0,verticalCenter:!0,horizontalCenter:!0,scaleInterval:20,backgroundSize:'cover',fillElement:'window',overrideMSIEStop:!1,onFirstImageLoaded:function(){},onImagesLoaded:function(){}}})(jQuery)

</script>
		<script type="text/javascript" charset="utf-8">
			$(function(){
				// Trigger maximage
				jQuery('#maximage').maximage();
			});
		</script>

		<script>
		
			//Slideshow Reset
			setTimeout(function(){
			window.location.reload(1);
			}, <?php echo $reset;?>);
			
		</script>
	</body>
</html>