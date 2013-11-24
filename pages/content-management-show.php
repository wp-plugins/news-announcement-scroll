<?php
// Form submitted, check the data
if (isset($_POST['frm_gNews_display']) && $_POST['frm_gNews_display'] == 'yes')
{
	$did = isset($_GET['did']) ? $_GET['did'] : '0';
	
	$gNews_success = '';
	$gNews_success_msg = FALSE;
	
	// First check if ID exist with requested ID
	$sSql = $wpdb->prepare(
		"SELECT COUNT(*) AS `count` FROM ".WP_G_NEWS_ANNOUNCEMENT."
		WHERE `gNews_id` = %d",
		array($did)
	);
	$result = '0';
	$result = $wpdb->get_var($sSql);
	
	if ($result != '1')
	{
		?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'newsscroll'); ?></strong></p></div><?php
	}
	else
	{
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
		{
			//	Just security thingy that wordpress offers us
			check_admin_referer('gNews_form_show');
			
			//	Delete selected record from the table
			$sSql = $wpdb->prepare("DELETE FROM `".WP_G_NEWS_ANNOUNCEMENT."`
					WHERE `gNews_id` = %d
					LIMIT 1", $did);
			$wpdb->query($sSql);
			
			//	Set success message
			$gNews_success_msg = TRUE;
			$gNews_success = __('Selected record was successfully deleted.', 'newsscroll');
		}
	}
	
	if ($gNews_success_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $gNews_success; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php _e('News announcement scroll', 'newsscroll'); ?>
	<a class="add-new-h2" href="<?php echo WP_G_NEWS_ADMIN_URL; ?>&amp;ac=add"><?php _e('Add New', 'newsscroll'); ?></a></h2>
    <div class="tool-box">
	<?php
		$sSql = "SELECT * FROM ".WP_G_NEWS_ANNOUNCEMENT." order by gNews_type, gNews_order";
		$myData = array();
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		?>
		<script language="JavaScript" src="<?php echo WP_G_NEWS_PLUGIN_URL; ?>/gAnnounce/gAnnounceform.js"></script>
		<script language="JavaScript" src="<?php echo WP_G_NEWS_PLUGIN_URL; ?>/gAnnounce/noenter.js"></script>
		<form name="frm_gNews_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th class="check-column" scope="row"><input type="checkbox" name="gNews_group_item[]" /></th>
			<th scope="col"><?php _e('News', 'newsscroll'); ?></th>
			<th scope="col"><?php _e('Order', 'newsscroll'); ?></th>
            <th scope="col"><?php _e('Status', 'newsscroll'); ?></th>
			<th scope="col"><?php _e('Group', 'newsscroll'); ?></th>
            <th scope="col"><?php _e('Expiration', 'newsscroll'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
            <th class="check-column" scope="row"><input type="checkbox" name="gNews_group_item[]" /></th>
			<th scope="col"><?php _e('News', 'newsscroll'); ?></th>
			<th scope="col"><?php _e('Order', 'newsscroll'); ?></th>
            <th scope="col"><?php _e('Status', 'newsscroll'); ?></th>
			<th scope="col"><?php _e('Group', 'newsscroll'); ?></th>
            <th scope="col"><?php _e('Expiration', 'newsscroll'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			$displayisthere = FALSE;
			foreach ($myData as $data)
			{
				if(strtoupper($data['gNews_status']) == 'YES') 
				{
					$displayisthere = TRUE; 
				}
				?>
				<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
					<td align="left"><input type="checkbox" value="<?php echo $data['gNews_id']; ?>" name="gNews_group_item[]"></th>
					<td>
					<?php echo esc_html(stripslashes($data['gNews_text'])); ?>
					<div class="row-actions">
					<span class="edit">
					<a title="Edit" href="<?php echo WP_G_NEWS_ADMIN_URL; ?>&amp;ac=edit&amp;did=<?php echo $data['gNews_id']; ?>"><?php _e('Edit', 'newsscroll'); ?></a> | </span>
					<span class="trash">
					<a onClick="javascript:gNews_delete('<?php echo $data['gNews_id']; ?>')" href="javascript:void(0);"><?php _e('Delete', 'newsscroll'); ?></a></span> 
					</div>
					</td>
					<td><?php echo esc_html(stripslashes($data['gNews_order'])); ?></td>
					<td><?php echo esc_html(stripslashes($data['gNews_status'])); ?></td>
					<td><?php echo esc_html(stripslashes($data['gNews_type'])); ?></td>
					<td><?php echo esc_html(stripslashes($data['gNews_expiration'])); ?></td>
				</tr>
				<?php 
				$i = $i+1; 
				} 
			?>
			<?php 
			if ($displayisthere == FALSE) 
			{ 
				?><tr><td colspan="6" align="center"><?php _e('No records available.', 'newsscroll'); ?></td></tr><?php 
			} 
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('gNews_form_show'); ?>
		<input type="hidden" name="frm_gNews_display" value="yes"/>
      </form>	
	  <div class="tablenav">
	  <h2>
	  <a class="button add-new-h2" href="<?php echo WP_G_NEWS_ADMIN_URL; ?>&amp;ac=add"><?php _e('Add New', 'newsscroll'); ?></a>
	  <a class="button add-new-h2" href="<?php echo WP_G_NEWS_ADMIN_URL; ?>&amp;ac=set"><?php _e('Widget setting', 'newsscroll'); ?></a>
	  <a class="button add-new-h2" target="_blank" href="<?php echo WP_G_NEWS_FAV; ?>"><?php _e('Help', 'newsscroll'); ?></a>
	  </h2>
	  </div>
	  <br />
	<h3><?php _e('Plugin configuration option', 'newsscroll'); ?></h3>
	<ol>
		<li><?php _e('Drag and drop the widget.', 'newsscroll'); ?></li>
		<li><?php _e('Add the plugin in the posts or pages using short code.', 'newsscroll'); ?></li>
		<li><?php _e('Add directly in to the theme using PHP code.', 'newsscroll'); ?></li>
	</ol>
	  <p class="description">
		<?php _e('Check official website for more information', 'newsscroll'); ?>
		<a target="_blank" href="<?php echo WP_G_NEWS_FAV; ?>"><?php _e('click here', 'newsscroll'); ?></a>
	  </p>
	</div>
</div>