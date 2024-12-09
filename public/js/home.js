document.addEventListener('DOMContentLoaded', function () {
    const inputPseudo = document.getElementById('pseudo1');

    // Fonction pour récupérer le cookie "pseudo"
    function getCookie(name) {
        const cookies = document.cookie.split(';');
        for (let cookie of cookies) {
            cookie = cookie.trim();
            if (cookie.startsWith(`${name}=`)) {
                return decodeURIComponent(cookie.substring(name.length + 1));
            }
        }
        return null;
    }

    // Fonction pour définir un cookie
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/`;
    }

    // Récupère le pseudo du cookie au chargement de la page et le met dans le champ
    const pseudoCookie = getCookie('pseudo');
    if (pseudoCookie) {
        inputPseudo.value = pseudoCookie;
    }

    // Met à jour le cookie lorsque l'utilisateur tape quelque chose
    inputPseudo.addEventListener('input', function () {
        const pseudo = inputPseudo.value.trim();
        if (pseudo) {
            setCookie('pseudo', encodeURIComponent(pseudo), 365); // Cookie valide 1 an
        }
    });
});
