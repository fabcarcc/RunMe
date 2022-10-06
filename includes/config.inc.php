<?php

global $config;

$config['debug']=false;

$config['mysql']['user'] = 'root';
$config['mysql']['password'] = 'password';
$config['mysql']['host'] = 'localhost';
$config['mysql']['database'] = 'RunMe_APP';

$config['scriptDir'] = "/var/www/html/RunMe/sampleScript/";

$config['allowDelete'] = true;
$config['allowUpload'] = true;

//configurazione server smtp per invio email
//$config['smtp']['host'] = '10.0.0.60';
//$config['smtp']['port'] = '25';
//$config['smtp']['smtpauth'] = false;
//$config['smtp']['username'] = '';
//$config['smtp']['password'] = '';

function debug($var){
    global $config;
    if ($config['debug']){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}
