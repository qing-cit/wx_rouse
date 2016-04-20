/**
 * main.js
 *
 * Handles scripts.
 */

/*--------------------------*
/* Page Init
/*--------------------------*/
jQuery(function(){
	
  initScrollDim();
  initScrollFade();
  initScrollReveal();
});

jQuery(document).ready(function() {
  
 jQuery(".animsition").animsition({
  
    inClass               :   'fade-in',
    outClass              :   'fade-out',
    inDuration            :    1500,
    outDuration           :    800,
    linkElement           :   '.animsition-link',
    // e.g. linkElement   :   'a:not([target="_blank"]):not([href^=#])'
    loading               :    true,
    loadingParentElement  :   'body', //animsition wrapper element
    loadingClass          :   'animsition-loading',
    unSupportCss          : [ 'animation-duration',
                              '-webkit-animation-duration',
                              '-o-animation-duration'
                            ],
    //"unSupportCss" option allows you to disable the "animsition" in case the css property in the array is not supported by your browser.
    //The default setting is to disable the "animsition" in a browser that does not support "animation-duration".
    
    overlay               :   false,
    
    overlayClass          :   'animsition-overlay-slide',
    overlayParentElement  :   'body'
  });
});

/*--------------------------*
/* Gallery Fade
/*--------------------------*/

jQuery(document).ready(function () {
  jQuery(".slide").fadeImages({
        complete: function () {
            console.log("Fade Images Complete");
        }
    });
});


/*--------------------------*
/* Parallax
/*--------------------------*/

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};

if(isMobile.any()) {
	jQuery('.parallax-section').each(function () {
	jQuery(this).css("background-position", "0");
	jQuery(this).css("background-attachment", "inherit");
});
}
if(!isMobile.any()) {
(function () {
       

       jQuery('.parallax-section').each(function () {
           
           var $el = jQuery(this);
           
           jQuery(window).scroll(function () {
               updateBackground($el);
           });
           updateBackground($el);
       });

   }(jQuery));
}
   var speed = 0.4;

   function updateBackground($el) {

       var diff = jQuery(window).scrollTop() - $el.offset().top;
       var yPos = -(diff * speed);

       var coords = '50% ' + yPos + 'px';

       $el.css({
           backgroundPosition: coords
       });
   }


/*--------------------------*
/* Masonry
/*--------------------------*/


jQuery(window).load(function() {
      if(jQuery('.blog-grid').length) {
     // MASSONRY Without jquery
     var container = document.querySelector('.blog-grid');
     var msnry = new Masonry( container, {
       itemSelector: '.col',
       columnWidth: '.col',                
     });  
 }
       });
	 
	   
/*--------------------------*
/* Header Parallax
/*--------------------------*/

function StackParallax() {
	if ( jQuery(window).innerWidth() > 667 ) {
	scrollPos = jQuery(this).scrollTop();
	jQuery('#stack-banner, .parallax').css({
		'background-position' : '50% ' + (-scrollPos/6)+"px"
	});
	
	jQuery('#bannertext').css({
		'margin-top': (scrollPos/4)+"px",
		'opacity': 1-(scrollPos/600)
	});
}
}
if(isMobile.any()) {
	jQuery('#stack-banner').each(function () {
	jQuery(this).css("background-position", "0");
	jQuery(this).css("background-attachment", "inherit");
	jQuery('#bannertext').css({
		//'margin-top': "96px",
		'position': "relative"
	});
});
}
if(!isMobile.any()) {
jQuery(document).ready(function(){
	jQuery(window).scroll(function() {
		StackParallax();
	});
	
});
}

if(jQuery('#stack-banner').length) {
	jQuery('.banner').hide();
}

if (jQuery('#stack-banner').length) {
	
	 var hero_height  = jQuery(window).height();
 }
 
else {
	var hero_height   = jQuery('.banner').height();
 }
var $root          = jQuery('html'),
    $nav_header    = jQuery('.header-banner-top .main-navigation'),
    $navicon       = jQuery('[data-navicon="button"]'),


    header_height  = jQuery('.header-banner-top .main-navigation').height() - 20,

    offset_val     = hero_height - header_height,
    eventType      = ((document.ontouchstart !== null) ? 'click' : 'touchstart');

    jQuery('.banner').css("padding-top", header_height);

/*--------------------------*
/* Sticky Nav
/*--------------------------*/
	
function navSlide() {
var scroll_top = jQuery(window).scrollTop();
if ( jQuery(window).innerWidth() > 718 ) {
if (scroll_top >= offset_val) {
  $nav_header.addClass('is-sticky');
  } else {
    $nav_header.removeClass('is-sticky');
  }
}
}

/*--------------------------*
/* Anchor Scroll
/*--------------------------*/

function anchorScroll(event) {
  var id     = jQuery(this).attr("href"),
      offset = header_height,
      target = jQuery(id).offset().top - offset;

  jQuery('html, body').animate({
    scrollTop: target
  }, 500);

  event.preventDefault();
}


