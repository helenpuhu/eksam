<?php
class ColorManager {
	// InterestsManager.class.php
	
	private $connection;
	private $user_id;
	
	// kui tekitan new, siis käivitatakse see funktsioon
	function __construct($mysqli){
		
		$this->connection = $mysqli;

		echo "Värvide haldus käivitatud";
		
	}
	
	function addColor($new_color){
		
		$response = new StdClass();
		
		$stmt = $this->connection->prepare("SELECT color FROM clothes_colors WHERE color=?");
		$stmt->bind_param("s", $new_color);
		$stmt->bind_result($color);
		$stmt->execute();
		
		if($stmt->fetch()){
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Värv <strong>".$new_color."</strong> on juba olemas!";
			$response->error = $error;
			return $response;
			
		}
		
		$stmt->close();
		$stmt = $this->connection->prepare("INSERT INTO clothes_colors (color) VALUES (?)");
		$stmt->bind_param("s", $new_color);
		
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
	}
	
	function createDropdown(){
		
		$html = '';
		
		$html .= '<select name="new_dd_selection">';
		//$html .= '<option selected>3</option>';
		
		$stmt = $this->connection->prepare("
		SELECT color FROM clothes_colors
		");
		
		//$stmt->bind_param("s", $this->color);
		$stmt->bind_result($color);
		$stmt->execute();
		
		//iga rea kohta, mis on ab'is
		while($stmt->fetch()){
			$html .= '<option value="'.$color.'">'.$color.'</option>';
			
		}
		
		
		
		$html .= '</select>';
		return $html;
		
	}
	
	/*function addUserInterest($new_interest_id){
		
		$response = new StdClass();
		
		//kas sellel kasutajal on see huviala
		$stmt = $this->connection->prepare("SELECT id FROM user_interests WHERE user_id = ? AND interests_id = ?");
		$stmt->bind_param("ii", $this->user_id, $new_interest_id);
		$stmt->bind_result($id);
		$stmt->execute();
		
		if($stmt->fetch()){
			$error = new StdClass();
			$error->id = 0;
			$error->message = "Huviala on Sinul juba olemas!";
			$response->error = $error;
			return $response;
			
		}
		
		$stmt->close();
		
		$stmt = $this->connection->prepare("INSERT INTO user_interests (user_id, interests_id) VALUES (?,?)");
		$stmt->bind_param("ii", $this->user_id, $new_interest_id);
		
		if($stmt->execute()){	
			$success = new StdClass();
			$success->message = "Huviala edukalt lisatud!";
			$response->success = $success;	
		}else{
			$error = new StdClass();
			$error->id = 1;
			$error->message = "Midagi läks katki!";
			$response->error = $error;
		}
		
		$stmt->close();
		
		return $response;
		
	}
	*/
	function getColors(){
		
		$html = '';
		
		$stmt = $this->connection->prepare("
		SELECT color FROM persons 	
		WHERE color = ?
		");
		$stmt->bind_param("s", $this->color);
		$stmt->bind_result($color);
		$stmt->execute();
		
		//iga rea kohta
		while($stmt->fetch()){
			$html .= '<p>'.$color.'<p>';
		}
		
		return $html;
		
		
	}
	
	
} ?>