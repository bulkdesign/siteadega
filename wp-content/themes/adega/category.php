<?php get_header() ?>
	
	<!-- news -->
	<?php if ( have_posts() ) : ?>
	<div class="container news">
	    <div class="row">
	        <div class="col-xs-12 col-sm-8 col-md-9" id="content">
		        <?php while ( have_posts() ) : the_post(); ?>
	            <div class="box-news">
		            <span class="data"><?php the_date('d M Y') ?></span> <span class="comentarios"><fb:comments-count href=<?php echo get_permalink(); ?>></fb:comments-count> Comentários</span>
	                <h3 class="title-news"><?php the_title() ?></h3>
					<?php if ( has_post_thumbnail() ) { ?>
					    <?php the_post_thumbnail( 'list-news', array( 'class' => 'img-responsive img-border' ) ); ?>
					<?php } ?>
	                <div class="txt-news">
		                <?php the_excerpt() ?>
	                </div>
	                <a href="<?php the_permalink() ?>" class="btn btn-default btn-leia">Leia mais</a>
                </div>
                <?php endwhile; ?>
                <?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
	        </div>
			<?php get_sidebar() ?>
	    </div>
	</div>
	<?php endif; ?>
	
<?php get_footer() ?>