<html>
<head>
    <title>Monitora</title>
    <link rel="icon" href="{{ asset('images/monitora-removebg-preview.png') }}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: black !important;
        }
        </style>
         <link rel="stylesheet" href="{{ asset('css/dark_styles.css') }}">
</head>

<body class="{{ request('darkMode', false) ? 'dark-mode hidden-content' : 'hidden' }}" style="background-color: {{ request('darkMode', false) ? 'black' : 'white' }};">
    <div id="pageContent" class="hidden-content">
    
    


    <!--NavBar -->
    <nav class="custom-navbar">
        <div class="custom-navbar-container" id="mainNav" style="background-color: transparent !important;">
            <div class="navbar-brand">
            <a href="#featuredContainer" id="scrollToFeatured">
                    <img src="images/inverted.png" alt="Monitora Logo">
                </a>
            </div>
            <div class="navbar-toggler" id="navbarToggler">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="navbar-nav" id="navbarLinks">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#onamaModal">O nama</a>
                </li>
            </ul>
        </div>
    </nav>


    <!-- Page Header-->
        <header class="masthead">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7 position-relative">
                        <div class="floating-monitora">
                            <img id="monitoraImage" src="{{ asset('images/monitora-removebg-preview.png') }}" alt="Monitora Image">
                            </div>
                            <div class="site-heading">
                            <h1>Monitora</h1>
                            <span class="subheading">Sve iz svijeta računalne opreme.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div id="postsContainer">
    <!-- Featured blog post -->
    <div id="featuredContainer">
        @if (isset($posts[0]))
            @php
                $latestPost = json_decode($posts[0]);
            @endphp
            <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
                <div class="col-md-6 px-0">
                    <h1 class="display-4 fst-italic">{{ $latestPost->clip_title }}</h1>
                    <p class="lead my-3">{{ substr($latestPost->clip_content, 0, 250) }}...</p>
                    <p class="lead mb-0"><a href="{{ $latestPost->clip_url }}" class="text-white fw-bold">Saznajte više...</a></p>
                </div>
            </div>
        @endif
    </div>

    <!-- Main content -->
    <div id="postsSection" class="container-fluid px-4 px-lg-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <?php foreach ($posts as $post): ?>
                    <?php
                        $decodedPost = json_decode($post);
                        $formattedDate = date('d/m/Y', strtotime($decodedPost->created_at));
                        $clipAuthors = substr($decodedPost->clip_authors, 2, -2);
                    ?>
                    <?php if (!isset($latestPost) || $decodedPost->id !== $latestPost->id): ?>
                        <div class="post-preview">
                            <h2 class="post-title"><?= $decodedPost->clip_title ?></h2>
                            <p class="post-abstract"><?= substr($decodedPost->clip_content, 0, 250) ?>...</p>
                            <p class="post-meta">
                                Objavljeno <?= $formattedDate ?>, autor: <?= $clipAuthors ? $clipAuthors : '/' ?>
                            </p>
                            <a href="<?= $decodedPost->clip_url ?>">
                                <h5>Saznajte više...</h5>
                            </a>
                        </div>
                        <hr class="my-4">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

                    </div>
   

    <!-- Pager -->
<div>
    <br>
    <br>
