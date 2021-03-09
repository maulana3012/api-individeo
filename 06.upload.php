<?php
require_once '0S.setting.php';
require_once 'phpseclib0.3.0/Net/SFTP.php';
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

        $filePath 	= "EOV-ZURICH/";
        $localFile 	= "files/";
        $localPath 	= $localFile.$fileExport;

	if ($handle = opendir($localFile))
    	{
  
        	while (false !== ($file = readdir($handle)))
        	{
            		if ($file != "." && $file != "..")
            		{
                		$files_to_upload[] = $file;
            		}
        	}

        	closedir($handle);
    	}

	if(!empty($files_to_upload))
    	{
        /* Now upload all the files to the remote server */
        	foreach($files_to_upload as $file)
        	{
              		/* Upload the local file to the remote server
                 	put('remote file', 'local file');
               		*/
              		$success = $sftp->put($filePath . $file,
                                    $localFile . $file,
                                     NET_SFTP_LOCAL_FILE);
			$message = "".$fileExport." Berhasil di Upload ke Server RDS";
			addLog($file_name_log_SFTP, $message, "[OK]");
    			echo $noSFTP++ .".";
    			echo $message."----";
    			echo "\n";
        	}
    	}
}

array_map("unlink", glob($localPath));
?>
