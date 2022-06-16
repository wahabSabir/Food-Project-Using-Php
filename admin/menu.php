<?php
include('../config/constants.php');
include('login-check.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/adminstyle.css">
</head>
<body>
<!-- Dashboard -->
<div class="d-flex flex-column flex-lg-row h-lg-full bg-surface-secondary">
    <!-- Vertical Navbar -->
    <nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
                <img src="../images/logo.png" style="height:50px;width:auto;">
            </a>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-house"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-admin.php">
                            <i class="bi bi-house"></i> Manage Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-category.php">
                            <i class="bi bi-bar-chart"></i> Manage Category
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-foods.php">
                            <i class="bi bi-chat"></i> Manage Food
                            <!-- <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">6</span> -->
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage-orders.php">
                            <i class="bi bi-bookmarks"></i> Manage Order
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                        <i class="bi-box-arrow-in-right"></i> Sign out
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>