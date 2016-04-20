<?php
/**
 * WP-SpamShield Compatibility
 * Ver 1.9.7.7
 */

if( !defined( 'ABSPATH' ) || !defined( 'WPSS_VERSION' ) ) {
	if( !headers_sent() ) { header('HTTP/1.1 403 Forbidden'); }
	die( 'ERROR: Direct access to this file is not allowed.' );
}

class WPSS_Compatibility {

	/**
	 * WP-SpamShield Compatibility Class
	 * Plugin detection
	 * Compatibility deconfliction for some of the plugins listed in the Known Issues and Plugin Conflicts ( http://www.redsandmarketing.com/plugins/wp-spamshield/known-conflicts/ )
	 * Where possible, apply compatibility fixes or workarounds
	 */

	function __construct() {
		/**
		 * Do nothing...for now
		 */
	}
	
	static public function is_plugin_active( $plug_bn, $check_network = TRUE ) {
		/**
		 * Using this because WordPress native' 'is_plugin_active()' function only works in Admin
		 * ex. $plug_bn = 'folder/filename.php'; // Plugin Basename
		 */
		if( empty( $plug_bn ) ){ return FALSE; }
		global $wpss_conf_active_plugins;
		/* Quick Check */
		if( !empty( $wpss_conf_active_plugins[$plug_bn] ) ) { return TRUE; }
		if( TRUE === $check_network && is_multisite() ) { if( !empty( $wpss_conf_active_network_plugins[$plug_bn] ) ) { return TRUE; } }
		$wpss_conf_active_plugins = array();
		$wpss_conf_active_network_plugins = array();
		/* Check known plugin constants and classes */
		$plug_cncl = array(
			/* Compatibility Fixes */
			'autoptimize/autoptimize.php' => array( 'cn' => 'AUTOPTIMIZE_WP_CONTENT_NAME', 'cl' => 'autoptimizeConfig' ), 'commentluv/commentluv.php' => array( 'cn' => '', 'cl' => 'commentluv' ), 'si-contact-form/si-contact-form.php' => array( 'cn' => 'FSCF_VERSION', 'cl' => 'FSCF_Util' ), 'jetpack/jetpack.php' => array( 'cn' => 'JETPACK__VERSION', 'cl' => 'Jetpack' ), 'wp-spamfree/wp-spamfree.php' => array( 'cn' => '', 'cl' => 'wpSpamFree' ), 
			/* 3rd Party Forms, Membership & Registration */
			'bbpress/bbpress.php' => array( 'cn' => '', 'cl' => 'bbPress' ), 'buddypress/bp-loader.php' => array( 'cn' => 'BP_PLUGIN_DIR', 'cl' => 'BuddyPress' ), 'contact-form-7/wp-contact-form-7.php' => array( 'cn' => 'WPCF7_VERSION', 'cl' => '' ), 'gravityforms/gravityforms.php' => array( 'cn' => 'GF_MIN_WP_VERSION', 'cl' => 'GFForms' ), 'mailchimp-for-wp/mailchimp-for-wp.php' => array( 'cn' => 'MC4WP_LITE_VERSION', 'cl' => 'MC4WP_Lite' ), 'ninja-forms/ninja-forms.php' => array( 'cn' => 'NF_PLUGIN_VERSION', 'cl' => 'Ninja_Forms' ), 
			/* Cache Plugins */
			'w3-total-cache/w3-total-cache.php' => array( 'cn' => 'W3TC_VERSION', 'cl' => '' ), 'wp-fastest-cache/wpFastestCache.php' => array( 'cn' => 'WPFC_WP_PLUGIN_DIR', 'cl' => 'WpFastestCache' ), 'wp-fastest-cache-premium/wpFastestCachePremium.php' => array( 'cn' => '', 'cl' => '' ), 'wp-rocket/wp-rocket.php' => array( 'cn' => 'WP_ROCKET_VERSION', 'cl' => '' ), 
			/* Ecommerce Plugins */
			'affiliates/affiliates.php' => array( 'cn' => 'AFFILIATES_CORE_VERSION', 'cl' => '' ), 'caldera-forms/caldera-core.php' => array( 'cn' => 'CFCORE_VER', 'cl' => '' ), 'download-manager/download-manager.php' => array( 'cn' => 'WPDM_Version', 'cl' => '' ), 'easy-digital-downloads/easy-digital-downloads.php' => array( 'cn' => 'EDD_VERSION', 'cl' => '' ), 'ecommerce-product-catalog/ecommerce-product-catalog.php' => array( 'cn' => 'AL_BASE_PATH', 'cl' => 'eCommerce_Product_Catalog' ), 'ecwid-shopping-cart/ecwid-shopping-cart.php' => array( 'cn' => 'ECWID_PLUGIN_DIR', 'cl' => '' ), 'events-made-easy/events-manager.php' => array( 'cn' => 'EME_DB_VERSION', 'cl' => '' ), 'events-manager/events-manager.php' => array( 'cn' => 'EM_VERSION', 'cl' => '' ), 'eshop/eshop.php' => array( 'cn' => 'ESHOP_VERSION', 'cl' => '' ), 'give/give.php' => array( 'cn' => 'GIVE_VERSION', 'cl' => 'Give' ), 'gravity-forms-stripe/gravity-forms-stripe.php' => array( 'cn' => 'GFP_STRIPE_FILE', 'cl' => '' ), 'gravityformspaypal/paypal.php' => array( 'cn' => 'GF_PAYPAL_VERSION', 'cl' => 'GF_PayPal_Bootstrap' ), 'ithemes-exchange/init.php' => array( 'cn' => '', 'cl' => 'IT_Exchange' ), 'jigoshop/jigoshop.php' => array( 'cn' => 'JIGOSHOP_VERSION', 'cl' => '' ), 'paid-memberships-pro/paid-memberships-pro.php' => array( 'cn' => 'PMPRO_VERSION', 'cl' => '' ), 's2member/s2member-o.php' => array( 'cn' => 'WS_PLUGIN__S2MEMBER_VERSION', 'cl' => '' ), 'shopp/Shopp.php' => array( 'cn' => '', 'cl' => 'ShoppLoader' ), 'simple-membership/simple-wp-membership.php' => array( 'cn' => 'SIMPLE_WP_MEMBERSHIP_VER', 'cl' => '' ), 'stripe/stripe-checkout.php' => array( 'cn' => 'SIMPAY_VERSION', 'cl' => '' ), 'ultimate-product-catalogue/UPCP_Main.php' => array( 'cn' => 'UPCP_CD_PLUGIN_PATH', 'cl' => '' ), 'usc-e-shop/usc-e-shop.php' => array( 'cn' => 'USCES_VERSION', 'cl' => '' ), 'users-ultra/xoousers.php' => array( 'cn' => 'xoousers_url', 'cl' => '' ), 'wc-vendors/class-wc-vendors.php' => array( 'cn' => 'wcv_plugin_dir', 'cl' => 'WC_Vendors' ), 'woocommerce/woocommerce.php' => array( 'cn' => 'WOOCOMMERCE_VERSION', 'cl' => 'WooCommerce' ), 'woocommerce-paypal-pro-payment-gateway/woo-paypal-pro.php' => array( 'cn' => 'WC_PP_PRO_ADDON_VERSION', 'cl' => 'WC_Paypal_Pro_Gateway_Addon' ), 'wordpress-ecommerce/marketpress.php' => array( 'cn' => 'MP_LITE', 'cl' => 'MarketPress' ), 'wordpress-simple-paypal-shopping-cart/wp_shopping_cart.php' => array( 'cn' => 'WP_CART_VERSION', 'cl' => '' ), 'wp-e-commerce/wp-shopping-cart.php' => array( 'cn' => 'WPSC_VERSION', 'cl' => 'WP_eCommerce' ), 'wp-easycart/wpeasycart.php' => array( 'cn' => 'EC_CURRENT_VERSION', 'cl' => '' ), 'wp-shop-original/wp-shop.php' => array( 'cn' => 'WPSHOP_DIR', 'cl' => '' ), 'wp-ultra-simple-paypal-shopping-cart/wp_ultra_simple_shopping_cart.php' => array( 'cn' => 'WUSPSC_VERSION', 'cl' => '' ), 'wppizza/wppizza.php' => array( 'cn' => 'WPPIZZA_VERSION', 'cl' => '' ), 'yith-woocommerce-stripe/init.php' => array( 'cn' => 'YITH_WCSTRIPE_VERSION', 'cl' => '' ), 
			/* Page Builder Plugins */
			'beaver-builder-lite-version/fl-builder.php' => array( 'cn' => 'FL_BUILDER_VERSION', 'cl' => 'FLBuilder' ), 'bb-plugin/fl-builder.php' => array( 'cn' => 'FL_BUILDER_VERSION', 'cl' => 'FLBuilder' ), 
			/* All others */
			'wordfence/wordfence.php' => array( 'cn' => 'WORDFENCE_VERSION', 'cl' => 'wordfence' ), 
		);
		if( ( !empty( $plug_cncl[$plug_bn]['cn'] ) && defined( $plug_cncl[$plug_bn]['cn'] ) ) || ( !empty( $plug_cncl[$plug_bn]['cl'] ) && class_exists( $plug_cncl[$plug_bn]['cl'] ) ) ) { $wpss_conf_active_plugins[$plug_bn] = TRUE; return TRUE; }
		/* No match yet, so now do standard check */
		global $wpss_active_plugins; if( empty( $wpss_active_plugins ) ) { $wpss_active_plugins = rs_wpss_get_active_plugins(); }
		if( in_array( $plug_bn, $wpss_active_plugins, TRUE ) ) { $wpss_conf_active_plugins[$plug_bn] = TRUE; return TRUE; }
		if( TRUE === $check_network && is_multisite() ) {
			global $wpss_active_network_plugins; if( empty( $wpss_active_network_plugins ) ) { $wpss_active_network_plugins = rs_wpss_get_active_network_plugins(); }
			if( in_array( $plug_bn, $wpss_active_network_plugins, TRUE ) ) { $wpss_conf_active_network_plugins[$plug_bn] = TRUE; return TRUE; }
		}
		return FALSE;
	}

