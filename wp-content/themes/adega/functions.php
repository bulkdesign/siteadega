<?php

//jetpack
add_filter( 'jetpack_development_mode', '__return_true' );

/*
add_theme_support( 'infinite-scroll', array(
    'type'           => 'scroll',
	'wrapper'        => false,
	'container'      => 'content',
	'footer_widgets' => false,
	'footer'         => false,
	'posts_per_page' => false,
	'render'         => false
) );
*/

function pinkstone_remove_jetpack() {
	if( class_exists( 'Jetpack' ) && !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'jetpack' );
	}
}
add_action( 'admin_init', 'pinkstone_remove_jetpack' );

//thumbs	
add_theme_support( 'post-thumbnails' );
add_image_size( 'foto-page', 1920, 263, true );
add_image_size( 'list-news', 832, 407, true );
//add_image_size( 'foto-produto', 77, 281, true );
add_image_size( 'foto-produto', 155, 295, true );
add_image_size( 'foto-produto-home', 155, 368, true );
add_image_size( 'foto-depoimento', 155, 155, true );

//remove a da img
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);	

//menu
function register_my_menu() {
  register_nav_menu('menu_default',__( 'Menu Default' ));
  register_nav_menu('menu_footer',__( 'Menu Footer' ));
}
add_action( 'init', 'register_my_menu' );

//options page
if( function_exists('acf_add_options_sub_page') )
{
    acf_add_options_sub_page(array(
        'title' => 'Opções do Tema',
		'page_title' 	=> 'Opções do Tema',
		'menu_title' 	=> 'Opções do Tema',
		'menu_slug' 	=> 'opcoes-do-tema',
        'parent' 		=> 'themes.php',
        'capability' 	=> 'manage_options'
    ));
}

//plugins datepicker
function load_jquery_ui_google_cdn() {
    global $wp_scripts;
 
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-slider');
 
    // get the jquery ui object
    $queryui = $wp_scripts->query('jquery-ui-core');
 
    // load the jquery ui theme
    $url = "http://ajax.googleapis.com/ajax/libs/jqueryui/".$queryui->ver."/themes/smoothness/jquery-ui.css";
    wp_enqueue_style('jquery-ui-smoothness', $url, false, null);
}
 
add_action('wp_enqueue_scripts', 'load_jquery_ui_google_cdn');


//// enviar email por ajax

add_action( 'wp_ajax_emailAjax', 'wpse_sendmail' );
add_action( 'wp_ajax_nopriv_emailAjax', 'wpse_sendmail' );

add_action('wp_head','create_ajaxurl');
function create_ajaxurl() {
	?>
	<script type="text/javascript">
	var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
	</script>
	<?php
}

function wpse_sendmail()
{
	$result = $_POST['tipo'];	
	if($_POST['tipo']=='orcamento'){ //aqui começa o email q vai pra loja solicitando orçamento
	
		$message = '<html><body>';
		$message.= '<h1>'.$_POST['nome'].'</h1>';
		$message.= '<h2>'.$_POST['email'].' - '.$_POST['telefone'].'</h2>';
		$message.= '<h3>Evento dia '.$_POST['data'].' para '.$_POST['convidados'].' convidados</h3>';
		$message.= '<br/>';
		
		if ($_POST['evento'] != ''){
			$message.= $_POST['evento'];
		}
		
		$message.= '<br/>';
		
		if ($_POST['msg'] != ''){
			$message.= $_POST['msg'];
		}
		
		$message.= '<br/>';
		$message.= '<table style="width:100%; border: 1px solid;" border="1" >';
			
		$produtos = $_POST['carrinho'];
		
		foreach($produtos as $p){	
			
			$message.= '<tr><td width="100px">';
			$message.= stripslashes( $p['pic'] );
			$message.= '</td><td>';
			$message.= '<table style="width:100%; border: 1px solid;" border="1"><tr><td>';
			$message.= $p['nome'];
			$message.= '</td></tr><tr><td>';
			$message.= $p['desc'];
			$message.= '</td></tr><tr><td>';
			$message.= $p['preco'];
			$message.= '</td></tr></table></td><td>';
			$message.= $p['qtde'];
			$message.= '</td></tr>';
		}
			
		$message.= '</table>';
		$message .= '</body></html>';
		
		$to = 'vendas@adegachablis.com.br';
		$subject = 'Solicitação de Orçamento enviada pelo site';
		
	}elseif($_POST['tipo']=='orcamento_email'){ //aqui começa o email q o usuario manda pra ele mesmo
		$message = '<html><body>';
		$message.= '<h1>Or&ccedil;amento</h1>';
		$message.= '<br/>';
		$message.= '<table style="width:100%; border: 1px solid;" border="1" >';
			
		$produtos = $_POST['carrinho'];
		
		foreach($produtos as $p){	
			
			$message.= '<tr><td width="100px">';
			$message.= stripslashes( $p['pic'] );
			$message.= '</td><td>';
			$message.= '<table style="width:100%; border: 1px solid;" border="1"><tr><td>';
			$message.= $p['nome'];
			$message.= '</td></tr><tr><td>';
			$message.= $p['desc'];
			$message.= '</td></tr><tr><td>';
			$message.= $p['preco'];
			$message.= '</td></tr></table></td><td>';
			$message.= $p['qtde'];
			$message.= '</td></tr>';
		}
			
		$message.= '</table>';
		$message .= '</body></html>';
		
		$to = $_POST['email'];
		$subject = 'Orçamento enviado pelo site Chablis.';
		
	}elseif($_POST['tipo']=='calculo'){ //aqui é o email da calculadora
		$message = '<html><body>';
		$message.= '<h1>C&aacute;lculo de bebidas</h1>';
		$message.= '<br/>';
			
		$message.= $_POST['resultado'];
		$result.= $_POST['resultado'];
			
		$message .= '</body></html>';
		
		$to = $_POST['email'];
		$subject = 'Cálculo de bebidas enviado pelo site Chablis.';
	}
	
	$headers = array('Content-Type: text/html; charset=UTF-8');
	
	$result.=wp_mail( $to, $subject, $message, $headers );

	echo $result;
    die();
}

?>