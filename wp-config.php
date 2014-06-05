<?php
define('WP_HOME','http://localhost/montage');
define('WP_SITEURL','http://localhost/montage');
define('WP_DEBUG', false);

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
define('DB_NAME', 'montage');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'M;|=!|X?rabYKIEZ!>}ms4Q_wJ<>R{}MoBhlBW4V[PMA!h=,VM80I+2I.rH8&5?/');
define('SECURE_AUTH_KEY',  'a+)mC&*HkLn!`*VM/1P8QNB}WR)m>*Le5gfCkapp]VU,zD1#p,&a1C6kcHBI|a/-');
define('LOGGED_IN_KEY',    ')KTC#[T2$Lvb%iU=Ms_mnU;u$dMlSo}&s83WLo,1C!ycx3L.LW2;q.nmHtLM?a=G');
define('NONCE_KEY',        '^&yaS0})XmX%tzyzX#@Ya<hHA.t~rQ#[P]yiTI,~/@lxMBJ6%+5x>4ICBbmY:E@1');
define('AUTH_SALT',        '~~8YH1Nafk2zH@L9`5sJO!vefV#WHhZy]?qyRL}981T4~zmz}V,8>+V}|2pBd.Sb');
define('SECURE_AUTH_SALT', '?`zX {go,k0_u8%r:6>@;U3g@?MdJeU<0v/JYysj27+TS@ 72Mkq8K}[$DOC4nJ7');
define('LOGGED_IN_SALT',   'aF?p*7u${$]za4<)jl}WfS]U(t,lc0X]1=tVA0f;p)=:c/^[`]^U_X,!E8 MGC0%');
define('NONCE_SALT',       '|O`B&])s1#$e3z:`qK r8i2IfilO!6HK=`l+U[4Frkr89dk0wG1P3.Qjr Xiy#PW');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'xs_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
