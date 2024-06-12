document.addEventListener("DOMContentLoaded", function () {
    const loader = document.querySelector(".loader");
    const splashScreen = document.querySelector(".splash-screen");
    loader.style.display = "none";
    splashScreen.style.display = "block";
    const email = '';//cse_2012020339@lus.ac.bd'
    setTimeout(function () {
        window.location.href = "../home/index.php?email="+ encodeURIComponent(email);
    }, 3000);
});