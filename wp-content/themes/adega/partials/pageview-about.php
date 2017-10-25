<?php get_header() 
	
/* Template Name: Sobre */
	
?>

	<?php the_post() ?>
	
	<!-- title -->
	<?php get_template_part( 'partials/partial-title-default' ); ?>
	<?php get_template_part( 'partials/shortcode-box-fotos' ); ?>
	
	<!-- sobre -->
	<div class="container sobre">
	    <?php the_content() ?>
	    
	    <?php if( have_rows('repetidor_grupo_chabilis') ): ?>
		    <div class="row box-logos">
			    <?php
					while( have_rows('repetidor_grupo_chabilis') ): the_row();
					$image = get_sub_field('imagem');
					//var_dump(get_sub_field('borda'));
				?>
		        	<div class="col-xs-12 col-sm-6 col-md-3 <?php if(get_sub_field('borda')){echo "border";} else{echo "";} ?>">
			        	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
		        	</div>
		        <?php endwhile; ?>
		    </div>
	    <?php endif; ?>
	</div>
	
<?php get_footer() ?>
