<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Diadopsi dari : Buku Trik dan Rahasia Membuat Aplikasi Web dengan PHP
 * Dimodifikasi oleh : ifan lumape
 * E-Mail : fnnight@gmail.com
 */

/* End of file randompassword_helper.php */
/* Location: ./application/helpers/randompassword_helper.php */

function random_password($len)
{
	$pass = '';
	$lchar = 0;
	$char = 0;
	
	for ($i = 0; $i < $len; $i++)
	{
		while ($char == $lchar)
		{
			$char = rand(48, 109);
			if ($char > 57)
			{
				$char += 7;
			}
			if ($char > 90)
			{
				$char += 6;
			}
		}
		
		$pass .= chr($char);
		$lchar = $char;
	}
	return $pass;
}