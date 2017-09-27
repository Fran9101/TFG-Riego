<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socios extends CI_Controller {

	public $showgrid;

	public function __construct()
    {
        parent::__construct();
        
        $this->load->model('socios_model');
        $this->load->model('actividades_model');
        $this->load->model('socioclase_model');

        // Chequeo si el usuario está logueado y si tiene permiso para ver esta página
	    $this->ion_auth->check_permissions();
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		header('Access-Control-Allow-Origin: *');

		$data_header['css_files'] = array(
			'js/plugins/data-tables/css/jquery.dataTables.min'
		);

		$data_body = array(
			'socios' => $this->socios_model->get_all(),
			'grid' => $this->showgrid
		);

		$data_footer['js_files'] = array(
			'plugins/data-tables/js/jquery.dataTables.min',
			'pages/socios_listado',
			'swfobject',
			'scriptcam.min'
		);

		$this->load->view('commons/header',$data_header);
		$this->load->view('socios/listado',$data_body);
		$this->load->view('commons/footer',$data_footer);
	}

	public function grid() 
	{
		$this->showgrid = true;
		$this->index();
	}

	public function upload_photo() {
		echo $this->socios_model->update_foto();
	}

	public function transformar_fotos() {
		$this->socios_model->transformar_foto();
	}

	public function nuevo()
	{

		$data_header['css_files'] = array(

		);

		$data_body = array(
			'nacionalidades' => $this->socios_model->get_all_nacionalidades(),
			'colegios' => $this->socios_model->get_all_colegios()
		);

		$data_footer['js_files'] = array(
			'pages/socios_nuevo'
		);

		if($this->input->post('nuevo')) {
			// Validación
			$this->form_validation->set_rules('dni', 'DNI', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('direccion', 'Dirección postal', 'required');
            $this->form_validation->set_rules('fechanac', 'Fecha de nacimiento', 'required');
            $this->form_validation->set_rules('tlf1', 'Teléfono', '');
            $this->form_validation->set_rules('tlf2', 'Teléfono de urgencia', '');
            $this->form_validation->set_rules('enfermedades', 'Enfermedades', '');
            $this->form_validation->set_rules('alergias', 'Alergias', '');
            $this->form_validation->set_rules('observaciones', 'Observaciones', '');
            $this->form_validation->set_rules('idnacionalidad', 'idnacionalidad', 'required');
            $this->form_validation->set_rules('sexo', 'Sexo', 'required');


            if ($this->form_validation->run() == TRUE) {
	        	$this->socios_model->insert_entry();
	        	$this->session->set_flashdata('mensaje', "Nuevo socio creado");
	       		redirect('socios');
	       	} else { 
	       		$this->load->view('commons/header',$data_header);
				$this->load->view('socios/nuevo',$data_body);
				$this->load->view('commons/footer',$data_footer);
	       	}


        } else {

			$this->load->view('commons/header',$data_header);
			$this->load->view('socios/nuevo',$data_body);
			$this->load->view('commons/footer',$data_footer);
		}
		
	}

	public function edit($id)
	{

		$data_header['css_files'] = array(
		);

		$data_body = array(
			'nacionalidades' => $this->socios_model->get_all_nacionalidades(),
			'colegios' => $this->socios_model->get_all_colegios(),
			'socio' => $this->socios_model->get_by_id($id)
		);

		$data_footer['js_files'] = array(
		);

		if($this->input->post('editar')) {
			// Validación
			$this->form_validation->set_rules('dni', 'DNI', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('direccion', 'Dirección postal', 'required');
            $this->form_validation->set_rules('fechanac', 'Fecha de nacimiento', 'required');
            $this->form_validation->set_rules('tlf1', 'Teléfono', '');
            $this->form_validation->set_rules('tlf2', 'Teléfono de urgencia', '');
            $this->form_validation->set_rules('enfermedades', 'Enfermedades', '');
            $this->form_validation->set_rules('alergias', 'Alergias', '');
            $this->form_validation->set_rules('observaciones', 'Observaciones', '');
            $this->form_validation->set_rules('idnacionalidad', 'idnacionalidad', 'required');
            $this->form_validation->set_rules('sexo', 'Sexo', 'required');


            if ($this->form_validation->run() == TRUE) {
	        	$this->socios_model->update_entry();
        		$this->session->set_flashdata('mensaje', "Se han guardado los cambios");
	       		redirect('socios');
	       	} else { 
	       		$this->load->view('commons/header',$data_header);
				$this->load->view('socios/editar',$data_body);
				$this->load->view('commons/footer',$data_footer);
	       	}


        } else {

			$this->load->view('commons/header',$data_header);
			$this->load->view('socios/editar',$data_body);
			$this->load->view('commons/footer',$data_footer);
		}
		
	}

	public function delete() 
	{
		$this->socios_model->delete_entry();
	}

	public function inscribir() 
	{
		$socio = $this->socioclase_model->inscribir_socio_clase();

		echo '<li class="collection-item avatar">
                    <img src="'.site_url('assets/images/avatar_unknown.png').'" alt="" class="circle" />
                    <span class="title">'.$socio->apellidos.", ".$socio->nombre.'</span>
                    <p><small>Donativo: '.$socio->preciopagado.'€</small></p>
                    <a href="#!" class="btn-delete secondary-content" id="id-<?=$asociado->idsocio?>"><i class="mdi-action-delete"></i></a>
                  </li>';
	}

	public function csv() {
		
		echo $this->socios_model->get_all_csv();

	}
	
	public function ficha($id)
	{

		$data_header['css_files'] = array(

		);

		 

		$data_body = array(
			'socio' => $this->socios_model->get_by_id($id)
		);

		$data_footer['js_files'] = array(
		);

		$this->load->view('commons/header',$data_header);
		$this->load->view('socios/ficha',$data_body);
		$this->load->view('commons/footer',$data_footer);
		
	}
	
	

}
