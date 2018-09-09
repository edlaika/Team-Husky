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
define('DB_NAME', 'teamhusk_wp331');

/** MySQL database username */
define('DB_USER', 'teamhusk_wp331');

/** MySQL database password */
define('DB_PASSWORD', '9pS0X9.!Fr');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'i1i4pbrpaauhrq2gm7eeqz9uukxuini51fiszvxvlxa662mc31lficuutesobrao');
define('SECURE_AUTH_KEY',  '1jinqjidxivz6gezehp1t85odhelchsngclq4nsztsxc8vw5v6ez5jpzn3a4qn0y');
define('LOGGED_IN_KEY',    'tx3zp8r9jgfzwtbfotlf4zzh37qugr8nf5ovde2hciskwqfnfjqrgtoqy32dsdmc');
define('NONCE_KEY',        'bv9ohl1sgpdlxtmwdhq3te67uygbsb4we3ltfebkqe9brthvsy2ygpxsw5oka8wv');
define('AUTH_SALT',        'nfh0yiqfdppmta5wv6eqr0wd8tlq350dbydp3no1adxxdoos2jt3nc2o65awdlga');
define('SECURE_AUTH_SALT', '3svsacmoe2effx1sthzfoytvwnnv4djkgaplanrx1pclpo7gvc1uebyj36katexj');
define('LOGGED_IN_SALT',   '0bu9szizcilwowruy6n4x6lv5spbycw3vllasrrrbiltobetytuvwe669sfns0nl');
define('NONCE_SALT',       'nuaiqlfdu0dajkohhhd4tv9kn0iamabueixysf1jsx1dgs736vmfcfhyy6dwco7c');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpvm_';

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

/** SSL */  
define('FORCE_SSL_ADMIN', true);  
// in some setups HTTP_X_FORWARDED_PROTO might contain  
// a comma-separated list e.g. http,https  
// so check for https existence  
if (strpos($_SERVER['HTTP_X_FORWARDED_PROTO'], 'https') !== false)  
    $_SERVER['HTTPS']='on';

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');