</div>
<div class="d-flex justify-content-between mb-4" style="margin: 0 10%;">
    @if ($posts->currentPage() > 1)
    <a id="prevPageLink" class="custom-btn" href="{{ $posts->previousPageUrl() }}#postsContainer">Prijašnja</a>
    @endif

    <div class="pagination">
        Stranica:
        @php
            $totalPages = $posts->lastPage();
            $currentPage = $posts->currentPage();
            $numPagesToShow = 3;
            $startPage = max(1, $currentPage - $numPagesToShow);
            $endPage = min($totalPages, $currentPage + $numPagesToShow);
        @endphp

        @if ($startPage > 1)
            <a href="{{ $posts->url(1) }}#postsSection">1</a>
            @if ($startPage > 2)
                <span>...</span>
            @endif
        @endif

        @for ($i = $startPage; $i <= $endPage; $i++)
            @if ($i == $currentPage)
                <span>{{ $i }}</span>
            @else
                <a href="{{ $posts->url($i) }}#postsSection">{{ $i }}</a>
            @endif
        @endfor

        @if ($endPage < $totalPages)
            @if ($endPage < $totalPages - 1)
                <span>...</span>
            @endif
            <a href="{{ $posts->url($totalPages) }}#postsSection">{{ $totalPages }}</a>
        @endif
    </div>

    @if ($posts->hasMorePages())
    <a id="nextPageLink" class="custom-btn" href="{{ $posts->nextPageUrl() }}#postsContainer">Slijedeća</a>
    @endif
    </div>


    <!-- Footer -->
    <footer  class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top text-light">
        <div class="footer-left">
            <p class="mb-0 text-body-secondary"></p>
        </div>
        <div class="footer-center">
        <a href="/" class="d-flex align-items-center justify-content-center link-body-emphasis text-decoration-none">
        </div>
        <div class="footer-right">
            <ul class="nav justify-content-end">
                <li class="nav-item">
                <li class="nav-item"><span class="nav-link px-2 text-body-secondary"></span></li>
                </li>
            </ul>
        </div>
    </footer>
    <div class="footer-text">
        <p id="footer-text">
            © 2023, Monitora
        </p>
        <br>
    </div>

    
    <!-- Modal for "O nama" -->
    <div class="modal fade" id="onamaModal" tabindex="-1" aria-labelledby="onamaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="onamaModalLabel">Monitora</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Monitora je Vaš glavni hub za sve iz svijeta tehnologije, gadgeta i računalne opreme posebno usredotočen na monitore i njihove specifikacije. Ovdje možete saznati sve što trebate znati pri kupnji novog monitora.</p>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvori</button>
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Prevent default behavior of the anchor when clicked
        $('#scrollToFeatured').on('click', function(event) {
            event.preventDefault();
            const featuredContainer = document.getElementById('featuredContainer');
            const offset = featuredContainer.getBoundingClientRect().top + window.scrollY;

            window.scrollTo({
                top: offset,
                behavior: 'smooth'
            });
        });
    });
</script>


<script>
    function scrollToTopOfPosts(direction) {
        const postsContainer = document.getElementById('postsContainer');
        const offset = postsContainer.getBoundingClientRect().top + window.scrollY;

        let scrollPosition = offset;
        if (direction === 'prev') {
            scrollPosition -= 10; 
        } else if (direction === 'next') {
            scrollPosition += 10; 
        }

        window.scrollTo({
            top: scrollPosition,
            behavior: 'smooth'
        });
    }
</script>


    <script>
        $(document).ready(function() {
            $('.pagination > li:first-child > .page-link').hide();
            $('.pagination > li:last-child > .page-link').hide();
        });
    </script>

    <script>
        function goToPage(pageNumber) {
            const mainContent = document.getElementById('mainContent');
            const offset = mainContent.getBoundingClientRect().top;
            const scrollOptions = {
                top: window.pageYOffset + offset,
                behavior: 'smooth', 
            };
            window.scrollTo(scrollOptions);
        }
    </script>

    <script>
        function adjustImagePosition() {
            const monitoraImage = document.getElementById('monitoraImage');
            const siteHeading = document.querySelector('.site-heading');

            if (window.innerWidth <= 767) {//mobile screens
                monitoraImage.style.display = 'none';
                siteHeading.style.position = 'absolute';
                siteHeading.style.textAlign = 'initial';
            } else { //larger screens
                monitoraImage.style.display = 'block';
                siteHeading.style.position = 'relative';
                siteHeading.style.textAlign = 'center';
            }
        }
    </script>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>