<?php
require_once '/var/piv/services/api/function.php';

$DB_HOST 		= "";
$DB_USERNAME 	= "";
$DB_PASSWORD 	= "";
$DB_NAME 		= "db_temp_zurich";
$DB_TABLE 		= "tb_data_zurich";
$DB_TABLE_ERROR = "tb_error";
$DB_TABLE_CHECK = "tb_data_check";
$LIMIT			= 3000;
//$LINK_ZURICH	= ""; /*for Dev*/
$LINK_ZURICH 	= ""; /*for Prod*/
//$PROJECT 		= ''; /*for Dev*/
$PROJECT		= ''; /*for Prod*/
//$HOSTNAME		= "";/*for Dev*/
$HOSTNAME		= "";/*for Prod*/
$filename 		= "Datafeed-Export-".date('Ymd',strtotime("-5 days")).".csv";/*for Prod*/
//$filename 	= 'Datafeed-Export-20200101.csv';/*for Dev*/
$fileExport		= "Datafeed-Export-eov-".date('Ymd',strtotime("-5 days")).".csv";/*for Prod*/
//$fileExport 	= 'Datafeed-Export-eov-20200101.csv';/*for Dev*/

$file_name_log_SFTP 	 	= "/var/piv/services/api/logs/SFTP/api-log-sftp".date("Ymd").".txt";
$file_name_log_create    	= "/var/piv/services/api/logs/create/api-log-create".date("Ymd").".txt";
$file_name_log_check 	 	= "/var/piv/services/api/logs/check/api-log-check".date("Ymd").".txt";
$file_name_log_parsing 	 	= "/var/piv/services/api/logs/parse/api-log-parse".date("Ymd").".txt";
$file_name_log_generated	= "/var/piv/services/api/logs/generate/api-log-generate".date("Ymd").".txt";

try {   
       	$pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", 
        $DB_USERNAME, $DB_PASSWORD,
        array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ));
    }catch (PDOException $e) {
        die('database connection failed: ' . $e->getMessage());
    }
?>
