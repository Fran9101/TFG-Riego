<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Socios_model extends CI_Model {

        public $dni;
        public $nombre;
        public $apellidos;
        public $direccion;
        public $fechanac;
        public $tlf1;
        public $tlf2;
        public $idcentro;
        public $idnacionalidad;
        public $enfermedades;
        public $alergias;
        public $observaciones;
        public $sexo;
		public $animador;
		public $numsocio;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();

                $this->load->database();
                $this->load->dbutil();

        }

        public function get_all()
        {
                $idcentro = $this->session->userdata('idcentro');
                $this->db->order_by('idsocios', 'DESC');
		$query = $this->db->get_where('socios', array('idcentro' => $idcentro));

                return $query->result();
        }
		
        public function get_all_apelli()
        {
                $idcentro = $this->session->userdata('idcentro');
                $this->db->order_by('apellidos', 'ASC');
                $query = $this->db->get_where('socios', array('idcentro' => $idcentro));

                return $query->result();
        }

        public function get_all_apelli_limit()
        {
                $idcentro = $this->session->userdata('idcentro');
                $this->db->order_by('apellidos', 'ASC');
                $this->db->limit(300);
                $query = $this->db->get_where('socios', array('idcentro' => $idcentro));

                return $query->result();
        }

        public function get_all_nacionalidades()
        {
                $query = $this->db->get('nacionalidad');
                return $query->result();
        }

        public function get_all_colegios()
        {
                $query = $this->db->get('colegios');
                return $query->result();
        }

        public function get_last_ten_entries()
        {
                $query = $this->db->get('socios', 10);
                return $query->result();
        }

        public function get_by_id($id) {
                $query = $this->db->get_where('socios', array('idsocios' => $id));
                return $query->row();
        }

        public function get_all_csv() {

                $query = $this->db->get('socios');
                header('Content-Type: text/csv');
                header('Content-disposition: attachment;filename=centrojuvenil_socios_'.date("d-m-Y").'.csv');
                return $this->dbutil->csv_from_result($query);
        }
		
		public function get_numsocio_max()
        {
			$idcentro = $this->session->userdata('idcentro');
	       $query = $this->db->query('SELECT max(numsocio) as total FROM socios WHERE idcentro='.$idcentro);
		   $row = $query->row();
		   return $row->total;

        }

        public function insert_entry()
        {
                $this->dni       = $this->input->post('dni');
                $this->nombre    = $this->input->post('nombre');
                $this->apellidos = $this->input->post('apellidos');
                $this->email     = $this->input->post('email');
                $this->direccion = $this->input->post('direccion');
                $this->fechanac  = $this->input->post('fechanac');
                $this->tlf1      = $this->input->post('tlf1');
                $this->tlf2      = $this->input->post('tlf2');
                $this->idcentro  = $this->input->post('idcentro');
                $this->enfermedades  = $this->input->post('enfermedades');
                $this->alergias  = $this->input->post('alergias');
                $this->observaciones  = $this->input->post('observaciones');
                $this->idnacionalidad  = $this->input->post('idnacionalidad');
                $this->sexo  = $this->input->post('sexo');
				
				if($this->input->post('animador')=='on'){
					$aux=1;
				}else{
					$aux=0;
				}
				
				$this->animador  = $aux;
				$this->numsocio = $this->get_numsocio_max()+1;

                $this->db->insert('socios', $this);

                // Insertamos una notificación de nuevo socio
                $this->load->model('notificaciones_model');
                $this->notificaciones_model->insert_entry('newsocio');

        }

        public function update_entry()
        {
			if($this->input->post('animador')=='on'){
					$aux=1;
				}else{
					$aux=0;
				}
				
			
                $datos = array(
                        'dni'       => $this->input->post('dni'),
                        'nombre'    => $this->input->post('nombre'),
                        'apellidos' => $this->input->post('apellidos'),
                        'email'     => $this->input->post('email'),
                        'direccion' => $this->input->post('direccion'),
                        'fechanac'  => $this->input->post('fechanac'),
                        'tlf1'      => $this->input->post('tlf1'),
                        'tlf2'      => $this->input->post('tlf2'),
                        'enfermedades'  => $this->input->post('enfermedades'),
                        'alergias'  => $this->input->post('alergias'),
                        'observaciones'  => $this->input->post('observaciones'),
                        'idnacionalidad'  => $this->input->post('idnacionalidad'),
                        'sexo'  => $this->input->post('sexo'),
						'animador'  => $aux,
						
                );

                $this->db->update('socios', $datos, array('idsocios' => $this->input->post('idsocios')));
        }

        public function update_foto()
        {
                //$datos = array("foto" => $this->input->post('foto'));
                //$this->db->update('socios', $datos, array('idsocios' => $this->input->post('id')));

                $idsocio = $this->input->post('id');
                $foto    = $this->input->post('foto');
                $ruta    = './assets/images/socios/'.$idsocio.".jpg";

                $ifp = fopen($ruta, "w");

                fwrite($ifp, base64_decode($foto)); 
                fclose($ifp); 

                return './assets/images/socios/'.$idsocio.".jpg";
        }

        public function delete_entry()
        {
                $idsocio = $this->input->post('id');
                $this->db->delete('socios', array('idsocios' => $idsocio)); 
        }

        public function  get_socios_by_clase($idclase) {
                $this->db->select('*');
                $this->db->from('socios');
                $this->db->join('socioaclase', 'socioaclase.idsocio = socios.idsocios');
                $this->db->where('idclase', $idclase);
				$this->db->order_by('apellidos', 'ASC');
                $query = $this->db->get();
                return $query->result();
        }
		
		////Utilizada en la lista socio
		public function get_all_centro()
        {
		$idcentro = $this->session->userdata('idcentro');
                $this->db->order_by('idsocios', 'DESC');
				$query = $this->db->get_where('socios', array('idcentro' => $idcentro));

                return $query->result();
        }
		
		//Utilizada en la ficha del socio
		public function get_socio_actividades($id)
        {
			   
	       $query = $this->db->query('SELECT count(*) as total FROM socioaclase WHERE idsocio='.$id);
		   $row = $query->row();
		   return $row->total;

        }
		
		//Utilizada en la ficha del socio
		public function get_socio_eventos($id)
        {
			   
	       $query = $this->db->query('SELECT count(*) as total FROM socioevento WHERE idsocio='.$id);
		   $row = $query->row();
		   return $row->total;

        }
		
		//Utilizada en la ficha del socio
		public function get_socio_donado($id)
        {
			   
	       $query = $this->db->query('SELECT SUM(preciopagado) as total FROM socioaclase WHERE idsocio ='.$id);
		   $row = $query->row();
		   return $row->total;

        }
		
		//Utilizada en la ficha del socio
		public function get_socio_clase_actividades($id)
        {
			   
	       $query = $this->db->query('SELECT actividades.nombre as actividad,actividades.id,clase.nombre as clase,clase.idclase as class,clase.precio as donativo,socioaclase.preciopagado as donado FROM (socioaclase join clase on(socioaclase.idclase=clase.idclase)) join actividades on(clase.idactividad=actividades.id) where socioaclase.idsocio ='.$id);
		   return $query->result();
        }
		
		//Utilizada en la ficha del socio
		public function get_socio_evento($id)
        {
			   
	       $query = $this->db->query('SELECT eventos.ideventos as evento,eventos.nombre as nombre,eventos.precio as precio ,eventos.fechaini as fecha,socioevento.preciopagado as pagado FROM eventos join socioevento on(eventos.ideventos=socioevento.idevento) WHERE socioevento.idsocio='.$id);
		   return $query->result();
        }

        public function transformar_foto() {
                $socios = $this->get_all();

                foreach ($socios as $socio) {
                        $foto    = $socio->foto;
                        $ruta    = './assets/images/socios/'.$socio->idsocios.".jpg";

                        $ifp = fopen($ruta, "w");

                        fwrite($ifp, base64_decode($foto)); 
                        fclose($ifp); 
                }
                
        }
		
		
		
		


}