	static public function supported() {
		/**
		 * Check if supported 3rd party plugins are active that require exceptions
		 */

		/* Gravity Forms ( http://www.gravityforms.com/ ) */

		if( self::is_plugin_active( 'gravityforms/gravityforms.php', TRUE ) ) {
			if( !defined( 'WPSS_SOFT_COMPAT_MODE' ) ) { define( 'WPSS_SOFT_COMPAT_MODE', TRUE ); }
		}

	}

	static public function conflict_check() {
		/**
		 * Check if plugins with known issues are active, then deconflict
		 */

		/* New User Approve Plugin ( https://wordpress.org/plugins/new-user-approve/ ) */
		if( class_exists( 'pw_new_user_approve' ) ) {
			add_action( 'register_post', array('WPSS_Compatibility','deconflict_nua_01'), -10 );
			add_action( 'registration_errors', array('WPSS_Compatibility','deconflict_nua_02'), -10 );
		}

		/* Affiliates Plugin ( https://wordpress.org/plugins/affiliates/ ) */
		if( defined( 'AFFILIATES_CORE_VERSION' ) || class_exists( 'Affiliates_Registration' ) ) {
			if( class_exists( 'Affiliates_Registration' ) && method_exists( 'Affiliates_Registration', 'update_affiliate_user' ) ) {
				add_filter( 'user_registration_email', 'rs_wpss_sanitize_new_user_email' );
			}
			if( class_exists( 'Affiliates_Registration' ) && method_exists( 'Affiliates_Registration', 'render_form' ) ) {
				add_filter( 'affiliates_registration_after_fields', 'rs_wpss_register_form_append' );
			}
		}
	}

