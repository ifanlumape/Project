<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';	
	
	$attributes = array('name' => 'hubungi_form', 'id' => 'hubungi_form');
	echo form_open($form_action, $attributes);
?>
	 <p>
		<label for="kepada">Kepada:</label>
		<input type="text" class="form_field" id="email" name="email" size="30" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" />
	</p>
	<?php echo form_error('email', '<p class="field_error">', '</p>');?>


	 <p>
		<label for="subjek">Subjek:</label>
		<input type="text" class="form_field" id="subjek" name="subjek" size="30" value="<?php echo set_value('subjek', isset($default['subjek']) ? $default['subjek'] : ''); ?>" />
	</p>
	<?php echo form_error('subjek', '<p class="field_error">', '</p>');?>
    
    
	 <p>
		<label for="pesan">Pesan:</label>
		<textarea class="form_field" name="pesan" id="pesan" rows="10" cols="70"><?php echo set_value('pesan', isset($default['pesan']) ? $default['pesan'] : ''); ?></textarea>
	</p>
	<?php echo form_error('pesan', '<p class="field_error">', '</p>');?>
    

	<p>
		<input type="submit" name="submit" id="submit" value=" Reply " />
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