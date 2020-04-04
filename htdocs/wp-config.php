<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'adrootcouk_434928_db1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'jtI(m?x!k4|-&Zv1`<MACa+6rc+p/-i6&eRg+sO*,:C:||j{TWO|XMO|/^XyFFt@');
define('SECURE_AUTH_KEY',  '1.V&Q$V7+Ccu|k(<}R-`<p|j3e(Y+<MhKP( ?Gly|-9,E+P5=-z#2@l*$-B:`@LG');
define('LOGGED_IN_KEY',    'noQ%Xs|Rm:v@)UlD-zq]zCt7-@C!WMn-A-SQ1qSn3.&}6AtfJ0w= Y# l^$<8,#t');
define('NONCE_KEY',        'Zz-0uwp:S$BLk!5,z,|Et/)--y^t~7d(-TQ2Mx._+LASmQJ7:-s9g#DaR}+.Nk?Z');
define('AUTH_SALT',        ',GhTl&pa_U,U2HrUF@CLc; >RfgN.g@)CIuyRiJrQF.-8lj~RDav-0;*1!|D7}Vr');
define('SECURE_AUTH_SALT', '_3z8.]5~4|@TZy|}c78B&CJLo!Xv+#|2edPvaj_++I@vN$!F$73lXO6@f_wk;+<[');
define('LOGGED_IN_SALT',   'hg}Xy87;-/1U6}PHYb=> =HRsmq-lEJ>CX=v4+Nx3pfNT,M)ri0QvwRj1X%2i&qV');
define('NONCE_SALT',       'D/2?Q18=<x!:K7m[UJ8UPe$[-Ti;~?M~!82o_x*22W4Z%v|`|+>*To VC*gTNv&M');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'adr_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress.  A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de.mo to wp-content/languages and set WPLANG to 'de' to enable German
 * language support.
 */
define ('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);
define( ‘WP_MEMORY_LIMIT’, ‘256M’ );

define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', 'localhost' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1);
define( 'BLOG_ID_CURRENT_SITE', 3 );

define('WP_HOME','http://localhost');
define('WP_SITEURL','http://localhost');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_ALLOW_MULTISITE', true);