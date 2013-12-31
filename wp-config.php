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
define('DB_NAME', 'db4db1b4fcb60d4c0c98caa2a50040e8c5');

/** MySQL database username */
define('DB_USER', 'hncwsqghafiuwrju');

/** MySQL database password */
define('DB_PASSWORD', 'pTTXY8Ddfjto5riLJoZmKBbAkVxTvLEhtPebwPitcbWHuavQdQnNXjnVRsLdHTQA');

/** MySQL hostname */
define('DB_HOST', '281ed575-4aeb-4070-b80a-a2a500299d1d.mysql.sequelizer.com');

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
define('AUTH_KEY',         'F[li8,`4t/8hk8q&Eg0lld)$>^`/>>4tHRP{mmv}$fa,/;k e*Il1;2*diB; r>_');
define('SECURE_AUTH_KEY',  '/;k%a?i|^;r(rm_C&9Zx{x+xs hK4Poy^<P-:F}!nz[8hyHv!j)[8[AUt1TTb)Op');
define('LOGGED_IN_KEY',    '?:vw}J~ w;Ql%/(:P^TMk4C]@Fo0?Lm5K)Kb!!2kB7OFd#414*SbB~so<,[Nex3A');
define('NONCE_KEY',        '+_zjOO5tltgk)K,~O5}r)1VG]Kiw$RrwGf7X#)kwMM*Qc`vCr,d[kd~cmS)~((?{');
define('AUTH_SALT',        '_6Q(+G}RTun(#W ]2<?xz h{XrP;TvxIK:7{wV`P?RCFod@$_?2{M[M Lz0Qr4-S');
define('SECURE_AUTH_SALT', 'hR4x&Em4`(;*Q3:>b0fg-;NSS[).%:r+E;<_s.6d]PYifgIt4J0Fc1p}f(ZQp]`2');
define('LOGGED_IN_SALT',   'Jb,LG)jh53?3@|N#zH&ilZ9D6dqZ)+$d&xzk&`}lShzTjdATC!zZ+4z3tBvKg9?>');
define('NONCE_SALT',       'P|<0yl1$jO,hD|ts:Dgsodiw@e]ZFtP^.0$Vi|up{ZIxx=,_ZYd$Ra0#^b~$aC?J');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
