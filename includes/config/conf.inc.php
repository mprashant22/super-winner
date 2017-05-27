<?php

define("APP_ENV", "heroku");

//if (APP_ENV == "local") {
  //  define("DB_HOST", "localhost");
    //define("DB_NAME", "my_first_app");
    //define("DB_USER", "root");
    //define("DB_PASS", "");
//} else if (APP_ENV == "heroku") {echo 'heroku vala';
    define("DB_HOST", "lamp-512mb-nyc1-01-ShopifyDemoApp");
    define("DB_PORT", "3306");
    define("DB_NAME", "shopifyApp");
    define("DB_USER", "root@localhost");
    define("DB_PASS", "e3828e583f915c60dcaea9ed125420284a8c8fa3bb8ec463");
//}

define("SHOPIFY_API_KEY", "b0f177c128a0b6fcb23226d1132f7026");
define("SHOPIFY_API_SECRET", "dc73e2402d1c41278c6ea6356d1d16b2");
define("CALLBACK_URL", "https://shoppify-app-installation.herokuapp.com/install");
define("APP_URL", "https://shoppify-app-installation.herokuapp.com/app");