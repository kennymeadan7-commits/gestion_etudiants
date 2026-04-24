document.getElementById('studentForm').addEventListener('submit', function(e) {
    let nom = document.getElementById('nom').value;
    let prenom = document.getElementById('prenom').value;
    let errorDiv = document.getElementById('error-message');

    // Vérifier que le nom et le prénom sont remplis [cite: 94, 95, 96]
    if (nom === "" || prenom === "") {
        e.preventDefault(); // Empêcher l'envoi [cite: 97]
        errorDiv.innerText = "Erreur : Tous les champs doivent être remplis !"; // Message d'erreur [cite: 98]
    }
});