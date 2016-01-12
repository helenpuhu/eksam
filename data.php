<?php 	
		require_once("functions.php");
		require_once("ColorManager.php");
		require_once("PersonManager.php");
		
		
	$id = "";
	$color = "";
	$time = "";
	$gender = "";

	?>
	



<a href="http://greeny.cs.tlu.ee/~helepuh/eksam/table.php">Vaata tabelit</a>


  <?php
  //VÄRVIDE LISAMINE
  //uus instants klassist
	$ColorManager = new ColorManager($mysqli);
	$PersonManager = new PersonManager($mysqli);
	
	//aadressirealt muutuja
	if(isset($_GET["new_color"])){
	
		$add_new_color = $ColorManager->addColor($_GET["new_color"]);
		var_dump($add_new_color);
		
	}
	
	//rippmenüü valiku kõrval vajutati nuppu
	if(isset($_POST["add_person"])){
		var_dump($_POST);
		$add_new_person_response = $PersonManager->addPerson($_POST["new_dd_selection"], $_POST["date_time"], $_POST["gender"], $POST["add_person"]);
		
	}
	?>
	


<h2>Lisa uus värv</h2>
  <?php if(isset($add_new_color_response->error)):  ?>

  
	<p style="color:red;">
		<?=$add_new_color_response->error->message;?>
	</p>
  
  <?php elseif(isset($add_new_color_response->success)): ?>
	
	<p style="color:green;" >
		<?=$add_new_color_response->success->message;?>
	</p>
	
  <?php endif; ?>
  
  <form>
	<input name="new_color">
	<input type="submit">
</form>


<h2>Lisa uus inimene</h2>
  
    <?php if(isset($add_new_person_response->error)):  ?>

  
	<p style="color:red;">
		<?=$add_new_person_response->error->message;?>
	</p>
  
  <?php elseif(isset($add_new_person_response->success)): ?>
	
	<p style="color:green;" >
		<?=$add_new_person_response->success->message;?>
	</p>
	
	<?php endif; ?>
	

<label for="color" >Üleriiete värv</label><br>
	<!-- siia järele tuleb rippmenüü -->
	
	
	<?php if(isset($add_new_color_response->error)): ?>
  
	<p style="color:red;">
		<?=$add_new_color_response->error->message;?>
	</p>
  
  <?php elseif(isset($add_new_color_response->success)): ?>
	
	<p style="color:green;" >
		<?=$add_new_color_response->success->message;?>
	</p>
	 <?php endif; ?>


<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<?=$ColorManager->createDropdown();?>
	<br><br>
	<label for="animal_name" >Vaatluse aeg</label><br>
	<input id="date_time" name="date_time" type="date" value="<?php echo $date_time; ?>"><br><br>
	<label for="gender" >Sugu</label><br>
	<input id="gender" name="gender" type="gender" value="<?php echo $gender; ?>"><br><br>
	<input type="submit" name="add_person" value="Salvesta">
</form>


