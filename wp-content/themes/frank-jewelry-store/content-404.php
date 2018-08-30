<article <?php post_class( 'post_item_single post_item_404' ); ?>>
	<div class="post_content">
		<h1 class="page_title"><?php esc_html_e( '404', 'frank-jewelry-store' ); ?></h1>
		<div class="page_info">
			<h1 class="page_subtitle"><?php esc_html_e('Oops...', 'frank-jewelry-store'); ?></h1>
			<p class="page_description"><?php echo wp_kses_post(__("We're sorry, but <br>something went wrong.", 'frank-jewelry-store')); ?></p>
			<div class="sc_item_button sc_button_wrap"><a href="<?php echo esc_url(home_url('/')); ?>" class="sc_button sc_button_border demo_button sc_button_size_normal sc_button_iconed sc_button_icon_left"><?php esc_html_e('Homepage', 'frank-jewelry-store'); ?><span class="sc_button_iconed"></span></a></div>
		</div>
	</div>
</article>
