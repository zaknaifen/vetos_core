<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'vetos_core');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'o|LMse5$~nW06i-f,G#MzLLtLHAUm P2U?)Vv>=4xkeixJX]34.t+U,fwJ4BFul3');
define('SECURE_AUTH_KEY',  'St!$WbpP6Lx|SBnJ7b4ln`2z=StLA3fy_ayhSJ+H^y)8V:A&_k?@8uQ&wN3#Vcq[');
define('LOGGED_IN_KEY',    'N}Bx-KK%+lkF{;l{*DZwDITnx=1NA&5ffD[=<mbDhl!XXnl%u7cpv5-}<g4M/:xR');
define('NONCE_KEY',        '4z~1ZEW/IQ5lR=_TlV6h310yK?[a;kl:r-{x|=?L62+OPS 2c^dUUS=R9wM8kZht');
define('AUTH_SALT',        'i =Sf)xe[W|$N%BHNFEB^{,ETD|O!M34:^/RR?XRHIn3ML0)42=AzMo7<1,H;DMI');
define('SECURE_AUTH_SALT', '_X*I<;+aA &6tyg@Vr=L#4]ESRZGss9V1%ab^wW5,as7lL$l{X]~|^e2m9epFpt]');
define('LOGGED_IN_SALT',   '{m<1-%<QM9 )N<Enq_kXGo-_8M?WxG`5QrV,%C76Eu@aC}OK]l|?fEFagq{uez. ');
define('NONCE_SALT',       ';(2-zt3MPbclbXc./L.wQM!we`L^&55>$bg$Ri!7%/1Da!S[Y^`wcp#S244(RS~O');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
