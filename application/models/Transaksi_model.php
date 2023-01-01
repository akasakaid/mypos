<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Transaksi_model extends CI_Model 
{
    public function select()
    {
        $this->db->select('*');
        $this->db->from('transaksi');
        return $this->db->get()->result();

    }


    public function select_last_id(){
        $this->db->select('id');
        $this->db->order_by('id','DESC');
        $this->db->limit(1);
        return $this->db->get('transaksi')->row();
    }

    public function insert_barang($data){
        $this->db->insert('barang_transaksi',$data);
    }

    public function get_barang_transaksi($id){
        $this->db->where('id_transaksi',$id);
        $this->db->select('*');
        $this->db->join('barang','barang_transaksi.kode_barang = barang.kode_barang');
        $this->db->from('barang_transaksi');
        return $this->db->get()->result();
    }

    public function update_total_dan_keuntungan($id,$total,$keuntungan){
        $this->db->where('id',$id);
        $this->db->update('transaksi',[
            'total' => $total,
            'keuntungan' => $keuntungan
        ]);
    }

    public function get_harga($kode_barang){
        $this->db->select('harga_beli');
        $this->db->select('harga_jual');
        $this->db->where('kode_barang',$kode_barang);
        return $this->db->get('barang')->row();
    }

    public function create_transaksi()
    {
        $this->db->insert('transaksi',[
            'total' => 0,
            'keuntungan' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $this->db->insert_id();
    }
}


/* End of file Transaksi_model.php and path \application\models\Transaksi_model.php */