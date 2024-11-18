// side bar hide function
document.addEventListener("DOMContentLoaded", () => {
    // Sidebar Collapse Toggle
    const expandBtn = document.querySelector(".expand-btn");
    const body = document.body;

    // Check if the sidebar should be collapsed on page load
    if (localStorage.getItem("sidebarState") === "collapsed") {
        body.classList.add("collapsed");
    }

    // Toggle collapsed state on button click
    expandBtn.addEventListener("click", () => {
        body.classList.toggle("collapsed");

        // Update the localStorage value based on the current state
        if (body.classList.contains("collapsed")) {
            localStorage.setItem("sidebarState", "collapsed");
        } else {
            localStorage.removeItem("sidebarState");
        }
    });

        const allLinks = document.querySelectorAll(".sidebar-links a");

        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page') || 'inbox';

        allLinks.forEach(link => {
        // Get the href of the link and extract its page value
        const linkPage = new URL(link.href).searchParams.get('page');

        // Check if the link's page matches the current page
        linkPage === currentPage ? link.classList.add("active") : link.classList.remove("active");
    });
});

// Profile Dropdown Function
const profile = document.querySelector('.profile');
const dropdown = document.querySelector('.dropdown__wrapper');

// Toggle visibility of dropdown immediately on click
profile.addEventListener('click', () => {
    dropdown.classList.remove('nothing');

    if (dropdown.classList.contains('conceal')) {
        // Opening the dropdown
        dropdown.classList.remove('conceal');
        dropdown.classList.add('dropdown__wrapper--fade-in');
    } else {
        // Closing the dropdown
        dropdown.classList.add('conceal');
        dropdown.classList.remove('dropdown__wrapper--fade-in');
    }
});

// Close dropdown when clicking outside
document.addEventListener("click", (event) => {
    const isClickInsideDropdown = dropdown.contains(event.target);
    const isProfileClicked = profile.contains(event.target);

    if (!isClickInsideDropdown && !isProfileClicked) {
        dropdown.classList.add('conceal');
        dropdown.classList.remove('dropdown__wrapper--fade-in');
    }
});
