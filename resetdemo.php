<?php
require_once ("assets/includes/global.php");
require_once ("assets/database/MysqliDb.php");
require_once ("assets/database/dbconnect.php");


//html page header and menu
require_once ("assets/includes/header.php");
?>


    <!-- Begin page content -->
    <div class="container">

      <div class="page-header">


      </div>

<?php

$prefix = 'tbl';

$db = new Mysqlidb(Array (
                'host' => 'localhost',
                'username' => 'root',
                'password' => '',
                'db' => 'survey',
                'prefix' => $prefix,
                'charset' => null));
if(!$db) die("Database error");
$db->setTrace(true);
$tables = Array (
    'providerData' => Array (
        'providerDataId' => 'int(11) NOT NULL AUTO_INCREMENT, PRIMARY KEY (providerDataId)',
        'prov_no' => 'varchar(12) NOT NULL ',
        'first_name' => 'varchar(14) NOT NULL ',
        'last_name' => 'varchar(36) NOT NULL ',
        'sex' => 'varchar(1) NULL ',
        'spec1' => 'varchar(2) NULL ',
        'spec2' => 'varchar(2) NULL ',
        'lang01' => 'varchar(2) NULL ',
        'lang02' => 'varchar(2) NULL ',
        'lang03' => 'varchar(2) NULL ',
        'newPatients' => 'varchar(1) NULL ',
        'medicalGroup' => 'varchar(100) NULL ',
        'address1' => 'varchar(100) NULL ',
        'address2' => 'varchar(100) NULL ',
        'city' => 'varchar(50) NULL ',
        'state' => 'varchar(2) NULL ',
        'zip' => 'varchar(10) NULL ',
        'phone_1' => 'varchar(20) NULL ',
        'phone_1_info' => 'varchar(20) NULL ',
        'handicapAccessible' => 'varchar(1) NULL ',
        'website' => 'varchar(256) NULL ',
        'email' => 'varchar(256) NULL ',
        'adddate' => 'datetime NOT NULL DEFAULT CURRENT_TIMESTAMP',
        'moddate' => 'datetime NULL '

    )

);
$data = Array (
    'providerData' => Array (
        Array ('prov_no' => '100087629',
               'first_name' => 'ALEXANDER',
               'last_name' => 'NAVARRO',
               'adddate' => $db->now()
        )
    )
);
function createTable ($name, $data) {
    global $db;
    $count = 0;
    //$q = "CREATE TABLE $name (id INT(9) UNSIGNED PRIMARY KEY NOT NULL";
    $db->rawQuery("DROP TABLE IF EXISTS $name");
    //$q = "CREATE TABLE $name (id INT(9) UNSIGNED PRIMARY KEY AUTO_INCREMENT";
    $q = "CREATE TABLE $name (";

    foreach ($data as $k => $v) {
        if ($count == 0) {
          $q .= " $k $v";
        } else {
          $q .= ", $k $v";
        };

        $count ++;

    }
    $q .= ");";
    echo $q . '<br>';
    $db->rawQuery($q);
}
// rawQuery test
foreach ($tables as $name => $fields) {
    $db->rawQuery("DROP TABLE ".$prefix.$name);
    createTable ($prefix.$name, $fields);
}
if (!$db->ping()) {
    echo "db is not up";
    exit;
}

// insert test with autoincrement

foreach ($data as $name => $datas) {
    foreach ($datas as $d) {
        $id = $db->insert($name, $d);
        if ($id)
            $d['id'] = $id;
        else {
            echo "failed to insert: ".$db->getLastQuery() ."\n". $db->getLastError();
            exit;
        }
    }
}



echo "<p class='lead'>All done: ";
echo "Memory usage: ".memory_get_peak_usage()."</p>";
 ?>


 <?php
 //html page footer
 require_once ("assets/includes/footer.php");
 ?>
