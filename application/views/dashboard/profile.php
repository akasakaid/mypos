<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span
                            class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username')?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('img/undraw_profile.svg') ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('dashboard/profile') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('/auth/logout')?>" data-toggle="modal"
                            data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success fade show" role="alert">
                <strong>Success!</strong> <?= $this->session->flashdata('success') ?>
            </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger fade show" role="alert">
                <?= $this->session->flashdata('error') ?>
            </div>
            <?php endif; ?>
            <div class="card shadow col-9 mx-auto">
                <div class="card-title">
                    <h5 class="text-primary m-3">Edit Profile</h5>
                </div>
                <form action="<?= base_url('dashboard/update_profile')?>" method="POST" class="m-2">
                    <input type="hidden" class="" name="id" value="<?= $user->id ?>">
                    <label for="email" class="mt-3">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= $user->email ?>"
                        readonly>
                    <div class="text-secondary mb-3" style="font-size: 12px">
                        <h7>Email tidak bisa diubah !</h7>
                    </div>
                    <label for="username">Username</label>
                    <input type="text" name="username" value="<?= $user->username ?>" id="username"
                        class="form-control">
                    <div class="mt-3">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="<?= $user->fullname ?>" id="nama_lengkap"
                            class="form-control">

                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card shadow col-9 mx-auto mt-3">
                <div class="card-title">
                    <h5 class="text-primary m-3">Update Password</h5>
                </div>
                <form action="<?= base_url('dashboard/update_password')?>" method="POST" class="m-2">
                    <input type="hidden" class="" name="email" value="<?= $user->email ?>">
                    <label for="password_lama" class="mt-3">Password Lama</label>
                    <input type="password_lama" name="password_lama" id="password_lama" class="form-control">
                    <label for="Password Baru">Password Baru</label>
                    <input type="text" name="password_baru" id="Password Baru" class="form-control">
                    <div class="mt-3">
                        <label for="repeat_password">Ulangi Password Baru</label>
                        <input type="text" name="repeat_password" id="repeat_password" class="form-control">
                    </div>
                    <div class="row mt-3 mb-3">
                        <div class="col">
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->