

<html>

<head>

	<link rel="stylesheet" type="text/css" href="eventInfoStyle.css">

	<link rel="stylesheet" type="text/css" href="headbar.css">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script type="text/javascript" src="header.js"></script>
<link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel= "stylesheet" href= "../bootstrap1.css">
    <link rel="stylesheet" href="../main.css">
	



</head>

<style>

.headbar{

margin-top:-4em;

}

</style>

<body>

 <div class="nav">
      <div class="container">
        <ul class= "pull-right nav nav-pills">
          <li><a href="../index.html">Home</a></li>
          <li><a href="../forms/index.php">Forms</a></li>
          <li><a href="../myStats/index.php">My Stats</a></li>
          <li><a href="../members/index.php">Members</a></li>
          <li><a href="../events/index.php">Events</a></li>
          <li><a href="../admin/index.php">Admin Login</a></li>
          <li><a href="../members/signup.php">Create Account</a></li>
        </ul>
      </div>
    </div>
 </div>

<?php //starting tag


// Check connection
$con = mysqli_connect("localhost", "root", "");mysqli_select_db($con, "WVNHSV2");
if (mysqli_connect_errno()) {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

}

$event = $_GET['eventName'];

$result = mysqli_query($con,"SELECT * FROM Events WHERE Name='$event'");



while($row = mysqli_fetch_array($result)) {

  $eventName=$row['Name'];

  $date=$row['Date'];

  $spotsTaken=$row['Spots_Taken'];

  $totalSpots=$row['Total_Spots'];
  $credits_worth= $row['Credits_Worth'];

 }

 

$result = mysqli_query($con,"SELECT * FROM $eventName");



$newName = preg_replace('/(?<!\ )[A-Z]/', ' $0', $eventName);



echo "<h1>".str_replace("_", " ", $newName)."</h1>";

$date2 = date_create($date);

echo "<h2>".date_format($date2, "l,  F d")."</h2>";



$file = file_get_contents('uploads/'.$eventName.'.txt', true);

echo "<div class='announcmentWrapper' id='announcment'>

		 	<div class='announcment'>

		 		<h1>Event Details</h1>

		 		<hr class = 'experiencehr'>

				<p>".$file."</p>			

				<hr class = 'experiencehr'>

				<p>Spots Taken: ".$spotsTaken."<br>Total Spots: ".$totalSpots." <br>Gives ".$credits_worth. " credits

				

			</div>

		</div>

		<div class='announcmentWrapper' id='announcment'>

		 	<div class='announcment'>

			<h1>Members Attending</h1>

			<hr class = 'experiencehr'>

				";//<ol>";

				

				$result2 = mysqli_query($con,"SELECT * FROM $event");



			//	while($row = mysqli_fetch_array($result2)) {

				 //echo "<p><li>".$row['FirstName']." ".$row['LastName']."</li></p><br>";

					echo"<p> To see if you have signed up for this event, please check your <a href ='../myStats'>My Stats</a> page!</p>";

			//	 }

				

			echo 

		//	</ol>

			"</div>

		 </div>";



$canSign = true;

if($spotsTaken>=$totalSpots) $canSign=false;

echo "<div class='announcmentWrapper' id='announcment'>

		 	<div class='announcment'>

			<form action='signUp.php?eventName=".$eventName."' method='post'>

<p>User Identification:</p> <input type='text' name='id'><br>

<input type='submit' value='Sign Up!'";

if(!$canSign)echo "disabled";

echo "/>

</form>

<div class = 'sideImage'>

	<img src='wvlogo.png'>

</div>

<p>Signing up means that there are less spots for other members.<br> PLEASE don't sign up unless you are 100% sure you can attend.<br>In the event of a last minute emergency, please contact an NHS Board member.</p>

</div></div>";





mysqli_close($con);



?>









</body>

</html>
