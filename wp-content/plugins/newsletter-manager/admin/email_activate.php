<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
$_POST = stripslashes_deep($_POST);
$_GET = stripslashes_deep($_GET);

$xyz_em_emailId = intval($_GET['id']);
if (
		! isset( $_REQUEST['_wpnonce'] )
		|| ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'email_activate_'.$xyz_em_emailId )
) {
	wp_nonce_ays( 'email_activate_'.$xyz_em_emailId );

	exit();

} 
$xyz_em_pageno = intval($_GET['pageno']);
$xyz_em_search = '';
if(isset($_GET['search']))
	$xyz_em_search = trim($_GET['search']);

if($xyz_em_emailId=="" || !is_numeric($xyz_em_emailId)){
	header("Location:".admin_url('admin.php?page=newsletter-manager-manage-emails'));
	?>
	<script>
	document.location.href="admin.php?page=newsletter-manager-manage-emails";
	</script>
	<?php
	
	exit();

}
$emailCount = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_email_address WHERE id= %d",$xyz_em_emailId) ) ;

if(count($emailCount) == 0){
	header("Location:".admin_url('admin.php?page=newsletter-manager-manage-emails'));
	?>
	<script>
	document.location.href="admin.php?page=newsletter-manager-manage-emails" ;
	</script>
	<?php
	
	exit();
}else{
	$xyz_em_status = 1;
	$time = time();
	
	$wpdb->update($wpdb->prefix.'xyz_em_address_list_mapping', array('status'=>$xyz_em_status,'last_update_time'=>$time), array('ea_id'=>$xyz_em_emailId));
	
	//$wpdb->query( 'UPDATE  '.$wpdb->prefix.'xyz_em_address_list_mapping SET status="'.$xyz_em_status.'" WHERE ea_id="'.$xyz_em_emailId.'" ' ) ;
	if($xyz_em_search=='')
	{
		header("Location:".admin_url('admin.php?page=newsletter-manager-manage-emails&emailmsg=5&pagenum='.$xyz_em_pageno));
	?>
	<script>
	document.location.href="admin.php?page=newsletter-manager-manage-emails&emailmsg=5&pagenum=<?php echo $xyz_em_pageno ?>" ;
	</script>
	<?php
	}
	else
	{
		header("Location:".admin_url('admin.php?page=newsletter-manager-searchemails&search='.$xyz_em_search));
		?>
		<script>
		document.location.href="admin.php?page=newsletter-manager-searchemails&search=<?php echo $xyz_em_search ?>" ;
		</script>
		<?php
		exit();
	}
	

}

?>
