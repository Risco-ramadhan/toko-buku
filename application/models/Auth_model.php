<?php
class Auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function Register($data)
    {
        $this->db->insert('user', $data);
    }

    public function cekUser($email)
    {
        $query = $this->db->get_where('user', array('email' => $email))->row_array();
        return $query;
    }

    public function getDatauser()
    {
        return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function allUser()
    {

        // $this->db->select('*');
        // $this->db->from('user');
        // $this->db->join('user_role', 'user.role_id = user_role.id');
        // $query = $this->db->get('user');

        $this->db->select('*,user.id');
        $this->db->from('user');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function deleteuser($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
    public function getRole()
    {
        $query = $this->db->get('user_role');
        return $query->result();
    }
    public function editAdmin($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
}
