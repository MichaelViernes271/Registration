<!DOCTYPE html>
<html>
<head>
	<title>Table with database</title>
	<style type="text/css">
		table {
			border-collapse: collapse;
			width: 100%;
			color: #d96459;
			font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
			font-size: 25px;
			text-align: left;
		}

		th {
			background-color: #588c7e;
			color: white;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		caption {
			font-family: serif;
			font-size: 4rem;
		}
		caption::before{
			content: "📃";
		}
	</style>
</head>
<body>
	<table>
		<caption>Registration Roll</caption>
		<tr>
			<th>Id</th>
			<th>Username</th>
			<th>Password</th>
		</tr>
		<?php
		$conn = mysqli_connect("localhost", "root", "", "tutorial");
		if($conn -> connect_error){
			die("Connection_failed: " . $conn-> connect_error);
		}

		$sql =  "SELECT Id, Username, Password from users";
		$result = $conn-> query($sql);

		if($result-> num_rows > 0){
			while($row = $result-> fetch_assoc()){
			echo "<tr><td>" . $row["Id"] . "</td><td>" . $row["Username"] . "</td><td>" . $row["Password"] . "</td></tr>";
			}
			echo "</table>";
		}
		else{
			echo "0 results";
		}

		$conn-> close();
		?>
	</table>

</body>
</html>