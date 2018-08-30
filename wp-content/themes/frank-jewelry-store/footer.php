<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */

						// Widgets area inside page content
						frank_jewelry_store_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					frank_jewelry_store_create_widgets_area('widgets_below_page');

					$frank_jewelry_store_body_style = frank_jewelry_store_get_theme_option('body_style');
					if ($frank_jewelry_store_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			$frank_jewelry_store_footer_scheme =  frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('footer_scheme')) ? frank_jewelry_store_get_theme_option('color_scheme') : frank_jewelry_store_get_theme_option('footer_scheme');
			if (!frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('hide_footer'))) {
			?>
			
			<footer class="site_footer_wrap scheme_<?php echo esc_attr($frank_jewelry_store_footer_scheme); ?>">
				<?php
				// Footer sidebar
				$frank_jewelry_store_footer_name = frank_jewelry_store_get_theme_option('footer_widgets');
				$frank_jewelry_store_footer_present = !frank_jewelry_store_is_off($frank_jewelry_store_footer_name) && is_active_sidebar($frank_jewelry_store_footer_name);
				if ($frank_jewelry_store_footer_present) { 
					frank_jewelry_store_storage_set('current_sidebar', 'footer');
					$frank_jewelry_store_footer_wide = frank_jewelry_store_get_theme_option('footer_wide');
					ob_start();
					do_action( 'frank_jewelry_store_action_before_sidebar' );
					if ( !dynamic_sidebar($frank_jewelry_store_footer_name) ) {
						// Put here html if user no set widgets in sidebar
					}
					do_action( 'frank_jewelry_store_action_after_sidebar' );
					$frank_jewelry_store_out = ob_get_contents();
					ob_end_clean();
					$frank_jewelry_store_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $frank_jewelry_store_out);
					$frank_jewelry_store_need_columns = true;	//or check: strpos($frank_jewelry_store_out, 'columns_wrap')===false;
					if ($frank_jewelry_store_need_columns) {
						$frank_jewelry_store_columns = max(0, (int) frank_jewelry_store_get_theme_option('footer_columns'));
						if ($frank_jewelry_store_columns == 0) $frank_jewelry_store_columns = min(6, max(1, substr_count($frank_jewelry_store_out, '<aside ')));
						if ($frank_jewelry_store_columns > 1)
							$frank_jewelry_store_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($frank_jewelry_store_columns).' widget ', $frank_jewelry_store_out);
						else
							$frank_jewelry_store_need_columns = false;
					}
					?>
					<div class="footer_wrap widget_area<?php echo !empty($frank_jewelry_store_footer_wide) ? ' footer_fullwidth' : ''; ?>">
						<div class="footer_wrap_inner widget_area_inner">
							<?php 
							if (!$frank_jewelry_store_footer_wide) { 
								?><div class="content_wrap"><?php
							}
							if ($frank_jewelry_store_need_columns) {
								?><div class="columns_wrap"><?php
							}
							frank_jewelry_store_show_layout($frank_jewelry_store_out);
							if ($frank_jewelry_store_need_columns) {
								?></div><!-- /.columns_wrap --><?php
							}
							if (!$frank_jewelry_store_footer_wide) {
								?></div><!-- /.content_wrap --><?php
							}
							?>
						</div><!-- /.footer_wrap_inner -->
					</div><!-- /.footer_wrap -->
				<?php
				}


				$footer_image = frank_jewelry_store_get_theme_option( 'image_in_footer' );
				if (!empty($footer_image)) {?>
					<div class="logo_footer_wrap">
					<?php
						echo '<img src="'.esc_url($footer_image).'" class="footer_image" alt="">';
					?>
					</div>
					<?php
				}


				// Logo
				if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('logo_in_footer'))) {
					$frank_jewelry_store_logo_image = '';
					if (frank_jewelry_store_get_retina_multiplier(2) > 1)
						$frank_jewelry_store_logo_image = frank_jewelry_store_get_theme_option( 'logo_footer_retina' );
					if (empty($frank_jewelry_store_logo_image)) 
						$frank_jewelry_store_logo_image = frank_jewelry_store_get_theme_option( 'logo_footer' );
					$frank_jewelry_store_logo_text   = get_bloginfo( 'name' );
					if (!empty($frank_jewelry_store_logo_image) || !empty($frank_jewelry_store_logo_text)) {
						?>
						<div class="logo_footer_wrap">
							<div class="logo_footer_wrap_inner">
								<?php
								if (!empty($frank_jewelry_store_logo_image)) {
									$frank_jewelry_store_attr = frank_jewelry_store_getimagesize($frank_jewelry_store_logo_image);
									echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($frank_jewelry_store_logo_image).'" class="logo_footer_image" alt=""'.(!empty($frank_jewelry_store_attr[3]) ? sprintf(' %s', $frank_jewelry_store_attr[3]) : '').'></a>' ;
								} else if (!empty($frank_jewelry_store_logo_text)) {
									echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($frank_jewelry_store_logo_text) . '</a></h1>';
								}
								?>
							</div>
						</div>
						<?php
					}
				}

				// Socials
				if ( frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('socials_in_footer')) && ($frank_jewelry_store_output = frank_jewelry_store_get_socials_links()) != '') {
					?>
					<div class="socials_footer_wrap socials_wrap">
						<div class="socials_footer_wrap_inner">
							<?php frank_jewelry_store_show_layout($frank_jewelry_store_output); ?>
						</div>
					</div>
					<?php
				}
				
				// Footer menu
				$frank_jewelry_store_menu_footer = frank_jewelry_store_get_nav_menu('menu_footer');
				if (!empty($frank_jewelry_store_menu_footer)) {
					?>
					<div class="menu_footer_wrap">
						<div class="menu_footer_wrap_inner">
							<?php frank_jewelry_store_show_layout($frank_jewelry_store_menu_footer); ?>
						</div>
					</div>
					<?php
				}
				
				// Copyright area
				$frank_jewelry_store_copyright_scheme = frank_jewelry_store_is_inherit(frank_jewelry_store_get_theme_option('copyright_scheme')) ? $frank_jewelry_store_footer_scheme : frank_jewelry_store_get_theme_option('copyright_scheme');
				?> 
				<div class="copyright_wrap scheme_<?php echo esc_attr($frank_jewelry_store_copyright_scheme); ?>">
					<div class="copyright_wrap_inner">
						<div class="content_wrap">
							<div class="copyright_text"><?php
								$frank_jewelry_store_copyright = frank_jewelry_store_prepare_macros(frank_jewelry_store_get_theme_option('copyright'));
								if (!empty($frank_jewelry_store_copyright)) {
									if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $frank_jewelry_store_copyright, $frank_jewelry_store_matches)) {
										$frank_jewelry_store_copyright = str_replace($frank_jewelry_store_matches[1], date(str_replace(array('{', '}'), '', $frank_jewelry_store_matches[1])), $frank_jewelry_store_copyright);
									}
									frank_jewelry_store_show_layout(nl2br($frank_jewelry_store_copyright));
								}
							?></div>
						</div>
					</div>
				</div>

			</footer><!-- /.site_footer_wrap -->
			<?php } ?>
		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (frank_jewelry_store_is_on(frank_jewelry_store_get_theme_option('debug_mode')) && file_exists(frank_jewelry_store_get_file_dir('images/makeup.jpg'))) { ?>
		<img src="<?php echo esc_url(frank_jewelry_store_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>