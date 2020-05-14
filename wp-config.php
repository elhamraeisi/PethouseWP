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
define('FS_METHOD', 'direct');

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'pethouse');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'VXiUubw%)o6GGi`ry71V0<>7`C<>:.MpMqLd6RCa6z(cvvEAouEgOk9?,]j9.9a{');
define('SECURE_AUTH_KEY',  '{K1k]]Qbc%g<%a2*mNp!$s?77$bO+:/m*>H<r5ww>=bbl)L%WZ7ur.~Bgd_7]4*i');
define('LOGGED_IN_KEY',    '5{IL8zmrAL%6D(A?M|,#&Src^uwv{QOlv|L 7Fx5Hbd]Z [tx`A};Mjpd0/}~BH{');
define('NONCE_KEY',        ' >F&OXuBfwU[tueht/VO9=&5@>eAJ:o{yNzG7*XToIv6{uvr^1eaXQ?G.(i`g9s?');
define('AUTH_SALT',        'Ej8|SGHz)9_:S0?pWJTJ_.AWE$n)~tcS5E;#:slNuA>$w-s^25%fvkA3+!AL&{cI');
define('SECURE_AUTH_SALT', 'TA$Kc+cKZS[bT`}b~cY<am?;=l>m0o2q]8Idva0@|tm2JAU..By:B:(8CgmyuCkb');
define('LOGGED_IN_SALT',   '5Z>_,Xai&_9l[p#I+8h5cf`.:8FE6hV4])5Fr=VL wYq)LMo9p]B)^OG+B7EmF9W');
define('NONCE_SALT',       'hZ}Gr3c[*%.(%8Er=`;2C,k2[n@G8gZ3k3CMJ8|A=bs),&S! fG,d/ytqT^Zt;]g');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'petHouse';

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
define('WP_DEBUG', true);
/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */
define('WP_DEBUG_LOG', true);

/** Chemin absolu vers le dossier de WordPress. */
if (!defined('ABSPATH'))
  define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
