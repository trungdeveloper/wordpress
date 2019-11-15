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
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\xampp\htdocs\wordpress\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_MEMORY_LIMIT', '256M' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '-EyNr8<6-VmMw@Tq;?VRn}LF)Nvd=4=:JGqMmt _3`$m9jir,v&mTdoWS.*o#9 ^' );
define( 'SECURE_AUTH_KEY',  'l],dtgQTA4-`/>q&5SD/)|/2c{k)Lt=4o~oT}je, oqFg_Pm<@(_r8DR5yPBN;R+' );
define( 'LOGGED_IN_KEY',    'Ku1bc#ZM2sAlL0_o7ifFy4uDN+/?pk(}Pq/!8x#{l7|q8OYU/zT-Qn-CB3q}F[*=' );
define( 'NONCE_KEY',        'y3-7jkdUY:ss|[yICdRVZIe|cIuyFi3r;spK%a<O[KhWFmQtY.*C9-0 7{BZxp06' );
define( 'AUTH_SALT',        'O$p2kCBjO)MD95dqaS@S=7;Qk_54CoN/|Y<?pbQ72dQ%Grj<GDr32.q3K bqg{N1' );
define( 'SECURE_AUTH_SALT', ']/IbrvJlHH!}szJFVLS73O>cot?e&}xgwYRlgQp49.)F@!@=FL%J{UCV #:J3`[}' );
define( 'LOGGED_IN_SALT',   't$^J|`WcDG sq=m)4 ?wAy70Y zm*y=LE//U,7f}X3Bd;VK<-`U6l>c(k.2AD6j;' );
define( 'NONCE_SALT',       ']tS8LPt>5&!097_J%~.8Mx:4wftGI)`xuTm &:?ioB{WSfma!txN;cpjSB-V[&rb' );

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
