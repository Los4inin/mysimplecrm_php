<?php require_once('func/funcCont.php');
$rowsOnPage=50;

if (isset($_GET['search'])) {
   $search=$_GET['search'];
   $data = searchContacts($search);
 }
 elseif ((isset($_GET['role'])) or (isset($_GET['tag']))){
  if (isset($_GET['role'])) $role=$_GET['role'];
  else $role='';
  if (!isset($_GET['tag'])){
  	$tag='';
    $data = contactsByRoleAndTag($role, $tag);
  } else {
  	$tag=$_GET['tag'];
  	$data=array('');
  	foreach ($tag as $key => $value) {
  		$iteration = contactsByRoleAndTag($role, $value);
  		$data=array_merge($data, $iteration);
  	}
  	/*$data = array_unique($data); не работает для многомерных массивов*/
  	$data = array_diff($data, array(''));
  	//попробуем удалить дубли и многомерного массива ручками
  	$aux_res = array();
    $result_res = array();
    //создание одномерного массива
    foreach ($data as $key => $value) {
    	$aux_res[$key] = $value['id'];
    }
    $aux_res = array_unique($aux_res);
 	//собираем обратно
    foreach ($aux_res as $key => $value) {
        $result_res[$key] = $data[$key] ;
    }
	$data=$result_res;
  }
 }
 else{
  $data = getContacts();
}
$page=getPage();
$page=$page*$rowsOnPage;
$i=0;

 if(isset( $_GET['makeCSV'] ) ){
   require_once('func/funkCsv.php');
   download_send_headers("data_export.csv");
   $titles = array("id", "parentAcc","parAccName","appeal","sex","Фамилия","имя","отчество","должность","tel1","tel2","mailing","mail2","skype","owner","modDate","text");
   echo array2csv($data, $titles);
   die();
 }
?>
