<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="keywords" content="<?php the_field('palavras_chave','option') ?>">
    <meta name="description" content="<?php the_field('descricao_do_site','option') ?>">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>
    <?php wp_title( '-', true, 'right' ); echo esc_html( get_bloginfo('name'), 1 ) ?>
    </title>
    
    <!-- Favicon -->
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/android-chrome-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo get_bloginfo('template_directory');?>/images/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-TileImage" content="<?php echo get_bloginfo('template_directory');?>/images/favicon/mstile-144x144.png">
	<meta name="theme-color" content="#ffffff">
	
    <!-- Bootstrap -->
    <link href="<?php echo get_bloginfo('template_directory');?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- style -->
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url') ?>" />
    <link href="<?php echo get_bloginfo('template_directory');?>/css/slick.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo('template_directory');?>/css/style.css" rel="stylesheet">
    <?php wp_head() // For plugins ?>

    <!-- fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
    <script>
      WebFont.load({
        google: {
          families: ["Lato:100,100italic,300,300italic,400,400italic,700,700italic,900,900italic","Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Great+Vibes::latin"]
        }
      });
    </script>

    <!-- For Facebook -->
    <div id="fb-root"></div>
    <script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4&appId=219663938045196";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

    <!-- For WhatsApp -->
    <script type="text/javascript">
		if(typeof wabtn4fg==="undefined"){wabtn4fg=1;h=document.head||document.getElementsByTagName("head")[0],s=document.createElement("script");s.type="text/javascript";s.src="<?php echo get_bloginfo('template_directory');?>/js/whatsapp-button.js";h.appendChild(s);}
	</script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

	<!-- chat -->
	<div class="box-chat hidden-xs hidden-sm">
		<a href="javascript:$zopim.livechat.window.show()">
			<img src="<?php echo get_bloginfo('template_directory');?>/images/chat.png">
		</a>
	</div>
	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top">
        <div class="container">
	        <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                	<span class="sr-only">Toggle navigation</span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                	<span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo get_home_url('home') ?>/">Chablis</a>
            </div>
			<?php 
				$menuArray = array(
					'theme_location'  => 'menu_default',
					'container'       => 'nav',
					'container_class' => 'navbar-collapse collapse',
					'container_id'    => 'navbar',
					'menu_class'      => 'nav navbar-nav',
					'menu_id'         => 'menu_default'
				);
				
				wp_nav_menu( $menuArray );				
			?>
	        <!--/.nav-collapse -->
	        <div class="busca">
		         <?php echo do_shortcode('[searchandfilter id="160"]'); ?>
            </div>
	    </div>
    </nav>
