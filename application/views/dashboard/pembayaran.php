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
            <div class="row">
                <div class="card shadow col-5 mx-auto">
                    <div class="card-title mt-3">
                        <h4 class="text-primary">Pembayaran</h4>
                    </div>
                    <form action="<?= base_url('dashboard/transaksi')?>" method="POST" class="m-3">
                        <input type="hidden" name="id_transaksi" value="<?= $id?>">
                        <label for="total_pembelian">Total Pembelian</label>
                        <input type="text" name="total_pembelian" value="<?= $data->total ?>" id="total_pembelian"
                            class="form-control" readonly>
                        <label for="uang_pembeli" class="mt-3">Uang Pembeli</label>
                        <input type="number" name="uang_pembeli" id="uang_pembeli" class="form-control">
                        <label for="kembalian" class="mt-3">kembalian</label>
                        <input type="number" name="kembalian" id="kembalian" class="form-control" readonly>
                        <div class="row mt-3">
                            <div class="col">
                                <a href="<?php $url = 'dashboard/cancel_pembayaran/'.$id; echo base_url($url) ?>"
                                    class="btn btn-danger">Batal</a>
                            </div>
                            <div class="col"></div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <?php echo 'Copyright &copy; ' . date('Y');?>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
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
                <a class="btn btn-primary" href="<?= base_url('/auth/logout')?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> -->
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('/js/sb-admin-2.min.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?= base_url('/vendor/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<!-- <script src="<?= base_url('/js/demo/chart-area-demo.js') ?>"></script>
<script src="<?= base_url('/js/demo/chart-pie-demo.js') ?>"></script> -->
<script src="<?= base_url('/js/demo/datatables-demo.js') ?>"></script>
<script>
$('#uang_pembeli').change(function() {
    var total_pembelian = parseInt($('#total_pembelian').val());
    var uang_pembeli = parseInt($('#uang_pembeli').val());
    var kembalian = uang_pembeli - total_pembelian;
    $('#kembalian').val(kembalian);
});
</script>

</body>

</html>