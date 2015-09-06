(function($) {

    // Object Instance
    $.ketslider = function(el, options) {
        var slider = el;

        slider.init = function() {
            slider.vars = $.extend({}, $.ketslider.defaults, options);
            slider.data('ketslider', true);
            slider.container = $('.slides', slider).first();
            slider.slides = $('.slides:first > li', slider);
            slider.count = slider.slides.length;
            slider.animating = false;
            slider.currentSlide = 0;
            slider.slides.filter(':eq(0)').addClass("active");

            slider.animatingTo = slider.currentSlide;
            slider.eventType = ('ontouchstart' in document.documentElement) ? 'touchstart': 'click';
            slider.args = {};
            slider.touch = 'ontouchstart' in document.documentElement;

            ///////////////////////////////////////////////////////////////////
            // Slider Initialize
            totalwidth = 0;
            slider.find(".slides img").each(function() {
                h = slider.height();
                w = this.width * h / this.height;
                $(this).css({
                    "width": w + "px",
                    "height": h + "px"
                }).width($(this).width());
                totalwidth += $(this).width();
            });

            slider.container.width(totalwidth);

            setTimeout(function() {
                slider.slides.css("visibility", "visible");
            }, 100);

            if (!slider.touch) {
                slider.css({
                    "overflow": "hidden"
                });
                overlay = "<span></span>";
                slider.slides.each(function() {
                    $(this).append(overlay);
                });
            }
            ///////////////////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
            // Add Label
            if (slider.vars.label && !slider.touch) {
                var labelHtml = $('<div class="ketslider-label"></div>');
                slider.append(labelHtml);
                slider.label = $('.ketslider-label', slider);
                slider.label.html(slider.find(".slides img:eq(" + slider.currentSlide + ")").attr("alt"));
            }
            
     
			if (slider.touch) {
            	slider.find(".slides img").each(function() {
            	
            	touch_href = $(this).closest('li').find('a').attr('href');
            	
            	touch_title = $(this).attr('alt');
            	
            	if($(this).closest('li').find('a').length){
            	
            	$(this).closest('li').find('a').append('<span  class="touch_title">' + touch_title + '</span>');
            	
            	if( !($(this).closest('li').hasClass('fullscreen_video') || $(this).closest('li').hasClass('lightbox_video'))) {
            	
            		$(this).closest('li').find('a').append('<span  class="mobile_info"></span>');
            		
            	
            	}
            	
            	}
            	else {
            		
            	$(this).closest('li').append('<span class="touch_title">' + touch_title + '</span>');		
            	}
   
            	});
            	
             }	
            
            ///////////////////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
            // Add Number
            if (slider.vars.number && !slider.touch) {
                var numberHtml = $('<div class="ketslider-number"></div>');
                slider.append(numberHtml);
                slider.number = $('.ketslider-number', slider);
                slider.number.html((slider.currentSlide + 1) + "/" + slider.count);
            }
                       
            ///////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////
            // Add Direction Nav
            if (slider.vars.directionNav && !slider.touch) {
                var directionNavHtml = $('<ul class="ketslider-nav"><li><a class="prev" href="#">Previous</a></li><li><a class="next" href="#">Next</a></li></ul>');

                slider.append(directionNavHtml);
                slider.directionNav = $('.ketslider-nav li a', slider);

				//Set initial disable styles if necessary
				if (!slider.vars.wrap)
				{
					if (slider.currentSlide == 0) {
						slider.directionNav.filter('.prev').addClass('disabled');
					} else if (slider.currentSlide == slider.count - 1) {
						slider.directionNav.filter('.next').addClass('disabled');
					}
				}

                slider.directionNav.bind(slider.eventType, function(event) {
                    event.preventDefault();
                    target = ($(this).hasClass('next')) ? slider.getTarget("next") : slider.getTarget("prev");
                    if (!slider.animating && target >= 0 && target <= slider.count - 1) {
                        $.address.path(target + 1);
                    }
                    return false;
                });
            }
            //////////////////////////////////////////////////////////////////
            //////////////////////////////////////////////////////////////////
            // Keyboard Nav
            if (slider.vars.keyboardNav && $('ul.slides').length == 1 && !slider.touch) {
                function keyboardMove(event) {
                    if (slider.animating) {
                        return;
                    } else if (event.keyCode != 39 && event.keyCode != 37) {
                        return;
                    } else {
                        if (event.keyCode == 39) {
                            target = slider.getTarget("next");
                        } else if (event.keyCode == 37) {
                            target = slider.getTarget("prev");
                        }

                        if (!slider.animating && target >= 0 && target <= slider.count - 1) {
                            $.address.path(target + 1);
                        }
                    }
                }
                $(document).bind('keyup', keyboardMove);
            }
            
           
           
            if (slider.vars.slideshow && !slider.touch)
           
           {
           
           var callback = function() { 
           
           
	           slider.getTarget("next");
	           $.address.path(target + 1);
	           
			//	           $('.progress_active').css('width', '0px').animate({ width: "40px" }, slider.vars.slideshowInterval);           

	        };
           
           
			
			var playHtml = $('<div class="play_button pause">Pause</div><div class="play_button play">Play</div>');
			slider.append(playHtml);
            var intervalId = window.setInterval(callback, slider.vars.slideshowInterval);
  
  			$('.pause, .slides li a').on("click", function () {
  				window.clearInterval(intervalId);
  				$('.pause').fadeOut('fast'); 
  				$('.play_button.play').fadeIn('fast');
  			});
  			
  			
  			$('.play').on("click", function () {
  				intervalId = window.setInterval(callback, slider.vars.slideshowInterval);
  				$(this).fadeOut('fast'); 
  				$('.play_button.pause').fadeIn('fast');
  			});
  
  
  			
  
           }
           
           
            //////////////////////////////////////////////////////////////////

            //////////////////////////////////////////////////////////////////
            // Mousewheel Interact
			if (slider.vars.mousewheel) {
			
			slider.bind('mousewheel', function(event, delta) {
			   
			   	event.preventDefault();
			   
			   	var wheelData = delta > 0 ? '1' : '-1';
			   
			   target = (wheelData < 0) ? slider.getTarget("next") : slider.getTarget("prev");
			   
               if (!slider.animating && target >= 0 && target <= slider.count - 1) {
                   $.address.path(target + 1);
               }
			});
			}
            //////////////////////////////////////////////////////////////////

            //////////////////////////////////////////////////////////////////
            // Resize Function
            $(window).resize(function() {
                if (slider.animating)
                    return;
                totalwidth = 0;
                newPos = 0;
                i = 0;

                slider.find(".slides img").each(function() {
                    h = slider.height();
                    w = this.width * h / this.height;
                    $(this).css({
                        "width": w + "px",
                        "height": h + "px"
                    }).width($(this).width());
                    if (i < slider.currentSlide)
                        newPos += $(this).width();
                    else if (i == slider.currentSlide)
                        newPos += $(this).width() / 2;
                    totalwidth += $(this).width();
                    i++;
                });
                slider.container.width(totalwidth);
                if (!slider.touch) {

                    newPos -= slider.width() / 2;

                    if (newPos < 0 || totalwidth < slider.width())
                        newPos = 0;
                    else if (newPos > totalwidth - slider.width())
                        newPos = totalwidth - slider.width();

                    newPos *= -1;

                    if (slider.animateString != newPos + "px") {
                        slider.animateString = newPos + "px";
                        slider.ketAnimate(0);
                    }
                }
            });
        }
        
        
        //Orientation Change
       $(window).bind('orientationchange', function(event) {

                              totalwidth = 0;
                              newPos = 0;
                              i = 0;
	              
                              slider.find(".slides img").each(function() {
                                  h = slider.height();
                                  w = this.width * h / this.height;
                                  $(this).css({
                                      "width": w + "px",
                                      "height": h + "px"
                                  }).width($(this).width());
                                  if (i < slider.currentSlide)
                                      newPos += $(this).width();
                                  else if (i == slider.currentSlide)
                                      newPos += $(this).width() / 2;
                                  totalwidth += $(this).width();
                                  i++;
                              });
                              slider.container.width(totalwidth);                    
       });        
        
        //////////////////////////////////////////////////////////////////
        // Get Target slide
		slider.getTarget = function(direction) {
			if (slider.vars.wrap && slider.currentSlide == 0 && direction == "prev")
				target = slider.count - 1;
			else if (slider.vars.wrap && slider.currentSlide == slider.count - 1 && direction == "next")
				target = 0;
			else if (direction == "prev")
				target = slider.currentSlide - 1;
			else if (direction == "next")
				target = slider.currentSlide + 1;
			return target;
		}
        //////////////////////////////////////////////////////////////////
        // Animation Actions
        slider.slideTo = function(target) {
            if (!slider.animating) {
                //Animating flag
                slider.animating = true;
                slider.animatingTo = target;

                //before() animation Callback
                slider.vars.before(slider);

                //Update label   
                if (slider.vars.label) {
                    slider.label.html(slider.find(".slides img:eq(" + target + ")").attr("alt"));
                }

                //Update number   
                if (slider.vars.number) {
                    slider.number.html((target + 1) + "/" + slider.count);
                }

                //Is the slider at either end
                if (slider.vars.directionNav && !slider.vars.wrap) {
                    if (target == 0) {
                        slider.directionNav.removeClass('disabled').filter('.prev').addClass('disabled');
                    } else if (target == slider.count - 1) {
                        slider.directionNav.removeClass('disabled').filter('.next').addClass('disabled');
                    } else {
                        slider.directionNav.removeClass('disabled');
                    }
                }

                slider.slides.filter(':eq(' + slider.currentSlide + ')').removeClass("active");
                slider.slides.filter(':eq(' + target + ')').addClass("active");

                newPos = 0;
                i = 0;
                slider.find(".slides img").each(function() {
                    if (i < target)
                        newPos += $(this).width();
                    else if (i == target)
                        newPos += $(this).width() / 2;
                    i++;
                });

                newPos -= slider.width() / 2;
                if (newPos < 0 || slider.container.width() < slider.width())
                    newPos = 0;
                else if (newPos > slider.container.width() - slider.width())
                    newPos = slider.container.width() - slider.width();
                newPos *= -1;

                if (slider.animateString == newPos + "px") {
                    slider.wrapup();
                } else {
                    slider.animateString = newPos + "px";
                    slider.ketAnimate(slider.vars.animationDuration);
                }
            }
        }
        //////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////
        // Animate function
        slider.ketAnimate = function(duration) {
            if ($.browser.webkit || $.browser.safari) {
                slider.args["-webkit-transition-duration"] = duration + "ms";
                slider.args["-webkit-transform"] = "translate(" + slider.animateString + ",0) scale(1)";
                slider.args["-webkit-transition-timing-function"] = "cubic-bezier(0.420, 1, 0.580, 1.000)";
                slider.container.css(slider.args).one("webkitTransitionEnd ", function() {
                    slider.wrapup();
                });
            } else if ($.browser.mozilla)
            // Firefox
            {
                slider.args["-moz-transition-duration"] = duration + "ms";
                slider.args["-moz-transform"] = "translate(" + slider.animateString + ",0px) scale(1)";
                slider.args["-moz-transition-timing-function"] = "cubic-bezier(0.420, 1, 0.580, 1.000)";
                slider.container.css(slider.args).one("transitionend", function() {
                    slider.wrapup();
                });
            } else if ($.browser.opera)
            // Opera
            {
                slider.args["-o-transition-duration"] = duration + "ms";
                slider.args["-o-transform"] = "translate(" + slider.animateString + ",0px) scale(1)";
                slider.args["-o-transition-timing-function"] = "cubic-bezier(0.420, 1, 0.580, 1.000)";
                slider.container.css(slider.args).one("oTransitionEnd", function() {
                    slider.wrapup();
                });
            } else {
                slider.container.animate({
                    "marginLeft": slider.animateString
                }, duration, function() {
                    slider.wrapup();
                });
            }
        }
        //////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////
        // Update animating flag and current slide
        slider.wrapup = function() {
            slider.animating = false;
            slider.currentSlide = slider.animatingTo;

            // after animation Callback
            slider.vars.after(slider);
        }
        //////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////
        // Update slider on address change
        slider.addressChange = function() {
            target = $.address.path();
            if (target == "/")
                target = 0;
            else
                target = parseInt(target.substr(1, target.length)) - 1;
            if (target >= 0 && target <= slider.count)
                slider.slideTo(target);
        }
        $.address.change(slider.addressChange);
        //////////////////////////////////////////////////////////////////
        // Initialize KetSlider
        slider.init();
    }

    //KetSlider: Default Settings
    $.ketslider.defaults = {
        //Integer: Set the speed of animations, in milliseconds
        animationDuration: 1000,
        //Boolean: Create navigation for previous/next navigation?
        directionNav: true,
        //Boolean: Allow slider navigating via keyboard left/right keys
        keyboardNav: true,
        //Boolean: Show title (alt text) for each image
        label: true,
        //Boolean: Show current image number and total number of images
        number: true,
        //Boolean: Allow slider navigating with mousewheel
		mousewheel: true,
		//Boolean: Whether to wrap at the first and last items and jump back to the start/end
		wrap: true,
        // Play the slideshow
        slideshow: true,
        //slideshow interval
        slideshowInterval: 5000,
        //Callback: function(slider) - Fires asynchronously with each slider animation
        before: function() {
        },
        //Callback: function(slider) - Fires after each slider animation completes
        after: function() {}
        }

    // Plugin Function
    $.fn.ketslider = function(options) {
        return this.each(function() {
            if ($(this).find('.slides li').length == 1) {
                $(this).find('.slides li img').css({
                    "width": "auto",
                    "height": $(this).height() + "px"
                });
                $(this).find('.slides li').css("visibility", "visible");
            } else if ($(this).data('ketslider') != true) {
                new $.ketslider($(this), options);
            }
        });
    }

})(jQuery);


