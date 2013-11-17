<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="robots" content="index, follow">
<meta name="description" content="<?php $this->load->view('dina_meta1'); ?>">
<meta name="keywords" content="<?php $this->load->view('dina_meta2'); ?>">
<meta name="revisit-after" content="7">
<meta name="webcrawlers" content="all">
<meta name="spiders" content="all">

<title><?php $this->load->view('dina_titel'); ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="rss.xml" />

<link rel="stylesheet" href="<?php echo base_url(); ?>css/stylebox.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>css/pageNavi.css" type="text/css" /> 
<link rel="stylesheet" href="<?php echo base_url(); ?>css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/css/jquery.snippet.min.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.4.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.snippet.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $("pre").snippet("php",{style:"acid"});
  });
</script>
   
<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryslidemenu.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.prettyPhoto.js"></script>

<![if !IE]>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.preloader.js" ></script>
<script type="text/javascript">
    $(document).ready(function (){ 
    $("#gallery").preloader({
    });
    $("#post .thumb").preloader({
    });
  
    }); 
</script>
<![endif]>
<script type="text/javascript">
$(document).ready(function() {  
            $('.gallery img, #gallery img').each(function() {
                $(this).hover(
                    function() {
                        $(this).stop().animate({ opacity: 0.6 }, 200);
                    },
                   function() {
                       $(this).stop().animate({ opacity: 1.0 }, 200);
                   })
                });
});
</script>

</head>
<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div id="header">
        <div class="inner" style="z-index:205;">
    		<div id="logo">
    		  
                <?php $w=$this->db->query("select alamat_website from identitas")->row(); ?>

            	  <a href="<?php echo $w->alamat_website; ?>">
                	<img src="<?php echo base_url(); ?>/images/logo.png" />
                </a>
            </div><!-- END #logo -->
            
            <div id="navigation" class="jqueryslidemenu">
                <ul>
                <?php              
                $main = $this->db->query("SELECT * FROM mainmenu WHERE aktif = 'Y'")->result();
    
                foreach($main as $r) {
                    echo '<li>';
						echo '<a href="'.$r->link.'">'.$r->nama_menu.'</a>';
                    
					$sub = $this->db->query("SELECT * FROM submenu, mainmenu 
          WHERE submenu.id_main = mainmenu.id_main AND submenu.id_main ='".$r->id_main."' AND submenu.aktif='Y'");
                    $jml = $sub->num_rows();
                    // apabila sub menu ditemukan
                    if($jml > 0) {
                       	echo '<ul>';
                       	foreach($sub->result() as $w){
                           	echo '<li>';
								echo '<a href="'.$w->link_sub.'">'.$w->nama_sub.'</a>';
							echo '</li>';
                       	}           
                       	echo '</ul>';
						echo '</li>';
                    } else {
                        echo '</li>';
                    }
                }
                ?>
                </ul>
            </div><!-- END #navigation -->
            
    </div><!-- END .inner -->
        <div class="strife"></div>
	</div><!-- END #header -->
