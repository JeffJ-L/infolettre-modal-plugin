//Attend que la page soit chargee
window.addEventListener('DOMContentLoaded', function() {
    // Selection des éléments html
    const steps = Array.from(document.querySelectorAll('.step'));
    const nextBtns = document.querySelectorAll('form .imp-bouton-prochain');
    const form = document.querySelector('#imp-form-client');
    console.log(form);




    // Ecouteurs d'evenement
    nextBtns.forEach(button => {
        button.addEventListener('click', () => {
            changeStep('next', button);
        })
    });




    form.addEventListener('imp-form-client', (evenement) => {
        evenement.preventDefault();
        let index = 0;
        const active = document.querySelector('form .step.active');
        index = steps.indexOf(active);
        steps[index].classList.remove('active');
        steps[0].classList.add('active');
        form.reset();
    });




   /** Une fonction qui change le steps du formulaire en d'autres mots les sections selon l'index de la section active */
   function changeStep(btn, button) {
        let index = 0;
        const active = document.querySelector('form .step.active');
        index = steps.indexOf(active); // Trouve l'index de la section active

        // Validation de l'email si la section courriel est active
        if (btn === 'next' && active.querySelector('#imp-courriel')) {
            const emailInput = active.querySelector('#imp-courriel').value;
            if (!validateEmail(emailInput)) {
                const messageErreur = active.querySelector('.imp-erreur-message');
                messageErreur.classList.remove('invisible');
                button.classList.add('disabled');
                return;
            }
        }
        steps[index].classList.remove('active');
        if (btn === 'next') {
            index++;
        }
        steps[index].classList.add('active');
    }




    /** Une fonction qui verifie que l'email est valide */
    function validateEmail(email) 
    {
        const re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i;
        return re.test(email);
    }



    /** Une fonction qui ouvre la modale et qui ajoute un temps d'attente */
    function ouvertureModal() {
        const conteneur = document.querySelector("[data-js-imp-modal-template]");


        setTimeout(function() {
            conteneur.classList.replace('imp-modal-template--ferme', 'imp-modal-template--ouvert');
        }, 1000);
    }
    ouvertureModal();



    
    /** Une fonction qui change la couleur de fond et la couleur du texte de la modale */
    function changeStyle() {
        const conteneurModal = document.querySelector(".imp-modal-template");
        const couleurBg = conteneurModal.getAttribute("data-couleur_bg");
        const couleurTxt = conteneurModal.getAttribute("data-couleur_txt");
        conteneurModal.style.color = couleurTxt;
        conteneurModal.style.backgroundColor = couleurBg;
    };

    changeStyle();

});
