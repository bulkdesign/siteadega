<?php get_header() 
	
/* Template Name: Contato */
	
?>

	<?php the_post() ?>
	<!-- title -->
	<?php get_template_part( 'partials/partial-title-default' ); ?>
	
	<!-- contato -->
	<div class="linha-contato">
	    <div class="container">
	        <div class="row">
	            <div class="col-xs-12 col-sm-12 col-md-3">
	                <h4>Endereço:</h4>
	                <p>
	                    <?php the_field('endereco') ?>
	                </p>
	            </div>
	            <div class="col-xs-12 col-sm-12 col-md-3">
	                <h4>Telefone:</h4>
	                <p>
	                    <?php the_field('telefone') ?>
	                </p>
	            </div>
	            <div class="col-xs-12 col-sm-12 col-md-3">
	                <h4>Reposição 24h:</h4>
	                <p>
	                    <?php the_field('reposicao_24h') ?>
	                </p>
	            </div>
	            <div class="col-xs-12 col-sm-12 col-md-3">
	                <h4>email:</h4>
	                <p><a href="mailto:<?php the_field('e-mail') ?>">
	                    <?php the_field('e-mail') ?>
	                    </a></p>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="form-contato">
	    <div class="container"> <?php echo do_shortcode( '[contact-form-7 id="4" title="Formulário - página de contato"]' ); ?> </div>
	</div>
	<?php
	    $location = get_field('mapa');
	    
	    if(!empty($location)):
	?>
		<div class="mapa">
		    <div class="content_Mapa" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
		</div>
	<?php endif; ?>
	
<?php get_footer() ?>
