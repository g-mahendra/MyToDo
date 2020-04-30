<?php

$conn=mysqli_connect("localhost", "root", "", "toDo");
// if($conn->connect_error)
// 	echo "Connection Error";
// else
// 	echo "Connection Successfull";

if(isset($_POST['submit']))
{
	$textbox=$_POST['textbox'];
	$sql="insert into Todo(Title) values('$textbox')";
	mysqli_query($conn, $sql);
}

if(isset($_GET['delete']))
{
	$id=$_GET['delete'];
	$sql="delete from Todo where ID=$id";
	mysqli_query($conn, $sql);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>TO Do List</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="ToDo2.css">

	<style type="text/css">
		#tab td:hover {
		background: black;
		color: white;
		border: none;
	}

	#tab tr:nth-child(even) {
		background: yellow;
		color: black;
	}

	#tab tr:nth-child(odd) {
	background: white;
	}

	.href {
		text-decoration: none;
		color: black;
		display: block;
		background: transparent;
		border: none;
	}

	a:hover{
		color: white;
		background: red;
	}

	</style>

</head>
<body>
	<div id="main">
		<div id="h"><h1>TASKS TO DO</h1></div>
		<div id="upper">
			<form method="post">
				<div id="textbox">
					<input type="textbox" name="textbox" id="textbox" style="width: 100%; padding: 10px; border: none; height: 21px;" placeholder="Add tasks to see them bellow">
				</div>
				<div id="btn">
					<input type="submit" name="submit" value="submit" style="padding: 10px; display: inline-block; background: lightgreen; border: none;height: 40px;">
				</div>
			</form>
		</div>
		<div id="lower">
			<?php

			$sql1="select * from Todo order by ID desc";
			$res=mysqli_query($conn, $sql1);
			$cnt=mysqli_num_rows($res);
			if($cnt>0)
			{
				?>
					<table id="tab">
						<?php

						while ($row=mysqli_fetch_assoc($res))
						{
							?>
								<tr>
									<td width="90%"><?php echo $row['Title']?></td>
									<td style="background: red; display: inline-block; border: none;" ><a class="href" href="ToDo2.php?delete=<?php echo $row['ID'];?>">Remove</a></td>
								</tr>
							<?php
						}

						?>
					</table>
				<?php }
			?>
		</div>
	</div>
</body>
</html>