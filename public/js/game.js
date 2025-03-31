let countdown; // Variable pour gérer le décompte
let timeLeft = 120; // Temps initial pour chaque round en secondes

document.getElementById("ready-btn").addEventListener("click", () => {
    // Envoie la requête POST vers la route Symfony
    fetch(`/games/${gameId}/ready`, { method: "POST" })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.allReady) {
                // alert("Tous les joueurs sont prêts ! La partie commence.");
                window.location.href = `/games/${gameId}/play`;
            } else {
                document.getElementById("status").innerText = "En attente des autres joueurs...";
            }
        })
        .catch(error => console.error("Erreur :", error));
});

// Vérifier régulièrement si tous les joueurs sont prêts
function verifier(){
    setInterval(() => {
    fetch(`/games/${gameId}/status`)
        .then(response => response.json())
        .then(data => {
            document.getElementById("status").innerText = `Joueurs prêts : ${data.ready}/${data.total}`;
            if (data.allReady) {
                // alert(`Tous les joueurs sont prêts ! /games/${gameId}/play`);
                window.location.href = `/games/${gameId}/play`;
            }
        });
}, 5000);
}

function transformToInput(button) {
    // Créer un conteneur pour l'input et le bouton
    const container = document.createElement('div');
    container.style.display = 'flex';
    container.style.flexDirection = 'column';  // Disposer les éléments verticalement
    container.style.alignItems = 'center';  // Centrer les éléments horizontalement

    // Créer un nouvel input
    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Écris ton anecdote ici';
    input.id = 'input';  
    input.style.padding = '10px';
    input.style.width = '50%';
    input.style.border = '1px solid #ccc';
    input.style.borderRadius = '20px';
    
    // Créer un bouton pour soumettre l'anecdote
    const submitButton = document.createElement('button');
    submitButton.innerText = 'Soumettre l\'anecdote';
    submitButton.style.padding = '10px 20px';
    submitButton.style.marginTop = '10px';
    submitButton.style.border = 'none';
    submitButton.style.borderRadius = '20px';
    submitButton.style.backgroundColor = '#4CAF50';
    submitButton.style.color = 'white';
    submitButton.style.cursor = 'pointer';
    submitButton.style.width = '15%';  // Largeur du bouton
    submitButton.style.height = '100px';  // Hauteur du bouton

    // Remplacer le bouton par l'input et le bouton de soumission dans le conteneur
    button.style.display = 'none';  // Cacher le bouton
    container.appendChild(input);  // Ajouter l'input
    container.appendChild(submitButton);  // Ajouter le bouton de soumission

    // Ajouter le conteneur après le bouton caché
    button.parentNode.appendChild(container);
    
    input.focus();  // Mettre le focus sur l'input pour permettre la saisie

    submitButton.addEventListener('mouseover', () => {
        submitButton.style.backgroundColor = '#45a049';
        submitButton.style.transform = 'scale(1.05)';
    });
    
    submitButton.addEventListener('mouseout', () => {
        submitButton.style.backgroundColor = '#4CAF50';
        submitButton.style.transform = 'scale(1)';
    });

    submitButton.addEventListener('click', sendAnecdote);

}




// Fonction pour mettre à jour l'affichage du timer
function updateTimer() {
    document.querySelector('.timer').textContent = "Temps restant: " + timeLeft + "s"; // Afficher le temps restant dans un élément avec la classe "timer"
}

// Fonction pour démarrer le round et le chronomètre
function startRound() {
    // Mettre à jour l'affichage du timer
    updateTimer();

    // Démarrer le chronomètre dès que la page est chargée
    countdown = setInterval(function() {
        timeLeft--;
        updateTimer();

        // Si le temps est écoulé
        if (timeLeft <= 0) {
            clearInterval(countdown); // Arrêter le chronomètre
            alert("Round terminé !");
            // Réinitialiser le temps pour le prochain round
            timeLeft = 30;
        }
    }, 1000); // Décrémenter chaque seconde
}

// Démarrer automatiquement le chronomètre dès le chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    startRound(); // Lance le chronomètre automatiquement lorsque la page est prête
});







function sendAnecdote() {
    const inputanecdote = document.getElementById('input');
    const anecdote = inputanecdote.value.trim();
    console.log('Valeur de l\'anecdote:', anecdote);  // Affiche la valeur de l'input

    if (anecdote === '') {
        alert("L'anecdote ne peut pas être vide.");
        return;
    }

    fetch(`/games/${gameId}/play/save-anecdote`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ anecdote: anecdote })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        inputanecdote.value = ''; // Réinitialiser le champ
    })
    .catch(error => console.error('Erreur:', error));
    // Remplacer l'input et le bouton par un message de confirmation
    const container = inputanecdote.parentNode;
    container.innerHTML = "<p style='color: white; font-weight: bold;'>Votre anecdote a été soumise avec succès !</p>";
}

document.getElementById('submit-anecdote').addEventListener('click', sendAnecdote);