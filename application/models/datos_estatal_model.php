<?php
class Datos_estatal_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_datos_estatal($cve_indicador = 0)
    {
        if ($cve_indicador === 0)
        {
            $this->db->order_by('cve_indicador');
            $query = $this->db->get('datos_estatal');
            return $query->result_array();
        }

        $this->db->select('*');
        $this->db->from('datos_estatal');
        $this->db->where('cve_indicador', $cve_indicador);
        $estados = array('00','11');
        $this->db->where_in('cve_estado', $estados);
        $query = $this->db->get();
        return $query->result_array();
    }

}
