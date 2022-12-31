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

    public function index()
    {
        $this->_verifikasi();
        $this->load->view('dashboard/dashboard');
    }

    public function barang()
    {
        $this->_verifikasi();
        $this->load->model('barang_model','barang');
        $data = ['data' => $this->barang->select()];
        $this->load->view('dashboard/barang',$data);
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
            $total = $this->input->post('total');
            $keterangan = $this->input->post('keterangan');
            $data = [
                'kode_barang' => $kode_barang,
                'nama_barang' => $nama_barang,
                'harga_beli' => $harga_beli,
                'harga_jual' => $harga_jual,
                'total' => $total,
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
                $total = $this->input->post('total');
                $keterangan = $this->input->post('keterangan');
                $data = [
                    'kode_barang' => $kode_barang,
                    'nama_barang' => $nama_barang,
                    'harga_beli' => $harga_beli,
                    'harga_jual' => $harga_jual,
                    'total' => $total,
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
        if ($this->input->method() == 'get'){
            $this->load->model('barang_model','barang');
            $data = ['data' => $this->barang->select()];
            $this->load->view('dashboard/transaksi',$data);
        }
    }
}