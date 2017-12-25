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
define('DB_NAME', 'magid_october_20');

/** MySQL database username */
define('DB_USER', 'magid_october_20');

/** MySQL database password */
define('DB_PASSWORD', 'AnEV9NZt');

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
define('AUTH_KEY', 'TORpxDMQOdEAemDyvKuszG9vfd8yBk7lBgv2uQ3TTS950SpS5nVsl2qKcSmXXAKN');
define('SECURE_AUTH_KEY', 'Agr89dFiLwoQKuBAoqYlDobMzUR7jrvDJBka8FPFB8vlVJzLtiatM0inQmkHT7ME');
define('LOGGED_IN_KEY', '9lTBEgPa8rLvfqumEAUmQWshg3MxknIDdFdX711T4FvrLx4qNsD7IUWWvYF1xGqo');
define('NONCE_KEY', '42sp3K3r4dvMcdJi5sPlGbVhEPN32NlwRB6H89Yu8ovViBy3nMErCf2EbDBSRwOk');
define('AUTH_SALT', 'OMvT87KogJmGhVB2koJpWW7qnAdwlUB21NDa2vV4GKm5B3DIoCRK7cysyT46tvkV');
define('SECURE_AUTH_SALT', '4VftseNSOTD8LZuVumFKovMFJuwGxIQqCBcUgFPoXuyEadKVIJWdvMBedFnoJqkT');
define('LOGGED_IN_SALT', '4XBdV8Xt6v2dkoBYBjRQqdoV4o9frSYYrfsR7vCMS1F3ampTxEckKJ3fMW6iRu6s');
define('NONCE_SALT', 'lETXHOFJRP8xLKOT78cDsuK1YVDfM9ooQxhh4vKUS2Zpte59tr6McTPqhTvdXePD');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
