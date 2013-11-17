<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';	
	
	$attributes = array('name' => 'halaman_form', 'id' => 'halaman_form');
	echo form_open_multipart($form_action, $attributes);
?>
	 <p>
		<label for="judul">Judul:</label>
		<input type="text" class="form_field" id="judul" name="judul" size="30" value="<?php echo set_value('judul', isset($default['judul']) ? $default['judul'] : ''); ?>" />
	</p>
	<?php echo form_error('judul', '<p class="field_error">', '</p>');?>
    

	 <p>
		<label for="isi_halaman">Isi halaman:</label>
		<textarea class="form_field" name="isi_halaman" id="isi_halaman" rows="10" cols="70"><?php echo set_value('isi_halaman', isset($default['isi_halaman']) ? $default['isi_halaman'] : ''); ?></textarea>
	</p>
	<?php echo form_error('isi_halaman', '<p class="field_error">', '</p>');?>
    
	
	<?php if(isset($default['view_image'])){ ?>
    <p>
    	<label for="view_image">&nbsp;</label>
    	<img src="<?php echo base_url().'images/halaman/thumbs/'.$default['gambar']; ?>" />
   </p>     
	<?php } ?>  
          
	<p><br />
    	<label for="userfile">Gambar:</label>
        <input type="file" name="userfile" id="userfile" size="30" />
    </p>
    
    <p>
    	<label for="upload">&nbsp;</label>
        <input type="checkbox" name="upload" id="upload" value="1"  /> Klik untuk upload images!
    </p>
    
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