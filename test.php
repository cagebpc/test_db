<!DOCTYPE html>
<html>
<head>
	<title>WORK</title>
	<meta charset="utf-8">
</head>
<body>

<style type="text/css">
	table ,th ,td{
		border: 1px solid black;
		border-collapse: collapse;

	}
	th, td{
		padding: 5px;
		text-align: center;
	}
	.form p{
		text-align: left;
	}
	
	#age{
		position: relative;
		left: 13px;
	}
	
	/*#submit{
	position: absolute;
    left: 8%;
    background-color: antiquewhite;
    border-radius: 10px;
    width: 80px;
    height: 25px;
	}*/	


	
</style>

<?php
include_once("db.php");

echo "<table>";
echo "<tr><th>№</th><th>Name</th><th>Age</th><th>Salary</th><th>Delete</th></tr>";

$query = "SELECT * FROM test";
$result = mysqli_query($link, $query);

while ($row = mysqli_fetch_assoc($result)) {
	echo "<tr>";
 	echo "<td>".$row['id'] ."</td><td>".$row['name']."</td>"; 
	echo "<td>".$row['age']. "</td><td>" .$row['salary']. "</td>"; 
	echo "\t\t<td>"."<a href='/?id=".$row['id']."&delete=1'>x</a>"."</td>\n";
	echo "</tr>";
}


if(isset($_GET['id']))
{
  $query = "DELETE FROM test WHERE id=".$_GET['id'];
  $result = mysqli_query($link, $query);  

if($result) {
     header("HTTP/1.1 301 Moved Permanently"); 
     header("Location: http://test.loc?delete_finish=OK"); 
     exit();
  }
  else {
     header("HTTP/1.1 301 Moved Permanently"); 
     header("Location: http://test.loc?delete_finish=Error"); 
     exit();
     }	
 }


 
 
if(isset($_POST['create']) && $_POST['create'] == '1')
{

  $name = $_POST['name'];
  $age = $_POST['age'];
  $salary = $_POST['salary'];
  if(isset($name) && !empty($name) && isset($age) && !empty($age) && isset($salary) && !empty($salary) )
  {
    $query = 'INSERT INTO `test`(name, age, salary, test) VALUES ("'.$name.'", '.$age.','.$salary.', 1 )';

    $result = mysqli_query($link,$query);

    if($result) {
      header("HTTP/1.1 301 Moved Permanently"); 
      header("Location: http://test.loc?create_finish=OK"); 
       exit();
    }else {
      header("HTTP/1.1 301 Moved Permanently"); 
      header("Location: http://test.loc?create_finish=Error"); 
       exit();
    }
  }
}


mysqli_close($link);


?>
<div class="form">
<form action="" method="post">
<p>Name: <input type="text" name="name" /></p>
<p>Age: <input type="text" name="age" / id="age"></p>
<p>Salary: <input type="text" name="salary" id="salary"></p>
<p><input type="submit" value="create"  id="submit" /></p>
<p style="opacity: 0"><input type="text" value="1" name="create" /></p>
</form>
</div>
</body>
</html>
