<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';	
	
	$attributes = array('name' => 'berita_form', 'id' => 'berita_form');
	echo form_open_multipart($form_action, $attributes);
?>
	 <p>
		<label for="judul">Judul:</label>
		<input type="text" class="form_field" id="judul" name="judul" size="30" value="<?php echo set_value('judul', isset($default['judul']) ? $default['judul'] : ''); ?>" />
	</p>
	<?php echo form_error('judul', '<p class="field_error">', '</p>');?>
    

	 <p>
		<label for="kutipan">Kutipan:</label>
		<textarea class="form_field" name="kutipan" id="kutipan" rows="5" cols="60"><?php echo set_value('kutipan', isset($default['kutipan']) ? $default['kutipan'] : ''); ?></textarea>
	</p>
	<?php echo form_error('kutipan', '<p class="field_error">', '</p>');?>
    

	 <p>
		<label for="isi_berita">Isi Berita:</label>
		<textarea class="form_field" name="isi_berita" id="isi_berita" rows="5" cols="60"><?php echo set_value('isi_berita', isset($default['isi_berita']) ? $default['isi_berita'] : ''); ?></textarea>
	</p>
	<?php echo form_error('isi_berita', '<p class="field_error">', '</p>');?>
    
	
	<?php if(isset($default['view_image'])){ ?>
    <p>
    	<label for="view_image">&nbsp;</label>
    	<img src="<?php echo base_url().'images/berita/thumbs/'.$default['gambar']; ?>" />
   </p>     
	<?php } ?>  
          
	<p><br />
    	<label for="userfile">Gambar:</label>
        <input type="file" name="userfile" id="userfile" size="30" />
    </p>
    <p>
    	<label>&nbsp;</label>
        Lebar maksimal gambar Maksimal 535px, serta ukuran 1024kb/1Mb.
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