 <?php
$stack_color = esc_attr(get_theme_mod('highlight_color'));
$stack_header = esc_attr(get_theme_mod('menu_color'));
$stack_footer = esc_attr(get_theme_mod('footer_color'));
$stack_text = esc_attr(get_theme_mod('text_color'));
$stack_text_footer = esc_attr(get_theme_mod('text_color_footer'));
function hex2rgb($hex) {
$hex = str_replace("#", "", $hex);

if(strlen($hex) == 3) {
$r = hexdec(substr($hex,0,1).substr($hex,0,1));
$g = hexdec(substr($hex,1,1).substr($hex,1,1));
$b = hexdec(substr($hex,2,1).substr($hex,2,1));
} else {
$r = hexdec(substr($hex,0,2));
$g = hexdec(substr($hex,2,2));
$b = hexdec(substr($hex,4,2));
}
$rgb = array($r, $g, $b);

return $rgb; // returns an array with the rgb values
}
$RGB_color = hex2rgb($stack_color);
$rgb_color = implode(", ", $RGB_color);
$custom_inline_style = '.header-banner-top .main-navigation, .header-banner-top .main-navigation.is-sticky {background-color:'.$stack_header.';}.header-banner-top .horizontal-nav a, .header-banner-top .horizontal-nav a:hover, .header-banner-top .horizontal-nav .active-link a{color:'.$stack_text.';}.site-footer, .site-footer .content{background-color:'.$stack_footer.';}.site-footer .footer-links a{color:'.$stack_text_footer.';}#stack-banner > div a:hover, span.login a.modal__trigger, .widget ul a:hover, a, a:visited, a:hover, a:focus, a:active, .statistic-list .box .icon, .stack-heading span.icon{color:'.$stack_color.';}span.login a.modal__trigger, .paging .active a, .paging a:hover, input.wpcf7-form-control:focus, textarea:focus, textarea.wpcf7-form-control:focus, #stack-banner > div a, .nav a:hover{border-color:'.$stack_color.';}span.login a.modal__trigger:hover, .blog-grid article.post .entry-footer .comments-link a:hover, .slide ol li, .paging .active a, .paging a:hover, .wpcf7-submit, .wpcf7-form input[type="submit"], #stack-banner > div a, #modal__temp, .header-banner-top .horizontal-nav .sub-menu li:hover, .comment-form .submit, .btn-link, .error-404 .search-submit, .cd-top, .stack-single-point > a, .stack-expand__card {background-color:'.$stack_color.';}
@-webkit-keyframes stack-pulse {
  0% {
    -webkit-transform: scale(1);
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0.8);
  }
  50% {
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0.8);
  }
  100% {
    -webkit-transform: scale(1.6);
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0);
  }
}
@-moz-keyframes stack-pulse {
  0% {
    -moz-transform: scale(1);
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0.8);
  }
  50% {
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0.8);
  }
  100% {
    -moz-transform: scale(1.6);
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0);
  }
}
@keyframes stack-pulse {
  0% {
    -webkit-transform: scale(1);
    -moz-transform: scale(1);
    -ms-transform: scale(1);
    -o-transform: scale(1);
    transform: scale(1);
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0.8);
  }
  50% {
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0.8);
  }
  100% {
    -webkit-transform: scale(1.6);
    -moz-transform: scale(1.6);
    -ms-transform: scale(1.6);
    -o-transform: scale(1.6);
    transform: scale(1.6);
    box-shadow: inset 0 0 1px 1px rgba('.$rgb_color.', 0);
  }
}
';