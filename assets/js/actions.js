const selectAllCheckbox = document.getElementById('select-all');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const deleteAllContainer = document.querySelector('.delete-all-container');
    const favoriteIcons = document.querySelectorAll('.favorite');

    const preventCheckboxPropagation = (event) => {
    event.stopPropagation();
    };

    const preventFavoritePropagation = (event) => {
    event.stopPropagation();

    const icon = event.target;
    if (icon.classList.contains('fa-star')) {
        icon.classList.toggle('favorited'); // Add or remove a favorited class
        icon.style.color = icon.classList.contains('favorited') ? 'gold' : '#b3b3b3';
    }
    };

    selectAllCheckbox.addEventListener('change', (event) => {
    rowCheckboxes.forEach((checkbox) => {
        checkbox.checked = selectAllCheckbox.checked;
    });
    toggleDeleteAllButton();
    event.stopPropagation();
    });

    const toggleDeleteAllButton = () => {
    const checkedCount = Array.from(rowCheckboxes).filter((checkbox) => checkbox.checked).length;
    deleteAllContainer.style.display = checkedCount > 0 ? 'block' : 'none';
    };

    rowCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
        selectAllCheckbox.checked = Array.from(rowCheckboxes).every((cb) => cb.checked);
        toggleDeleteAllButton();
        event.stopPropagation(); 
    });

    checkbox.addEventListener('click', preventCheckboxPropagation);
    });

    favoriteIcons.forEach((icon) => {
    icon.addEventListener('click', preventFavoritePropagation);
    });
