<?php
if( isset( $_POST['makeCSV'] ) ){
  require_once('func/funkCsv.php');
  download_send_headers("data_export.csv");
  echo array2csv($data, $titles);
  die();
}
?>
