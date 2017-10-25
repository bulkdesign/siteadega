<?php if( have_rows('repetidor_slider_produto') ): ?>
<div class="carousel-banner-prod">
	<?php while( have_rows('repetidor_slider_produto') ): the_row();
		
		$image = get_sub_field('imagem');
		$link = get_sub_field('url');
	?>
	<div class="banner">
	    <?php if ( $link ): ?>
	    	<a href="<?php echo $link; ?>" class="link">
	    <?php endif; ?>
	    
			<?php if($image): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
			<?php endif; ?>
			
			<?php //if ( get_sub_field('titulo') ): ?>
			<!-- <div class="content-banner"> -->
				<!-- <h2><?php //the_sub_field('titulo') ?></h2> -->
				<?php //if ( get_sub_field('texto') ): ?>
					<!-- <p><?php //the_sub_field('texto') ?></p> -->
				<?php //endif; ?>
			<!-- </div> -->
			<?php //endif; ?>
		
        <?php if ( $link ): ?>
        	</a>
    	<?php endif; ?>
	</div>
	<?php endwhile; ?>
</div>
<?php endif; ?>
