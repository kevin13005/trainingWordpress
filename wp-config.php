<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('WP_CACHE', true);
define( 'WPCACHEHOME', 'C:\wamp64\www\wordpress\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'themeWordpress' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost:3308' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'yb`>h9@wds(yWHQx/]s OQXjnljjXYh)Cv%5]JtefEJY9 .rz:~t*m>v2*BE^f_Z' );
define( 'SECURE_AUTH_KEY',  'L0eipf^(mS+@0,=b`fu2i$tITn`w<Zq;y@>th,AZkiS}Aq_d+Md58~2}C F*/~<D' );
define( 'LOGGED_IN_KEY',    'qAqMw%W*w%:s3gK1ryT=$#ul15,HB|}|C|3V;5uDAi*%cSi/)vyw>P(4{6&CB!!$' );
define( 'NONCE_KEY',        'J_lbJ{`$}G_XkiTKm4VN GPrKF>>qH+N^_Ka)fT[LHhKo3iQ@y6rlI}3#e8(o){p' );
define( 'AUTH_SALT',        'QQOL8c^WD~gV#~wC4^uaUuzM2U+HyI]p5NzWZ(Ncptaf^8iy.Ao[z4g+v`n.DO9O' );
define( 'SECURE_AUTH_SALT', 'BYI/m^0q iW_9^L`lba7g1%QK#xw3dn#f/N`wY{?Ht!rO]TQxVh?*K`gF+WQk/gM' );
define( 'LOGGED_IN_SALT',   '0K% .X-ABDw&Y[b,:@5h.WVkz?FL0<{L=H~)Ijs(d5+ll`}%p%3|yUJ0P4]+du]8' );
define( 'NONCE_SALT',       '5fd[v5]zy#y@b:A?r.;/|$L>a!hwgdWKY|jd0,pjB(qAX$~90_L:JCdnX^CIlM:f' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
