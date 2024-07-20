<?php

/*
Plugin Name: Infolettre Modal Plugin
Description: Un plugin qui permet d'afficher une boîte de dialogue dans la page d'accueil.
Version: 1
Author: Jeff Jean-Louis
*/




// vérifie si la constante ABSPATH n'est pas définie et quitte le script si c'est le cas.

if( !defined( 'ABSPATH' )) {
    exit;
}




/** Enregistre les constantes. Le premier pour le coté admin et le deuxième pour le site coté client */
function imp_definir_const() {
    if ( !defined( 'IMP_PARAMETRES' ) ) {
        global $wpdb;
        define( 'IMP_PARAMETRES', $wpdb->prefix . 'imp_parametres' );
    }

    if ( !defined( 'IMP_INSCRIPTIONS' ) ) {
        global $wpdb;
        define( 'IMP_INSCRIPTIONS', $wpdb->prefix . 'imp_inscriptions' );
    }
}
add_action( 'plugins_loaded', 'imp_definir_const', 0 );



// Appelle et enregistre la fonction d'activation
require_once( plugin_dir_path( __FILE__ ) . '/includes/imp-activation.php' );
register_activation_hook( __FILE__, 'imp_activation' );




/**
 * Charge les comportements du panneau admin
 */
require_once( plugin_dir_path( __FILE__ ) . '/includes/imp-panneau-admin.php' );




/** inclure le fichier imp-modal-client.php du répertoire includes */
require_once( plugin_dir_path( __FILE__ ) . '/includes/imp-modal-client.php' );




function imp_ajouter_styles_et_scripts() {
    wp_register_style('imp-style', plugins_url('assets/styles/styles.css', __FILE__));
    wp_enqueue_style('imp-style');
    
    if (!is_admin()) {
        wp_register_script('imp-script', plugins_url('assets/scripts/main.js', __FILE__));
        wp_enqueue_script('imp-script');
    }
}
add_action('wp_enqueue_scripts', 'imp_ajouter_styles_et_scripts');
add_action('admin_enqueue_scripts', 'imp_ajouter_styles_et_scripts');
