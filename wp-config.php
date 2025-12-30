<?php
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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',          'WDaY CeNy_Vq,gSkmgS|E${=[!0G(iafcO&5U@U$.j7v}QY$, b[<^9h(jA,=xJ3' );
define( 'SECURE_AUTH_KEY',   'y1_Su!OG_0{^ErV^:%,mx{MA3kxCqyB:T]:|wXZT2k|VrdgIxfTuQSCe{E[wm?Rb' );
define( 'LOGGED_IN_KEY',     'odsJ=~04:G>#||ODs@)XVan?zmM?B(:GH7P[kks+M>Kt)HM&UYv|gY^AH8#VbnN_' );
define( 'NONCE_KEY',         '%Utts,Y~Flt* q4[TN~fMC-?5hpn%4E8IY<|peg]Qk/5e?BVV:l6Lp[rSrr(g5Ul' );
define( 'AUTH_SALT',         'dQ*oK<L5*8&?}5r>BUS*o6HRo}x@kMu;%R`t5hH25BgK<#F9@O;BAsfS/rG5s&3R' );
define( 'SECURE_AUTH_SALT',  'cD{7sm5FIA>)twgvjBupTwQMIkd3<_zOWwF5U,uh]Vr|1~}+xw-h&:oMULzM1g0P' );
define( 'LOGGED_IN_SALT',    'a|}IjxI~I7>TYVP3QosLcj8ui!@t@vh|Gr>8bc_NS4c=SVIK{%#%52]D0tCN,-l.' );
define( 'NONCE_SALT',        'BeJ%oe6&S4aK1]N(i9{YTrvf_0E:7*|3G2*X(+xGm@8oASwT1,wY-s=<C.=.Z>.V' );
define( 'WP_CACHE_KEY_SALT', 'd(-C8RIna#Q?{sIPCN2eGyyokX,@yyVWl2)~.f*& JMQAw4S1tI;`2,g$Wo?cKW,' );


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

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
