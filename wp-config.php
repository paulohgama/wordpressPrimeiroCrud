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
define('DB_NAME', 'id7433777_wordpress');

/** MySQL database username */
define('DB_USER', 'id7433777_wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '!fykaT=b&]I{^Nk= Dbzz#OD4C|Rr*#VnQPJolI@4~-sYlB1gn$,DCx|gg1drinV');
define('SECURE_AUTH_KEY',  'VY>W)zxi>eTO%E{0+5Md)-i9qW(U}O_Lg.I*qGJsYON+G&D!a.&e/w*i]KZ%BcJ*');
define('LOGGED_IN_KEY',    'It>q;Aq=0{-PKs|?-gWn:3b}OQWa]bo| UlMkzccGh R]GQY~3/bM/mS?2Xcouqw');
define('NONCE_KEY',        'MIcA|2XFMx!$_DM(2 4om/-5h.[PLQCO l*Ox@a9?1jtC68vR$(%AjYdhY<9E|i-');
define('AUTH_SALT',        'd,E&WXilz9~jlCPsK{y^V%BDvbPb7}_N|f`SE>|4*Q;p]vU.l$TvVr6Hb]>LEKbw');
define('SECURE_AUTH_SALT', '.AUO#q= >iaH ne.6<h`^m@NN&cDV*x@x5Qh5 }SlQ:E[Rgg&L65jn]<i%|d9)eM');
define('LOGGED_IN_SALT',   '6~SS4qaXP.UrDH5T=:MU2CFH;iGt fm5>Ee*5;ueBck?D/*9]Rvvf&Jk8n&_N668');
define('NONCE_SALT',       '}+?i#M1aB(+uKaZL:ZPFp&zr:ri8-%i]Q$AIr^N[b&uQT)u{lQb501$=]Di>E2^ ');

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
