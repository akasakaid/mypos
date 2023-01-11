<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Barang_model extends CI_Model 
{
    public function select($limit=null,$urutan="ASC",$stok=null)
    {
        if ($limit == null && $stok == null){
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->order_by('no','ASC');
        } else if ($limit != null && $stok != null) {
            $this->db->select('*');
            $this->db->from('barang');
            $this->db->where('stok <',$stok);
            $this->db->order_by('created_at',$urutan);
            $this->db->limit($limit);
        }
        return $this->db->get()->result();
    }

    public function subtract_stok($kode_barang,$jumlah)
    {
        $this->db->where('kode_barang',$kode_barang);
        $this->db->set('stok', 'stok-'.$jumlah, false);
        $this->db->update('barang');
    }

    public function update($id,$data)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('kode_barang',$data['kode_barang']);
        $this->db->where('no',$id);
        $res = $this->db->update('barang',$data);
        return $res;
        // $cek = $this->db->get()->num_rows();
        // print_r($cek);
        // if ($cek > 0) {
        //     return false;
        // } else {
        //     $this->db->where('no',$id);
        //     $this->db->update('barang',$data);
        //     return true;
        // }
    }

    public function delete($id)
    {
        $this->db->where('no',$id);
        $this->db->delete('barang');
    }

    public function get_stok($kode_barang){
        $this->db->select('stok');
        $this->db->from('barang');
        $this->db->where('kode_barang',$kode_barang);
        return $this->db->get()->row();
    }

    public function update_stok($kode_barang,$stok){
        $this->db->where('kode_barang',$kode_barang);
        $this->db->update('barang',[
            'stok' => $stok
        ]);
    }

    // create method function name select_by_id
    public function select_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('no',$id);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('kode_barang',$data['kode_barang']);
        $this->db->or_where('nama_barang',$data['nama_barang']);
        $cek = $this->db->get()->num_rows();
        if ($cek > 0) {
            return false;
        } else {
            $this->db->insert('barang',$data);
            return true;
        }
    }
}