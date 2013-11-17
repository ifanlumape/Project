<?php echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>' : ''; ?>
<?php echo ! empty($message) ? '<p class="message">' . $message. '</p>' : ''; ?>
<?php $flashmessage = $this->session->flashdata('message'); ?>
<?php echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>' : ''; ?>

<?php echo form_open_multipart($form_action); ?>

<p>
<label for="judul">Judul:</label>
<input type="text" name="judul" class="form_field" size="50" value="<?php echo set_value('judul', isset($default['judul']) ? $default['judul'] : ''); ?>" />
</p>
<?php 
echo  form_error('judul', '<p class="field_error">', "</p>"); 
?>

	<?php if(isset($default['nama_file'])){ ?>
    <p>
    	<label for="view_file">&nbsp;</label>
    	<a href="<?php echo base_url().'files/'.$default['nama_file']; ?>"><?php echo $default['nama_file']; ?></a>
   </p>     
	<?php } ?>  
          
	<p><br />
    	<label for="userfile">File :</label>
        <input type="file" name="userfile" id="userfile" size="30" />
    </p>
    <p>
    	<label>&nbsp;</label>
        Maksimal file Maksimal 1Mb. Hanya untuk zip|pdf|ppt|gtar|gz|tar|tgz|gif|jpeg|jpg|jpe|png|doc|docx|xlsx|word|xl file.
    </p>
    
    <p>
    	<label for="upload">&nbsp;</label>
        <input type="checkbox" name="upload" id="upload" value="1"  /> Klik untuk upload file!
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