	static public function deconflict_nua_01() {
		if( class_exists( 'pw_new_user_approve' ) && method_exists( 'pw_new_user_approve', 'create_new_user' ) && has_filter( 'register_post', array( pw_new_user_approve::instance(), 'create_new_user' ) ) ) {
			remove_action( 'register_post', array( pw_new_user_approve::instance(), 'create_new_user' ), 10 );
			add_action( 'registration_errors', array('WPSS_Compatibility','deconflict_nua_01_01'), 9998, 3 );
		}
	}

	static public function deconflict_nua_01_01( $errors, $user_login, $user_email ) {
		if( !empty( $errors ) && is_object( $errors ) && $errors->get_error_code() ) { return $errors; }
		if( class_exists( 'pw_new_user_approve' ) && method_exists( 'pw_new_user_approve', 'create_new_user' ) ) {
			if( empty( $errors ) || !is_object( $errors ) ) { $errors = new WP_Error; }
			pw_new_user_approve::instance()->create_new_user( $user_login, $user_email, $errors );
		}
		return $errors;
	}

	static public function deconflict_nua_02() {
		if( class_exists( 'pw_new_user_approve' ) && method_exists( 'pw_new_user_approve', 'show_user_pending_message' ) && has_filter( 'registration_errors', array( pw_new_user_approve::instance(), 'show_user_pending_message' ) ) ) {
			remove_filter( 'registration_errors', array( pw_new_user_approve::instance(), 'show_user_pending_message' ), 10 );
			if( function_exists( 'login_header' ) && function_exists( 'login_footer' ) ) {
				add_filter( 'registration_errors', array('WPSS_Compatibility','deconflict_nua_02_01'), 9999 );
			}
		}
	}

