LCTV Badges
-----------

License: GPLv3  
Requires: PHP v5.4+  
Version: 0.0.8


#### SETUP

Setup constants are in LctvApiCredentials.inc.  
This file must exist in order to use this class.  
You can create this file using LctvApiCredentials.inc.example as a reference  
Then initialize by browsing to authorize.php and authorizing with the LCTV API.  
Depending on your use case, you may want to hide authorize.php after setup.  
See example.php for usage.


* LCTV_CLIENT_ID
This must match your app client id defined on the LCTV API website.

* LCTV_CLIENT_SECRET
This must match your app client secret defined on the LCTV API website.

* LCTV_REDIRECT_URL is the url the API should return user authentication codes to.
Should be the url to authorize.php and must match one that you defined
on the LCTV API website.

* LCTV_MASTER_USER is the master user account the API will use to make public
queries. In order for any API request to work it needs an authorized user.
You can authenticate this master account by visiting authorize.php.

* LCTVAPI_STORAGE_CLASS is the class of the data store to use for caching.
Options are LctvApiDataStoreFlatFiles or LctvApiDataStoreMySQL.

* LCTV_DATA_PATH is the path to the folder where API tokens and cache will be
stored if using the flat file data store. This folder must be writable by the server.
It would be a good idea to use a folder below the server's public html path, so
that cached user tokens aren't publicly accessible.

* LCTVAPI_CACHE_EXPIRES_IN is the amount of time in seconds before cached
data expires. Default is 300, or 5 minutes.

* LCTVAPI_DB_NAME, LCTVAPI_DB_USER, LCTVAPI_DB_PASSWORD, LCTVAPI_DB_HOST are
database connection options if using the MySQL data store.
