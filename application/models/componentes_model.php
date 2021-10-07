<?php
class Componentes_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_componentes($cve_componente = 0)
    {
        if ($cve_componente === 0)
        {
            $this->db->order_by('clave');
            $query = $this->db->get('componentes');
            return $query->result_array();
        }

        $this->db->select('d.clave, d.cve_dimension, d.nombre_corto, d.nombre_largo');
        $this->db->from('componentes d');
        $this->db->where('d.clave', $cve_componente);
        $this->db->order_by('d.nombre', 'asc');
        //$query = $this->db->get_where('componentes', array('clave' => $cve_componente));
        $query = $this->db->get();
        return $query->row_array();
    }

}
