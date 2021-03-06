<div class="app-sidebar sidebar-shadow">
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
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <?php
            $url = $_SERVER['REQUEST_URI'];
            //    $arr = explode('/shopping/admin/',$url);
            //    pretty($arr[1]);
            $arr = explode('/', $url);
            $path = $arr[count($arr) - 2];
            $rpath = $arr[count($arr) - 1];
            ?>
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Dashboard</li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/index.php" class="<?php echo $path == 'admin' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-home"></i>
                        Dashboard
                    </a>
                </li>
                <li class="app-sidebar__heading"> Management</li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/order/index.php" class="<?php echo $path == 'order' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-cart"></i>
                        Order

                    </a>

                </li>


                <li>
                    <a href="<?php echo BASE_URL ?>admin/product/index.php" class="<?php echo $path == 'product' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-next-2"></i>
                        Product

                    </a>

                </li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/category/index.php" class="<?php echo $path == 'category' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-menu"></i>
                        Category

                    </a>

                </li>
                <li class="app-sidebar__heading">Reports</li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/report/weekly_report.php" class="<?php echo $rpath == 'weekly_report.php' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Weekly Report
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/report/monthly_report.php" class="<?php echo $rpath == 'monthly_report.php' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-note2"></i>
                        Monthly Report
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/report/best_seller_item.php" class="<?php echo $rpath == 'best_seller_item.php' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon pe-7s-shopbag"></i>
                       Best Seller Item
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/report/royal_customer.php" class="<?php echo $rpath == 'royal_customer.php' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon feather-user-check"></i>
                        Royal Customer
                    </a>
                </li>
               

                <li class="app-sidebar__heading">Account</li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/user/index.php" class="<?php echo $path == 'user' ? 'mm-active' : ''; ?>">
                        <i class="metismenu-icon feather-users"></i>
                        Customers
                    </a>
                </li>

                <li class="app-sidebar__heading"></li>
                <li>
                    <a href="<?php echo BASE_URL ?>admin/logout.php">
                        <i class="metismenu-icon pe-7s-left-arrow"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>