jQuery('.scrollto').on(eventType, function() {
  anchorScroll.call(this, event);
});

jQuery(window).scroll(navSlide);

function initScrollDim() {
jQuery(window).scroll(function(){
	if ( jQuery(window).innerWidth() > 600 ) {
    var scrollVar = jQuery(window).scrollTop();
	jQuery('.stack-header-overlay').css('opacity', .6 + (jQuery(window).scrollTop()) / ((jQuery(window).height())*1.8) );
}
});
}
if ( jQuery(window).innerWidth() < 718 ) {
	jQuery('.menu-item-has-children > a').on('click', function(e) {
	      jQuery(this).next('.sub-menu').toggleClass("pressed"); 
	      e.preventDefault();
	    });
}


/*--------------------------*
/* Modals
/*--------------------------*/
 

var Modal = (function() {

  var trigger = $qsa('.modal__trigger'); // what you click to activate the modal
  var modals = $qsa('.modal'); // the entire modal (takes up entire window)
  var modalsbg = $qsa('.modal__bg'); // the entire modal (takes up entire window)
  var content = $qsa('.modal__content'); // the inner content of the modal
	var closers = $qsa('.modal__close'); // an element used to close the modal
  var w = window;
  var isOpen = false;
	var contentDelay = 400; // duration after you click the button and wait for the content to show
  var len = trigger.length;

  // make it easier for yourself by not having to type as much to select an element
  function $qsa(el) {
    return document.querySelectorAll(el);
  }

  var getId = function(event) {

    event.preventDefault();
    var self = this;
    // get the value of the data-modal attribute from the button
    //var modalId = self.dataset.modal;
	 var modalId = self.getAttribute('data-modal');
    var len = modalId.length;
    // remove the '#' from the string
    var modalIdTrimmed = modalId.substring(1, len);
    // select the modal we want to activate
    var modal = document.getElementById(modalIdTrimmed);
    // execute function that creates the temporary expanding div
    makeDiv(self, modal);
  };

  var makeDiv = function(self, modal) {

    var fakediv = document.getElementById('modal__temp');
	
    /**
     * if there isn't a 'fakediv', create one and append it to the button that was
     * clicked. after that execute the function 'moveTrig' which handles the animations.
     */

    if (fakediv === null) {
      var div = document.createElement('div');
      div.id = 'modal__temp';
      self.appendChild(div);
      moveTrig(self, modal, div);
    }
  };
  
  var moveTrig = function(trig, modal, div) {
    var trigProps = trig.getBoundingClientRect();
    var m = modal;
    var mProps = m.querySelector('.modal__content').getBoundingClientRect();
    var transX, transY, scaleX, scaleY;
    var xc = w.innerWidth / 2;
    var yc = w.innerHeight / 2;

    // this class increases z-index value so the button goes overtop the other buttons
    trig.classList.add('modal__trigger--active');

    // these values are used for scale the temporary div to the same size as the modal
    scaleX = mProps.width / trigProps.width;
    scaleY = mProps.height / trigProps.height;

    scaleX = scaleX.toFixed(3); // round to 3 decimal places
    scaleY = scaleY.toFixed(3);


    // these values are used to move the button to the center of the window
    transX = Math.round(xc - trigProps.left - trigProps.width / 2);
    transY = Math.round(yc - trigProps.top - trigProps.height / 2);

		// if the modal is aligned to the top then move the button to the center-y of the modal instead of the window
    if (m.classList.contains('modal--align-top')) {
      transY = Math.round(mProps.height / 2 + mProps.top - trigProps.top - trigProps.height / 2);
    }


		// translate button to center of screen
		trig.style.transform = 'translate(' + transX + 'px, ' + transY + 'px)';
		trig.style.webkitTransform = 'translate(' + transX + 'px, ' + transY + 'px)';
		// expand temporary div to the same size as the modal
		div.style.transform = 'scale(' + scaleX + ',' + scaleY + ')';
		div.style.webkitTransform = 'scale(' + scaleX + ',' + scaleY + ')';


		window.setTimeout(function() {
			window.requestAnimationFrame(function() {
				open(m, div);
			});
		}, contentDelay);

  };

  var open = function(m, div) {

    if (!isOpen) {
      // select the content inside the modal
      var content = m.querySelector('.modal__content');
      // reveal the modal
      m.classList.add('modal--active');
      // reveal the modal content
      content.classList.add('modal__content--active');

      /**
       * when the modal content is finished transitioning, fadeout the temporary
       * expanding div so when the window resizes it isn't visible ( it doesn't
       * move with the window).
       */

      content.addEventListener('transitionend', hideDiv, false);

      isOpen = true;
    }

    function hideDiv() {
      // fadeout div so that it can't be seen when the window is resized
      div.style.opacity = '0';
      content.removeEventListener('transitionend', hideDiv, false);
    }
  };

  var close = function(event) {

		

    var target = event.target;
    var div = document.getElementById('modal__temp');

    /**
     * make sure the modal__bg or modal__close was clicked, we don't want to be able to click
     * inside the modal and have it close.
     */

    if (isOpen && target.classList.contains('modal__bg') || target.classList.contains('modal__close')) {

      // make the hidden div visible again and remove the transforms so it scales back to its original size
      div.style.opacity = '1';
      div.removeAttribute('style');

			/**
			* iterate through the modals and modal contents and triggers to remove their active classes.
      * remove the inline css from the trigger to move it back into its original position.
			*/

			for (var i = 0; i < len; i++) {
				modals[i].classList.remove('modal--active');
				content[i].classList.remove('modal__content--active');
				trigger[i].style.transform = 'none';
        trigger[i].style.webkitTransform = 'none';
				trigger[i].classList.remove('modal__trigger--active');
			}

      // when the temporary div is opacity:1 again, we want to remove it from the dom
			div.addEventListener('transitionend', removeDiv, false);
	
      isOpen = false;
	  
	event.preventDefault();
  event.stopImmediatePropagation();
  

    }

    function removeDiv() {
      setTimeout(function() {
        window.requestAnimationFrame(function() {
          // remove the temp div from the dom with a slight delay so the animation looks good
          jQuery(div).remove();
        });
      }, contentDelay - 50);
    }

  };

  var bindActions = function() {
    for (var i = 0; i < len; i++) {
      trigger[i].addEventListener('click', getId, false);
      closers[i].addEventListener('click', close, false);
      modalsbg[i].addEventListener('click', close, false);
    }
  };

  var init = function() {
    bindActions();
  };

  return {
    init: init
  };

}());

