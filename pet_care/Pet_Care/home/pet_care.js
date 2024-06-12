// import {Dropdown,Dialog,Tablist,} from "https://cdn.jsdelivr.net/npm/jolty/dist/jolty.esm.min.js";

// document.querySelectorAll(".nav-submenu").forEach((submenu) => {
//   new Dropdown(submenu, {
//     toggler: submenu.previousElementSibling,
//     delay: 10, 
//     items: ":scope > li > a",
//     trigger: "click hover",
//     hideMode: "class-shown",
//   });
// });

function toggleProfileMenu() {
  var profileMenu = document.getElementById("profile-menu");
  profileMenu.classList.toggle("show");
}

// Get the submenu element
var submenu = document.getElementById('submenu');

// Add event listener for mouse enter
submenu.addEventListener('mouseenter', function() {
  // Show submenu
  submenu.style.display = 'block';

  // Set timeout to hide submenu after 1.5 seconds
  setTimeout(function() {
    submenu.style.display = 'none';
  }, 1500);
});