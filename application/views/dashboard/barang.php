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

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Daftar Barang</h1>
            <!-- alert success dengan text 'barang berhasil di tambahkan' -->
            <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?= $this->session->flashdata('success') ?>
            </div>
            <?php endif; ?>
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Barang</h6>
                    <!-- button bernama tambah barang disebelah kanan -->
                    <a href="<?= base_url('dashboard/tambah_barang') ?>"
                        class="btn btn-primary btn-icon-split btn-sm float-right">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Tambah Barang</span></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Keterangan</th>
                                    <th>Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Stok</th>
                                    <th>Keterangan</th>
                                    <th>Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>

                                <?php $no = 1;
                                        // load function select from model barang
                                        $data = $this->barang->select();
                                        foreach ($data as $d) {
                                            if ($d->updated_at == null){
                                                $d->updated_at = 'Belum pernah diupdate';
                                            }
                                            echo '<tr>
                                                <td>' . $no . '</td>
                                                <td>' . $d->kode_barang . '</td>
                                                <td>' . $d->nama_barang . '</td>
                                                <td>' . $d->harga_beli . '</td>
                                                <td>' . $d->harga_jual . '</td>
                                                <td>' . $d->stok . '</td>
                                                <td>' . $d->keterangan . '</td>
                                                <td>' . $d->updated_at . '</td>
                                                <td>
                                                    <a href="' . base_url('dashboard/update_barang/' . $d->no) . '" class="btn btn-primary btn-sm">Edit</a>
                                                    <a href="' . base_url('dashboard/delete_barang/' . $d->no) . '" class="btn btn-danger btn-sm">Delete</a></td>   
                                            </tr>';
                                            $no++;
                                            # code...
                                        }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->