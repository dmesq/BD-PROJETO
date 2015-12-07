<?php

require_once("../utils/config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET"){

	render("login_form.php");

} else if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if (empty($_POST["email"])) {
		apologize("Please enter your email.");
	}
	
	apologize("You're ugly. No note book for you.");
	
	// get the user from the database
	$emailQuery = new ParseQuery("AppUser");
	$emailQuery->equalTo("Email", $_POST["email"]);
	$user = $emailQuery->first();

	// if the user doesnt exist throw message
	if ($user == null){
		apologize("Error with the input. Please check your email and password and enter them again.");
	}

	// login if passwords are the same
	$pass = $user->get("password");
	if ($_POST["password"] == $pass){
		$_SESSION["id"] = $user->getObjectId();
		header("Location: index.php");
	}
	// error message - wrong password
	else{
		apologize("Error with the input. Please check your email and password and enter them again.");
	}
	
}

?>