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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'isn_learn' );

/** MySQL database username */
define( 'DB_USER', 'e_learning' );

/** MySQL database password */
define( 'DB_PASSWORD', 'wX4hdYDGfmHtXXtA' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.`EXwEOm,CqHKy/W.ihQi<ppBs,3g7t/<I;N&zKxJ8-jy*f*/v++%h93&]<A4 $/' );
define( 'SECURE_AUTH_KEY',  'ga=`XgUzG@8a?!I/GOvfAYEY6dBE++@)*v+yR(XpA!^:NB>@]9qS:xm`3FQS-Ov8' );
define( 'LOGGED_IN_KEY',    '&F2ufN!~Z>ir;CAv35;~k6m<:A+Q$x4q.VH{{ABD(X(rp(3=-{Dz.oIIeN~)z?08' );
define( 'NONCE_KEY',        'P{BkWm%+J/LmRS8%/LhW=#<,f!(-E&!M$N|fGO%!2|/`qeQpc#~kq@w9<lsPW!wX' );
define( 'AUTH_SALT',        'gt:TB*3$=|ibl!6Pejb):D6N97 iWsXaOx77o4f1T<}7dBzH_Q4p%<< )o  qd_e' );
define( 'SECURE_AUTH_SALT', ')@:hOZ;Cu}Pe)X{7C<]eV# )Z1qaz^_g[YUae#Z.l:pU4tIbAT5LOK2ohYFYhQpO' );
define( 'LOGGED_IN_SALT',   'gl$2FOh3~<,wiDzlqv]qg:HBV![cq>O3K*llPDI([j[sc1RHl/=8HZ.R:6gG}0hr' );
define( 'NONCE_SALT',       'GtwI^K-}bU%U#poi=mf7/,:f4EtQ-Sj2{i^w+@<TUH&U>nP6n_LKjcH54~^@T6{,' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

define('FS_METHOD','direct');

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
