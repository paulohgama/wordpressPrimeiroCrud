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
define('AUTH_KEY',         '5)jKo=<YkEn7sD6~@oJUEsbpXbGWqLp$$ug(G. w,?8PtqN>Q<UA#glsyL<b~/gI');
define('SECURE_AUTH_KEY',  ';5DTxMw.D/xJ3Pta}&zK) ]g2WM?@;;i4M&;|,Qx;@)L`:Mt*gGyy(|$i,(3^f=@');
define('LOGGED_IN_KEY',    '9;TkC7 M6=q,eS.:2?A2XF#$4$Z5;fkFLP6p++bhJ}ia|*r<bR)(Bh?Tm4u}NfC5');
define('NONCE_KEY',        '}|w0Hf&lYkoV$?{DKKUPBoPcYtvKGPgYD];jTH]jo 2_}Ctb_Q{:=,lC*16iq3h_');
define('AUTH_SALT',        'eI5+aM=.0;BZVarMo{,_Y+ IaGPY`HIei_?nMgwBK5F*Y}1z^V,s TopznA pNS=');
define('SECURE_AUTH_SALT', '?`y`~_LV~8PU)(*W^jo[k^/TS4.=Dk>a1~D__SQzl#T<l{ ~eaTzwi]Q=pYwvopa');
define('LOGGED_IN_SALT',   'H>1_kTGH7)<sq}GwSxm^BcEg69g_aZ<Ww;g0*%$|C9<5j`vz|0:nLQ]PEmx(b_ka');
define('NONCE_SALT',       'fv/>)6dOdi+:o}R(e[x[,68a6hQCAY e1P_@],L:AD7:i$Ni:a%]M)OrLLb[R$T|');

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
