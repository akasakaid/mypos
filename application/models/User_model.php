<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
                        
class User_model extends CI_Model 
{
    public function select($email){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->limit(1);
        return $this->db->get()->result();
    }

    public function get_user($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        return $this->db->get()->row();
    }

    public function get_user_id($id){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id',$id);
        return $this->db->get()->row();
    }

    public function update($data){
        $this->db->select('email');
        $this->db->where('email',$data['email']);
        $res = $this->db->get('users')->result();
        if (count($res) > 0) {
            $this->db->where('email',$data['email']);
            $this->db->update('users',$data);

        } else {
            return null;
        }
    }

    public function selectAll(){
        $this->db->select('*');
        $this->db->from('users');
        return $this->db->get()->result();
    }

    public function insert($data){
        $this->db->insert('users',$data);
    }

    public function delete($id){
        $this->db->delete('users',['id' => $id]);
    }

                        
}