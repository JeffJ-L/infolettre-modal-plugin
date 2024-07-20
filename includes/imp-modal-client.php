<?php

function charge_modal() {
    require_once( 'imp-get-infos.php' );
    $imp_infos = imp_get_infos();

    ob_start();
    include( dirname(plugin_dir_path( __FILE__ )). '/templates/imp-modal-template.php' );
    $template = ob_get_clean();
    echo $template;
}

add_action('wp_body_open', 'charge_modal');




/**
 * Gestion de la soumission du formulaire côté client
 */
function imp_nouvelle_inscription() {

    
    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        
        if ( !empty( $_POST['imp-courriel'] ) && !empty( $_POST['imp-nom'] ) ) {
            
            global $wpdb;

            $imp_courriel = sanitize_email( $_POST['imp-courriel'] );
            $imp_nom = sanitize_text_field( $_POST['imp-nom'] );

            $wpdb->insert( IMP_INSCRIPTIONS,
                array(
                    'courriel' => $imp_courriel,
                    'nom' => $imp_nom
                )
            );

            /**
             * Rafraîchi la page pour faire la communication client serveur
             * Détruit la variable spécifiée
             * exit pour stopper l'exécution de la suite du code
             */
            header( "Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" );
            unset( $_POST );
            exit;
        }
    }
}
add_action( 'init', 'imp_nouvelle_inscription' );