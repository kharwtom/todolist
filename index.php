<html>
  <head>
    <title>Todo App</title>
    <!-- <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'> -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <?php 
	$db = mysqli_connect("localhost", "root", "", "task_db");

	if(isset($_POST['submit'])) {
      $task = $_POST['task'];
      $sql = "INSERT INTO `tasks`(`task`, `isDone`) VALUES ('$task',0)";
      mysqli_query($db, $sql);
  }
  if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
  
    mysqli_query($db, "DELETE FROM tasks WHERE tid=".$id);
    header('location: index.php');
  }
  if (isset($_GET['com_task'])) {
    $id = $_GET['com_task'];
  
    mysqli_query($db, "UPDATE `tasks` SET `isDone`= 1  WHERE `tid`=".$id);
    header('location: index.php');
  }
  ?>
  </head>
  <body>
    <div class="container">
      <h1>TO DO LIST</h1>
        <form method="post" action="index.php">
          <input type="text" name="task">
          <button class="btn btn-primary" type="submit"  name="submit">Add</button>
		    </form>
      <ul>
      <?php 
		$tasks = mysqli_query($db, "SELECT * FROM tasks");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { 
      if($row['isDone']==0)
        echo '<h3><li><a href="index.php?com_task='.$row['tid'].'"><button class="btn btn-outline-warning">is done?</button></a><span class="label label-default">';
      else
        echo '<h3><li><span class="label label-success">';

        echo $row['task'].'</span>';

        echo '<a href="index.php?del_task='.$row['tid'].'"><button class="btn btn-danger">Delete</button></a></li></h3>';
    }
    ?>
      
      
      </ul>
    </div>
  </body>
</html>