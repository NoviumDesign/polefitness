<?php
/**
 * Baskonfiguration för WordPress.
 *
 * Denna fil används av wp-config.php-genereringsskript under installationen.
 * Du behöver inte använda webbplatsen, du kan kopiera denna fil direkt till
 * "wp-config.php" och fylla i värdena.
 *
 * Denna fil innehåller följande konfigurationer:
 *
 * * Inställningar för MySQL
 * * Säkerhetsnycklar
 * * Tabellprefix för databas
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// Fix local dev over lan
$s = empty($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
$port = ($_SERVER['SERVER_PORT'] == '80') ? '' : (":".$_SERVER['SERVER_PORT']);
$url = "http$s://" . $_SERVER['HTTP_HOST'] . $port;
define('WP_HOME', $url);
define('WP_SITEURL', $url);
unset($s, $port, $url);

// ** MySQL-inställningar - MySQL-uppgifter får du från ditt webbhotell ** //
/** Namnet på databasen du vill använda för WordPress */
define('DB_NAME', 'polefitness');

/** MySQL-databasens användarnamn */
define('DB_USER', 'root');

/** MySQL-databasens lösenord */
define('DB_PASSWORD', 'root');

/** MySQL-server */
define('DB_HOST', 'localhost');

/** Teckenkodning för tabellerna i databasen. */
define('DB_CHARSET', 'utf8mb4');

/** Kollationeringstyp för databasen. Ändra inte om du är osäker. */
define('DB_COLLATE', '');

/**#@+
 * Unika autentiseringsnycklar och salter.
 *
 * Ändra dessa till unika fraser!
 * Du kan generera nycklar med {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Du kan när som helst ändra dessa nycklar för att göra aktiva cookies obrukbara, vilket tvingar alla användare att logga in på nytt.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Z(YgnH-3]q#k+U^i-)Vj;8P$!M(E@+@a6|LR|_/K|/WOinpYvv8-rgbkpu>!{k^P');
define('SECURE_AUTH_KEY',  '.8#Z%4;b6}h!l-2H[!&fRl*k3dY{vo-EB>LNF7 p.w^_8.v)#YYJtxQia+vdlhW.');
define('LOGGED_IN_KEY',    '*K}D|..[6Iw(zK;oh;B}Q(MWOf,-a/-s`>aJY>mf5:4TpRyd.9FdWWOF$8.U#* [');
define('NONCE_KEY',        'sz:M`)~;+>?)A-`X*7p1kAE=2VXuri(6loA^BRFAgpZ9F1B7n][|A<}4+`]0!??7');
define('AUTH_SALT',        'n]Wgv(k{at5SLmA1yNQqB=4QwE4(^0ba@PJ,8mAN-4rAI3{w5Iz?c-&:#zV.=d]W');
define('SECURE_AUTH_SALT', '~L%&Tk[%>t`<]``yJ52^#Ko{_KYrv-2yk;?EvS5x2(i-k0@lRVY5N8h;S5Nt;&2J');
define('LOGGED_IN_SALT',   'D@9Z*|@KQ?Q_C=qKx-)@A+iY[N75deuf=bD_-[*w^_n/`Z~/*YF+q+XE5/T ;3q3');
define('NONCE_SALT',       'ebbHl2SZ:GM1M#vR$%B2k>yFli+h5F|-iO&[||%) oa-ZBy~l.9[/p[&VEquA@#v');

/**#@-*/

/**
 * Tabellprefix för WordPress Databasen.
 *
 * Du kan ha flera installationer i samma databas om du ger varje installation ett unikt
 * prefix. Endast siffror, bokstäver och understreck!
 */
$table_prefix  = 'pole_';

/** 
 * För utvecklare: WordPress felsökningsläge. 
 * 
 * Ändra detta till true för att aktivera meddelanden under utveckling. 
 * Det är rekommderat att man som tilläggsskapare och temaskapare använder WP_DEBUG 
 * i sin utvecklingsmiljö. 
 *
 * För information om andra konstanter som kan användas för felsökning, 
 * se dokumentationen. 
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */ 
define('WP_DEBUG', true);

/* Det var allt, sluta redigera här! Blogga på. */

/** Absoluta sökväg till WordPress-katalogen. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Anger WordPress-värden och inkluderade filer. */
require_once(ABSPATH . 'wp-settings.php');