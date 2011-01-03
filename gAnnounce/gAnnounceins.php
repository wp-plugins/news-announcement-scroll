<?php
//############################################################################################################
//###### Project   : news announcement scroll  															######
//###### File Name : gAnnounceins.php                   												######
//###### Purpose   : To insert & update the Announcement record to database								######
//###### Date      : Jan 1st 2011                  														######
//###### Author    : Gopi.R                        														######
//############################################################################################################



if(trim($_POST['gNews_id']) == "" )
{
	$sql = "insert into ".WP_G_NEWS_ANNOUNCEMENT
			. " set `gNews_text`='" . mysql_real_escape_string(trim($_POST['gNews_text']))
			. "', `gNews_order`='" . mysql_real_escape_string(trim($_POST['gNews_order']))
			. "', `gNews_status`='" . mysql_real_escape_string(trim($_POST['gNews_status']))
			. "', `gNews_expiration`='" . mysql_real_escape_string(trim($_POST['gNews_expiration']))
			. "', `gNews_date`=NOW();";
}
else
{
	$sql = "update ".WP_G_NEWS_ANNOUNCEMENT
			. " set `gNews_text`='" . mysql_real_escape_string(trim($_POST['gNews_text']))
			. "', `gNews_order`='" . mysql_real_escape_string(trim($_POST['gNews_order']))
			. "', `gNews_status`='" . mysql_real_escape_string(trim($_POST['gNews_status']))
			. "', `gNews_expiration`='" . mysql_real_escape_string(trim($_POST['gNews_expiration']))
			. "', `gNews_date`=NOW() where gNews_id=".$_POST['gNews_id'].";";

}
$wpdb->get_results($sql);
?>