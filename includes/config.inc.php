<?php

global $config;


$config['debug']=false;
$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'password';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'RunMe_APP';

$config['scriptDir'] = "/var/www/html/RunMe/sampleScript/";

//configurazione server smtp per invio email
//$config['smtp']['host'] = 'smtp.cheapnet.it';
//$config['smtp']['port'] = '25';
//$config['smtp']['smtpauth'] = false;
//$config['smtp']['username'] = '';
//$config['smtp']['password'] = '';

//$config['email_webmaster']='webmaster@bookstore.lamjex.com';
//$config['url_bookstore']='http://localhost/bookstore2/';

function debug($var){
    global $config;
    if ($config['debug']){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}


