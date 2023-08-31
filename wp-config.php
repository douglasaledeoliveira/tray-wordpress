<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do banco de dados
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do banco de dados - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'u955030981_testetray' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'u955030981_douglasaleluia' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 's^z^A1uUii7L' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(0*lBD~lZtPI6Q+p]+rNN0(!)tkLOxjj;Xd-=rv8G[oHNCy(/N;^]Ir{Yd-tvhx=' );
define( 'SECURE_AUTH_KEY',  'JSzlk&tzwL|qnS?Va(>Mg*{uwZHGuH}sCSBh9Bh;>/jjd6$tq?j#OE3:QCX:ZR~F' );
define( 'LOGGED_IN_KEY',    '}%DMo};=iBI&+9!jNt~r_NNOohNs3S8vz6o42o <u;4XL8bcggk(pYC`aaQnt7kD' );
define( 'NONCE_KEY',        '~S .9GiIW=bkC+b?6{v;s^y*6[`U>Qc;6KSn8oRY>m]eLYu:FzHz|]^i.#-,Gp2o' );
define( 'AUTH_SALT',        '^kE|f@YNJ%@VjQGtd($>Nqf,8:P4Qe|= h$.`Y8K,kxXOY@?S>T)h(s#x*d@qD;P' );
define( 'SECURE_AUTH_SALT', '~{ISY2Z3~,gXWS;oc(N{40M6QzR%Te<# {]Ge_Q*7695#vv#&0oONWgO]08%,I&7' );
define( 'LOGGED_IN_SALT',   'l|S?_rQRP!(gA,N)p_C&oq!/g=~tu}EnYX7|{//X{5{]g@!$+TOqX5LVgrFgP(]w' );
define( 'NONCE_SALT',       '0QE;#`6nXJcW_=,q,nn%AY+T<ec^?3!{NDFSGtLR>1[+G vE~&Xg{)gdG&Zh3TJ,' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
