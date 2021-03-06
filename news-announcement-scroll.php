<?php
/*
Plugin Name: News announcement scroll
Plugin URI: http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/
Description: This plugin will create a vertical scroll news or Announcement for your word press site, we can embed this in site sidebar, Multi language support.
Version: 8.6
Author: Gopi Ramasamy
Author URI: http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/
Donate link: http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

global $wpdb, $wp_version, $gNews_db_version;
$gNews_db_version = "8.2";
define("WP_G_NEWS_ANNOUNCEMENT", $wpdb->prefix . "news_announcement");
define('WP_G_NEWS_FAV', 'http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/');

if ( ! defined( 'WP_G_NEWS_BASENAME' ) )
	define( 'WP_G_NEWS_BASENAME', plugin_basename( __FILE__ ) );
	
if ( ! defined( 'WP_G_NEWS_PLUGIN_NAME' ) )
	define( 'WP_G_NEWS_PLUGIN_NAME', trim( dirname( WP_G_NEWS_BASENAME ), '/' ) );
	
if ( ! defined( 'WP_G_NEWS_PLUGIN_URL' ) )
	define( 'WP_G_NEWS_PLUGIN_URL', WP_PLUGIN_URL . '/' . WP_G_NEWS_PLUGIN_NAME );
	
if ( ! defined( 'WP_G_NEWS_ADMIN_URL' ) )
	define( 'WP_G_NEWS_ADMIN_URL', get_option('siteurl') . '/wp-admin/options-general.php?page=news-announcement-scroll' );

function news_announcement()
{
	include_once("gAnnounce/gAnnounce.php");
}

function news_announcement_activation()
{
	global $wpdb, $gNews_db_version;;
	
	$gNews_pluginversion = "";
	$gNews_tableexists = "YES";
	$gNews_pluginversion = get_option("gNewspluginversion");
	
	if($wpdb->get_var("show tables like '". WP_G_NEWS_ANNOUNCEMENT . "'") != WP_G_NEWS_ANNOUNCEMENT)
	{
		$gNews_tableexists = "NO";
	}
	
	if(($gNews_tableexists == "NO") || ($gNews_pluginversion != $gNews_db_version)) 
	{
		$sSql = "CREATE TABLE ". WP_G_NEWS_ANNOUNCEMENT . " (
			 gNews_id mediumint(9) NOT NULL AUTO_INCREMENT,
			 gNews_text text NOT NULL,
			 gNews_order int(11) NOT NULL default '0',
			 gNews_status char(3) NOT NULL default 'YES',
			 gNews_date DATE DEFAULT '0000-00-00' NOT NULL,	
			 gNews_expiration DATE DEFAULT '0000-00-00' NOT NULL, 
			 gNews_type VARCHAR(100) DEFAULT 'GROUP1' NOT NULL,
			 UNIQUE KEY gNews_id (gNews_id)
		  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  		dbDelta( $sSql );
		
		//echo $sSql;
		
		if($gNews_pluginversion == "")
		{
			add_option('gNews_pluginversion', "8.3");
		}
		else
		{
			update_option( "gNews_pluginversion", $gNews_db_version );
		}
		
		if($gNews_tableexists == "NO")
		{
			$welcome_text = "This plug-in will create a vertical scrolling announcement news <br><br> This plug-in will create a vertical scrolling announcement news";	
			$welcome_text1 = "Dieses Plug-in wird ein vertikales Scrollen Ankündigung news";
			$rows_affected = $wpdb->insert( WP_G_NEWS_ANNOUNCEMENT , array( 'gNews_text' => $welcome_text, 'gNews_type' => 'WIDGET' ) );
			$rows_affected = $wpdb->insert( WP_G_NEWS_ANNOUNCEMENT , array( 'gNews_text' => $welcome_text1, 'gNews_type' => 'SAMPLE' ) );
		}
	}
	//die();
	add_option('gNewsAnnouncementtitle', "Announcement");
	add_option('gNewsAnnouncementfont', 'verdana,arial,sans-serif');
	add_option('gNewsAnnouncementfontsize', '11px');
	add_option('gNewsAnnouncementfontweight', 'normal');
	add_option('gNewsAnnouncementfontcolor', '#FF0000');
	add_option('gNewsAnnouncementwidth', '180');
	add_option('gNewsAnnouncementheight', '100');
	add_option('gNewsAnnouncementslidedirection', '0');
	add_option('gNewsAnnouncementslidetimeout', '3000');
	add_option('gNewsAnnouncementtextalign', 'center');
	add_option('gNewsAnnouncementtextvalign', 'middle');
	add_option('gNewsAnnouncementnoannouncement ', 'No announcement available');
	add_option('gNewsAnnouncementorder', '0');
	add_option('gNewsAnnouncementtype', 'widget');
}

function news_announcement_admin_options() 
{
	global $wpdb;
	$current_page = isset($_GET['ac']) ? $_GET['ac'] : '';
	switch($current_page)
	{
		case 'edit':
			include('pages/content-management-edit.php');
			break;
		case 'add':
			include('pages/content-management-add.php');
			break;
		case 'set':
			include('pages/content-setting.php');
			break;
		default:
			include('pages/content-management-show.php');
			break;
	}
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
	echo '<p>';
	_e('Check official website for more information', 'newsscroll');
	?> <a target="_blank" href="<?php echo WP_G_NEWS_FAV; ?>"><?php _e('click here', 'newsscroll'); ?></a></p><?php
}

function news_announcement_plugins_loaded()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget(__('News announcement scroll', 'newsscroll'), 
				__('News announcement scroll', 'newsscroll'), 'widget_news_announcement');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control(__('News announcement scroll', 'newsscroll'), 
				array(__('News announcement scroll', 'newsscroll'), 'widgets'), 'news_announcement_widget_control');
	} 
}

function news_announcement_add_to_menu() 
{
	add_options_page(__('News announcement scroll', 'newsscroll'), 
			__('News announcement scroll', 'newsscroll'), 'manage_options', 'news-announcement-scroll', 'news_announcement_admin_options' );
}

if (is_admin()) 
{
	add_action('admin_menu', 'news_announcement_add_to_menu');
}

function news_shortcode( $atts ) 
{
	global $wpdb;
	
	//$scode = $matches[1];
	
	$nas =  "";
	$Ann = "";
	
	//list($gNewsAnnouncementtype_main) = split("[:.-]", $scode);
	//[NEWS:TYPE=widget]
	//[news-announcement type="widget"]
	
	//list($gNewsAnnouncementtype_cap, $gNewsAnnouncementtype) = split('[=.-]', $scode);
	
	if ( ! is_array( $atts ) )
	{
		return '';
	}
	$gNewsAnnouncementtype = $atts['type'];
	
	$sSql = "SELECT * from ". WP_G_NEWS_ANNOUNCEMENT . " where gNews_status='YES'";
	$sSql = $sSql . " and (`gNews_date` <= NOW() or `gNews_date` = '0000-00-00')";
	$sSql = $sSql . " and (`gNews_expiration` >= NOW() or `gNews_expiration` = '0000-00-00')";
	
	if($gNewsAnnouncementtype <> "")
	{ 
		$sSql = $sSql . " and gNews_type='".$gNewsAnnouncementtype."'"; 
	}
	
	if( get_option('gNewsAnnouncementorder') == "1")
	{
		$sSql = $sSql . " ORDER BY rand()";
	}
	else
	{
		$sSql = $sSql . " ORDER BY gNews_order";
	}
	
	//echo $sSql;
	
	$data = $wpdb->get_results($sSql);
	
	$nas = $nas .'<script language="JavaScript" type="text/javascript">';
	$nas = $nas .'v_font="'.get_option('gNewsAnnouncementfont').'"; ';
	$nas = $nas .'v_fontSize="'.get_option('gNewsAnnouncementfontsize').'"; ';
	$nas = $nas .'v_fontSizeNS4="'.get_option('gNewsAnnouncementfontsize').'"; ';
	$nas = $nas .'v_fontWeight="'.get_option('gNewsAnnouncementfontweight').'"; ';
	$nas = $nas .'v_fontColor="'.get_option('gNewsAnnouncementfontcolor').'"; ';
	$nas = $nas .'v_textDecoration="none"; ';
	$nas = $nas .'v_fontColorHover="#FFFFFF"; ';
	$nas = $nas .'v_textDecorationHover="none"; ';
	$nas = $nas .'v_top=0;';
	$nas = $nas .'v_left=0;';
	$nas = $nas .'v_width='.get_option('gNewsAnnouncementwidth').'; ';
	$nas = $nas .'v_height='.get_option('gNewsAnnouncementheight').'; ';
	$nas = $nas .'v_paddingTop=0; ';
	$nas = $nas .'v_paddingLeft=0; ';
	$nas = $nas .'v_position="relative"; ';
	$nas = $nas .'v_timeout='.get_option('gNewsAnnouncementslidetimeout').'; ';
	$nas = $nas .'v_slideSpeed=1;';
	$nas = $nas .'v_slideDirection='.get_option('gNewsAnnouncementslidedirection').'; ';
	$nas = $nas .'v_pauseOnMouseOver=true; ';
	$nas = $nas .'v_slideStep=1; ';
	$nas = $nas .'v_textAlign="'.get_option('gNewsAnnouncementtextalign').'"; ';
	$nas = $nas .'v_textVAlign="'.get_option('gNewsAnnouncementtextvalign').'"; ';
	$nas = $nas .'v_bgColor="transparent"; ';
	$nas = $nas .'</script>';
	
	if ( ! empty($data) ) 
	{
		foreach ( $data as $data ) 
		{ 
			$Ann = $Ann . "['','".$data->gNews_text."',''],";
		}
		$Ann=substr($Ann,0,(strlen($Ann)-1));
	
		$nas = $nas .'<div style="padding-bottom:5px;padding-top:5px;">';
		$nas = $nas .'<script language="JavaScript" type="text/javascript">';
		$nas = $nas .'v_content=['.$Ann.']';
		$nas = $nas .'</script>';
		$nas = $nas .'<script language="JavaScript" src="'.get_option('siteurl').'/wp-content/plugins/news-announcement-scroll/gAnnounce/gAnnounce.js"></script>';
		$nas = $nas .'</div>';
	}
	return $nas;
}

function news_announcement_deactivate() 
{
	// No action required.
}


//function news_add_javascript_files() 
//{
//	if (!is_admin())
//	{
//		wp_enqueue_script( 'gAnnounce', get_option('siteurl').'/wp-content/plugins/news-announcement-scroll/gAnnounce/gAnnounce.js','','',true);
//	}	
//}
//
//add_action('init', 'news_add_javascript_files');

function news_announcement_textdomain() 
{
	  load_plugin_textdomain( 'newsscroll', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action('plugins_loaded', 'news_announcement_textdomain');
add_shortcode( 'news-announcement', 'news_shortcode' );
register_activation_hook(__FILE__, 'news_announcement_activation');
add_action("plugins_loaded", "news_announcement_plugins_loaded");
register_deactivation_hook( __FILE__, 'news_announcement_deactivate' );
?>