jQuery(document).ready(function() {

	// list/grid view
	jQuery('.jq_toggle_view a').click(function() {
		if (!(jQuery(this).hasClass('active'))) {
			jQuery(this).addClass('active').siblings('a').removeClass('active');
			if (jQuery(this).hasClass('grid')) {
				jQuery('#product_list_container').addClass('grid');
				jQuery.cookie('category_view', 'grid');
			} else {
				jQuery('#product_list_container').removeClass('grid');
				jQuery.cookie('category_view', 'list');
			};
		};
		return false;
	});

	jQuery('#nav > li:has(ul)').addClass("has_submenu");

	// carouel new products
	jQuery('.jq_carousel1').jcarousel({
		scroll:1,
		auto: 5,
		vertical: true,
		wrap:'both',
		animation:'slow'
	});

	// carousel home page
	jQuery('.jq_carousel_home').jcarousel({
		scroll:1,
		itemFallbackDimension: 200
	});

	// carousel products category
	jQuery('.jq_carousel2').jcarousel({
		scroll:1
	});

	// touch for jcarousel
	$('#featured-products_block_center .jq_carousel_home').touchwipe({
		wipeLeft: function() {
			$('#featured-products_block_center .jq_carousel_home').jcarousel('next');
		},
		
		wipeRight: function() {
			$('#featured-products_block_center .jq_carousel_home').jcarousel('prev');
		},		
		preventDefaultEvents: false
	});
	$('#best-sellers_block_center .jq_carousel_home').touchwipe({
		wipeLeft: function() {
			$('#best-sellers_block_center .jq_carousel_home').jcarousel('next');
		},
		
		wipeRight: function() {
			$('#best-sellers_block_center .jq_carousel_home').jcarousel('prev');
		},		
		preventDefaultEvents: false
	});
	$('#crossselling .jq_carousel2').touchwipe({
		wipeLeft: function() {
			$('#crossselling .jq_carousel2').jcarousel('next');
		},
		
		wipeRight: function() {
			$('#crossselling .jq_carousel2').jcarousel('prev');
		},		
		preventDefaultEvents: false
	});
	$('.blockproductscategory .jq_carousel2').touchwipe({
		wipeLeft: function() {
			$('.blockproductscategory .jq_carousel2').jcarousel('next');
		},
		
		wipeRight: function() {
			$('.blockproductscategory .jq_carousel2').jcarousel('prev');
		},		
		preventDefaultEvents: false
	});
	$('#new-products_block_right .jq_carousel1').touchwipe({
		wipeDown: function() {
			$('#new-products_block_right .jq_carousel1').jcarousel('next');
		},
		
		wipeUp: function() {
			$('#new-products_block_right .jq_carousel1').jcarousel('prev');
		},		
		preventDefaultEvents: true
	});

	// Back to top
	if(jQuery(window).width()>600) {

		jQuery('body').prepend('<div id="toTop">Top</div>');

		jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#toTop').fadeIn();	
		} else {
			jQuery('#toTop').fadeOut();
		}
		});

		jQuery('#toTop').click(function() {
			jQuery('body,html').animate({scrollTop:0},800);
		});

	};
	
	// Toggle facebook like box
	jQuery('#block_facebook_like').addClass('jq_slide_toggle');
	jQuery('#block_facebook_like h4').click(function() {
		jQuery(this).closest('#block_facebook_like').toggleClass('opened');
	});
});