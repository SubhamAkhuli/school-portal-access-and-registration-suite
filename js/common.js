// $(document).ready(function () {
//     $("#menu-toggle").click(function (e) {
//         e.preventDefault();
//         $("#wrapper").toggleClass("toggled");
//     });
// });	

// document.addEventListener("DOMContentLoaded", function () {
//     const toggleButton = document.querySelector(".dropdown-toggle1");
//     const dropdownMenu = document.querySelector(".dropdown-menu");

//     // Toggle dropdown menu and arrow on button click
//     toggleButton.addEventListener("click", function (event) {
//       event.preventDefault(); // Prevent default link behavior
//       dropdownMenu.classList.toggle("show"); // Toggle the 'show' class
//       toggleButton.classList.toggle("open"); // Toggle 'open' class to rotate the arrow
//     });

//     // Close the dropdown menu when clicking outside
//     document.addEventListener("click", function (event) {
//       if (!toggleButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
//         dropdownMenu.classList.remove("show");
//         toggleButton.classList.remove("open");
//       }
//     });
// });