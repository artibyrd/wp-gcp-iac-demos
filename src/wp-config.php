<?php

/** Invoke Google Secret Manager */
require 'vendor/autoload.php';
use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;
$secretManagerServiceClient = new SecretManagerServiceClient();
/** change this to match your Google project ID */
$project = 'cloud-academy-demo-308807'
/** fetches latest secret version by default */
$version = 'projects/&#42;/secrets/&#42;/versions/latest'
/** create empty associative array for our secrets */
$secrets = array( 'DB_NAME'=>' ', 'DB_USER'=>' ', 'DB_PASSWORD'=>' ', 'AUTH_KEY'=>' ', 'SECURE_AUTH_KEY'=>' ', 'LOGGED_IN_KEY'=>' ', 'NONCE_KEY'=>' ', 'AUTH_SALT'=>' ', 'SECURE_AUTH_SALT'=>' ', 'LOGGED_IN_SALT'=>' ', 'NONCE_SALT'=>' ' );
/** populates array values with secrets fetched from Google Secret Manager */
foreach ($secrets as $name => $secret){
	try {
		$formattedName = $secretManagerServiceClient->secretVersionName($project, $name, $version);
		$response = $secretManagerServiceClient->accessSecretVersion($formattedName);
		$secrets[$name] = $response->getPayload()->getData();
	}
}
$secretManagerServiceClient->close();

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', $secrets['DB_NAME'] );

/** MySQL database username */
define( 'DB_USER', $secrets['DB_USER'] );

/** MySQL database password */
define( 'DB_PASSWORD', $secrets['DB_PASSWORD'] );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         $secrets['AUTH_KEY'] );
define( 'SECURE_AUTH_KEY',  $secrets['SECURE_AUTH_KEY'] );
define( 'LOGGED_IN_KEY',    $secrets['LOGGED_IN_KEY'] );
define( 'NONCE_KEY',        $secrets['NONCE_KEY'] );
define( 'AUTH_SALT',        $secrets['AUTH_SALT'] );
define( 'SECURE_AUTH_SALT', $secrets['SECURE_AUTH_SALT'] );
define( 'LOGGED_IN_SALT',   $secrets['LOGGED_IN_SALT'] );
define( 'NONCE_SALT',       $secrets['NONCE_SALT'] );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';