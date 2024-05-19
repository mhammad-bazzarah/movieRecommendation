const movieRow = document.querySelector('.movie-row');
const prevBtn = document.querySelector('.prev-btn');
const nextBtn = document.querySelector('.next-btn');

const allMovies = Array.from(document.querySelectorAll('.movies-section .row .col-sm-4'));
let currentIndex = 0;

function displayMovies() {
    movieRow.innerHTML = '';
    for (let i = currentIndex; i < currentIndex + 3 && i < allMovies.length; i++) {
        movieRow.appendChild(allMovies[i]);
    }
}

function navigateMovies(direction) {
    if (direction === 'prev' && currentIndex > 0) {
        currentIndex -= 3;
    } else if (direction === 'next' && currentIndex < allMovies.length - 3) {
        currentIndex += 3;
    }
    displayMovies();
}

displayMovies();

nextBtn.addEventListener('click', () => navigateMovies('next'));
prevBtn.addEventListener('click', () => navigateMovies('prev'));
