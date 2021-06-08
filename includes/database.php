<?php

//Get Heroku ClearDB connection information
$cleardb_server = 'us-cdbr-east-04.cleardb.com';
$cleardb_username = 'b2d89fe57b5978';
$cleardb_password = '241c8e67';
$cleardb_db = 'heroku_e7ec67a7705bcd0';
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$con = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

    // $db = array(
    //     'db_host' => 'localhost',
    //     'db_user' => 'root',
    //     'db_pass' => 'root',
    //     'db_name' => 'uni_portal'
    // );

    // foreach($db as $key => $value) {
    //     define(strtoupper($key), $value);
    // }

    // $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    define('SITENAME', 'UniPortal', false);
    define('SITESUBTITLE', '&nbsp;&nbsp;&nbsp;', false);
	define('POSTSPERPAGE', 10);
	define('AUTHOR', 'Rejoice', false);
	define('TIMEOUT', 120);
	define('HASHCOST', 12);
    define('TZ', 'America/Los_Angeles');
?>