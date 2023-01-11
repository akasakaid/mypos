<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?= base_url("assets/icon.ico") ?>" type="image/ico">
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
    <script>
    var no = 1;
    var total_pembelian = 0;
    var list_pembelian = [];
    </script>
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
                <div class="sidebar-brand-text mx-3">MyPOS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/dashboard')?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/dashboard/barang')?>" data-target="#collapseTwo"
                    aria-expanded="true">
                    <i class="fas fa-fw fa-cog"></i>
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

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('/dashboard/user')?>" data-target="#collapseTwo"
                    aria-expanded="true">
                    <i class="fas fa-user"></i>
                    <span>User</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
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
                                <a class="dropdown-item" href="<?= base_url('dashboard/profile') ?>">
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
                    <div class="card shadow">
                        <div class="card-title ml-3 mt-3">
                            <h5 class="text-black">Pilih Produk : </h5>
                        </div>
                        <div class="card-body">
                            <form id="form-tambah" action="<?= base_url('/dashboard/pembayaran') ?>" method="POST">
                                <button type="submit" class="btn btn-primary float-right mb-3">Submit</button>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="30%">Kode Barang</th>
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
                                                    <select class="form-select" name="barang[]" id="barang-0">
                                                    </select>
                                                </td>
                                                <td><input class="form-control" type="text" name="nama_barang[]"
                                                        id="nama_barang-0" required readonly></td>
                                                <td><input type="number" class="form-control" id="stok-0" readonly></td>
                                                <td><input class="form-control" type="text" name="harga[]" id="harga-0"
                                                        required readonly></td>
                                                <td><input class="form-control" type="text" name="jumlah[]"
                                                        id="jumlah-0" required></td>
                                                <td><input class="form-control" type="text" name="subtotal[]"
                                                        id="subtotal-0" required readonly></td>
                                                <td><button class="btn btn-primary mt-3" id="add">Tambah</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
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
    let selected_barang = {};
    const data_barang = <?= json_encode($data); ?>

    function fill_barang(no) {
        let x;
        let html_str = "<option></option>";
        let dom_barang = $("#barang-" + no + " option:selected");
        var kode_barang = dom_barang.attr("kode_barang");

        for (x in data_barang) {
            let y = data_barang[x];
            let selected_attribute = "";
            if (y.stok <= 0) {
                continue;
            }
            if (y.kode_barang == kode_barang) {
                selected_attribute = " selected";
            } else if (y.kode_barang in selected_barang) {
                continue;
            }

            html_str += `<option value = "${y.kode_barang}"
                nama_barang = "${y.nama_barang}"
                harga = "${y.harga_jual}"
                stok = "${y.stok}" 
                kode_barang = "${y.kode_barang}"${selected_attribute}> ${y.kode_barang} | ${y.nama_barang} </option>`;
        }
        $("#barang-" + no).html(html_str);
    }

    function install_listener(no) {
        // console.log("install listener no = " + no);
        fill_barang(no);
        $('#barang-' + no).select2();

        // jquery event on change with selector name is jumlah
        $("#jumlah-" + no).on("change", function() {
            var stok = parseInt($("#stok-" + no).val());
            var jumlah = parseInt($("#jumlah-" + no).val());
            var harga = parseInt($("#harga-" + no).val());
            if (jumlah > stok) {
                alert("Stok tidak mencukupi");
                $("#jumlah-" + no).val(0);
                $("#subtotal-" + no).val(0);
            } else if (jumlah <= 0) {
                alert("Jumlah minimal 1");
            } else {
                var subtotal = jumlah * harga;
                $("#subtotal-" + no).val(subtotal);
            }
        });

        $("#barang-" + no).on("change", function() {
            let dom_barang = $("#barang-" + no + " option:selected");
            var nama = dom_barang.attr("nama_barang");
            var harga = dom_barang.attr("harga_jual");
            var stok = dom_barang.attr("stok");
            var harga = dom_barang.attr("harga");
            var kode_barang = dom_barang.attr("kode_barang");
            // var grosir = dom_barang.attr("grosir");
            // var min = dom_barang.attr("min");

            selected_barang[kode_barang] = 1;
            $("#nama_barang-" + no).val(nama);
            $("#harga-" + no).val(harga);
            $("#stok-" + no).val(stok);
            $("#harga-" + no).val(harga);
            $("#subtotal-" + no).val(0);
            refresh_barang();
        });
    }
    install_listener(0);

    function refresh_barang() {
        let i;
        for (i = 0; i < no; i++) {
            fill_barang(i);
        }
    }

    $(document).ready(function() {
        $('#add').click(function(e) {
            e.preventDefault();
            $('#list-item').append(`<tr>
                                        <td>
                                            <select class="form-select" name="barang[]" id="barang-${no}">
                                            </select>
                                        </td>
                                        <td><input class="form-control" type="text" name="nama_barang[]"
                                                id="nama_barang-${no}" required readonly></td>
                                        <td><input type="number" class="form-control" id="stok-${no}" readonly></td>
                                        <td><input class="form-control" type="text" name="harga[]" id="harga-${no}"
                                                required readonly></td>
                                        <td><input class="form-control" type="text" name="jumlah[]" id="jumlah-${no}"
                                                required></td>
                                        <td><input class="form-control" type="text" name="subtotal[]"
                                                id="subtotal-${no}" required readonly></td>
                                        <td><button class="btn btn-danger mt-3" id="btn-hapus-${no}">Hapus</button></td>
                                    </tr>`);

            install_listener(no);
            $("#btn-hapus-" + no).click(function(e) {
                console.log("button hapus no = " + no + "di klik");
                refresh_barang();
                // console.log("test");
                let dom_barang = $("#barang-" + no + " option:selected");
                var kode_barang = dom_barang.attr("kode_barang");
                delete selected_barang[kode_barang];
                no--;
                e.preventDefault();
                let row_item = $(this).parent().parent();
                $(row_item).remove();
            });
            no++;
        });

        // $(document).on('click', '#btn-hapus', function(e) {
        //     e.preventDefault();
        //     let row_item = $(this).parent().parent();
        //     $(row_item).remove();
        // });
    });
    // function javascript
    </script>
</body>

</html>