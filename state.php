<?php
session_start();
require_once("db.php");

//If user clicked login button
if(isset($_POST)){

	$sql = "SELECT * FROM drinks WHERE id_drink='$_POST[id]'";
	$result = $conn->query($sql);
	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){

			echo '<option value="'.$row["price"].'" data-id="'.$row["id"].'">'.$row["name"].'</option>';
		}

	}

	$conn->close();

}