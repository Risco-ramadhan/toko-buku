<!-- Sidebar -->
<ul class="navbar-nav bg-gradient sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center logo" href="<?= base_url('admin') ?>">
        <div class="">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img class="adminLogo" src="<?= base_url('assets/img/') ?>tokobuku.png" alt="toko buku" width="5px">
        </div>
        <div class="sidebar-brand-text text-dark"><?= $title ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">



    <!-- QUERY Menu -->
    <?php

    $role_id = $this->session->userdata('role_id');
    $querMenu = "SELECT `user_menu`.`id`,`menu`
     FROM `user_menu` 
     JOIN  `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id`
    WHERE `user_access_menu`.`role_id` = $role_id
    ORDER BY `user_access_menu`.`menu_id` ASC
    ";
    $menu = $this->db->query($querMenu)->result_array();

    ?>


    <!-- LOOPING MENU -->
    <?php
    foreach ($menu as $x) :

    ?>
        <div class="sidebar-heading text-dark">
            <?= $x['menu'] ?>
        </div>
        <?php
        $menuId = $x['id'];
        $querySubMenu = "SELECT * 
                            FROM `user_sub_menu`
                            JOIN `user_menu` ON `user_sub_menu` . `menu_id` = `user_menu` . `id`
                            WHERE `user_sub_menu` . `menu_id` = $menuId
                            AND `user_sub_menu`.`is_active` = 1
                            ";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <!-- Nav Item - Dashboard -->

            <?php if ($act == $sm['title']) {

            ?>
                <li class="nav-item ">
                    <a class="nav-link text-dark" href="<?= base_url($sm['url']) ?>">
                        <i class="<?= $sm['icon'] ?>" style="color: red;"></i>
                        <span style="color: red;"><?= $sm['title'] ?></span></a>
                </li>
            <?php } else { ?>
                <li class="nav-item ">
                    <a class="nav-link text-dark" href="<?= base_url($sm['url']) ?>">
                        <i class="<?= $sm['icon'] ?>" style="color: black;"></i>
                        <span><?= $sm['title'] ?></span></a>
                </li>
            <?php } ?>
        <?php endforeach ?>
        <hr class="sidebar-divider">
    <?php endforeach ?>

    <div class="sidebar-heading">
        Logout
    </div>
    <li class="nav-item">
        <a class="nav-link text-dark" href="<?= base_url('auth/logout') ?>">
            <i class="fas fa-fw fa-sign-out-alt" style="color: black;"></i>
            <span>Logout</span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->