<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class autenticar extends CI_Controller {

function _construct(){
parent_construct();

}

				public function autentica()
	{
		$this->load->view('autenticar');
	}
	
	
		public function geralmetas()
	{
		$this->load->view('resultados/geralmetas');
	}
	
	
	
	
	
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/primeiro.php */