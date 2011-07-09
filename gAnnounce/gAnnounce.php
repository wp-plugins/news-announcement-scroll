<?php

//############################################################################################################
//###### Project   : news announcement scroll  															######
//###### File Name : gAnnounce.php                   													######
//###### Purpose   : To display vertical scroll news at front end										######
//###### Date      : 07-07-2011                  														######
//###### Author    : Gopi.R                        														######
//############################################################################################################


global $wpdb;

$gNewsAnnouncementtype = get_option('gNewsAnnouncementtype');

$sSql = "SELECT * from ". WP_G_NEWS_ANNOUNCEMENT . " where gNews_status='Yes' and (`gNews_expiration` >= NOW() or `gNews_expiration` = '0000-00-00')";

if($gNewsAnnouncementtype <> "")
{
	$sSql = $sSql . " and gNews_type='".$gNewsAnnouncementtype."'";
}

if( get_option('gNewsAnnouncementorder') == "1")
{
	$sSql = $sSql . " ORDER BY rand( )";
}
else
{
	$sSql = $sSql . " ORDER BY gNews_order";
}

$data = $wpdb->get_results($sSql);

?>
<script language="JavaScript" type="text/javascript">
	v_font='<?php echo get_option('gNewsAnnouncementfont'); ?>';
	v_fontSize='<?php echo get_option('gNewsAnnouncementfontsize'); ?>';
	v_fontSizeNS4='<?php echo get_option('gNewsAnnouncementfontsize'); ?>';
	v_fontWeight='<?php echo get_option('gNewsAnnouncementfontweight'); ?>';
	v_fontColor='<?php echo get_option('gNewsAnnouncementfontcolor'); ?>';
	v_textDecoration='none';
	v_fontColorHover='#FFFFFF';//		| won't work
	v_textDecorationHover='none';//	    | in Netscape4
	v_top=0;//	|
	v_left=0;//	| defining
	v_width=<?php echo get_option('gNewsAnnouncementwidth'); ?>;//	| the box
	v_height=<?php echo get_option('gNewsAnnouncementheight'); ?>;//	|
	v_paddingTop=0;
	v_paddingLeft=0;
	v_position='relative';// absolute/relative
	v_timeout=<?php echo get_option('gNewsAnnouncementslidetimeout'); ?>;//1000 = 1 second
	v_slideSpeed=1;
	v_slideDirection=<?php echo get_option('gNewsAnnouncementslidedirection'); ?>;//0=down-up;1=up-down
	v_pauseOnMouseOver=true;// v2.2+ new below
	v_slideStep=1;//pixels
	v_textAlign='<?php echo get_option('gNewsAnnouncementtextalign'); ?>';// left/center/right
	v_textVAlign='<?php echo get_option('gNewsAnnouncementtextvalign'); ?>';// top/middle/bottom - won't work in Netscape4
	v_bgColor='transparent';
</script>
<?php

if ( ! empty($data) ) 
{
	foreach ( $data as $data ) 
	{ 
		$Ann = $Ann . "['','".$data->gNews_text."',''],";
	}
	$Ann=substr($Ann,0,(strlen($Ann)-1));
	?>
	<div>
    <script language="JavaScript" type="text/javascript">
	v_content=[<?php echo $Ann; ?>]
	</script>
	<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/news-announcement-scroll/gAnnounce/gAnnounce.js"></script>
	</div>
	<?php 
}
else
{
	?>
	<div>
	<script language="JavaScript" type="text/javascript">
	v_content=[['','<?php echo get_option('gNewsAnnouncementnoannouncement'); ?>',''],['','<?php echo get_option('gNewsAnnouncementnoannouncement'); ?>','']]
	</script>
	<script language="JavaScript" src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/news-announcement-scroll/gAnnounce/gAnnounce.js"></script>
	</div>
<?php 
} 
?>
