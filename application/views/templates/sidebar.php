
        <!-- Sidebar -->
        <ul class="navbar-nav bg_auth sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user') ?>">
            <div class="sidebar-brand-icon">
            <i class="fas fa-fw fa-journal-whills"></i>
            </div>
            <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <div class="mx-auto mt-5">
            <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/').$user['image'] ?>" alt="">
            <p class="text-center mt-2"><?= $user['nama']; ?></p>
        </div>

        <!-- Nav Item - Dashboard -->
        <?php if($title == 'Home') { ?>
            <li class="nav-item active">
        <?php }else{ ?>
            <li class="nav-item">
        <?php } ?>
            <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            User
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <?php if($title == 'Profile') { ?>
        <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Profile</span>
            </a>
            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <?php }else{ ?>
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user-cog"></i>
            <span>Profile</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <?php } ?>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">My Profile</h6>
                <a class="collapse-item" href="<?= base_url('user/Profile') ?>">Lihat Profile saya</a>
                <a class="collapse-item" href="<?= base_url('user/EditProfile') ?>">Edit Profile</a>
            </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <?php if($title == 'Akun') { ?>
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-user-lock"></i>
                <span>Akun</span>
                </a>
                <div id="collapseUtilities" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <?php }else{ ?>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-user-lock"></i>
                <span>Akun</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <?php } ?>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Password</h6>
                <a class="collapse-item" href="cards.html">Change Password</a>
            </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Jurnal
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <?php if($title == 'Akun') { ?>
            <li class="nav-item active">
            <a class="nav-link" href="#" data-toggle="collapse" data-target="#jurnal" aria-expanded="true" aria-controls="jurnal">
            <i class="fas fa-fw fa-book"></i>
            <span>My Jurnal</span>
            </a>
            <div id="jurnal" class="collapse show" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <?php }else{ ?>
            <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jurnal" aria-expanded="true" aria-controls="jurnal">
            <i class="fas fa-fw fa-book"></i>
            <span>My Jurnal</span>
            </a>
            <div id="jurnal" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <?php } ?>
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">My Jurnal</h6>
                <a class="collapse-item" href="cards.html">My Jurnal</a>
            </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
