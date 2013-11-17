<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utama extends CI_Controller 
{

	function __construct()
	{
        parent::__construct();   
		$this->load->model('m_keluarga');
		$this->load->helper('form');
		$this->load->database();
    }	

	function index()
	{		 		
		$data['pusat_peta'] = $this->m_keluarga->geocode('Manado');
		$this->load->view('tampil_peta', $data);
	}

	function cari()
	{
		if ($this->input->post('address') != ''){			  
			$alamat = $this->input->POST('address');
		}
		
		if($this->uri->segment(3) != '' && $this->uri->segment(4) != '')
		{
			$alamat = $this->uri->segment(3).','.$this->uri->segment(4);	
		}
		
		if($alamat <> "")
	 	{
	    	$alamat = $this->m_keluarga->geocode($alamat);
         	if ($alamat[3]=="OK")
			{
	        	$data['pusat_peta'] = $alamat;
				$term1= $this->m_keluarga->carintd($alamat[0],$alamat[1],"");
				$term2= $this->m_keluarga->carintd($alamat[0],$alamat[1],$term1[2]);

	   			$batas_jarak = 30;
            	if($term1[3] <= $batas_jarak  or $term2[3] <= $batas_jarak)
				{
	      			$data['marker1']= $term1;
	      			$data['marker2']=$term2; 
	   			}	
	  			else
				{
	      			$data['note']= "Lokasi berjarak $batas_jarak KM lebih dari Manado, tidak ada data yang ditampilkan";
	  			}
				$this->load->view('tampil_peta', $data);         
			}
			else
			{
	      		$this->kesalahan();
			}
		}	
     	else
	 	{
	    	$this->kesalahan();
     	}			
     }

	function cari_kord(){
        $data['longi'] = $this->input->POST('lng');
        $data['latit'] = $this->input->POST('lat');
		$data['ntd'] = $this->m_terminal->carintd($data['longi'],$data['latit'],"");
        $this->load->view('tampil_peta', $data);
       $this->index();
	}	
	
	function kesalahan()
	{
	    $data['pusat_peta']= $this->m_keluarga->geocode('Manado');
	    $data['note']= "Alamat tidak ditemukan, silahkan coba lagi";
	    $this->load->view('tampil_peta', $data);         
	}
}
?>
