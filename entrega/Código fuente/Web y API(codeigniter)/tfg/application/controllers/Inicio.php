<?php

class Inicio extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('model_riego');
    }

    public function index()
    {
        $data['titulo'] = 'Estatidisticas';

        $this->load->view('plantilla/header.php', $data);
        $this->load->view('inicio/Index.php');
        $this->load->view('plantilla/footer.php');
    }

    public function Prog(){
    	$data['titulo'] = 'Agregar Prog';
        
        $this->load->view('plantilla/header.php', $data);
        $this->load->view('inicio/AgregarProg.php');
        $this->load->view('plantilla/footer.php');
    }

    public function agregarProg(){//modificar
        $id = $this->input->post('nID');
        $query = array('Hora_ini' => $this->input->post('nInicio'),'Hora_fin' => $this->input->post('nFin'));

        $this->model_riego->programa($id,$query);

        redirect( base_url() . 'inicio/Prog');
    }

    public function Conf(){
        $data['titulo'] = 'Agregar Config';
        
        $this->load->view('plantilla/header.php', $data);
        $this->load->view('inicio/AgregarConf.php');
        $this->load->view('plantilla/footer.php');
    }

    public function agregarConf(){
        /*$this-> form_validation ->set_rules('nID','Id','required');
        $this-> form_validation ->set_rules('nZona','Zona','required');
        if($this-> form_validation -> run() == FALSE){
            $data['titulo'] = 'Agregar Config';
        
            $this->load->view('plantilla/header.php', $data);
            $this->load->view('inicio/AgregarConf.php');
            $this->load->view('plantilla/footer.php');
        }else{*/
            $id = $this->input->post('nID');
            $query = array('Zona' => $this->input->post('nZona'));

            $this->model_riego->configura($id,$query);

            redirect( base_url() . 'inicio/Conf');
            /*$data['titulo'] = 'Agregar Config';
        
            $this->load->view('plantilla/header.php', $data);
            $this->load->view('inicio/AgregarConf.php');
            $this->load->view('plantilla/footer.php');*/
        //}

        /*$id = $this->input->post('id');
        $data = $this->input->post('zona');
        echo $id;
        echo $zona;*/
    }
}
?>