Modal.init();

jQuery(document).ready(function(){
  jQuery(".modal__trigger").click(function(){
    var $c=jQuery(this).css("background-color");
    jQuery("#modal__temp").css("background-color",$c);
  });
});



/*--------------------------*
/* POI
/*--------------------------*/

jQuery(document).ready(function($){
	//open interest point description
	$('.stack-single-point').children('a').on('click', function(){
		var selectedPoint = $(this).parent('li');
		if( selectedPoint.hasClass('is-open') ) {
			selectedPoint.removeClass('is-open').addClass('visited');
		} else {
			selectedPoint.addClass('is-open').siblings('.stack-single-point.is-open').removeClass('is-open').addClass('visited');
		}
	});
	//close interest point description
	$('.stack-close-info').on('click', function(event){
		event.preventDefault();
		$(this).parents('.stack-single-point').eq(0).removeClass('is-open').addClass('visited');
	});

	//on desktop, switch from product intro div to product mockup div
	$('#stack-start').on('click', function(event){
		event.preventDefault();
		//detect the CSS media query using .stack-product-intro::before content value
		var mq = window.getComputedStyle(document.querySelector('.stack-product-intro'), '::before').getPropertyValue('content');
		if(mq == 'mobile') {
			$('body,html').animate({'scrollTop': $($(this).attr('href')).offset().top }, 200); 
		} else {
			$('.stack-product').addClass('is-product-tour').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('.stack-close-product-tour').addClass('is-visible');
				$('.stack-points-container').addClass('points-enlarged').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
					$(this).addClass('points-pulsing');
				});
			});
		}
	});
	//on desktop, switch from product mockup div to product intro div
	$('.stack-close-product-tour').on('click', function(){
		$('.stack-product').removeClass('is-product-tour');
		$('.stack-close-product-tour').removeClass('is-visible');
		$('.stack-points-container').removeClass('points-enlarged points-pulsing');
	});
	 $('.stack-expand__card').toggleClass('active');
	function googleExpandoToggle() {
	  $(this).toggleClass('active');
	  $(this).next().toggleClass('active');
	  }

      $('.stack-single-point').children('a').on('click', function(){
	  googleExpandoToggle.call(this);
	});
	// For each .box element
  $('.stack-product-mockup').each(function() {
    // Set up the variables
    var $this = $(this),
        w = $this.find('img').width(), // Width of the image inside .box
        h = $this.find('img').height(); // Height of the image inside .box
    $this.width(w); // Set width and height of .box to match image
  });
});

jQuery(document).on('ready', start);
  // Gallery preview
  function start(){
    jQuery('.gallery img').on('click', openFull);
    jQuery('#stack-preview').on('click', closeFull);
  }
  //
  function openFull(){
    var number = jQuery(this).attr('src'),
        direction = number;
    
    jQuery('#imgFull img').attr('src', direction);
    jQuery('#stack-preview').fadeIn();
  }

function closeFull(){
  jQuery('#stack-preview').fadeOut();
}

/*--------------------------*
/* Testimonials
/*--------------------------*/

