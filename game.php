<?php 
	// check if name param was provided
	if (! isset($_GET["name"]) || strlen($_GET["name"]) < 1) {
		// deny access if key was not provided OR its value is missing
		die("Name parameter missing");
	}

	// logout user and return to homepage
	if ( isset($_POST['logout']) ) {
	    header('Location: index.php');
	    exit;
	}

	// set the default values for needed variables
	$message = "Please select a strategy and press Play.";
	$computer = rand(0, 2);
	$human = -1;
	$options = ["Rock", "Paper", "Scissors"];

	// check if the human changed their input
	if (isset($_POST["human"])) {
		if (isset($_POST["human"]) !== -1) {
			// grab the new human input
			$human = $_POST["human"];
			// change the message based on computer/human input
			$message = check($computer, $human);
		}
		
	}

	// compare the two inputs
	function check($computer, $human){
		// I couldn't come up with the arithmetics of % on my own, the solutions 
		// I found were still including about 3 if/ifelse statements. 
		if ($computer == $human ) {
			return "Tie";
		} elseif ($human == -1){
			return "Please select a strategy and press Play.";
		}

		$r = $computer - $human;

		if ($r == 1 || $r == -2) {
			return "You lose";
		}  else {
			return "You win";
		}	
	}

	// retrieve the image assigned to chosed option
	function displaylogo ($pickID){
		$logos_array = ["rock-logo.png", "paper-logo.png", "scissors-logo.png"];
		return $logos_array[intval($pickID)];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Alexandra Nemes RPS f68f71e0</title>
	<link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
	<div class="container">
		<h1 class="title">Rock Paper Scissors</h1>

		<?php 
			if (isset($_REQUEST["name"])) {
				print "<p class='greeting'>Welcome, ". htmlentities($_GET['name']) . "!</p>";
			}
		?>

		<form class="form" method="POST">
			<select name="human">
				<option value="-1" selected>Select</option>
				<option value="0">Rock</option>
				<option value="1">Paper</option>
				<option value="2">Scissors</option>
				<option value="3">Test</option>
			</select>
			<input type="submit" value="Play">
			<input type="submit" value="Logout" name="logout">
		</form>
		<pre>
<?php

if ( $human == -1 ) {
    print $message;
} else if ( $human == 3 ) {
    for( $c = 0; $c < 3; $c++ ) {
        for( $h = 0; $h < 3; $h++ ) {
            $r = check($c, $h);
            print "Human=$options[$h] Computer=$options[$c] Result=$r\n";
        }
    }
} else {
    print "Your Play=$options[$human] <img class='logo' src='" . displaylogo($human) . "'> Computer Play=$options[$computer] <img class='logo' src='" . displaylogo($computer) .  "'> Result=$message.\n";
}

?>
		</pre>		
	</div>
</body>
</html>