<!DOCTYPE html>
<html lang="it" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'E-Commerce Laravel')</title>
    <meta name="description" content="@yield('description', 'E-Commerce Laravel')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="@yield('og-image')">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/storage/assets/css/style.css">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem
            }
        }

        .bg-hero {
            background-position: center;
            background-size: cover;
            border-bottom: 1px solid #e5e5e5;
        }
    </style>
</head>
<body>
<x-nav-bar
    placeholder="Cerca nel nostro catalogo"
/>

<main class="@yield('main-class', '')">
    @yield('content')
</main>

<footer class="text-body-secondary py-5">
    <div class="container">
        <p class="float-end mb-1"><a href="#">Back to top</a></p>
        <p class="mb-1">Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
                href="/docs/5.3/getting-started/introduction">getting started guide</a>.</p></div>
</footer>

<script src="//cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
