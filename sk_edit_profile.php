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
	 $add_cus = edit_profile();
}
function edit_profile()
{
$customer_id =trim($_GET['cid']);
$name =trim($_GET['name']);
$email =trim($_GET['email']);
$phone =trim($_GET['phone']);
$updatePrdInfo = array(
			"customer"=>array(
              "id"=>$customer_id,
              "email"=>$email,
              "first_name"=>$name,
              "phone"=>$phone 
          )    
);

print_r($customer_id);
$url= API_URL ."admin/api/2021-01/customers/".$customer_id.".json";
$data_json=json_encode($updatePrdInfo);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($data_json)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
print_r($response);
curl_close($ch);
}
?>	