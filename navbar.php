<?php
    include 'assets.php';
?>

<link rel="stylesheet" href="assets/bootstrap-icons/font/bootstrap-icons.css">

<style>

@font-face {
    font-family: 'Kanit';
    src: url('assets/Kanit-Regular.ttf') format('truetype');
    font-weight: 500;
    font-style: normal;
}

html,
body {
    overflow-x: hidden;
    font-family: 'Kanit', sans-serif;
}

body {
    padding-top: 65px;
    background-color: #f8f9fa;
}

@media (max-width: 991.98px) {
  .offcanvas-collapse {
    position: fixed;
    top: 56px;
    bottom: 0;
    left: 100%;
    width: 100%;
    padding-right: 1rem;
    padding-left: 1rem;
    overflow-y: auto;
    visibility: hidden;
    background-color: #343a40;
    transition: transform .3s ease-in-out, visibility .3s ease-in-out;
  }

  .offcanvas-collapse.open {
    visibility: visible;
    transform: translateX(-100%);
  }
  
}

.navbar {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    display: flex;
    align-items: center;
    font-size: 1.25rem;
    font-weight: 600;
}

.navbar-brand img {
    margin-right: 10px;
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

.navbar-toggler {
    transition: transform 0.3s ease;
}

.navbar-toggler:hover {
    transform: rotate(90deg);
}

.nav-link {
    color: #adb5bd;
    font-weight: 500;
    transition: color 0.3s ease, transform 0.3s ease;
}

.nav-link:hover {
    color: #ffffff;
    transform: translateY(-1px);
}

.dropdown-menu {
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.nav-scroller {
    background-color: #343a40;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding: 0.5rem 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.nav-scroller .nav-link {
    color: rgba(255, 255, 255, 0.75);
    font-size: 0.9rem;
    padding: 0.5rem 1rem;
    border-radius: 10px;
}

.nav-scroller .nav-link:hover {
    color: #ffffff;
}

.badge {
    font-size: 0.75rem;
}
</style>

<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="test/logo.svg" alt="Logo">
            Dekit Delivery
        </a>
        <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse offcanvas-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-2"></i> Name Lastname
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="nav-scroller">
    <nav class="nav" aria-label="Secondary navigation">
        <a class="nav-link nav-content" href="#" data-content="menu"><i class="bi bi-house me-2"></i> Dashboard</a>
        <a class="nav-link nav-content" href="#" data-content="cart">
            <i class="bi bi-cart me-2"></i> Cart
            <span class="badge bg-light text-dark rounded-pill">27</span>
        </a>
    </nav>
</div>

<script>
(() => {
  'use strict'
  document.querySelector('#navbarSideCollapse').addEventListener('click', () => {
    document.querySelector('.offcanvas-collapse').classList.toggle('open')
  })
})()

$(document).ready(function() {
    const lastContent = localStorage.getItem('lastContent');
    if (lastContent) {
        $(".contents").hide();
        $("#" + lastContent).fadeIn();
    } else {
        $(".contents").hide();
        $(".contents").first().fadeIn();
    }
    $(".nav-content").on("click", function(e) {
        e.preventDefault();
        let show = $(this).data("content");
        $(".contents").hide();
        $("#" + show).fadeIn();
        localStorage.setItem('lastContent', show);
    })
})
</script>