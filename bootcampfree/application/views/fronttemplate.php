<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo isset($title) ? $title : ''; ?></title>
<link href="../../css/stylebox.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>css/stylebox.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.4.min.js" ></script>
<script type="text/javascript">
$(function(){
//set the starting bigestHeight variable
var biggestHeight = 0;
//check each of them
$('.kolom').each(function(){
//if the height of the current element is
//bigger then the current biggestHeight value
if($(this).height() > biggestHeight){
//update the biggestHeight with the
//height of the current elements
biggestHeight = $(this).height();
}
});
//when checking for biggestHeight is done set that
//height to all the elements
$('.kolom').height(biggestHeight);
});
</script>
<script type="text/javascript">
$(function(){
//set the starting bigestHeight variable
var biggestHeight = 0;
//check each of them
$('.kolom2').each(function(){
//if the height of the current element is
//bigger then the current biggestHeight value
if($(this).height() > biggestHeight){
//update the biggestHeight with the
//height of the current elements
biggestHeight = $(this).height();
}
});
//when checking for biggestHeight is done set that
//height to all the elements
$('.kolom2').height(biggestHeight);
});
</script>
</head>

<body>
<div id="wrapper">
  <div id="header">
    <div id="headerleft"><?php echo heading('Sulut Doctoral Bootcamp', 2); ?></div>
    <div id="headerright"><?php $this->load->view('topmenu'); ?></div>
  </div>
  <div id="clearer"></div>
  <div id="content" class="kolom"><?php $this->load->view($content); ?>
  </div>
  <div id="sidemenu" class="kolom"><?php $this->load->view('sidebar'); ?></div>
  <div id="clearer">&nbsp;</div>
  <div id="footer"><?php $this->load->view('frontfooter'); ?></div>
</div>

</body>
</html>