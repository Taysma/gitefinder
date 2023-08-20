function toggleSharePopup() {

    let popup = document.getElementById("sharePopup");
    popup.style.display = (popup.style.display === "block") ? "none" : "block";
}

function shareOnFacebook() {
    var shareURL = "https://www.example.com/page-a-partager";
    window.open("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(shareURL));
}

function shareOnTwitter() {
    var shareURL = "https://www.example.com/page-a-partager";
    window.open("https://twitter.com/share?url=" + encodeURIComponent(shareURL));
}

function shareOnLinkedIn() {
    var shareURL = "https://www.example.com/page-a-partager";
    window.open("https://www.instagram.com/shareArticle?url=" + encodeURIComponent(shareURL));
}





//seconde share

function copyToClipboard(text) {
    lettextarea = document.createElement("textarea");
    textarea.textContent = text;
    textarea.style.position = "fixed";
    document.body.appendChild(textarea);
    textarea.select();
    try {
        document.execCommand("copy");
    } catch (ex) {
        console.warn("Copy to clipboard failed.", ex);
        return false;
    } finally {
        document.body.removeChild(textarea);
    }
}

function shareOnFacebook() {
    const currentURL = window.location.href;
    const fbShareURL = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(currentURL);
    window.open(fbShareURL, '_blank');
}

function shareOnTwitter() {
    const currentURL = window.location.href;
    const twitterShareURL = "https://twitter.com/share?url=" + encodeURIComponent(currentURL);
    window.open(twitterShareURL, '_blank');
}

function shareOnWhatsApp() {
    const currentURL = window.location.href;
    const whatsappShareURL = "https://wa.me/?text=" + encodeURIComponent(currentURL);
    window.open(whatsappShareURL, '_blank');
}

function shareOnInstagram() {
    // Discord n'a pas de lien de partage direct, donc nous copierons simplement l'URL pour l'utilisateur
    const currentURL = window.location.href;
    copyToClipboard(currentURL);
    alert("Lien copié dans le presse-papiers. Collez-le dans Discord pour le partager !");
    // const currentURL = window.location.href;
    // const twitterShareURL = "https://www.instagram.com/share?url=" + encodeURIComponent(currentURL);
    // window.open(twitterShareURL, '_blank');
}



// Attacher les écouteurs d'événements aux boutons
document.getElementById('facebookShareButton').addEventListener('click', shareOnFacebook);
document.getElementById('twitterShareButton').addEventListener('click', shareOnTwitter);
document.getElementById('whatsappShareButton').addEventListener('click', shareOnWhatsApp);
document.getElementById('instagramShareButton').addEventListener('click', shareOnInstagram);

