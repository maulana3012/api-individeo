<?php
require_once '0S.setting.php';

$sqlConvert = "SELECT UID,CLIENT_TYPE,POLICY_HOLDER_NAME,POLICY_HOLDER_NAME_ROW_2,LIFE_ASSURED,LIFE_ASSURED_ROW_2,POLICY_HOLDER_DATE_OF_BIRTH,POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED,POLICY_NUMBER,CURRENCY_1,SUM_ASSURED,CURRENCY_2,PREMIUM_AMOUNT,CODE_FREQUENCY,PAYMENT_FREQUENCY,CODE_PAYMENT_METHOD,PAYMENT_METHOD,AGENT_NAME,POLICY_HOLDER_PHONE_NUMBER,EMAIL_POLICY_HOLDER_NAME,COMPONENT_DESCRIPTION,CODE_COMPONENT_DESCRIPTION,LANDING_PAGE,ISSUED_DATE,CYCLE_DATE,PARSED_AT,GENERATED_AT,STATUS_FLAG,CREATED_AT FROM $DB_TABLE WHERE STATUS_FLAG='PARSED'";
$convert = $pdo->prepare($sqlConvert);
$convert->execute();
$resultConvert = $convert->fetchALL();
$num_of_rows_convert = count($resultConvert);

 foreach ($resultConvert as $row){

      $UID              = $row['UID'];
      $encode           = base64_encode($UID);
      $LANDING_PAGE     = $LINK_ZURICH."".$UID;
      $GENERATED_AT     = trim(date('Y-m-d H:i:s'));
      $POLICY_NUMBER    = trim($row['POLICY_NUMBER']);

      $sqlupdate = "UPDATE tb_data_zurich SET LANDING_PAGE=:LANDING_PAGE, GENERATED_AT=:GENERATED_AT, STATUS_FLAG='CONVERTED' WHERE POLICY_NUMBER=:POLICY_NUMBER";
      $update = $pdo->prepare($sqlupdate);
      $update ->execute(array(
        'LANDING_PAGE' => $LANDING_PAGE,
        'GENERATED_AT' => $GENERATED_AT,
        'POLICY_NUMBER' => $POLICY_NUMBER,
      ));
      $message = '['.$row['CODE_COMPONENT_DESCRIPTION'].'][GENERATED]
                        POLICY_HOLDER_NAME = "'.$row['POLICY_HOLDER_NAME'].'",
                        POLICY_NUMBER = "'.$row['POLICY_NUMBER'].'",
                        UID = "'.$UID.'",
                        LANDING_PAGE = "'.$LANDING_PAGE.'"';
      addLog($file_name_log_generated,$message,"[OK]");
      echo $message;

 }

?>