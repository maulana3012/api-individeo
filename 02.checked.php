<?php
require_once '/var/piv/services/api/setting.php';

$sqlCheck = "SELECT * FROM $DB_TABLE_CHECK WHERE STATUS_FLAG='CREATED' LIMIT $LIMIT";//limit 3000
$check = $pdo->prepare($sqlCheck);
$check->execute();
$resultCheck = $check->fetchALL();
$num_of_rows_check = count($resultCheck);
$countCheck = 0;
$noCheck=0;
$mx_add = 18;

if($num_of_rows_check>0){
        foreach($resultCheck as $row){
                if(!preg_match("/^[a-zA-Z ]*$/", $row['POLICY_HOLDER_NAME'])){
                  $message ="DATA  MENGANDUNG SPESIAL KARAKTER,POLICY_NUMBER=".$row['POLICY_NUMBER'].",POLICY_HOLDER_NAME=".$row['POLICY_HOLDER_NAME']."";
                        addLog($file_name_log_check,$message,"[CHECK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";

                        $del = "`,'/";
                        $dataUpdateCheck = [
                                date('Y-m-d H:i:s'),
                                $U_POLICY_HOLDER_NAME = str_replace(str_split($del)," ", $row['POLICY_HOLDER_NAME']),
                                $row['POLICY_NUMBER']
                        ];
                        //var_dump($dataUpdateCheck);

                        $sqlUpdateCheck = "UPDATE $DB_TABLE_CHECK SET CHECKED_AT=?, POLICY_HOLDER_NAME=?, STATUS_FLAG='CHECKED' WHERE POLICY_NUMBER=?";
                        $stmt = $pdo->prepare($sqlUpdateCheck);
                        $stmt->execute($dataUpdateCheck);

                        $countCheck++;
                        $message ="SPESIAL KARAKTER BERHASIL DI UPDATE,POLICY_NUMBER=".$row['POLICY_NUMBER'].",POLICY_HOLDER_NAME=".$U_POLICY_HOLDER_NAME."";
                        addLog($file_name_log_check,$message,"[OK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";
                }elseif(!preg_match("/^[a-zA-Z ]*$/", $row['LIFE_ASSURED'])){
                  $message ="DATA  MENGANDUNG SPESIAL KARAKTER,POLICY_NUMBER=".$row['POLICY_NUMBER'].",LIFE_ASSURED=".$row['LIFE_ASSURED']."";
                        addLog($file_name_log_check,$message,"[CHECK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";

                        $del = "`',/";
                        $dataUpdateCheck = [
                                date('Y-m-d H:i:s'),
                                $U_LIFE_ASSURED = str_replace(str_split($del)," ", $row['LIFE_ASSURED']),
                                $row['POLICY_NUMBER']
                        ];
                        //var_dump($dataUpdateCheck);

                        $sqlUpdateCheck = "UPDATE $DB_TABLE_CHECK SET CHECKED_AT=?, LIFE_ASSURED=?, STATUS_FLAG='CHECKED' WHERE POLICY_NUMBER=?";
                        $stmt = $pdo->prepare($sqlUpdateCheck);
                        $stmt->execute($dataUpdateCheck);

                        $countCheck++;
                        $message ="SPESIAL KARAKTER BERHASIL DI UPDATE,POLICY_NUMBER=".$row['POLICY_NUMBER'].",LIFE_ASSURED=".$U_LIFE_ASSURED."";
                        addLog($file_name_log_check,$message,"[OK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";
                }else{
                  $message ="STEP-1 : TIDAK ADA SPECIAL CHARACTER DISINI...!";
                        addLog($file_name_log_check,$message,"[CHECK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";

                        $dataUpdateCheck = [
                                date('Y-m-d H:i:s'),
                                $row['POLICY_NUMBER']
                        ];

                        $sqlUpdateCheck = "UPDATE $DB_TABLE_CHECK SET CHECKED_AT=?, STATUS_FLAG='CHECKED' WHERE POLICY_NUMBER=?";
                        $stmt = $pdo->prepare($sqlUpdateCheck);
                        $stmt->execute($dataUpdateCheck);

                        $countCheck++;
                        $message ="SUDAH DIUPDATE ".$filename."";
                        addLog($file_name_log_check,$message,"[OK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";

                }

                if(!preg_match("/^[a-zA-Z ]*$/", $row['AGENT_NAME'])){
                  $message ="DATA  MENGANDUNG SPESIAL KARAKTER,POLICY_NUMBER=".$row['POLICY_NUMBER'].",AGENT_NAME=".$row['AGENT_NAME']."";
                        addLog($file_name_log_check,$message,"[CHECK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";

                        $del = "`',/";
                        $dataUpdateCheck = [
                                date('Y-m-d H:i:s'),
                                $U_AGENT_NAME = str_replace(str_split($del)," ", $row['AGENT_NAME']),
                                $row['POLICY_NUMBER']
                        ];
                        //var_dump($dataUpdateCheck);

                        $sqlUpdateCheck = "UPDATE $DB_TABLE_CHECK SET CHECKED_AT=?, AGENT_NAME=?, STATUS_FLAG='CHECKED' WHERE POLICY_NUMBER=?";
                        $stmt = $pdo->prepare($sqlUpdateCheck);
                        $stmt->execute($dataUpdateCheck);

                        $countCheck++;
                        $message ="SPESIAL KARAKTER BERHASIL DI UPDATE,POLICY_NUMBER=".$row['POLICY_NUMBER'].",AGENT_NAME=".$U_AGENT_NAME."";
                        addLog($file_name_log_check,$message,"[OK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";
                }elseif(!filter_var($row['EMAIL_POLICY_HOLDER_NAME'], FILTER_VALIDATE_EMAIL)){
                  $message ="DATA  MENGANDUNG SPESIAL KARAKTER,POLICY_NUMBER=".$row['POLICY_NUMBER'].",EMAIL_POLICY_HOLDER_NAME=".$row['EMAIL_POLICY_HOLDER_NAME']."";
                        addLog($file_name_log_check,$message,"[CHECK]");
                        echo $nCheck++ .".";
                        echo $message."----";
                        echo "\n";

                        $del = "`',/";
                        $dataUpdateCheck = [
                                date('Y-m-d H:i:s'),
                                $U_EMAIL_POLICY_HOLDER_NAME = str_replace(str_split($del)," ", $row['EMAIL_POLICY_HOLDER_NAME']),
                                $row['POLICY_NUMBER']
                        ];
                        //var_dump($dataUpdateCheck);

                        $sqlUpdateCheck = "UPDATE $DB_TABLE_CHECK SET CHECKED_AT=?, EMAIL_POLICY_HOLDER_NAME=?, STATUS_FLAG='CHECKED' WHERE POLICY_NUMBER=?";
                        $stmt = $pdo->prepare($sqlUpdateCheck);
                        $stmt->execute($dataUpdateCheck);

                        $countCheck++;
                        $message ="SPESIAL KARAKTER BERHASIL DI UPDATE,POLICY_NUMBER=".$row['POLICY_NUMBER'].",EMAIL_POLICY_HOLDER_NAME=".$U_EMAIL_POLICY_HOLDER_NAME."";
                        addLog($file_name_log_check,$message,"[OK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";
                }else{
                  $message ="STEP-2 : TIDAK ADA SPECIAL CHARACTER DISINI...!";
                        addLog($file_name_log_check,$message,"[CHECK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";

                        $dataUpdateCheck = [
                                date('Y-m-d H:i:s'),
                                $row['POLICY_NUMBER']
                        ];

                        $sqlUpdateCheck = "UPDATE $DB_TABLE_CHECK SET CHECKED_AT=?, STATUS_FLAG='CHECKED' WHERE POLICY_NUMBER=?";
                        $stmt = $pdo->prepare($sqlUpdateCheck);
                        $stmt->execute($dataUpdateCheck);

                        $countCheck++;
                        $message ="SUDAH DIUPDATE ".$filename."";
                        addLog($file_name_log_check,$message,"[OK]");
                        echo $noCheck++ .".";
                        echo $message."----";
                        echo "\n";
                }

        }
}

$localFile = "/var/piv/services/api/files/";
$localPath = $localFile.$filename;
array_map("unlink", glob($localPath));
?>
