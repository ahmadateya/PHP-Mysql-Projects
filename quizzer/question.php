<?php include 'database.php'; ?>
<?php include 'layout/header.php'; ?>
<?php session_start() ?>
<?php 
	//Set question number
	$number = (int)$_GET['n'];

	/*
	*  Get total questions 
	*/
	$query = "SELECT * FROM questions";

	// Get the results
	 $results = $mysqli->query($query) or die($mysqli->error.__LINE__);
	 $total= $results->num_rows;


	/*
	* Get Question
	*/
	$query= "SELECT * FROM questions
			 WHERE question_number = $number";

	// Get the result
	 $result =$mysqli->query($query) or die($mysqli->error.__LINE__); 
	 $question= $result->fetch_assoc();

	/*
	* Get Choice
	*/
	$query= "SELECT * FROM choices
			 WHERE question_number = $number";
	// Get the results
	 $choices =$mysqli->query($query) or die($mysqli->error.__LINE__); 

?>
	<main>
		<div class="container">
			<div class="current">Question <?php echo $question['question_number']; ?> of <?php echo $total; ?></div>
			<p class="question">
			 	<?php echo $question['text']; ?>
		 	</p>
			<form method="post" action="process.php">
				<ul class="choices">
					<?php while($row = $choices->fetch_assoc()): ?>
					<li><input type="radio" name="choice" 
								value="<?php echo $row['id']; ?>">
						<?php echo $row['text']; ?></li>
					<?php endwhile?>
				</ul>
				<input type="submit" value="Submit">
				<input type="hidden" name="number" value="<?php echo $number; ?>">
			</form>
		</div>
	</main>
<?php include 'layout/footer.php'; ?>