	static public function deconflict_nua_02_01( $errors ) {
		if( !empty( $errors ) && is_object( $errors ) && $errors->get_error_code() ) { return $errors; }
		if( class_exists( 'pw_new_user_approve' ) && method_exists( 'pw_new_user_approve', 'show_user_pending_message' ) ) {
			if( empty( $errors ) || !is_object( $errors ) ) { $errors = new WP_Error; }
			pw_new_user_approve::instance()->show_user_pending_message( $errors );
		}
		return $errors;
	}

	static public function comment_form() {
		/**
		 * Comments Form Compatibility 
		 */

		if( rs_wpss_is_admin_sproc() ) { return; }

		/* Vantage Theme by Appthemes ( https://www.appthemes.com/themes/vantage/ ) */
		global $wpss_theme_vantage;
		if( !empty( $wpss_theme_vantage ) ) { return TRUE; }
		elseif( defined( 'APP_FRAMEWORK_DIR_NAME' ) && defined( 'VA_VERSION' ) ) { return TRUE; }
		else {
			$wpss_theme = wp_get_theme();
			$theme_name = $wpss_theme->get( 'Name' );
			$theme_author = $wpss_theme->get( 'Author' );
			if( 'Vantage' === $theme_name && 'AppThemes' === $theme_author ) { return TRUE; }
		}

		/* Add next here... */

		return FALSE;
	}

	static public function footer_js() {
		/**
		 * Footer JS Compatibility
		 */

		if( rs_wpss_is_admin_sproc() ) { return; }

		$js = '';

		/* Vantage Theme by Appthemes ( https://www.appthemes.com/themes/vantage/ ) */
		global $wpss_theme_vantage;
		$v_js = ', #add-review-form';
		if( !empty( $wpss_theme_vantage ) ) { $js .= $v_js; }
		elseif( defined( 'APP_FRAMEWORK_DIR_NAME' ) && defined( 'VA_VERSION' ) ) { $js .= $v_js; }
		else {
			$wpss_theme = wp_get_theme();
			$theme_name = $wpss_theme->get( 'Name' );
			$theme_author = $wpss_theme->get( 'Author' );
			if( 'Vantage' === $theme_name && 'AppThemes' === $theme_author ) { $js .= $v_js; }
		}

		/* Add next here... */

		return $js;
	}

