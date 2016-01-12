<?php
	require_once("functions.php");

//Car=Person
//id=color
//plate_number=time
//color=gender
	
	
	// kas kustutame
	// ?delete=vastav id mida kustutada on aadressireal
	if(isset($_GET["delete"])){
		
		echo "Kustutame id ".$_GET["delete"];
		//käivitan funktsiooni, saadan kaasa id!
		deletePerson($_GET["delete"]);
		
	}
	
	//HELEN - salvestan andmebaasi uuendused
	if(isset($_POST["save"])){
		
		updatePerson($_POST["color"], $_POST["time"], $_POST["gender"]);
	}
	
	
	//käivitan funktsiooni
	$array_of_persons = getPersonData();
	
	//trükin välja esimese auto
	//echo $array_of_cars[0]->id." ".$array_of_cars[0]->plate;
	
?>

	<h2>Tänavavaatlusmärkmik</h2>
	<table border=1>
	<tr>
		<th>id</th>
		<th>Üleriiete värv</th><
		<th>Vaatluse aeg</th>
		<th>Sugu</th>
		<th>Kustuta</th>
	</tr>
	

	<?php
		// trükime välja read
		// massiivi pikkus count()
		for($i = 0; $i < count($array_of_persons); $i++){
			//echo $array_of_persons[$i]->id;
			
			//kasutaja tahab muuta seda rida
			if(isset($_GET["edit"]) && $array_of_persons[$i]->id == $_GET["edit"]){
				
				echo "<tr>";
				echo "<form action='table.php' method='post'>";
				echo "<input type='hidden' name='id' value='".$array_of_persons[$i]->id."'>";
				echo "<td>".$array_of_persons[$i]->id."</td>";
				echo "<td><input name='time' value='".$array_of_persons[$i]->date_time."'></td>";
				echo "<td><input name='gender' value='".$array_of_persons[$i]->gender."'></td>";
				echo "<td><input type='submit' name='save'></td>";
				echo "</form>";
				echo "</tr>";
				
			}else{
				
				echo "<tr>";
				echo "<td>".$array_of_persons[$i]->id."</td>";
				echo "<td>".$array_of_persons[$i]->color."</td>";
				echo "<td>".$array_of_persons[$i]->date_time."</td>";
				echo "<td>".$array_of_persons[$i]->gender."</td>";
				echo "<td><a href='?delete=".$array_of_persons[$i]->id."'>X</a></td>";
				echo "</tr>";
				
			}
			
		}
	
	

?>
</table>


<?php
//HELEN
//Car=Person
//id=color
//plate_number=time
//color=gender	
	
	// kas kustutame
	// ?delete=vastav id mida kustutada on aadressireal
	if(isset($_GET["delete"])){
		
		echo "Kustutame id ".$_GET["delete"];
		//käivitan funktsiooni, saadan kaasa id!
		deletePerson($_GET["delete"]);
		
	}
	
	//HELEN - salvestan andmebaasi uuendused
	if(isset($_POST["save"])){
		
		updatePerson($_POST["color"], $_POST["time"], $_POST["gender"]);
	}
	
	
	//käivitan funktsiooni
	$array_of_persons = getPersonData();
	
	//trükin välja esimese auto
	//echo $array_of_cars[0]->id." ".$array_of_cars[0]->plate;
	
	
	?>
	
	<a href="http://greeny.cs.tlu.ee/~helepuh/eksam/data.php">Tagasi</a>
