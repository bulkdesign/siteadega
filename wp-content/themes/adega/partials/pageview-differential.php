<?php get_header() 
	
/* Template Name: Diferenciais */
	
?>

	<?php the_post() ?>
	<!-- title -->
	<?php get_template_part( 'partials/partial-title-default' ); ?>
		
	<!-- diferenciais -->
	<div class="container diferenciais">
		<?php if( have_rows('repetidor_diferenciais') ): ?>
	    <ul>
		    <?php
			    while( have_rows('repetidor_diferenciais') ): the_row();
			    
			    //vars
			    $image = get_sub_field('imagem');
		    ?>
	        <li>
	        	<?php if($image): ?>
	        		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
	        	<?php endif; ?>
	        	
	        	<?php if(get_sub_field('titulo')): ?>
	           		<h3><?php the_sub_field('titulo') ?></h3>
	            <?php endif; ?>
	            
	            <?php if(get_sub_field('conteudo')): ?>
					<?php the_sub_field('conteudo') ?>
	            <?php endif; ?>
	        </li>
	        <?php endwhile; ?>
	    </ul>
	    <?php endif; ?>
	</div>
	
	<?php
		$args = array(
	        'post_type' => 'faq'
		);
		
		//vars
		$a = 0;
		$e = 0;
		$i = 0;
		$o = 0;
		$u = 0;
		
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
	?>
	
	<!-- perguntas frequentes -->
	<div class="perguntas-freq">
	    <div class="container">
	        <h2>PERGUNTAS FREQUENTES</h2>
	        <?php get_template_part( 'partials/shortcode-input-faq' ); ?>
	        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		        
		        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	            <div class="panel panel-default">
	                <div class="panel-heading" role="tab" id="heading_<?php echo $a++; ?>">
	                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $e++; ?>" aria-expanded="true" aria-controls="collapse_<?php echo $i++; ?>"><?php the_title() ?><span class="mais">+</span><span class="menos">-</span></a> </h4>
	                </div>
	                <div id="collapse_<?php echo $o++; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo $u++; ?>">
	                    <div class="panel-body"><?php the_content() ?></div>
	                </div>
	            </div>
	            <?php endwhile; ?>
	            
	        </div>
	    </div>
	</div>
	
	<?php endif; ?>
	
<?php get_footer() ?>
