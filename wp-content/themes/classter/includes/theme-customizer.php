<?php
// Redefine colors in styles
$THEMEREX_custom_css = "";

function getThemeCustomStyles() {
	global $THEMEREX_custom_css;
	return $THEMEREX_custom_css;//str_replace(array("\n", "\r", "\t"), '', $THEMEREX_custom_css);
}

function addThemeCustomStyle($style) {
	global $THEMEREX_custom_css;
	$THEMEREX_custom_css .= "
		{$style}
	";
}

function prepareThemeCustomStyles() {
	// Custom fonts
	if (get_custom_option('typography_custom')=='yes') {
		$s = '';
		$fonts = getThemeFontsList(false);
		$fname = get_custom_option('typography_p_font');
		if (isset($fonts[$fname])) {
			$fstyle = explode(',', get_custom_option('typography_p_style'));
			$fname2 = ($pos=themerex_strpos($fname,' ('))!==false ? themerex_substr($fname, 0, $pos) : $fname;
			$i = in_array('i', $fstyle);
			$u = in_array('u', $fstyle);
			$c = get_custom_option('typography_p_color');
			$s .= "
				body, button, input, select, textarea {
					font-family: '".$fname2."'".(isset($fonts[$fname]['family']) ? ", ".$fonts[$fname]['family'] : '').";
				}
				body {
					font-size: ".get_custom_option('typography_p_size')."px;
					font-weight: ".get_custom_option('typography_p_weight').";
					line-height: ".get_custom_option('typography_p_lineheight')."px;
					".($c ? "color: ".$c.";" : '')."
					".($i ? "font-style: italic;" : '')."
					".($u ? "text-decoration: underline;" : '')."
				}
			";
		}
		for ($h=1; $h<=6; $h++) {
			$fname = get_custom_option('typography_h'.$h.'_font');
			if (isset($fonts[$fname])) {
				$fstyle = explode(',', get_custom_option('typography_h'.$h.'_style'));
				$fname2 = ($pos=themerex_strpos($fname,' ('))!==false ? themerex_substr($fname, 0, $pos) : $fname;
				$i = in_array('i', $fstyle);
				$u = in_array('u', $fstyle);
				$c = get_custom_option('typography_h'.$h.'_color');
				$s .= "
					h".$h.", .h".$h." {
						font-family: '".$fname2."'".(isset($fonts[$fname]['family']) ? ", ".$fonts[$fname]['family'] : '').";
						font-size: ".get_custom_option('typography_h'.$h.'_size')."px;
						font-weight: ".get_custom_option('typography_h'.$h.'_weight').";
						line-height: ".get_custom_option('typography_h'.$h.'_lineheight')."px;
						".($c ? "color: ".$c.";" : '')."
						".($i ? "font-style: italic;" : '')."
						".($u ? "text-decoration: underline;" : '')."
					}
					h".$h." a, .h".$h." a {
						".($c ? "color: ".$c.";" : '')."
					}
				";
			}
		}
		if (!empty($s)) addThemeCustomStyle($s);
	}

	// Submenu width
	$menu_width = (int) get_theme_option('menu_width');
	if ($menu_width > 50) {
		addThemeCustomStyle("
			.topWrap .topMenuStyleLine > ul > li ul {
				width: {$menu_width}px;
			}
			.topWrap .topMenuStyleLine > ul > li ul li ul {
				left: ".($menu_width+31)."px;
			}
			.menu_right .topWrap .topMenuStyleLine ul.submenu_left {
				left: -".($menu_width+91)."px !important;
			}
			ul#mainmenu .menu-panel ul.columns > li ul {
				max-width: ".$menu_width."px;
			}

		");
	}

	// Logo height
	$logo_height = (int) get_custom_option('logo_height');
	$logo_offset = (int) get_custom_option('logo_offset');
	if ($logo_height > 10) {
		if (empty($logo_offset)) {
			$logo_offset = max(20, round((100 - $logo_height) / 2));
		}
		$add = max(0, round(($logo_offset*2 + $logo_height - 100) / 2)); 
		addThemeCustomStyle("
			header.noFixMenu .topWrap .logo {
				height: ".$logo_height."px;
			}
			header.noFixMenu .topWrap .logo img {
				height: ".$logo_height."px;
			}
			header.noFixMenu .topWrap .logo .logo_text {
				line-height: ".$logo_height."px;
			}
			header.noFixMenu.menu_right .topWrap .openRightMenu,
			header.noFixMenu.menu_right .topWrap .search {
				margin-top: ".(33 + $add)."px;
				margin-bottom: ".(37 + $add)."px;
			}
			header.noFixMenu.menu_right .topWrap .topMenuStyleLine > ul > li {
				padding-top: ".(30 + $add)."px;
				padding-bottom: ".(30 + $add)."px;
			}
			header.noFixMenu.menu_right .topWrap .topMenuStyleLine > ul#mainmenu > li > .menu-panel,
			header.noFixMenu.menu_right .topWrap .topMenuStyleLine > ul > li > ul {
				top: ".(100 + $add)."px;
			}
		");
	}

	// Logo top offset
	if ($logo_offset > 0) {
		addThemeCustomStyle("
			header.noFixMenu .topWrap .logo {
				padding: ".$logo_offset."px 0 0 0;
			}
		");
	}

	$logo_height = (int) get_theme_option('logo_image_footer_height');
	if ($logo_height > 10) {
		addThemeCustomStyle("
			footer .logo img {
				height: ".$logo_height."px;
			}
		");
	}
	
	// Main Slider height
	$slider_height = (int) get_custom_option('slider_height');
	if ($slider_height > 10) {
		addThemeCustomStyle("
			.sliderHomeBullets {
				height: ".$slider_height."px;
			}
		");
	}

	// Bg custom image
	global $bg_custom_image_style;
	if ($bg_custom_image_style != '' && get_custom_option('bg_custom_image_style') != '') {
		addThemeCustomStyle("
			.sc_quote_style_1,
			.audio_container,
			.topTabsWrap,
			.relatedPostWrap article .wrap.no_thumb,
			.postAside,
			.postStatus,
			.postLink,
			.portfolioWrap .isotopePadding,
			.userFooterSection.global,
			.sc_testimonials_style {
				background-image:url(".$bg_custom_image_style.");
			}
			.sc_testimonials_style {
				background-size: 100% auto;
			}
		");
	}


	// Bg custom image in header
	global $bg_custom_image_style_header;
	if($bg_custom_image_style_header != ''){
		addThemeCustomStyle("
			.userHeaderSection.global {
				background-image:url(".$bg_custom_image_style_header.");
			}
		");
	}
	else if ($bg_custom_image_style != '' && get_custom_option('bg_custom_image_style') != '') {
		addThemeCustomStyle("
			.userHeaderSection.global {
				background-image:url(".$bg_custom_image_style.");
			}
		");
	}



	// Custom css from theme options
	$css = get_custom_option('custom_css');
	if (!empty($css)) {
		addThemeCustomStyle($css);
	}

	$custom_style = '';
	$customizer = get_theme_option('show_theme_customizer') == 'yes';

	// Theme color from customizer
	$clr = '';
	if ($customizer)
		$clr = getValueGPC('theme_color', '');
	if (empty($clr))
		$clr = get_custom_option('theme_color');
	if (!empty($clr)) {
		$rgb = themerex_hex2rgb($clr);
		$custom_style .= '
a:hover,
.theme_accent,
.theme_accent:before,
.topTabsWrap .speedBar a:hover,
.topWrap .topMenuStyleLine > ul > li ul li a:hover,
.topWrap .topMenuStyleLine .current-menu-item > a,
.topWrap .topMenuStyleLine .current-menu-ancestor > a,
.topWrap .topMenuStyleLine > ul li a:hover,
.topWrap .topMenuStyleLine > ul li.sfHover > a,
.infoPost a:hover,
.tabsButton ul li a:hover,
.popularFiltr ul li a:hover,
.isotopeFiltr ul li a:hover,
.widget_popular_posts article h3:before,
.widgetTabs .widget_popular_posts article .post_info .post_date a:hover,
.sidebar .widget_popular_posts article .post_info .post_date a:hover,
.sidebar .widget_recent_posts article .post_info .post_date a:hover,
.main .widgetWrap a:hover,
.main .widgetWrap a:hover span,
.widgetWrap a:hover span,
.roundButton:hover a,
input[type="submit"]:hover,
input[type="button"]:hover,
.squareButton > a:hover,
.nav_pages_parts > a:hover,
.nav_comments > a:hover,
.comments_list a.comment-edit-link:hover,
.wp-calendar tbody td.today a:hover,
blockquote.sc_quote_title a:hover,
blockquote.sc_quote_style_1 a:hover,
blockquote.sc_quote_style_2 a:hover,
.postLink a,
.masonry article .masonryInfo a:hover,
.masonry article .masonryInfo span.infoTags a:hover,
.relatedPostWrap article .relatedInfo a:hover,
.relatedPostWrap article .relatedInfo span.infoTags a:hover,
.infoPost span.infoTags a:hover,
.page404 p a,
.page404 .searchAnimation.sFocus .searchIcon,
.copyWrap a,
.comments .commBody li.commItem .replyWrap .posted a:hover,
.comments .commBody li.commItem h4 a:hover,
.ratingItem span:before,
.reviewBlock .totalRating,
.widget_area .contactInfo .fContact:before,
.footerStyleLight .widget_area article .post_title:before,
.footerStyleLight .widget_area article .post_info a:hover,
.footerStyleLight .widget_area article .post_info .post_date a:hover,
.sc_list_style_arrows li:before,
.sc_list_style_arrows li a:hover,
.sc_list_style_iconed li a:hover,
.sc_accordion.sc_accordion_style_2 .sc_accordion_item.sc_active .sc_accordion_title,
.sc_accordion.sc_accordion_style_2 .sc_accordion_item.sc_active .sc_accordion_title:before,
.sc_toggles.sc_toggles_style_2 .sc_toggles_item.sc_active .sc_toggles_title,
.sc_toggles.sc_toggles_style_2 .sc_toggles_item.sc_active .sc_toggles_title:before,
.sc_tabs .sc_tabs_titles li a:hover,
.sc_highlight.sc_highlight_style_2,
.sc_price_item .sc_price_money,
.sc_price_item .sc_price_penny,
.sc_pricing_table .sc_pricing_columns ul li .sc_icon,
.sc_title_icon,
.sc_scroll_controls .flex-direction-nav a:hover:before,
.sc_testimonials_style_1 .flex-direction-nav a:hover:before,
.sc_testimonials_style_3 .flex-direction-nav a:hover:before,
.sc_testimonials_style_3 .flex-direction-nav a:active:before,
.pagination .pageLibrary > li.libPage > .pageFocusBlock .flex-direction-nav a:hover:before,
.topWrap .usermenu_area ul.usermenu_list li.usermenu_currency > a:hover,
.topWrap .usermenu_area ul.usermenu_list li.usermenu_currency.sfHover > a,
.topWrap .usermenu_area ul.usermenu_list li ul li a:hover,
.topWrap .usermenu_area ul.usermenu_list li.usermenu_cart .widget_area ul li a:hover,
.topWrap .usermenu_area a:hover,
.topWrap .usermenu_area .sfHover a,
.sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_currency > a:hover,
.sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_currency.sfHover > a,
.sidemenu_wrap .usermenu_area ul.usermenu_list li ul li a:hover,
.sidemenu_wrap .usermenu_area ul.usermenu_list li.usermenu_cart .widget_area ul li a:hover,
.sc_blogger a:hover,
.sc_blogger.style_date .load_more:before,
.sc_blogger.style_accordion .sc_blogger_info .comments_number,
.widgetTabs .widgetTop ul > li:not(.tabs):before,
.widgetTabs .widgetTop ul > li:not(.tabs) > a:hover,
.widgetTabs .widgetTop ul > li:not(.tabs) > a:hover span,
.widgetTabs .widgetTop.widget_popular_posts article .post_title:before,
.swpRightPos .tabsMenuBody a:hover,
.swpRightPos .tabsMenuBody a:hover:before,
.swpRightPos .panelmenu_area .current-menu-item > a,
.swpRightPos .panelmenu_area .current-menu-ancestor > a,
.swpRightPos .panelmenu_area > ul li a:hover,
.swpRightPos .panelmenu_area > ul li.sfHover > a,
.swpRightPos .panelmenu_area .current-menu-item.dropMenu:before,
.swpRightPos .panelmenu_area .current-menu-ancestor.dropMenu:before,
.swpRightPos .panelmenu_area li.liHover.dropMenu:before,
.topWrap .search:not(.searchOpen):hover:before,
.topWrap .search .searchSubmit:hover .icoSearch:before,
.user-popUp .formItems.loginFormBody .remember .forgotPwd,
.user-popUp .formItems.loginFormBody .loginProblem,
.user-popUp .formItems.registerFormBody .i-agree a,
.sc_slider_pagination_area .flex-control-nav.manual .slide_info .slide_title,
#toc .toc_item.current .toc_icon,
#toc .toc_item:hover .toc_icon,
.openResponsiveMenu:hover,
.openResponsiveMenu:hover:before,
.sidebarStyleLight .widgetWrap ul li.liHover:before,
.sidebarStyleLight .widgetWrap  a:hover,
.sidebarStyleLight .widgetWrap  a:active,
.sidebarStyleLight.widget_area .widgetWrap a:hover span,
.sidebarStyleLight.widget_area .widgetWrap a:hover,
.sidebarStyleLight.widget_area .widgetWrap ul > li > a:hover,
.sidebarStyleLight.widget_area .widgetWrap ul > li > a:hover span,
.sidebarStyleLight.widget_area ul.tabs > li.ui-state-active > a,
.sidebarStyleLight .widgetWrap .tagcloud a:hover,
.sidebarStyleLight .widgetWrap .tagcloud a:active,
.sidebarStyleLight.widget_area a:hover,
.sidebarStyleLight.widget_area a:hover span,
.sidebarStyleLight.widget_area .ui-state-active a,
.sidebarStyleLight.widget_area .widgetWrap ul li a:hover,
.sidebarStyleLight.widget_area .widget_twitter ul li:before,
.sidebarStyleLight .wp-calendar tfoot th a:before,
.sidebarStyleLight.widget_area table.wp-calendar tfoot a:hover,
.sidebarStyleLight.widget_area article span:before,
.sidebarStyleLight.widget_area .widgetWrap ul > li.dropMenu:hover:before,
.sidebarStyleLight.widget_area .widgetWrap ul > li.dropMenu.dropOpen:before,
.sc_pricing_light .sc_pricing_columns:hover ul.columnsAnimate .sc_pricing_title,
.sc_pricing_light .sc_pricing_columns:hover ul.columnsAnimate .sc_pricing_data > span,
.sc_pricing_light .sc_pricing_columns.active ul.columnsAnimate .sc_pricing_title,
.sc_pricing_light .sc_pricing_columns.active ul.columnsAnimate .sc_pricing_data > span,
.postSharing > ul > li> a:before,
.post .tagsWrap .post_cats a:hover,
.post .tagsWrap .post_tags a:hover,
.post_text_area .tagsWrap .post_cats a:hover,
.post_text_area .tagsWrap .post_tags a:hover,
.infoPost > span:before,
.infoPost > span a:before,
.comments .commBody li.commItem .replyWrap a:hover,
.relatedPostWrap .no_indent_style article .wrap a:hover,
.postLink a:hover,
.portfolBlock ul li a:hover,
.swpRightPos .searchBlock .searchSubmit:hover:before,
.twitBlock .sc_slider .swiper-slide a:hover,
.twitBlockWrap .twitterAuthor a:hover,
.relatedPostWrap.sc_blogger article .relatedInfo a:hover,
.sc_blogger.style_date .sc_blogger_item .sc_blogger_info a:hover,
ul#mainmenu .menu-panel.thumb_title > li > ul > li > ul li a:before,
.footerContentWrap .googlemap_button:after
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce ul.products li.product .added_to_cart,
.woocommerce-page ul.products li.product .added_to_cart,
.woocommerce .woocommerce-breadcrumb a:hover,
.woocommerce-page .woocommerce-breadcrumb a:hover,
.topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button:hover,
.topWrap .sidebar_cart ul.cart_list li > a:hover,
.woocommerce .star-rating span:before,
.woocommerce-page .star-rating span:before,
.woocommerce a.reset_variations,
.woocommerce-page a.reset_variations,
.shipping-calculator-button:hover
').'
{ color:'.$clr.'; }

.roundButton.border_1:hover > a,
.squareButton.border_1 > a:hover,
.squareButton.border_1 > a:active,
.topWrap .topMenuStyleLine > ul > li ul li a:hover,
.flip-clock-wrapper ul li a div div.inn
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce .woocommerce-info a:after,
.woocommerce-page .woocommerce-info a:after,
.woocommerce .woocommerce-info a,
.woocommerce-page .woocommerce-info a,
.woocommerce p.stars a:hover.star-1:after,
.woocommerce p.stars a:hover.star-1.active:after,
.woocommerce-page p.stars a:hover.star-1:after,
.woocommerce-page p.stars a.star-1.active:after,
.woocommerce p.stars a:hover.star-2:after,
.woocommerce p.stars a.star-2.active:after,
.woocommerce-page p.stars a:hover.star-2:after,
.woocommerce-page p.stars a.star-2.active:after,
.woocommerce p.stars a:hover.star-3:after,
.woocommerce p.stars a.star-3.active:after,
.woocommerce-page p.stars a:hover.star-3:after,
.woocommerce-page p.stars a.star-3.active:after,
.woocommerce p.stars a:hover.star-4:after,
.woocommerce p.stars a.star-4.active:after,
.woocommerce-page p.stars a:hover.star-4:after,
.woocommerce-page p.stars a.star-4.active:after,
.woocommerce p.stars a.star-5:hover:after,
.woocommerce p.stars a.star-5.active:after,
.woocommerce-page p.stars a:hover.star-5:after,
.woocommerce-page p.stars a.star-5.active:after,
.woocommerce .widget_shopping_cart .cart_list li a.remove:hover,
.woocommerce.widget_shopping_cart .cart_list li a.remove:hover
').'
{ color:'.$clr.' !important; }

.theme_accent_bgc,
.theme_accent_bgc:before,
.sc_video_player:active .sc_video_play_button:after,
input[type="submit"]:active,
input[type="button"]:active,
.squareButton.active > span,
.squareButton.active > a,
.squareButton.ui-state-active > a,
.roundButton > a:active,
.squareButton > a:active,
.squareButton.global > a,
.nav_pages_parts > span.page_num,
.nav_comments > span.current,
ul > li.likeActive:active > a,
.masonry article .status,
.portfolio .isotopeElement .folioShowBlock:before,
.post .postStatus,
.itemPageFull .itemDescriptionWrap .toggleButton:active,
.footerWrap .footerWidget .sc_video_player:active .sc_video_play_button:after,
.topMenuStyleLine > ul .menu-panel,
.sliderLogo .elastislide-wrapper nav span:active:before,
.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcap,
.sc_highlight.sc_highlight_style_1,
.sc_title_bg,
.sc_testimonials_style_1 .flex-direction-nav a:active,
.sc_testimonials_style_3 .sc_testimonials_items,
.sc_testimonials_style_3 .flex-direction-nav li,
.sc_testimonials_style_3 .flex-direction-nav a,
.pagination .pageLibrary > li.libPage > .pageFocusBlock .flex-direction-nav a:active,
.sc_popup_light:before,
.global_bg,
.widgetTabs .widgetTop .tagcloud a:hover,
.widgetTabs .widgetTop .tagcloud a:active,
.fullScreenSlider.globalColor .sliderHomeBullets .rsContent:before,
.fullScreenSlider .sliderHomeBullets .rsContent .slide-3 .order p span,
ul.sc_list_style_disk li:before,
.sc_slider_pagination_area .flex-control-nav.manual .slide_date,
.sc_contact_form_custom .bubble label:hover,
.sc_contact_form_custom .bubble label.selected,
.topWrap .cart a.cart_button,
.sidebarStyleLight .widget_socials .socPage ul li a:hover,
.sidebarStyleLight.widget_area .instagram-pics li a:after,
.sidebarStyleLight.widget_area .flickr_images .flickr_badge_image a:after,
.sidebarStyleLight .wp-calendar tbody td a:hover,
.sidebarStyleLight .wp-calendar tbody td a:hover,
.sidebarStyleLight .wp-calendar tbody td.today > span,
.sidebarStyleLight .wp-calendar tbody td.today a,
.footerStyleLight .contactFooter .contactShare ul li a:hover,
.footerContentWrap .googlemap_button,
.page404 .titleError > span,
.isotopeFiltr ul a .data_count,
.isotopeFiltr ul a .data_count:before
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce #review_form #respond .form-submit input,
.woocommerce-page #review_form #respond .form-submit input,
.woocommerce table.cart a.remove:hover,
.woocommerce #content table.cart a.remove:hover,
.woocommerce-page table.cart a.remove:hover,
.woocommerce-page #content table.cart a.remove:hover,
.topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button.checkout
').'
'.(!class_exists('TribeEvents') ? '' : ',
.tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"], .tribe-events-calendar td.tribe-events-present div[id*="tribe-events-daynum-"] > a, #tribe_events_filters_wrapper input[type="submit"], .tribe-events-button, #tribe-events .tribe-events-button, .tribe-events-button.tribe-inactive, #tribe-events .tribe-events-button:hover, .tribe-events-button:hover, .tribe-events-button.tribe-active:hover
').'
{ background-color:'.$clr.'; }

.sc_pricing_light .sc_pricing_columns:hover ul.columnsAnimate .sc_button > a,
.sc_pricing_light .sc_pricing_columns.active ul.columnsAnimate .sc_button > a
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce #payment #place_order,
.woocommerce-page #payment #place_order,
.woocommerce .woocommerce-message a.button,
.woocommerce .woocommerce-error a.button,
.woocommerce .woocommerce-info a.button,
.woocommerce-page .woocommerce-message a.button,
.woocommerce-page .woocommerce-error a.button,
.woocommerce-page .woocommerce-info a.button
').'
{ background-color: '.$clr.' !important; }

.theme_accent_border,
.squareButton.border_1 > a:hover,
.squareButton.border_1 > a:active,
.sidebarStyleLight .widgetWrap .tagcloud a:hover,
.sidebarStyleLight .widgetWrap .tagcloud a:active,
.sidebarStyleLight.widget_area .tabs_area ul.tabs > li > a:hover,
.sidebarStyleLight.widget_area .tagcloud a:hover,
.sidebarStyleLight.widget_area .tagcloud a:active,
.sidebarStyleLight.widget_area ul.tabs > li.ui-state-active > a,
.sidebarStyleLight.widget_area .wp-calendar tbody a:hover,
.sc_pricing_light .sc_pricing_columns:hover ul.columnsAnimate,
.sc_pricing_light .sc_pricing_columns.active ul.columnsAnimate,
#toc .toc_item.current,
#toc .toc_item:hover,
.topWrap .search:not(.searchOpen):hover,
.upToScroll a.addBookmark:hover,
.sc_scroll_controls .flex-direction-nav a:active,
.sc_testimonials_style_1 .flex-direction-nav a:active,
.pagination .flex-direction-nav a:active
.sc_scroll_controls .flex-direction-nav a:hover,
.topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button:hover,
.openResponsiveMenu:hover
{ border-color: '.$clr.'; }

.theme_accent_bg,
.theme_accent_bg:before
{ background:'.$clr.'; }

'.(!class_exists('TribeEvents') ? '' : ',
#tribe-bar-form .tribe-bar-submit input[type="submit"]
{ background:'.$clr.'; }
').'

.squareButton.global > a:hover,
.squareButton.global > a:active,
.topWrap .sidebar_cart .widget_shopping_cart_content .buttons .button.checkout:hover,
.topWrap .cart .cart_button:hover
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce #review_form #respond .form-submit input:hover,
.woocommerce-page #review_form #respond .form-submit input:hover,
.woocommerce #payment #place_order:hover,
.woocommerce-page #payment #place_order:hover,
.woocommerce .woocommerce-message a.button:hover,
.woocommerce .woocommerce-error a.button:hover,
.woocommerce .woocommerce-info a.button:hover,
.woocommerce-page .woocommerce-message a.button:hover,
.woocommerce-page .woocommerce-error a.button:hover,
.woocommerce-page .woocommerce-info a.button:hover
').'
{ background-color: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7) !important; }


::selection { background-color:'.$clr.';}
::-moz-selection { background-color:'.$clr.';}
';
	$custom_style = apply_filters('theme_skin_set_theme_color', $custom_style, $clr);
}



// Theme color 1 from customizer
$clr = '';
if ($customizer)
	$clr = getValueGPC('theme_color_1', '');
if (empty($clr))
	$clr = get_custom_option('theme_color_1');
if (!empty($clr)) {
	$rgb = themerex_hex2rgb($clr);
	$custom_style .= '
.theme_accent_1,
.theme_accent_1:before,
.sc_pricing_dark .sc_pricing_columns:hover ul.columnsAnimate .sc_pricing_data > span,
.sc_pricing_dark .sc_pricing_columns:hover ul.columnsAnimate .sc_pricing_title,
.sc_pricing_dark .sc_pricing_columns.active ul.columnsAnimate .sc_pricing_data > span,
.sc_pricing_dark .sc_pricing_columns.active ul.columnsAnimate .sc_pricing_title,
.postLink a
{ color:'.$clr.'; }

.roundButton.border:hover > a,
.squareButton.border > a:hover,
.squareButton.border > a:active,
.revlink.border:hover,
.revlink.border:active
{ color:'.$clr.' !important; }

.theme_accent_1_bgc,
.theme_accent_1_bgc:before,
.sc_dropcaps.sc_dropcaps_style_4 .sc_dropcap,
.squareButton.accent_1 > a,
.revlink.filled
{ background-color: '.$clr.'; }

.sc_pricing_dark .sc_pricing_columns .sc_button > a:hover,
.sc_pricing_dark .sc_pricing_columns .sc_button > a:active,
.sc_pricing_dark .sc_pricing_columns:hover ul.columnsAnimate .sc_button > a
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce form .button,
.woocommerce-page form .button
').'
{ background-color: '.$clr.' !important; }

.squareButton.border > a:hover,
.squareButton.border > a:active,
.sc_pricing_dark .sc_pricing_columns:hover ul.columnsAnimate,
.sc_pricing_dark .sc_pricing_columns.active ul.columnsAnimate,
.revlink.border:hover,
.revlink.border:active
{ border-color: '.$clr.'; }

.theme_accent_1_bg,
.theme_accent_1_bg:before
{ background:'.$clr.'; }

.squareButton.accent_1 > a:hover,
.squareButton.accent_1 > a:active,
.revlink.filled:hover,
.revlink.filled:active
{ background-color: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7) !important; }

'.(!function_exists('is_woocommerce') ? '' : '
.woocommerce form .button:hover,
.woocommerce-page form .button:hover
{ background: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7) !important; }
').'
';

}


// Theme color 2 from customizer
$clr = '';
if ($customizer)
	$clr = getValueGPC('theme_color_2', '');
if (empty($clr))
	$clr = get_custom_option('theme_color_2');
if (!empty($clr)) {
	$rgb = themerex_hex2rgb($clr);
	$custom_style .= '
.theme_accent_2,
.theme_accent_2:before,
.sc_tooltip_parent,
.hoverIncrease .hoverIcon:hover:before,
.sc_video_player .sc_video_play_button:hover:after,
.sc_video_player:active .sc_video_play_button:hover:after,
.sc_accordion.sc_accordion_style_1 .sc_accordion_item.sc_active .sc_accordion_title,
.sc_toggles.sc_toggles_style_1 .sc_toggles_item.sc_active .sc_toggles_title,
.sc_team .sc_team_item .sc_team_item_avatar .sc_team_item_socials li a:hover,
.hoverIncrease .hoverIcon:hover:before,
.hoverIncrease .hoverLink:hover:before
{ color:'.$clr.'; }

.relatedPostWrap.sc_blogger article a.readmore_blogger:hover
{ color:'.$clr.' !important; }

.theme_accent_2_bgc,
.theme_accent_2_bgc:before,
.sc_tooltip_parent .sc_tooltip,
.sc_tooltip_parent .sc_tooltip:before,
.sc_dropcaps.sc_dropcaps_style_3 .sc_dropcap,
.hoverIncrease .hoverShadow,
.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:before,
.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title:before,
.squareButton.accent_2 > a,
.sc_skills_bar .sc_skills_item .sc_skills_count,
.sc_skills_counter .sc_skills_item.sc_skills_style_3 .sc_skills_count,
.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_count,
.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_info,
.relatedPostWrap .wrap:before,
.relatedPostWrap.sc_blogger .wrap:hover:before,
.portfolioWrap .isotopePadding:before,
#pagination .squareButton.active span,
#pagination .squareButton a:hover,
#pagination .squareButton a:active,
#viewmore_link:hover,
#viewmore_link:active,
.user-popUp .formItems .formList li .sendEnter,
.user-popUp ul.loginHeadTab li.ui-tabs-active:before,
.sc_blogger.style_date .sc_blogger_item .sc_blogger_date,
.sc_scroll_bar .swiper-scrollbar-drag:before,
.sc_blogger.sc_blogger_vertical.style_date.sc_scroll_controls ul.flex-direction-nav li a:hover
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce .widget_area aside.widgetWrap.woocommerce .button,
.woocommerce-page .widget_area aside.widgetWrap.woocommerce  .button,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce #content nav.woocommerce-pagination ul li span.current,
.woocommerce #content nav.woocommerce-pagination ul li a:hover,
.woocommerce #content nav.woocommerce-pagination ul li a:focus,
.woocommerce-page nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li a:focus,
.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
.woocommerce-page #content nav.woocommerce-pagination ul li a:focus
').'
{ background-color: '.$clr.'; }

.theme_accent_2_bg,
.theme_accent_2_bg:before
{ background:'.$clr.'; }

a.sc_icon.bg_icon.sc_icon_round:hover,
a.sc_icon.no_bg_icon.sc_icon_round:hover
{ background-color: '.$clr.' !important; }

.sc_slider_flex .sc_slider_info,
.sc_slider_swiper .sc_slider_info,
.squareButton.accent_2 > a:hover,
.squareButton.accent_2 > a:active,
.user-popUp .formItems .formList li .sendEnter:hover,
.user-popUp .formItems .formList li .sendEnter:active
{ background-color: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7) !important; }

.postSharing > ul > li > a:active,
.postSharing > ul > li > span:active,
.roundButton > a:active,
.nav_pages_parts > span.page_num,
.nav_comments > span.current,
.itemPageFull .itemDescriptionWrap .toggleButton:active,
.footerWidget .sc_video_player:active .sc_video_play_button:after,
.sliderLogo .elastislide-wrapper nav span:active:before,
pre.code,
.sc_tooltip_parent
{ border-color: '.$clr.'; }

blockquote.sc_quote_style_2
{ border-left-color: '.$clr.'; }

'.(!function_exists('is_woocommerce') ? '' : '
.woocommerce .widget_price_filter .price_slider_amount .button,
.woocommerce-page .widget_price_filter .price_slider_amount .button
{ background: '.$clr.' !important; }
').'

'.(!function_exists('is_woocommerce') ? '' : '
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .widget_area aside.widgetWrap.woocommerce .button:hover,
.woocommerce-page .widget_area aside.widgetWrap.woocommerce  .button:hover
{ background: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7) !important; }
').'

.sc_image_shape_round:hover figcaption,
.post .sc_image_shape_round:hover figcaption
{ background: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.6); }
';

}


// Theme color 3 from customizer
	$clr = '';
	if ($customizer)
		$clr = getValueGPC('theme_color_3', '');
	if (empty($clr))
		$clr = get_custom_option('theme_color_3');
	if (!empty($clr)) {
		$rgb = themerex_hex2rgb($clr);
		$custom_style .= '
.theme_accent_3,
.theme_accent_3:before,
.widgetWrap ul li.liHover:before,
.widgetWrap  a:hover,
.widgetWrap  a:active,
.widget_area .widgetWrap ul > li > a:hover,
.widget_area .widgetWrap ul > li > a:hover span,
.sidebarStyleDark.widget_area a:hover,
.sidebarStyleDark.widget_area a:hover span,
.widget_area ul.tabs > li.ui-state-active > a,
aside.widgetWrap .tagcloud a:hover,
aside.widgetWrap .tagcloud a:active,
.sidebarStyleDark.widget_area a:hover,
.sidebarStyleDark.widget_area .ui-state-active a,
.sidebarStyleDark.widget_area .widgetWrap ul li a:hover,
.sidebarStyleDark.widget_area .widget_twitter ul li:before,
.sidebarStyleDark .wp-calendar tfoot th a:before,
.sidebarStyleDark.widget_area table.wp-calendar tfoot a:hover,
.sidebarStyleDark.widget_area .widgetWrap ul > li.dropMenu:hover:before,
.sidebarStyleDark.widget_area .widgetWrap ul > li.dropMenu.dropOpen:before,
.copyWrap .copy .copyright > a,
.widget_area article span:before,
.twitBlock .sc_slider .swiper-slide a,
.twitBlock .sc_slider .swiper-slide .twitterIco:before,
.menuSearch .searchSubmit:hover:before,
.sidemenu_wrap .sidemenu_area .current-menu-item > a,
.sidemenu_wrap .sidemenu_area .current-menu-ancestor > a,
.sidemenu_wrap .sidemenu_area > ul li a:hover,
.sidemenu_wrap .sidemenu_area > ul li.sfHover > a,
.sidemenu_wrap .sidemenu_area .current-menu-item.dropMenu:before,
.sidemenu_wrap .sidemenu_area .current-menu-ancestor.dropMenu:before,
.sidemenu_wrap .sidemenu_area li.liHover.dropMenu:before,
.twitBlock .sc_slider .swiper-slide a,
.twitBlockWrap .twitterAuthor a,
.sidebarStyleDark.widget_area .widgetWrap a:hover,
.sidebarStyleDark.widget_area .widgetWrap .post_info a:hover
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce ul.cart_list li > .amount, .woocommerce ul.product_list_widget li > .amount, .woocommerce-page ul.cart_list li > .amount, .woocommerce-page ul.product_list_widget li > .amount,
.woocommerce ul.cart_list li span .amount, .woocommerce ul.product_list_widget li span .amount, .woocommerce-page ul.cart_list li span .amount, .woocommerce-page ul.product_list_widget li span .amount,
.woocommerce ul.cart_list li ins .amount, .woocommerce ul.product_list_widget li ins .amount, .woocommerce-page ul.cart_list li ins .amount, .woocommerce-page ul.product_list_widget li ins .amount,
.woocommerce .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .sidebarStyleDark.widget_area.widget_area aside.widgetWrap.woocommerce .button:hover,
.woocommerce-page .sidebarStyleDark.widget_area.widget_area aside.widgetWrap.woocommerce .button:hover,
.woocommerce div.product span.price,
.woocommerce div.product p.price,
.woocommerce #content div.product span.price,
.woocommerce #content div.product p.price,
.woocommerce-page div.product span.price,
.woocommerce-page div.product p.price,
.woocommerce-page #content div.product span.price,
.woocommerce-page #content div.product p.price,
.woocommerce .sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a,
.woocommerce-page .sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a,
#sidebar_main.sidebarStyleDark .widget_layered_nav ul li.chosen a:before,
#sidebar_main.sidebarStyleDark .widget_layered_nav ul li a:hover:before,
#sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li a:hover:before,
#sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li.chosen a:before,
.woocommerce.widget_shopping_cart .total .amount,
.woocommerce .widget_shopping_cart .total .amount,
.woocommerce-page.widget_shopping_cart .total .amount,
.woocommerce-page .widget_shopping_cart .total .amount,
.woocommerce ul.products li.product .price > .amount,
.woocommerce ul.products li.product .price ins .amount,
.woocommerce ul.products li.product .price,
.woocommerce-page ul.products li.product .price
').'
{ color:'.$clr.'; }

.sidebarStyleDark.widget_area a:hover span
{ color:'.$clr.' !important; }

.theme_accent_3_bgc,
.theme_accent_3_bgc:before,
.sc_dropcaps.sc_dropcaps_style_2 .sc_dropcap,
.squareButton.accent_3 > a,
.copyWrap .socPage ul li a:hover,
.sidebarStyleDark .widget_socials .socPage ul li a:hover,
.widget_area .instagram-pics li a:after,
.widget_area .flickr_images .flickr_badge_image a:after,
.wp-calendar tbody td a:hover,
.footerStyleDark .contactFooter .contactShare ul li a:hover,
ul > li.share > ul.shareDrop > li > a:hover,
.author .socPage ul li a:hover,
.sc_team .sc_team_item .sc_team_item_avatar:after,
.wp-calendar tbody td a:hover,
.wp-calendar tbody td.today > span
{ background-color: '.$clr.'; }

.theme_accent_3_bg,
.theme_accent_3_bg:before
{ background:'.$clr.'; }

.squareButton.accent_3 > a:hover,
.squareButton.accent_3 > a:active,
.squareButton.gray > a:hover,
.squareButton.gray > a:active
{ background-color: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7);}

'.(!function_exists('is_woocommerce') ? '' : '
.woocommerce #content table.cart td.actions .button:hover,
.woocommerce table.cart td.actions .button:hover,
.woocommerce #content table.cart td.actions .button:active,
.woocommerce table.cart td.actions .button:active,
.woocommerce #content table.cart td.actions .button.checkout-button,
.woocommerce table.cart td.actions .button.checkout-button,
.woocommerce .shipping-calculator-form .button:hover,
.woocommerce .shipping-calculator-form .button:active,
.return-to-shop .button:hover,
.return-to-shop .button:active,
.wc-proceed-to-checkout .checkout-button,
.woocommerce div.product form.cart .button,
.woocommerce #content div.product form.cart .button,
.woocommerce-page div.product form.cart .button,
.woocommerce-page #content div.product form.cart .button
{ background-color:'.$clr.' !important; }
').'

'.(!function_exists('is_woocommerce') ? '' : '
.woocommerce #content table.cart td.actions .button.checkout-button:hover,
.woocommerce table.cart td.actions .button.checkout-button:hover,
.wc-proceed-to-checkout .checkout-button:hover,
.woocommerce div.product form.cart .button:hover,
.woocommerce #content div.product form.cart .button:hover,
.woocommerce-page div.product form.cart .button:hover,
.woocommerce-page #content div.product form.cart .button:hover
{ background: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7) !important; }
').'

'.(!function_exists('is_woocommerce') ? '' : '
.woocommerce ul.products li.product:hover .button,
.woocommerce-page ul.products li.product:hover .button
{ background: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.7); }
').'

