<?php 
	echo ! empty($h2_title) ? '<h2>' . $h2_title . '</h2>': '';
	echo ! empty($message) ? '<p class="message">' . $message . '</p>': '';

	$flashmessage = $this->session->flashdata('message');
	echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>': '';	
	
	$attributes = array('name' => 'users_form', 'id' => 'users_form');
	echo form_open($form_action, $attributes);
?>
	 <p>
		<label for="username">Username:</label>
		<input type="text" class="form_field" id="username" name="username" size="30" value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>" />
	</p>
	<?php echo form_error('username', '<p class="field_error">', '</p>');?>

    <?php 
		if(isset($default['update']) && $default['update'] != TRUE){
	?>
	 <p>
		<label for="password">Password:</label>
		<input type="password" class="form_field" id="password" name="password" size="30" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>" />
	</p>
	<?php echo form_error('password', '<p class="field_error">', '</p>');?>
    <?php } else { ?>
	 <p>
		<label for="password">Password:</label>
		<input type="password" class="form_field" id="password" name="password" size="30" value="" />
	</p>
    <?php echo form_error('password', '<p class="field_error">', '</p>');?>    
    <?php } ?>	
	 <p>
		<label for="nama_lengkap">Nama Lengkap:</label>
		<input type="text" class="form_field" id="nama_lengkap" name="nama_lengkap" size="30" value="<?php echo set_value('nama_lengkap', isset($default['nama_lengkap']) ? $default['nama_lengkap'] : ''); ?>" />
	</p>
	<?php echo form_error('nama_lengkap', '<p class="field_error">', '</p>');?>
            
	 <p>
		<label for="email">Email:</label>
		<input type="text" class="form_field" id="email" name="email" size="30" value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" />
	</p>
	<?php echo form_error('email', '<p class="field_error">', '</p>');?>	
    

	 <p>
		<label for="no_telp">No. Telp:</label>
		<input type="text" class="form_field" id="no_telp" name="no_telp" size="30" value="<?php echo set_value('no_telp', isset($default['no_telp']) ? $default['no_telp'] : ''); ?>" />
	</p>
	<?php echo form_error('no_telp', '<p class="field_error">', '</p>');?>
    
    <p>
	<label for="blokir">Blokir:</label>
	<input name="blokir" type="radio" value="Y" <?php echo set_radio('blokir', 'Y', isset($default['blokir']) && $default['blokir'] == 'Y' ? TRUE : FALSE); ?> /> Y
	<input name="blokir" type="radio" value="N" <?php echo set_radio('blokir', 'N', isset($default['blokir']) && $default['blokir'] == 'N' ? TRUE : FALSE); ?> /> N    
	</p>
	<?php echo form_error('blokir', '<p class="field_error">', '</p>');?>

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