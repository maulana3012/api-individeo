<?php
require_once '/var/piv/services/api/setting.php';
require_once '/var/piv/services/api/phpseclib0.3.0/Net/SFTP.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

$file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

set_include_path(get_include_path() . PATH_SEPARATOR . './phpseclib0.3.0');

$sftp = new Net_SFTP("sftp.rds.co.id");
$noSFTP = 0;

if (!$sftp->login("zuricheov-uat", "zurichbuatuateoV"))
{
	$message = "SFTP TIDAK TERKONEKSI";
    addLog($file_name_log_SFTP, $message, "[ERROR]");
    addLog($file_name_log_error, $message, "[ERROR]");
    echo $noSftp++ .".";
    echo $message."----";
    echo "\n";

}else{
    $message = "SFTP TERKONEKSI";
    addLog($file_name_log_SFTP, $message, "[OK]");
    echo $noSFTP++ .".";
    echo $message."----";
    echo "\n";

        $path = "DATA-FEED/";
        $filePath = $path.$filename;
        $localFile = "/var/piv/services/api/files/";
        $localPath = $localFile.$filename;

        if(!$sftp->get($filePath,$localPath))
        {
                $message = "".$filename." Tidak Terdownload";
                addLog($file_name_log_SFTP, $message, "[ERROR]");
                echo $noSFTP++ .".";
                echo $message."----";
                echo "\n";
        }else{
                $message = "".$filename." Terdownload";
                addLog($file_name_log_SFTP, $message, "[OK]");
                echo $noSFTP++ .".";
                echo $message."----";
                echo "\n";

                $heandel = csvToArray($localPath);
                $num_of_rows = count($heandel);
                $countCreated = 0;
                $noCreated = 0;
                //Import Data
                if ($num_of_rows>0) {
                        foreach ($heandel as $line) {
                                $dataCreated = [
                                        $CLIENT_TYPE = set($line[17]),
                                        $POLICY_HOLDER_NAME = set($line[3]),
                                        $LIFE_ASSURED = set($line[8]),
                                        $POLICY_HOLDER_DATE_OF_BIRTH = set($line[5]),
                                        $POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED = set($line[6]),
                                        $POLICY_NUMBER = set($line[7]),
                                        $CURRENCY_1 = set($line[9]),
                                        $SUM_ASSURED = set($line[10]),
                                        $CURRENCY_2 = set($line[9]),
                                        $PREMIUM_AMOUNT = set($line[11]),
                                        $PAYMENT_FREQUENCY = set($line[12]),
                                        $CODE_PAYMENT_METHOD = set($line[13]),
                                        $AGENT_NAME = set($line[14]),
                                        $POLICY_HOLDER_PHONE_NUMBER = set($line[15]),
                                        $EMAIL_POLICY_HOLDER_NAME = set($line[16]),
                                        $COMPONENT_DESCRIPTION = set($line[4]),
                                        $CYCLE_DATE = set($line[0]),
                                        $ISSUED_DATE = set($line[2]),
                                        $CREATED_AT = date('Y-m-d H:i:s'),
                                        $STATUS_FLAG='CREATED'
                                ];

                                //var_dump($dataCreated);

                                $sqlCreated = "INSERT INTO $DB_TABLE_CHECK(
                                        CLIENT_TYPE,
                                        POLICY_HOLDER_NAME,
                                        LIFE_ASSURED,
                                        POLICY_HOLDER_DATE_OF_BIRTH,
                                        POLICY_HOLDER_DATE_OF_BIRTH_LIFE_ASSURED,
                                        POLICY_NUMBER,
                                        CURRENCY_1,
                                        SUM_ASSURED,
                                        CURRENCY_2,
                                        PREMIUM_AMOUNT,
                                        PAYMENT_FREQUENCY,
                                        CODE_PAYMENT_METHOD,
                                        AGENT_NAME,
                                        POLICY_HOLDER_PHONE_NUMBER,
                                        EMAIL_POLICY_HOLDER_NAME,
                                        COMPONENT_DESCRIPTION,
                                        CYCLE_DATE,
                                        ISSUED_DATE,
                                        CREATED_AT,
                                        STATUS_FLAG) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                                $stmt = $pdo->prepare($sqlCreated);
                                $stmt->execute($dataCreated);
                                $countCreated++;
                                $message = '['.$DB_TABLE_CHECK.'][CREATED] Total = '.$countCreated.' POLICY_HOLDER_NAME = "'.$line[3].'", POLICY_NUMBER = "'.$line[7].'"';
                                addLog($file_name_log_create,$message,"[OK]");
                                echo $noCreated++ .".";
                                echo $message."----";
                                echo "\n";
                        }
                }

        }
}
?>