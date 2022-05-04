<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class dados extends CI_Controller {

function _construct(){
parent_construct();

}

	public function usuario()
	{
		$this->load->view('resultados/usuario');
	}
	
	public function criausuario()
	{
		$this->load->view('resultados/novousuario');
	}
	
	public function addusuario()
	{
		$this->load->view('resultados/adicionausu');
	}	

	public function editausuario()
	{
		$this->load->view('resultados/mudausuario');
	}	

	public function atualizausuario()
	{
		$this->load->view('resultados/atualizausuario');
	}
	
	public function deletausuario()
	{
		$this->load->view('resultados/excluiusuario');
	}

	public function local()
	{
		$this->load->view('resultados/local');
	}
	
	public function crialocal()
	{
		$this->load->view('resultados/novolocal');
	}
	
	public function addlocal()
	{
		$this->load->view('resultados/adicionalocal');
	}	

	public function editalocal()
	{
		$this->load->view('resultados/mudalocal');
	}	

	public function atualizalocal()
	{
		$this->load->view('resultados/atualizalocal');
	}
	
	public function deletalocal()
	{
		$this->load->view('resultados/excluilocal');
	}

	public function maquina()
	{
		$this->load->view('resultados/maquina');
	}
	
	public function criamaquina()
	{
		$this->load->view('resultados/novomaquina');
	}
	
	public function addmaquina()
	{
		$this->load->view('resultados/adicionamaquina');
	}	

	public function editamaquina()
	{
		$this->load->view('resultados/mudamaquina');
	}	

	public function atualizamaquina()
	{
		$this->load->view('resultados/atualizamaquina');
	}
	
	public function deletamaquina()
	{
		$this->load->view('resultados/excluimaquina');
	}

	public function componente()
	{
		$this->load->view('resultados/componente');
	}
	
	public function criacomponente()
	{
		$this->load->view('resultados/novocomponente');
	}
	
	public function addcomponente()
	{
		$this->load->view('resultados/adicionacomponente');
	}	

	public function editacomponente()
	{
		$this->load->view('resultados/mudacomponente');
	}	

	public function atualizacomponente()
	{
		$this->load->view('resultados/atualizacomponente');
	}
	
	public function deletacomponente()
	{
		$this->load->view('resultados/excluicomponente');
	}

	public function preventiva()
	{
		$this->load->view('resultados/preventiva');
	}

	public function corretiva()
	{
		$this->load->view('resultados/corretiva');
	}

	public function criacorretiva()
	{
		$this->load->view('resultados/novocorretiva');
	}
	
	public function addcorretiva()
	{
		$this->load->view('resultados/adicionacorretiva');
	}	

	public function editacorretiva()
	{
		$this->load->view('resultados/mudacorretiva');
	}	

	public function atualizacorretiva()
	{
		$this->load->view('resultados/atualizacorretiva');
	}
	
	public function deletacorretiva()
	{
		$this->load->view('resultados/excluicorretiva');
	}

	public function imprimecorretiva()
	{
		$this->load->view('resultados/relatoriocorretiva');
	}

	public function imprimepreventiva()
	{
		$this->load->view('resultados/relatoriopreventiva');
	}

	public function itenschecklist()
	{
		$this->load->view('resultados/itenschecklist');
	}

	public function criaitem()
	{
		$this->load->view('resultados/novoitem');
	}

	public function additem()
	{
		$this->load->view('resultados/adicionaitem');
	}

	public function checklist()
	{
		$this->load->view('resultados/checklist');
	}

	public function verificar()
	{
		$this->load->view('resultados/verificaitens');
	}

	public function addverificacao()
	{
		$this->load->view('resultados/adicionaverificacao');
	}

	public function editaitem()
	{
		$this->load->view('resultados/mudaitem');
	}

	public function atualizaitem()
	{
		$this->load->view('resultados/atualizaitem');
	}

	public function deletaitem()
	{
		$this->load->view('resultados/excluiitem');
	}

public function checklistfinalizados(){

	$this->load->view('resultados/checklistfinalizados');
}

public function mudachecklist(){

	$this->load->view('resultados/mudachecklist');
}

public function atualizachecklist(){

	$this->load->view('resultados/atualizachecklist');
}

public function imprimechecklist(){

	$this->load->view('resultados/relatoriochecklist');
}

public function visualizachecklist(){

	$this->load->view('resultados/visualizachecklist');
}

public function deletachecklist(){


	$this->load->view('resultados/excluichecklist');
}




	
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/primeiro.php */