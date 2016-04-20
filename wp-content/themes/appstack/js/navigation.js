/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */

/*--------------------------*
/* Page Init
/*--------------------------*/
jQuery(function(){
	
  initScrollDim();

});
jQuery(document).ready(function () {
  jQuery(".slide").fadeImages({
        complete: function () {
            console.log("Fade Images Complete");
        }
    });
});
(function () {
       

       jQuery('.parallax-section').each(function () {
           
           var $el = jQuery(this);
           
           jQuery(window).scroll(function () {
               updateBackground($el);
           });
           updateBackground($el);
       });

   }(jQuery));

   var speed = 0.4;

   function updateBackground($el) {

       var diff = jQuery(window).scrollTop() - $el.offset().top;
       var yPos = -(diff * speed);

       var coords = '50% ' + yPos + 'px';

       $el.css({
           backgroundPosition: coords
       });
   }



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
      transform: 'translate3d(0px,'+ yOffset +'px, 0)',
      opacity: opacity
    });

    previousOpacity = opacity;
  });
}

scrollFade(jQuery('.banner .primary-wrapper')
  , 0.5  // Friction (0 ~ 1): lower = none
  , 0    // Fade duration (0 ~ 1): lower = longer
);


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
	 
	   


function StackParallax() {
	scrollPos = jQuery(this).scrollTop();
	jQuery('#stack-banner, .parallax').css({
		'background-position' : '50% ' + (-scrollPos/6)+"px"
	});
	
	jQuery('#bannertext').css({
		'margin-top': (scrollPos/4)+"px",
		'opacity': 1-(scrollPos/600)
	});
}
jQuery(document).ready(function(){
	jQuery(window).scroll(function() {
		StackParallax();
	});
});

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
// Methods
// =================================================

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

function anchorScroll(event) {
  var id     = jQuery(this).attr("href"),
      offset = header_height,
      target = jQuery(id).offset().top - offset;

  jQuery('html, body').animate({
    scrollTop: target
  }, 500);

  event.preventDefault();
}


// Handlers
// =================================================

jQuery('.scrollto').on(eventType, function() {
  anchorScroll.call(this, event);
});

jQuery(window).scroll(navSlide);

function initScrollDim() {
jQuery(window).scroll(function(){
	if ( jQuery(window).innerWidth() > 600 ) {
    var scrollVar = jQuery(window).scrollTop();
	jQuery('.stack-header-overlay').css('opacity', .3 + (jQuery(window).scrollTop()) / ((jQuery(window).height())*1.2) );
}
});
}
if ( jQuery(window).innerWidth() < 718 ) {
	jQuery('.menu-item-has-children > a').on('click', function(e) {
	      jQuery(this).next('.sub-menu').toggleClass("pressed"); 
	      e.preventDefault();
	    });
}


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
    var modalId = self.dataset.modal;
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
          div.remove();
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
    $this.width(w).height(h); // Set width and height of .box to match image
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

/* SmoothScroll */

jQuery(document).ready(function() {
   jQuery('a[href*=#]').bind('click', function(e) {
	//e.preventDefault(); //prevent the "normal" behaviour which would be a "hard" jump
       
	var target = $=jQuery(this).attr("href"); //Get the target
			
	// perform animated scrolling by getting top-position of target-element and set it as scroll target
	jQuery('html, body').stop().animate({ scrollTop: jQuery(target).offset().top}, 500, function() {
	     location.hash = target;  //attach the hash (#jumptarget) to the pageurl
	});
			
	return false;
   });
});

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




