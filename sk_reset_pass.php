<?php 
/*
* @ Purpose: Check customer exists or not(With API).
* @ Purpose: Check customer phone number exists or not(With API).
*/

include 'sk_config.php';

header("Access-Control-Allow-Origin: *");

print_r($_GET);
if(isset($_GET))
{
	 $add_cus = variant_id();
}
function variant_id()
{
$customer_id =trim($_GET['cid']);
$new_pass =trim($_GET['newpass']);
$confirm =trim($_GET['confirmpass']);
$updatePrdInfo = array(
			"customer"=>array(
              "id"=>$customer_id,
              "password"=>$new_pass,
              "password_confirmation"=>$confirm   
          )    
);

print_r($customer_id);
$url= API_URL ."admin/api/2021-01/customers/".$customer_id.".json";
print_r($url);
$data_json=json_encode($updatePrdInfo);
print_r($data_json);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
}
?>	