	static public function misc_form_bypass() {
		/**
		 * Miscellaneous Form Spam Check Bypass 
		 */
		
		/* Setup necessary variables */
		$url		= rs_wpss_get_url();
		$url_lc		= rs_wpss_casetrans('lower',$url);
		$req_uri	= $_SERVER['REQUEST_URI'];
		$req_uri_lc	= rs_wpss_casetrans('lower',$req_uri);
		$post_count = count( $_POST );
		$ip			= rs_wpss_get_ip_addr();
		$user_agent = rs_wpss_get_user_agent();
		$referer	= rs_wpss_get_referrer();

		/* IP / PROXY INFO - BEGIN */
		global $wpss_ip_proxy_info;
		if( empty( $wpss_ip_proxy_info ) ) { $wpss_ip_proxy_info = rs_wpss_ip_proxy_info(); }
		extract( $wpss_ip_proxy_info );
		/* IP / PROXY INFO - END */

		/* GEOLOCATION */
		if( $post_count == 6 && isset( $_POST['updatemylocation'], $_POST['log'], $_POST['lat'], $_POST['country'], $_POST['zip'], $_POST['myaddress'] ) ) { return TRUE; }

		/* WP Remote */
		if( defined( 'WPRP_PLUGIN_SLUG' ) && !empty( $_POST['wpr_verify_key'] ) && preg_match( "~\ WP\-Remote$~", $user_agent ) && preg_match( "~\.amazonaws\.com$~", $reverse_dns ) ) { return TRUE; }

		/* Ecommerce Plugins */
		if( ( rs_wpss_is_ssl() || !empty( $_POST['add-to-cart'] ) || !empty( $_POST['add_to_cart'] ) || !empty( $_POST['addtocart'] ) || !empty( $_POST['product-id'] ) || !empty( $_POST['product_id'] ) || !empty( $_POST['productid'] ) || ( preg_match( "~^PayPal\ IPN~", $user_agent ) && preg_match( "~(^|\.)paypal\.com$~", $reverse_dns ) ) ) && self::is_ecom_enabled() ) { return TRUE; }

		/* WooCommerce Payment Gateways */
		if( self::is_woocom_enabled() ) {
			if( ( preg_match( "~^PayPal\ IPN~", $user_agent ) && preg_match( "~(^|\.)paypal\.com$~", $reverse_dns ) ) || strpos( $req_uri, 'WC_Gateway_Paypal' ) !== FALSE ) { return TRUE; }
			if( preg_match( "~(^|\.)payfast\.co\.za$~", $reverse_dns ) || ( strpos( $req_uri, 'wc-api' ) !== FALSE && strpos( $req_uri, 'WC_Gateway_PayFast' ) !== FALSE ) ) { return TRUE; }
			/* Plugin: 'woocommerce-gateway-payfast/gateway-payfast.php' */
			if( preg_match( "~((\?|\&)wc\-api\=WC_(Addons_)?Gateway_|/wc\-api/.*WC_(Addons_)?Gateway_)~", $req_uri ) ) { return TRUE; }
			/* $wc_gateways = array( 'WC_Gateway_BACS', 'WC_Gateway_Cheque', 'WC_Gateway_COD', 'WC_Gateway_Paypal', 'WC_Addons_Gateway_Simplify_Commerce', 'WC_Gateway_Simplify_Commerce' ); */
		}

		/* Easy Digital Downloads Payment Gateways */
		if( defined( 'EDD_VERSION' ) ) {
			if( ( preg_match( "~^PayPal\ IPN~", $user_agent ) && preg_match( "~(^|\.)paypal\.com$~", $reverse_dns ) ) || ( !empty( $_GET['edd-listener'] ) && $_GET['edd-listener'] === 'IPN' )  || ( strpos( $req_uri, 'edd-listener' ) !== FALSE && strpos( $req_uri, 'IPN' ) !== FALSE ) ) { return TRUE; }
			if( ( !empty( $_GET['edd-listener'] ) && $_GET['edd-listener'] === 'amazon' ) || ( strpos( $req_uri, 'edd-listener' ) !== FALSE && strpos( $req_uri, 'amazon' ) !== FALSE ) ) { return TRUE; }
			if( !empty( $_GET['edd-listener'] ) || strpos( $req_uri, 'edd-listener' ) !== FALSE ) { return TRUE; }
		}

		/* Gravity Forms PayPal Payments Standard Add-On ( http://www.gravityforms.com/add-ons/paypal/ ) */
		if( ( defined( 'GF_MIN_WP_VERSION' ) && defined( 'GF_PAYPAL_VERSION' ) ) || ( class_exists( 'GFForms' ) && class_exists( 'GF_PayPal_Bootstrap' ) ) ) {
			if( $url === WPSS_SITE_URL.'/?page=gf_paypal_ipn' && isset( $_POST['ipn_track_id'], $_POST['payer_id'], $_POST['receiver_id'], $_POST['txn_id'], $_POST['txn_type'], $_POST['verify_sign'] ) ) { return TRUE; }
		}


		/* PayPal IPN */
		if(
			isset( $_POST['ipn_track_id'], $_POST['payer_id'], $_POST['payment_type'], $_POST['payment_status'], $_POST['receiver_id'], $_POST['txn_id'], $_POST['txn_type'], $_POST['verify_sign'] ) &&
			FALSE !== strpos( $req_uri_lc, 'paypal' ) &&
			FALSE !== strpos( $req_uri_lc, 'ipn' ) &&
			$user_agent === 'PayPal IPN ( https://www.paypal.com/ipn )' &&
			$reverse_dns === 'notify.paypal.com' &&
			$fcrdns === '[Verified]'
			) { return TRUE; }

		/* Clef */
		if( defined( 'CLEF_VERSION' ) ) {
			if( preg_match( "~^Clef/[0-9](\.[0-9]+)+\ \(https\://getclef\.com\)$~", $user_agent ) && preg_match( "~((^|\.)clef\.io|\.amazonaws\.com)$~", $reverse_dns ) ) { return TRUE; }
		}

		/* OA Social Login */
		if( defined( 'OA_SOCIAL_LOGIN_VERSION' ) ) {
			$ref_dom_rev = strrev( rs_wpss_get_domain( $referer ) ); $oa_dom_rev = strrev( 'api.oneall.com' );
			if( $post_count >= 4 && isset( $_GET['oa_social_login_source'], $_POST['oa_action'], $_POST['oa_social_login_token'], $_POST['connection_token'], $_POST['identity_vault_key'] ) && $_POST['oa_action'] === 'social_login' && strpos( $ref_dom_rev, $oa_dom_rev ) === 0 ) { return TRUE; }
		}

		/* Nothing was triggered */
		return FALSE;
	}

