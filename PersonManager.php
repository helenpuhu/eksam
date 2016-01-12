<?php
class PersonManager {
	// InterestsManager.class.php
	
	private $connection;
	private $user_id;
	
	// kui tekitan new, siis käivitatakse see funktsioon
	function __construct($mysqli){
		
		$this->connection = $mysqli;

		echo "Isikute haldus käivitatud";
		
	}
	
		function addPerson($color, $time, $gender){
		
		$response = new StdClass();
		//kas selline on juba olemas
		$stmt = $this->connection->prepare("SELECT id FROM persons WHERE color=?");
		$stmt->bind_param("sss", $color, $time, $gender);
		$stmt->bind_result($id);
		$stmt->execute();
		//kui ei olnud olemas siis
		if($stmt->fetch()){
			
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Isik <strong>".$new_person."</strong> on juba olemas!";
			$response->error = $error;
			return $response;
			
		}
		
		$stmt->close();
		
		$stmt = $this->connection->prepare("SELECT id, color, time, gender FROM persons  WHERE color=?");
		$stmt->bind_param("sss", $color, $time, $gender);
		$stmt->bind_result($id_from_db, $color_from_db, $time_from_db, $gender_from_db);
		$stmt->execute();
		
		if($stmt->fetch()){	
			$success = new StdClass();
			$success->message = "Isik edukalt lisatud!";
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
		
	}
?>