<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marvel Studios - Landing Page</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- my CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0d0d10;
            color: white;
        }

        /* headings use display font */
        h1, h2, h3, .navbar-brand {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 1px;
        }

        /* marvel logo */
        .marvel {
            color: white;
            background-color: red;
            padding: 2px 8px;
        }
        .studios {
            color: white;
            border-top: 3px solid white;
            border-bottom: 3px solid white;
        }

        /* navbar */
        .navbar {
            background-color: #111322;
        }

        /* carousel */
        .carousel-item img {
            height: 450px;
            object-fit: cover;
            filter: brightness(55%);
        }
        .carousel-caption h2 {
            font-size: 2.5rem;
        }

        /* cards */
        .character-card {
            background-color: #16182b;
            border: 1px solid #2a2d45;
            color: white;
        }
        .character-card img {
            height: 350px;
            object-fit: cover;
            object-position: center top;
        }
        .power-badge {
            background-color: red;
        }

        .welcome-username {
            color: red;
        }

        /* footer */
        footer {
            background-color: #111322;
        }
    </style>