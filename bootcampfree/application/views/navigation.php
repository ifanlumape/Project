<ul id="menu_tab">
	<li id="tab_adminhome"><?php echo anchor('adminhome', 'Home'); ?>	
<?php 
if($this->session->userdata('level') == 'admin')
{
?>
    <li id="tab_agenda">
	<?php echo anchor('agenda', 'Agenda'); ?>
    </li>
    <li id="tab_banner">
	<?php echo anchor('banner', 'Banner'); ?>
    </li>
    <li id="tab_berita">
	<?php echo anchor('berita', 'Berita') ?>
    </li>
    <li id="tab_halaman">
	<?php echo anchor('halaman', 'Halaman'); ?>
    </li>    
    <li id="tab_hubungi">
	<?php echo anchor('hubungi', 'Hubungi'); ?>
    </li>  
    <li id="tab_download">
    <?php echo anchor('download', 'Download'); ?>
    </li>
    <li id="tab_album">
	<?php echo anchor('album', 'Album'); ?>
    </li>
    <li id="tab_galery">
	<?php echo anchor('gallery', 'Gallery'); ?>
    </li>
	<li id="tab_users">
	<?php echo anchor('users', 'Users');?>
    </li>    

<?php 
}
else
{
?>
    <li id="tab_berita">
	<?php echo anchor('berita', 'Berita') ?>
    </li>  
    <li id="tab_jadwal">
	<?php echo anchor('album', 'Album'); ?>
    </li>
    <li id="tab_permintaandoa">
	<?php echo anchor('gallery', 'Gallery'); ?>
    </li>
    <li id="tab_permintaanperkunjungan">
	<?php echo anchor('agenda', 'Agenda'); ?>
    </li>
    <li id="tab_renungan">
    <?php echo anchor('banner', 'Banner'); ?>
    </li>    
	<li id="tab_users">
	<?php echo anchor('users', 'Users');?>
    </li>    
 
<?php 
}
?>
	<li id="tab_logout"><?php echo anchor('users/process_logout', 'Logout', array('onclick' => "return confirm('Anda yakin akan logout?')"));?></li>
</ul>