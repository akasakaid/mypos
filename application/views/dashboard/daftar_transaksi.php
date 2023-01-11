<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <ul class="navbar-nav ml-auto">
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata(
                                        "username"
                                    ) ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url(
                                    "img/undraw_profile.svg"
                                ) ?>">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= base_url('dashboard/profile') ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url(
                                    "/auth/logout"
                                ) ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="container-fluid">
            <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->flashdata('success') ?>
            </div>
            <?php elseif ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('error') ?>
            </div>
            <?php endif; ?>
            <h1 class="h3 mb-2 text-gray-800">Daftar Transaksi</h1>
            <div class="card shadow mb-4 mt-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tabel Daftar Transaksi</h6>
                    <!-- button bernama tambah barang disebelah kanan -->
                    <a href="<?= base_url("dashboard/transaksi") ?>"
                        class="btn btn-primary btn-icon-split btn-sm float-right">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Buat Transaksi</span></a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Transaksi</th>
                                    <th>Total Penjualan</th>
                                    <th>Keuntungan</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID Transaksi</th>
                                    <th>Total Penjualan</th>
                                    <th>Keuntungan</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                        $no = 1;
                                        foreach ($data as $t): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $t->id ?></td>
                                    <td><?= $t->total ?></td>
                                    <td><?= $t->keuntungan ?></td>
                                    <td><?= $t->created_at ?></td>
                                    <td><a href="<?= base_url(
                                                "dashboard/detail_transaksi/$t->id"
                                            ) ?>" class="btn btn-primary">Detail</a></td>
                                </tr>
                                <?php endforeach;
                                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <?php echo "Copyright &copy; " . date("Y"); ?>
            </div>
        </div>
    </footer>
</div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url(
                        "/auth/logout"
                    ) ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url("/vendor/jquery/jquery.min.js") ?>"></script>
<script src="<?= base_url(
        "/vendor/bootstrap/js/bootstrap.bundle.min.js"
    ) ?>"></script>
<script src="<?= base_url(
        "/vendor/jquery-easing/jquery.easing.min.js"
    ) ?>"></script>
<script src="<?= base_url("/js/sb-admin-2.min.js") ?>"></script>
<script src="<?= base_url("/vendor/chart.js/Chart.min.js") ?>"></script>
<script src="<?= base_url(
        "/vendor/datatables/jquery.dataTables.min.js"
    ) ?>"></script>
<script src="<?= base_url(
        "/vendor/datatables/dataTables.bootstrap4.min.js"
    ) ?>"></script>
<script src="<?= base_url("/js/demo/chart-area-demo.js") ?>"></script>
<script src="<?= base_url("/js/demo/chart-pie-demo.js") ?>"></script>
<script src="<?= base_url("/js/demo/datatables-demo.js") ?>"></script>

</body>

</html>