<?php
class Indicadores_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function get_indicadores($cve_indicador = 0)
    {
        if ($cve_indicador === 0)
        {
            $this->db->select('i.clave, i.nombre_corto, i.nombre_largo, i.descripcion_estatal, i.descripcion_municipal, c.clave as cve_componente, c.nombre_corto as componente_corto, c.nombre_largo as componente_largo, d.nombre as dimension, d.clave as cve_dimension, d.proposito, i.interpretacion_estatal, i.interpretacion_municipal, i.titulo_estatal_mapa, i.titulo_municipal_mapa, i.titulo_estatal_grafico, i.titulo_municipal_grafico, i.titulo_serie_estatal, i.titulo_serie_municipal, i.unidad_estatal, i.unidad_municipal, i.fuente_estatal, i.fuente_municipal, i.col_datos, i.rango_estatal, i.rango_municipal, d.paleta, i.comportamiento, i.estatus, ');
            $this->db->from('indicadores i');
            $this->db->join('componentes c', 'i.componente = c.clave', 'left');
            $this->db->join('dimensiones d', 'c.cve_dimension = d.clave', 'left');
            $this->db->order_by('i.clave', 'asc');
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->db->select('i.clave, i.nombre_corto, i.nombre_largo, i.descripcion_estatal, i.descripcion_municipal, c.clave as cve_componente, c.nombre_corto as componente_corto, c.nombre_largo as componente_largo, d.nombre as dimension, d.clave as cve_dimension, d.proposito, i.interpretacion_estatal, i.interpretacion_municipal, i.titulo_estatal_mapa, i.titulo_municipal_mapa, i.titulo_estatal_grafico, i.titulo_municipal_grafico, i.titulo_serie_estatal, i.titulo_serie_municipal, i.unidad_estatal, i.unidad_municipal, i.fuente_estatal, i.fuente_municipal, i.col_datos, i.rango_estatal, i.rango_municipal, d.paleta, i.comportamiento, i.estatus, ');
        $this->db->from('indicadores i');
        $this->db->join('componentes c', 'i.componente = c.clave', 'left');
        $this->db->join('dimensiones d', 'c.cve_dimension = d.clave', 'left');
        $this->db->where('i.clave', $cve_indicador);
        $this->db->order_by('i.clave', 'asc');
        //$query = $this->db->get_where('indicadores', array('clave' => $cve_indicador));
        $query = $this->db->get();
        return $query->row_array();
    }

}
