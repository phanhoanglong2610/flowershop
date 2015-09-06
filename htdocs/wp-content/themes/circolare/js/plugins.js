/*global jQuery:false */

/* hoverIntent by Brian Cherne */
(function(e){e.fn.hoverIntent=function(t,n,r){var i={interval:100,sensitivity:7,timeout:0};if(typeof t==="object"){i=e.extend(i,t)}else if(e.isFunction(n)){i=e.extend(i,{over:t,out:n,selector:r})}else{i=e.extend(i,{over:t,out:t,selector:n})}var s,o,u,a;var f=function(e){s=e.pageX;o=e.pageY};var l=function(t,n){n.hoverIntent_t=clearTimeout(n.hoverIntent_t);if(Math.abs(u-s)+Math.abs(a-o)<i.sensitivity){e(n).off("mousemove.hoverIntent",f);n.hoverIntent_s=1;return i.over.apply(n,[t])}else{u=s;a=o;n.hoverIntent_t=setTimeout(function(){l(t,n)},i.interval)}};var c=function(e,t){t.hoverIntent_t=clearTimeout(t.hoverIntent_t);t.hoverIntent_s=0;return i.out.apply(t,[e])};var h=function(t){var n=jQuery.extend({},t);var r=this;if(r.hoverIntent_t){r.hoverIntent_t=clearTimeout(r.hoverIntent_t)}if(t.type=="mouseenter"){u=n.pageX;a=n.pageY;e(r).on("mousemove.hoverIntent",f);if(r.hoverIntent_s!=1){r.hoverIntent_t=setTimeout(function(){l(n,r)},i.interval)}}else{e(r).off("mousemove.hoverIntent",f);if(r.hoverIntent_s==1){r.hoverIntent_t=setTimeout(function(){c(n,r)},i.timeout)}}};return this.on({"mouseenter.hoverIntent":h,"mouseleave.hoverIntent":h},i.selector)}})(jQuery)


/* Superfish v1.4.8 - jQuery menu widget */
;(function($){$.fn.superfish=function(op){var sf=$.fn.superfish,c=sf.c,$arrow=$(['<span class="',c.arrowClass,'"> &#187;</span>'].join("")),over=function(){var $$=$(this),menu=getMenu($$);clearTimeout(menu.sfTimer);$$.showSuperfishUl().siblings().hideSuperfishUl()},out=function(){var $$=$(this),menu=getMenu($$),o=sf.op;clearTimeout(menu.sfTimer);menu.sfTimer=setTimeout(function(){o.retainPath=$.inArray($$[0],o.$path)>-1;$$.hideSuperfishUl();if(o.$path.length&&$$.parents(["li.",o.hoverClass].join("")).length<
1)over.call(o.$path)},o.delay)},getMenu=function($menu){var menu=$menu.parents(["ul.",c.menuClass,":first"].join(""))[0];sf.op=sf.o[menu.serial];return menu},addArrow=function($a){$a.addClass(c.anchorClass).append($arrow.clone())};return this.each(function(){var s=this.serial=sf.o.length;var o=$.extend({},sf.defaults,op);o.$path=$("li."+o.pathClass,this).slice(0,o.pathLevels).each(function(){$(this).addClass([o.hoverClass,c.bcClass].join(" ")).filter("li:has(ul)").removeClass(o.pathClass)});sf.o[s]=
sf.op=o;$("li:has(ul)",this)[$.fn.hoverIntent&&!o.disableHI?"hoverIntent":"hover"](over,out).each(function(){if(o.autoArrows)addArrow($(">a:first-child",this))}).not("."+c.bcClass).hideSuperfishUl();var $a=$("a",this);$a.each(function(i){var $li=$a.eq(i).parents("li");$a.eq(i).focus(function(){over.call($li)}).blur(function(){out.call($li)})});o.onInit.call(this)}).each(function(){var menuClasses=[c.menuClass];if(sf.op.dropShadows&&!($.browser.msie&&$.browser.version<7))menuClasses.push(c.shadowClass);
$(this).addClass(menuClasses.join(" "))})};var sf=$.fn.superfish;sf.o=[];sf.op={};sf.IE7fix=function(){var o=sf.op;if($.browser.msie&&$.browser.version>6&&o.dropShadows&&o.animation.opacity!=undefined)this.toggleClass(sf.c.shadowClass+"-off")};sf.c={bcClass:"sf-breadcrumb",menuClass:"sf-js-enabled",anchorClass:"sf-with-ul",arrowClass:"sf-sub-indicator",shadowClass:"sf-shadow"};sf.defaults={hoverClass:"sfHover",pathClass:"overideThisToUse",pathLevels:1,delay:800,animation:{opacity:"show"},speed:"normal",
autoArrows:true,dropShadows:true,disableHI:false,onInit:function(){},onBeforeShow:function(){},onShow:function(){},onHide:function(){}};$.fn.extend({hideSuperfishUl:function(){var o=sf.op,not=o.retainPath===true?o.$path:"";o.retainPath=false;var $ul=$(["li.",o.hoverClass].join(""),this).add(this).not(not).removeClass(o.hoverClass).find(">ul").hide().css("visibility","hidden");o.onHide.call($ul);return this},showSuperfishUl:function(){var o=sf.op,sh=sf.c.shadowClass+"-off",$ul=this.addClass(o.hoverClass).find(">ul:hidden").css("visibility",
"visible");sf.IE7fix.call($ul);o.onBeforeShow.call($ul);$ul.animate(o.animation,o.speed,function(){sf.IE7fix.call($ul);o.onShow.call($ul)});return this}})})(jQuery);


