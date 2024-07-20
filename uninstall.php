<?php

// Si uninstall.php n'est pas appelé par Wordpress, die
// Attention!!!!! Faire backup avant de supprimer le plugin!!!!!
if  ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
     die;
}
global $wpdb;
$table_parametres = $wpdb->prefix . 'imp_parametres';
$wpdb->query( "DROP TABLE IF EXISTS $table_parametres" );

$table_inscriptions = $wpdb->prefix . 'imp_inscriptions';
$wpdb->query( "DROP TABLE IF EXISTS $table_inscriptions" );