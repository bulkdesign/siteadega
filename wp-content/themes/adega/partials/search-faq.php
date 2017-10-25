<?php get_header() ?>

	<?php
		//vars
		$a = 0;
		$e = 0;
		$i = 0;
		$o = 0;
		$u = 0;
		
		if ( have_posts() ) :
	?>
	
	<!-- perguntas frequentes -->
	<div class="perguntas-freq">
	    <div class="container">
	        <?php get_template_part( 'partials/shortcode-input-faq' ); ?>
	        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		        
		        <?php while ( have_posts() ) : the_post(); ?>
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