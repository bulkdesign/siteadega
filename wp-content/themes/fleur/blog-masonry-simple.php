<?php
/*
Template Name: Blog: Masonry Simple
*/
?>
<?php get_header(); ?>

<?php fleur_mikado_get_title(); ?>
<?php get_template_part('slider'); ?>

	<div class="mkd-full-width">
		<div class="mkd-full-width-inner clearfix">
			<?php the_content(); ?>
			<?php do_action('fleur_mikado_page_after_content'); ?>
			<?php fleur_mikado_get_blog('masonry-simple'); ?>
		</div>
	</div>
<?php get_footer(); ?>