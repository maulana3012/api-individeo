<?php
require_once '/var/piv/services/api/setting.php';

$sqlParsing = "SELECT * FROM $DB_TABLE_CHECK WHERE STATUS_FLAG='CHECKED' LIMIT $LIMIT";//limit 3000
$parsing = $pdo->prepare($sqlParsing);
$parsing->execute();
$resultParsing = $parsing->fetchALL();
$num_of_rows_parsing = count($resultParsing);
$countParsing = 0;
$noParsing=0;
$max_add = 18;

if ($num_of_rows_parsing>0) {
    foreach ($resultParsing as $dataParsing) {

        $InputParsed = [
                $CLIENT_TYPE = trim($dataParsing['CLIENT_TYPE']),
                $POLICY_HOLDER_NAME = trim(parsing($dataParsing['POLICY_HOLDER_NAME'],$max_add,1)),
                $POLICY_HOLDER_NAME_ROW_2 = trim(parsing($dataParsing['POLICY_HOLDER_NAME'],$max_add,2)),
                $LIFE_ASSURED = trim(parsing($dataParsing['LIFE_ASSURED'],$max_add,1)),
                $LIFE_ASSURED_ROW_2 = trim(parsing($dataParsing['LIFE_ASSURED'],$max_add,2)),
                $POLICY_HOLDER_DATE_OF_BIRTH = trim($dataParsing['POLICY_HOLDER_DATE_OF_BIRTH']),
                $POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED = trim($dataParsing['POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED']),
                $POLICY_NUMBER = trim($dataParsing['POLICY_NUMBER']),
                $CURRENCY_1 = trim(converrtCurr($dataParsing['CURRENCY_1'])),
                $SUM_ASSURED = trim(convertNominal($dataParsing['SUM_ASSURED'])),
                $CURRENCY_2 = trim(converrtCurr($dataParsing['CURRENCY_2'])),
                $PREMIUM_AMOUNT = trim(convertNominal($dataParsing['PREMIUM_AMOUNT'])),
                $CODE_FREQUENCY = trim(convertfreq($dataParsing['PAYMENT_FREQUENCY'])),
                $PAYMENT_FREQUENCY = trim($dataParsing['PAYMENT_FREQUENCY']),
                $CODE_PAYMENT_METHOD = trim($dataParsing['CODE_PAYMENT_METHOD']),
                $PAYMENT_METHOD = trim(convertmetode($dataParsing['CODE_PAYMENT_METHOD'])),
                $AGENT_NAME = trim($dataParsing['AGENT_NAME']),
                $POLICY_HOLDER_PHONE_NUMBER = trim($dataParsing['POLICY_HOLDER_PHONE_NUMBER']),
                $EMAIL_POLICY_HOLDER_NAME = trim($dataParsing['EMAIL_POLICY_HOLDER_NAME']),
                $COMPONENT_DESCRIPTION = trim($dataParsing['COMPONENT_DESCRIPTION']),
                $CODE_COMPONENT_DESCRIPTION = trim(convertcode($dataParsing['COMPONENT_DESCRIPTION'])),
                $ISSUED_DATE = trim($dataParsing['ISSUED_DATE']),
                $CYCLE_DATE = trim($dataParsing['CYCLE_DATE']),
                $PARSED_AT = trim(date('Y-m-d H:i:s')),
                $CREATED_AT = trim($dataParsing['CHECKED_AT']),
                $STATUS_FLAG = 'PARSED'];

        //var_dump($InputParsed);

        $sqlInputParsed = "INSERT INTO $DB_TABLE (
                CLIENT_TYPE,
                POLICY_HOLDER_NAME,
                POLICY_HOLDER_NAME_ROW_2,
                LIFE_ASSURED,
                LIFE_ASSURED_ROW_2,
                POLICY_HOLDER_DATE_OF_BIRTH,
                POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED,
                POLICY_NUMBER,
                CURRENCY_1,
                SUM_ASSURED,
                CURRENCY_2,
                PREMIUM_AMOUNT,
                CODE_FREQUENCY,
                PAYMENT_FREQUENCY,
                CODE_PAYMENT_METHOD,
                PAYMENT_METHOD,
                AGENT_NAME,
                POLICY_HOLDER_PHONE_NUMBER,
                EMAIL_POLICY_HOLDER_NAME,
                COMPONENT_DESCRIPTION,
                CODE_COMPONENT_DESCRIPTION,
                ISSUED_DATE,
                CYCLE_DATE,
                PARSED_AT,
                CREATED_AT,
                STATUS_FLAG) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
                         $stmt = $pdo->prepare($sqlInputParsed);
                         $stmt->execute($InputParsed);
                         $countParsing++;
                         $message = '['.$DB_TABLE.'][IN] Total = '.$countParsing.' records insert. ';
                         addLog($file_name_log_parsing,$message,"[OK]");
                         echo $noParsing++ .".";
                         echo $message."----";
                         echo "\n";
    }
}
?>
