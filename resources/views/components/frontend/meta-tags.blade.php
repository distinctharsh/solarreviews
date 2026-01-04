@props([
    'title' => config('app.name', 'Solar Reviews'),
    'description' => 'Compare trusted solar installers, EPCs, and equipment reviews across India on Solar Reviews.',
    'keywords' => 'solar reviews, solar installers, solar companies, solar panels India',
    'canonical' => url()->current(),
    'image' => asset('favicon.svg'),
    'type' => 'website',
    'robots' => 'index,follow',
    'locale' => str_replace('_', '-', app()->getLocale()),
])

<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">

<link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">


<!-- Open Graph -->
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:locale" content="{{ $locale }}">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">

@stack('seo')
