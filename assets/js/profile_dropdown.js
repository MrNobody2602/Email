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