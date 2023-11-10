<?php
require_once './config/config.php';
require_once 'app.php';

loadEnv();

Autoloader::register();

require_once 'routes.php';