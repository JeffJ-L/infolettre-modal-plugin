<?php

require_once( plugin_dir_path( __FILE__ ) . '../includes/imp-get-infos.php' );
$imp_infos = imp_get_infos();

//Une solution assez longue pour changer le style de la boîte de la modale dynamiquement

echo '<div class="imp-modal-template imp-modal-template--ferme" data-couleur_bg="' . esc_attr( $imp_infos[0]->couleur_bg ) . '" data-couleur_txt="' . esc_attr( $imp_infos[0]->couleur_txt ) . '" data-js-imp-modal-template>
    <p>' . esc_attr( $imp_infos[0]->titre ) . '</p>
     <form id="imp-form-client" method="post">
        <section class="step imp-section-nom  active">
           <label for="imp-nom">' . esc_attr( $imp_infos[0]->nom ) . ' :</label>
           <input type="text" id="imp-nom" name="imp-nom">
           <button type="button" class="imp-bouton-prochain">' . esc_attr( $imp_infos[0]->btn_prochain ) . '</button>
        </section>
        <section class="step imp-section-courriel">
        <p class="imp-erreur-message invisible"><small>Veuillez entrer une adresse courriel valide!</small></p>
            <label for="imp-courriel">' . esc_attr( $imp_infos[0]->courriel ) . '</label>
           <input type="email" id="imp-courriel" name="imp-courriel">
           <button type="button" class="imp-bouton-prochain">' . esc_attr( $imp_infos[0]->btn_prochain ) . '</button>
        </section>
        <section class="step imp-section-soumission">
           <button type="submit" id="client-submit" class="imp-bouton-soumettre">' . esc_attr( $imp_infos[0]->btn_soumission ) . '</button>
        </section>
     </form>
</div>';