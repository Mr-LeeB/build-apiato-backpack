<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1, maximum-scale=1, user-scalable=no"> -->
<meta name="viewport" content="width=1280">
<meta name="description" content="">
<meta name="author" content="">

{{-- @if (file_exists(public_path($view_load_namespace . '/images/favicon.ico')))
    <link rel="shortcut icon" href="{{ asset($view_load_namespace . '/images/favicon.ico') }}" type="image/x-icon" />
@endif --}}

<title>@yield('title')</title>

@php
    $view_load_theme = 'base';
@endphp

<!-- <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700&amp;subset=vietnamese" rel="stylesheet"> -->
<link href="{{ asset('theme/' . $view_load_theme . '/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('theme/' . $view_load_theme . '/css/prismjs.bundle.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('theme/' . $view_load_theme . '/css/style.bundle.min.css') }}" rel="stylesheet" type="text/css">

<link href="{{ asset('theme/' . $view_load_theme . '/css/header_base_dark.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('theme/' . $view_load_theme . '/css/header_menu_dark.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('theme/' . $view_load_theme . '/css/brand_dark.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('theme/' . $view_load_theme . '/css/aside_dark.min.css') }}" rel="stylesheet" type="text/css">

<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading,
    .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link {
        background-color: #1b1b28;
    }

    .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading .menu-icon,
    .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link .menu-icon i {
        color: white;
    }

    .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-heading,
    .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-link {
        background-color: #1b1b28;
        color: white;
    }

    .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-heading,
    .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-link .menu-icon i {
        color: white;
    }

    .clickable-row:hover {
        cursor: pointer;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background: #db1430 !important;
        color: white;
    }

    /* .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
        background: rgba(85,120,235,.1) !important;
        color: white;
    } */

    .kt-sc-faq-3 {
        padding: 2rem 0 0;
    }

    .kt-content {
        padding: 25px 0;
    }

    .aside-menu .menu-nav .menu-section .menu-icon {
        flex: 0 0 35px;
    }

    .aside-menu .menu-nav .menu-section {
        align-items: center;
    }

    .aside-menu .menu-nav .menu-section .menu-icon,
    .aside-menu .menu-nav .menu-section .menu-text {
        display: inline-block;
        vertical-align: middle;
    }
</style>
{{-- @if (file_exists(public_path($view_load_namespace . '/css/style.css')))
    <link href="{{ asset($view_load_namespace . '/css/style.css') }}" rel="stylesheet">
@endif --}}

@stack('after_header')
