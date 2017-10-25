<?php
 
include 'connection.php';
 error_reporting(0);
  $companyName = $_POST['CompanyName'];
  $street = $_POST['Street'];
  $postnr = $_POST['Postnr'];
  $city= $_POST['City'];
  $description= $_POST['Description'];
  $website= $_POST['Website'];
  $facebook= $_POST['Facebook'];
if(!$_POST['submit']){
	// you can remove this echo code and add alert using JS or use required tag in your input feilds.
	
  echo "All feilds must be filled";
  
}

else {
 // insert into tableName (feilds) values (variables) If still you cant understand please check videos on my youtube channel NOSGENE or comment there so i can help you
 
$sql = "INSERT INTO company(companyName,street,postnr,city,description,website,facebook)
VALUES ('$companyName', '$street', '$postnr', '$city', '$description', '$website', '$facebook')";

if (mysqli_query($conn, $sql)) {
    echo "<h1><center>New record created successfully</center></h1>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>

<html>
<head>
<title>Add Company Data</title>
</head>

<body>
   
	<h2>Add Updates from this menu</h2>
		<form action="add.php" method="POST">
			CompanyName: <input type="text" name="companyName" value="" required><br><br>
			Street: <input type="text" name="street" value="" required><br><br>
			Postnr: <input type= "10" name="postnr" value="" required><br><br>
			City: <input type="text" name="city" value="" required><br><br>
			Description: <input type="text" name="description" value="" required><br><br>
			Website: <input type="text" name="website" value="" required><br><br>
			Facebook:<input type= "text" name="facebook" value="" required><br><br>
	
			<input type="submit" name="submit" value="add"/></center>
</body>

<!--
	Similarly you can make delete and updates pages with little changes in sql query and here and there. If you need to learn those too
	please check my youtube channel NOSGENE as i am running a full stack web development course there right now.
 -->

 <!--
      ENCODED BY RAMEEZ SAFDAR / For more web and other programmings check out my channel nosgene https://www.youtube.com/channel/UCYbUaMVWujooISm4m7NDIeg
 -->
</html>