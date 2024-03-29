<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    {{-- Meta --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="This is a project about repositories.">
    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">
    {{-- <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}"> --}}
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type='image/png' />

    {{-- Title --}}
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    {{-- Styles --}}
    <link rel="stylesheet" href="{{ asset('css/app.css?20210529') }}">
    <link rel="stylesheet" href="{{ asset('css/kero.css?20210529') }}">

    <style>
        .app-sidebar{
            background: {{config('dpyx.menu_color')}} !important;
        }
        .bg-info{
            background: {{config('dpyx.dropdown_menu_header_background_color')}} !important;
        }
        .d-border-top{
            border-top: 5px solid {{config('dpyx.border_top_color')}};
        }

        body{}
    </style>

    @livewireStyles

</head>

<body>
    <div class="app-container app-theme-gray app-sidebar-full {{ Cookie::get('expandNavbar') == 'false' ? 'header-mobile-open' : '' }}"
        id="app-container">
        <div class="app-main">
            <div class="app-sidebar-wrapper">
                <div class="app-sidebar sidebar-text-dark">
                    <div class="app-header__logo d-flex justify-content-between" x-data="navbar()" x-init="mounted()">
                        <a href="{{ route('dashboard') }}" data-toggle="tooltip" data-placement="bottom"
                            title="dPyx {{ env('APP_NAME', '') }}" class="">
                            <img src="{{ url('images/logo.png') }}" width="200px"
                                class="img-responsive" alt="">
                        </a>
                        {{-- <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav"> --}}
                        <button type="button" class="float-right hamburger hamburger--elastic mobile-toggle-nav"
                            {{-- class="float-right hamburger hamburger--elastic mobile-toggle-nav is-active" --}} id="navbarButton" x-on:click="changeState()">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                    <div class="scrollbar-sidebar scrollbar-container">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Opciones</li>
                                {{-- <li>
                                    <a href="widgets-chart-boxes.html">
                                        <i class="metismenu-icon fas fa-scroll">
                                        </i>Cuestionario
                                    </a>
                                </li> --}}
                                @can('index categories')
                                    <li>
                                        <a href="{{ route('categories.index') }}">
                                            <i class="metismenu-icon fas fa-layer-group">
                                            </i>Categorías
                                        </a>
                                    </li>
                                @endcan
                                @can('index subcategories')
                                    <li>
                                        <a href="{{ route('subcategories.index') }}">
                                            <i class="metismenu-icon fas fa-cubes">
                                            </i>Subcategorías
                                        </a>
                                    </li>
                                @endcan
                                @can('index users')
                                    <li>
                                        <a href="{{ route('users.index') }}">
                                            <i class="metismenu-icon fas fa-users">
                                            </i>Usuarios
                                        </a>
                                    </li>
                                @endcan
                                @can('index questions')
                                    <li>
                                        <a href="{{ route('questions.index') }}">
                                            <i class="metismenu-icon fas fa-question-circle">
                                            </i>Preguntas
                                        </a>
                                    </li>
                                @endcan
                                {{-- <li>
                                    <a href="widgets-profile-boxes.html">
                                        <i class="metismenu-icon fas fa-chart-pie">
                                        </i>Estadísticas
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('repositories.index') }}">
                                        <i class="metismenu-icon fas fa-box-open"></i>
                                        {{ ucfirst(__('containerNamePlural')) }}
                                    </a>
                                </li>
                                @if (config('app.is_evaluable'))
                                    <li>
                                        <a href="{{ route('announcements.index') }}">
                                            <i class="metismenu-icon fas fa-calendar-check">
                                            </i>Convocatorias
                                        </a>
                                    </li>
                                @endif
                                <li class="mt-5 text-center" style="border: 1px solid #c3c6d4 !important;">
                                    <a href="https://dpyx.site/preguntas-frecuentes/" target="_blank">
                                        Más información y FAQ
                                    </a>
                                </li>
                                @if (auth()->user()->is_admin)
                                    <li class="mt-1 text-center" style="border: 1px solid #c3c6d4 !important;">
                                        <a href="https://dpyx.site/administrador/" target="_blank">
                                            Manual de administrador
                                        </a>
                                    </li>
                                @elseif(auth()->user()->is_evaluator)
                                    <li class="mt-1 text-center" style="border: 1px solid #c3c6d4 !important;">
                                        <a href="https://dpyx.site/evaluador/" target="_blank">
                                            Manual de evaluador
                                        </a>
                                    </li>
                                @else
                                    <li class="mt-1 text-center" style="border: 1px solid #c3c6d4 !important;">
                                        <a href="https://dpyx.site/usuario/" target="_blank">
                                            Manual de usuario
                                        </a>
                                    </li>
                                @endif
                                <img src="{{ url('images/default/dpyx.png') }}" width="60px"
                                    class="float-right mt-2 img-responsive" alt="">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-sidebar-overlay d-none animated fadeIn"></div>
            <div class="container app-main__outer">
                <div class="container app-main__inner">
                    <div class="header-mobile-wrapper" style="background-color: #e1e6ff;">
                        <div class="app-header__logo">
                            <img src="{{ url('images/logo.png') }}" width="120px" class="img-responsive" alt="">
                            {{-- <a href="#" data-toggle="tooltip" data-placement="bottom" title="KeroUI Admin Template"
                                class="logo-src"></a> --}}
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-sidebar-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                            <div class="app-header__menu">
                                <span>
                                    <button type="button"
                                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav"
                                        style="background: #b6bad2; border: 1px solid #9da4ca;">
                                        <span class="btn-icon-wrapper">
                                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                                        </span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white shadow-sm app-header">
                        @yield('header')
                        <div class="app-header-right">
                            {{-- <div class="search-wrapper">
                                <i class="search-icon-wrapper typcn typcn-zoom-outline"></i>
                                <input type="text" placeholder="Search...">
                            </div> --}}
                            {{-- <div class="pr-0 header-btn-lg">
                                <div class="header-dots">
                                    <div class="dropdown">
                                        <button type="button" aria-haspopup="true" aria-expanded="false"
                                            data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                                            <i class="typcn typcn-th-large-outline"></i>
                                        </button>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-vicious-stance">
                                                    <div class="menu-header-image opacity-4"
                                                        style="background-image: url('/images/dropdown-header/city5.jpg');">
                                                    </div>
                                                    <div class="text-white menu-header-content">
                                                        <h5 class="menu-header-title">Grid Dashboard</h5>
                                                        <h6 class="menu-header-subtitle">Easy grid navigation inside
                                                            dropdowns</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid-menu grid-menu-xl grid-menu-3col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button
                                                            class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i
                                                                class="mb-3 pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg"></i>
                                                            Automation
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button
                                                            class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i
                                                                class="mb-3 pe-7s-piggy icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg">
                                                            </i>
                                                            Reports
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button
                                                            class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i
                                                                class="mb-3 pe-7s-config icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg">
                                                            </i>
                                                            Settings
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button
                                                            class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i
                                                                class="mb-3 pe-7s-browser icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg">
                                                            </i>
                                                            Content
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button
                                                            class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i
                                                                class="mb-3 pe-7s-hourglass icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg">
                                                            </i>
                                                            Activity
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button
                                                            class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i
                                                                class="mb-3 pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg">
                                                            </i>
                                                            Contacts
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider nav-item"></li>
                                                <li class="text-center nav-item-btn nav-item">
                                                    <button
                                                        class="btn-shadow btn btn-primary btn-sm">Follow-ups</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button type="button" aria-haspopup="true" aria-expanded="false"
                                            data-toggle="dropdown" class="p-0 btn btn-link">
                                            <i class="typcn typcn-bell"></i>
                                            <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span>
                                        </button>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                            <div class="mb-0 dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-night-sky">
                                                    <div class="menu-header-image opacity-5"
                                                        style="background-image: url('/images/dropdown-header/city2.jpg');">
                                                    </div>
                                                    <div class="menu-header-content text-light">
                                                        <h5 class="menu-header-title">Notifications</h5>
                                                        <h6 class="menu-header-subtitle">You have <b>21</b> unread
                                                            messages</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul
                                                class="p-3 tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered">
                                                <li class="nav-item">
                                                    <a role="tab" class="nav-link active" data-toggle="tab"
                                                        href="#tab-messages-header">
                                                        <span>Messages</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a role="tab" class="nav-link" data-toggle="tab"
                                                        href="#tab-events-header">
                                                        <span>Events</span>
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a role="tab" class="nav-link" data-toggle="tab"
                                                        href="#tab-errors-header">
                                                        <span>System</span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                                    <div class="scroll-area-sm">
                                                        <div class="scrollbar-container">
                                                            <div class="p-3">
                                                                <div class="notifications-box">
                                                                    <div
                                                                        class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                                        <div
                                                                            class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">All Hands
                                                                                        Meeting</h4><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <p>Yet another one, at <span
                                                                                            class="text-success">15:00
                                                                                            PM</span></p><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Build the
                                                                                        production release
                                                                                        <span
                                                                                            class="ml-2 badge badge-danger">NEW</span>
                                                                                    </h4>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Something
                                                                                        not important
                                                                                        <div
                                                                                            class="mt-2 avatar-wrapper avatar-wrapper-overlap">
                                                                                            <div
                                                                                                class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                <div
                                                                                                    class="avatar-icon">
                                                                                                    <img src="/images/default/avatars/1.jpg"
                                                                                                        alt=""></div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                <div
                                                                                                    class="avatar-icon">
                                                                                                    <img src="/images/default/avatars/2.jpg"
                                                                                                        alt=""></div>
                                                                                            </div>
                                                                                            <div
                                                                                                class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                <div
                                                                                                    class="avatar-icon">
                                                                                                    <img src="{{auth()->user()->profile_photo_path ? asset('storage/'.auth()->user()->profile_photo_path) : '/images/default/avatars/profile.jpg?20210526'}}"
                            alt=""></div>
                    </div>
                    <div class="avatar-icon-wrapper avatar-icon-sm">
                        <div class="avatar-icon">
                            <img src="/images/default/avatars/4.jpg" alt=""></div>
                    </div>
                    <div class="avatar-icon-wrapper avatar-icon-sm">
                        <div class="avatar-icon">
                            <img src="/images/default/avatars/5.jpg" alt=""></div>
                    </div>
                    <div class="avatar-icon-wrapper avatar-icon-sm">
                        <div class="avatar-icon">
                            <img src="/images/default/avatars/9.jpg" alt=""></div>
                    </div>
                    <div class="avatar-icon-wrapper avatar-icon-sm">
                        <div class="avatar-icon">
                            <img src="/images/default/avatars/7.jpg" alt=""></div>
                    </div>
                    <div class="avatar-icon-wrapper avatar-icon-sm">
                        <div class="avatar-icon">
                            <img src="/images/default/avatars/8.jpg" alt=""></div>
                    </div>
                    <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                        <div class="avatar-icon">
                            <i>+</i></div>
                    </div>
                </div>
                </h4>
                <span class="vertical-timeline-element-date"></span>
            </div>
        </div>
    </div>
    <div class="vertical-timeline-item dot-info vertical-timeline-element">
        <div><span class="vertical-timeline-element-icon bounce-in"></span>
            <div class="vertical-timeline-element-content bounce-in">
                <h4 class="timeline-title">This dot
                    has an info state</h4><span class="vertical-timeline-element-date"></span>
            </div>
        </div>
    </div>
    <div class="vertical-timeline-item dot-danger vertical-timeline-element">
        <div><span class="vertical-timeline-element-icon bounce-in"></span>
            <div class="vertical-timeline-element-content bounce-in">
                <h4 class="timeline-title">All Hands
                    Meeting</h4><span class="vertical-timeline-element-date"></span>
            </div>
        </div>
    </div>
    <div class="vertical-timeline-item dot-warning vertical-timeline-element">
        <div><span class="vertical-timeline-element-icon bounce-in"></span>
            <div class="vertical-timeline-element-content bounce-in">
                <p>Yet another one, at <span class="text-success">15:00
                        PM</span></p><span class="vertical-timeline-element-date"></span>
            </div>
        </div>
    </div>
    <div class="vertical-timeline-item dot-success vertical-timeline-element">
        <div><span class="vertical-timeline-element-icon bounce-in"></span>
            <div class="vertical-timeline-element-content bounce-in">
                <h4 class="timeline-title">Build the
                    production release
                    <span class="ml-2 badge badge-danger">NEW</span>
                </h4>
                <span class="vertical-timeline-element-date"></span>
            </div>
        </div>
    </div>
    <div class="vertical-timeline-item dot-dark vertical-timeline-element">
        <div><span class="vertical-timeline-element-icon bounce-in"></span>
            <div class="vertical-timeline-element-content bounce-in">
                <h4 class="timeline-title">This dot
                    has a dark state</h4><span class="vertical-timeline-element-date"></span>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="tab-pane" id="tab-events-header" role="tabpanel">
        <div class="scroll-area-sm">
            <div class="scrollbar-container">
                <div class="p-3">
                    <div
                        class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-success">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">All Hands
                                        Meeting</h4>
                                    <p>Lorem ipsum dolor sic amet, today at
                                        <a href="javascript:void(0);">12:00
                                            PM</a></p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-warning">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <p>Another meeting today, at <b class="text-danger">12:00 PM</b>
                                    </p>
                                    <p>Yet another one, at <span class="text-success">15:00
                                            PM</span></p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-danger">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Build the
                                        production release</h4>
                                    <p>Lorem ipsum dolor sit
                                        amit,consectetur eiusmdd tempor
                                        incididunt ut labore et dolore magna
                                        elit enim at minim veniam quis
                                        nostrud</p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-primary">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title text-success">
                                        Something not important</h4>
                                    <p>Lorem ipsum dolor sit
                                        amit,consectetur elit enim at minim
                                        veniam quis nostrud</p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-success">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">All Hands
                                        Meeting</h4>
                                    <p>Lorem ipsum dolor sic amet, today at
                                        <a href="javascript:void(0);">12:00
                                            PM</a></p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-warning">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <p>Another meeting today, at <b class="text-danger">12:00 PM</b>
                                    </p>
                                    <p>Yet another one, at <span class="text-success">15:00
                                            PM</span></p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-danger">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title">Build the
                                        production release</h4>
                                    <p>Lorem ipsum dolor sit
                                        amit,consectetur eiusmdd tempor
                                        incididunt ut labore et dolore magna
                                        elit enim at minim veniam quis
                                        nostrud</p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                        <div class="vertical-timeline-item vertical-timeline-element">
                            <div><span class="vertical-timeline-element-icon bounce-in"><i
                                        class="badge badge-dot badge-dot-xl badge-primary">
                                    </i></span>
                                <div class="vertical-timeline-element-content bounce-in">
                                    <h4 class="timeline-title text-success">
                                        Something not important</h4>
                                    <p>Lorem ipsum dolor sit
                                        amit,consectetur elit enim at minim
                                        veniam quis nostrud</p><span class="vertical-timeline-element-date"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="tab-errors-header" role="tabpanel">
        <div class="scroll-area-sm">
            <div class="scrollbar-container">
                <div class="pt-3 pb-0 no-results">
                    <div class="swal2-icon swal2-success swal2-animate-success-icon">
                        <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                        </div>
                        <span class="swal2-success-line-tip"></span>
                        <span class="swal2-success-line-long"></span>
                        <div class="swal2-success-ring"></div>
                        <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);">
                        </div>
                        <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);">
                        </div>
                    </div>
                    <div class="results-subtitle">All caught up!</div>
                    <div class="results-title">There are no system errors!
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item-divider nav-item"></li>
        <li class="text-center nav-item-btn nav-item">
            <button class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View
                Latest Changes</button>
        </li>
    </ul>
    </div>
    </div>
    </div>
    </div> --}}
                            <div class="pr-0 header-btn-lg">
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left">
                                            <div class="btn-group">
                                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    class="p-0 btn">
                                                    <img width="80" class="rounded"
                                                        src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : '/images/default/avatars/profile.jpg' }}"
                                                        alt="" style="display: inline-block;">
                                                    <i class="ml-2 fa fa-angle-down opacity-8"></i>
                                                </a>
                                                <div tabindex="-1" role="menu" aria-hidden="true"
                                                    class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                                    <div class="dropdown-menu-header">
                                                        <div class="dropdown-menu-header-inner bg-info">
                                                            <div class="menu-header-image opacity-2"
                                                                style="background-image: url('/images/dropdown-header/city1.jpg');">
                                                            </div>
                                                            <div class="text-left menu-header-content">
                                                                <div class="p-0 widget-content">
                                                                    <div class="widget-content-wrapper">
                                                                        <div class="mr-3 widget-content-left">
                                                                            <img width="80" class="rounded-circle"
                                                                                src="{{ auth()->user()->profile_photo_path ? asset('storage/' . auth()->user()->profile_photo_path) : '/images/default/avatars/profile.jpg' }}"
                                                                                alt="">
                                                                        </div>
                                                                        <div class="widget-content-left">
                                                                            <div class="widget-heading">
                                                                                {{ auth()->user()->name }}
                                                                            </div>
                                                                            {{-- <div class="widget-subheading opacity-8">
                                                                                A short profile description
                                                                            </div> --}}
                                                                        </div>
                                                                        <div class="mr-2 widget-content-right">
                                                                            <form method="POST"
                                                                                action="{{ route('logout') }}">
                                                                                @csrf
                                                                                <button
                                                                                    class="btn-pill btn-shadow btn-shine btn btn-focus">Cerrar
                                                                                    sesión
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="scroll-area-xs" style="height: 150px;">
                                                        <div class="scrollbar-container ps">
                                                            <ul class="nav flex-column">
                                                                {{-- <li class="nav-item-header nav-item">
                                            Correo
                                        </li> --}}
                                                                <li class="nav-item">
                                                                    <a href="javascript:void(0);"
                                                                        class="nav-link float"><span class="text-muted">
                                                                            <i class="fas fa-envelope"></i>
                                                                            {{ auth()->user()->email }}
                                                                        </span>
                                                                        {{-- <div
                                                                            class="ml-auto badge badge-pill badge-info">
                                                                            8
                                                                        </div> --}}
                                                                    </a>
                                                                </li>
                                                                {{-- <li class="nav-item">
                                                                    <a href="javascript:void(0);"
                                                                        class="nav-link">Recover Password
                                                                    </a>
                                                                </li> --}}
                                                                <li class="nav-item-header nav-item">Mi cuenta
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{ route('users.account', [auth()->user()]) }}"
                                                                        class="nav-link">
                                                                        <i class="mr-1 fas fa-tools"></i>
                                                                        Configuración
                                                                        {{-- <div class="ml-auto badge badge-success">New
                                                                        </div> --}}
                                                                    </a>
                                                                </li>
                                                                {{-- <li class="nav-item">
                                                                    <a href="javascript:void(0);"
                                                                        class="nav-link">Mensajes
                                                                        <div class="ml-auto badge badge-warning">512
                                                                        </div>
                                                                    </a>
                                                                </li> --}}
                                                                {{-- <li class="nav-item">
                                                                    <a href="javascript:void(0);" class="nav-link">Logs
                                                                    </a>
                                                                </li> --}}
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    {{-- <ul class="nav flex-column">
                                                        <li class="mb-0 nav-item-divider nav-item"></li>
                                                    </ul>
                                                    <div class="grid-menu grid-menu-2col">
                                                        <div class="no-gutters row">
                                                            <div class="col-sm-6">
                                                                <button
                                                                    class="pt-2 pb-2 btn-icon-vertical btn-transition btn-transition-alt btn btn-outline-warning">
                                                                    <i
                                                                        class="mb-2 pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper"></i>
                                                                    Message Inbox
                                                                </button>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <button
                                                                    class="pt-2 pb-2 btn-icon-vertical btn-transition btn-transition-alt btn btn-outline-danger">
                                                                    <i
                                                                        class="mb-2 pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper"></i>
                                                                    <b>Support Tickets</b>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <ul class="nav flex-column">
                                                        <li class="nav-item-divider nav-item">
                                                        </li>
                                                        <li class="text-center nav-item-btn nav-item">
                                                            <button class="btn-wide btn btn-primary btn-sm">
                                                                Open Messages
                                                            </button>
                                                        </li>
                                                    </ul> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="app-header-overlay d-none animated fadeIn"></div>
                    </div>
                    <div class="app-inner-layout app-inner-layout-page">
                        <div class="app-inner-layout__wrapper">
                            <div class="app-inner-layout__sidebar">
                                <div class="app-layout__sidebar-inner dropdown-menu-rounded">
                                    <div class="nav flex-column">
                                        <div class="nav-item-header text-primary nav-item">
                                            Dashboards Examples
                                        </div>
                                        <a class="dropdown-item active" href="analytics-dashboard.html">Analytics</a>
                                        <a class="dropdown-item" href="management-dashboard.html">Management</a>
                                        <a class="dropdown-item" href="advertisement-dashboard.html">Advertisement</a>
                                        <a class="dropdown-item" href="index.html">Helpdesk</a>
                                        <a class="dropdown-item" href="monitoring-dashboard.html">Monitoring</a>
                                        <a class="dropdown-item" href="crypto-dashboard.html">Cryptocurrency</a>
                                        <a class="dropdown-item" href="pm-dashboard.html">Project Management</a>
                                        <a class="dropdown-item" href="product-dashboard.html">Product</a>
                                        <a class="dropdown-item" href="statistics-dashboard.html">Statistics</a>
                                    </div>
                                </div>
                            </div>
                            <div class="container app-inner-layout__content">
                                <div class="tab-content">
                                    <div class="container">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="">
                            <div class="app-footer__inner">
                                <div class="app-footer-left">
                                    <img src="{{ asset('images/default/footer-left.png') }}" width="100px">

                                    {{-- <div class="footer-dots">
                                        <div class="dropdown">
                                            <a aria-haspopup="true" aria-expanded="false" data-toggle="dropdown"
                                                class="dot-btn-wrapper">
                                                <i class="dot-btn-icon typcn typcn-warning-outline text-warning"></i>
                                                <div class="badge badge-dot badge-abs badge-dot-sm badge-danger">Danger
                                                </div>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="dropdown-menu-xl rm-pointers dropdown-menu">
                                                <div class="mb-0 dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-deep-blue">
                                                        <div class="menu-header-image opacity-1"
                                                            style="background-image: url('/images/dropdown-header/city3.jpg');">
                                                        </div>
                                                        <div class="menu-header-content text-dark">
                                                            <h5 class="menu-header-title">Notifications</h5>
                                                            <h6 class="menu-header-subtitle">You have <b>21</b> unread
                                                                messages</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul
                                                    class="p-3 tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered">
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link active" data-toggle="tab"
                                                            href="#tab-messages-header1">
                                                            <span>Messages</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" data-toggle="tab"
                                                            href="#tab-events-header1">
                                                            <span>Events</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a role="tab" class="nav-link" data-toggle="tab"
                                                            href="#tab-errors-header1">
                                                            <span>System</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab-messages-header1"
                                                        role="tabpanel">
                                                        <div class="scroll-area-sm">
                                                            <div class="scrollbar-container">
                                                                <div class="p-3">
                                                                    <div class="notifications-box">
                                                                        <div
                                                                            class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                                            <div
                                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">All
                                                                                            Hands Meeting</h4><span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <p>Yet another one, at <span
                                                                                                class="text-success">15:00
                                                                                                PM</span></p><span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">Build
                                                                                            the production release
                                                                                            <span
                                                                                                class="ml-2 badge badge-danger">NEW</span>
                                                                                        </h4>
                                                                                        <span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-primary vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">
                                                                                            Something not important
                                                                                            <div
                                                                                                class="mt-2 avatar-wrapper avatar-wrapper-overlap">
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/1.jpg') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/2.jpg') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/profile.jpg?20210526') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/4.jpg') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/5.jpg') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/9.jpg') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/7.jpg') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <img src="{{ asset('images/default/avatars/8.jpg') }}"
                                                                                                            alt="">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                                                                    <div
                                                                                                        class="avatar-icon">
                                                                                                        <i>+</i>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </h4>
                                                                                        <span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-info vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">This
                                                                                            dot has an info state</h4>
                                                                                        <span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">All
                                                                                            Hands Meeting</h4><span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <p>Yet another one, at <span
                                                                                                class="text-success">15:00
                                                                                                PM</span></p><span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-success vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">Build
                                                                                            the production release
                                                                                            <span
                                                                                                class="ml-2 badge badge-danger">NEW</span>
                                                                                        </h4>
                                                                                        <span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="vertical-timeline-item dot-dark vertical-timeline-element">
                                                                                <div><span
                                                                                        class="vertical-timeline-element-icon bounce-in"></span>
                                                                                    <div
                                                                                        class="vertical-timeline-element-content bounce-in">
                                                                                        <h4 class="timeline-title">This
                                                                                            dot has a dark state</h4>
                                                                                        <span
                                                                                            class="vertical-timeline-element-date"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-events-header1" role="tabpanel">
                                                        <div class="scroll-area-sm">
                                                            <div class="scrollbar-container">
                                                                <div class="p-3">
                                                                    <div
                                                                        class="vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-success">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">All Hands
                                                                                        Meeting</h4>
                                                                                    <p>Lorem ipsum dolor sic amet, today
                                                                                        at <a
                                                                                            href="javascript:void(0);">12:00
                                                                                            PM</a></p><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-warning">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <p>Another meeting today, at <b
                                                                                            class="text-danger">12:00
                                                                                            PM</b></p>
                                                                                    <p>Yet another one, at <span
                                                                                            class="text-success">15:00
                                                                                            PM</span></p><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-danger">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Build the
                                                                                        production release</h4>
                                                                                    <p>Lorem ipsum dolor sit
                                                                                        amit,consectetur eiusmdd tempor
                                                                                        incididunt ut labore et dolore
                                                                                        magna elit enim at minim veniam
                                                                                        quis nostrud</p><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-primary">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4
                                                                                        class="timeline-title text-success">
                                                                                        Something not important</h4>
                                                                                    <p>Lorem ipsum dolor sit
                                                                                        amit,consectetur elit enim at
                                                                                        minim veniam quis nostrud</p>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-success">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">All Hands
                                                                                        Meeting</h4>
                                                                                    <p>Lorem ipsum dolor sic amet, today
                                                                                        at <a
                                                                                            href="javascript:void(0);">12:00
                                                                                            PM</a></p><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-warning">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <p>Another meeting today, at <b
                                                                                            class="text-danger">12:00
                                                                                            PM</b></p>
                                                                                    <p>Yet another one, at <span
                                                                                            class="text-success">15:00
                                                                                            PM</span></p><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-danger">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4 class="timeline-title">Build the
                                                                                        production release</h4>
                                                                                    <p>Lorem ipsum dolor sit
                                                                                        amit,consectetur eiusmdd tempor
                                                                                        incididunt ut labore et dolore
                                                                                        magna elit enim at minim veniam
                                                                                        quis nostrud</p><span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="vertical-timeline-item vertical-timeline-element">
                                                                            <div><span
                                                                                    class="vertical-timeline-element-icon bounce-in"><i
                                                                                        class="badge badge-dot badge-dot-xl badge-primary">
                                                                                    </i></span>
                                                                                <div
                                                                                    class="vertical-timeline-element-content bounce-in">
                                                                                    <h4
                                                                                        class="timeline-title text-success">
                                                                                        Something not important</h4>
                                                                                    <p>Lorem ipsum dolor sit
                                                                                        amit,consectetur elit enim at
                                                                                        minim veniam quis nostrud</p>
                                                                                    <span
                                                                                        class="vertical-timeline-element-date"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="tab-errors-header1" role="tabpanel">
                                                        <div class="scroll-area-sm">
                                                            <div class="scrollbar-container">
                                                                <div class="pt-3 pb-0 no-results">
                                                                    <div
                                                                        class="swal2-icon swal2-success swal2-animate-success-icon">
                                                                        <div class="swal2-success-circular-line-left"
                                                                            style="background-color: rgb(255, 255, 255);">
                                                                        </div>
                                                                        <span class="swal2-success-line-tip"></span>
                                                                        <span class="swal2-success-line-long"></span>
                                                                        <div class="swal2-success-ring"></div>
                                                                        <div class="swal2-success-fix"
                                                                            style="background-color: rgb(255, 255, 255);">
                                                                        </div>
                                                                        <div class="swal2-success-circular-line-right"
                                                                            style="background-color: rgb(255, 255, 255);">
                                                                        </div>
                                                                    </div>
                                                                    <div class="results-subtitle">All caught up!</div>
                                                                    <div class="results-title">There are no system
                                                                        errors!</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="nav-item-divider nav-item"></li>
                                                    <li class="text-center nav-item-btn nav-item">
                                                        <button
                                                            class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm">View
                                                            Latest Changes</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="dots-separator"></div>
                                        <div class="dropdown">
                                            <a class="dot-btn-wrapper dd-chart-btn-2" aria-haspopup="true"
                                                data-toggle="dropdown" aria-expanded="false">
                                                <i class="dot-btn-icon typcn typcn-chart-bar-outline text-danger"></i>
                                                <div class="badge badge-dot badge-abs badge-dot-sm badge-warning">
                                                    Warning</div>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true"
                                                class="dropdown-menu-xl rm-pointers dropdown-menu">
                                                <div class="dropdown-menu-header">
                                                    <div class="dropdown-menu-header-inner bg-premium-dark">
                                                        <div class="menu-header-image"
                                                            style="background-image: url('/images/dropdown-header/abstract4.jpg');">
                                                        </div>
                                                        <div class="text-white menu-header-content">
                                                            <h5 class="menu-header-title">Users Online
                                                            </h5>
                                                            <h6 class="menu-header-subtitle">Recent Account Activity
                                                                Overview
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-chart">
                                                    <div class="widget-chart-content">
                                                        <div class="icon-wrapper rounded-circle">
                                                            <div class="icon-wrapper-bg opacity-9 bg-focus">
                                                            </div>
                                                            <i class="text-white lnr-users">
                                                            </i>
                                                        </div>
                                                        <div class="widget-numbers">
                                                            <span>344k</span>
                                                        </div>
                                                        <div class="pt-2 widget-subheading">
                                                            Profile views since last login
                                                        </div>
                                                        <div class="widget-description text-danger">
                                                            <span class="pr-1">
                                                                <span>176%</span>
                                                            </span>
                                                            <i class="fa fa-arrow-left"></i>
                                                        </div>
                                                    </div>
                                                    <div class="widget-chart-wrapper">
                                                        <div id="dashboard-sparkline-carousel-4-pop"></div>
                                                    </div>
                                                </div>
                                                <ul class="nav flex-column">
                                                    <li class="mt-0 nav-item-divider nav-item">
                                                    </li>
                                                    <li class="text-center nav-item-btn nav-item">
                                                        <button
                                                            class="btn-shine btn-wide btn-pill btn btn-warning btn-sm">
                                                            <i class="mr-2 fa fa-cog fa-spin">
                                                            </i>
                                                            View Details
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div> --}}
                                </div>
                                <div class="app-footer-right">
                                    <span class="text-muted">Consultoría Tecnologías y Gestión del Conocimiento S.A. de C.V.</span>
                                    {{-- <ul class="header-megamenu nav">
                                        <li class="nav-item">
                                            <a data-placement="top" rel="popover-focus" data-offset="300"
                                                data-toggle="popover-custom" class="nav-link">
                                                Footer Menu
                                                <div class="ml-0 ml-1 badge badge-success">
                                                    <small>Old</small>
                                                </div>
                                                <i class="ml-2 fa fa-angle-up opacity-8"></i>
                                            </a>
                                            <div class="rm-max-width rm-pointers">
                                                <div class="d-none popover-custom-content">
                                                    <div class="dropdown-mega-menu dropdown-mega-menu-sm">
                                                        <div class="grid-menu grid-menu-2col">
                                                            <div class="no-gutters row">
                                                                <div class="col-sm-6 col-xl-6">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item-header nav-item">Overview
                                                                        </li>
                                                                        <li class="nav-item"><a
                                                                                href="javascript:void(0);"
                                                                                class="nav-link"><i
                                                                                    class="nav-link-icon lnr-inbox">
                                                                                </i><span>Contacts</span></a></li>
                                                                        <li class="nav-item"><a
                                                                                href="javascript:void(0);"
                                                                                class="nav-link"><i
                                                                                    class="nav-link-icon lnr-book">
                                                                                </i><span>Incidents</span>
                                                                                <div
                                                                                    class="ml-auto badge badge-pill badge-danger">
                                                                                    5</div>
                                                                            </a></li>
                                                                        <li class="nav-item"><a
                                                                                href="javascript:void(0);"
                                                                                class="nav-link"><i
                                                                                    class="nav-link-icon lnr-picture">
                                                                                </i><span>Companies</span></a></li>
                                                                        <li class="nav-item"><a disabled=""
                                                                                href="javascript:void(0);"
                                                                                class="nav-link disabled"><i
                                                                                    class="nav-link-icon lnr-file-empty">
                                                                                </i><span>Dashboards</span></a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="col-sm-6 col-xl-6">
                                                                    <ul class="nav flex-column">
                                                                        <li class="nav-item-header nav-item">Sales &amp;
                                                                            Marketing</li>
                                                                        <li class="nav-item"><a
                                                                                href="javascript:void(0);"
                                                                                class="nav-link">Queues</a></li>
                                                                        <li class="nav-item"><a
                                                                                href="javascript:void(0);"
                                                                                class="nav-link">Resource
                                                                                Groups</a>
                                                                        </li>
                                                                        <li class="nav-item"><a
                                                                                href="javascript:void(0);"
                                                                                class="nav-link">Goal
                                                                                Metrics
                                                                                <div
                                                                                    class="ml-auto badge badge-warning">
                                                                                    3</div>
                                                                            </a></li>
                                                                        <li class="nav-item"><a
                                                                                href="javascript:void(0);"
                                                                                class="nav-link">Campaigns</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="ui-theme-settings">
            <button type="button" id="TooltipDemo" class="btn-open-options btn btn-outline-2x btn-outline-focus">
                <i class="fa fa-sync-alt icon-anim-pulse fa-2x"></i>
            </button>
            <div class="theme-settings__inner">
                <div class="scrollbar-container">
                    <div class="theme-settings__options-wrapper">
                        <h3 class="themeoptions-heading">Layout Options
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="p-0 widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="mr-3 widget-content-left">
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="app-sidebar-full">
                                                    <div class="switch-animate switch-off">
                                                        <input type="checkbox" data-toggle="toggle"
                                                            data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Full Sidebar
                                                </div>
                                                <div class="widget-subheading">Removes sidebar layout spacing.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="p-0 widget-content">
                                        <div class="widget-content-wrapper">
                                            <div class="mr-3 widget-content-left">
                                                <div class="switch has-switch switch-container-class"
                                                    data-class="body-subnav-pills">
                                                    <div class="switch-animate switch-off">
                                                        <input type="checkbox" data-toggle="toggle"
                                                            data-onstyle="success">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="widget-content-left">
                                                <div class="widget-heading">Pills Page Navigation Style
                                                </div>
                                                <div class="widget-subheading">Changes the page sub navigation style to
                                                    pills!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>
                                Sidebar Options
                            </div>
                            <button type="button"
                                class="ml-auto btn-pill btn-shadow btn-wide btn btn-focus btn-sm switch-sidebar-cs-class"
                                data-class="">
                                Restore Default
                            </button>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Choose Color Scheme
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div class="swatch-holder bg-primary switch-sidebar-cs-class"
                                            data-class="bg-primary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-secondary switch-sidebar-cs-class"
                                            data-class="bg-secondary sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-success switch-sidebar-cs-class"
                                            data-class="bg-success sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-info switch-sidebar-cs-class"
                                            data-class="bg-info sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-warning switch-sidebar-cs-class"
                                            data-class="bg-warning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-danger switch-sidebar-cs-class"
                                            data-class="bg-danger sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-light switch-sidebar-cs-class"
                                            data-class="bg-light sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-dark switch-sidebar-cs-class"
                                            data-class="bg-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-focus switch-sidebar-cs-class"
                                            data-class="bg-focus sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-alternate switch-sidebar-cs-class"
                                            data-class="bg-alternate sidebar-text-light">
                                        </div>
                                        <div class="divider">
                                        </div>
                                        <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class"
                                            data-class="bg-vicious-stance sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class"
                                            data-class="bg-midnight-bloom sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-night-sky switch-sidebar-cs-class"
                                            data-class="bg-night-sky sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class"
                                            data-class="bg-slick-carbon sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-asteroid switch-sidebar-cs-class"
                                            data-class="bg-asteroid sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-royal switch-sidebar-cs-class"
                                            data-class="bg-royal sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class"
                                            data-class="bg-warm-flame sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-night-fade switch-sidebar-cs-class"
                                            data-class="bg-night-fade sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class"
                                            data-class="bg-sunny-morning sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class"
                                            data-class="bg-tempting-azure sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class"
                                            data-class="bg-amy-crisp sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class"
                                            data-class="bg-heavy-rain sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class"
                                            data-class="bg-mean-fruit sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class"
                                            data-class="bg-malibu-beach sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class"
                                            data-class="bg-deep-blue sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class"
                                            data-class="bg-ripe-malin sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class"
                                            data-class="bg-arielle-smile sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class"
                                            data-class="bg-plum-plate sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class"
                                            data-class="bg-happy-fisher sidebar-text-dark">
                                        </div>
                                        <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class"
                                            data-class="bg-happy-itmeo sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class"
                                            data-class="bg-mixed-hopes sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class"
                                            data-class="bg-strong-bliss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-grow-early switch-sidebar-cs-class"
                                            data-class="bg-grow-early sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class"
                                            data-class="bg-love-kiss sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class"
                                            data-class="bg-premium-dark sidebar-text-light">
                                        </div>
                                        <div class="swatch-holder bg-happy-green switch-sidebar-cs-class"
                                            data-class="bg-happy-green sidebar-text-light">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h3 class="themeoptions-heading">
                            <div>Main Content Options</div>
                        </h3>
                        <div class="p-3">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h5 class="pb-2">Color Schemes
                                    </h5>
                                    <div class="theme-settings-swatches">
                                        <div role="group" class="mt-2 btn-group">
                                            <button type="button"
                                                class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class"
                                                data-class="app-theme-white">
                                                White Theme
                                            </button>
                                            <button type="button"
                                                class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class active"
                                                data-class="app-theme-gray">
                                                Gray Theme
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="app-drawer-wrapper">
        <div class="drawer-nav-btn">
            <button type="button" class="hamburger hamburger--elastic is-active">
                <span class="hamburger-box"><span class="hamburger-inner"></span></span></button>
        </div>
        <div class="drawer-content-wrapper">
            <div class="scrollbar-container">
                <h3 class="drawer-heading">Servers Status</h3>
                <div class="drawer-section">
                    <div class="row">
                        <div class="col">
                            <div class="progress-box">
                                <h4>Server Load 1</h4>
                                <div class="mx-auto circle-progress circle-progress-gradient-xl">
                                    <small></small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="progress-box">
                                <h4>Server Load 2</h4>
                                <div class="mx-auto circle-progress circle-progress-success-xl">
                                    <small></small>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="progress-box">
                                <h4>Server Load 3</h4>
                                <div class="mx-auto circle-progress circle-progress-danger-xl">
                                    <small></small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="mt-3">
                        <h5 class="text-center card-title">Live Statistics</h5>
                        <div id="sparkline-carousel-3"></div>
                        <div class="row">
                            <div class="col">
                                <div class="p-0 widget-chart">
                                    <div class="widget-chart-content">
                                        <div class="widget-numbers text-warning fsize-3">43</div>
                                        <div class="pt-1 widget-subheading">Packages</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-0 widget-chart">
                                    <div class="widget-chart-content">
                                        <div class="widget-numbers text-danger fsize-3">65</div>
                                        <div class="pt-1 widget-subheading">Dropped</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="p-0 widget-chart">
                                    <div class="widget-chart-content">
                                        <div class="widget-numbers text-success fsize-3">18</div>
                                        <div class="pt-1 widget-subheading">Invalid</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="mt-2 text-center d-block">
                            <button class="mr-2 border-0 btn-transition btn btn-outline-danger">Escalate Issue</button>
                            <button class="border-0 btn-transition btn btn-outline-success">Support Center</button>
                        </div>
                    </div>
                </div>
                <h3 class="drawer-heading">File Transfers</h3>
                <div class="p-0 drawer-section">
                    <div class="files-box">
                        <ul class="list-group list-group-flush">
                            <li class="pt-2 pb-2 pr-2 list-group-item">
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div
                                            class="mr-3 widget-content-left opacity-6 fsize-2 text-primary center-elem">
                                            <i class="fa fa-file-alt"></i>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading font-weight-normal">TPSReport.docx</div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                <i class="fa fa-cloud-download-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="pt-2 pb-2 pr-2 list-group-item">
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div
                                            class="mr-3 widget-content-left opacity-6 fsize-2 text-warning center-elem">
                                            <i class="fa fa-file-archive"></i>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading font-weight-normal">Latest_photos.zip</div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                <i class="fa fa-cloud-download-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="pt-2 pb-2 pr-2 list-group-item">
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="mr-3 widget-content-left opacity-6 fsize-2 text-danger center-elem">
                                            <i class="fa fa-file-pdf"></i>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading font-weight-normal">Annual Revenue.pdf</div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                <i class="fa fa-cloud-download-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="pt-2 pb-2 pr-2 list-group-item">
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div
                                            class="mr-3 widget-content-left opacity-6 fsize-2 text-success center-elem">
                                            <i class="fa fa-file-excel"></i>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading font-weight-normal">Analytics_GrowthReport.xls
                                            </div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <button class="btn-icon btn-icon-only btn btn-link btn-sm">
                                                <i class="fa fa-cloud-download-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <h3 class="drawer-heading">Tasks in Progress</h3>
                <div class="p-0 drawer-section">
                    <div class="todo-box">
                        <ul class="todo-list-wrapper list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="todo-indicator bg-warning"></div>
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="mr-2 widget-content-left">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" id="exampleCustomCheckbox1266"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="exampleCustomCheckbox1266">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Wash the car
                                                <div class="ml-2 badge badge-danger">Rejected</div>
                                            </div>
                                            <div class="widget-subheading"><i>Written by Bob</i></div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <button class="border-0 btn-transition btn btn-outline-success">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button class="border-0 btn-transition btn btn-outline-danger">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-focus"></div>
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="mr-2 widget-content-left">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" id="exampleCustomCheckbox1666"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="exampleCustomCheckbox1666">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Task with hover dropdown menu</div>
                                            <div class="widget-subheading">
                                                <div>By Johnny
                                                    <div class="ml-2 badge badge-pill badge-info">NEW</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <div class="d-inline-block dropdown">
                                                <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false" class="border-0 btn-transition btn btn-link">
                                                    <i class="fa fa-ellipsis-h">
                                                    </i>
                                                </button>
                                                <div tabindex="-1" role="menu" aria-hidden="true"
                                                    class="dropdown-menu dropdown-menu-right">
                                                    <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                    <button type="button" disabled="" tabindex="-1"
                                                        class="disabled dropdown-item">Action</button>
                                                    <button type="button" tabindex="0" class="dropdown-item">Another
                                                        Action</button>
                                                    <div tabindex="-1" class="dropdown-divider"></div>
                                                    <button type="button" tabindex="0" class="dropdown-item">Another
                                                        Action</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-primary"></div>
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="mr-2 widget-content-left">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" id="exampleCustomCheckbox4777"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="exampleCustomCheckbox4777">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Badge on the right task</div>
                                            <div class="widget-subheading">This task has show on hover actions!</div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <button class="border-0 btn-transition btn btn-outline-success">
                                                <i class="fa fa-check">
                                                </i>
                                            </button>
                                        </div>
                                        <div class="ml-3 widget-content-right">
                                            <div class="badge badge-pill badge-success">Latest Task</div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-info"></div>
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="mr-2 widget-content-left">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" id="exampleCustomCheckbox2444"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="exampleCustomCheckbox2444">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="mr-3 widget-content-left">
                                            <div class="widget-content-left"><img width="42" class="rounded"
                                                    src="{{ asset('images/default/avatars/1.jpg') }}" alt="" /></div>
                                        </div>
                                        <div class="widget-content-left">
                                            <div class="widget-heading">Go grocery shopping</div>
                                            <div class="widget-subheading">A short description ...</div>
                                        </div>
                                        <div class="widget-content-right widget-content-actions">
                                            <button class="border-0 btn-transition btn btn-sm btn-outline-success">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            <button class="border-0 btn-transition btn btn-sm btn-outline-danger">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="todo-indicator bg-success"></div>
                                <div class="p-0 widget-content">
                                    <div class="widget-content-wrapper">
                                        <div class="mr-2 widget-content-left">
                                            <div class="custom-checkbox custom-control">
                                                <input type="checkbox" id="exampleCustomCheckbox3222"
                                                    class="custom-control-input">
                                                <label class="custom-control-label"
                                                    for="exampleCustomCheckbox3222">&nbsp;</label>
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading">Development Task</div>
                                            <div class="widget-subheading">Finish React ToDo List App</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <div class="mr-2 badge badge-warning">69</div>
                                        </div>
                                        <div class="widget-content-right">
                                            <button class="border-0 btn-transition btn btn-outline-success">
                                                <i class="fa fa-check">
                                                </i>
                                            </button>
                                            <button class="border-0 btn-transition btn btn-outline-danger">
                                                <i class="fa fa-trash-alt">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <h3 class="drawer-heading">Urgent Notifications</h3>
                <div class="drawer-section">
                    <div class="notifications-box">
                        <div
                            class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                            <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">All Hands Meeting</h4><span
                                            class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <p>Yet another one, at <span class="text-success">15:00 PM</span></p><span
                                            class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">Build the production release
                                            <div class="ml-2 badge badge-danger">NEW</div>
                                        </h4>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item dot-primary vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">Something not important
                                            <div class="mt-2 avatar-wrapper avatar-wrapper-overlap">
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/1.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/2.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/profile.jpg') }}"
                                                            alt=""></div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/4.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/5.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/6.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/7.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm">
                                                    <div class="avatar-icon"><img
                                                            src="{{ asset('images/default/avatars/8.jpg') }}" alt="">
                                                    </div>
                                                </div>
                                                <div class="avatar-icon-wrapper avatar-icon-sm avatar-icon-add">
                                                    <div class="avatar-icon"><i>+</i></div>
                                                </div>
                                            </div>
                                        </h4>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item dot-info vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <h4 class="timeline-title">This dot has an info state</h4><span
                                            class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="vertical-timeline-item dot-dark vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon is-hidden"></span>
                                    <div class="vertical-timeline-element-content is-hidden">
                                        <h4 class="timeline-title">This dot has a dark state</h4><span
                                            class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>



    @livewireScripts
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script>
        function navbar() {
            return {
                errors: @json($errors->all()),
                expandNavbar: JSON.parse(localStorage.getItem('expandNavbar')) ? true : false,
                appContainer: document.getElementById('app-container'),
                navbarButton: document.getElementById('navbarButton'),

                /**
                 *
                 *
                 *
                 */

                mounted() {
                    document.cookie = `expandNavbar=${this.expandNavbar}`;

                    if (this.errors.length > 0) {
                        this.showErrors();
                    }
                },

                /**
                 *
                 *
                 *
                 */

                changeState() {
                    this.expandNavbar = !this.expandNavbar;
                    localStorage.setItem('expandNavbar', this.expandNavbar);
                    document.cookie = `expandNavbar=${this.expandNavbar}`;
                },


                showErrors() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: this.errors[0],
                        // footer: '<a href>Why do I have this issue?</a>'
                    })
                },

            }
        }

    </script>

    @include('sweetalert::alert')

    @stack('modals')
    @stack('scripts')

    {{-- To avoid sweet alert after shown --}}
    {{-- {{ Session::forget('alert') }} --}}
</body>

</html>
