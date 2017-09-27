<?php
class Home extends CI_Controller{
	public function Index(){
		$data['titulo'] = 'Página principal';

        $this->load->view('plantilla/header.php', $data);
        $this->load->view('home/Index.php');
        $this->load->view('plantilla/footer.php');
	}
} 
?>