/* Mosaic - Sliding Boxes and Captions jQuery Plugin */
(function($){if(!$.omr)$.omr=new Object;$.omr.mosaic=function(el,options){var base=this;base.$el=$(el);base.el=el;base.$el.data("omr.mosaic",base);base.init=function(){base.options=$.extend({},$.omr.mosaic.defaultOptions,options);base.load_box()};base.load_box=function(){if(base.options.preload){$(base.options.backdrop,base.el).hide();$(base.options.overlay,base.el).hide();$(window).load(function(){if(base.options.options.animation=="fade"&&$(base.options.overlay,base.el).css("opacity")==0)$(base.options.overlay,
base.el).css("filter","alpha(opacity=0)");$(base.options.overlay,base.el).fadeIn(200,function(){$(base.options.backdrop,base.el).fadeIn(200)});base.allow_hover()})}else{$(base.options.backdrop,base.el).show();$(base.options.overlay,base.el).show();base.allow_hover()}};base.allow_hover=function(){switch(base.options.animation){case "fade":$(base.el).hover(function(){$(base.options.overlay,base.el).stop().fadeTo(base.options.speed,base.options.opacity)},function(){$(base.options.overlay,base.el).stop().fadeTo(base.options.speed,
0)});break;case "slide":startX=$(base.options.overlay,base.el).css(base.options.anchor_x)!="auto"?$(base.options.overlay,base.el).css(base.options.anchor_x):"0px";startY=$(base.options.overlay,base.el).css(base.options.anchor_y)!="auto"?$(base.options.overlay,base.el).css(base.options.anchor_y):"0px";var hoverState={};hoverState[base.options.anchor_x]=base.options.hover_x;hoverState[base.options.anchor_y]=base.options.hover_y;var endState={};endState[base.options.anchor_x]=startX;endState[base.options.anchor_y]=
startY;$(base.el).hover(function(){$(base.options.overlay,base.el).stop().animate(hoverState,base.options.speed)},function(){$(base.options.overlay,base.el).stop().animate(endState,base.options.speed)});break}};base.init()};$.omr.mosaic.defaultOptions={animation:"fade",speed:150,opacity:1,preload:0,anchor_x:"left",anchor_y:"bottom",hover_x:"0px",hover_y:"0px",overlay:".mosaic-overlay",backdrop:".mosaic-backdrop"};$.fn.mosaic=function(options){return this.each(function(){new $.omr.mosaic(this,options)})}})(jQuery);