	static public function is_ecom_enabled() {
		/**
		 * Detect if ecommerce is enabled
		 */
		global $wpss_ecom_enabled,$wpss_woocom_enabled;
		if( !empty( $wpss_ecom_enabled ) || !empty( $wpss_woocom_enabled ) ) { $wpss_ecom_enabled = TRUE; return TRUE; }
		/**
		 * Users can manually to TRUE in wp-config.php (For example, if user has a custom or unknown ecommerce package)
		 * Plugin Developers can use WP-SpamShield filter hook 'wpss_misc_form_spam_check_bypass'
		 */
		if( defined('WPSS_CUSTOM_ECOM') && WPSS_CUSTOM_ECOM ) { $wpss_ecom_enabled = TRUE; return TRUE; }
		/**
		 * Detect popular e-commerce plugins
		 */
		$ecom_plug_constants = array( 
			'WC_VERSION', 'WOOCOMMERCE_VERSION', 'WPDM_Version', 'WPDM_BASE_DIR', 'EDD_VERSION', 'ECWID_PLUGIN_DIR', 'ESHOP_VERSION', 'GF_PAYPAL_VERSION', 'JIGOSHOP_VERSION', 'USCES_VERSION', 'MP_LITE', 'WP_CART_VERSION', 'WPSC_FILE_PATH', 
			'AFFILIATES_CORE_VERSION', 'AL_BASE_PATH', 'CFCORE_VER', 'EC_CURRENT_VERSION', 'EM_VERSION', 'EME_DB_VERSION', 'GFP_STRIPE_FILE', 'GIVE_VERSION', 'PMPRO_VERSION', 'SIMPAY_VERSION', 'SIMPLE_WP_MEMBERSHIP_VER', 'UPCP_CD_PLUGIN_PATH', 'WC_PP_PRO_ADDON_VERSION', 'wcv_plugin_dir', 'WP_CART_VERSION', 'WPPIZZA_VERSION', 'WPSC_VERSION', 'WPSHOP_DIR', 'WS_PLUGIN__S2MEMBER_VERSION', 'WUSPSC_VERSION', 'xoousers_url', 'YITH_WCSTRIPE_VERSION', 
			);
		foreach( $ecom_plug_constants as $k => $p ) { if( defined( $p ) ) { $wpss_ecom_enabled = TRUE; return TRUE; } }
		$ecom_plug_classes = array( 
			'GF_PayPal_Bootstrap', 'IT_Exchange', 'ShoppLoader', 'MarketPress', 
			'eCommerce_Product_Catalog', 'Give', 'Shopify_ECommerce_Plugin', 'WC_Vendors', 'WC_Paypal_Pro_Gateway_Addon', 'WP_eCommerce', 
		);
		foreach( $ecom_plug_classes as $k => $p ) { if( class_exists( $p ) ) { $wpss_ecom_enabled = TRUE; return TRUE; } }
		$ecom_plugs = array( 
			'woocommerce/woocommerce.php', 'download-manager/download-manager.php', 'easy-digital-downloads/easy-digital-downloads.php', 'ecwid-shopping-cart/ecwid-shopping-cart.php', 'eshop/eshop.php', 'gravityformspaypal/paypal.php', 'ithemes-exchange/init.php', 'jigoshop/jigoshop.php', 'shopp/Shopp.php', 'usc-e-shop/usc-e-shop.php', 'wordpress-ecommerce/marketpress.php', 'wordpress-simple-paypal-shopping-cart/wp_shopping_cart.php', 'wp-e-commerce/wp-shopping-cart.php', 
			'affiliates/affiliates.php', 'caldera-forms/caldera-core.php', 'ecommerce-product-catalog/ecommerce-product-catalog.php', 'events-made-easy/events-manager.php', 'events-manager/events-manager.php', 'give/give.php', 'gravity-forms-stripe/gravity-forms-stripe.php', 'paid-memberships-pro/paid-memberships-pro.php', 's2member/s2member-o.php', 'simple-membership/simple-wp-membership.php', 'stripe/stripe-checkout.php', 'ultimate-product-catalogue/UPCP_Main.php', 'users-ultra/xoousers.php', 'wc-vendors/class-wc-vendors.php', 'woocommerce-paypal-pro-payment-gateway/woo-paypal-pro.php', 'wp-easycart/wpeasycart.php', 'wppizza/wppizza.php', 'wp-shop-original/wp-shop.php', 'wp-ultra-simple-paypal-shopping-cart/wp_ultra_simple_shopping_cart.php', 'yith-woocommerce-stripe/init.php', 
		);
		foreach( $ecom_plugs as $k => $p ) { if( self::is_plugin_active( $p ) ) { $wpss_ecom_enabled = TRUE; return TRUE; } }
		$ecom_plug_str = array(
			'memberpress/', 
		);
		$ecom_plug_regex = array();
		return FALSE;
	}

