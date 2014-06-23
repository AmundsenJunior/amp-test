<!DOCTYPE html>

<html>

	<head>

	</head>

	<body>

		<h1>PHP Test Page</h1>

		<h2>PHP Test Form</h2>

		<div>
			<form action="insert.php" method="post">
				Name:<br>
				First: <input type="text" name="fname">
				Middle: <input type="text" name="mname">
				Last: <input type="text" name="lname"><br>
				Date of Birth:<br>
				Day: <input type="integer" name="dbirth">
				Month: <input type="text" name="mbirth">
				Year: <input type="integer" name="ybirth"><br>
				Gender:
				<select name="gender">
					<option value=""></option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Other">Other</option>
				</select><br>
				18 or older?:
				<input type="radio" name="age" value="Yes">Yes
				<input type="radio" name="age" value="No">No<br>
				<input type="submit" value="Submit Information">
			</form>
		</div>

		<div>
			<h2>MySQL Test Table</h2>

			<?php include 'select.php'; ?>
		</div>



	</body>

</html>