/* Mobile Menu */
(function(e){function s(e){document.location.href=e}function o(){return e(".mnav").length?true:false}function u(t){var n=true;t.each(function(){if(!e(this).is("ul")&&!e(this).is("ol")){n=false}});return n}function a(){return e(window).width()<t.switchWidth}function f(t){return e.trim(t.clone().children("ul, ol").remove().end().text())}function l(t){return e.inArray(t,i)===-1?true:false}function c(t){t.find(" > li").each(function(){var n=e(this),r=n.find("a").attr("href"),s=function(){if(n.parent().parent().is("li")){return n.parent().parent().find("a").attr("href")}else{return null}};if(n.find(" ul, ol").length){c(n.find("> ul, > ol"))}if(!n.find(" > ul li, > ol li").length){n.find("ul, ol").remove()}if(!l(s(),i)&&l(r,i)){n.appendTo(t.closest("ul#mmnav").find("li:has(a[href="+s()+"]):first ul"))}else if(l(r)){i.push(r)}else{n.remove()}})}function h(){var t=e('<ul id="mmnav" />');n.each(function(){e(this).children().clone().appendTo(t)});c(t);return t}function p(t,n,r){if(!r){e('<option value="'+t.find("a:first").attr("href")+'">'+e.trim(f(t))+"</option>").appendTo(n)}else{e('<option value="'+t.find("a:first").attr("href")+'">'+r+"</option>").appendTo(n)}}function d(n,r){var i=e('<optgroup label="'+e.trim(f(n))+'" />');p(n,i,t.groupPageText);n.children("ul, ol").each(function(){e(this).children("li").each(function(){p(e(this),i)})});i.appendTo(r)}function v(n){var i=e('<select id="mm'+r+'" class="mnav" />');r++;if(t.topOptionText){p(e("<li>"+t.topOptionText+"</li>"),i)}n.children("li").each(function(){var n=e(this);if(n.children("ul, ol").length&&t.nested){d(n,i)}else{p(n,i)}});i.change(function(){s(e(this).val())}).prependTo(t.prependTo)}function m(){if(a()&&!o()){if(t.combine){var r=h();v(r)}else{n.each(function(){v(e(this))})}}if(a()&&o()){e(".mnav").show();n.hide()}if(!a()&&o()){e(".mnav").hide();n.show()}}var t={combine:false,groupPageText:"Main",nested:true,prependTo:".navigation",switchWidth:1007,topOptionText:"Select a page"},n,r=0,i=[];e.fn.mobileMenu=function(r){if(r){e.extend(t,r)}if(u(e(this))){n=e(this);m();e(window).resize(function(){m()})}else{alert("mobileMenu only works with <ul>/<ol>")}}})(jQuery)


