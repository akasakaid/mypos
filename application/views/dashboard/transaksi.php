<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
$no_ = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Admin</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="<?= base_url('/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('/css/sb-admin-2.min.css')?>" rel="stylesheet">
    <link href="<?= base_url('/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="<?= base_url('/dashboard')?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/dashboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/dashboard/barang')?>" data-target="#collapseTwo"
                    aria-expanded="true">
                    <!-- <i class="fas fa-fw fa-cog"></i> -->
                    <!-- icon bootstrap untuk barang -->
                    <i class="fas fa-fw fa-box"></i>
                    <span>Barang</span>
                </a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Kasir</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Kasir</h6>
                        <a class="collapse-item" href="<?= base_url('/dashboard/transaksi') ?>">Buat Transaksi</a>
                        <a class="collapse-item" href="<?= base_url('/dashboard/daftar_transaksi') ?>">Daftar
                            Transaksi</a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('username')?></span>
                                <img class="img-profile rounded-circle" src="<?= base_url('img/undraw_profile.svg') ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('/auth/logout') ?>" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <div class="container-fluid">
                    <form action="" method="post">
                        <h6>Pilih Produk : </h6>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="list-item">
                                    <tr>
                                        <td>
                                            <select class="form-select" name="barang" id="barang-<?= $no_ ?>">
                                                <?php
                                                    foreach ($data as $d ) {
                                                        ?>
                                                <option value="<?= $d->kode_barang ?>"
                                                    nama_barang="<?= $d->nama_barang ?>" harga="<?= $d->harga_jual ?>"
                                                    stok="<?= $d->total ?>">
                                                    <?= $d->kode_barang ?>
                                                    | <?= $d->nama_barang?>
                                                </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" name="nama_barang[]"
                                                id="nama_barang-<?= $no_ ?>"></td>
                                        <td><input type="number" class="form-control" id="stok-<?= $no_ ?>" readonly>
                                        </td>
                                        <td><input class="form-control" type="text" name="harga[]"
                                                id="harga-<?= $no_ ?>"></td>
                                        <td><input class="form-control" type="text" name="jumlah[]"
                                                id="jumlah-<?= $no_ ?>"></td>
                                        <td><input class="form-control" type="text" name="subtotal[]"
                                                id="subtotal-<?= $no_ ?>">
                                        </td>
                                        <td><button class="btn btn-primary mt-3" id="add">Tambah</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
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
                    <a class="btn btn-primary" href="<?= base_url('/auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $('#barang-<?= $no_ ?>').select2();

    $("#barang-<?= $no_ ?>").on("change", function() {

        var nama = $("#barang-<?= $no_ ?> option:selected").attr("nama_barang");
        var harga = $("#barang-<?= $no_ ?> option:selected").attr("harga_jual");
        var stok = $("#barang-<?= $no_ ?> option:selected").attr("stok");
        var harga = $("#barang-<?= $no_ ?> option:selected").attr("harga");
        // var grosir = $("#barang option:selected").attr("grosir");
        // var min = $("#barang option:selected").attr("min");

        $("#nama_barang-<?= $no_ ?>").val(nama);
        $("#hargal-<?= $no_ ?>").val(harga);
        $("#stok-<?= $no_ ?>").val(stok);
        $("#harga-<?= $no_ ?>").val(harga);
        $("#subtotal-<?= $no_ ?>").val(0);
    });
    // function javascript
    $(document).ready(function() {
        $('#add').click(function(e) {
            e.preventDefault();
            <?php $no_++; ?>
            $('#list-item').append(`                                    <tr>
                                        <td>
                                            <select class="form-select" name="barang" id="barang-<?= $no_ ?>">
                                                <?php
                                                    foreach ($data as $d ) {
                                                        ?>
                                                <option value="<?= $d->kode_barang ?>"
                                                    nama_barang="<?= $d->nama_barang ?>" harga="<?= $d->harga_jual ?>"
                                                    stok="<?= $d->total ?>">
                                                    <?= $d->kode_barang ?>
                                                    | <?= $d->nama_barang?>
                                                </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" name="nama_barang[]"
                                                id="nama_barang-<?= $no_ ?>"></td>
                                        <td><input type="number" class="form-control" id="stok-<?= $no_ ?>" readonly>
                                        </td>
                                        <td><input class="form-control" type="text" name="harga[]"
                                                id="harga-<?= $no_ ?>"></td>
                                        <td><input class="form-control" type="text" name="jumlah[]"
                                                id="jumlah-<?= $no_ ?>"></td>
                                        <td><input class="form-control" type="text" name="subtotal[]"
                                                id="subtotal-<?= $no_ ?>">
                                        </td>
                                        <td><button class="btn btn-danger mt-3" id="btn-hapus">Hapus</button></td>
                                    </tr>`);
        });
        $(document).on('click', '#btn-hapus', function(e) {
            e.preventDefault();
            <?php $no_-- ?>
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });
    });
    </script>
</body>

</html>