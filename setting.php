<div class="wrap">
  <h2><?php echo wp_specialchars( 'news announcement scroll' ); ?></h2>
  <?php
global $wpdb, $wp_version;

$gNewsAnnouncementtitle = get_option('gNewsAnnouncementtitle');
$gNewsAnnouncementwidth = get_option('gNewsAnnouncementwidth');
$gNewsAnnouncementfont = get_option('gNewsAnnouncementfont');
$gNewsAnnouncementheight = get_option('gNewsAnnouncementheight');
$gNewsAnnouncementfontsize = get_option('gNewsAnnouncementfontsize');
$gNewsAnnouncementslidedirection = get_option('gNewsAnnouncementslidedirection');
$gNewsAnnouncementfontweight = get_option('gNewsAnnouncementfontweight');
$gNewsAnnouncementslidetimeout = get_option('gNewsAnnouncementslidetimeout');
$gNewsAnnouncementfontcolor = get_option('gNewsAnnouncementfontcolor');
$gNewsAnnouncementtextalign = get_option('gNewsAnnouncementtextalign');
$gNewsAnnouncementtextvalign = get_option('gNewsAnnouncementtextvalign');
$gNewsAnnouncementnoannouncement = get_option('gNewsAnnouncementnoannouncement');
$gNewsAnnouncementorder = get_option('gNewsAnnouncementorder');

