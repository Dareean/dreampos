<?php
// IMS Configuration with Railway & Cloud Platform Support
$dev_data = array('id'=>'-1','firstname'=>'Developer','lastname'=>'','email'=>'dev_oretnom','password'=>'5da283a2d990e8d8512cf967df5bc0d0','last_login'=>'','date_updated'=>'','date_added'=>'');

// Auto-detect Railway or use local settings
$is_railway = getenv('RAILWAY_ENVIRONMENT') !== false;
$is_production = getenv('APP_ENV') === 'production' || $is_railway;

// Database Configuration - Railway compatible
if ($is_railway) {
    // Railway provides MySQL variables automatically
    $db_host = getenv('MYSQLHOST') ?: 'localhost';
    $db_port = getenv('MYSQLPORT') ?: '3306';
    $db_user = getenv('MYSQLUSER') ?: 'root';
    $db_pass = getenv('MYSQLPASSWORD') ?: '';
    $db_name = getenv('MYSQLDATABASE') ?: 'railway';
    
    // Add port to host if not default
    if ($db_port && $db_port != '3306') {
        $db_host = $db_host . ':' . $db_port;
    }
} else {
    // Local development settings
    $db_host = getenv('DB_SERVER') ?: 'localhost';
    $db_user = getenv('DB_USERNAME') ?: 'root';
    $db_pass = getenv('DB_PASSWORD') ?: '';
    $db_name = getenv('DB_NAME') ?: 'ims';
}

if(!defined('DB_SERVER')) define('DB_SERVER', $db_host);
if(!defined('DB_USERNAME')) define('DB_USERNAME', $db_user);
if(!defined('DB_PASSWORD')) define('DB_PASSWORD', $db_pass);
if(!defined('DB_NAME')) define('DB_NAME', $db_name);

// Base URL - Auto-detect for different environments
if ($is_railway) {
    // Railway public domain
    $railway_domain = getenv('RAILWAY_PUBLIC_DOMAIN');
    $base_url = $railway_domain ? "https://{$railway_domain}/" : 'http://localhost/ims/';
} else {
    // Local or custom domain
    $base_url = getenv('BASE_URL') ?: 'http://localhost/ims/';
}

if(!defined('base_url')) define('base_url', $base_url);
if(!defined('base_app')) define('base_app', str_replace('\\','/',__DIR__).'/' );
if(!defined('dev_data')) define('dev_data', $dev_data);

// Production settings
if ($is_production) {
    // Disable error display in production
    ini_set('display_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
} else {
    // Enable errors in development
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
