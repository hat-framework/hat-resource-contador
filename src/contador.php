<?php
session_start();

$FILE = "contador.txt";
$n_digitos = 6;
$count = '0';
if (file_exists($FILE)) {
        $fp = fopen("$FILE", "r+");
        flock($fp, 1);
        $count = fgets($fp, 4096);
        if(!array_key_exists("contador", $_SESSION)){
            $_SESSION['contador'] = true;
            $count += 1;
            fseek($fp,0);
            fputs($fp, $count);
        }
        flock($fp, 3);
        fclose($fp);
} else exit;

chop($count);
$n_digitos = max(strlen($count), $n_digitos);
$count     = substr("0000000000".$count, -$n_digitos);
$digits    = preg_split("//", $count);
$digits    = implode("", $digits);
    
header('Content-type: text/javascript');
echo "document.write(\"".$digits."\");";
?>