if(jQuery('.testimonial').length) {
var testimonials = {};

testimonials.slider = (function(){
	
  var currentItemIndex = 0,
      prevBtn = jQuery('.prev-testimonial'),
      nextBtn = jQuery('.next-testimonial'),
      items = (function(){
        var items = [];
        jQuery('.inner.testimonial').each(function(){
          items.push(jQuery(this));
        });
        return items;
      })();
  
  function getCurrent(){
    jQuery('.inner.testimonial').each(function(index){
      jQuery(this).removeClass('current');
    });
    jQuery('.inner.testimonial').eq(currentItemIndex).addClass('current');
  }
  
  function greyOut(prevBtn, nextBtn){
    if(jQuery(prevBtn).hasClass('grey-out')){
      jQuery(prevBtn).removeClass('grey-out');
    }
    if(jQuery(nextBtn).hasClass('grey-out')){
      jQuery(nextBtn).removeClass('grey-out');
    }
    if(currentItemIndex == 0){
      jQuery(prevBtn).addClass('grey-out');
    }
    if(currentItemIndex == items.length -1){
      jQuery(nextBtn).addClass('grey-out');
    }
  }

  	return{
    init: function(prevBtn, nextBtn){
      items[currentItemIndex].addClass('current');
      greyOut(prevBtn, nextBtn);
      jQuery(prevBtn).click(function(){
        if(currentItemIndex > 0){
          currentItemIndex--;
        }
        getCurrent();
        greyOut(prevBtn, nextBtn);
      });
      jQuery(nextBtn).click(function(){
        if(currentItemIndex < items.length - 1){
          currentItemIndex++;
        }
        getCurrent();
        greyOut(prevBtn, nextBtn);
      });
    }
  };

})();

testimonials.slider.init('.prev-testimonial', '.next-testimonial');
 }

/*--------------------------*
/* Accordions
/*--------------------------*/