if ($_POST['gNewsAnnouncementsubmit']) 
{	
	$gNewsAnnouncementtitle = stripslashes($_POST['gNewsAnnouncementtitle']);
	$gNewsAnnouncementwidth = stripslashes($_POST['gNewsAnnouncementwidth']);
	$gNewsAnnouncementfont = stripslashes($_POST['gNewsAnnouncementfont']);
	$gNewsAnnouncementheight = stripslashes($_POST['gNewsAnnouncementheight']);
	$gNewsAnnouncementfontsize = stripslashes($_POST['gNewsAnnouncementfontsize']);
	$gNewsAnnouncementslidedirection = stripslashes($_POST['gNewsAnnouncementslidedirection']);
	$gNewsAnnouncementfontweight = stripslashes($_POST['gNewsAnnouncementfontweight']);
	$gNewsAnnouncementslidetimeout = stripslashes($_POST['gNewsAnnouncementslidetimeout']);
	$gNewsAnnouncementfontcolor = stripslashes($_POST['gNewsAnnouncementfontcolor']);
	$gNewsAnnouncementtextalign = stripslashes($_POST['gNewsAnnouncementtextalign']);
	$gNewsAnnouncementtextvalign = stripslashes($_POST['gNewsAnnouncementtextvalign']);
	$gNewsAnnouncementnoannouncement = stripslashes($_POST['gNewsAnnouncementnoannouncement']);
	$gNewsAnnouncementorder = stripslashes($_POST['gNewsAnnouncementorder']);
	
	update_option('gNewsAnnouncementtitle', $gNewsAnnouncementtitle );
	update_option('gNewsAnnouncementwidth', $gNewsAnnouncementwidth );
	update_option('gNewsAnnouncementfont', $gNewsAnnouncementfont );
	update_option('gNewsAnnouncementheight', $gNewsAnnouncementheight );
	update_option('gNewsAnnouncementfontsize', $gNewsAnnouncementfontsize );
	update_option('gNewsAnnouncementslidedirection', $gNewsAnnouncementslidedirection );
	update_option('gNewsAnnouncementfontweight', $gNewsAnnouncementfontweight );
	update_option('gNewsAnnouncementslidetimeout', $gNewsAnnouncementslidetimeout );
	update_option('gNewsAnnouncementfontcolor', $gNewsAnnouncementfontcolor );
	update_option('gNewsAnnouncementtextalign', $gNewsAnnouncementtextalign );
	update_option('gNewsAnnouncementtextvalign', $gNewsAnnouncementtextvalign );
	update_option('gNewsAnnouncementnoannouncement', $gNewsAnnouncementnoannouncement );
	update_option('gNewsAnnouncementorder', $gNewsAnnouncementorder );
}
?>
  <div align="left" style="padding-top:5px;padding-bottom:5px;"> 
  <a href="options-general.php?page=news-announcement-scroll/news-announcement-scroll.php">Manage Page</a> 
  <a href="options-general.php?page=news-announcement-scroll/setting.php">Setting Page</a> </div>

  <form name="form_gAnnounce" method="post" action="">
    <table width='99%' border='0' cellspacing='0' cellpadding='3'>
      <tr>
        <td width='242'>&nbsp;</td>
        <td width='14'>&nbsp;</td>
        <td width='632'>&nbsp;</td>
        <td width='36' rowspan="12" align="center" valign="top"><?php if (function_exists (timepass)) timepass(); ?></td>
      </tr>
      <tr>
        <td>Title:</td>
        <td>&nbsp;</td>
        <td>Width (only number):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementtitle' type='text' id='gNewsAnnouncementtitle'  value='<?php echo $gNewsAnnouncementtitle; ?>' size="30" maxlength="100" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementwidth' type='text' id='gNewsAnnouncementwidth'  value='<?php echo $gNewsAnnouncementwidth; ?>' size="30" maxlength="3" /></td>
      </tr>
      <tr>
        <td>Font: </td>
        <td>&nbsp;</td>
        <td>Height (only number):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementfont'  type='text' id='gNewsAnnouncementfont' value='<?php echo $gNewsAnnouncementfont; ?>' size="30" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementheight' type='text' id='gNewsAnnouncementheight'  value='<?php echo $gNewsAnnouncementheight; ?>' size="30" maxlength="3" /></td>
      </tr>
      <tr>
        <td>Font Size(Ex:13px):</td>
        <td>&nbsp;</td>
        <td>Slide Direction(0=down-up;1=up-down:)</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementfontsize' type='text' id='gNewsAnnouncementfontsize'  value='<?php echo $gNewsAnnouncementfontsize; ?>' size="30" maxlength="6" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementslidedirection' type='text' id='gNewsAnnouncementslidedirection'  value='<?php echo $gNewsAnnouncementslidedirection; ?>' size="30" maxlength="1" /></td>
      </tr>
      <tr>
        <td>Font Weight(blod/normal):</td>
        <td>&nbsp;</td>
        <td>Slide Timeout (1000=1 second):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementfontweight' type='text' id='gNewsAnnouncementfontweight'  value='<?php echo $gNewsAnnouncementfontweight; ?>' size="30" maxlength="10" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementslidetimeout' type='text' id='gNewsAnnouncementslidetimeout'  value='<?php echo $gNewsAnnouncementslidetimeout; ?>' size="30" maxlength="5" /></td>
      </tr>
      <tr>
        <td>Font Color (Ex: #000000):</td>
        <td>&nbsp;</td>
        <td>Text Valign (top/middle/bottom):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementfontcolor' type='text' id='gNewsAnnouncementfontcolor'  value='<?php echo $gNewsAnnouncementfontcolor; ?>' size="30" maxlength="20" /></td>
        <td>&nbsp;</td>
        <td><input name='gNewsAnnouncementtextvalign' type='text' id='gNewsAnnouncementtextvalign'  value='<?php echo $gNewsAnnouncementtextvalign; ?>' size="30" maxlength="6" /></td>
      </tr>
      <tr>
        <td>No Announcement Text:</td>
        <td>&nbsp;</td>
        <td>Text Alignt (left/center/right/justify):</td>
      </tr>
      <tr>
        <td><input name='gNewsAnnouncementnoannouncement' type='text' id='gNewsAnnouncementnoannouncement'  value='<?php echo $gNewsAnnouncementnoannouncement; ?>' size="30" maxlength="200" /></td>
        <td>&nbsp;</td>
        <td>
		<input name='gNewsAnnouncementtextalign' type='text' id='gNewsAnnouncementtextalign'  value='<?php echo $gNewsAnnouncementtextalign; ?>' size="30" maxlength="8" /></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3">Announcement Order </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><input name='gNewsAnnouncementorder' type='text' id='gNewsAnnouncementorder'  value='<?php echo $gNewsAnnouncementorder; ?>' size="10" maxlength="1" />
        ( 0 = Display order(it is available in manage page link), 1= Random Order) </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="40" colspan="3" align="left" valign="bottom"><input name="gNewsAnnouncementsubmit" id="gNewsAnnouncementsubmit" lang="publish" class="button-primary" value="Update Setting" type="submit" /></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
  <h2><?php echo wp_specialchars( 'Paste the below code to your desired template location!' ); ?></h2>
  <div style="padding-top:7px;padding-bottom:7px;"> <code style="padding:7px;"> &lt;?php if (function_exists (news_announcement)) news_announcement(); ?&gt; </code></div>
  <div align="left" style="padding-top:8px;padding-bottom:8px;"> 
  <a href="options-general.php?page=news-announcement-scroll/news-announcement-scroll.php">Manage Page</a> 
  <a href="options-general.php?page=news-announcement-scroll/setting.php">Setting Page</a> </div>
  Click manage page link to add/update/delete announcement. <br> 
  <h2><?php echo wp_specialchars( 'About Plugin' ); ?></h2>
  Plug-in created by <a target="_blank" href='http://www.gopiplus.com/'>Gopi</a>. <br> 
  <a target="_blank" href='http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/'>Click here</a> to post suggestion or comments or feedback. <br> 
  <a target="_blank" href='http://www.gopiplus.com/work/2011/01/01/news-announcement-scroll/'>Click here</a> to see live demo. <br> 
  <a target="_blank" href='http://www.gopiplus.com/work/plugin-list/'>Click here</a> to download my other plugins. <br> 
  <br>
</div>
