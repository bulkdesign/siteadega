	<!-- footer -->
	<footer>
	    <div class="newsletter">
	        <div class="container">
	            <div class="row">
		            <?php if ( get_field('newsletter', 'option') ): ?>
	                <div class="col-xs-12 col-sm-6 col-md-6">
	                    <h2>Newsletter</h2>
	                    <p><?php the_field('newsletter', 'option') ?></p>
	                </div>
	                <?php endif; ?>
	                <div class="col-xs-12 col-sm-6 col-md-6">
	                    <?php echo do_shortcode( '[contact-form-7 id="125" title="Newsletter - Rodapé"]' ); ?>
                    </div>
	            </div>
	        </div>
	    </div>
	    <div class="rodape">
	        <div class="container">
	            <div class="row">
	                <div class="col-xs-6 col-sm-4 col-md-3">
		                <a class="navbar-brand" href="<?php echo get_home_url('home') ?>/">Chablis</a>
	                </div>
	                <div class="col-xs-6 col-sm-2 col-md-3">
						<?php 
							$menuArray = array(
								'theme_location'  => 'menu_footer',
								'menu_class'      => 'menu-rodape',
								'menu_id'         => 'menu_footer'
							);
							
							wp_nav_menu( $menuArray );				
						?>
	                </div>
	                <div class="col-xs-6 col-sm-3 col-md-3">
		                
		                <?php if ( get_field('telefone_comercial', 'option') ): ?>
	                    <div class="fone">
	                        <h4>Telefone</h4>
	                        <?php the_field('telefone_comercial', 'option') ?>
	                        
	                        <?php if ( get_field('whatsapp', 'option') ): ?>
	                        	<p><span>Whatsapp – <?php the_field('whatsapp', 'option') ?></span></p>
                        	<?php endif; ?>
	                    </div>
	                    <?php endif; ?>
	                    
	                    <?php if ( get_field('horario_de_atendimento', 'option') ): ?>
	                    <div class="horario">
	                        <h4>Horário de atendimento:</h4>
	                        <p><?php the_field('horario_de_atendimento', 'option') ?></p>
	                    </div>
	                    <?php endif; ?>
	                    
	                </div>
	                <div class="col-xs-6 col-sm-3 col-md-3">
		                
		                <?php if ( get_field('endereco', 'option') ): ?>
	                    <div class="endereco">
	                        <h4>Endereço</h4>
	                        <?php the_field('endereco', 'option') ?>
	                    </div>
	                    <?php endif; ?>
	                    
	                    <div class="redesociais">
	                        <h4>Encontre-nos na web:</h4>
	                        <?php if ( get_field('facebook', 'option') ): ?>
	                        	<a href="<?php the_field('facebook', 'option') ?>" class="facebook">facebook</a>
	                        <?php endif; ?>
	                        <?php if ( get_field('instagram', 'option') ): ?>
	                       		<a href="<?php the_field('instagram', 'option') ?>" class="instagram">instagram</a>
	                        <?php endif; ?>
                        </div>
                        
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="direitos">
	        <div class="container">
	            <div class="row">
		            <?php if ( get_field('copyright', 'option') ): ?>
	                	<div class="col-xs-12 col-sm-6 col-md-10 reservado"><?php the_field('copyright', 'option') ?></div>
	                <?php endif; ?>
	                <div class="col-xs-12 col-sm-6 col-md-2 site"><a href="http://www.facebrand.com.br/" target="_blank" title="facebrand.com.br">facebrand.com.br</a></div>
	            </div>
	        </div>
	    </div>
	</footer>
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script> 
	<!-- Include all compiled plugins (below), or include individual files as needed --> 
	<script src="<?php echo get_bloginfo('template_directory');?>/js/bootstrap.min.js"></script> 
	<script src="<?php echo get_bloginfo('template_directory');?>/js/jquery.maskedinput.min.js"></script>
	<script src="<?php echo get_bloginfo('template_directory');?>/js/whatsapp-button.js"></script>
	<script src="<?php echo get_bloginfo('template_directory');?>/js/printThis.js"></script>
	<script src="<?php echo get_bloginfo('template_directory');?>/js/slick.min.js"></script> 
	<script src="<?php echo get_bloginfo('template_directory');?>/js/maps.js"></script> 
	<script src="<?php echo get_bloginfo('template_directory');?>/js/main.js"></script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	 
	  ga('create', 'UA-70084483-1', 'auto');
	  ga('send', 'pageview');
	</script>	
	<?php wp_footer() ?>
</body>
</html>