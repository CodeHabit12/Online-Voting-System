<?php
include 'config.php';

// Read POST data
$postData = json_decode(file_get_contents("php://input"));
$request = "";
if(isset($postData->request)){
   $request = $postData->request;
}

// Get states
if($request == 'getStates'){
   $country_id = 0;
   $result = array();$data = array();

   if(isset($postData->country_id)){
      $country_id = $postData->country_id;

      $sql = "SELECT * from states WHERE country_id=?";
      $stmt = $con->prepare($sql); 
      $stmt->bind_param("i", $country_id);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()){

         $id = $row['id'];
         $name = $row['name'];

         $data[] = array(
            "id" => $id,
            "name" => $name
         );

      }

   }

   echo json_encode($data);
   die;

}

// Get cities
if($request == 'getCities'){
   $state_id = 0;
   $result = array();$data = array();

   if(isset($postData->state_id)){
      $state_id = $postData->state_id;

      $sql = "SELECT * from cities WHERE state_id=?";
      $stmt = $con->prepare($sql); 
      $stmt->bind_param("i", $state_id);
      $stmt->execute();
      $result = $stmt->get_result();

      while ($row = $result->fetch_assoc()){

         $id = $row['id'];
         $name = $row['name'];

         $data[] = array(
            "id" => $id,
            "name" => $name
         );

      }
   }

   echo json_encode($data);
   die;
}