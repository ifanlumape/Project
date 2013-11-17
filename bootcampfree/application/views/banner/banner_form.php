<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';	
	
	$attributes = array('name' => 'banner_form', 'id' => 'banner_form');
	echo form_open_multipart($form_action, $attributes);
?>
	 <p>
		<label for="judul">Judul:</label>
		<input type="text" class="form_field" id="judul" name="judul" size="30" value="<?php echo set_value('judul', isset($default['judul']) ? $default['judul'] : ''); ?>" />
	</p>
	<?php echo form_error('judul', '<p class="field_error">', '</p>');?>


	 <p>
		<label for="url">URL:</label>
		<input type="text" class="form_field" id="url" name="url" size="30" value="<?php echo set_value('url', isset($default['url']) ? $default['url'] : ''); ?>" />
	</p>
	<?php echo form_error('url', '<p class="field_error">', '</p>');?>
    
	
	<?php if(isset($default['view_image']) && $default['view_image'] == TRUE){ ?>
    <p>
    	<label for="view_image">&nbsp;</label>
    	<img src="<?php echo base_url().'images/banner/'.$default['gambar']; ?>" />
   </p>     
	<?php } ?>  
          
	<p><br />
    	<label for="userfile">Image:</label>
        <input type="file" name="userfile" id="userfile" size="30" />
    </p>
    
    <p>
    	<label>&nbsp;</label>
        Gambar Maksimal 260px, ukuran 1Mb
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