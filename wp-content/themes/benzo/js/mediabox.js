var Mediabox;(function(){var state=0,options,images,activeImage,prevImage,nextImage,top,fx,preload,preloadPrev=new Image(),preloadNext=new Image(),overlay,center,image,bottomContainer,bottom,captionSplit,title,caption,prevLink,number,nextLink,URL,WH,WHL,elrel,mediaWidth,mediaHeight,mediaType="none",mediaSplit,mediaId="mediaBox",mediaFmt;window.addEvent("domready",function(){$(document.body).adopt($$([overlay=new Element("div",{id:"mbOverlay"}).addEvent("click",close),center=new Element("div",{id:"mbCenter"}),bottomContainer=new Element("div",{id:"mbBottomContainer"})]).setStyle("display","none"));image=new Element("div",{id:"mbImage"}).injectInside(center);bottom=new Element("div",{id:"mbBottom"}).injectInside(bottomContainer).adopt(new Element("a",{id:"mbCloseLink",href:"#"}).addEvent("click",close),nextLink=new Element("a",{id:"mbNextLink",href:"#"}).addEvent("click",next),prevLink=new Element("a",{id:"mbPrevLink",href:"#"}).addEvent("click",previous),title=new Element("div",{id:"mbTitle"}),number=new Element("div",{id:"mbNumber"}),caption=new Element("div",{id:"mbCaption"}),new Element("div",{styles:{clear:"both"}}));fx={overlay:new Fx.Tween(overlay,{property:"opacity",duration:360}).set(0),image:new Fx.Tween(image,{property:"opacity",duration:360,onComplete:nextEffect}),bottom:new Fx.Tween(bottom,{property:"margin-top",duration:240})};});Mediabox={close:function(){close();},open:function(_images,startImage,_options){options=$extend({loop:false,stopKey:true,//
overlayOpacity:0.7,resizeDuration:240,resizeTransition:false,initialWidth:360,initialHeight:240,showCaption:true,animateCaption:true,showCounter:true,counterText:'  ({x} of {y})',scriptaccess:'true',fullscreen:'true',fullscreenNum:'1',autoplay:'true',autoplayNum:'1',autoplayYes:'yes',bgcolor:'#000000',playerpath:'../js/player.swf',backcolor:'000000',frontcolor:'999999',lightcolor:'000000',screencolor:'000000',controlbar:'over',useNB:true,//
NBpath:'../js/NonverBlaster.swf',NBloop:'true',controllerColor:'0x777777',showTimecode:'false',controller:'true',flInfo:'true',revverID:'187866',revverFullscreen:'true',revverBack:'000000',revverFront:'ffffff',revverGrad:'000000',ytBorder:'0',ytColor1:'000000',ytColor2:'333333',ytQuality:'&ap=%2526fmt%3D18',ytRel:'0',ytInfo:'1',ytSearch:'0',vuPlayer:'basic',vmTitle:'1',vmByline:'1',vmPortrait:'1',vmColor:'ffffff'},_options||{});if(typeof _images=="string"){_images=[[_images,startImage,_options]];startImage=0;}
if((Browser.Engine.gecko)&&(Browser.Engine.version<19)){options.overlayOpacity=1;overlay.className='mbOverlayFF';}
images=_images;options.loop=options.loop&&(images.length>1);position();setup(true);top=window.getScrollTop()+(window.getHeight()/15);fx.resize=new Fx.Morph(center,$extend({duration:options.resizeDuration,onComplete:nextEffect},options.resizeTransition?{transition:options.resizeTransition}:{}));center.setStyles({top:top,width:options.initialWidth,height:options.initialHeight,marginLeft:-(options.initialWidth/2),display:""});fx.overlay.start(options.overlayOpacity);state=1;return changeImage(startImage);}};Element.implement({mediabox:function(_options,linkMapper){$$(this).mediabox(_options,linkMapper);return this;}});Elements.implement({mediabox:function(_options,linkMapper,linksFilter){linkMapper=linkMapper||function(el){elrel=el.rel.split(/[\[\]]/);elrel=elrel[1];return[el.href,el.title,elrel];};linksFilter=linksFilter||function(){return true;};var links=this;links.removeEvents("click").addEvent("click",function(){var filteredArray=links.filter(linksFilter,this);var filteredLinks=[];var filteredHrefs=[];filteredArray.each(function(item,index){if(filteredHrefs.indexOf(item.toString())<0){filteredLinks.include(filteredArray[index]);filteredHrefs.include(filteredArray[index].toString());};});return Mediabox.open(filteredLinks.map(linkMapper),filteredHrefs.indexOf(this.toString()),_options);});return links;}});function position(){overlay.setStyles({top:window.getScrollTop(),height:window.getHeight()});}
function setup(open){["object",window.ie?"select":"embed"].forEach(function(tag){Array.forEach(document.getElementsByTagName(tag),function(el){if(open)el._mediabox=el.style.visibility;el.style.visibility=open?"hidden":el._mediabox;});});overlay.style.display=open?"":"none";var fn=open?"addEvent":"removeEvent";window[fn]("scroll",position)[fn]("resize",position);document[fn]("keydown",keyDown);}
function keyDown(event){switch(event.code){case 27:case 88:case 67:close();break;case 37:case 80:previous();break;case 39:case 78:next();}
if(options.stopKey){return false;};}
function previous(){return changeImage(prevImage);}
function next(){return changeImage(nextImage);}
function changeImage(imageIndex){if((state==1)&&(imageIndex>=0)){state=2;image.set('html','');activeImage=imageIndex;prevImage=((activeImage||!options.loop)?activeImage:images.length)-1;nextImage=activeImage+1;if(nextImage==images.length)nextImage=options.loop?0:-1;$$(prevLink,nextLink,image,bottomContainer).setStyle("display","none");fx.bottom.cancel().set(0);fx.image.set(0);center.className="mbLoading";WH=images[imageIndex][2].split(' ');WHL=WH.length;if(WHL>1){mediaWidth=(WH[WHL-2].match("%"))?(window.getWidth()*("0."+(WH[WHL-2].replace("%",""))))+"px":WH[WHL-2]+"px";mediaHeight=(WH[WHL-1].match("%"))?(window.getHeight()*("0."+(WH[WHL-1].replace("%",""))))+"px":WH[WHL-1]+"px";}else{mediaWidth="";mediaHeight="";}
URL=images[imageIndex][0];captionSplit=images[activeImage][1].split('::');if(URL.match(/quietube\.com/i)){mediaSplit=URL.split('v.php/');URL=mediaSplit[1];}
if(URL.match(/\.gif|\.jpg|\.png/i)){mediaType='img';preload=new Image();preload.onload=nextEffect;preload.src=images[imageIndex][0];}else if(URL.match(/\.flv|\.mp4/i)){mediaType='obj';mediaWidth=mediaWidth||options.initialWidth;mediaHeight=mediaHeight||options.initialHeight;if(options.useNB){preload=new Swiff(''+options.NBpath+'?videoURL='+URL+'&allowSmoothing=true&autoPlay='+options.autoplay+'&buffer=6&showTimecode='+options.showTimecode+'&loop='+options.NBloop+'&controlColour='+options.controllerColor+'&scaleIfFullScreen=true&showScalingButton=false',{id:'MediaboxSWF',width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});}else{preload=new Swiff(''+options.playerpath+'?file='+URL+'&backcolor='+options.backcolor+'&frontcolor='+options.frontcolor+'&lightcolor='+options.lightcolor+'&screencolor='+options.screencolor+'&autostart='+options.autoplay+'&controlbar='+options.controlbar,{id:'MediaboxSWF',width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});}
nextEffect();}else if(URL.match(/\.mp3|\.aac/i)){mediaType='obj';mediaWidth=mediaWidth||options.initialWidth;mediaHeight=mediaHeight||options.initialHeight;preload=new Swiff(''+options.playerpath+'?file='+URL+'&backcolor='+options.backcolor+'&frontcolor='+options.frontcolor+'&lightcolor='+options.lightcolor+'&screencolor='+options.screencolor+'&autostart='+options.autoplay,{id:'MediaboxSWF',width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/\.swf/i)){mediaType='obj';mediaWidth=mediaWidth||options.initialWidth;mediaHeight=mediaHeight||options.initialHeight;preload=new Swiff(URL,{id:'MediaboxSWF',width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/blip\.tv/i)){mediaType='obj';mediaWidth=mediaWidth||"640px";mediaHeight=mediaHeight||"390px";preload=new Swiff(URL,{src:URL,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/dailymotion\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"480px";mediaHeight=mediaHeight||"381px";preload=new Swiff(URL,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/facebook\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"320px";mediaHeight=mediaHeight||"240px";mediaSplit=URL.split('v=');mediaSplit=mediaSplit[1].split('&');mediaId=mediaSplit[0];preload=new Swiff('http://www.facebook.com/v/'+mediaId,{movie:'http://www.facebook.com/v/'+mediaId,classid:'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000',width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});startEffect();}else if(URL.match(/flickr\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"500px";mediaHeight=mediaHeight||"375px";mediaSplit=URL.split('/');mediaId=mediaSplit[5];preload=new Swiff('http://www.flickr.com/apps/video/stewart.swf',{id:mediaId,classid:'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000',width:mediaWidth,height:mediaHeight,params:{flashvars:'photo_id='+mediaId+'&amp;show_info_box='+options.flInfo,wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/google\.com\/videoplay/i)){mediaType='obj';mediaWidth=mediaWidth||"400px";mediaHeight=mediaHeight||"326px";mediaSplit=URL.split('=');mediaId=mediaSplit[1];preload=new Swiff('http://video.google.com/googleplayer.swf?docId='+mediaId+'&autoplay='+options.autoplayNum,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/megavideo\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"640px";mediaHeight=mediaHeight||"360px";mediaSplit=URL.split('=');mediaId=mediaSplit[1];preload=new Swiff('http://wwwstatic.megavideo.com/mv_player.swf?v='+mediaId,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/metacafe\.com\/watch/i)){mediaType='obj';mediaWidth=mediaWidth||"400px";mediaHeight=mediaHeight||"345px";mediaSplit=URL.split('/');mediaId=mediaSplit[4];preload=new Swiff('http://www.metacafe.com/fplayer/'+mediaId+'/.swf?playerVars=autoPlay='+options.autoplayYes,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/myspacetv\.com|vids\.myspace\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"425px";mediaHeight=mediaHeight||"360px";mediaSplit=URL.split('=');mediaId=mediaSplit[2];preload=new Swiff('http://lads.myspace.com/videos/vplayer.swf?m='+mediaId+'&v=2&a='+options.autoplayNum+'&type=video',{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/revver\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"480px";mediaHeight=mediaHeight||"392px";mediaSplit=URL.split('/');mediaId=mediaSplit[4];preload=new Swiff('http://flash.revver.com/player/1.0/player.swf?mediaId='+mediaId+'&affiliateId='+options.revverID+'&allowFullScreen='+options.revverFullscreen+'&autoStart='+options.autoplay+'&backColor=#'+options.revverBack+'&frontColor=#'+options.revverFront+'&gradColor=#'+options.revverGrad+'&shareUrl=revver',{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/rutube\.ru/i)){mediaType='obj';mediaWidth=mediaWidth||"470px";mediaHeight=mediaHeight||"353px";mediaSplit=URL.split('=');mediaId=mediaSplit[1];preload=new Swiff('http://video.rutube.ru/'+mediaId,{movie:'http://video.rutube.ru/'+mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/seesmic\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"435px";mediaHeight=mediaHeight||"355px";mediaSplit=URL.split('/');mediaId=mediaSplit[5];preload=new Swiff('http://seesmic.com/Standalone.swf?video='+mediaId,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/tudou\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"400px";mediaHeight=mediaHeight||"340px";mediaSplit=URL.split('/');mediaId=mediaSplit[5];preload=new Swiff('http://www.tudou.com/v/'+mediaId,{width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/youku\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"480px";mediaHeight=mediaHeight||"400px";mediaSplit=URL.split('id_');mediaId=mediaSplit[1];preload=new Swiff('http://player.youku.com/player.php/sid/'+mediaId+'=/v.swf',{width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/youtube\.com\/watch/i)){mediaType='obj';mediaSplit=URL.split('v=');mediaId=mediaSplit[1];if(mediaId.match(/fmt=18/i)){mediaFmt='&ap=%2526fmt%3D18';mediaWidth=mediaWidth||"560px";mediaHeight=mediaHeight||"345px";}else if(mediaId.match(/fmt=22/i)){mediaFmt='&ap=%2526fmt%3D22';mediaWidth=mediaWidth||"640px";mediaHeight=mediaHeight||"385px";}else{mediaFmt=options.ytQuality;mediaWidth=mediaWidth||"480px";mediaHeight=mediaHeight||"295px";}
preload=new Swiff('http://www.youtube.com/v/'+mediaId+'&autoplay='+options.autoplayNum+'&fs='+options.fullscreenNum+mediaFmt+'&border='+options.ytBorder+'&color1=0x'+options.ytColor1+'&color2=0x'+options.ytColor2+'&rel='+options.ytRel+'&showinfo='+options.ytInfo+'&showsearch='+options.ytSearch,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/youtube\.com\/view/i)){mediaType='obj';mediaSplit=URL.split('p=');mediaId=mediaSplit[1];mediaWidth=mediaWidth||"480px";mediaHeight=mediaHeight||"385px";preload=new Swiff('http://www.youtube.com/p/'+mediaId+'&autoplay='+options.autoplayNum+'&fs='+options.fullscreenNum+mediaFmt+'&border='+options.ytBorder+'&color1=0x'+options.ytColor1+'&color2=0x'+options.ytColor2+'&rel='+options.ytRel+'&showinfo='+options.ytInfo+'&showsearch='+options.ytSearch,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/veoh\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"410px";mediaHeight=mediaHeight||"341px";mediaSplit=URL.split('videos/');mediaId=mediaSplit[1];preload=new Swiff('http://www.veoh.com/videodetails2.swf?permalinkId='+mediaId+'&player=videodetailsembedded&videoAutoPlay='+options.AutoplayNum,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/viddler\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"437px";mediaHeight=mediaHeight||"370px";mediaSplit=URL.split('/');mediaId=mediaSplit[4];preload=new Swiff(URL,{id:'viddler_'+mediaId,movie:URL,classid:'clsid:D27CDB6E-AE6D-11cf-96B8-444553540000',width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen,id:'viddler_'+mediaId,movie:URL}});nextEffect();}else if(URL.match(/viddyou\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"416px";mediaHeight=mediaHeight||"312px";mediaSplit=URL.split('=');mediaId=mediaSplit[1];preload=new Swiff('http://www.viddyou.com/get/v2_'+options.vuPlayer+'/'+mediaId+'.swf',{id:mediaId,movie:'http://www.viddyou.com/get/v2_'+options.vuPlayer+'/'+mediaId+'.swf',width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/vimeo\.com/i)){mediaType='obj';mediaWidth=mediaWidth||"400px";mediaHeight=mediaHeight||"225px";mediaSplit=URL.split('/');mediaId=mediaSplit[3];preload=new Swiff('http://www.vimeo.com/moogaloop.swf?clip_id='+mediaId+'&amp;server=www.vimeo.com&amp;fullscreen='+options.fullscreenNum+'&amp;autoplay='+options.autoplayNum+'&amp;show_title='+options.vmTitle+'&amp;show_byline='+options.vmByline+'&amp;show_portrait='+options.vmPortrait+'&amp;color='+options.vmColor,{id:mediaId,width:mediaWidth,height:mediaHeight,params:{wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/12seconds\.tv/i)){mediaType='obj';mediaWidth=mediaWidth||"430px";mediaHeight=mediaHeight||"360px";mediaSplit=URL.split('/');mediaId=mediaSplit[5];preload=new Swiff('http://embed.12seconds.tv/players/remotePlayer.swf',{id:mediaId,width:mediaWidth,height:mediaHeight,params:{flashvars:'vid='+mediaId+'',wmode:'opaque',bgcolor:options.bgcolor,allowscriptaccess:options.scriptaccess,allowfullscreen:options.fullscreen}});nextEffect();}else if(URL.match(/\#mb_/i)){mediaType='inline';mediaWidth=mediaWidth||options.initialWidth;mediaHeight=mediaHeight||options.initialHeight;URLsplit=URL.split('#');preload=$(URLsplit[1]).get('html');nextEffect();}else{mediaType='url';mediaWidth=mediaWidth||options.initialWidth;mediaHeight=mediaHeight||options.initialHeight;mediaId="mediaId_"+new Date().getTime();preload=new Element('iframe',{'src':URL,'id':mediaId,'width':mediaWidth,'height':mediaHeight,'frameborder':0});nextEffect();}}
return false;}
function nextEffect(){switch(state++){case 2:if(mediaType=="img"){mediaWidth=preload.width;mediaHeight=preload.height;image.setStyles({backgroundImage:"url("+URL+")",display:""});}else if(mediaType=="obj"){if(Browser.Plugins.Flash.version<8){image.setStyles({backgroundImage:"none",display:""});image.set('html','<div id="mbError"><b>Error</b><br/>Adobe Flash is either not installed or not up to date,<br/>please visit <a href="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" title="Get Flash" target="_new">Adobe.com</a> to download the free player.</div>');}else{image.setStyles({backgroundImage:"none",display:""});preload.inject(image);}}else if(mediaType=="inline"){image.setStyles({backgroundImage:"none",display:""});image.set('html',preload);}else if(mediaType=="url"){image.setStyles({backgroundImage:"none",display:""});preload.inject(image);}else{alert('this file type is not supported\n'+URL+'\nplease visit iaian7.com/webcode/Mediabox for more information');}
$$(image,bottom).setStyle("width",mediaWidth);image.setStyle("height",mediaHeight);title.set('html',(options.showCaption)?captionSplit[0]:"");caption.set('html',(options.showCaption&&(captionSplit.length>1))?captionSplit[1]:"");number.set('html',(options.showCounter&&(images.length>1))?options.counterText.replace(/{x}/,activeImage+1).replace(/{y}/,images.length):"");if((prevImage>=0)&&(images[prevImage][0].match(/\.gif|\.jpg|\.png/i)))preloadPrev.src=images[prevImage][0];if((nextImage>=0)&&(images[nextImage][0].match(/\.gif|\.jpg|\.png/i)))preloadNext.src=images[nextImage][0];state++;case 3:center.className="";fx.resize.start({height:image.offsetHeight,width:image.offsetWidth,marginLeft:-image.offsetWidth/2});break;state++;case 4:bottomContainer.setStyles({top:top+center.clientHeight,marginLeft:center.style.marginLeft,visibility:"hidden",display:""});fx.image.start(1);break;case 5:if(prevImage>=0)prevLink.style.display="";if(nextImage>=0)nextLink.style.display="";if(options.animateCaption){fx.bottom.set(-bottom.offsetHeight).start(0);}
bottomContainer.style.visibility="";state=1;}}
function close(){if(state){state=0;preload.onload=$empty;image.set('html','');for(var f in fx)fx[f].cancel();$$(center,bottomContainer).setStyle("display","none");fx.overlay.chain(setup).start(0);}
return false;}})();Mediabox.scanPage=function(){var links=$$("a").filter(function(el){return el.rel&&el.rel.test(/^mediabox/i);});$$(links).mediabox({},null,function(el){var rel0=this.rel.replace(/[[]|]/gi," ");var relsize=rel0.split(" ");return(this==el)||((this.rel.length>8)&&el.rel.match(relsize[1]));});};window.addEvent("domready",Mediabox.scanPage);