<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'o&~Ar/LSyx`)1&~<^HfXLlBx8}=08,IfjpjX4lkXm_4sZl/wPhi,l+8`I<n$xK#]' );
define( 'SECURE_AUTH_KEY',   '>e>vYxkE[,-8;%o6%9-&<K@{X{OEp5RB 0~%aj3u_xglH=DV(jD~7=xc<2L)~E)z' );
define( 'LOGGED_IN_KEY',     'RsktB1j//@5YPB=H1n|!HVs~5DeY]Kub%id!eNs1L6vo:Py`97.^Z1?7ZM.:jA{ ' );
define( 'NONCE_KEY',         'R<LP5e:eld?Y!8(W|@,W#%Mg?X}Xokf<hDsf<!HvW)QEEE*:Fi^5r;Y^bfae0$Kf' );
define( 'AUTH_SALT',         'P!&W=WJqzT#8}&<^N F=N7i;p:b#h2&RJ Fx2pE{s^27k_kcD6*libnOSUwLLBO3' );
define( 'SECURE_AUTH_SALT',  'P7- Xb6Z>kA(A}/Gr}orE($@Gv^A4XojT2mR>cr`,LK?Bgz$|s3[=Ldk{E5CD_3^' );
define( 'LOGGED_IN_SALT',    '$9:u139 T=3:u2`)} *Hc~G5z;KYu|~N~3EX9tiyK^mG&Z{ZMcu>$`l4|unn(yH{' );
define( 'NONCE_SALT',        'Y:<KA2&CK;v+{?n/B;<KMwUkfNGpa^gn*h>QA`c[q`3elVF5n^nwOr*xM@t]SGRT' );
define( 'WP_CACHE_KEY_SALT', 'VAI^s@Zc-BbhfC_j&M |C0&2r&sMeY5%3;rz_#^)3vv!+TOQ@8T4!0fdiUh4mnYa' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', true );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
