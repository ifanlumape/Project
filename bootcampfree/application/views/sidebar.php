<?php
echo heading('Popular', 2);
$list_popular = array();
foreach($populars as $popular)
{
	$list_popular[] = anchor('berita/detail/'.$popular->id_berita.'/'.seo_title($popular->judul), $popular->judul);
}

$attributes_popular = array(
                    'class' => 'boldlist',
                    'id'    => 'mylist'
                    );
echo ul($list_popular, $attributes_popular);

echo heading('Recent', 2);
$list_recent = array();
foreach($recents as $recent)
{
	$list_recent[] = anchor('berita/detail/'.$recent->id_berita.'/'.seo_title($recent->judul), $recent->judul);
}

$attributes_recent = array(
                    'class' => 'boldlist',
                    'id'    => 'mylist'
                    );
echo ul($list_recent, $attributes_recent);

echo heading('Tags', 2);
$list_tag = array();
foreach($tags as $tag)
{
	$image_properties = array(
          'src' => 'images/banner/'.$tag->gambar,
          'alt' => $tag->judul,
          'class' => 'banner_images',
          'width' => '100',
          'title' => $tag->judul,
          'rel' => 'lightbox',
);
	$list_tag[] = anchor($tag->url, img($image_properties));
}

$attributes_tag = array(
                    'class' => 'boldlist',
                    'id'    => 'mylist'
                    );
echo ul($list_tag, $attributes_tag);