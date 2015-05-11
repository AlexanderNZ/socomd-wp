<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'socomd-wordpress');

/** MySQL database username */
define('DB_USER', 'alex');

/** MySQL database password */
define('DB_PASSWORD', 'alex');

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
define('AUTH_KEY',         ' RU+z5-~rMV(B+U$n#mP`vKq6DB3wATk;6$lQOIgY&@ah6=`**dygqA*PV$m*avg');
define('SECURE_AUTH_KEY',  'S5?O-;Xt{=05F6S-X;^[,A!CaK[Qi)ZGlWRC*@(bCtAAR^H~BmO<Kx`1Q$xsaAi#');
define('LOGGED_IN_KEY',    '(6i,[&*=(@&XIPO0>11hrbsS&aQIU2~yGL>#R,{6$T_w9Ks?>L>fj&&1E-(gj;O5');
define('NONCE_KEY',        '_=x4ZtNv+=m.QkrC4^AT|3:Z>W*17jKW+o:<r@NP.#7vWbf*$<N|]!BIjQ;?mBP$');
define('AUTH_SALT',        'sc=M}ZjJ9^E.r;OmB%|7t`Vn:#]kLfF!?h?i(P#Mc_?Ol,!j}2om|ZX6#Bl`&95V');
define('SECURE_AUTH_SALT', '`c]:ctJJ8%R;XuvmxIZv Q]GyJ`3&mY(glGkhxA*sgM-YZz.f[6Hd<5Giiad] S/');
define('LOGGED_IN_SALT',   '(#5m}W&;7^<CR|++;!7?zlEl+FDnq(XH>m`,MI)=]ZpuIfB|V+8N1 D?.0w|}+~,');
define('NONCE_SALT',       'SR769(7N,&v6iN-88b|waXl|R%Oh$[@X@4oOCq{R,lBgcJ?sem-xO7$>~D?05KHD');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
