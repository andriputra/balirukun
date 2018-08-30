<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage FRANK_JEWELRY_STORE
 * @since FRANK_JEWELRY_STORE 1.0
 */
?>

<div class="author_info scheme_dark author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">

	<div class="author_avatar" itemprop="image">
		<?php 
		$frank_jewelry_store_mult = frank_jewelry_store_get_retina_multiplier();
		echo get_avatar( get_the_author_meta( 'user_email' ), 120*$frank_jewelry_store_mult ); 
		?>
	</div><!-- .author_avatar -->

	<div class="author_description">
		<h5 class="author_title" itemprop="name"><?php echo wp_kses_data(sprintf(__('About %s', 'frank-jewelry-store'), '<span class="fn">'.get_the_author().'</span>')); ?></h5>

		<div class="author_bio" itemprop="description">
			<?php echo wpautop(get_the_author_meta( 'description' )); ?>
			<a class="author_link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( esc_html__( 'View all posts by %s', 'frank-jewelry-store' ), '<span class="author_name">' . esc_html(get_the_author()) . '</span>' ); ?>
			</a>
		</div><!-- .author_bio -->

	</div><!-- .author_description -->

</div><!-- .author_info -->
