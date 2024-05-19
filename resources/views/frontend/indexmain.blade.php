<!DOCTYPE html>
<html>

<head>
    <title>Movies Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <style>
        .navbar {
            background-image: linear-gradient(to right,
                    #0f1010,
                    #2b322e,
                    #e11708,
                    #e72204);
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand text-white" href="#">Movies Website</a>
        <ul class="navbar-nav ml-auto">
            
        </ul>
    </nav>

    <!-- Movies Sections -->
    <div class="allsection">
        <div class="container movies-section">
            <h2>Latest Movies</h2>
            <hr>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card movie-card">
                        <img src="images/1.jpg" alt="Movie 1">
                        <div class="card-body">
                            <h5 class="card-title">Movie 1</h5>
                            <p class="card-text">Rating: 8.5/10</p>
                            <a href="detailes.html" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card movie-card">
                        <img src="images/2.jpg" alt="Movie 2">
                        <div class="card-body">
                            <h5 class="card-title">Movie 2</h5>
                            <p class="card-text">Rating: 9.2/10</p>
                            <a href="detailes.html" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card movie-card">
                        <img src="images/3.jpg" alt="Movie 3">
                        <div class="card-body">
                            <h5 class="card-title">Movie 3</h5>
                            <p class="card-text">Rating: 7.8/10</p>
                            <a href="detailes.html" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card movie-card">
                        <img src="images/4.jpg" alt="Movie 4">
                        <div class="card-body">
                            <h5 class="card-title">Movie 4</h5>
                            <p class="card-text">Rating: 8.0/10</p>
                            <a href="detailes.html" class="btn btn-primary">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container movies-section">

            <div class="row movie-row">
            </div>
            <div class="navigation-arrows">
                <button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
                <button class="next-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div><br><br>

    <footer class="text-center py-3">
        <p>&copy; 2023 Movies Website. All rights reserved.</p>
    </footer>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js">
        const searchIcon = document.getElementById('search-icon');
        const searchContainer = document.querySelector('.search-container');

        searchIcon.addEventListener('click', () => {
            searchContainer.style.display = searchContainer.style.display === 'block' ? 'none' : 'block';
            searchContainer.querySelector('.search-box').focus();
        });
    </script>
    <script type="text/javascript" src="js/script.js"></script>
</body>

</html>
