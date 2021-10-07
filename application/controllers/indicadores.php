<?php
class Indicadores extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('indicadores_model');
        $this->load->model('dimensiones_model');
        $this->load->model('componentes_model');
        $this->load->model('datos_estatal_model');
    }

    public function index()
    {
        $data['dimensiones'] = $this->dimensiones_model->get_dimensiones();
        $data['componentes'] = $this->componentes_model->get_componentes();
        $data['indicadores'] = $this->indicadores_model->get_indicadores();
        $data['title'] = 'Indicadores de Desarrollo del estado de Guanajuato y sus Municipios';

        //print_r($data['componentes']);

        $this->load->view('templates/header', $data);
        $this->load->view('indicadores/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($cve_indicador)
    {
        $data['indicadores'] = $this->indicadores_model->get_indicadores($cve_indicador);
        $data['datos_estatal'] = $this->datos_estatal_model->get_datos_estatal($cve_indicador);

        //print_r($data['datos_estatal']);
        //print_r($data);

        if (empty($data['indicadores']))
        {
            echo 'empty';
        }

        $data['title'] = $data['indicadores']['nombre_largo'];
        $this->load->view('templates/header', $data);
        $this->load->view('indicadores/view', $data);
        $this->load->view('templates/footer');
    }

}
