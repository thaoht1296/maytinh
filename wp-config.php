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
define( 'DB_NAME', 'maytinh' );

/** MySQL database username */
define( 'DB_USER', 'user_maytinh' );

/** MySQL database password */
define( 'DB_PASSWORD', 'b17dcat169' );

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
define( 'AUTH_KEY',         '``g7tCCN3*9M62Ee+9 _(~FO_enuURUAj.$ucX&gUH|CI^`[)nNNq^rF@${qRK`+' );
define( 'SECURE_AUTH_KEY',  'vpnYalz7Fgc$6gg&LA181:u0V:N[k Qc9`9!4w:9thP,ykWalt_[Q[ig=baZU{<]' );
define( 'LOGGED_IN_KEY',    'c#VCNm+&56 jukcECH4.{^6k{0,yS+s6dg/^V@f@PF`G?bK,XWQ[g}BZz#c6anU^' );
define( 'NONCE_KEY',        'di?RcS:uK?f=*g<By:<Y/ci$=:e&bEb9CwpHS}/w.d$I!@M&wFv}SFd_r<;[?z7N' );
define( 'AUTH_SALT',        '{RAv>XgMsz9_m+KoY<|PJ>%_[F)[SgnO|GS|pNb@x$u2`?{U~y=3Eow*o+K2OkI4' );
define( 'SECURE_AUTH_SALT', 'v}TQi^0mdiHDF)mKBamzirC)INqD#0qw`wqV{(:cB:5-?Xqe[}$s]p=7Tj.i{m`/' );
define( 'LOGGED_IN_SALT',   '>xNz8Bg/)W}X[+,-lyHP~YZD%5sS(-1$@!3-wp@B^HT9dUU5w{>Y[1D, ;J(MI8W' );
define( 'NONCE_SALT',       'A,9lUJBJ9;PC/%``z]v9/SN.m(IYMlR92y~Hm^lTFjG1c>_se},g:|ou<uYKLy*3' );

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

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
