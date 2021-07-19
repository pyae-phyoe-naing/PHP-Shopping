<?php

if (isset($_SESSION['user']) && $_SESSION['user']->role != 1) {
    unset($_SESSION['user']);
    set_url("https://localhost/shopping/admin/login.php");
    echo("<script>location.reload();</script>");
  }
 

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="<?php echo BASE_URL ?>admin/main.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo BASE_URL ?>asset/feather-icons/feather.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
</head>

<body>
    
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header mb-5">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <?php
                $curUrl =  $_SERVER["PHP_SELF"];

                $ary = explode('/shopping/admin/', $curUrl);
                // pretty($ary[1]);
                $page = $ary[1];
                if ($page == 'user/index.php' || $page == 'category/index.php' || $page == 'product/index.php' ) {
                ?>
                    <div class="app-header-left">
                        <form class="form-inline" method="post" <?php if ($page == 'product' || $page == 'category' || $page == 'user') : ?> action="index.php" <?php endif; ?>>
                            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token'] ?>">
                            <input type="text" name="search" class="form-control py-0" placeholder="search">
                            <button type="submit" class="btn btn-primary  ml-2"><i class="pe-7s-search" style="font-size:18px"></i></button>
                        </form>
                    </div>
                <?php } ?>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="<?php echo "https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=" . $_SESSION['user']->name;  ?>" alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                            <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a href="<?php echo BASE_URL ?>admin/logout.php" type="button" tabindex="0" class="dropdown-item">Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        <?php
                                        echo isset($_SESSION['user']) ?  $_SESSION['user']->name : 'Need Login';
                                        ?>
                                    </div>
                                    <div class="widget-subheading">
                                        <?php
                                        echo isset($_SESSION['user']) ?  $_SESSION['user']->phone : 'Need Login';
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <?php require('sidebar.php') ?>
            <div class="app-main__outer">