.widgetWrap .tagcloud a:hover,
.widgetWrap .tagcloud a:active,
.widget_area .tabs_area ul.tabs > li > a:hover,
.sidebarStyleDark.widget_area .tagcloud a:hover,
.sidebarStyleDark.widget_area .tagcloud a:active,
.widget_area ul.tabs > li.ui-state-active > a
'.(!function_exists('is_woocommerce') ? '' : ',
.woocommerce .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .sidebarStyleDark.widget_area .widget_price_filter .price_slider_amount .button:hover,
.woocommerce .sidebarStyleDark.widget_area aside.widgetWrap.woocommerce .button:hover,
.woocommerce-page .sidebarStyleDark.widget_area aside.widgetWrap.woocommerce .button:hover,
#sidebar_main.sidebarStyleDark.widget_area .widget_layered_nav ul li a:hover:before,
.woocommerce #sidebar_main .sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a:before,
.woocommerce-page #sidebar_main.sidebarStyleDark.widget_area .widget_layered_nav ul li.chosen a:before,
#sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li.chosen a:before,
#sidebar_main.sidebarStyleDark .widget_layered_nav_filters ul li a:hover:before
').'
{ border-color: '.$clr.'; }

.sc_table table tr:hover
{ background-color: rgba('.$rgb['r'].','.$rgb['g'].','.$rgb['b'].',0.15); }
';

}



addThemeCustomStyle(apply_filters('theme_skin_add_styles_inline', $custom_style));

return getThemeCustomStyles();
};
?>