<?php
/**
 *     News announcement scroll
 *     Copyright (C) 2011 - 2013 www.gopiplus.com
 * 
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 * 
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 * 
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

global $wpdb;
$Ann = "";

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
v_fontColorHover='#FFFFFF';
v_textDecorationHover='none';
v_top=0;
v_left=0;
v_width=<?php echo get_option('gNewsAnnouncementwidth'); ?>;
v_height=<?php echo get_option('gNewsAnnouncementheight'); ?>;
v_paddingTop=0;
v_paddingLeft=0;
v_position='relative';
v_timeout=<?php echo get_option('gNewsAnnouncementslidetimeout'); ?>;
v_slideSpeed=1;
v_slideDirection=<?php echo get_option('gNewsAnnouncementslidedirection'); ?>;
v_pauseOnMouseOver=true;
v_slideStep=1;
v_textAlign='<?php echo get_option('gNewsAnnouncementtextalign'); ?>';
v_textVAlign='<?php echo get_option('gNewsAnnouncementtextvalign'); ?>';
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
	<script language="JavaScript" src="<?php echo WP_G_NEWS_PLUGIN_URL; ?>/gAnnounce/gAnnounce.js"></script>
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
	<script language="JavaScript" src="<?php echo WP_G_NEWS_PLUGIN_URL; ?>/gAnnounce/gAnnounce.js"></script>
	</div>
	<?php 
} 
?>