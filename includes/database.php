<?php

    $db = array(
        'db_host' => 'localhost',
        'db_user' => 'root',
        'db_pass' => '',
        'db_name' => 'uni_portal'
    );

    foreach($db as $key => $value) {
        define(strtoupper($key), $value);
    }

    $con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    define('SITENAME', 'UniPortal', false);
    define('TZ', 'America/Los_Angeles');
?>