<?php
session_start();

/**
* 
*/
require_once('./common.php');
require_once(full_path('controllers/index_servlet.php'));

IndexServlet::setup();
if($_SERVER["REQUEST_METHOD"] === 'GET'){
    IndexServlet::doGet();
} else if($_SERVER["REQUEST_METHOD"] === 'POST'){
    IndexServlet::doPost();
}

?>