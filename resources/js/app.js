import "./bootstrap";

import Alpine from "alpinejs";
// Import AOS
import AOS from "aos";
import "aos/dist/aos.css"; // Import AOS styles

window.Alpine = Alpine;
Alpine.start();

// Initialize AOS
AOS.init({
    duration: 1000, // Global animation duration (in milliseconds)
    once: true, // Animations will only happen once
    //optional settings
    // offset: 120, // Offset (in pixels) from the original trigger point
    // delay: 200, // Delay between animations (in milliseconds)
    // easing: 'ease-in-out', // Easing type
    // mirror: false, // Whether elements should animate out while scrolling past them
});

/* ------------------------------------------------------------------ CUSTOM CODE ----------------------------------------------------------------- */
window.dataTableInit = function (tableSelector) {
    $(tableSelector).DataTable({
        scrollX: true, // Enable horizontal scrolling
        scrollY: "400px", // Fixed height
        autoWidth: false, // Prevents shrinking

        paging: true,
        searching: true,
        ordering: true,
        info: true,
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
        pageLength: 10,
    });
};
export default window.dataTableInit;