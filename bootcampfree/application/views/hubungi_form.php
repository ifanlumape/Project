<?php
echo heading('Hubungi Kami', 2);
echo ! empty($message) ? '<p class="message">' . $message. '</p>' : ''; 
$flashmessage = $this->session->flashdata('message');
echo ! empty($flashmessage) ? '<p class="message">' . $flashmessage . '</p>' : '';

echo form_open($form_action);
echo '<p><label>Nama:</label>';
$data = array(
              'name'        => 'nama',
              'id'          => 'nama',
              'value'       => isset($default['nama']) ? $default['nama'] : '',
              'maxlength'   => '50',
              'size'        => '50',
              'style'       => 'width:50%',
            );

echo form_input($data);
echo'</p>';
echo  form_error('nama', '<p class="field_error">', "</p>"); 

echo '<p><label>Email:</label>';
$data = array(
              'name'        => 'email',
              'id'          => 'email',
              'value'       => isset($default['email']) ? $default['email'] : '',
              'maxlength'   => '50',
              'size'        => '50',
              'style'       => 'width:50%',
            );

echo form_input($data);
echo'</p>';
echo  form_error('email', '<p class="field_error">', "</p>"); 

echo '<p><label>Subjek:</label>';
$data = array(
              'name'        => 'subjek',
              'id'          => 'subjek',
              'value'       => isset($default['subjek']) ? $default['subjek'] : '',
              'maxlength'   => '50',
              'size'        => '50',
              'style'       => 'width:50%',
            );

echo form_input($data);
echo'</p>';
echo  form_error('subjek', '<p class="field_error">', "</p>"); 

echo '<p><label>Pesan:</label>';
$data = array(
              'name'        => 'pesan',
              'id'          => 'pesan',
              'value'       => isset($default['pesan']) ? $default['pesan'] : '',
              'cols'   		=> '60',
              'rows'        => '5',
			  'type'		=> 'textarea',
              'style'       => 'width:50%',
            );

echo form_input($data);
echo'</p>';
echo  form_error('pesan', '<p class="field_error">', "</p>"); 

echo form_submit('mysubmit', 'Submit Post!');
echo form_close();