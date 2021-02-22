<?php
require_once 'setting.php';
require_once 'phpseclib0.3.0/Net/SFTP.php';
set_include_path(get_include_path() . PATH_SEPARATOR . './phpseclib0.3.0');

$delimiter = "|";
$sqlGenerated = "SELECT * FROM $DB_TABLE WHERE STATUS_FLAG='CONVERTED' LIMIT $LIMIT";//limit 3000
$statement = $pdo->prepare($sqlGenerated);
$statement->execute();
$filelocation = 'files/';
//$filename     = 'export-'.date('Y-m-d H.i.s').'.csv';
$filenameExport = 'Datafeed-Export-eov-20210113.csv';
$file_export  =  $filelocation . $filenameExport;
$data = fopen($file_export, 'w');
//Get the column names.
 $csv_fields = array();
  
  $csv_fields[] = 'UID';
  $csv_fields[] = 'CLIENT_TYPE';
  $csv_fields[] = 'POLICY_HOLDER_NAME';
  $csv_fields[] = 'POLICY_HOLDER_NAME_ROW_2';
  $csv_fields[] = 'LIFE_ASSURED';
  $csv_fields[] = 'LIFE_ASSURED_ROW_2';
  $csv_fields[] = 'POLICY_HOLDER_DATE_OF_BIRTH';
  $csv_fields[] = 'POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED';
  $csv_fields[] = 'POLICY_NUMBER';
  $csv_fields[] = 'CODE_FREQUENCY';
  $csv_fields[] = 'PAYMENT_FREQUENCY';
  $csv_fields[] = 'CODE_PAYMENT_METHOD';
  $csv_fields[] = 'PAYMENT_METHOD';
  $csv_fields[] = 'AGENT_NAME';
  $csv_fields[] = 'POLICY_HOLDER_PHONE_NUMBER';
  $csv_fields[] = 'EMAIL_POLICY_HOLDER_NAME';
  $csv_fields[] = 'CODE_COMPONENT_DESCRIPTION';
  $csv_fields[] = 'COMPONENT_DESCRIPTION';
  $csv_fields[] = 'LANDING_PAGE';
  $csv_fields[] = 'CREATED_DATE';

  fputcsv($data, $csv_fields,$delimiter);
  file_put_contents($filenameExport, implode("|", $csv_fields).PHP_EOL , FILE_APPEND | LOCK_EX);

  while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $lineData = array(
          $row['UID'], 
          $row['CLIENT_TYPE'], 
          $row['POLICY_HOLDER_NAME'], 
          $row['POLICY_HOLDER_NAME_ROW_2'], 
          $row['LIFE_ASSURED'], 
          $row['LIFE_ASSURED_ROW_2'], 
          $row['POLICY_HOLDER_DATE_OF_BIRTH'], 
          $row['POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED'], 
          $row['POLICY_NUMBER'], 
          $row['CODE_FREQUENCY'], 
          $row['PAYMENT_FREQUENCY'], 
          $row['CODE_PAYMENT_METHOD'], 
          $row['PAYMENT_METHOD'], 
          $row['AGENT_NAME'], 
          $row['POLICY_HOLDER_PHONE_NUMBER'], 
          $row['EMAIL_POLICY_HOLDER_NAME'], 
          $row['CODE_COMPONENT_DESCRIPTION'], 
          $row['COMPONENT_DESCRIPTION'], 
          $row['LANDING_PAGE'], 
          $row['CREATED_AT']);
        fputcsv($data, $lineData, $delimiter);
        file_put_contents($filenameExport, implode ("|", $lineData).PHP_EOL , FILE_APPEND | LOCK_EX);
    }
?>

