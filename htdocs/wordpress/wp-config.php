<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wbdatabase' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'AwPUQ+9ma{sSgAKMzw_xwO61RYem1O-w(Q; z[_TGDL#D_V1xh7Ed^9H$63K)c[g' );
define( 'SECURE_AUTH_KEY',  ')||`{>Q_J=^vbYl^X5&E7M:(~:U2]y-; E6]^9%-Y>]eEX8EAOS#H><aCJ~mgxT,' );
define( 'LOGGED_IN_KEY',    ':f|}O4-@F4d(qHGA0)V$uA^|@CzAX}P=.1Fr|Rn+*.}:lbiOBD(4dk@%Ep?bw?Ut' );
define( 'NONCE_KEY',        'Z/:$J3p(%Z^l:R{:uV9=k .G8ZA-YUwTSc$vMV.~t4+s?@CgY4,@3-~S0cmz,pS2' );
define( 'AUTH_SALT',        'muqF48TMef@ogSD,q+Y+eQfH%b9ox&qp6y8KNBi/Cq?TU[!/Ao{IIeFb*(:FGnmL' );
define( 'SECURE_AUTH_SALT', 'IdJd_gI{(; yuOS% C#/h.:K9Z`=aO1MgOp:V08EAWi~^%H<1vBTVly=:*y Ja&@' );
define( 'LOGGED_IN_SALT',   ' S*O-?;v){+~W=~Sw&I},,srOm1L/Sxrt%Y6m6`|_aX/FEML$&aM,}J2<5U(jKJ^' );
define( 'NONCE_SALT',       'zr<a0?}T1m6;oC/3fh s1C74q`>%[+#1(^npGwiQr)>!a: On%AMC<C]OPE:9juk' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
