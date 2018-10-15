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
define('AUTH_KEY',         'L3WeMs0F6P^ng!;0lc]rM!!_Z&/]t|,-0i7@f9++1OSk}x7X@UM:oekHAedsLhlf');
define('SECURE_AUTH_KEY',  'wf|~gm3K@j{Udt}50?`;a>c.+Pz^3fz|OEJWkb@-W:%Y6^5`9WaLT5[M&A@@qSbx');
define('LOGGED_IN_KEY',    '<2c$n:1q<N0wAwZi7xL8kNF!f9hHHBvxM^msj+O%X<MD3d5x-I QJhngh2QE/nKA');
define('NONCE_KEY',        'm}g{&=sKI>y,(F$BIT-/XEaSxC}Tnez#f:o<s~=HC`./TP/k58HAKw{,x3GQs>}z');
define('AUTH_SALT',        '[V|:k$:29F_Zkhg&3o#V.254:7@[1S75MPDU|6lBn`ue)-c_!2M,6j$8c183*pVd');
define('SECURE_AUTH_SALT', '8#OW/odmt(Isa+`KCHY}Gha:I`lMUKs^bhzbB=|#?gG{>Ks+an6h(Og[SXI*B<,~');
define('LOGGED_IN_SALT',   '6&JUjS{T~=#psgoasfP%b`(5l}B;fp&sVBrh_wfz4E|[M?O-[6 OQ.D7v?`I^Vdm');
define('NONCE_SALT',       'hx)4QW3.7k]ZuHnsF!;#)iEo BrCsNGr5}At^[PY#c~X,T>U_H%+v%>F^>G&/v+Z');

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
