<?php

function imp_activation() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    /**
     * Table pour les paramètres
     */
    $table_parametres = $wpdb->prefix . 'imp_parametres';
    if  ( $wpdb->get_var( "SHOW TABLES LIKE '$table_parametres'" ) != $table_parametres ) {
        $sql = "CREATE TABLE $table_parametres (
                    id int NOT NULL AUTO_INCREMENT,
                    couleur_bg varchar(10)  NOT NULL,
                    couleur_txt varchar(10)  NOT NULL,
                    titre varchar(255)  NOT NULL,
                    nom varchar(100)  NOT NULL,
                    courriel varchar(100)  NOT NULL,
                    btn_prochain varchar(50)  NOT NULL,
                    btn_soumission varchar(50)  NOT NULL,           
                    PRIMARY KEY (id)
                    ) $charset_collate";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );


        $wpdb->insert( $table_parametres, array( 'couleur_bg' => '#fffff' , 'couleur_txt' => '#000000', 'titre' => 'Inscrivez-vous à notre infolettre', 'nom' => 'Nom', 'courriel' => 'Courriel', 'btn_prochain' => 'Suivant', 'btn_soumission' => 'Soumettre' ) );
    
    }

    /**
     * Table pour les infos d'inscription
     */
    $table_inscriptions = $wpdb->prefix . 'imp_inscriptions';

    if  ( $wpdb->get_var( "SHOW TABLES LIKE '$table_inscriptions'" ) != $table_inscriptions ) {
        $sql = "CREATE TABLE $table_inscriptions (
                    id int NOT NULL AUTO_INCREMENT,
                    courriel varchar(100)  NOT NULL, 
                    nom varchar(100)  NOT NULL,           
                    PRIMARY KEY (id)
                    ) $charset_collate";
        
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );



    
    }

}