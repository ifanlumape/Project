<?php echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : ''; ?>
<?php echo ! empty($message) ? '<p class="message">' . $message. '</p>' : ''; ?>
<?php $flashmessage = $this->session->flashdata('message'); ?>
<?php echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>' : ''; ?>
<?php echo form_open_multipart($form_action); ?>
<p>
<p>
<label for="id_album">Album :</label>
<?php echo form_dropdown('id_album', $options_album, isset($default['id_album']) ? $default['id_album'] : ''); ?>
</p>
<?php 
echo  form_error('id_album', '<p class="field_error">', "</p>"); 
?>

<p>
<label for="jdl_gallery">Jdl Gallery:</label>
<input type="text" name="jdl_gallery" class="form_field" size="50" value="<?php echo set_value('jdl_gallery', isset($default['jdl_gallery']) ? $default['jdl_gallery'] : ''); ?>" />
</p>
<?php 
echo  form_error('jdl_gallery', '<p class="field_error">', "</p>"); 
?>
<p>
<label for="gallery_seo">Gallery Seo:</label>
<input type="text" name="gallery_seo" class="form_field" size="50" value="<?php echo set_value('gallery_seo', isset($default['gallery_seo']) ? $default['gallery_seo'] : ''); ?>" />
</p>
<?php 
echo  form_error('gallery_seo', '<p class="field_error">', "</p>"); 
?>

<p>
<label for="keterangan">Keterangan:</label>
<textarea class="form_field" name="keterangan" id="keterangan" rows="5" cols="60"><?php echo set_value('keterangan', isset($default['keterangan']) ? $default['keterangan'] : ''); ?></textarea>
</p>
<?php echo  form_error('keterangan', '<p class="field_error">', '</p>');?>

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