/*! Copyright (c) 2011 Brandon Aaron (http://brandonaaron.net)
* Licensed under the MIT License (LICENSE.txt).
*
* Thanks to: http://adomas.org/javascript-mouse-wheel/ for some pointers.
* Thanks to: Mathias Bank(http://www.mathias-bank.de) for a scope bug fix.
* Thanks to: Seamus Leahy for adding deltaX and deltaY
*
* Version: 3.0.6
*
* Requires: 1.2.2+
*/

(function($) {

var types = ['DOMMouseScroll', 'mousewheel'];

if ($.event.fixHooks) {
    for ( var i=types.length; i; ) {
        $.event.fixHooks[ types[--i] ] = $.event.mouseHooks;
    }
}

$.event.special.mousewheel = {
    setup: function() {
        if ( this.addEventListener ) {
            for ( var i=types.length; i; ) {
                this.addEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = handler;
        }
    },
    
    teardown: function() {
        if ( this.removeEventListener ) {
            for ( var i=types.length; i; ) {
                this.removeEventListener( types[--i], handler, false );
            }
        } else {
            this.onmousewheel = null;
        }
    }
};

$.fn.extend({
    mousewheel: function(fn) {
        return fn ? this.bind("mousewheel", fn) : this.trigger("mousewheel");
    },
    
    unmousewheel: function(fn) {
        return this.unbind("mousewheel", fn);
    }
});


function handler(event) {
    var orgEvent = event || window.event, args = [].slice.call( arguments, 1 ), delta = 0, returnValue = true, deltaX = 0, deltaY = 0;
    event = $.event.fix(orgEvent);
    event.type = "mousewheel";
    
    // Old school scrollwheel delta
    if ( orgEvent.wheelDelta ) { delta = orgEvent.wheelDelta/120; }
    if ( orgEvent.detail ) { delta = -orgEvent.detail/3; }
    
    // New school multidimensional scroll (touchpads) deltas
    deltaY = delta;
    
    // Gecko
    if ( orgEvent.axis !== undefined && orgEvent.axis === orgEvent.HORIZONTAL_AXIS ) {
        deltaY = 0;
        deltaX = -1*delta;
    }
    
    // Webkit
    if ( orgEvent.wheelDeltaY !== undefined ) { deltaY = orgEvent.wheelDeltaY/120; }
    if ( orgEvent.wheelDeltaX !== undefined ) { deltaX = -1*orgEvent.wheelDeltaX/120; }
    
    // Add event and delta to the front of the arguments
    args.unshift(event, delta, deltaX, deltaY);
    
    return ($.event.dispatch || $.event.handle).apply(this, args);
}

})(jQuery);