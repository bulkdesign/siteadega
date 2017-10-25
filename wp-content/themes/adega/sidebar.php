<div class="col-xs-12 col-sm-4 col-md-3">
    <div class="box-arquivos">
        <h4 class="title-arq">Arquivos</h4>
        <ul class="itens-arq">
			<?php 
				wp_get_archives( array(
					'type'   => 'monthly',
					'limit'  => 12,
					//'echo'   => 0,
					'before' => '<li>',
					'after'  => '</li>'
				));
			?>
        </ul>
    </div>
    <div>
        <h4 class="title-arq">Categorias</h4>
        <ul class="itens-arq">
			<?php 
			    $args = array(
					'orderby'            => 'name',
					'order'              => 'ASC',
					'title_li'           => '',
					'hide_empty '		 => 0,
					//'exclude'			 => '-1',
					'show_option_none'   => ''
			    );
			    wp_list_categories( $args ); 
			?>	                    
        </ul>
    </div>
</div>
