

<html>

<head>

	<!--<link rel="stylesheet" type="text/css" href="../events/eventInfoStyle.css">

	<link rel="stylesheet" type="text/css" href="../events/headbar.css">-->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script type="text/javascript" src="../events/header.js"></script>
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

.announcmentWrapper{

	margin-top:5em;

}

h2{

	text-align: left;

}

.remove{

	float:right;

	color:red;

	font-weight: bolder;

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



echo "<h1>Adding Credits</h1><br><br>";

$id = $_GET['id'];

$eventName = $_GET['event'];


$event = mysqli_query($con,"SELECT * FROM Events WHERE Name='$eventName'");

$member = mysqli_query($con,"SELECT * FROM members WHERE ID='$id'");




$membersInEvent = mysqli_query($con,"SELECT * FROM $eventName WHERE ID='$id'");

	$credits=0;
	$creditTally=0;
	$spotsTaken=0;
	while($row = mysqli_fetch_array($event)) {
		$credits = $row['Credits_Worth'];
		$creditTally= $row['Credit_Tally'];
		$totalSpots= $row['Total_Spots'];
		$spotsTaken= $row['Spots_Taken'];
		
	}


if($creditTally < $totalSpots){
while($member1 = mysqli_fetch_array($membersInEvent)) {

	echo "Adding ".$credits." credit(s) to ".$member1['FirstName']." ".$member1['LastName']." for ".$eventName;

}
$oldVal=0;
while($row2=mysqli_fetch_array($member)){
	$oldVal= $row2['Credits'];
}
	
	$newVal= $oldVal+$credits;
	mysqli_query($con,"UPDATE members SET Credits='$newVal' WHERE ID=$id");
	$creditTally+=1;
	
	mysqli_query($con, "UPDATE events SET Credit_Tally = '$creditTally' WHERE Name= '$eventName' ");
	
	if($creditTally == $spotsTaken ){
		mysqli_query($con, "UPDATE events SET Credits_Added = '1' Where Name= '$eventName'");
	}

}
else{
	echo "Credits have already been added for this event.";
}
mysqli_close($con);


?>
<script type='text/javascript'>window.location.href = 'eventMemberList.php?pass=a12B7low8'</script>









</body>

</html>
