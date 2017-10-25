<?php
/*
	file:	persons.php
	desc:	Lists all persons in person-table
*/
if(!empty($_POST['keyword'])) $keyword=$_POST['keyword'];else $keyword='';
$keyword.='%%';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Database Example with Personnel db</title>
	</head>
	<body>
		<h3>Personnel</h3>
		<form action="login.php" method="post">
			Email<input type="text" name="email" />
			Password<input type="password" name="password" />
			<input type="submit" value="Login" />
		</form>
		<h4>List of companies</h4>
		<p>
			<form action="addCompany.php" method="post">
			Search <input type="text" name="keyword" placeholder="Search" />
			<input type="submit" value="Search" />
			</form>
		</p>
		<?php
		echo '<table><tr><th>ID#</th><th>Lastname</th><th>Firstname</th>';
		echo '<th>Email</th><th>Salary</th><th>Department</th></tr>';
		include('db.php'); //use the database connection
		$sql = "SELECT person.personID,firstname,lastname,email,salary,department.department
				FROM company 
				LEFT JOIN placement
				ON company.companyID=placement.companyID
				LEFT JOIN companyarea
				ON placement.companyareID=department.depID 
				WHERE firstname LIKE '$keyword' OR 
				lastname LIKE '$keyword'
				ORDER BY lastname,firstname";
		$result=$conn->query($sql);  //runs the query in database
		while($row=$result->fetch_assoc()){
			echo '<tr>';
			echo '<td>'.$row['personID'].'</td>';
			echo '<td>'.$row['lastname'].'</td>';
			echo '<td>'.$row['firstname'].'</td>';
			echo '<td>'.$row['email'].'</td>';
			echo '<td>'.$row['salary'].'</td>';
			echo '<td>'.$row['department'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
		$conn->close();
		?>
	</body>
</html>