!function(){function e(e,r){return[].slice.call((r||document).querySelectorAll(e))}if(window.addEventListener){var r=window.StyleFix={link:function(e){try{if("stylesheet"!==e.rel||e.hasAttribute("data-noprefix"))return}catch(t){return}var n,i=e.href||e.getAttribute("data-href"),a=i.replace(/[^\/]+$/,""),o=(/^[a-z]{3,10}:/.exec(a)||[""])[0],s=(/^[a-z]{3,10}:\/\/[^\/]+/.exec(a)||[""])[0],l=/^([^?]*)\??/.exec(i)[1],u=e.parentNode,p=new XMLHttpRequest;p.onreadystatechange=function(){4===p.readyState&&n()},n=function(){var t=p.responseText;if(t&&e.parentNode&&(!p.status||p.status<400||p.status>600)){if(t=r.fix(t,!0,e),a){t=t.replace(/url\(\s*?((?:"|')?)(.+?)\1\s*?\)/gi,function(e,r,t){return/^([a-z]{3,10}:|#)/i.test(t)?e:/^\/\//.test(t)?'url("'+o+t+'")':/^\//.test(t)?'url("'+s+t+'")':/^\?/.test(t)?'url("'+l+t+'")':'url("'+a+t+'")'});var n=a.replace(/([\\\^\$*+[\]?{}.=!:(|)])/g,"\\$1");t=t.replace(RegExp("\\b(behavior:\\s*?url\\('?\"?)"+n,"gi"),"$1")}var i=document.createElement("style");i.textContent=t,i.media=e.media,i.disabled=e.disabled,i.setAttribute("data-href",e.getAttribute("href")),u.insertBefore(i,e),u.removeChild(e),i.media=e.media}};try{p.open("GET",i),p.send(null)}catch(t){"undefined"!=typeof XDomainRequest&&(p=new XDomainRequest,p.onerror=p.onprogress=function(){},p.onload=n,p.open("GET",i),p.send(null))}e.setAttribute("data-inprogress","")},styleElement:function(e){if(!e.hasAttribute("data-noprefix")){var t=e.disabled;e.textContent=r.fix(e.textContent,!0,e),e.disabled=t}},styleAttribute:function(e){var t=e.getAttribute("style");t=r.fix(t,!1,e),e.setAttribute("style",t)},process:function(){e("style").forEach(StyleFix.styleElement),e("[style]").forEach(StyleFix.styleAttribute)},register:function(e,t){(r.fixers=r.fixers||[]).splice(void 0===t?r.fixers.length:t,0,e)},fix:function(e,t,n){for(var i=0;i<r.fixers.length;i++)e=r.fixers[i](e,t,n)||e;return e},camelCase:function(e){return e.replace(/-([a-z])/g,function(e,r){return r.toUpperCase()}).replace("-","")},deCamelCase:function(e){return e.replace(/[A-Z]/g,function(e){return"-"+e.toLowerCase()})}};!function(){setTimeout(function(){},10),document.addEventListener("DOMContentLoaded",StyleFix.process,!1)}()}}(),function(e){function r(e,r,n,i,a){if(e=t[e],e.length){var o=RegExp(r+"("+e.join("|")+")"+n,"gi");a=a.replace(o,i)}return a}if(window.StyleFix&&window.getComputedStyle){var t=window.PrefixFree={prefixCSS:function(e,n){var i=t.prefix;if(t.functions.indexOf("linear-gradient")>-1&&(e=e.replace(/(\s|:|,)(repeating-)?linear-gradient\(\s*(-?\d*\.?\d*)deg/gi,function(e,r,t,n){return r+(t||"")+"linear-gradient("+(90-n)+"deg"})),e=r("functions","(\\s|:|,)","\\s*\\(","$1"+i+"$2(",e),e=r("keywords","(\\s|:)","(\\s|;|\\}|$)","$1"+i+"$2$3",e),e=r("properties","(^|\\{|\\s|;)","\\s*:","$1"+i+"$2:",e),t.properties.length){var a=RegExp("\\b("+t.properties.join("|")+")(?!:)","gi");e=r("valueProperties","\\b",":(.+?);",function(e){return e.replace(a,i+"$1")},e)}return n&&(e=r("selectors","","\\b",t.prefixSelector,e),e=r("atrules","@","\\b","@"+i+"$1",e)),e=e.replace(RegExp("-"+i,"g"),"-"),e=e.replace(/-\*-(?=[a-z]+)/gi,t.prefix)},property:function(e){return(t.properties.indexOf(e)?t.prefix:"")+e},value:function(e){return e=r("functions","(^|\\s|,)","\\s*\\(","$1"+t.prefix+"$2(",e),e=r("keywords","(^|\\s)","(\\s|$)","$1"+t.prefix+"$2$3",e)},prefixSelector:function(e){return e.replace(/^:{1,2}/,function(e){return e+t.prefix})},prefixProperty:function(e,r){var n=t.prefix+e;return r?StyleFix.camelCase(n):n}};!function(){var e={},r=[],n=getComputedStyle(document.documentElement,null),i=document.createElement("div").style,a=function(t){if("-"===t.charAt(0)){r.push(t);var n=t.split("-"),i=n[1];for(e[i]=++e[i]||1;n.length>3;){n.pop();var a=n.join("-");o(a)&&-1===r.indexOf(a)&&r.push(a)}}},o=function(e){return StyleFix.camelCase(e)in i};if(n.length>0)for(var s=0;s<n.length;s++)a(n[s]);else for(var l in n)a(StyleFix.deCamelCase(l));var u={uses:0};for(var p in e){var f=e[p];u.uses<f&&(u={prefix:p,uses:f})}t.prefix="-"+u.prefix+"-",t.Prefix=StyleFix.camelCase(t.prefix),t.properties=[];for(var s=0;s<r.length;s++){var l=r[s];if(0===l.indexOf(t.prefix)){var c=l.slice(t.prefix.length);o(c)||t.properties.push(c)}}"Ms"!=t.Prefix||"transform"in i||"MsTransform"in i||!("msTransform"in i)||t.properties.push("transform","transform-origin"),t.properties.sort()}(),function(){function e(e,r){return i[r]="",i[r]=e,!!i[r]}var r={"linear-gradient":{property:"backgroundImage",params:"red, teal"},calc:{property:"width",params:"1px + 5%"},element:{property:"backgroundImage",params:"#foo"},"cross-fade":{property:"backgroundImage",params:"url(a.png), url(b.png), 50%"}};r["repeating-linear-gradient"]=r["repeating-radial-gradient"]=r["radial-gradient"]=r["linear-gradient"];var n={initial:"color","zoom-in":"cursor","zoom-out":"cursor",box:"display",flexbox:"display","inline-flexbox":"display",flex:"display","inline-flex":"display",grid:"display","inline-grid":"display","min-content":"width"};t.functions=[],t.keywords=[];var i=document.createElement("div").style;for(var a in r){var o=r[a],s=o.property,l=a+"("+o.params+")";!e(l,s)&&e(t.prefix+l,s)&&t.functions.push(a)}for(var u in n){var s=n[u];!e(u,s)&&e(t.prefix+u,s)&&t.keywords.push(u)}}(),function(){function r(e){return a.textContent=e+"{}",!!a.sheet.cssRules.length}var n={":read-only":null,":read-write":null,":any-link":null,"::selection":null},i={keyframes:"name",viewport:null,document:'regexp(".")'};t.selectors=[],t.atrules=[];var a=e.appendChild(document.createElement("style"));for(var o in n){var s=o+(n[o]?"("+n[o]+")":"");!r(s)&&r(t.prefixSelector(s))&&t.selectors.push(o)}for(var l in i){var s=l+" "+(i[l]||"");!r("@"+s)&&r("@"+t.prefix+s)&&t.atrules.push(l)}e.removeChild(a)}(),t.valueProperties=["transition","transition-property"],e.className+=" "+t.prefix,StyleFix.register(t.prefixCSS)}}(document.documentElement);