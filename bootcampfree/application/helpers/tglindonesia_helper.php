<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Dibuat oleh : ifan lumape
 * E-Mail : fnnight@gmail.com
 */
function tgl_indonesia($tanggal)
{
	$hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	
	
	$hr = date('w', strtotime($tanggal));
	$hari = $hari_array[$hr];
	$tgl = date('d-m-Y', strtotime($tanggal));
	
	
	$hr_tgl = "$hari, $tgl";
	return $hr_tgl;
}

function tgl_indo($tgl){
		$tanggal = substr($tgl,8,2);
		$bulan = getBulan(substr($tgl,5,2));
		$tahun = substr($tgl,0,4);
		return $tanggal.' '.$bulan.' '.$tahun;		 
}	

function getBulan($bln){
			switch ($bln){
				case 1: 
					return "Januari";
					break;
				case 2:
					return "Februari";
					break;
				case 3:
					return "Maret";
					break;
				case 4:
					return "April";
					break;
				case 5:
					return "Mei";
					break;
				case 6:
					return "Juni";
					break;
				case 7:
					return "Juli";
					break;
				case 8:
					return "Agustus";
					break;
				case 9:
					return "September";
					break;
				case 10:
					return "Oktober";
					break;
				case 11:
					return "November";
					break;
				case 12:
					return "Desember";
					break;
			}
		} 
/* End of file tglindonesia_helper.php */
/* Location: ./application/helpers/tglindonesia_helper.php */