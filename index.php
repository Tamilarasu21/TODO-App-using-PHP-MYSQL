<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
  <style>
    body
    {
      margin:0;
      padding:0;
      font-family:verdana;
      font-size:16;
    }
    input[type=text]
    {
        width:200px;
        height:30px;
        font-size:17px;
    }
    input[type=submit]
    {
        width:100px;
        height:30px;
        background:green;
        color:snow;
        border-color:green;
        border-radius:4px;
    }
    input[type=submit]:hover
    {
        color:#000;
        background:yellowgreen;
        border-color:yellowgreen;
    }
    .success
    {
        width:200px;
        margin:auto;
        padding:5px 5px;
        border-radius:4px;
        background:green;
        color:snow;
    }
    .fail
    {
        width:200px;
        margin:auto;
        padding:5px 5px;
        border-radius:4px;
        background:red;
        color:snow;
    }
    .todo
    {
        width:400px;
        margin:auto;
    }
    a
    {
        text-decoration: none;
        color:red;
    }
  </style>
    <br>
<?php 
  $con=mysqli_connect("localhost","root","","todo");

  $url="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  if(strpos($url,"delete=success")==true)
  {
      echo "<p class='success'>Deleted Successfully</p>";
  }
  elseif(strpos($url,"add=success")==true)
  {
    echo "<p class='success'>Added Successfully</p>";
  }
  elseif(strpos($url,"add=failed")==true)
  {
    echo "<p class='fail'>Insertion Failed</p>";
  }
  elseif(strpos($url,"add=failed")==true)
  {
    echo "<p class='fail'>Insertion Failed</p>";
  }
  elseif(strpos($url,"empty=failed")==true)
  {
    echo "<p class='fail'>Task cannot be empty</p>";
  }
?>
<br>
<div class="todo">
    <form action="" method="post">
        <label for="task"></label><input type="text" name="task" id="task">
        <input type="submit" name="add" value="add">
    </form>
</div>
<br>
<hr>
</body>
</html>
<?php

  // code for adding 
  if(isset($_POST['add']))
  {
      $task=$_POST['task'];
      if(empty($task))
      {
        header("Location:index.php?empty=failed");
      }
      else
      {
        $query="insert into task (task) values('$task')";
        $run=mysqli_query($con,$query);
        if($run)
        {
            header("Location:index.php?add=success");
        }
        else
        {
          header("Location:index.php?add=failed");
        }
      }   
  }

  // code for displaying
  $sql="select * from task";
  $exe=mysqli_query($con,$sql);
  while($line=mysqli_fetch_assoc($exe))
  {
      echo "<center><p>";
      echo $line['task'];
    ?>
      &emsp;<a href="index.php?id=<?php echo $line['id'] ?>" name="delete" class="delete"><i class="fa fa-trash fa-2x"></i></a><p><center><hr>
    <?php
  }

  // code for deleting
  if(isset($_GET['id']))
  {
      $id=$_GET['id'];
      $sql="delete from task where id='".$id."'";
      $run=mysqli_query($con,$sql);
      if($run)
      {
          header("Location:index.php?delete=success");
      }
  }
?>