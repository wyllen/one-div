<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'onediv');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'COYqxa7R^Ok&6DU}Ct:>pNv|+b~#pLx<s@pW*?,.cuC7htZ4j&)fwFo}WnnUE2Ka');
define('SECURE_AUTH_KEY',  'x0-B%m87:5,}(m*g~aT1b)5| N?BkrqB! /5b!ZWD&xzZwKA7)VWp=+G?t2HQU<_');
define('LOGGED_IN_KEY',    '@(WQBBz/Tw#amb0=NnnavO|qo}:c]d,Hl%EuI1{_P-<[7+}NAz@ER%8<>L}6f7t ');
define('NONCE_KEY',        'QlchaP5@`i4i>))Y`:vg_BJN(A,])xj:Inn|4E;fo|kC/=TYfdEuGF.;EKMA2V9.');
define('AUTH_SALT',        'V;U&slmOH32NmtdOt,~t;vLN5:lJ%ctYi^`(zOSnpmEvRo%R9+i6}[GvhL7B[<f|');
define('SECURE_AUTH_SALT', 'r%P sOa(_5it4^r}xX}AckkVOcc2xZkz?7ycdkv^|BR+<1nb>Zb)DYOUw.V8X<QU');
define('LOGGED_IN_SALT',   'LbOS59VJpU{Pq/>CbMwc7Sg0rEg$|4xOgJJc>nzu|/9I#!L|{eMS=%o:[)~luy9`');
define('NONCE_SALT',       '/v@IAJ>frLx;.$?,tt$=D,Z2iu~GdgK1*d%[;~Buj8LpD_ILA;RM.UFQugA)hy[w');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');