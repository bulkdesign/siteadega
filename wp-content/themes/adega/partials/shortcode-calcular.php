<div class="container resultado-calculo">
	<img src="<?php echo get_bloginfo('template_directory');?>/images/logo-print.jpg" class="logo-print">
    <div class="list-resultado">
        <div class="row">
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal brut">
                    <h4>Espumante Brut</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal moscatel">
                    <h4>Espumante Moscatel</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal tinto">
                    <h4>Vinho Tinto</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal branco">
                    <h4>Vinho Branco ou Rose</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal whisky">
                    <h4>Whisky</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal vodka">
                    <h4>Vodka</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal cerveja">
                    <h4>Cerveja (long-neck)</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="list-cal licor">
                    <h4>Licores Encerramento</h4>
                    <p><span class="value">0</span> garrafas</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container"> Não alcóolicos
        <div class="list-resultado">
            <div class="row">
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="list-cal energetico">
                        <h4>Energético (lata)</h4>
                        <p><span class="value">0</span> unidades</p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="list-cal energeticoPet">
                        <h4>Energético (pet 1 litro)</h4>
                        <p><span class="value">0</span> unidades</p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="list-cal suco">
                        <h4>Sucos (lata)</h4>
                        <p><span class="value">0</span> unidades</p>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-3 col-md-3">
                    <div class="list-cal sorvete">
                        <h4>Sorvetes (Mini-cup 100 ml)</h4>
                        <p><span class="value">0</span> unidades</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="list-asse">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6"> <a class='imprimir-calculo-page' href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span>imprimir</a> <a data-toggle="modal" data-target="#modalEnviarSidebar" href="#"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>enviar por email</a> </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <ul class="compart">
                        <?php get_template_part( 'partials/shortcode-social' ); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
