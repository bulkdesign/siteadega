<?php get_header() 
	
/* Template Name: Parceiros */
	
?>

	<?php the_post() ?>
	<!-- title -->
	<?php get_template_part( 'partials/partial-title-default' ); ?>
	
	<?php get_template_part( 'partials/shortcode-depoimento' ); ?>
	
	<!-- parceiros -->
	<div class="container parceiros">
		<?php the_content() ?>
		
		<?php if( have_rows('repetidor_parceiros') ): ?>
	    <div class="row">
		    <?php while( have_rows('repetidor_parceiros') ): the_row();
			
				//vars
				$image = get_sub_field('imagem');
			?>
	        <div class="col-xs-12 col-sm-6 col-md-3">
	            <div class="box-parceiros">
		            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
	                <div class="box-parceiros-hover">
		                
		                <?php if ( get_sub_field('empresa') ): ?>
	                    	<h3><?php the_sub_field('empresa') ?></h3>
	                    <?php endif; ?>
	                    
	                    <?php if ( get_sub_field('funcao') ): ?>
	                    	<h4><?php the_sub_field('funcao') ?></h4>
	                    <?php endif; ?>
	                    
	                    <?php if ( get_sub_field('site') ): ?>
	                    <p><a href="<?php the_sub_field('site') ?>" target="_blank"><?php the_sub_field('site') ?></a></p>
	                    <?php endif; ?>
	                    
	                </div>
	            </div>
	        </div>
	        <?php endwhile; ?>
	    </div>
	    <?php endif; ?>
	    
	    <div>
	        <h3 class="title-dicas"><a href="#">Conheça nosso blog</a></h3>
	    </div>
	</div>
	
<?php get_footer() ?>
