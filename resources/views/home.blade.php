<!DOCTYPE html>
<html lang="es" data-theme="ayu">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ $seoTitle }}</title>
  <meta name="description" content="{{ $seoDescription }}">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="{{ url('/') }}">

  <meta property="og:type" content="website">
  <meta property="og:title" content="{{ $seoTitle }}">
  <meta property="og:description" content="{{ $seoDescription }}">
  <meta property="og:url" content="{{ url('/') }}">
  <meta property="og:locale" content="es_ES">

  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="{{ $seoTitle }}">
  <meta name="twitter:description" content="{{ $seoDescription }}">

  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('styles.css') }}" />

  <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
</head>
<body class="crt-scan crt-glow crt-flicker">
  <div id="root"></div>

  <script src="https://unpkg.com/react@18.3.1/umd/react.development.js" integrity="sha384-hD6/rw4ppMLGNu3tX5cjIb+uRZ7UkRJ6BPkLpg4hAu/6onKUg4lLsHAs9EBPT82L" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/react-dom@18.3.1/umd/react-dom.development.js" integrity="sha384-u6aeetuaXnQ38mYT8rp6sbXaQe3NL9t+IBXmnYxwkUI2Hw4bsp2Wvmx4yRQF1uAm" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/@babel/standalone@7.29.0/babel.min.js" integrity="sha384-m08KidiNqLdpJqLq95G/LEi8Qvjl/xUYll3QILypMoQ65QorJ9Lvtp2RXYGBFj1y" crossorigin="anonymous"></script>

  <script>window.SITE = @json($site);</script>
  <script type="text/babel" src="{{ asset('tweaks-panel.jsx') }}"></script>
  <script type="text/babel" src="{{ asset('components.jsx') }}"></script>
  <script type="text/babel" src="{{ asset('app.jsx') }}"></script>
  <script type="text/babel" src="{{ asset('root.jsx') }}"></script>
</body>
</html>
