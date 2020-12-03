    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="<?=base_url("Admin/profil")?>"><img src="<?=base_url('assets/logo/bpn.png')?>" style="width: 30px"> BPN</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                   
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="<?=base_url("Admin/profil")?>"><i class="fa fa-fw fa-user-circle"></i>Profil</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="<?=base_url("Admin/ukurTanah")?>"><i class="fa fa-map"></i>Ukur Tanah</a>
                            </li>
                             <li class="nav-item ">
                                <a class="nav-link" href="<?=base_url("Admin/History")?>"><i class="fa fa-history"></i>History</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="<?=base_url("Admin/laporan")?>"><i class="fa fa-file"></i>Laporan</a>
                            </li>
                             <li class="nav-item ">
                                <a class="nav-link" href="<?=base_url("login/Logout")?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
                            </li>



                        </ul>
                    </div>
                </nav>
            </div>
        </div>