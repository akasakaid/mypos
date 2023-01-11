<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Transaksi_model extends CI_Model 
{
    public function select($limit=null)
    {
        if ($limit == null){
        $this->db->select('*');
        $this->db->from('transaksi');
        return $this->db->get()->result();
        }
        else {
            $this->db->select("*");
            $this->db->limit($limit);
            $this->db->order_by("created_at","DESC");
            return $this->db->get('transaksi')->result();
        }

    }

    public function insert_pembayaran($data){
        $this->db->insert('pembayaran',$data);
    }

    public function cek_pembayaran($id){
        $this->db->select('complete');
        $this->db->from('pembayaran');
        return $this->db->get()->row();
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

    public function delete_transaksi($id){
        $this->db->where('id',$id);
        $this->db->delete('transaksi');
    }

    public function delete_barang_transaksi($id){
        $this->db->where('id_transaksi',$id);
        $this->db->delete('barang_transaksi');
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

    public function get_total($id){
        $this->db->select('total');
        $this->db->where('id',$id);
        return $this->db->get('transaksi')->row();
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

    public function get_profit_day(){
        $this->db->select_sum('keuntungan');
        $this->db->where('DATE(created_at)',date('Y-m-d'));
        return $this->db->get('transaksi')->row();
    }

    public function get_profit_month(){
        $this->db->select_sum('keuntungan');
        $this->db->where('MONTH(created_at)',date('m'));
        return $this->db->get('transaksi')->row();
    }

    public function get_total_day(){
        $this->db->select_sum('total');
        $this->db->where('DATE(created_at)',date('Y-m-d'));
        return $this->db->get('transaksi')->row();
    }

    public function get_total_month(){
        $this->db->select_sum('total');
        $this->db->where('MONTH(created_at)',date('m'));
        return $this->db->get('transaksi')->row();
    }

    public function get_profit_year(){
        $this->db->select_sum('keuntungan');
        $this->db->where('YEAR(created_at)',date('Y'));
        return $this->db->get('transaksi')->row();
    }

    public function get_total_select_month($month){
        $this->db->select_sum('total');
        $this->db->where('MONTH(created_at)',$month);
        return $this->db->get('transaksi')->row();
    }
}


/* End of file Transaksi_model.php and path \application\models\Transaksi_model.php */