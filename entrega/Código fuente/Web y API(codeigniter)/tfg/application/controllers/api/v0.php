<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;


class v0 extends REST_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function estadistica_get(){
		//comprobar entrada de dia mes o año, en cada caso es una consulta
        $dia = $this->get('dia');
        $mes = $this->get('mes');
        $anno = $this->get('anno');
        $id = $this->get('id');
        if($dia != NULL and $mes != NULL and $anno != NULL){
            $query = $this-> db ->query("SELECT * FROM estadisticas WHERE DAY(Fecha) = ".$dia." AND MONTH(Fecha) = ".$mes." AND YEAR(Fecha) = ".$anno);
        }else if($dia == NULL and $mes != NULL and $anno == NULL){
            $query = $this-> db ->query("SELECT * FROM estadisticas WHERE DAY(Fecha) = ".$dia." AND MONTH(Fecha) = MONTH(now()) AND YEAR(Fecha) = YEAR(now())");
        }else{
            //$query = $this-> db ->query("SELECT * FROM estadisticas WHERE DAY(Fecha) = DAY(now()) AND MONTH(Fecha) = MONTH(now()) AND YEAR(Fecha) = YEAR(now())");
            //$query = $this-> db ->query("SELECT * FROM estadisticas AS es, arduino WHERE YEAR(fecha)=YEAR(now())");
            //$query = $this-> db ->query("SELECT Zona, Fecha, Temperatura, Hum_Aire, Litros FROM estadisticas INNER JOIN arduino ON estadisticas.Arduino_IDArduino=arduino.IDArduino WHERE YEAR(Fecha)=YEAR(now())");
            $query = $this-> db ->query("SELECT Fecha, Temperatura, Hum_Aire, Litros FROM estadisticas WHERE YEAR(Fecha)=YEAR(now()) AND Arduino_IDArduino= '".$id."'");
        }
        //$query = $this-> db ->query("SELECT * FROM estadisticas");//SELECT * FROM estadistica WHERE fecha BETWEEN '2017-03-19 00:00:00' AND '2017-03-19 23:59:59'
        $resultado = $query->result();
        $this->response($resultado, REST_Controller::HTTP_OK);

    }
	
	public function programacion_get(){
		
        $query = $this-> db ->query("SELECT P.IDProg, A.Zona,P.Hora_ini,P.Hora_fin FROM arduino AS A, arduino_programacion AS AP, programacion AS P WHERE A.IDArduino=AP.Arduino_IDArduino AND AP.Programacion_IDProg=P.IDProg");//SELECT Hora_ini, Hora_fin FROM arduino_programacion as ap, programacion WHERE ap.IDArduino=.$id
        $resultado = $query->result();
        $this->response($resultado, REST_Controller::HTTP_OK);

    }

    public function config_get(){
        $id = $this->get('id');
        if($id != NULL){
            $query = $this-> db ->query("SELECT Zona FROM arduino WHERE IDArduino='".$id."'");
        }else{
        $query = $this-> db ->query("SELECT * FROM arduino ");
        }
        $resultado = $query->result();
        $this->response($resultado, REST_Controller::HTTP_OK);

    }
	//update programacion y arduino
	
	public function prog_post()
    {
        
        $idProg = $this->input->get("id");
        $ini = $this->input->get("ini");
        $fin = $this->input->get("fin");
        $query_update = $this-> db->query("UPDATE programacion SET Hora_ini=".$ini.", Hora_fin=".$fin."WHERE IDProg=".$idProg);
        
        
        if($query_update){
            $this-> response($query_update,REST_Controler::HTTP_CREATED);//201
        }else{
            $this-> response($query_update,REST_Controler::HTTP_INTERNAL_SERVER_ERROR);//500
        }
    }
	
	public function arduino_post()
    {
        
        $idArdu = $this->input->get("id");
        $zona = $this->input->get("zona");
        //$idArdu = $this->input->post("id");
        //$zona = $this->input->post("zona");
        $query_update = $this->db->query("UPDATE arduino SET Zona=".$zona." WHERE IDArduino=".$idArdu);
        
        
        if($query_update){
            $this-> response($query_update,REST_Controler::HTTP_CREATED);//OK 201
            redirect(base_url() . "inicio/Conf", 'refresh');
        }else{
            $this-> response($query_update,REST_Controler::HTTP_INTERNAL_SERVER_ERROR);//ERROR 500
            echo "ERROR";
        }
    }
	
	
	//falta delete para eliminar entradas en la BBDD
	
	/*public function hdad_get(){

        $dia = $this->get('dia');
        $id = $this->get('id');

        if ($id != NULL) {
            $query = $this->db->query("SELECT * FROM hermandades WHERE id =".$id);
            $resultado['hdad']['datos']= $query->row();
            $query = $this->db->query("SELECT nombre,posicion,historia,capataz FROM pasos WHERE idHermandad =".$id);
            $resultado['hdad']['pasos']= $query->result();
            $query = $this->db->query("SELECT descripcion,imgUrl,imgUrl2 FROM tunicas WHERE idHermandades =".$id);
            $resultado['hdad']['tunica']= $query->row();
            $query = $this->db->query("SELECT nombre,detrasDe FROM musica WHERE idHermandades =".$id);
            $resultado['hdad']['musica']= $query->result();
        }elseif ($dia != NULL){
            $query = $this->db->query("SELECT id,nombre,escudoUrl,imagen,retraso,inicio,fin FROM hermandades WHERE idDias =".$dia);
            $resultado['hdad']= $query->result();
        }else{
            $query = $this->db->query("SELECT h.id,h.nombre AS hdad,h.escudoUrl,h.nazarenos,d.nombre"
                ." FROM hermandades AS h JOIN dias AS d ON(h.idDias=d.id)");
            $resultado['hdad']= $query->result();
        }


        $this->response($resultado, REST_Controller::HTTP_OK);
    }
	public function contastes_user_insert_post()
	{
	
		$id_user = $this->input->get("id_user");
		$id_constante = $this->input->get("id_constante");
		$valor = $this->input->get("valor");		
		$query_inser = $this->db->query("INSERT INTO users_constantes (id_user,id_constante,valor)VALUES(".$id_user.",".$id_constante.",".$valor.")");
		
		if($query_inser){
			$this-> response($query_inser,201);
		}else{
			$this-> response($query_inser,500);
		}
		
	}

public function puntos_user_post()
	{
		$id = $this->input->get("id_user");
		$puntos = $this->input->get("puntos");
		$query_update = $this->db->query("UPDATE users SET puntuacion=".$puntos." WHERE id=".$id);
		
		
		if($query_update){
			$this-> response($query_update,201);
		}else{
			$this-> response($query_update,500);
		}
	
	*/
}
