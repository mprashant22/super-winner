<?php

define("APP_ENV", "heroku");

if (APP_ENV == "local") {
    define("DB_HOST", "localhost");
    define("DB_NAME", "my_first_app");
    define("DB_USER", "root");
    define("DB_PASS", "");
} else if (APP_ENV == "heroku") {echo 'heroku vala';
    define("DB_HOST", "ec2-54-235-120-39.compute-1.amazonaws.com");
    define("DB_PORT", "5432");
    define("DB_NAME", "d5fb1psv67etp7");
    define("DB_USER", "zgkfevvqqgaxwv");
    define("DB_PASS", "4802ef3c3eec8755a7027a133b33ff83e0ba437ebd7fbd3464fac3b9d78b2552");
}

define("SHOPIFY_API_KEY", "b0f177c128a0b6fcb23226d1132f7026");
define("SHOPIFY_API_SECRET", "dc73e2402d1c41278c6ea6356d1d16b2");
define("CALLBACK_URL", "https://shoppify-app-installation.herokuapp.com/install");
define("APP_URL", "https://shoppify-app-installation.herokuapp.com/app");