(function($) {
    $('.accordion > li:eq(0) a').addClass('active').next().slideDown();

    $('.accordion a').click(function(j) {
        var dropDown = $(this).closest('li').find('p');

        $(this).closest('.accordion').find('p').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('a.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
})(jQuery);


/*--------------------------*
/* Device Switcher
/*--------------------------*/

(function($) {

  function setDevice(device) { 
    deviceNs = device ? "device--" + device : "";
    containerNs = device ? "container--" + device : "";
	
    $(".device").removeClass().addClass("device " + deviceNs);
    $(".container").removeClass().addClass("container " + containerNs);
	
  };
  
  $(".nav").on("click", "a", function(e) {
    e.preventDefault();
    setDevice($(e.target).data("device"));
  });
  
  $(window).on("keyup", function(e) {
    switch(e.keyCode) {
      case 49 :
        setDevice();
        break;
      case 50 :
        setDevice("tablet-mini");
        break;
      case 51 :
        setDevice("tablet");
        break;
      case 52 :
        setDevice("browser");
        break;
    }
  });
  
  function setbackground(background) { 
	
    $(".device__content").css('background-image','url(' + background + ')');
	
  };
  
  $(".nav").on("click", "a", function(e) {
    e.preventDefault();
    setbackground($(e.target).data("background"));
  });
  
  $(window).on("keyup", function(e) {
    switch(e.keyCode) {
      case 49 :
        setbackground();
        break;
      case 50 :
        setbackground("ipad-mini");
        break;
      case 51 :
        setbackground("ipad");
        break;
      case 52 :
        setbackground("browser");
        break;
    }
  });
  
})(jQuery);

/*--------------------------*
/* Header Slider
/*--------------------------*/
	
(function ($) {
    $.fn.fadeImages = function (options) {
        var opt = $.extend({
            time: 3000,              
            fade: 1000,                 
            dots: false,               
            complete:function(){}    
        }, options);
        var t = parseInt(opt.time), f = parseInt(opt.fade), d = opt.dots, i = 0, j = 0, k, l, m, set,cb=opt.complete;
        m = $(this).find("ul li");
        m.hide();
        l = m.length;
        if(l<=0){
            return false;
        }
        if (d) {
            $(this).append("<ol id='dots'></ol>");
            for (j = 0; j < l; j++) {
                $(this).find("ol").append("<li>" + (j + 1) + "</li>");
            }
            $(this).find("ol li").eq(0).addClass("active");
        }
       
        show(0);
       
        function show(i) {
            m.eq(i).addClass("curr").css("z-index",2).stop(true,true).fadeIn(f,cb);
            m.eq(i).siblings().css("z-index",1).removeClass("curr").stop(true,true).fadeOut(f);
        }

       
        function dots(i) {
            $("ol#dots li").eq(i).addClass("active").siblings().removeClass();
        }

       
        function play() {
            if (i++ < l - 1) {
                set = setTimeout(function () {
                    show(i);
                    dots(i);
                    play();
                }, t + f)
            }
            else {
                i = -1;
                play();
            }
        }

        play();
        
        m.hover(function () {
            clearTimeout(set);
            k = i;
        }, function () {
            i = k - 1;
            play();
        });
       
        if (d) {
            $(this).on("click", "ol#dots li", function () {
                i = $(this).index();
                dots(i);
                show(i);
            })
        }
        return this;
    }
}(jQuery));

/*--------------------------*
/* Scroll to Top
/*--------------------------*/

jQuery(document).ready(function($){
	// browser window scroll (in pixels) after which the "back to top" link is shown
	var offset = 1200,
		//browser window scroll (in pixels) after which the "back to top" link opacity is reduced
		offset_opacity = 1200,
		//duration of the top scrolling animation (in ms)
		scroll_top_duration = 700,
		//grab the "back to top" link
		$back_to_top = $('.cd-top');

	//hide or show the "back to top" link
	$(window).scroll(function(){
		( $(this).scrollTop() > offset ) ? $back_to_top.addClass('cd-is-visible') : $back_to_top.removeClass('cd-is-visible cd-fade-out');
		if( $(this).scrollTop() > offset_opacity ) { 
			$back_to_top.addClass('cd-fade-out');
		}
	});

	

}(jQuery));

/* SmoothScroll */

jQuery(document).ready(function() {
   jQuery('a[href*=#]').bind('click', function(e) {
       
	var target = $=jQuery(this).attr("href");
	if ( jQuery(window).innerWidth() < 718 ) { 
		var offset  = jQuery('.header-banner-top .main-navigation').height() - 500;
	}
	else {
	var offset  = jQuery('.header-banner-top .main-navigation').height() - 20;
    }
	jQuery('html, body').stop().animate({ scrollTop: jQuery(target).offset().top - offset}, 500, function() {
	     //location.hash = target;  //attach the hash (#jumptarget) to the pageurl
	});
			
	return false;
   });
  
});


if (!jQuery('body').hasClass("home")) {
	var templateDir = SiteParameters.site_url;
	jQuery('.menu-main-container ul li a[href*="#"]').each(function() {
		var anchor = jQuery(this).attr("href");
		jQuery(this).attr("href", templateDir+'/'+anchor)
	});
}

/*--------------------------*
/* Scroll Fade
/*--------------------------*/

function initScrollFade() {
var $window = jQuery(window);
var scrollFade = function ($element, friction, offset) {
  friction  = (friction  === undefined)? 0.5 : friction;
  offset = (offset === undefined)? 0 : offset;

  var parentHeight = $element.parent().outerHeight() * 0.5;
  var previousOpacity = Infinity;

  $window.scroll(function() {
    var scrollTop = Math.max(0, $window.scrollTop())
      , yOffset   = ($element.outerHeight() * -0.5) + scrollTop * friction
      , opacity   = 1 - (scrollTop / parentHeight - (parentHeight * offset))

    if (opacity < 0 && previousOpacity < 0) return;

    $element.css({
	  '-webkit-transform' : 'translate3d(0px,'+ yOffset +'px, 0)',
      '-moz-transform'    : 'translate3d(0px,'+ yOffset +'px, 0)',
      '-ms-transform'     : 'translate3d(0px,'+ yOffset +'px, 0)',
      '-o-transform'      : 'translate3d(0px,'+ yOffset +'px, 0)',
      'transform' : 'translate3d(0px,'+ yOffset +'px, 0)',
	  opacity: opacity
    });

    previousOpacity = opacity;
  });
}

scrollFade(jQuery('.banner .primary-wrapper')
  , 0.5  // Friction (0 ~ 1): lower = none
  , 0    // Fade duration (0 ~ 1): lower = longer
);
}

/*--------------------------*
/* Scroll Reveal
/*--------------------------*/

function initScrollReveal() {
	
	var config = {
	        vFactor: 0.20,
	      }
		   if(window.pageYOffset<2) {
window.sr = new scrollReveal(config);
}
}

jQuery(document).ready(function() { jQuery(".menu-main-container ul").iosnavfix(); });
;(function(w, $) {  

    $.fn.iosnavfix = function() {

        return this.each(function() {

            if ( isIos() ) {
                var $this = $(this);

                $("> li", $this).each(function() {
                    var $this       = $(this);
                    var $parentLink = $("> a", $this);

                    // If we have children
                    if ($this.children('ul').length || $this.children('ol').length) {

                        // Set default clicked state
                        $parentLink.data('clicked', false);

                        // When the link is clicked
                        $parentLink.on("click", function(e) {

                            // if we haven't already clicked, false
                            if ($parentLink.data('clicked') == false) {
                                // Inform everyone we've now clicked
                                $parentLink.data('clicked', true);

                                // Prevent link being followed into next click
                                return false;
                            } else {
                                // Reset link click state
                                $parentLink.data('clicked', false);

                                // Allow link to be followed now
                                return true;
                            }

                        });
                    }
                });
            }

        });

        /** 
         * If a user is pretending to be an iOS device, too bad for them.
         * As if you would imitate an iPad or iPhone for non-testing purposes.
         *
         * Anyway, this function will detect iOS user agents, simple.
         */
        function isIos() {
            if ( (navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i) ) || (navigator.userAgent.match(/iPad/i))) { return true; } else { return false; }
        }

    }

})(window, jQuery);


/*!
 * animsition v3.6.0
 * A simple and easy jQuery plugin for CSS animated page transitions.
 * http://blivesta.github.io/animsition
 * License : MIT
 * Author : blivesta (http://blivesta.com/)
 */
!function(n){"use strict";"function"==typeof define&&define.amd?define(["jquery"],n):"object"==typeof exports?module.exports=n(require("jquery")):n(jQuery)}(function(n){"use strict";var a="animsition",i={init:function(t){t=n.extend({inClass:"fade-in",outClass:"fade-out",inDuration:1500,outDuration:800,linkElement:".animsition-link",loading:!0,loadingParentElement:"body",loadingClass:"animsition-loading",unSupportCss:["animation-duration","-webkit-animation-duration","-o-animation-duration"],overlay:!1,overlayClass:"animsition-overlay-slide",overlayParentElement:"body"},t);var o=i.supportCheck.call(this,t);if(!o&&t.unSupportCss.length>0&&(!o||!this.length))return"console"in window||(window.console={},window.console.log=function(n){return n}),this.length||console.log("Animsition: Element does not exist on page."),o||console.log("Animsition: Does not support this browser."),i.destroy.call(this);var e=i.optionCheck.call(this,t);return e&&i.addOverlay.call(this,t),t.loading&&i.addLoading.call(this,t),this.each(function(){var o=this,e=n(this),s=n(window),l=e.data(a);l||(t=n.extend({},t),e.data(a,{options:t}),s.on("load."+a+" pageshow."+a,function(){i.pageIn.call(o)}),s.on("unload."+a,function(){}),n(t.linkElement).on("click."+a,function(a){a.preventDefault();var t=n(this),e=t.attr("href");2===a.which||a.metaKey||a.shiftKey||-1!==navigator.platform.toUpperCase().indexOf("WIN")&&a.ctrlKey?window.open(e,"_blank"):i.pageOut.call(o,t,e)}))})},addOverlay:function(a){n(a.overlayParentElement).prepend('<div class="'+a.overlayClass+'"></div>')},addLoading:function(a){n(a.loadingParentElement).append('<div class="'+a.loadingClass+'"></div>')},removeLoading:function(){var i=n(this),t=i.data(a).options,o=n(t.loadingParentElement).children("."+t.loadingClass);o.fadeOut().remove()},supportCheck:function(a){var i=n(this),t=a.unSupportCss,o=t.length,e=!1;0===o&&(e=!0);for(var s=0;o>s;s++)if("string"==typeof i.css(t[s])){e=!0;break}return e},optionCheck:function(a){var i,t=n(this);return i=a.overlay||t.data("animsition-overlay")?!0:!1},animationCheck:function(i,t,o){var e=n(this),s=e.data(a).options,l=typeof i,r=!t&&"number"===l,c=t&&"string"===l&&i.length>0;return r||c?i=i:t&&o?i=s.inClass:!t&&o?i=s.inDuration:t&&!o?i=s.outClass:t||o||(i=s.outDuration),i},pageIn:function(){var t=this,o=n(this),e=o.data(a).options,s=o.data("animsition-in-duration"),l=o.data("animsition-in"),r=i.animationCheck.call(t,s,!1,!0),c=i.animationCheck.call(t,l,!0,!0),d=i.optionCheck.call(t,e);e.loading&&i.removeLoading.call(t),d?i.pageInOverlay.call(t,c,r):i.pageInBasic.call(t,c,r)},pageInBasic:function(a,i){var t=n(this);t.trigger("animsition.start").css({"animation-duration":i/1e3+"s"}).addClass(a).animateCallback(function(){t.removeClass(a).css({opacity:1}).trigger("animsition.end")})},pageInOverlay:function(i,t){var o=n(this),e=o.data(a).options;o.trigger("animsition.start").css({opacity:1}),n(e.overlayParentElement).children("."+e.overlayClass).css({"animation-duration":t/1e3+"s"}).addClass(i).animateCallback(function(){o.trigger("animsition.end")})},pageOut:function(t,o){var e=this,s=n(this),l=s.data(a).options,r=t.data("animsition-out"),c=s.data("animsition-out"),d=t.data("animsition-out-duration"),u=s.data("animsition-out-duration"),m=r?r:c,h=d?d:u,p=i.animationCheck.call(e,m,!0,!1),f=i.animationCheck.call(e,h,!1,!1),g=i.optionCheck.call(e,l);g?i.pageOutOverlay.call(e,p,f,o):i.pageOutBasic.call(e,p,f,o)},pageOutBasic:function(a,i,t){var o=n(this);o.css({"animation-duration":i/1e3+"s"}).addClass(a).animateCallback(function(){location.href=t})},pageOutOverlay:function(t,o,e){var s=this,l=n(this),r=l.data(a).options,c=l.data("animsition-in"),d=i.animationCheck.call(s,c,!0,!0);n(r.overlayParentElement).children("."+r.overlayClass).css({"animation-duration":o/1e3+"s"}).removeClass(d).addClass(t).animateCallback(function(){location.href=e})},destroy:function(){return this.each(function(){var i=n(this);n(window).unbind("."+a),i.css({opacity:1}).removeData(a)})}};n.fn.animateCallback=function(a){var i="animationend webkitAnimationEnd mozAnimationEnd oAnimationEnd MSAnimationEnd";return this.each(function(){n(this).bind(i,function(){return n(this).unbind(i),a.call(this)})})},n.fn.animsition=function(t){return i[t]?i[t].apply(this,Array.prototype.slice.call(arguments,1)):"object"!=typeof t&&t?void n.error("Method "+t+" does not exist on jQuery."+a):i.init.apply(this,arguments)}});

!function(e,t){"function"==typeof define&&define.amd?define(t):"object"==typeof exports?module.exports=t(require,exports,module):e.scrollReveal=t()}(this,function(){return window.scrollReveal=function(e){"use strict";function t(i){return this instanceof t?(r=this,r.elems={},r.serial=1,r.blocked=!1,r.config=o(r.defaults,i),r.isMobile()&&!r.config.mobile||!r.isSupported()?void r.destroy():(r.config.viewport===e.document.documentElement?(e.addEventListener("scroll",a,!1),e.addEventListener("resize",a,!1)):r.config.viewport.addEventListener("scroll",a,!1),void r.init(!0))):new t(i)}var i,o,a,r;return t.prototype={defaults:{enter:"bottom",move:"8px",over:"0.6s",wait:"0s",easing:"ease",scale:{direction:"up",power:"5%"},rotate:{x:0,y:0,z:0},opacity:0,mobile:!1,reset:!1,viewport:e.document.documentElement,delay:"once",vFactor:.6,complete:function(){}},init:function(e){var t,i,o;o=Array.prototype.slice.call(r.config.viewport.querySelectorAll("[data-sr]")),o.forEach(function(e){t=r.serial++,i=r.elems[t]={domEl:e},i.config=r.configFactory(i),i.styles=r.styleFactory(i),i.seen=!1,e.removeAttribute("data-sr"),e.setAttribute("style",i.styles.inline+i.styles.initial)}),r.scrolled=r.scrollY(),r.animate(e)},animate:function(e){function t(e){var t=r.elems[e];setTimeout(function(){t.domEl.setAttribute("style",t.styles.inline),t.config.complete(t.domEl),delete r.elems[e]},t.styles.duration)}var i,o,a;for(i in r.elems)r.elems.hasOwnProperty(i)&&(o=r.elems[i],a=r.isElemInViewport(o),a?("always"===r.config.delay||"onload"===r.config.delay&&e||"once"===r.config.delay&&!o.seen?o.domEl.setAttribute("style",o.styles.inline+o.styles.target+o.styles.transition):o.domEl.setAttribute("style",o.styles.inline+o.styles.target+o.styles.reset),o.seen=!0,o.config.reset||o.animating||(o.animating=!0,t(i))):!a&&o.config.reset&&o.domEl.setAttribute("style",o.styles.inline+o.styles.initial+o.styles.reset));r.blocked=!1},configFactory:function(e){var t={},i={},a=e.domEl.getAttribute("data-sr").split(/[, ]+/);return a.forEach(function(e,i){switch(e){case"enter":t.enter=a[i+1];break;case"wait":t.wait=a[i+1];break;case"move":t.move=a[i+1];break;case"ease":t.move=a[i+1],t.ease="ease";break;case"ease-in":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="ease-in";break}t.move=a[i+1],t.easing="ease-in";break;case"ease-in-out":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="ease-in-out";break}t.move=a[i+1],t.easing="ease-in-out";break;case"ease-out":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="ease-out";break}t.move=a[i+1],t.easing="ease-out";break;case"hustle":if("up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2],t.easing="cubic-bezier( 0.6, 0.2, 0.1, 1 )";break}t.move=a[i+1],t.easing="cubic-bezier( 0.6, 0.2, 0.1, 1 )";break;case"over":t.over=a[i+1];break;case"flip":case"pitch":t.rotate=t.rotate||{},t.rotate.x=a[i+1];break;case"spin":case"yaw":t.rotate=t.rotate||{},t.rotate.y=a[i+1];break;case"roll":t.rotate=t.rotate||{},t.rotate.z=a[i+1];break;case"reset":t.reset="no"==a[i-1]?!1:!0;break;case"scale":if(t.scale={},"up"==a[i+1]||"down"==a[i+1]){t.scale.direction=a[i+1],t.scale.power=a[i+2];break}t.scale.power=a[i+1];break;case"vFactor":case"vF":t.vFactor=a[i+1];break;case"opacity":t.opacity=a[i+1];break;default:return}}),i=o(i,r.config),i=o(i,t),"top"===i.enter||"bottom"===i.enter?i.axis="Y":("left"===i.enter||"right"===i.enter)&&(i.axis="X"),("top"===i.enter||"left"===i.enter)&&(i.move="-"+i.move),i},styleFactory:function(e){function t(){0!==parseInt(s.move)&&(o+=" translate"+s.axis+"("+s.move+")",r+=" translate"+s.axis+"(0)"),0!==parseInt(s.scale.power)&&("up"===s.scale.direction?s.scale.value=1-.01*parseFloat(s.scale.power):"down"===s.scale.direction&&(s.scale.value=1+.01*parseFloat(s.scale.power)),o+=" scale("+s.scale.value+")",r+=" scale(1)"),s.rotate.x&&(o+=" rotateX("+s.rotate.x+")",r+=" rotateX(0)"),s.rotate.y&&(o+=" rotateY("+s.rotate.y+")",r+=" rotateY(0)"),s.rotate.z&&(o+=" rotateZ("+s.rotate.z+")",r+=" rotateZ(0)"),o+="; opacity: "+s.opacity+"; ",r+="; opacity: 1; "}var i,o,a,r,n,s=e.config,c=1e3*(parseFloat(s.over)+parseFloat(s.wait));return i=e.domEl.getAttribute("style")?e.domEl.getAttribute("style")+"; visibility: visible; ":"visibility: visible; ",n="-webkit-transition: -webkit-transform "+s.over+" "+s.easing+" "+s.wait+", opacity "+s.over+" "+s.easing+" "+s.wait+"; transition: transform "+s.over+" "+s.easing+" "+s.wait+", opacity "+s.over+" "+s.easing+" "+s.wait+"; -webkit-perspective: 1000;-webkit-backface-visibility: hidden;",a="-webkit-transition: -webkit-transform "+s.over+" "+s.easing+" 0s, opacity "+s.over+" "+s.easing+" 0s; transition: transform "+s.over+" "+s.easing+" 0s, opacity "+s.over+" "+s.easing+" 0s; -webkit-perspective: 1000; -webkit-backface-visibility: hidden; ",o="transform:",r="transform:",t(),o+="-webkit-transform:",r+="-webkit-transform:",t(),{transition:n,initial:o,target:r,reset:a,inline:i,duration:c}},getViewportH:function(){var t=r.config.viewport.clientHeight,i=e.innerHeight;return r.config.viewport===e.document.documentElement&&i>t?i:t},scrollY:function(){return r.config.viewport===e.document.documentElement?e.pageYOffset:r.config.viewport.scrollTop+r.config.viewport.offsetTop},getOffset:function(e){var t=0,i=0;do isNaN(e.offsetTop)||(t+=e.offsetTop),isNaN(e.offsetLeft)||(i+=e.offsetLeft);while(e=e.offsetParent);return{top:t,left:i}},isElemInViewport:function(t){function i(){var e=n+a*c,t=s-a*c,i=r.scrolled+r.getViewportH(),o=r.scrolled;return i>e&&t>o}function o(){var i=t.domEl,o=i.currentStyle||e.getComputedStyle(i,null);return"fixed"===o.position}var a=t.domEl.offsetHeight,n=r.getOffset(t.domEl).top,s=n+a,c=t.config.vFactor||0;return i()||o()},isMobile:function(){var t=navigator.userAgent||navigator.vendor||e.opera;return/(ipad|playbook|silk|android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(t)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(t.substr(0,4))?!0:!1},isSupported:function(){for(var e=document.createElement("sensor"),t="Webkit,Moz,O,".split(","),i=("transition "+t.join("transition,")).split(","),o=0;o<i.length;o++)if(""===!e.style[i[o]])return!1;return!0},destroy:function(){var e=r.config.viewport,t=Array.prototype.slice.call(e.querySelectorAll("[data-sr]"));t.forEach(function(e){e.removeAttribute("data-sr")})}},a=function(){r.blocked||(r.blocked=!0,r.scrolled=r.scrollY(),i(function(){r.animate()}))},o=function(e,t){for(var i in t)t.hasOwnProperty(i)&&(e[i]=t[i]);return e},i=function(){return e.requestAnimationFrame||e.webkitRequestAnimationFrame||e.mozRequestAnimationFrame||function(t){e.setTimeout(t,1e3/60)}}(),t}(window),scrollReveal});