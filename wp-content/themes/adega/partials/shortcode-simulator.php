<div class="col-xs-12 col-sm-12 col-md-3 alig-r">
    <div class="row">
        <div class="col-xs-7 col-sm-7 col-md-12 box-duvi">
            <p>Dúvidas com relação à quantidade?</p>
        </div>
        <div class="col-xs-5 col-sm-5 col-md-12 box-duvi simu">
	        <img src="<?php echo get_bloginfo('template_directory');?>/images/icon-calculadora.png">
	        <a href="#" data-toggle="modal" data-target="#modalCalcular">Acesse nosso simulador</a>
        </div>
    </div>
</div>

<!-- modal calcular -->
<div class="modal fade" id="modalCalcular" tabindex="-1" role="dialog" aria-labelledby="modalCalcularLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <button type="button" class="close close-calcular" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="modal-body">
                <div class="box-modal">
                    <h2 class="title-modal">Simulador</h2>
                    <p>CALCULE A QUANTIDADE DE BEBIDAS PARA O SEU EVENTO</p>
                    <form>
<!--
                        <select class="form-control">
                            <option>Selecione o evento</option>
                            <option>Casamento</option>
                            <option>15 anos</option>
                            <option>Corporativos</option>
                            <option>Sociais</option>
                        </select>
-->
						<span class="controls">
	                        <input type="text" class="form-control txt-pessoas" id="calcular" placeholder="Nº de convidados">
	                        <button type="button" class="btn btn-default btn-calcular">Calcular</button>
						</span>
                    </form>
                </div>
                	<span class="resultado-calculo">
                    <div class="list-resultado">
				        <div class="row">
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal brut">
				                    <h4>Espumante<br/>Brut</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal moscatel">
				                    <h4>Espumante<br/>Moscatel</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal tinto">
				                    <h4>Vinho<br/>Tinto</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal branco">
				                    <h4>Vinho Branco<br/>ou Rose</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal whisky">
				                    <h4>Whisky<br/>(garrafa)</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal vodka">
				                    <h4>Vodka<br/>(garrafa)</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal cerveja">
				                    <h4>Cerveja<br/>(long-neck)</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				            <div class="col-xs-6 col-sm-3 col-md-3">
				                <div class="list-cal licor">
				                    <h4>Licores<br/>Encerramento</h4>
				                    <p><span class="value">0</span> garrafas</p>
				                </div>
				            </div>
				        </div>
				    </div>
				    <p>Não alcóolicos</p>
			        <div class="list-resultado">
			            <div class="row">
			                <div class="col-xs-6 col-sm-3 col-md-3">
			                    <div class="list-cal energetico">
			                        <h4>Energético<br/>(lata)</h4>
			                        <p><span class="value">0</span> unidades</p>
			                    </div>
			                </div>
			                <div class="col-xs-6 col-sm-3 col-md-3">
			                    <div class="list-cal energeticoPet">
			                        <h4>Energético<br/>(pet 1 litro)</h4>
			                        <p><span class="value">0</span> unidades</p>
			                    </div>
			                </div>
			                <div class="col-xs-6 col-sm-3 col-md-3">
			                    <div class="list-cal suco">
			                        <h4>Sucos<br/>(lata)</h4>
			                        <p><span class="value">0</span> unidades</p>
			                    </div>
			                </div>
			                <div class="col-xs-6 col-sm-3 col-md-3">
			                    <div class="list-cal sorvete">
			                        <h4>Sorvetes<br/>(Mini-cup 100 ml)</h4>
			                        <p><span class="value">0</span> unidades</p>
			                    </div>
			                </div>
			            </div>
				        <div class="list-asse">
				            <div class="row">
				                <div class="col-xs-12 col-sm-6 col-md-6"> <a class='imprimir-calculo' href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>imprimir</a> <a data-toggle="modal" data-target="#modalEnviarSidebar" href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>enviar por email</a> </div>
				                <div class="col-xs-12 col-sm-6 col-md-6">
				                    <ul class="compart">
				                        <?php get_template_part( 'partials/shortcode-social' ); ?>
				                    </ul>
				                </div>
				            </div>
				        </div>
				    </div>
                	</span>
            </div>
        </div>
    </div>
</div>
