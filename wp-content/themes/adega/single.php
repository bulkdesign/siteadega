<?php get_header() ?>
	
	<?php the_post() ?>
	<!-- news -->
	<div class="container news">
	    <div class="row">
	        <div class="col-xs-12 col-sm-8 col-md-9">
	            <div class="box-news"> <span class="data"><?php the_date('d M Y') ?></span> <span class="comentarios"><fb:comments-count href=<?php echo get_permalink(); ?>></fb:comments-count> Comentários</span>
	                <h3 class="title-news"><?php the_title() ?></h3>
					<?php if ( has_post_thumbnail() ) { ?>
					    <?php the_post_thumbnail( 'list-news', array( 'class' => 'img-responsive img-border' ) ); ?>
					<?php } ?>
	                <div class="txt-news">
	                    <?php the_content() ?>
	                </div>
	                <ul class="compart">
	                    <?php get_template_part( 'partials/shortcode-social' ); ?>
	                </ul>
	            </div>
	        </div>
	        <?php get_sidebar() ?>
	    </div>
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-9 fb-comments" data-href="<?php the_permalink() ?>" data-width="100%" data-numposts="5"></div>
		</div>
	</div>

<?php get_footer() ?>