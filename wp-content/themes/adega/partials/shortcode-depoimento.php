<?php
	$args = array(
        'post_type' => 'depoimento'
	);
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) :
?>
<!-- depoimento -->
<div class="box-depoimento">
  <div class="container">
    <div class="carousel-depoimento">
      
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <div>
        <?php
	        $image = get_field('foto');
			if( !empty($image) ):
			
			// vars
			$url = $image['url'];
			$alt = $image['alt'];
		
			// thumbnail
			$size = 'foto-depoimento';
			$thumb = $image['sizes'][ $size ];
			$width = $image['sizes'][ $size . '-width' ];
			$height = $image['sizes'][ $size . '-height' ];
			
			?>
			<img class="img-depoi" src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
        <?php endif; ?>
        <?php if(get_field('texto')): ?>
        	<blockquote><?php the_field('texto'); ?></blockquote>
        <?php endif; ?>
		<!--<h4 class="tile-depoi">Depoimento de:</h4>-->
        <h2 class="name-depoi"><?php the_title() ?></h2>
        <?php if(get_field('cliente')): ?>
        <h3 class="local-depoi"><?php the_field('cliente') ?></h3>
        <?php endif; ?>
      </div>
      <?php endwhile; ?>
      
    </div>
  </div>
</div>
<!-- FIM depoimento -->
<?php endif; wp_reset_query(); ?>
