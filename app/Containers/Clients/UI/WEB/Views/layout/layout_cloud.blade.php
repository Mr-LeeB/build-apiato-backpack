<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>VINACIS || Dashboard</title>
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <link href={{ asset("theme/base/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href={{ asset("theme/base/assets/plugins/global/plugins.bundle.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <link href={{ asset("theme/base/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <link href={{ asset("theme/base/assets/css/style.bundle.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <link href={{ asset("theme/base/css/custom.css") }} rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href={{ asset("theme/base/assets/css/themes/layout/header/base/light.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <link href={{ asset("theme/base/assets/css/themes/layout/header/menu/light.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <link href={{ asset("theme/base/assets/css/themes/layout/brand/dark.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <link href={{ asset("theme/base/assets/css/themes/layout/aside/dark.css?v=7.0.3") }} rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <!-- begin:: dàn cấm xoá -->
    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif;
        }

        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading,
        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link {
            background-color: #db1430;
        }

        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-heading .menu-icon,
        .aside-menu .menu-nav>.menu-item.menu-item-active>.menu-link .menu-icon i {
            color: white;
        }

        .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-heading,
        .aside-menu .menu-nav>.menu-item:not(.menu-item-parent):not(.menu-item-open):not(.menu-item-here):not(.menu-item-active):hover>.menu-link {
            background-color: #db1430;
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
    </style>
    <style type="text/css">
        .apexcharts-canvas {
            position: relative;
            user-select: none;
            /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
        }


        /* scrollbar is not visible by default for legend, hence forcing the visibility */
        .apexcharts-canvas ::-webkit-scrollbar {
            -webkit-appearance: none;
            width: 6px;
        }

        .apexcharts-canvas ::-webkit-scrollbar-thumb {
            border-radius: 4px;
            background-color: rgba(0, 0, 0, .5);
            box-shadow: 0 0 1px rgba(255, 255, 255, .5);
            -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
        }

        .apexcharts-canvas.apexcharts-theme-dark {
            background: #424242;
        }

        .apexcharts-inner {
            position: relative;
        }

        .apexcharts-text tspan {
            font-family: inherit;
        }

        .legend-mouseover-inactive {
            transition: 0.15s ease all;
            opacity: 0.20;
        }

        .apexcharts-series-collapsed {
            opacity: 0;
        }

        .apexcharts-tooltip {
            border-radius: 5px;
            box-shadow: 2px 2px 6px -4px #999;
            cursor: default;
            font-size: 14px;
            left: 62px;
            opacity: 0;
            pointer-events: none;
            position: absolute;
            top: 20px;
            overflow: hidden;
            white-space: nowrap;
            z-index: 12;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-tooltip.apexcharts-theme-light {
            border: 1px solid #e3e3e3;
            background: rgba(255, 255, 255, 0.96);
        }

        .apexcharts-tooltip.apexcharts-theme-dark {
            color: #fff;
            background: rgba(30, 30, 30, 0.8);
        }

        .apexcharts-tooltip * {
            font-family: inherit;
        }


        .apexcharts-tooltip-title {
            padding: 6px;
            font-size: 15px;
            margin-bottom: 4px;
        }

        .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
            background: #ECEFF1;
            border-bottom: 1px solid #ddd;
        }

        .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
            background: rgba(0, 0, 0, 0.7);
            border-bottom: 1px solid #333;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            display: inline-block;
            font-weight: 600;
            margin-left: 5px;
        }

        .apexcharts-tooltip-text-z-label:empty,
        .apexcharts-tooltip-text-z-value:empty {
            display: none;
        }

        .apexcharts-tooltip-text-value,
        .apexcharts-tooltip-text-z-value {
            font-weight: 600;
        }

        .apexcharts-tooltip-marker {
            width: 12px;
            height: 12px;
            position: relative;
            top: 0px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .apexcharts-tooltip-series-group {
            padding: 0 10px;
            display: none;
            text-align: left;
            justify-content: left;
            align-items: center;
        }

        .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
            opacity: 1;
        }

        .apexcharts-tooltip-series-group.apexcharts-active,
        .apexcharts-tooltip-series-group:last-child {
            padding-bottom: 4px;
        }

        .apexcharts-tooltip-series-group-hidden {
            opacity: 0;
            height: 0;
            line-height: 0;
            padding: 0 !important;
        }

        .apexcharts-tooltip-y-group {
            padding: 6px 0 5px;
        }

        .apexcharts-tooltip-candlestick {
            padding: 4px 8px;
        }

        .apexcharts-tooltip-candlestick>div {
            margin: 4px 0;
        }

        .apexcharts-tooltip-candlestick span.value {
            font-weight: bold;
        }

        .apexcharts-tooltip-rangebar {
            padding: 5px 8px;
        }

        .apexcharts-tooltip-rangebar .category {
            font-weight: 600;
            color: #777;
        }

        .apexcharts-tooltip-rangebar .series-name {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .apexcharts-xaxistooltip {
            opacity: 0;
            padding: 9px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
            transition: 0.15s ease all;
        }

        .apexcharts-xaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-xaxistooltip:after,
        .apexcharts-xaxistooltip:before {
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-xaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-left: -6px;
        }

        .apexcharts-xaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-left: -7px;
        }

        .apexcharts-xaxistooltip-bottom:after,
        .apexcharts-xaxistooltip-bottom:before {
            bottom: 100%;
        }

        .apexcharts-xaxistooltip-top:after,
        .apexcharts-xaxistooltip-top:before {
            top: 100%;
        }

        .apexcharts-xaxistooltip-bottom:after {
            border-bottom-color: #ECEFF1;
        }

        .apexcharts-xaxistooltip-bottom:before {
            border-bottom-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
            border-bottom-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top:after {
            border-top-color: #ECEFF1
        }

        .apexcharts-xaxistooltip-top:before {
            border-top-color: #90A4AE;
        }

        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {
            border-top-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
            border-top-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-xaxistooltip.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-yaxistooltip {
            opacity: 0;
            padding: 4px 10px;
            pointer-events: none;
            color: #373d3f;
            font-size: 13px;
            text-align: center;
            border-radius: 2px;
            position: absolute;
            z-index: 10;
            background: #ECEFF1;
            border: 1px solid #90A4AE;
        }

        .apexcharts-yaxistooltip.apexcharts-theme-dark {
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(0, 0, 0, 0.5);
            color: #fff;
        }

        .apexcharts-yaxistooltip:after,
        .apexcharts-yaxistooltip:before {
            top: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .apexcharts-yaxistooltip:after {
            border-color: rgba(236, 239, 241, 0);
            border-width: 6px;
            margin-top: -6px;
        }

        .apexcharts-yaxistooltip:before {
            border-color: rgba(144, 164, 174, 0);
            border-width: 7px;
            margin-top: -7px;
        }

        .apexcharts-yaxistooltip-left:after,
        .apexcharts-yaxistooltip-left:before {
            left: 100%;
        }

        .apexcharts-yaxistooltip-right:after,
        .apexcharts-yaxistooltip-right:before {
            right: 100%;
        }

        .apexcharts-yaxistooltip-left:after {
            border-left-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-left:before {
            border-left-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
            border-left-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right:after {
            border-right-color: #ECEFF1;
        }

        .apexcharts-yaxistooltip-right:before {
            border-right-color: #90A4AE;
        }

        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
            border-right-color: rgba(0, 0, 0, 0.5);
        }

        .apexcharts-yaxistooltip.apexcharts-active {
            opacity: 1;
        }

        .apexcharts-yaxistooltip-hidden {
            display: none;
        }

        .apexcharts-xcrosshairs,
        .apexcharts-ycrosshairs {
            pointer-events: none;
            opacity: 0;
            transition: 0.15s ease all;
        }

        .apexcharts-xcrosshairs.apexcharts-active,
        .apexcharts-ycrosshairs.apexcharts-active {
            opacity: 1;
            transition: 0.15s ease all;
        }

        .apexcharts-ycrosshairs-hidden {
            opacity: 0;
        }

        .apexcharts-selection-rect {
            cursor: move;
        }

        .svg_select_boundingRect,
        .svg_select_points_rot {
            pointer-events: none;
            opacity: 0;
            visibility: hidden;
        }

        .apexcharts-selection-rect+g .svg_select_boundingRect,
        .apexcharts-selection-rect+g .svg_select_points_rot {
            opacity: 0;
            visibility: hidden;
        }

        .apexcharts-selection-rect+g .svg_select_points_l,
        .apexcharts-selection-rect+g .svg_select_points_r {
            cursor: ew-resize;
            opacity: 1;
            visibility: visible;
        }

        .svg_select_points {
            fill: #efefef;
            stroke: #333;
            rx: 2;
        }

        .apexcharts-canvas.apexcharts-zoomable .hovering-zoom {
            cursor: crosshair
        }

        .apexcharts-canvas.apexcharts-zoomable .hovering-pan {
            cursor: move
        }

        .apexcharts-zoom-icon,
        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon,
        .apexcharts-reset-icon,
        .apexcharts-pan-icon,
        .apexcharts-selection-icon,
        .apexcharts-menu-icon,
        .apexcharts-toolbar-custom-icon {
            cursor: pointer;
            width: 20px;
            height: 20px;
            line-height: 24px;
            color: #6E8192;
            text-align: center;
        }

        .apexcharts-zoom-icon svg,
        .apexcharts-zoomin-icon svg,
        .apexcharts-zoomout-icon svg,
        .apexcharts-reset-icon svg,
        .apexcharts-menu-icon svg {
            fill: #6E8192;
        }

        .apexcharts-selection-icon svg {
            fill: #444;
            transform: scale(0.76)
        }

        .apexcharts-theme-dark .apexcharts-zoom-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
        .apexcharts-theme-dark .apexcharts-zoomout-icon svg,
        .apexcharts-theme-dark .apexcharts-reset-icon svg,
        .apexcharts-theme-dark .apexcharts-pan-icon svg,
        .apexcharts-theme-dark .apexcharts-selection-icon svg,
        .apexcharts-theme-dark .apexcharts-menu-icon svg,
        .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {
            fill: #f3f4f5;
        }

        .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
        .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {
            fill: #008FFB;
        }

        .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
        .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
        .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,
        .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
        .apexcharts-theme-light .apexcharts-menu-icon:hover svg {
            fill: #333;
        }

        .apexcharts-selection-icon,
        .apexcharts-menu-icon {
            position: relative;
        }

        .apexcharts-reset-icon {
            margin-left: 5px;
        }

        .apexcharts-zoom-icon,
        .apexcharts-reset-icon,
        .apexcharts-menu-icon {
            transform: scale(0.85);
        }

        .apexcharts-zoomin-icon,
        .apexcharts-zoomout-icon {
            transform: scale(0.7)
        }

        .apexcharts-zoomout-icon {
            margin-right: 3px;
        }

        .apexcharts-pan-icon {
            transform: scale(0.62);
            position: relative;
            left: 1px;
            top: 0px;
        }

        .apexcharts-pan-icon svg {
            fill: #fff;
            stroke: #6E8192;
            stroke-width: 2;
        }

        .apexcharts-pan-icon.apexcharts-selected svg {
            stroke: #008FFB;
        }

        .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
            stroke: #333;
        }

        .apexcharts-toolbar {
            position: absolute;
            z-index: 11;
            max-width: 176px;
            text-align: right;
            border-radius: 3px;
            padding: 0px 6px 2px 6px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .apexcharts-menu {
            background: #fff;
            position: absolute;
            top: 100%;
            border: 1px solid #ddd;
            border-radius: 3px;
            padding: 3px;
            right: 10px;
            opacity: 0;
            min-width: 110px;
            transition: 0.15s ease all;
            pointer-events: none;
        }

        .apexcharts-menu.apexcharts-menu-open {
            opacity: 1;
            pointer-events: all;
            transition: 0.15s ease all;
        }

        .apexcharts-menu-item {
            padding: 6px 7px;
            font-size: 12px;
            cursor: pointer;
        }

        .apexcharts-theme-light .apexcharts-menu-item:hover {
            background: #eee;
        }

        .apexcharts-theme-dark .apexcharts-menu {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        @media screen and (min-width: 768px) {
            .apexcharts-canvas:hover .apexcharts-toolbar {
                opacity: 1;
            }
        }

        .apexcharts-datalabel.apexcharts-element-hidden {
            opacity: 0;
        }

        .apexcharts-pie-label,
        .apexcharts-datalabels,
        .apexcharts-datalabel,
        .apexcharts-datalabel-label,
        .apexcharts-datalabel-value {
            cursor: default;
            pointer-events: none;
        }

        .apexcharts-pie-label-delay {
            opacity: 0;
            animation-name: opaque;
            animation-duration: 0.3s;
            animation-fill-mode: forwards;
            animation-timing-function: ease;
        }

        .apexcharts-canvas .apexcharts-element-hidden {
            opacity: 0;
        }

        .apexcharts-hide .apexcharts-series-points {
            opacity: 0;
        }

        .apexcharts-gridline,
        .apexcharts-annotation-rect,
        .apexcharts-tooltip .apexcharts-marker,
        .apexcharts-area-series .apexcharts-area,
        .apexcharts-line,
        .apexcharts-zoom-rect,
        .apexcharts-toolbar svg,
        .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
        .apexcharts-radar-series path,
        .apexcharts-radar-series polygon {
            pointer-events: none;
        }


        /* markers */

        .apexcharts-marker {
            transition: 0.15s ease all;
        }

        @keyframes opaque {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }


        /* Resize generated styles */

        @keyframes resizeanim {
            from {
                opacity: 0;
            }

            to {
                opacity: 0;
            }
        }

        .resize-triggers {
            animation: 1ms resizeanim;
            visibility: hidden;
            opacity: 0;
        }

        .resize-triggers,
        .resize-triggers>div,
        .contract-trigger:before {
            content: " ";
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        .resize-triggers>div {
            background: #eee;
            overflow: auto;
        }

        .contract-trigger:before {
            width: 200%;
            height: 200%;
        }
    </style>
    <style type="text/css">
        .topbar .btn.btn-icon i {
            color: #6e7899
        }

        .topbar .btn.btn-icon .svg-icon svg g [fill] {
            -webkit-transition: fill .3s ease;
            transition: fill .3s ease;
            fill: #6e7899
        }

        .topbar .btn.btn-icon .svg-icon svg:hover g [fill] {
            -webkit-transition: fill .3s ease;
            transition: fill .3s ease
        }

        .topbar .btn.btn-icon.active,
        .topbar .btn.btn-icon:active,
        .topbar .btn.btn-icon:focus,
        .topbar .btn.btn-icon:hover,
        .topbar .show .btn.btn-icon.btn-dropdown {
            background-color: #282f48 !important
        }

        .topbar .btn.btn-icon.active i,
        .topbar .btn.btn-icon:active i,
        .topbar .btn.btn-icon:focus i,
        .topbar .btn.btn-icon:hover i,
        .topbar .show .btn.btn-icon.btn-dropdown i {
            color: #fff !important
        }

        .topbar .btn.btn-icon.active .svg-icon svg g [fill],
        .topbar .btn.btn-icon:active .svg-icon svg g [fill],
        .topbar .btn.btn-icon:focus .svg-icon svg g [fill],
        .topbar .btn.btn-icon:hover .svg-icon svg g [fill],
        .topbar .show .btn.btn-icon.btn-dropdown .svg-icon svg g [fill] {
            -webkit-transition: fill .3s ease;
            transition: fill .3s ease;
            fill: #fff !important
        }

        .topbar .btn.btn-icon.active .svg-icon svg:hover g [fill],
        .topbar .btn.btn-icon:active .svg-icon svg:hover g [fill],
        .topbar .btn.btn-icon:focus .svg-icon svg:hover g [fill],
        .topbar .btn.btn-icon:hover .svg-icon svg:hover g [fill],
        .topbar .show .btn.btn-icon.btn-dropdown .svg-icon svg:hover g [fill] {
            -webkit-transition: fill .3s ease;
            transition: fill .3s ease
        }

        @media (min-width: 992px) {
            .header {
                background-color: #1e1e2d
            }

            .header-fixed .header {
                -webkit-box-shadow: 0 0 40px 0 rgba(82, 63, 105, .1);
                box-shadow: 0 0 40px 0 rgba(82, 63, 105, .1)
            }

            .header .header-menu .menu-nav>.menu-item>.menu-link {
                border-radius: 4px
            }

            .header .header-menu .menu-nav>.menu-item>.menu-link .menu-text {
                color: #6e7899;
                font-weight: 500
            }

            .header .header-menu .menu-nav>.menu-item>.menu-link .menu-arrow {
                color: #6e7899
            }

            .header .header-menu .menu-nav>.menu-item>.menu-link .menu-icon {
                color: #6e7899
            }

            .header .header-menu .menu-nav>.menu-item>.menu-link svg g [fill] {
                -webkit-transition: fill .3s ease;
                transition: fill .3s ease;
                fill: #6e7899
            }

            .header .header-menu .menu-nav>.menu-item>.menu-link svg:hover g [fill] {
                -webkit-transition: fill .3s ease;
                transition: fill .3s ease
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-active>.menu-link,
            .header .header-menu .menu-nav>.menu-item.menu-item-here>.menu-link {
                background-color: #282f48
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-active>.menu-link .menu-text,
            .header .header-menu .menu-nav>.menu-item.menu-item-here>.menu-link .menu-text {
                color: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-active>.menu-link .menu-arrow,
            .header .header-menu .menu-nav>.menu-item.menu-item-here>.menu-link .menu-arrow {
                color: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-active>.menu-link .menu-icon,
            .header .header-menu .menu-nav>.menu-item.menu-item-here>.menu-link .menu-icon {
                color: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-active>.menu-link svg g [fill],
            .header .header-menu .menu-nav>.menu-item.menu-item-here>.menu-link svg g [fill] {
                -webkit-transition: fill .3s ease;
                transition: fill .3s ease;
                fill: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-active>.menu-link svg:hover g [fill],
            .header .header-menu .menu-nav>.menu-item.menu-item-here>.menu-link svg:hover g [fill] {
                -webkit-transition: fill .3s ease;
                transition: fill .3s ease
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-hover:not(.menu-item-here):not(.menu-item-active)>.menu-link,
            .header .header-menu .menu-nav>.menu-item:hover:not(.menu-item-here):not(.menu-item-active)>.menu-link {
                background-color: #282f48
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-hover:not(.menu-item-here):not(.menu-item-active)>.menu-link .menu-text,
            .header .header-menu .menu-nav>.menu-item:hover:not(.menu-item-here):not(.menu-item-active)>.menu-link .menu-text {
                color: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-hover:not(.menu-item-here):not(.menu-item-active)>.menu-link .menu-arrow,
            .header .header-menu .menu-nav>.menu-item:hover:not(.menu-item-here):not(.menu-item-active)>.menu-link .menu-arrow {
                color: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-hover:not(.menu-item-here):not(.menu-item-active)>.menu-link .menu-icon,
            .header .header-menu .menu-nav>.menu-item:hover:not(.menu-item-here):not(.menu-item-active)>.menu-link .menu-icon {
                color: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-hover:not(.menu-item-here):not(.menu-item-active)>.menu-link svg g [fill],
            .header .header-menu .menu-nav>.menu-item:hover:not(.menu-item-here):not(.menu-item-active)>.menu-link svg g [fill] {
                -webkit-transition: fill .3s ease;
                transition: fill .3s ease;
                fill: #fff
            }

            .header .header-menu .menu-nav>.menu-item.menu-item-hover:not(.menu-item-here):not(.menu-item-active)>.menu-link svg:hover g [fill],
            .header .header-menu .menu-nav>.menu-item:hover:not(.menu-item-here):not(.menu-item-active)>.menu-link svg:hover g [fill] {
                -webkit-transition: fill .3s ease;
                transition: fill .3s ease
            }
        }

        @media (max-width: 991.98px) {
            .topbar {
                background-color: #1e1e2d;
                -webkit-box-shadow: none;
                box-shadow: none
            }

            .topbar-mobile-on .topbar {
                -webkit-box-shadow: 0 0 40px 0 rgba(82, 63, 105, .1);
                box-shadow: 0 0 40px 0 rgba(82, 63, 105, .1);
                border-top: 1px solid #2e3448
            }
        }
    </style>
    <!-- end:: dàn cấm xoá -->
</head>

<body id="kt_body"
    class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable">
    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
        <a href="/">
        </a>
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->
            <!--begin::Header Menu Mobile Toggle-->
            <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <!--end::Header Menu Mobile Toggle-->
            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:theme/base/assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero"></path>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
    </div>
    <div class="d-flex flex-column flex-root">

        <div class="d-flex flex-row flex-column-fluid page">

            <div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">
                <!-- begin:: Aside -->
                <div class="brand flex-column-auto" id="kt_brand" kt-hidden-height="65">
                    <a href="https://cloud.vinacis.com" class="brand-logo">
                        <img src="https://cloud.vinacis.com/storage/vinacis/images/logo.png"
                            style="width: 100%; height: auto" class="img-fluid">
                    </a>
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:/metronic/themes/metronic/theme/html/demo1/dist/theme/base/assets/media/svg/icons/Navigation/Angle-double-left.svg--><svg
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path
                                        d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) ">
                                    </path>
                                    <path
                                        d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"
                                        transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) ">
                                    </path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                    </button>
                </div>

                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <div id="kt_aside_menu" class="aside-menu my-4 scroll ps ps--active-y" data-menu-vertical="1"
                        data-menu-scroll="1" data-menu-dropdown-timeout="500"
                        style="height: 236px; overflow: hidden;">
                        <ul class="menu-nav">

                            <li class="menu-section">
                                <h4 class="menu-text">MENU</h4>
                                <i class="menu-icon flaticon-more-v2"></i>
                            </li>


                            <li class="menu-item " aria-haspopup="true">
                                <a href="https://cloud.vinacis.com/order" class="menu-link ">
                                    <span class="menu-icon">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span class="menu-text">Đăng ký dịch vụ</span>
                                </a>
                            </li>


                            <li class="menu-section">
                                <h4 class="menu-text">Hợp tác xã</h4>
                                <i class="menu-icon flaticon-more-v2"></i>
                            </li>



                            <li class="menu-item " aria-haspopup="true">
                                <a href="https://cloud.vinacis.com/reseller" class="menu-link ">
                                    <span class="menu-icon">
                                        <i class="fa fa-sitemap"></i>
                                    </span>
                                    <span class="menu-text">Đăng ký đại lý</span>
                                </a>
                            </li>

                            <li class="menu-item " aria-haspopup="true">
                                <a href="https://cloud.vinacis.com/investor" class="menu-link ">
                                    <span class="menu-icon">
                                        <i class="fa fa-dollar-sign"></i><i class="fa fa-dollar-sign"></i><i
                                            class="fa fa-dollar-sign"></i>
                                    </span>
                                    <span class="menu-text">Đăng ký đầu tư</span>
                                </a>
                            </li>

                        </ul>
                        <ul class="menu-nav">
                            <li class="menu-section">
                                <h4 class="menu-text">KHÁC</h4>
                                <i class="menu-icon flaticon-more-v2"></i>
                            </li>

                            <li class="menu-item " aria-haspopup="true">
                                <a href="https://cloud.vinacis.com/contact" class="menu-link ">
                                    <span class="menu-icon">
                                        <i class="fa fa-envelope"></i>
                                    </span>
                                    <span class="menu-text">Liên hệ</span>
                                </a>
                            </li>
                            <li class="menu-item " aria-haspopup="true">
                              <a href="/releasevuejs" class="menu-link">
                                  <span class="menu-icon">
                                    <i class="flaticon2-gear fa-spin text-warning"></i>
                                  </span>
                                  <span class="menu-text">Release</span>
                              </a>
                          </li>
                          <li class="menu-item " aria-haspopup="true">
                            <a href="/" class="menu-link">
                                <span class="menu-icon">
                                  <i class="flaticon2-gear fa-spin text-info"></i>
                                </span>
                                <span class="menu-text">Homepage</span>
                            </a>
                        </li>
                        </ul>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 447px; right: 4px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 173px;"></div>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 236px; right: 4px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 71px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

                <div id="kt_header" class="header header-fixed">
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <div id="kt_header_menu"
                                class="header-menu header-menu-mobile header-menu-layout-default">
                            </div>
                        </div>
                        <div class="topbar">
                            <div class="topbar-item topbar-item--user">
                                <a href="https://cloud.vinacis.com/login" class="btn btn-danger mr-5">
                                    <i class="fa fa-sign-in-alt"></i> Đăng nhập
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- begin:: Minh -->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
                        <div
                            class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <div class="d-flex align-items-center flex-wrap mr-1">
                                <div class="d-flex align-items-baseline mr-5">
                                    <h5 id="sub_title_h5" class="text-dark font-weight-bold my-2 mr-5">@yield('title')</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Begin:: Work Minh -->
                    <div id="kt_yield_content" class="d-flex flex-column-fluid">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                  @yield('content')
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End: Work Minh -->
                </div>

                <!-- end:: Minh -->
                <div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1" style="font-size:12px">
                          @yield('footer')
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Nav-->

                        <!--end::Nav-->
                    </div>
                    <!--end::Container-->
                </div>

            </div>
        </div>

    </div>
    <script>
        let HOST_URL = "https://keenthemes.com/metronic/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        let KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1200
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#F3F6F9",
                        "dark": "#212121"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#ECF0F3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#212121",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#ECF0F3",
                    "gray-300": "#E5EAEE",
                    "gray-400": "#D6D6E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#80808F",
                    "gray-700": "#464E5F",
                    "gray-800": "#1B283F",
                    "gray-900": "#212121"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->


    <script src={{ asset("theme/base/assets/plugins/global/plugins.bundle.js?v=7.0.3") }}></script>
    <script src={{ asset("theme/base/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.3") }}></script>
    <script src={{ asset("theme/base/assets/js/scripts.bundle.js?v=7.0.3") }}></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src={{ asset("theme/base/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js?v=7.0.3") }}></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src={{ asset("theme/base/assets/js/pages/widgets.js?v=7.0.3") }}></script>
    <script src={{ asset("/theme/base/assets/js/pages/features/miscellaneous/blockui.js?v=7.0.3") }}
    <iframe id="_hjSafeContext_94917652" title="_hjSafeContext" tabindex="-1" aria-hidden="true" src="about:blank" style="display: none !important; width: 1px !important; height: 1px !important; opacity: 0 !important; pointer-events: none !important;"></iframe>
    <script src={{ asset("theme/base/js/utils.js") }}></script>
    <script src={{ asset("theme/base/nova_assets/plugins/custom/datatables/datatables.bundle.js") }}></script>
    <link href={{ asset("theme/base/nova_assets/plugins/custom/datatables/datatables.bundle.css") }} rel="stylesheet" type="text/css" />
    <!--end::Page Scripts-->
    <script src={{ asset("theme/base/assets/js/pages/crud/forms/widgets/select2.js?v=7.0.3") }}></script>

    @yield('javascript')
    @yield('css')
    @stack('after_script')
</body>

</html>
