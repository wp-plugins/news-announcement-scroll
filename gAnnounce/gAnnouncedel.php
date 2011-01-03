<?php
//############################################################################################################
//###### Project   : news announcement scroll  															######
//###### File Name : gAnnouncedel.php                   												######
//###### Purpose   : To delete the Announcement record from database									######
//###### Date      : Jan 1st 2011                  														######
//###### Author    : Gopi.R                        														######
//############################################################################################################

$wpdb->get_results("delete from ".WP_G_NEWS_ANNOUNCEMENT." where gNews_id=".$AID);

?>