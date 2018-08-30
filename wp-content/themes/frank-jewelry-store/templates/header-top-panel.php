<?php
/**
 * The template for displaying Page title and Breadcrumbs
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

if(frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('header_top_panel'))){
?>
	<div class="top_panel_top scheme_<?php echo esc_attr(frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('menu_scheme'))
		? (frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('header_scheme'))
			? frank_jewelry_store_get_theme_option('color_scheme')
			: frank_jewelry_store_get_theme_option('header_scheme'))
		: frank_jewelry_store_get_theme_option('menu_scheme')); ?>">

		<div class="content_wrap clearfix">

			<?php
			$frank_jewelry_store_frank_jewelry_store_menu_top = frank_jewelry_store_get_nav_menu('menu_top');
			if (empty($frank_jewelry_store_frank_jewelry_store_menu_top)) $frank_jewelry_store_frank_jewelry_store_menu_top = frank_jewelry_store_get_nav_menu();
			frank_jewelry_store_show_layout($frank_jewelry_store_frank_jewelry_store_menu_top);
			?>

			<nav class="menu_top_nav_area_right">
				<ul id="menu_top_right" class="menu_top_nav">
					<?php if ( !is_user_logged_in() ) { ?>
						<li class="menu_user_login">
							<?php do_action('trx_addons_action_login'); ?>
						</li>
					<?php } ?>
					<?php
					if (function_exists('icl_get_languages')) {
						$languages = icl_get_languages('skip_missing=1');
						if (!empty($languages) && is_array($languages)) {
							$lang_list = '';
							$lang_active = '';
							foreach ($languages as $lang) {
								$lang_title = esc_attr($lang['translated_name']);
								if ($lang['active']) {
									$lang_active = $lang_title;
								}
								$lang_list .= "\n"
									.'<li><a rel="alternate" hreflang="' . esc_attr($lang['language_code']) . '" href="' . esc_url(apply_filters('WPML_filter_link', $lang['url'], $lang)) . '">'
									.'<img src="' . esc_url($lang['country_flag_url']) . '" alt="' . esc_attr($lang_title) . '" title="' . esc_attr($lang_title) . '" />'
									. ($lang_title)
									.'</a></li>';
							}
							?>
							<li class="menu_user_language">
								<a href="#"><span><?php frank_jewelry_store_show_layout($lang_active); ?></span></a>
								<ul><?php frank_jewelry_store_show_layout($lang_list); ?></ul>
							</li>
						<?php
						}
					}


					if (function_exists('frank_jewelry_store_is_woocommerce_page') && frank_jewelry_store_is_woocommerce_page()) {
						if(class_exists('WOOCS')) {
							?>
							<li class="menu_user_currency">
								<?php echo do_shortcode('[woocs show_flags=0]'); ?>
							</li>
							<?php
						}
					}


					if (function_exists('frank_jewelry_store_exists_woocommerce') && frank_jewelry_store_exists_woocommerce() && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) {
						?>
						<li class="menu_user_cart">

							<?php
							$cart_items = WC()->cart->get_cart_contents_count();
							$cart_summa = strip_tags(WC()->cart->get_cart_subtotal());
							?>
							<a href="#" class="top_panel_cart_button" data-items="<?php echo esc_attr($cart_items); ?>" data-summa="<?php echo esc_attr($cart_summa); ?>">
								<span class="contact_icon icon-shop"></span>
								<span class="contact_label contact_cart_label"><?php esc_html_e('Your cart:', 'frank-jewelry-store'); ?></span>
								<span class="contact_cart_totals">
									<span class="cart_items"><?php
										echo esc_html($cart_items) . ' ' . ($cart_items == 1 ? esc_html__('Item', 'frank-jewelry-store') : esc_html__('Items', 'frank-jewelry-store'));
										?></span>
									-
									<span class="cart_summa"><?php frank_jewelry_store_show_layout($cart_summa); ?></span>
								</span>
							</a>
							<ul class="cart_list sidebar_cart"><li>
									<?php
									do_action( 'before_sidebar' );
									frank_jewelry_store_storage_set('current_sidebar', 'cart');
									if ( !dynamic_sidebar( 'sidebar-cart' ) ) {
										the_widget( 'WC_Widget_Cart', 'title=&hide_if_empty=1' );
									}
									?>
								</li></ul>

						</li>

					<?php
					}
					?>


				</ul>
			</nav>
		</div>
	</div>



<?php
}
?>