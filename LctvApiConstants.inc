<?php

define( 'CREDENTIALS_FILE' , 'LctvApiCredentials.inc' ) ;
define( 'AUTHORIZE_FILE'   , 'authorize.php'          ) ;

define( 'NOT_AUTHORIZED_MSG'     , 'This app is not yet authorized with the livecoding.tv API and no ' . CREDENTIALS_FILE . ' was found.  This file must exist in order to use this class.  You can create this file using ' . CREDENTIALS_FILE . '.example as a reference and then initialize the API by browsing to ' . AUTHORIZE_FILE . '.' ) ;
define( 'CURL_NOT_FOUND_MSG'     , 'This library requires that curl be available on this server.' ) ;
define( 'CONSTANT_UNDEFINED_MSG' , 'This app is not yet authorized with the livecoding.tv API.  This constant must be defined in ' . CREDENTIALS_FILE . '.  Undefined constant: ' ) ;
define( 'MYSQL_UNSUPPORTED_MSG'  , 'The version of PHP on this system does not support MySql.  This is required to use the LctvApiDataStoreMySQL class.' ) ;

define( 'READ_SCOPE'       , 'read'         ) ; // Read basic public profile information
define( 'READVIEWER_SCOPE' , 'read:viewer'  ) ; // Play live streams and videos for you
define( 'READUSER_SCOPE'   , 'read:user'    ) ; // Read your personal information
define( 'READCHANNEL_SCOPE', 'read:channel' ) ; // Read private channel information
define( 'CHAT_SCOPE'       , 'chat'         ) ; // Access chat on your behalf

define( 'LCTV_TOKEN_URL' , 'https://www.livecoding.tv/o/token/'     ) ;
define( 'LCTV_AUTH_URL'  , 'https://www.livecoding.tv/o/authorize/' ) ;
define( 'LCTV_API_URL'   , 'https://www.livecoding.tv:443/api/'     ) ;

define( 'STATUS_ENDPOINT'     , 'v1/livestreams/'                  ) ;
define( 'VIEWERS_ENDPOINT'    , 'v1/livestreams/'                  ) ;
define( 'NEXTSTREAM_ENDPOINT' , 'v1/scheduledbroadcast/?limit=500' ) ;
define( 'FOLLOWERS_ENDPOINT'  , 'v1/user/followers/'               ) ;
define( 'LASTSTREAM_ENDPOINT' , 'v1/user/videos/latest/'           ) ;

?>
