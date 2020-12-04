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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'sup-up' );

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

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/sl}QA@k?^X2~  A,NhUyb4]+B/ jm@rR~X|PCipzHG@~a3zUUv*b`<+8Ed!6QJ6' );
define( 'SECURE_AUTH_KEY',  'T(,!;K%m5M!pb n0r9;~Y.lMJD?boC[?<19^$V=~Xl7>fm8R*A%uJYXmuxxkN~mN' );
define( 'LOGGED_IN_KEY',    '=#%6v~%%hb<u0f(p; bYBfWQAAm+!tNy}4pm-+1;}&jtgWDP0r)w1RL1#T<]_Hh:' );
define( 'NONCE_KEY',        '<J%+?P=ePS>rCFz?,9B_d>d#[&iLFgd~[40&@/tcuCXtV-wfp(}V8D6to#}^e!K:' );
define( 'AUTH_SALT',        'aZCEE-W^^3+#PK8^uY3iy3l^PT+PphX?]k@C|&UmmE] s4taA$w>5#|?,@3G~;Iz' );
define( 'SECURE_AUTH_SALT', '?Zk%HnF&xV&cLu]yr3nd@ys[aednB9O9,,bId+mz[=qS9CYGmW*#e/=!s2Fyz|j/' );
define( 'LOGGED_IN_SALT',   'BW4OrxV.iEk[*zXN_}Y2T3dkU@HV|<&36#AXjyvIevqll.[2Bsh-8oNhNGKttNXK' );
define( 'NONCE_SALT',       'TM;MO7a|F}/++ZN4Z#}:.oE@ii)J,Y@BliX.tev[@8/AigZyq?s;j6DVmz>J#;ue' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_sp';

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
