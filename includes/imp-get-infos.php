<?php

/**
 * retourne les paramètres de l'infolettre
 */
function imp_get_infos() {

    global $wpdb;

    $informations = $wpdb->get_results( "SELECT * FROM " . IMP_PARAMETRES . " WHERE id=1" );
    return $informations;
}