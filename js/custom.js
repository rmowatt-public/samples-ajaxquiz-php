jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d);},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b;},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b;},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b;},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b;},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b;},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b;},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b;},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b;},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b;},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b;},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b;},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b;},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b;},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b;},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b;},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b;},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b;},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b;},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b;},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b;},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b;},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b;},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4;}
else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b;},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b;},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b;},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b;},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b;},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b;}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b;}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b;}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b;}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b;}});jQuery.noConflict();jQuery(document).ready(function(){jQuery("#featured").not('.fadeslider, .newsslider').superaccordion({slides:'.featured',autorotation:true,autorotationSpeed:6,animationSpeed:950,event:'mouseover',imageShadowStrength:0.6,imageShadow:true});});(function($)
{$.fn.super_image_preloader=function(options)
{var defaults={repeatedCheck:550,fadeInSpeed:1100,delay:610,callback:''};var options=$.extend(defaults,options);return this.each(function()
{var imageContainer=jQuery(this),images=imageContainer.find('img').css({opacity:0,visibility:'hidden'}),imagesToLoad=images.length;imageContainer.operations={preload:function()
{var stopPreloading=true;images.each(function(i,event)
{var image=$(this);if(event.complete==true)
{imageContainer.operations.showImage(image);}
else
{image.bind('error load',{currentImage:image},imageContainer.operations.showImage);}});return this;},showImage:function(image)
{imagesToLoad--;if(image.data.currentImage!=undefined){image=image.data.currentImage;}
if(options.delay<=0)image.css('visibility','visible').animate({opacity:1},options.fadeInSpeed);if(imagesToLoad==0)
{if(options.delay>0)
{images.each(function(i,event)
{var image=$(this);setTimeout(function()
{image.css('visibility','visible').animate({opacity:1},options.fadeInSpeed);},options.delay*(i+1));});if(options.callback!='')
{setTimeout(options.callback,options.delay*images.length);}}
else if(options.callback!='')
{(options.callback)();}}}};imageContainer.operations.preload();});}})(jQuery);(function($)
{$.fn.super_fade_slider=function(options)
{var defaults={slides:'>div',autorotation:true,autorotationSpeed:3,backgroundOpacity:0.9,animationSpeed:910,appendControlls:''};var options=$.extend(defaults,options);return this.each(function()
{var slideWrapper=$(this),slides=slideWrapper.find(options.slides).css({display:'none',zIndex:0}),slideCount=slides.length,currentSlideNumber=0,interval,current_class='active_item',controlls='',skipSwitch=true;slides.find('.feature_excerpt').css('opacity',options.backgroundOpacity);slideWrapper.methods={init:function()
{slides.filter(':eq(0)').css({zIndex:2,display:'block'});if(slideCount<=1)
{slideWrapper.super_image_preloader({delay:200});}
else
{slideWrapper.super_image_preloader({callback:slideWrapper.methods.preloadingDone,delay:200});if(options.appendControlls)
{controlls=$('<div></div>').addClass('slidecontrolls').css({position:'absolute'}).appendTo(options.appendControlls);slides.each(function(i)
{var controller=$('<span class="ie6fix '+current_class+'"></span>').appendTo(controlls);controller.bind('click',{currentSlideNumber:i},slideWrapper.methods.switchSlide);current_class="";});}}},preloadingDone:function()
{skipSwitch=false;if(options.autorotation)
{slideWrapper.methods.autorotate();}},switchSlide:function(passed)
{var noAction=false;if(passed!=undefined&&!skipSwitch)
{if(currentSlideNumber!=passed.data.currentSlideNumber)
{currentSlideNumber=passed.data.currentSlideNumber;}
else
{noAction=true;}}
if(passed!=undefined)
{clearInterval(interval);}
if(!skipSwitch&&noAction==false)
{skipSwitch=true;var currentSlide=slides.filter(':visible'),nextSlide=slides.filter(':eq('+currentSlideNumber+')');if(options.appendControlls)
{controlls.find('.active_item').removeClass('active_item');controlls.find('span:eq('+currentSlideNumber+')').addClass('active_item');}
currentSlide.css({zIndex:4});nextSlide.css({zIndex:2,display:'block'});currentSlide.fadeOut(options.animationSpeed,function()
{currentSlide.css({zIndex:0,display:"none"});skipSwitch=false;});}},autorotate:function()
{interval=setInterval(function()
{currentSlideNumber++;if(currentSlideNumber==slideCount)currentSlideNumber=0;slideWrapper.methods.switchSlide();},(parseInt(options.autorotationSpeed)*1000));}};slideWrapper.methods.init();});}})(jQuery);(function($)
{$.fn.superaccordion=function(options)
{var defaults={slides:'>div',animationSpeed:910,imageShadow:true,imageShadowStrength:0.6,autorotation:true,autorotationSpeed:3,easing:'easeOutQuint',event:'mouseover',fontOpacity:1,backgroundOpacity:0.9};var options=$.extend(defaults,options);return this.each(function()
{var slideWrapper=$(this),slides=slideWrapper.find(options.slides).css('display','block'),slide_count=slides.length,slide_width=slideWrapper.width()/slide_count
expand_slide=slides.width(),minimized_slide=(slideWrapper.width()-expand_slide)/(slide_count-1),overlay_modifier=200*(1-options.imageShadowStrength),excerptWrapper=slideWrapper.find('.feature_excerpt'),interval='',current_slide=0;excerptWrapper.wrap('<span class="feature_excerpt"></span>').removeClass('feature_excerpt').addClass('position_excerpt');excerptWrapper=slideWrapper.find('.feature_excerpt').css('opacity',options.backgroundOpacity);excerptWrapper.equalHeights().find('.position_excerpt').css({display:'block',opacity:0,position:'absolute'});var excerptWrapperHeight=excerptWrapper.height();slides.each(function(i)
{var this_slide=$(this),this_slide_a=this_slide.find('a'),real_excerpt=this_slide.find('.position_excerpt'),real_excerpt_height=real_excerpt.height(),slide_heading=this_slide.find('.sliderheading'),cloned_heading=slide_heading.clone().appendTo(this_slide_a).addClass('heading_clone').css({opacity:options.fontOpacity,width:slide_width-30}),clone_height=cloned_heading.height();this_slide.css('backgroundPosition',parseInt(slide_width/2-8)+'px '+parseInt((this_slide.height()-real_excerpt_height)/2-8)+'px');cloned_heading.css({bottom:(excerptWrapperHeight-clone_height)/2+9});real_excerpt.css({bottom:(excerptWrapperHeight-real_excerpt_height)/2+9});this_slide.data('data',{this_slides_position:i*slide_width,pos_active_higher:i*minimized_slide,pos_active_lower:((i-1)*minimized_slide)+expand_slide});this_slide.css({zIndex:i+1,left:i*slide_width,width:slide_width+overlay_modifier});if(options.imageShadow)
{this_slide.find('>a').prepend('<span class="fadeout ie6fix"></span>');}});jQuery('#featured').super_image_preloader({callback:add_functionality});function add_functionality()
{if(options.autorotation)
{interval=setInterval(function(){autorotation();},(parseInt(options.autorotationSpeed)*1000));}
slides.each(function(i)
{var this_slide=$(this),real_excerpt=this_slide.find('.position_excerpt'),cloned_heading=this_slide.find('.heading_clone');this_slide.bind(options.event,function(event,continue_autoslide)
{if(!continue_autoslide)
{clearInterval(interval)}
var objData=this_slide.data('data');real_excerpt.stop().animate({opacity:options.fontOpacity},options.animationSpeed,options.easing);cloned_heading.stop().animate({opacity:0},options.animationSpeed,options.easing);this_slide.stop().animate({width:expand_slide+(overlay_modifier*1.2),left:objData.pos_active_higher},options.animationSpeed,options.easing);slides.each(function(j){if(i!==j)
{var this_slide=$(this),real_excerpt=this_slide.find('.position_excerpt'),cloned_heading=this_slide.find('.heading_clone'),objData=this_slide.data('data'),new_pos=objData.pos_active_higher;if(i<j){new_pos=objData.pos_active_lower;}
this_slide.stop().animate({left:new_pos,width:minimized_slide+overlay_modifier},options.animationSpeed,options.easing);real_excerpt.stop().animate({opacity:0},options.animationSpeed,options.easing);cloned_heading.stop().animate({opacity:options.fontOpacity},options.animationSpeed,options.easing);}});});});slideWrapper.bind('mouseleave',function()
{slides.each(function(i)
{var this_slide=$(this),real_excerpt=this_slide.find('.position_excerpt'),cloned_heading=this_slide.find('.heading_clone'),objData=this_slide.data('data'),new_pos=objData.this_slides_position;this_slide.stop().animate({left:new_pos,width:slide_width+overlay_modifier},options.animationSpeed,options.easing);real_excerpt.stop().animate({opacity:0},options.animationSpeed,options.easing);cloned_heading.stop().animate({opacity:options.fontOpacity},options.animationSpeed,options.easing);});});}
function autorotation()
{if(slide_count==current_slide)
{slideWrapper.trigger('mouseleave');current_slide=0;}
else
{slides.filter(':eq('+current_slide+')').trigger(options.event,[true]);current_slide++;}}});};})(jQuery);jQuery.fn.equalHeights=function(){return this.height(Math.max.apply(null,this.map(function(){return jQuery(this).height()}).get()));};