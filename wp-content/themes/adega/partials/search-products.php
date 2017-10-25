<?php get_header() ?>

	<?php the_post() ?>
	<!-- title -->
	<?php get_template_part( 'partials/partial-title-default' ); ?>
	
	<!-- banner -->
	<?php //get_template_part( 'partials/shortcode-slider' ); ?>

	<!-- produtos -->
	<div class="produtos">
	    <div class="line-calcular">
	        <div class="container">
	            <h3>Que produto procura?</h3>
	            <div class="box-proc">
                    <div class="select-calcular">
	                    <?php echo do_shortcode('[searchandfilter id="287"]'); ?>
                    </div>
	            </div>
	        </div>
	    </div>
	    <div class="container">
	        <div class="row">
				<?php get_template_part( 'partials/shortcode-simulator' ); ?>
				
				<?php
					if ( have_posts() ) :
				?>
	            <div class="col-xs-12 col-sm-12 col-md-9" id="products-resultado">
	                
	                <?php while ( have_posts() ) : the_post(); ?>
	                <div class="list-produtos">
	                    <div class="row">
							<?php if ( has_post_thumbnail() ) { ?>
	                        	<div class="col-xs-12 col-sm-3 col-md-3 img-prod">
									<?php the_post_thumbnail( 'foto-produto' ); ?>
		                        </div>
							<?php } ?>		                        
	                        <div class="col-xs-12 col-sm-9 col-md-9 id-<?php the_ID(); ?>">
	                            <h2 class="name-prod"><?php the_title() ?></h2>
	                            <a href="#fb-comments" class="msg-prod scroll">
		                            <img src="<?php echo get_bloginfo('template_directory');?>/images/icon-msg.png">
	                            </a>
	                            <div class="conteudo-prod">
		                            
		                            <?php if ( get_field('descricao_pais') ): ?>
	                                <div class="pais <?php the_field('pais') ?>">
	                                    <?php the_field('descricao_pais') ?>
	                                </div>
	                                <?php endif; ?>
	                                
	                                <?php if ( get_field('especificacao') ): ?>
	                                <div class="especifi">
	                                    <?php the_field('especificacao') ?>
	                                </div>
	                                <?php endif; ?>
	                                <?php $premios = ''; ?>
	                                <?php if( have_rows('repetidor') ): ?>
	                                <div class="premios">
	                                    <p><strong>Premiações:</strong></p>
	                                    <?php while( have_rows('repetidor') ): the_row(); ?>
	                                    	<p class="icon-premio"><?php the_sub_field('premiacao') ?></p>
	                                    	<?php $premios .= '<p class="icon-premio">'. get_sub_field('premiacao').'</p>'; ?>
                                    	<?php endwhile; ?>
	                                </div>
	                                <?php endif; ?>
	                                
	                                <?php if ( get_field('descricao_produto') ): ?>
	                                <div class="descricao">
	                                    <p><strong>Sommelier Chablis</strong></p>
	                                    <p><?php the_field('descricao_produto') ?></p>
	                                    <p class="preco">Preço: <?php the_field('preco') ?></p>
	                                </div>
	                                <?php endif; ?>
	                                
	                                <div class="quant-orc">
	                                    <form>
	                                        <p>Escolha a quantidade</p>
	                                        <div class="select-orc">
	                                            <select class="form-control qtde" data-max="<?= get_field('quantidade');?>"><?php
		                                            $i = 0;
		                                            for ($i = 1; $i <= get_field('quantidade'); $i++) {
													    echo '<option>'.$i.'</option>';
													} ?>
	                                            </select>
	                                        </div>
	                                        <button type="button" class="btn btn-default btn-orcamento"
	                                        		data-id='<?php the_ID(); ?>'
	                                        		data-preco='<?php the_field('preco') ?>'
	                                        		data-nome='<?php the_title() ?>'
	                                        		data-desc='<?= htmlspecialchars(get_field('especificacao')) ?>'
	                                        		data-premio='<?= $premios ?>'
	                                        		data-pic='<?php the_post_thumbnail( 'foto-produto' ); ?>'
	                                        		>Adicionar ao orçamento</button>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
					<?php endwhile; ?>
					<?php if(function_exists('wp_pagenavi')) { 
						wp_pagenavi(); 
					} ?>					
	            </div>
				<?php endif; ?>	  
				       
	        </div>
	    </div>
	    <div class="line-orcamento">
	        <div class="container">
	            <h3 class="qtde-total">Nenhum item adicionado ao orçamento</h3>
	            <a class="btn btn-abrir" href="#">ABRIR</a>
            </div>
	    </div>
	    <div class="box-orcamento">
	        <div class="container">
		        <a class="btn bt_Close">Fechar</a>
		        <div class="enviando">Enviando...</div>
		        <div class="resposta">Orçamento enviado com sucesso.</div>
	            <div class="tabela">
	                <div class="header-tabela">
	                    <div class="row">
	                        <div class="col-xs-12 col-sm-6 col-md-2">Produto</div>
	                        <div class="col-xs-12 col-sm-1 col-md-4 mob">&nbsp;</div>
	                        <div class="col-xs-12 col-sm-3 col-md-3 mob">Quantidade</div>
	                    </div>
	                </div>
	                <div class="body-tabela"></div>
	            </div>
	            <div class="form-final">
	                <h2>FINALIZE SEU ORÇAMENTO</h2>
	                <div class="formu">
	                    <form>
	                        <div class="form-group">
	                            <label for="nome">Nome completo</label>
	                            <input type="text" class="form-control" id="nome">
	                        </div>
	                        <div class="form-group">
	                            <label for="email">Email</label>
	                            <input type="email" class="form-control" id="email">
	                        </div>
	                        <div class="form-group">
	                            <label for="telefone">Telefone</label>
	                            <input type="text" class="form-control tel" id="telefone" placeholder="DDD + telefone">
	                        </div>
	                        <div class="form-group">
	                            <label for="data">Data do evento</label>
	                            <input type="text" class="form-control data" id="data" placeholder="DD/MM/AAA">
	                        </div>
	                        <div class="form-group">
	                            <label for="convidados">NÚMERO DE CONVIDADOS:</label>
	                            <input type="text" class="form-control" id="convidados">
	                        </div>
	                        <div class="form-group msg">
	                            <label for="">Observação:</label>
	                            <textarea cols="40" rows="8" class="form-control" id="obs"></textarea>
	                        </div>
	                        <div class="form-group">
		                        <input type="checkbox" name="" id="evento">
		                        <label for="">Não necessito para evento</label>
	                        </div>
	                        <button type="submit" class="btn btn-default btn-enviar enviar-orcamento">solicitar orçamento</button>
	                    </form>
	                </div>
	                <div class="list-asse">
	                    <div class="row">
	                        <div class="col-xs-12 col-sm-7 col-md-6">
		                        <a class='btn-imprimir' href="#"><span class="glyphicon glyphicon-download" aria-hidden="true"></span>salvar</a>
		                        <a class='btn-imprimir' href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>imprimir</a>
		                        <a href="#" data-toggle="modal" data-target="#modalEnviar"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>enviar por email</a> </div>
	                        <div class="col-xs-12 col-sm-5 col-md-6 redes">
	                            <ul>
	                                <?php get_template_part( 'partials/shortcode-social' ); ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	
	</div>
	
<?php get_footer() ?>
