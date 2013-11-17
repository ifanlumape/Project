<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="<?php echo base_url().'images/fav_icon.png';?>" />
<style type="text/css">
@import url("<?php echo base_url() . 'css/login.css'; ?>");
</style>
<link href="../../../css/login.css" rel="stylesheet" type="text/css" />
<title>Login</title>
</head>

<body>
<div id="wrapper">
<table width="600">
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="300" valign="top">Selamat datang di halaman administrator website. <br />Untuk masuk ke halaman utama administrator, silahkan login dengan menggunakan <em>username</em> dan <em>password</em> anda!</td>
    <td valign="top">
<?php
	$attributes = array('name' => 'login_form', 'id' => 'login_form');
	echo form_open('users/process_login', $attributes);
	$message = $this->session->flashdata('message');
	echo $message == '' ? '' : '<p id="message">' . $message . '</p>';
?>
<table width="100%" cellpadding="5">
  <tr>
    <td valign="top">Username</td>
    <td>:
      <input type="text" name="username" size="25" class="form_field" value="<?php echo set_value('username');?>"/><?php echo form_error('username', '<p class="field_error">', '</p>');?></td>
  </tr>
  <tr>
    <td valign="top">Password</td>
    <td>:
      <input type="password" name="password" size="25" class="form_field" value="<?php echo set_value('password');?>"/><?php echo form_error('password', '<p class="field_error">', '</p>');?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" id="submit" value="Login" /></td>
  </tr>
</table>
<?php echo form_close(); ?> 
    </td>
  </tr>
</table>
</div>
<p align="center">Copyright &copy; 2013 by APTIKOM Sulut. All rights reserved.</p>
</body>
</html>