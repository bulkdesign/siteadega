<?php get_header() 
	
/* Template Name: Degustação */
	
?>

	<?php the_post() ?>
	<!-- title -->
	<?php get_template_part( 'partials/partial-title-default' ); ?>
		
	<!-- agenda -->
	<div id="agenda" class="box-agenda interna">
		<div class="container">
			<?php the_content() ?>
		</div>
		<div class="container calendario">
			<?php echo do_shortcode( '[contact-form-7 id="244" title="Formulário - Agendamento"]' ); ?>
		</div>
	</div>
	
<?php get_footer() ?>
