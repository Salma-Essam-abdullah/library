<?php
session_start();
$conn = mysqli_connect("localhost" , "root" , "" ,"books");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}
//select all users
$query = "SELECT * FROM `list` ";
if (isset($_GET['search'])){
  $search = mysqli_escape_string($conn , $_GET['search']);
  $query.= " Where `list`.`book_title` LIKE '%".$search."%'";
}
$result = mysqli_query($conn , $query);
?>
<html>
    <head>
        <title>
        Books
        </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
   <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <nav class="nav">
        <div class="container">
            <div class="logo">
                <a href="home.php">BOOKS</a>
            </div>
            <div id="mainListDiv" class="main_list">
                <ul class="navlinks">
                    <li><a href="home.php">HOME</a></li>
                    <li><a href="home.php">SERVICES</a></li>
                    <li><a href="home.php">ABOUT</a></li>
                    <li><a href="list.php">BOOKS</a></li>
                    <li><a href="home.php">TEAM</a></li>
                    <li><a href="home.php">CONTACT</a></li>
                   
                     
    <?php
   
   if(isset($_SESSION['id'])) {
   ?>
      <li><a href="logout.php" class="btn btn-danger ml-3">LOGOUT</a></li>
   <?php
   }
   else{
     echo " ";
   }
?>            
                </ul>
            </div>
  
        </div>
    </nav>

        <h1 style="padding-top: 200px; margin-left:50px ; margin-bottom: 30px;">List Books</h1>     
        <form method="GET" style="margin-left:50px;">
            <input style="padding: 20px;" type="text" name="search" placeholder="Enter book name" />
            <input  style="padding: 20px;" type="submit" value="SEARCH" class="btn-success"/>
        </form>
       

        <?php
                while($row = mysqli_fetch_assoc($result)){
                ?>
        <div class="card" style="width: 20rem ; display: inline-block ; margin-top: 30px; margin-left:10px" >
  <div class="card-body">
      
    <h5 class="card-title">Book Title : <?=$row['book_title']?></h5>
    <h6 class="card-subtitle mb-2 text-muted">Book Number : <?=$row['number']?></h6>
    <p class="card-text">Author Name : <?=$row['author_name']?></p>
    <p class="card-text">Edition : <?=$row['edition']?></p>
    <p class="card-text">Submission Date : <?=$row['sumbission_date']?></p>
   
    
    <?php
   
    if(isset($_SESSION['id'])) {
    ?>
         <a class="btn-success" style="padding: 15px; text-decoration: none;" href="edit.php?number=<?=$row['number']?>" class="card-link">Edit</a>
    <a class="btn-danger" style="padding: 15px; text-decoration: none;" href="delete.php?number=<?=$row['number']?>" class="card-link">Delete</a>
    <?php
    }
    else{
      echo " ";
    }
?>



  
  </div>
</div>

           
<?php
                }
?>
<h4  style="margin-left:40px"><?= mysqli_num_rows($result)?> Books</h4>
<?php
   
   if(isset($_SESSION['id'])) {
   ?>
      <h5 style="margin-left:40px " > <a href="add.php"type="button" style= " padding:25px" class="btn btn-success">Add Book</a></h5></p>
   <?php
   }
   else{
     echo " ";
   }
?>
               

                 <!-- Site footer -->
  <footer id="footer" class="site-footer">

<div class="container">
  <div class="row">
    <div class="col-sm-12 col-md-6">
      <h6>About</h6>
      <p class="text-justify"> 
        E BOOKS
        A personalised digital reading experience for students of all ages and afalities. An exclusive Free offer from the best differentiation platform for teachers. View Products. Read Blog.</p>
    </div>

    <div class="col-xs-6 col-md-3">
      <h6>Categories</h6>
      <ul class="footer-links">
        <li>SCIENCE</li>
        <li>SOCIAL</li>
        <li>HISTORY</li>
        <li>MATH</li>
        <li>STORIES</li>
        <li>DICTIONARY</li>
      </ul>
    </div>

    <div class="col-xs-6 col-md-3">
      <h6>Contact Us</h6>
      <ul class="footer-links">
        <li>Phone : 01206982449</li>
        <li>Address : 19 st. Miami, Alexandria</li>
      </ul>
    </div>
  </div>
  <hr>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-sm-6 col-xs-12">
      <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved
      </p>
    </div>

   
  </div>
</div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>
    
</html>
<?php 
mysqli_free_result($result);
mysqli_close($conn);
?>