	static public function is_woocom_enabled() {
		/**
		 * Detect WooCommerce plugin
		 */
		global $wpss_ecom_enabled,$wpss_woocom_enabled;
		if( !empty( $wpss_woocom_enabled ) ) { $wpss_ecom_enabled = TRUE; return TRUE; }
		$ecom_plug_constants = array( 'WC_VERSION', 'WOOCOMMERCE_VERSION' );
		foreach( $ecom_plug_constants as $k => $p ) { if( defined( $p ) ) { $wpss_ecom_enabled = TRUE; $wpss_woocom_enabled = TRUE; return TRUE; } }
		$ecom_plugs = array( 'woocommerce/woocommerce.php' );
		foreach( $ecom_plugs as $k => $p ) { if( self::is_plugin_active( $p ) ) { $wpss_ecom_enabled = TRUE; $wpss_woocom_enabled = TRUE; return TRUE; } }
		return FALSE;
	}

	static public function is_builder_active() {
		/**
		 * Detect if conflicting page builder plugins are active
		 */
		global $wpss_builder_active; if( !empty( $wpss_builder_active ) ) { return TRUE; }
		$builder_plugs = array( 'beaver-builder-lite-version/fl-builder.php', 'bb-plugin/fl-builder.php' );
		foreach( $builder_plugs as $k => $p ) {
			if( self::is_plugin_active( $p ) ) {
				if( class_exists( 'FLBuilderModel' ) && FLBuilderModel::is_builder_active() ) { $wpss_builder_active = TRUE; return TRUE; }
			}
		}
		return FALSE;
	}
	
	
	/* Add more... */

}
