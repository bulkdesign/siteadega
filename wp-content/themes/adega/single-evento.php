<?php get_header() ?>

	<?php the_post() ?>
	<!-- title -->
	<?php get_template_part( 'partials/partial-title-default' ); ?>
	
	<!-- banner -->
	<?php get_template_part( 'partials/shortcode-slider' ); ?>
	
	<!-- eventos -->
	<div class="eventos">
	<div class="line-calcular">
	    <div class="container">
	        <div class="row">
	            <div class="col-xs-12 col-sm-5 col-md-6">
	                <h3>Calcule a quantidade de bebidas para o seu evento <?php //the_title() ?></h3>
	            </div>
	            <div class="col-xs-12 col-sm-7 col-md-6">
	                <form>
	                    <input type="text" class="form-control txt-pessoas" id="calcular" placeholder="Nº de convidados">
	                    <button type="button" class="btn btn-default btn-calcular <?php echo $post->post_name;?>">Calcular</button>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="cal-resultado">
		<?php 
			if(is_single('501')){
				get_template_part( 'partials/shortcode-calcular-custom' );
			}else{
				get_template_part( 'partials/shortcode-calcular' );
			}
		?>
	</div>
	<?php 
		
		$repeat = get_field('repetidor_esquerda');
		
		if($repeat): ?>
    <div class="box-dicas">
        <div class="container">
	        <?php if (get_field('url')): ?>
            <div>
                <a href="<?php the_field('url') ?>" class="title-dicas">CONFIRA AS IndicaçÕES do Sommelier Chablis</a>
            </div>
            <?php endif; ?>
            <a class="link-ag" href="<?php echo get_home_url('home') ?>/#agenda">APROVEITE E AGENDE SUA DEGUSTAÇÃO</a>
            
			<?php get_template_part( 'partials/shortcode-depoimento' ); ?>
            
            <h2 class="title-list">dicas</h2>
            <div class="row">
	            
	            <?php if( have_rows('repetidor_esquerda') ): ?>
                <div class="col-xs-12 col-sm-5 col-md-5">
	                <?php while( have_rows('repetidor_esquerda') ): the_row(); ?>
	                    <div class="list-dicas">
	                        <h3><?php the_sub_field('titulo') ?></h3>
	                        <?php the_sub_field('texto') ?>
	                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                
                <?php 
	                $image = get_field('imagem');
	                if($image): ?>
	                <div class="col-xs-12 col-sm-2 col-md-2">
        				<img class="img-dicas img-responsive" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
	                </div>
				<?php endif; ?>
                	                
                <?php if( have_rows('repetidor_direita') ): ?>
                <div class="col-xs-12 col-sm-5 col-md-5">
	                <?php while( have_rows('repetidor_direita') ): the_row(); ?>
	                    <div class="list-dicas alig-left">
	                        <h3><?php the_sub_field('titulo') ?></h3>
	                        <?php the_sub_field('texto') ?>
	                    </div>
                    <?php endwhile; ?>
                </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
    <?php endif; ?>
	
    <?php get_template_part( 'partials/shortcode-modal-send' ); ?>
	
<?php get_footer() ?>
