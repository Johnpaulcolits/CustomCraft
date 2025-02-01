const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

// Function to set the active class based on the current page
function setActiveMenu() {
    const currentPage = window.location.pathname.split('/').pop() || 'index.html'; // Get the current page filename

    allSideMenu.forEach(item => {
        const li = item.parentElement;
        const href = item.getAttribute('href');

        // Check if the href matches the current page
        if (href === currentPage) {
            li.classList.add('active');
        } else {
            li.classList.remove('active');
        }
    });
}

// Call the function to set the active menu on page load
setActiveMenu();

// Add click event listeners to handle active state when navigating
allSideMenu.forEach(item => {
    item.addEventListener('click', function () {
        allSideMenu.forEach(i => {
            i.parentElement.classList.remove('active');
        });
        item.parentElement.classList.add('active');
    });
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
    sidebar.classList.toggle('hide');
});

// SEARCH TOGGLE
const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

// Handle window resize
if (window.innerWidth < 768) {
    sidebar.classList.add('hide');
} else if (window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}

window.addEventListener('resize', function () {
    if (this.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

// DARK MODE TOGGLE
const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});