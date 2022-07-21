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
define( 'DB_NAME', 'wowgamin_word' );

/** MySQL database username */
define( 'DB_USER', 'wowgamin_press' );

/** MySQL database password */
define( 'DB_PASSWORD', 'okClW*9w{#G9' );

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
define( 'AUTH_KEY',         'Qz}8v)8I2GE=N_*zM^ADJ]>rIU9<[Wui2U: L0SXUGo/HE5b&F%^L:3$*4CfW[2C' );
define( 'SECURE_AUTH_KEY',  'HFS Mqu_B$DqMzB:<iOs7nwz++5C3+5z{_chxhrX1be{%4f-.>HD,kX&)}? 4YFR' );
define( 'LOGGED_IN_KEY',    '#tEIzR`+Q{=;W}KmSzGmreV2O.Nf4=vkvAVF#yvxyChb[aUS|zQsmrYN0xiX$*Xj' );
define( 'NONCE_KEY',        'j9|jdy=%r!#3ka)uUS8@sl[N%1|M>/Bn7Dd.]^]sWR+0,oRVx-+(r*]lFL;iX#-y' );
define( 'AUTH_SALT',        '^L#%1;LR%KE$C88p;d?K(*Y}*ZX_>%X<q+8su%FQx<=i4D@q+w--1aPKKEw,d&{-' );
define( 'SECURE_AUTH_SALT', '4P?7|D#@hkThb!!<{S;Ipu]4vg-wPkQVW_pG_@lXFb7(C.zpZGa<3#W`-R+bP+t7' );
define( 'LOGGED_IN_SALT',   '#B&90qqu`h]pd,Gn:%&oP*?~s5(%rCnZv?k3B?TRF}{0NvH%G u(#T{bsLC*Hofg' );
define( 'NONCE_SALT',       '~.DIniZ/GRb32>O~BEpW>MR* .2$PlYt[_L u@MkkHgE%[DMFpHuzr0-:dJWBQ0Z' );

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
