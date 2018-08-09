<?php
if ( ! defined( 'ABSPATH' ) ) exit;

$_POST = stripslashes_deep($_POST);
$_GET = stripslashes_deep($_GET);

$xyz_em_campId = intval($_GET['id']);
if (
		! isset( $_REQUEST['_wpnonce'] )
		|| ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'campaign_status_'.$xyz_em_campId )
) {

	wp_nonce_ays( 'campaign_status_'.$xyz_em_campId );

	exit();

}
global $wpdb;
$xyz_em_campStatus = intval($_GET['status']);
$xyz_em_pageno = intval($_GET['pageno']);

if($xyz_em_campId=="" || !is_numeric($xyz_em_campId)){
	header("Location:".admin_url('admin.php?page=newsletter-manager-manage-campaigns'));
	?><script>
						document.location.href="admin.php?page=newsletter-manager-manage-campaigns";
						</script>
						<?php
						
	exit();
}
$campCount = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$wpdb->prefix."xyz_em_email_campaign WHERE id= %d",$xyz_em_campId) ) ;
if(count($campCount)==0){
	header("Location:".admin_url('admin.php?page=newsletter-manager-manage-campaigns'));
	?><script>
	document.location.href="admin.php?page=newsletter-manager-manage-campaigns";
	</script>
	<?php
	exit();
}else{
	if($xyz_em_campStatus == 0){
	$xyz_em_status = 0;
	}elseif($xyz_em_campStatus == 1){
		$xyz_em_status = 1;
	}
	$wpdb->update($wpdb->prefix.'xyz_em_email_campaign', array('status'=>$xyz_em_status), array('id'=>$xyz_em_campId));	
	header("Location:".admin_url('admin.php?page=newsletter-manager-manage-campaigns&pagenum='.$xyz_em_pageno));
	?><script>
						document.location.href="admin.php?page=newsletter-manager-manage-campaigns&pagenum=<?php echo $xyz_em_pageno?>";
						</script>
						<?php
	exit();

}
?>
