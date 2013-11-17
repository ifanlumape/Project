<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';	
	
	$attributes = array('name' => 'agenda_form', 'id' => 'agenda_form');
	echo form_open($form_action, $attributes);
?>
	 <p>
		<label for="tema">Tema:</label>
		<input type="text" class="form_field" id="tema" name="tema" size="30" value="<?php echo set_value('tema', isset($default['tema']) ? $default['tema'] : ''); ?>" />
	</p>
	<?php echo form_error('tema', '<p class="field_error">', '</p>');?>

	 <p>
		<label for="isi_agenda">Isi Agenda:</label>
		<textarea class="form_field" name="isi_agenda" id="isi_agenda" rows="10" cols="70"><?php echo set_value('isi_agenda', isset($default['isi_agenda']) ? $default['isi_agenda'] : ''); ?></textarea>
	</p>
	<?php echo form_error('isi_agenda', '<p class="field_error">', '</p>');?>
    
	 <p>
		<label for="tempat">Tempat:</label>
		<input type="text" class="form_field" id="tempat" name="tempat" size="30" value="<?php echo set_value('tempat', isset($default['tempat']) ? $default['tempat'] : ''); ?>" />
	</p>
	<?php echo form_error('tempat', '<p class="field_error">', '</p>');?>
            
	 <p>
		<label for="waktu">Waktu:</label>
		<input type="text" class="form_field" id="waktu" name="waktu" size="30" value="<?php echo set_value('waktu', isset($default['waktu']) ? $default['waktu'] : ''); ?>" />
	</p>
	<?php echo form_error('waktu', '<p class="field_error">', '</p>');?>	
    
	<p>
    	<label for="tgl_mulai">Tgl. Mulai</label>
	<?php 
          combotgl(1,31,'tgl_mulai',$tgl_mulai);
          combonamabln(1,12,'bln_mulai',$bln_mulai);
          combothn(2000,$thn_mulai,'thn_mulai',$thn_mulai);
	?>        
    </p>
    
    <p>
    	<label for="tgl_selesai">Tgl. Selesai</label>
	<?php 
          combotgl(1,31,'tgl_selesai',$tgl_selesai);
          combonamabln(1,12,'bln_selesai',$bln_selesai);
          combothn(2000,$thn_selesai,'thn_selesai',$thn_selesai);
	?>        
    </p>
	
    <p>
		<label for="pengirim">Pengirim:</label>
		<input type="text" class="form_field" id="pengirim" name="pengirim" size="30" value="<?php echo set_value('pengirim', isset($default['pengirim']) ? $default['pengirim'] : ''); ?>" />
	</p>
	<?php echo form_error('pengirim', '<p class="field_error">', '</p>');?>

	<p>
		<input type="submit" name="submit" id="submit" value=" Simpan " />
	</p>

<?php
echo form_close();

	if ( ! empty($link))
	{
		echo '<p id="bottom_link">';
		foreach($link as $links)
		{
			echo $links . ' ';
		}
		echo '</p>';
	}
?>