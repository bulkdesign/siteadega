<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'site_adega');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');
/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'b$Or,^6[nL+RlO9yhUW;^:w-hVwYGSg]WyG+#W#9QV9HF+]6.wM[01-KHzf*}L/4');
define('SECURE_AUTH_KEY',  'nbxk^*UCG|@c9U|>@!7u%82&DH76q](WBa$YRAtB|+FyHVf9DgwO2R?QF+wHZ}2#');
define('LOGGED_IN_KEY',    'P,dG9YI R=L*y,~P& 0[K_ng??8XpyH6|-IS/fZ/F$rPV#{q}N9`FnVnz@t<|3f<');
define('NONCE_KEY',        'e|]rj MqhsUbZ1fbH5FgKYG:>k4e~Q)jBl*}(aA.qTnn.(_[|]-EyjTOEovidk,:');
define('AUTH_SALT',        '-[]Hh[m3Z?-,u&ZZYcRh%+8p||IoD{B`avYE-r?8*v}lpeLPV.F&4W2D=CnT;|BT');
define('SECURE_AUTH_SALT', '_AhD70vSs/a^>+J;ph$x+jYVIxY/;M,+6_?0]1ICF]S`|TO+v7r0wB+_VNRT=X-X');
define('LOGGED_IN_SALT',   'H([@K+;V2RPYKj7lt_gEraZRw-Dai`Ql6NP|fC|Tp|%kF)N+[G5Z)9I0E{{|5%}p');
define('NONCE_SALT',       'Mc1V:]2X%BXI<4Szz+0MkCzTUiJ,|f dHZ7n <JX?L~mC!h|-+:B!_?[9^SSFdt|');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);
define( 'JETPACK_DEV_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
