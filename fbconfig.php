<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret
FacebookSession::setDefaultApplication( '870921566338838','87d2199d67241efd2c733ae7d8b80df8' );
// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper("http://localhost/readly/fbconfig.php");
    //$helper = new FacebookRedirectLoginHelper('fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me?locale=en_US&fields=id,name,email' );
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
        $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
      $retrieve_FB_user_data_sql = "SELECT * FROM users WHERE name = '" . $fbfullname . "'";
               $res_tmp = mysql_query($retrieve_FB_user_data_sql);
               if(mysql_num_rows($res_tmp) > 0) {
                  while($tmp = mysql_fetch_assoc($res_tmp)) {
                     $_SESSION['current_user_id'] = $tmp['id'];
                  }
               }
    /* ---- header location after session ----*/
  header("Location: homepage.php");
} else {
  $loginUrl = $helper->getLoginUrl(array('scope' => 'email, public_profile,user_friends'));
 //header("Location: ".$loginUrl);
  header("Location: " . $loginUrl);
}
?>