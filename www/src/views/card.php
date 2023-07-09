/*
 * Copyright (c) 2023 by Hind SEDRATI
 * 
 *
 * File name: www/src/views/card.php
 * Creation date: 2023-07-09 04:09:27
 * Autor: Hind SEDRATI
 *
 * Last Modified: 4959ca7 2023-07-03 13:58:21
 */
    <div id="destinations-container">
        <!-- Placeholder pour les cartes de destination -->
        <h4>Add destination card</h4>
        <h5>Card 1</h5>
        <div class="destination-form">
            <?= $form->input($cardModel, 'card_title-0') ?>
            <?= $form->input($cardModel, 'card_link-0') ?>
            <?= $form->input($cardModel, 'card_media_url-0') ?>
            <?= $form->input($cardModel, 'card_price-0') ?>
        </div>
    </div>
<button type="button" id="add-destination-btn">Add card</button>
</section>

<script>
    let cardCounter = 1;

    // Fonction pour cloner un formulaire de carte de destination
    function cloneDestinationForm() {
        const destinationForm = document.querySelector(".destination-form");
        const clone = destinationForm.cloneNode(true);
        const container = document.getElementById("destinations-container");
        const cardClass = `card-${++cardCounter}`;
        clone.classList.remove("destination-form");
        clone.classList.add(cardClass);

        // Mettre à jour les attributs "name" des champs clonés avec l'index actuel
        const inputs = clone.querySelectorAll('input');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            const updatedName = name.replace(/-\d+$/, `-${cardCounter}`);
            input.setAttribute('name', updatedName);
        });
        
        // Ajouter le titre avec le numéro de carte
        const title = document.createElement("h5");
        title.innerText = `Card ${cardCounter}`;
        clone.insertBefore(title, clone.firstChild);
        
        container.appendChild(clone);
    }

    // Gestionnaire d'événement pour le bouton "Ajouter une destination"
    const addDestinationBtn = document.getElementById("add-destination-btn");
    addDestinationBtn.addEventListener("click", cloneDestinationForm);
</script>
