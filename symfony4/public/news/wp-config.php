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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'superwave' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'v9Uv?0dZ}nWC1NMKTvXq$ico~7Mf>CQhc4a42 ]cB#!6j*c}Foq.f`,9Zas8h(^h' );
define( 'SECURE_AUTH_KEY',  '!4ZFq}PtO5z3MRzDf^&5cOu)RK8j>CPVj$ xy}E=.]o9S}%/ZU^RPH(pk)$s$QuM' );
define( 'LOGGED_IN_KEY',    '+k0w_F@= b`CI^||BT[MIY}aB.<=We$>9cbppe@vZ.-NjP`IxC~g>t(37jw90{HN' );
define( 'NONCE_KEY',        'IQ(ob&UB0/pZ>qpv<bP<pRa|ME&(y(]U0/mbknZ]iTFZ%eI1hfjm%VCS4}-vw.XT' );
define( 'AUTH_SALT',        'Q01_&|:7g_Zk`NfHHWw{N<~p$X#a<Ja75@-@2/:3#V 6fq5%jBQ|`X{h;9}%.mu?' );
define( 'SECURE_AUTH_SALT', '*=<(n%O+UmRKrfrl^B)XS]7B`e$k97Ik+]b9iVX_t6?xMwYU@,IbJ&gCNvQ720#[' );
define( 'LOGGED_IN_SALT',   'BH-,H`wL-b8Z/pd6Sbx}t/%;Av<*S@+JQGMkl5uJN0YAOW7<)1$dJ7WhAp<g@% r' );
define( 'NONCE_SALT',       '9%:8/WCoNy7zb,C+51umfZX[hQG0Y-;+TSp(rm^dJ([8]tzE~$n UKb8az~3,X1]' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
