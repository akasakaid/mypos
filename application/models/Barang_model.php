<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Barang_model extends CI_Model 
{
    public function select()
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->order_by('no','ASC');
        return $this->db->get()->result();
    }

    public function update($id,$data)
    {
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->where('kode_barang',$data['kode_barang']);
        $this->db->where('no',$id);
        $this->db->update('barang',$data);
        return true;
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