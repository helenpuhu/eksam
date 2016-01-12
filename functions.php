<?php

require_once("../config_global.php");
	$database = "if15_helepuh_3";
	
			$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);

	
function getPersonData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT id, color, time, gender from persons WHERE deleted IS NULL ");
		$stmt->bind_result($id, $color, $time, $gender);
		$stmt->execute();
		
		// tekitan tühja massiivi, kus edaspidi hoian objekte
		$person_array = array();
		
		//tee midagi seni, kuni saame ab'ist ühe rea andmeid
		while($stmt->fetch()){
			// seda siin sees tehakse 
			// nii mitu korda kui on ridu
			// tekitan objekti, kus hakkan hoidma väärtusi
			$person = new StdClass();
			$person->id = $id;
			$person->color = $color;
			$person->date_time = $time;
			$person->gender = $gender;
			
			//lisan massiivi ühe rea juurde
			array_push($person_array, $person);
			//var dump ütleb muutuja tüübi ja sisu
			//echo "<pre>";
			//var_dump($car_array);
			//echo "</pre><br>";
		}
		
		//tagastan massiivi, kus kõik read sees
		return $person_array;
		
		
		$stmt->close();
		$mysqli->close();
	}
	
	
	function deletePerson($id){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE persons SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
			// sai kustutatud
			// kustutame aadressirea tühjaks
			header("Location: table.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		
		
	}
	
	function updatePerson($id, $color, $time, $gender){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE persons SET id=?, color=?, time=?, gender=? WHERE id=?");
		$stmt->bind_param("sssi", $id, $color, $time, $gender);
		if($stmt->execute()){
			// sai uuendatud
			// kustutame aadressirea tühjaks
			header("Location: table.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
	}
	
	$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";
/*VANA ASI: function addPerson($color,$time, $gender){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO persons SET color=?, time=?, gender=? WHERE id=?");
		$stmt->bind_param("sss", $color, $time, $gender);
		if($stmt->execute()){
			// sai uuendatud
			// kustutame aadressirea tühjaks
			header("Location: table.php");
			
		}
		
		$stmt->close();
		$mysqli->close();
	}*/
	
	
		function addPerson($color, $time, $gender){
		
		$response = new StdClass();
		
		$stmt = $this->connection->prepare("SELECT id,color,time,gender FROM persons WHERE id=?");
		$stmt->bind_param("isss", $id, $color, $time, $gender);
		$stmt->bind_result($id, $color, $time, $gender);
		$stmt->execute();
		
		if($stmt->fetch()){
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Isik <strong>".$new_person."</strong> on juba olemas!";
			$response->error = $error;
			return $response;
			
		}
		
		$stmt->close();
		$stmt = $this->connection->prepare("INSERT INTO persons (id, color, time, gender) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("s", $new_person);
		
		if($stmt->execute()){	
			$success = new StdClass();
			$success->message = "Värv edukalt lisatud!";
			$response->success = $success;	
			return $response;
		}else{
			$error = new StdClass();
			$error->id = 1;
			$error->message = "Midagi läks katki!";
			$response->error = $error;
		}
		
		$stmt->close();
		
		return $response;
		

		$mysqli->close();
	}
	
?>