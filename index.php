<?php
ini_set("display_errors", 0);

// echo "<pre>";print_r($_SERVER);echo $_SERVER["DOCUMENT_ROOT"];exit;

$headers = apache_request_headers();
$JsonInput = "";
$ProcessingImagesContent = "";
if (isset($headers) && !empty($headers) && ((isset($headers["Cust_api_key"]) && $headers["Cust_api_key"] == md5("CoachBookingAPI")) || (isset($headers["cust_api_key"]) && $headers["cust_api_key"] == md5("CoachBookingAPI")))) {
	$JsonInput = file_get_contents("php://input"); //read the HTTP body.
	$JsonInputArray = json_decode($JsonInput, true);
	// echo "<pre>";print_r($JsonInputArray);

	$InputArray = $JsonInputArray["inputdata"];
  if ($DataAvailable == "yes") {
    $FinalResponse["code"] = "200";
    $FinalResponse["status"] = "success";
    $FinalResponse["message"] = "Coach slot is available!";
  } else {
    $FinalResponse["code"] = "201";
    $FinalResponse["status"] = "error";
    $FinalResponse["message"] = "Coach slot is NOT available!";
  }
} else {
  $FinalResponse["code"] = "401";
  $FinalResponse["status"] = "error";
  $FinalResponse["message"] = "Authorization failed! Please try again!";
}

echo json_encode($FinalResponse);

?>
