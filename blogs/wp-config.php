<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u585176074_sx6ZH' );

/** Database username */
define( 'DB_USER', 'u585176074_VBxQw' );

/** Database password */
define( 'DB_PASSWORD', '768o0pVuOx' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '9vKd}a}v%#NFfTj$.=I%0{f7V>=PebC{?P-^huP4rH|:Xa?TT$pkbFErakB06-?!' );
define( 'SECURE_AUTH_KEY',   'Tl)juxQm?tLe_Lz)#Yg,q7qy3!j(xXiCwE1Y^%H-=m-0`]wW8g;v8}IVZi.rB;>)' );
define( 'LOGGED_IN_KEY',     'AJP;-_~2l- RzEsvH=q=|2I(Fk;l&mku s6x#6`zhcz@9ma4$bf;>2v,4UP,L/1S' );
define( 'NONCE_KEY',         'aWS1kx<2:XG= Hq@DR-^ICW>lP?UpLRTqVqXSV`NO3RY, G;FQu#LxMCZ!tmBMX]' );
define( 'AUTH_SALT',         '0kUmbo]giwY5q(c~O3qB_;$@6 %SR)u<,oFTfydwosag$VAH} KX{:Y0t,W|>$Cw' );
define( 'SECURE_AUTH_SALT',  'M6nZo`q*4JN= j=RmIN+&/C&GZK*uiNyOytPw4@nJ^vyL*,ZN=/ZA{fD=M#np4ih' );
define( 'LOGGED_IN_SALT',    'A-^0Iisqb!0pImcJu_C;fMV-`,B-17.PQ8%ZJ@n.4vO2@S B9k]cPfLC|G5qB,,S' );
define( 'NONCE_SALT',        '2n`Zf+z,w%WK@l]+K53r{,#c87!vM>kV;.#BL;EL]L^<} -b7`E)wCj7GbdJ~lvb' );
define( 'WP_CACHE_KEY_SALT', 'xItueO3Nw(N8$`JG[YH<?_Efuxe>#_R9^n)x;2ji`AkSok@n=L@aio>yL1K::I;o' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '2224c5ca82939932d6e12ed479d77542' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
