<?php
define('WP_CACHE', true); // Added by SpeedyCache

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
define( 'DB_NAME', 'mywp_local' );

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
define( 'AUTH_KEY',         'ktsji5espeqntzqqizwtpp5xuqfp3tehe81jlvmfhxszgg0euo9kl8tqmhhkpb4d' );
define( 'SECURE_AUTH_KEY',  'kowy0wupqnouwqnh4oriqaz782jxb15g8mjct3z91hedjkmpeygi4nk2dkumsb7g' );
define( 'LOGGED_IN_KEY',    'hiybpmqz7c1qdhamglxwfnsrt3zoutvukvmvj2ovtrmduhcaoq5mibqfl1sa1jej' );
define( 'NONCE_KEY',        'ytrcmwwvlydm0od5m17mczddqbwt7pvi2kgkkc9oirqeyk9gncu2i1zfcpuhexwg' );
define( 'AUTH_SALT',        '3i5n9gamzwvcjoziqjrfsjqtedwooudbkia7tzcqtmhcc4rixvxxizlz8h2jkvqo' );
define( 'SECURE_AUTH_SALT', 'wvwnlcwjefqhlb4zfywupjmohxh1u5icykwpwec2qjpa1t92jmyebvcxxzb2xfvg' );
define( 'LOGGED_IN_SALT',   'i0vkapuiejew8eshrf6jy2hhovrbigetgz9ag54kysgjdvotxefkaaxvgd1uylwc' );
define( 'NONCE_SALT',       '8njq4pmprslss7sfcc6owziggy032vvaotzxnbwmaiuuab0iaoejow2hheqpc72o' );

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
$table_prefix = 'wphi_';

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

