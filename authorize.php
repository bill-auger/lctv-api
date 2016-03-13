<?php
/**
 * Authorize Livecoding.tv accounts.
 *
 * @package LctvApi\Authorize
 * @since 0.0.3
 */


/** Initialize. */
require( 'LctvApi.inc' );


if ( ( ! isset( $_GET['state'] ) || empty( $_GET['state'] ) ) &&
     ( ! isset( $_GET['code'] ) || empty( $_GET['code'] ) ) ) {
  if ( ! isset( $_GET['user'] ) || empty( $_GET['user'] ) ) {
?>
    <script type="text/javascript">
			var loc = window.location;
			var this_location = loc.protocol + "//" + loc.host + loc.pathname;

			do var user = prompt("Please enter your LCTV nick:", ""); while (user == null);
			window.location = this_location + "?user=" + user;
		</script>
<?php
		exit ;
  }
  else {
  	$auth_user = htmlspecialchars( $_GET['user'] );
  }
}
else {
	$auth_user = '';
}


/** Load the API. */
try {
	$lctv_api = new LctvApi( $auth_user );
}
catch(Exception $ex) {
	die($ex->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en-US">
	<head>
		<title>LCTV Badges Authorization</title>
	</head>
	<body style="font-family:Helvetica,Arial,sans-serif;font-size:15px;font-weight:400;color:#111;">


<?php define(TRACE , false) ;
if ( TRACE ) { ?>
// begin DEBUG
<pre>constants
* <?php echo "LCTV_CLIENT_ID        = '" . LCTV_CLIENT_ID        . "'\n" ?>
* <?php echo "LCTV_CLIENT_SECRET    = '" . LCTV_CLIENT_SECRET    . "'\n" ?>
* <?php echo "LCTV_REDIRECT_URL     = '" . LCTV_REDIRECT_URL     . "'\n" ?>
* <?php echo "LCTVAPI_STORAGE_CLASS = '" . LCTVAPI_STORAGE_CLASS . "'\n" ?>
* <?php echo "LCTV_MASTER_USER      = '" . LCTV_MASTER_USER      . "'\n" ?>
</pre>
<pre>params
<?php $is_state_set   = isset( $_GET['state'] ) ? "true" : "false";  ?>
<?php $is_state_empty = empty( $_GET['state'] ) ? "true" : "false" ; ?>
<?php $is_code_set    = isset( $_GET['code'] ) ? "true" : "false";   ?>
<?php $is_code_empty  = empty( $_GET['code'] ) ? "true" : "false" ;  ?>
<?php $is_user_set    = isset( $_GET['user'] ) ? "true" : "false";   ?>
<?php $is_user_empty  = empty( $_GET['user'] ) ? "true" : "false" ;  ?>
* <?php echo "isset(_GET['state']) = $is_state_set\n";               ?>
* <?php echo "empty(_GET['state']) = $is_state_empty\n";             ?>
* <?php echo "isset(_GET['code'])  = $is_code_set\n";                ?>
* <?php echo "empty(_GET['code'])  = $is_code_empty\n";              ?>
* <?php echo "isset(_GET['user'])  = $is_user_set\n";                ?>
* <?php echo "empty(_GET['user'])  = $is_user_empty\n";              ?>
* <?php echo "user=$auth_user\n";                                    ?>
</pre>
<?php $client_id     = (isset($lctv_api->client_id    )) ? $lctv_api->client_id     : "unset" ; ?>
<?php $client_secret = (isset($lctv_api->client_secret)) ? $lctv_api->client_secret : "unset" ; ?>
<?php $data_store    = (isset($lctv_api->data_store   )) ? $lctv_api->data_store    : "unset" ; ?>
<?php $redirect_url  = (isset($lctv_api->redirect_url )) ? $lctv_api->redirect_url  : "unset" ; ?>
<?php $scope         = (isset($lctv_api->scope        )) ? $lctv_api->scope         : "unset" ; ?>
<?php $auth_user     = (isset($lctv_api->auth_user    )) ? $lctv_api->auth_user     : "unset" ; ?>
<pre>library
* <?php echo "lctv_api->client_id     = '$client_id'\n"                    ?>
* <?php echo "lctv_api->client_secret = '$client_secret'\n"                ?>
* <?php echo "lctv_api->redirect_url  = '$redirect_url'\n"                 ?>
* <?php echo "lctv_api->data_store    = '" . LCTVAPI_STORAGE_CLASS . "'\n" ?>
* <?php echo "lctv_api->scope         = '$scope'\n"                        ?>
* <?php echo "lctv_api->auth_user     = '$auth_user'\n"                    ?>
</pre>
<?php
$is_set= isset($lctv_api->token) ;
$is_empty = empty($lctv_api->token) ;
$token_dump = var_export($lctv_api->token , true) ;
$token = ( ($is_set) ? (($is_empty) ? "empty" : $token_dump): "unset") ;
$access_token = ((isset( $lctv_api->token) && isset( $lctv_api->token->access_token ) ) ? $lctv_api->token->access_token : "unset") ;
?>
<pre>tokens
* <?php echo "token=$token"; ?>\n
* <?php echo "access_token=$access_token"; ?>\n
* <?php echo "LCTVAPI_STORAGE_PATH=" . LCTVAPI_STORAGE_PATH; ?>\n
</pre>
// end DEBUG
<?php } ?>


		<div style="padding:20px;width:600px;margin:0 auto;">
		<?php if ( ! $lctv_api->is_authorized() ) : ?>
			<h1 style="font-size:24px;font-weight:400;">Authorize</h1>
			<p>LCTV Badges use the Livecoding.tv API to get their relevant stats.
					Badges that display data from public API endpoints require only the site admin to authorize this site.
					Badges that display data from private API endpoints require each target user to authorize this site.
					Vistors to the site will not need to authorize.
					Authorize account access with the link below.</p>
			<p><a href="<?php echo $lctv_api->get_authorization_url(); ?>">Connect your account</a></p>
			<br><br>
			<h1 style="font-size:24px;font-weight:400;">Remove Authorization</h1>
			<?php if ( isset( $_GET['user'] ) && isset( $_GET['delete'] ) ) : ?>
				<p>The account &ldquo;<?php echo htmlspecialchars( $_GET['user'] ); ?>&rdquo; has been disconnected.</p>
			<?php else : ?>
				<p>This site saves an authorization token to access your Livecoding.tv account. You may delete this token so as to stop this site from further accessing your account information.</p>
				<p>To disconnect your account, first connect your account with the link above, even if you have previously done so. After authorization a disconnect link will appear.</p>
			<?php endif; ?>
		<?php else : ?>
			<h1 style="font-size:24px;font-weight:400;">Authorize</h1>
			<p>The account &ldquo;<?php echo htmlspecialchars( $lctv_api->auth_user ); ?>&rdquo; is now connected.</p>
			<br><br>
			<h1 style="font-size:24px;font-weight:400;">Remove Authorization</h1>
			<p>This site saves an authorization token to access your Livecoding.tv account. You may delete this token so as to stop this site from further accessing your account information with the link below.</p>
			<p><a href="<?php echo $lctv_api->redirect_url; ?>?user=<?php echo urlencode( $lctv_api->auth_user ); ?>&delete=<?php echo urlencode( $lctv_api->token->delete_id ); ?>">Disconnect your account</a></p>
		<?php endif; ?>
			<br><br>
			<p><a href="./">Return Home</a></p>
		</div>
	</body>
</html>
<?php
