<?php



function imp_ajouter_menu() {
    add_menu_page(
        'Infolettre Modal Plugin',       // Page title
        'Infolettre Modal Plugin',       // Menu title
        'manage_options',           // Capability
        'imp-menu-page',            // Menu slug
        'imp_ajouter_formulaire'    // Callable function
    );
}
add_action( 'admin_menu', 'imp_ajouter_menu' );




function imp_ajouter_formulaire() {

    // Si les valeurs sont entrées, met à jour la db
    foreach ($_POST as $var){
        if (isset($var)) {
            imp_update_data(); // Appelle la fonction qui met à jour la db
        }
    }
    require_once( 'imp-get-infos.php' );
    $imp_infos = imp_get_infos();
    
    echo '<div style="padding:5vw;">
            <h2>' . get_admin_page_title() . '</h2>
            <form class="imp-params-form" method="post">
                <label for="imp-couleur-bg">Couleur de fond :</label>
                <input type="color" id="imp-couleur-bg" name="imp-couleur-bg" value="' . esc_attr( $imp_infos[0]->couleur_bg ) . '">
                <label for="imp-couleur-txt">Couleur :</label>
                <input type="color" id="imp-couleur-txt" name="imp-couleur-txt" value="' . esc_attr( $imp_infos[0]->couleur_txt ) . '">
                <label for="imp-titre-params">Titre :</label>
                <input type="text" id="imp-titre-params" name="imp-titre-params" value="' . esc_attr( $imp_infos[0]->titre ) . '">
                <label for="imp-nom-params">Intitulé "nom" :</label>
                <input type="text" id="imp-nom-params" name="imp-nom-params" value="' . esc_attr( $imp_infos[0]->nom ) . '">
                <label for="imp-courriel-params">Intitulé "courriel" :</label>
                <input type="text" id="imp-courriel-params" name="imp-courriel-params" value="' . esc_attr( $imp_infos[0]->courriel ) . '">
                <label for="imp-bouton-suivant">Bouton "Suivant" :</label>
                <input type="text" id="imp-bouton-suivant" name="imp-bouton-suivant" value="' . esc_attr( $imp_infos[0]->btn_prochain ) . '">
                <label for="imp-bouton-soumettre">Bouton "Soumettre" :</label>
                <input type="text" id="imp-bouton-soumettre" name="imp-bouton-soumettre" value="' . esc_attr( $imp_infos[0]->btn_soumission ) . '">
                <button class="imp-btn-submit-params" type="submit" name="enregistrer">Enregistrer</button>
            </form>
        </div>';
    imp_afficher_data(); // Appelle la fonction qui affiche les datas
}

function imp_update_data() {
    global $wpdb;

    $imp_couleur_bg = sanitize_hex_color( $_POST['imp-couleur-bg'] );
    $imp_couleur_txt = sanitize_hex_color( $_POST['imp-couleur-txt'] );

    $imp_titre = sanitize_text_field( $_POST['imp-titre-params'] );
    $imp_nom = sanitize_text_field( $_POST['imp-nom-params'] );
    $imp_courriel = sanitize_text_field( $_POST['imp-courriel-params'] );
    $imp_btn_prochain = sanitize_text_field( $_POST['imp-bouton-suivant'] );
    $imp_btn_soumettre = sanitize_text_field( $_POST['imp-bouton-soumettre'] );

    $data = [ 'couleur_bg' => $imp_couleur_bg, 'couleur_txt' => $imp_couleur_txt, 'titre' => $imp_titre, 'nom' => $imp_nom, 'courriel' => $imp_courriel, 'btn_prochain' => $imp_btn_prochain, 'btn_soumission' => $imp_btn_soumettre ];
    $where = ['id' => 1];
    $wpdb->update( IMP_PARAMETRES, $data, $where );
}




function imp_afficher_data() {
    global $wpdb;

    // Récupère les valeurs de la table wp_imp_inscriptions
    $resultats = $wpdb->get_results( "SELECT * FROM " . IMP_INSCRIPTIONS );

    // S'il y a des résultats
    if ( $resultats ) {
        echo "<h2>Usagers inscrits à l'infolettre</h2>";
        echo '<table id="imp-table">';
        echo '<tr>';
        echo '<th>Nom</th>';
        echo '<th>Courriel</th>';
        echo '</tr>';

        foreach ( $resultats as $data ) {
            echo '<tr>';
            echo '<td> ' . esc_html( $data->nom ) . '</td>';
            echo '<td> ' . esc_html( $data->courriel ) . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}