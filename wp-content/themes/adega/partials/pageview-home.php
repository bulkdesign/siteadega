<?php get_header() 
	
/* Template Name: Home */
	
?>

	<!-- banner -->
	<?php if( have_rows('repetidor_banner_destaque', 'option') ): ?>
		<div class="carousel-banner">
			<?php while( have_rows('repetidor_banner_destaque', 'option') ): the_row();
				
				//vars
				$image = get_sub_field('imagem');
				$link = get_sub_field('url');
			?>
		    <div class="banner">
			    <?php if ( $link ): ?>
		    	<a href="<?php echo $link; ?>" class="link">
			    <?php endif; ?>
				    
				    <?php if ( $image ): ?>
				    	<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>">
				    <?php endif; ?>
				    
				    <?php if( get_sub_field('cor_da_tarja') ): ?>
			        <div class="content-banner <?php the_sub_field('cor_da_tarja') ?>">
			            <div class="container">
				            <?php if( get_sub_field('titulo') ): ?>
			                	<h2><?php the_sub_field('titulo') ?></h2>
			                <?php endif; ?>
			                
			                <?php if( get_sub_field('resumo') ): ?>
			                	<?php the_sub_field('resumo') ?>
		                	<?php endif; ?>
			            </div>
			        </div>
			        <?php endif; ?>
			        
		        <?php if ( $link ): ?>
	        	</a>
	        	<?php endif; ?>
		    </div>
		    <?php endwhile; ?>
		</div>
	<?php endif; ?>
	
	<?php if( have_rows('repetidor_diferenciais', 47) ): ?>
	<!-- diferenciais -->
	<div class="container">
	    <div class="box-diferenciais"> 
	        <!-- title -->
	        <div class="box-title">
	            <h2 class="title">Diferenciais</h2>
	        </div>
	        <div class="row">
	            <?php while( have_rows('repetidor_diferenciais', 47) ): the_row();
				
					//vars
					$image = get_sub_field('imagem');
				?>
	            <div class="col-xs-12 col-sm-6 col-md-3 item-diferencial">
		            
		            <?php if($image): ?>
		        		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
		        	<?php endif; ?>
		        	
		        	<?php if(get_sub_field('titulo')): ?>
		           		<h3><?php the_sub_field('titulo') ?></h3>
		            <?php endif; ?>
		            
		            <?php if(get_sub_field('resumo')): ?>
						<p><?php the_sub_field('resumo') ?></p>
		            <?php endif; ?>
	                
	            </div>
	            <?php endwhile; ?>
	        </div>
	    </div>
	</div>
	<?php endif; ?>
	
	<!-- agenda -->
	<div id="agenda" class="box-agenda">
    	<div class="chamada-agenda">
	    	<div class="container">
		    	<h3><strong>Agende agora sua degustação</strong> sem compromisso e receba a consultoria dos nossos Sommeliers</h3>
	    	</div>
	    	<div class="frase-agenda">
		    	<div class="container">
			    	<p>Atendemos também aos sábados</p>
		    	</div>
	    	</div>
    	</div>
		<div class="container calendario">
			<?php echo do_shortcode( '[contact-form-7 id="244" title="Formulário - Agendamento"]' ); ?>
			<?php get_template_part( 'partials/shortcode-depoimento' ); ?>
		</div>
	</div>
	
	
	<!-- produtos -->
	<?php
		$args = array(
	        'post_type' => 'produto'
		);
		
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
	?>
	<div class="box-produtos"> 
	    <!-- title -->
	    <div class="box-title">
	        <h2 class="title">Produtos</h2>
	    </div>
	    <div class="slider responsive galeria-produtos">
		    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			    <?php if ( has_post_thumbnail() ) { ?>
		        	<div><?php the_post_thumbnail( 'foto-produto-home' ); ?></div>
		        <?php } ?>	
	        <?php endwhile; ?>
	    </div>
	</div>
	<?php endif; ?>	     

	<!-- parceiros -->
	<div class="container">
        <!-- title -->
        <div class="box-title">
            <h2 class="title">Parceiros</h2>
        </div>
		
		<?php if( have_rows('repetidor_parceiros', 69) ): ?>
	    <div class="galeria-parceiros">
		    <?php while( have_rows('repetidor_parceiros', 69) ): the_row();
			
				//vars
				$image = get_sub_field('imagem');
			?>
	        <div class="item-parceiro">
	            <div class="box-parceiros">
		            <a href="<?php the_sub_field('site') ?>" class="link_Parceiro" target="_blank">
			            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
		            </a>
	            </div>
	        </div>
	        <?php endwhile; ?>
	    </div>
	    <?php endif; ?>
	</div>
	
	<?php get_template_part( 'partials/shortcode-box-fotos' ); ?>
	
<?php get_footer() ?>
