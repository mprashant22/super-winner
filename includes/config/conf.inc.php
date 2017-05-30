<?php
//echo "in confffffffff";
define("APP_ENV", "heroku");

//if (APP_ENV == "local") {
  //  define("DB_HOST", "localhost");
    //define("DB_NAME", "my_first_app");
    //define("DB_USER", "root");
    //define("DB_PASS", "");
//} else if (APP_ENV == "heroku") {echo 'heroku vala';
    define("DB_HOST", "localhost");
    define("DB_PORT", "3306");
    define("DB_NAME", "shopifyApp");
    define("DB_USER", "root");
    define("DB_PASS", "e3828e583f915c60dcaea9ed125420284a8c8fa3bb8ec463");
//}

define("SHOPIFY_API_KEY", "731148aba4b8f20f0d72c25e0a884f8b");
define("SHOPIFY_API_SECRET", "d2e065e22c0a2436c47ef27d7996a99f");
define("CALLBACK_URL", "http://192.241.146.48/shopifyDemoLamp/install/");
define("APP_URL", "http://192.241.146.48/shopifyDemoLamp/app");