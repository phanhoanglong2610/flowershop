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
define('DB_NAME', 'longph_bitnami_wordpress');

/** MySQL database username */
define('DB_USER', 'longph');

/** MySQL database password */
define('DB_PASSWORD', 'BichNhung109');

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
define('AUTH_KEY',         'ad317db2fa83082367c8b46a2365956100e5ccc1c5d160d6dc61062ace46bf9e');
define('SECURE_AUTH_KEY',  'd0005be14f9e833a5baf2e79c5d618107794f686309720e14b92a3e0abbbd96f');
define('LOGGED_IN_KEY',    '01833bc0c0c567ea8cbf893c1d33a415b614c1cbb2c5c092f5b2369c2d4d4acd');
define('NONCE_KEY',        'c5b221cc9f3843634693686d9a7112c3b40d5b177a0f3c27fdf0ec843b9523c9');
define('AUTH_SALT',        '96d54a329b7875b6f0caba5dfdcb32c3f178c0c7f4a8d7c1a51503ab3ddfee64');
define('SECURE_AUTH_SALT', 'a0bd12a7af24832b876f0927e4b99da0f8e77193a951e880f20949443d15db22');
define('LOGGED_IN_SALT',   'd785e2d0580843f0638487a027b1ac2fe28fbc1acd432a54ada23b23b6710f21');
define('NONCE_SALT',       '0339102fbaa1c92cade9faa3826702ed7fb4d9e52591a93401ac5a4e18b249a2');

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
define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] . '/wordprflowershopess');


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define('WP_TEMP_DIR', '/Applications/XAMPP/xamppfiles/apps/flowershop/tmp');

