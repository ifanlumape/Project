<?php echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : ''; ?>
<?php echo ! empty($message) ? '<p class="message">' . $message. '</p>' : ''; ?>
<?php $flashmessage = $this->session->flashdata('message'); ?>
<?php echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>' : ''; ?>

<?php echo form_open_multipart($form_action);?>
<p>
	<label for="jdl_album">Judul Album:</label>
	<input type="text" name="jdl_album" class="form_field" size="50" value="<?php echo set_value('jdl_album', isset($default['jdl_album']) ? $default['jdl_album'] : ''); ?>" />
</p>
<?php 
	echo  form_error('jdl_album', '<p class="field_error">', "</p>"); 
?>
<p>
	<label for="album_seo">Album SEO:</label>
	<input type="text" name="album_seo" class="form_field" size="50" value="<?php echo set_value('album_seo', isset($default['album_seo']) ? $default['album_seo'] : ''); ?>" />
</p>
<?php 
	echo  form_error('album_seo', '<p class="field_error">', "</p>"); 
?>

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
	<label for="aktif">Aktif : </label>
	<input name="aktif" type="radio" value="Y" <?php echo  set_radio('aktif', 'Y', isset($default['aktif']) && $default['aktif'] == 'Y' ? TRUE : FALSE); ?> /> Y
	<input name="aktif" type="radio" value="N" <?php echo  set_radio('aktif', 'N', isset($default['aktif']) && $default['aktif'] == 'N' ? TRUE : FALSE); ?> /> N  
</p>
	<?php echo  form_error('aktif', '<p class="field_error">', '</p>');?>
<p>
<input type="submit" name="submit" id="submit" value=" Simpan " />
</p>

<?php
echo  form_close();

if ( ! empty($link))
{
	echo  '<p id="bottom_link">';
	foreach($link as $links)
	{
		echo  $links . ' ';
	}
	echo '</p>';
}
?>