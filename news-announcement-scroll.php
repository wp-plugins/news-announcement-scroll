<?php

/*
Plugin Name: news announcement scroll
Plugin URI: http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/
Description: This plug-in will create a vertical scroll news or Announcement for your word press site, we can embed this in site sidebar, Multi language support.
Version: 1
Author: Gopi.R
Author URI: http://www.gopiplus.com/
Donate link: http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/
*/

global $wpdb, $wp_version;
define("WP_G_NEWS_ANNOUNCEMENT", $wpdb->prefix . "news_announcement");

function news_announcement()
{
	include_once("gAnnounce/gAnnounce.php");
}

function news_announcement_activation()
{
	global $wpdb;
	
	//set the table
	if($wpdb->get_var("show tables like '". WP_G_NEWS_ANNOUNCEMENT . "'") != WP_G_NEWS_ANNOUNCEMENT) 
	{
		$wpdb->query("
			CREATE TABLE IF NOT EXISTS `". WP_G_NEWS_ANNOUNCEMENT . "` (
			  `gNews_id` int(11) NOT NULL auto_increment,
			  `gNews_text` text NOT NULL,
			  `gNews_order` int(11) NOT NULL default '0',
			  `gNews_status` char(3) NOT NULL default 'No',
			  `gNews_date` datetime NOT NULL default '0000-00-00 00:00:00',
			  PRIMARY KEY  (`gNews_id`) )
			");
	}
	$sSql = "ALTER TABLE ". WP_G_NEWS_ANNOUNCEMENT . " ADD `gNews_expiration` DATE NOT NULL"; 
	$wpdb->query($sSql);
	
	$sSql = "ALTER TABLE ". WP_G_NEWS_ANNOUNCEMENT . " CHANGE `gNews_text` `gNews_text` text ";
	$sSql = $sSql . "CHARACTER SET utf8 COLLATE utf8_bin NOT NULL ";
	$wpdb->query($sSql);
	
	add_option('gNewsAnnouncementtitle', "Announcement");
	add_option('gNewsAnnouncementfont', 'verdana,arial,sans-serif');
	add_option('gNewsAnnouncementfontsize', '11px');
	add_option('gNewsAnnouncementfontweight', 'normal');
	add_option('gNewsAnnouncementfontcolor', '#000000');
	add_option('gNewsAnnouncementwidth', '180');
	add_option('gNewsAnnouncementheight', '100');
	add_option('gNewsAnnouncementslidedirection', '0');
	add_option('gNewsAnnouncementslidetimeout', '3000');
	add_option('gNewsAnnouncementtextalign', 'center');
	add_option('gNewsAnnouncementtextvalign', 'middle');
	add_option('gNewsAnnouncementnoannouncement ', 'No announcement available');
	add_option('gNewsAnnouncementorder', '0');
}

function news_announcement_admin_options() 
{
	?>
    <div class="wrap">
    <?php
    $title = __('news announcement scroll');
    $mainurl = get_option('siteurl')."/wp-admin/options-general.php?page=news-announcement-scroll/news-announcement-scroll.php";
    ?>
    <h2><?php echo wp_specialchars( $title ); ?></h2>
    <?php
	global $wpdb;
    $AID=@$_GET["AID"];
    $AC=@$_GET["AC"];
    $rand=$_GET["rand"];
    $submittext = "Insert Announcement";
	if($AC <> "DEL" and trim($_POST['gNews_text']) <>"") { include_once("gAnnounce/gAnnounceins.php"); }
    if($AC=="DEL" && $rand == "76mv1ojtlele176mv1ojtlele1" && $AID > 0) { include_once("gAnnounce/gAnnouncedel.php"); }
    if($AID<>"" and $AC <> "DEL")
    {
        //select query
        $data = $wpdb->get_results("select * from ".WP_G_NEWS_ANNOUNCEMENT." where gNews_id=$AID limit 1");
        //bad feedback
        if ( empty($data) ) 
        {
            echo "";
            return;
        }
        $data = $data[0];
        //encode strings
        if ( !empty($data) ) $gNews_id_x = htmlspecialchars(stripslashes($data->gNews_id)); 
        if ( !empty($data) ) $gNews_text_x = htmlspecialchars(stripslashes($data->gNews_text));
        if ( !empty($data) ) $gNews_order_x = htmlspecialchars(stripslashes($data->gNews_order));
        if ( !empty($data) ) $gNews_status_x = htmlspecialchars(stripslashes($data->gNews_status));
		if ( !empty($data) ) $gNews_expiration_x = htmlspecialchars(stripslashes($data->gNews_expiration));
        $submittext = "Update Announcement";
    }
    ?>
    <?php include_once("gAnnounce/gAnnounceform.php"); ?>
    <?php include_once("gAnnounce/gAnnouncemanage.php"); ?>
</div>
    <?php
}

function widget_news_announcement($args) 
{
  extract($args);
  echo $before_widget;
  echo $before_title;
  echo get_option('gNewsAnnouncementtitle');
  echo $after_title;
  news_announcement();
  echo $after_widget;
}

function news_announcement_widget_control() 
{
	echo '<p>news announcement scroll.<br> To change the setting goto Announcement link under SETTING tab.';
	echo '<br><a href="options-general.php?page=news-announcement-scroll/setting.php">';
	echo 'click here</a></p>';

}


function news_announcement_plugins_loaded()
{
  	register_sidebar_widget(__('news announcement'), 'widget_news_announcement');   

	
	if(function_exists('register_sidebar_widget')) 
	{
		register_sidebar_widget('news announcement', 'widget_news_announcement');
	}
	
	if(function_exists('register_widget_control')) 
	{
		register_widget_control(array('news announcement', 'widgets'), 'news_announcement_widget_control', 560, 500);
	} 
}

function news_announcement_add_to_menu() 
{
	add_options_page('news announcement scroll', 'news announcement', 'manage_options', __FILE__, 'news_announcement_admin_options' );
	add_options_page('news announcement scroll', '', 'manage_options', 'news-announcement-scroll/setting.php','' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'news_announcement_add_to_menu');
}

function news_announcement_deactivate() 
{
	delete_option('gNewsAnnouncementtitle');
	delete_option('gNewsAnnouncementwidth');
	delete_option('gNewsAnnouncementfont');
	delete_option('gNewsAnnouncementheight');
	delete_option('gNewsAnnouncementfontsize');
	delete_option('gNewsAnnouncementslidedirection');
	delete_option('gNewsAnnouncementfontweight');
	delete_option('gNewsAnnouncementslidetimeout');
	delete_option('gNewsAnnouncementfontcolor');
	delete_option('gNewsAnnouncementtextalign');
	delete_option('gNewsAnnouncementtextvalign');
}

register_activation_hook(__FILE__, 'news_announcement_activation');
add_action('admin_menu', 'news_announcement_add_to_menu');
add_action("plugins_loaded", "news_announcement_plugins_loaded");
register_deactivation_hook( __FILE__, 'news_announcement_deactivate' );
?>