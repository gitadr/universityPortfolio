/*-----------------------------------------------------------------------------------

 	Custom JS - All front-end jQuery
 
-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	Let's get ready!
/*-----------------------------------------------------------------------------------*/

jQuery(document).ready(function() { 

	if (jQuery.browser.msie && jQuery.browser.version == '7.0' )
		jQuery('body').addClass('ie7');
 
/*-----------------------------------------------------------------------------------*/
/*	Superfish Settings - http://users.tpg.com.au/j_birch/plugins/superfish/
/*-----------------------------------------------------------------------------------*/

	jQuery('#primary-nav ul').superfish({
		delay: 200,
		animation: {opacity:'show', height:'show'},
		speed: 'fast',
		autoArrows: false,
		dropShadows: false
	});

	
/*-----------------------------------------------------------------------------------*/
/*	Overlay States
/*-----------------------------------------------------------------------------------*/
	
	var portfolioItems = jQuery('#portfolio-items li');
	var portfolioItemsEnabled = jQuery('#portfolio-items.enabled li');
	var imageItems = jQuery('.post-thumb');
	
	portfolioItems.hover( function () {
		jQuery(this).not('.active, .invisible').find('.overlay').fadeIn(150);
	}, function () {
		jQuery(this).not('.active, .invisible').find('.overlay').fadeOut(150);
	});
	
	imageItems.hover( function () {
		jQuery(this).not('.active, .invisible').find('.overlay').fadeIn(150);
	}, function () {
		jQuery(this).not('.active, .invisible').find('.overlay').fadeOut(150);
	});
	
/*-----------------------------------------------------------------------------------*/
/*	Portfolio Image Sorting
/*-----------------------------------------------------------------------------------*/

	var portfolioTerms = jQuery('#portfolio-terms a');	
	var portfolioTermsAll = jQuery('#portfolio-terms a.all');
	var magicDoor = jQuery('#door-frame')
	var url = magicDoor.find('#magic-door').attr('data-url');
	
	if(magicDoor.hasClass('open') && jQuery('#portfolio-items').hasClass('enabled')) {
		
		var postId = magicDoor.attr('data-id');
		
		portfolioItems.removeClass('active');
		jQuery('#portfolio-' + postId).addClass('active');
		portfolioItems.not('.active').find('.overlay').css({ display: 'none' });
			
		tz_getPortfolio(postId);
	}
	
	/*	Sort it out! */
	function tz_sortPortfolios(cat) {

		if(portfolioItems.hasClass(cat)) {
			
			portfolioItems
				.not('.'+cat)
				.removeClass('visible')
				.addClass('invisible')
				.find('.hentry')
				.stop()
				.animate({
					opacity: 0
				}, 200);
			
			jQuery('.'+cat)
				.addClass('visible')
				.removeClass('invisible')
				.find('.hentry')
				.stop()
				.animate({
					opacity: 1
				}, 200);
		}
		
	}
	
	
	portfolioTerms.click( function(e) { 
	
		var cat = jQuery(this).attr('data-value')
		
		tz_sortPortfolios(cat);
		portfolioTerms.removeClass('active');
		jQuery(this).addClass('active');
		
		e.preventDefault();

	});
	
	/*	When All is clicked */
	portfolioTermsAll.click( function(e) { 	
		
		portfolioItems
			.addClass('visible')
			.removeClass('invisible')
			.find('.hentry')
			.stop()
			.animate({
				opacity: 1
			}, 200);
			
		return false;
		
	});
	
	/*	When a portfolio item is clicked */
	portfolioItemsEnabled.click( function (e) {
		
		if(!jQuery(this).hasClass('active') && jQuery(this).hasClass('visible')) {
				
			portfolioItems.removeClass('active');
			jQuery(this).addClass('active');
			portfolioItems.not('.active').find('.overlay').css({ display: 'none' });

			var postId = jQuery(this).attr('id').split('portfolio-')[1];
			
			tz_getPortfolio(postId);
			
		}
		
		e.preventDefault();
		
	});
	
	function tz_changeNextPrev(postId) {
		
		var next = tz_getNext(postId)
		var prev = tz_getPrev(postId)
		
		jQuery('#next-post').attr('data-id', next);
		jQuery('#prev-post').attr('data-id', prev);
	}
	
	function tz_getPortfolio(postId, dontGet) {
		
		if(!dontGet)
			dontGet = false;
		
		var next = tz_getNext(postId);
		var prev = tz_getPrev(postId);
		
		if(dontGet == false) {
			
			var loader = jQuery('#loading');
			
			loader.fadeIn(200);
			
			tz_closeDoor();
			
			magicDoor.find('#magic-door').load(url, {
				id: postId,
				next: next,
				prev: prev
			}, function() {
			
				tz_portfolioInit();
				tz_sliderInit();
				tz_openDoor();
				loader.fadeOut(200);
				
			});
			
		}
			
		jQuery.scrollTo('#header', 500);
	}
	
	function tz_closeDoor() {
		
		if(magicDoor.height() != 0 ) {
			
			magicDoor.find('.inner').stop(true).animate({
				opacity: 0
			}, 200);
			
			magicDoor.stop(true).animate({
				height: 0
			}, 600, 'easeOutQuart');
		}
		
	}
	
	function tz_openDoor() {
		
		magicDoor.stop(true).animate({
			height: magicDoor.find('#magic-door').outerHeight()
		}, 800, 'easeOutQuart', function () {

			magicDoor.css({
				height: 'auto'
			});
	
		});
	}
	
	//tz_openDoor();
	
	function tz_getNext(postId) {
		
		var next = jQuery('#portfolio-items li.visible').first().attr('id').split('portfolio-')[1];

		//has next var
		var hasNext = jQuery('#portfolio-' + postId).next();
		
		//if there is a next object
		if(hasNext.length != 0) {
			
			while(hasNext.hasClass('visible') == false && hasNext.length != 0) {
				hasNext = hasNext.next();
			}
			
			if(hasNext.length != 0) {
				var next = hasNext
						.attr('id').split('portfolio-')[1];
			}
		}
		
		return next;
	}
	
	function tz_getPrev(postId) {
		
		var prev = jQuery('#portfolio-items li.visible').last().attr('id').split('portfolio-')[1];

		//has next var
		var hasPrev = jQuery('#portfolio-' + postId).prev();
		
		//if there is a next object
		if(hasPrev.length != 0) {
			
			while(hasPrev.hasClass('visible') == false && hasPrev.length != 0) {
				hasPrev = hasPrev.prev();
			}
			
			if(hasPrev.length != 0) {
				var prev = hasPrev
						.attr('id').split('portfolio-')[1];
			}
		}
		
		return prev;
	}
	
	//Initialize the portfolio
	function tz_portfolioInit() {

		
		jQuery('#next-post, #prev-post').click( function() {

			var postId = jQuery(this).attr('data-id');
			
			portfolioItems.removeClass('active');
			jQuery('#portfolio-' + postId).addClass('active');
			portfolioItems.not('.active').find('.overlay').css({ display: 'none' });
			jQuery('#portfolio-' + postId).find('.overlay').fadeIn(150);

			tz_getPortfolio(postId);
			
			return false;
			
		});
		
		
		jQuery('.portfolio-close a').click( function() { 
			
			magicDoor.stop().animate({
				height: 0
			}, 600, 'easeOutQuart', function() {
				magicDoor.find('#slider').remove(); 
			});
			
			portfolioItems.find('.overlay').fadeOut(150);
			portfolioItems.removeClass('active');
			
			return false;
			
		});
	}
	
/*-----------------------------------------------------------------------------------*/
/*	Slider
/*-----------------------------------------------------------------------------------*/

	function tz_sliderInit() {
		
		if(jQuery().slides) {
			
			jQuery(".slider").css({ height: 'auto' });
			
			jQuery(".slider").slides({
				generatePagination: true,
				effect: 'fade',
				crossfade: true,
				autoHeight: true,
				bigTarget: true,
				preload: true,
				preloadImage: jQuery("#loader").attr('data-loader')
			});
			
			jQuery("#slider").slides({
				generatePagination: true,
				effect: 'fade',
				crossfade: true,
				autoHeight: true,
				bigTarget: true
			});
		}
		
	}
	
	tz_sliderInit();
	
/*-----------------------------------------------------------------------------------*/
/*	PrettyPhoto Lightbox
/*-----------------------------------------------------------------------------------*/
	
	function tz_fancybox() {
		
		if(jQuery().fancybox) {
			jQuery("a.lightbox").fancybox({
				'transitionIn'	:	'fade',
				'transitionOut'	:	'fade',
				'speedIn'		:	300, 
				'speedOut'		:	300, 
				'overlayShow'	:	true,
				'autoScale'		:	false,
				'titleShow'		: 	false,
				'margin'		: 	10
			});
		}
	}
	
	tz_fancybox();
	
/*-----------------------------------------------------------------------------------*/
/*	All done!
/*-----------------------------------------------------------------------------------*/

});

/*-----------------------------------------------------------------------------------*/
/*	Plugins!
/*-----------------------------------------------------------------------------------*/

/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 5/25/2009
 * @author Ariel Flesler
 * @version 1.4.2
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);