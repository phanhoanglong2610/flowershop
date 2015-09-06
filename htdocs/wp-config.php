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
define('DB_NAME', 'bn_flowershop');

/** MySQL database username */
define('DB_USER', 'bn_wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'f156ec983e');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

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
/* Substitute in built apliances */
define('AUTH_KEY',         '339d4625f52c26777bd840327350a6e2db17c2b3828ad95dab82ca47c15b54d3');
define('SECURE_AUTH_KEY',  '8ae9e95c93157a4b372dd4bb599d98c4397fba3ec3cf63382591fe86c8de95d2');
define('LOGGED_IN_KEY',    '9413b98f927a0ef47178b19be1f776734d0d9e5d220f902bb8b7213d37d713c4');
define('NONCE_KEY',        '0e03ce157f7c18c7df41bed45653a142991f74edf3d911193643bd09512a1cd1');
define('AUTH_SALT',        'af5413c8c1a36d7dcc7775ecf23503f75b881dc7ad62f1bfac6da42f33bd899e');
define('SECURE_AUTH_SALT', '27d3b59f65761a20fe6fd54cbc5aa9b53490556a4bb1fdcaef203a9632f3118d');
define('LOGGED_IN_SALT',   'f1d2fec881d95febb5e9d51f91ed9a960b630dbb73081b861b3b5f5462f098bf');
define('NONCE_SALT',       '3715e6a3886188b9a7af281915f3e56c7109b6ff9ee47cc638fe3488e0929149');

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
/**
 * The WP_SITEURL and WP_HOME options are configured to access from any hostname or IP address.
 * If you want to access only from an specific domain, you can modify them. For example:
 *  define('WP_HOME','http://example.com');
 *  define('WP_SITEURL','http://example.com');
 *
*/

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/flowershop');
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/flowershop');


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', 'C:/xampp/apps/flowershop/tmp');