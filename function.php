<?php
    function phone($number){
	$number = trim($number);
	if(strlen($number)==9){
		return str_pad($number, 9, "0", STR_PAD_LEFT);
	}else{
		return $number;
	}
    }

    function set($string){
        if($string==null) {
            return '';
        }else{
            return $string;
        }
    }
    function convertDate($stringtgl){
        $tgl=trim($stringtgl);
        if(strlen($tgl)==8){
            $tahun = substr($tgl, 0,4);
            $bulan = substr($tgl, 4,2);
            $tangg = substr($tgl, 6,2);
            $arraybln=array(" ","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
            $strbln=$arraybln[intval($bulan)];
            return "$tangg $strbln $tahun";    
        }else{
            return 'invalid date!';
        }
    }

    function convertNominal($value)
    {
        return number_format((int)$value, 0, ',', '.');
    }

    function setDash($string){
        if($string=='')
            return "-";
        else
            return $string;
        
    }

    function converrtCurr($curr){
        if($curr=='IDR'){
            return "Rp ";
        }
    }

    function convertfreq($freq){
        if($freq=='Quarterly'){
            return "K";
        }elseif ($freq=="Monthly") {
            return "B";
        }else {
            return "T";
        }
    }

    function convertmetode($metode){
            if($metode=='D'){
                return "Auto Debit Rekening Bank";
            }elseif ($metode=="C") {
                return "Transfer Bank";
            }else {
                return "Auto Debit Kartu Kredit";
            }
    }

    function convertcode($code){
            if($code=='Zurich Proteksi 8'){
                return "ZP8";
            }elseif ($code=="") {
                return "null";
            }else {
                return "null";
            }
    }

    function parsing($string,$max_char_per_line,$row){
        $splited_string=explode(' ', $string);
        $tempresult='';
        $baris=1;
        $result = array(
            1   => "",
            2   => "",
        );
        foreach ($splited_string as $val) {
            if(strlen($tempresult." ".$val)<=$max_char_per_line){
                $tempresult = $tempresult." ".$val;
                $result[$baris] = $tempresult;
            }else{
                $baris++;
                $tempresult=$val;
                $result[$baris]=$tempresult;
            }
        }
        return $result[$row];   
    }

    function addLog($txt,$message,$status){
        if(!file_exists($txt))
            $log = fopen($txt,"w");
        $content = $status."[".date("Ymd H:i:s")."]".$message;
        file_put_contents($txt, $content.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    function csvToArray($filename = '', $delimiter = ';')
    {
    if (!file_exists($filename) || !is_readable($filename)) {
        return false;
    }
    $header = NULL;
    $result = array();
    if (($handle = fopen($filename, 'r')) !== FALSE) {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            if (!$header)
                $result[] = $row;
            else

                $result[] = array_combine($header, $row);
        }
        fclose($handle);
    }


    return $result;
}

?>