/* jQuery Cookie Plugin */
var jaaulde=window.jaaulde||{};jaaulde.utils=jaaulde.utils||{};jaaulde.utils.cookies=(function(){var resolveOptions,assembleOptionsString,parseCookies,constructor,defaultOptions={expiresAt:null,path:'/',domain:null,secure:false};resolveOptions=function(options){var returnValue,expireDate;if(typeof options!=='object'||options===null){returnValue=defaultOptions;}else
{returnValue={expiresAt:defaultOptions.expiresAt,path:defaultOptions.path,domain:defaultOptions.domain,secure:defaultOptions.secure};if(typeof options.expiresAt==='object'&&options.expiresAt instanceof Date){returnValue.expiresAt=options.expiresAt;}else if(typeof options.hoursToLive==='number'&&options.hoursToLive!==0){expireDate=new Date();expireDate.setTime(expireDate.getTime()+(options.hoursToLive*60*60*1000));returnValue.expiresAt=expireDate;}if(typeof options.path==='string'&&options.path!==''){returnValue.path=options.path;}if(typeof options.domain==='string'&&options.domain!==''){returnValue.domain=options.domain;}if(options.secure===true){returnValue.secure=options.secure;}}return returnValue;};assembleOptionsString=function(options){options=resolveOptions(options);return((typeof options.expiresAt==='object'&&options.expiresAt instanceof Date?'; expires='+options.expiresAt.toGMTString():'')+'; path='+options.path+(typeof options.domain==='string'?'; domain='+options.domain:'')+(options.secure===true?'; secure':''));};parseCookies=function(){var cookies={},i,pair,name,value,separated=document.cookie.split(';'),unparsedValue;for(i=0;i<separated.length;i=i+1){pair=separated[i].split('=');name=pair[0].replace(/^\s*/,'').replace(/\s*$/,'');try
{value=decodeURIComponent(pair[1]);}catch(e1){value=pair[1];}if(typeof JSON==='object'&&JSON!==null&&typeof JSON.parse==='function'){try
{unparsedValue=value;value=JSON.parse(value);}catch(e2){value=unparsedValue;}}cookies[name]=value;}return cookies;};constructor=function(){};constructor.prototype.get=function(cookieName){var returnValue,item,cookies=parseCookies();if(typeof cookieName==='string'){returnValue=(typeof cookies[cookieName]!=='undefined')?cookies[cookieName]:null;}else if(typeof cookieName==='object'&&cookieName!==null){returnValue={};for(item in cookieName){if(typeof cookies[cookieName[item]]!=='undefined'){returnValue[cookieName[item]]=cookies[cookieName[item]];}else
{returnValue[cookieName[item]]=null;}}}else
{returnValue=cookies;}return returnValue;};constructor.prototype.filter=function(cookieNameRegExp){var cookieName,returnValue={},cookies=parseCookies();if(typeof cookieNameRegExp==='string'){cookieNameRegExp=new RegExp(cookieNameRegExp);}for(cookieName in cookies){if(cookieName.match(cookieNameRegExp)){returnValue[cookieName]=cookies[cookieName];}}return returnValue;};constructor.prototype.set=function(cookieName,value,options){if(typeof options!=='object'||options===null){options={};}if(typeof value==='undefined'||value===null){value='';options.hoursToLive=-8760;}else if(typeof value!=='string'){if(typeof JSON==='object'&&JSON!==null&&typeof JSON.stringify==='function'){value=JSON.stringify(value);}else
{throw new Error('cookies.set() received non-string value and could not serialize.');}}var optionsString=assembleOptionsString(options);document.cookie=cookieName+'='+encodeURIComponent(value)+optionsString;};constructor.prototype.del=function(cookieName,options){var allCookies={},name;if(typeof options!=='object'||options===null){options={};}if(typeof cookieName==='boolean'&&cookieName===true){allCookies=this.get();}else if(typeof cookieName==='string'){allCookies[cookieName]=true;}for(name in allCookies){if(typeof name==='string'&&name!==''){this.set(name,null,options);}}};constructor.prototype.test=function(){var returnValue=false,testName='cT',testValue='data';this.set(testName,testValue);if(this.get(testName)===testValue){this.del(testName);returnValue=true;}return returnValue;};constructor.prototype.setOptions=function(options){if(typeof options!=='object'){options=null;}defaultOptions=resolveOptions(options);};return new constructor();})();(function(){if(window.jQuery){(function($){$.cookies=jaaulde.utils.cookies;var extensions={cookify:function(options){return this.each(function(){var i,nameAttrs=['name','id'],name,$this=$(this),value;for(i in nameAttrs){if(!isNaN(i)){name=$this.attr(nameAttrs[i]);if(typeof name==='string'&&name!==''){if($this.is(':checkbox, :radio')){if($this.attr('checked')){value=$this.val();}}else if($this.is(':input')){value=$this.val();}else
{value=$this.html();}if(typeof value!=='string'||value===''){value=null;}$.cookies.set(name,value,options);break;}}}});},cookieFill:function(){return this.each(function(){var n,getN,nameAttrs=['name','id'],name,$this=$(this),value;getN=function(){n=nameAttrs.pop();return!!n;};while(getN()){name=$this.attr(n);if(typeof name==='string'&&name!==''){value=$.cookies.get(name);if(value!==null){if($this.is(':checkbox, :radio')){if($this.val()===value){$this.attr('checked','checked');}else
{$this.removeAttr('checked');}}else if($this.is(':input')){$this.val(value);}else
{$this.html(value);}}break;}}});},cookieBind:function(options){return this.each(function(){var $this=$(this);$this.cookieFill().change(function(){$this.cookify(options);});});}};$.each(extensions,function(i){$.fn[i]=this;});})(window.jQuery);}})();

/* Equal Heights */
(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=minHeight?minHeight:0;this.each(function(){if($(this).height()>tallest)tallest=$(this).height()});if(maxHeight&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest).css("overflow","show")})}})(jQuery);