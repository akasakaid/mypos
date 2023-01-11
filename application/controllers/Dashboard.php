<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function _verifikasi(){
        if ($this->session->userdata('is_login')){
            return true;
        } else {
            redirect(base_url('/auth/login'));
            exit;
        }
    }

    public function user(){
        $this->_verifikasi();
        if ($this->input->method()=='get'){
            $this->load->model('user_model','user');
            $data = $this->user->selectAll();
            $data = [
                'data' => $data
            ];
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/daftar_user',$data);
            $this->load->view('dashboard/footer');
        }
    }

    public function update_user(){
        $id_user = $this->uri->segment(3);
        $this->_verifikasi();
        if ($this->session->userdata('level') != 'admin'){
            redirect(base_url('dashboard/user'));
        }
        if ($this->input->method() == 'get'){
            $this->load->model('user_model','user');
            $data = $this->user->get_user_id($id_user);
            $data = [
                'user' => $data
            ];
            $this->load->view('dashboard/update_user',$data);
        } else if ($this->input->method() == 'post'){
            $this->load->model('user_model','user');
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'level' => $this->input->post('level'),
                'created_at' => date('d:m:Y')
            ];
            $this->user->update($data);
            $this->session->set_flashdata('success','User Berhasil di Update !');
            redirect(base_url('dashboard/user'));
        }
    }

    public function tambah_user(){
        $this->_verifikasi();
        if ($this->session->userdata('level') != 'admin'){
            redirect(base_url('dashboard/user'));
        }
        if ($this->input->method() == 'get'){
            $this->load->view('dashboard/tambah_user');
        } else if ($this->input->method() == 'post'){
            $this->load->model('user_model','user');
            $data = [
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
                'level' => $this->input->post('level'),
                'created_at' => date('d:m:Y')
            ];
            $this->user->insert($data);
            $this->session->set_flashdata('success','User Berhasil di Tambahkan !');
            redirect(base_url('dashboard/user'));
        }
    }

    public function hapus_user(){
        $id = $this->uri->segment(3);
        if ($id != null){
            $this->load->model('user_model','user');
            $this->user->delete($id);
            $this->session->set_flashdata('success','User Berhasil di Hapus !');
            redirect(base_url('dashboard/user'));
        }
    }

    public function create_notes(){
        $no_transaksi = 1;
        $width = 80;
        $height = 100;
        $garis = "==================================";
        $tanggal_ = date('d-m-Y');
        $jam_ = date('H:i:s');
        $kasir = $this->session->userdata('username');
        $res = $this->load->library('pdf');
        // $this->pdf->FPDF('P','mm','A4');
        $this->pdf->AddPage();
        $this->pdf->SetFont(family:'Times',size:12);
        $this->pdf->Cell(w: 0, h: 5, txt: 'Nama Toko', border: 0, ln: 1, align: 'C', fill: false, link: '');
        $this->pdf->SetFont(family:'Times',size:9);
        $this->pdf->Cell(w: 0, h: 5, txt: 'jl. Timoho 1, no 13. Tembalang', border: 0, ln: 1, align: 'C', fill: false, link: '');
        $this->pdf->Cell(w: 0, h: 5, txt:  $garis, border: 0, ln: 1, align: 'C', fill: false, link: '');
        $this->pdf->Cell(w: 15, h: 5, txt:  'Tanggal', border: 0, align: 'L', fill: false, link: '');
        $this->pdf->Cell(w: 10, h: 5, txt:  ':', border: 0, fill: false, link: '');
        $this->pdf->Cell(w: 0, h: 5, txt:  $tanggal_, border: 0, ln:1,align: 'L', fill: false, link: '');
        $this->pdf->Cell(w: 15, h: 5, txt:  'Jam', border: 0, align: 'L', fill: false, link: '');
        $this->pdf->Cell(w: 10, h: 5, txt:  ':', border: 0, fill: false, link: '');
        $this->pdf->Cell(w: 0, h: 5, txt:  $jam_, border: 0, ln:1,align: 'L', fill: false, link: '');
        $this->pdf->Cell(w: 15, h: 5, txt:  'Kasir', border: 0, align: 'L', fill: false, link: '');
        $this->pdf->Cell(w: 10, h: 5, txt:  ':', border: 0, fill: false, link: '');
        $this->pdf->Cell(w: 0, h: 5, txt:  $kasir, border: 0, ln:1,align: 'L', fill: false, link: '');

        // $this->pdf->Cell(w: 0, h: 5, txt:  'Jam          : ' . $jam_ , border: 0, ln: 1, align: 'L', fill: false, link: '');
        // $this->pdf->Cell(w: 0, h: 5, txt:  'Kasir        : ' . $kasir, border: 0, ln: 1, align: 'L', fill: false, link: '');
        $this->pdf->Cell(w: 0, h: 5, txt:  $garis, border: 0, ln: 1, align: 'C', fill: false, link: '');
        
        $this->pdf->Output();
    }

    public function profile(){
        $this->_verifikasi();
        $this->load->model('user_model','user');
        $data_user = $this->user->get_user($this->session->userdata('email'));
        if ($data_user == null){
            redirect(base_url('auth/logout'));
        }
        $data = [
            'user' => $data_user
        ];
        $this->load->view('dashboard/header');
        $this->load->view('dashboard/sidebar');
        $this->load->view('dashboard/profile',$data);
        $this->load->view('dashboard/footer');
    }

    public function update_profile(){
        $this->_verifikasi();
        $this->load->model('user_model','user');
        if ($this->input->method() == 'get'){
            redirect(base_url('dashboard/profile'));;
        } else if ($this->input->method() == 'post'){
            $id = $this->input->post('id');
            $username = $this->input->post('username');
            $fullname = $this->input->post('nama_lengkap');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $data = [
                'username' => $username,
                'fullname' => $fullname,
                'email' => $email
            ];
            if ($password != null){
                $data['password'] = password_hash($password,PASSWORD_DEFAULT);
            }
            $this->user->update($data);
            $this->session->set_flashdata('success','Data Profile Berhasil di Update');
            redirect(base_url('dashboard/profile'));
        }
    }

    public function update_password(){
        $this->_verifikasi();
        $this->load->model('user_model','user');
        if ($this->input->method() == 'get'){
            redirect(base_url('dashboard/profile'));
        } else if ($this->input->method() == 'post'){
            $email = $this->input->post('email');
            $oldpass = $this->input->post('password_lama');
            $newpass = $this->input->post('password_baru');
            $repass = $this->input->post('repeat_password');
            if ($newpass != $repass) {
                $this->session->set_flashdata('error','Password Baru dan Ulangi Password Baru Tidak Sama');
                redirect(base_url('dashboard/profile'));
            }
            if (password_verify($oldpass,$this->session->userdata('passsword'))){
                $this->session->set_flashdata('error','Password Lama Tidak Sama');
                redirect(base_url('dashboard/profile'));
            } else {
                $data = [
                    'email' => $email,
                    'password' => password_hash($newpass,PASSWORD_DEFAULT)
                ];
                $this->user->update($data);
                $this->session->set_flashdata('success','Password Berhasil di Update');
                redirect(base_url('dashboard/profile'));
            }
        }
    }

    public function index()
    {
        
        $data_total_perm = [];
        $array_month = ['01','02','03','04','05','06','07','08','09','10','11','12'];
        $this->_verifikasi();
        $this->load->model('transaksi_model','transaksi');
        $this->load->model('barang_model','barang');
        $keuntungan_harian = $this->transaksi->get_profit_day();
        $keuntungan_bulan = $this->transaksi->get_profit_month();
        $total_hari = $this->transaksi->get_total_day();
        $total_bulan = $this->transaksi->get_total_month();
        if ($keuntungan_harian->keuntungan == NULL){
            $keuntungan_harian->keuntungan = 0;
        }
        if ($keuntungan_bulan->keuntungan == NULL){
            $keuntungan_bulan->keuntungan = 0;
        }
        if ($total_hari->total == NULL){
            $total_hari->total = 0;
        }
        if ($total_bulan->total == NULL){
            $total_bulan->total = 0;
        }
        $five_latest = $this->transaksi->select(limit:5);
        $stok_barang = $this->barang->select(limit:5,urutan:"DESC",stok:5);
        foreach ($array_month as $month ) {
            $x = $this->transaksi->get_total_select_month($month)->total;
            if ($x != null){
                array_push($data_total_perm,(int)$x);

            }
        }
        $data = [
            'keuntungan_hari' => $keuntungan_harian,
            'keuntungan_bulan' => $keuntungan_bulan,
            'total_hari' => $total_hari,
            'total_bulan' => $total_bulan,
            'latest' => $five_latest,
            'barang' => $stok_barang,
            'total_perm' => $data_total_perm
        ];
        // echo json_encode($data);
        // return;
        $this->load->view('dashboard/header.php');
        $this->load->view('dashboard/sidebar.php');
        $this->load->view('dashboard/dashboard',$data);
        $this->load->view('dashboard/footer.php');
    }

    public function barang()
    {
        $this->_verifikasi();
        $this->load->model('barang_model','barang');
        $data = ['data' => $this->barang->select()];
        $this->load->view('dashboard/header.php');
        $this->load->view('dashboard/sidebar.php');
        $this->load->view('dashboard/barang',$data);
        $this->load->view('dashboard/footer.php');
    }

    public function update_barang()
    {
        $this->_verifikasi();
        if ($this->input->method() == 'get') {
            $id = $this->uri->segment(3);
            $this->load->model('barang_model','barang');
            $data = ['data' => $this->barang->select_by_id($id)];
            $this->load->view('dashboard/update_barang',$data);
        } elseif ($this->input->method() == 'post' && $this->input->post('simpan')) {
            $id = $this->input->post('no');
            $kode_barang = $this->input->post('kode_barang');
            $nama_barang = $this->input->post('nama_barang');
            $harga_beli = $this->input->post('harga_beli');
            $harga_jual = $this->input->post('harga_jual');
            $total = $this->input->post('stok');
            $keterangan = $this->input->post('keterangan');
            $data = [
                'kode_barang' => $kode_barang,
                'nama_barang' => $nama_barang,
                'harga_beli' => $harga_beli,
                'harga_jual' => $harga_jual,
                'stok' => $total,
                'keterangan' => $keterangan,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->load->model('barang_model','barang');
            $status = $this->barang->update($id,$data);
            if ($status){
                $this->session->set_flashdata('success','Barang berhasil diupdate');
                redirect(base_url('dashboard/barang'));
            } else {
                $this->session->set_flashdata('error','Kode Barang atau Nama Barang mungkin sudah ada');
                $this->session->set_flashdata('data',$data);
                redirect(base_url('dashboard/update_barang/'.$id));
            }
        } else {
            redirect(base_url('dashboard/barang'));
        }
    }



    public function tambah_barang(){
        $this->_verifikasi();
        if ($this->input->method() == 'get') {
            $this->load->view('dashboard/tambah_barang');
        } else {
            if ($this->input->post('simpan')) {
                $kode_barang = $this->input->post('kode_barang');
                $nama_barang = $this->input->post('nama_barang');
                $harga_beli = $this->input->post('harga_beli');
                $harga_jual = $this->input->post('harga_jual');
                $total = $this->input->post('stok');
                $keterangan = $this->input->post('keterangan');
                $data = [
                    'kode_barang' => $kode_barang,
                    'nama_barang' => $nama_barang,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'stok' => $total,
                    'keterangan' => $keterangan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->load->model('barang_model','barang');
                $status = $this->barang->insert($data);
                if ($status) {
                    $this->session->set_flashdata('success','Barang berhasil ditambahkan');
                    redirect(base_url('dashboard/barang'));
                } else {
                    $this->session->set_flashdata('error','Kode Barang atau Nama Barang mungkin sudah ada');
                    $this->session->set_flashdata('data',$data);
                    redirect(base_url('dashboard/tambah_barang'));
                }
            } else {
                redirect(base_url('dashboard/tambah_barang'));
            }
        }
    }

    public function transaksi(){
        $this->_verifikasi();
        $this->load->model('barang_model','barang');
        $this->load->model('transaksi_model','transaksi');
        if ($this->input->method() == 'get'){
            $data = [
                'data' => $this->barang->select(),
            ];
            $this->load->view('dashboard/transaksi',$data);
        } elseif ($this->input->method() == 'post') {
            $id_transaksi = $this->input->post('id_transaksi');
            $uang_client = $this->input->post('uang_pembeli');
            $kembalian = $this->input->post('kembalian');
            $data = [
                'id_transaksi' => $id_transaksi,
                'uang_pembeli' => $uang_client,
                'kembalian' => $kembalian,
                'complete' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            $this->transaksi->insert_pembayaran($data);
            $this->session->set_flashdata('success','Transaksi berhasil');
            redirect(base_url('dashboard/daftar_transaksi'));
        }
    }

    public function delete_barang(){
        $this->_verifikasi();
        $id = $this->uri->segment(3);
        $this->load->model('barang_model','barang');
        $this->barang->delete($id);
        $this->session->set_flashdata('success','Barang berhasil dihapus');
        redirect(base_url('dashboard/barang'));
    }

    public function cancel_pembayaran(){
        $id = $this->uri->segment(3);
        $this->load->model('transaksi_model','transaksi');
        $this->load->model('barang_model','barang');
        $daftar_barang = $this->transaksi->get_barang_transaksi($id);
        foreach ($daftar_barang as $barang){
            $hasil = $this->barang->get_stok($barang->kode_barang);
            // echo json_encode($hasil);
            // echo "<br>";
            // echo json_encode($barang->jumlah);
            $hasil = $hasil->stok + $barang->jumlah;
            $this->barang->update_stok($barang->kode_barang,$hasil);
        }
        $this->transaksi->delete_transaksi($id);
        $this->transaksi->delete_barang_transaksi($id);
        $this->session->set_flashdata('success','Transaksi berhasil dibatalkan');
        redirect(base_url('dashboard/daftar_transaksi'));
    }

    public function pembayaran(){
        $this->_verifikasi();
        $this->load->model('barang_model','barang');
        $this->load->model('transaksi_model','transaksi');
        if ($this->input->method() == 'get'){
            $id = $this->uri->segment(3);
            $data = $this->transaksi->get_total($id);
            if ($data == null){
                $this->session->set_flashdata('error','Transaksi tidak ditemukan');
                redirect(base_url('dashboard/daftar_transaksi'));
            }
            // $cek = $thi
            $data = [
                'id' => $id,
                'data' => $data,
            ];
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/pembayaran',$data);

        } elseif ($this->input->method() == 'post'){
            $this->db->trans_start();
            $id = $this->transaksi->create_transaksi();
            $barang = $this->input->post('barang');
            $nama_barang = $this->input->post('nama_barang');
            $harga_jual = $this->input->post('harga');
            $jumlah = $this->input->post('jumlah');
            $subtotal = $this->input->post('subtotal');
            $total_harga_jual = 0;
            $total_harga_beli = 0;
            foreach ($barang as $key => $kode_barang) {
                if ($jumlah[$key] <= 0) {
                    echo "<script>alert('Jumlah minimal 1');window.location = '';</script>";
                    return;
                }
                $harga = $this->transaksi->get_harga($kode_barang);
                $subtotal = $harga->harga_jual * (int)$jumlah[$key];
                $total_harga_jual += $subtotal;
                $total_harga_beli += $harga->harga_beli * (int)$jumlah[$key];
                $data = [
                    'id_transaksi' => $id,
                    'kode_barang' => $kode_barang,
                    'jumlah' => $jumlah[$key],
                    'subtotal' => $subtotal,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->barang->subtract_stok($kode_barang, $jumlah[$key]);
                $this->transaksi->insert_barang($data);
            }
            $keuntungan = $total_harga_jual - $total_harga_beli;
            $this->transaksi->update_total_dan_keuntungan($id, $total_harga_jual, $keuntungan);
            $this->db->trans_complete();
            redirect(base_url('dashboard/pembayaran/'.$id));
        }
    }

    public function daftar_transaksi(){
        $this->_verifikasi();
        if ($this->input->method() == 'get'){
            // $this->load->model('barang_model','barang');
            $this->load->model('transaksi_model','transaksi');
            $data = ['data' => $this->transaksi->select()];
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/sidebar');
            $this->load->view('dashboard/daftar_transaksi',$data);
        }
    }

    public function detail_transaksi($id){
        $this->_verifikasi();
        if ($this->input->method() == 'get'){
            $id = $this->uri->segment(3);
            $this->load->model('transaksi_model','transaksi');
            $data = ['data' => $this->transaksi->get_barang_transaksi($id)];
            $this->load->view('dashboard/header');
            $this->load->view('dashboard/detail_transaksi',$data);
        }
    }
}