<?php
class Dimensiones_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_dimensiones($cve_dimension = 0)
    {
        if ($cve_dimension === 0)
        {
            $this->db->order_by('clave');
            $query = $this->db->get('dimensiones');
            return $query->result_array();
        }

        $this->db->select('d.clave, d.nombre, d.proposito, d.paleta');
        $this->db->from('dimensiones d');
        $this->db->where('d.clave', $cve_dimension);
        $this->db->order_by('d.nombre', 'asc');
        //$query = $this->db->get_where('dimensiones', array('clave' => $cve_dimension));
        $query = $this->db->get();
        return $query->row_array();
    }

}
