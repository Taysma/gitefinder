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