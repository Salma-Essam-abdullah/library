<?php

$error_fields = array();
$conn = mysqli_connect("localhost" , "root" , "" ,"books");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}
$number=filter_input(INPUT_GET, 'number' , FILTER_SANITIZE_NUMBER_INT);
$select = "SELECT * FROM   `list` WHERE `list`.`number`=" . $number. " LIMIT 1" ;
$result = mysqli_query($conn , $select);
$row = mysqli_fetch_assoc($result);
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if(! (isset($_POST['book_title']) && !empty($_POST['book_title']))){
        $error_fields[]="book_title";
    }
    
    if(! (isset($_POST['author_name']) && !empty($_POST['author_name']))){
        $error_fields[]="author_name";
    }
    if(! (isset($_POST['edition']) && !empty($_POST['edition']))){
        $error_fields[]="edition";
    }
  
    if(!$error_fields){
           //escape special char to avoid sql injection
            $number=filter_input(INPUT_POST , 'number' , FILTER_SANITIZE_NUMBER_INT);
            $book_title=mysqli_escape_string($conn , $_POST['book_title']);
            $author_name=mysqli_escape_string($conn , $_POST['author_name']);
            $edition=mysqli_escape_string($conn , $_POST['edition']);
            //insert data
            $query="UPDATE `list` SET `book_title` = '".$book_title."' , `author_name` = '".$author_name."' , `edition` = '".$edition."' WHERE `list`.`number` = ". $number; 
            if(mysqli_query($conn , $query)){
                //redirect to page list.php
                header("Location: list.php");
                exit;
            }
            else{
                echo mysqli_error($conn);
            }
            //close connection
            mysqli_close($conn);
                } 
}
?>






<!-- new -->
<html >
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="css/style.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
   <link rel="stylesheet" href="style.css">
    <title>Add Books</title>
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
                    <li  ><a style="padding-bottom: 70px;" href="logout.php"class="btn btn-danger ml-3">LOGOUT</a></li>
                </ul>
            </div>
  
        </div>
    </nav>

  <div class="content" style="padding-bottom: 200px; padding-top:200px">
    
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10">
          

          <div class="row justify-content-center">
            <div class="col-md-6">
              
              <h3 class="heading mb-4">Let's Add Books</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptas debitis, fugit natus?</p>

              <p><img src="images/undraw-contact.svg" alt="Image" class="img-fluid"></p>


            </div>
            <div class="col-md-6">
              
              <form  method="post"  >

                <div class="row">
                  <div class="col-md-12 form-group">
                  <input type="hidden" name="number" id="number" value="<?=(isset($row['number'])) ? $row['number']:'' ?>" />
                     </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="book_title" id="book_title" placeholder="Book Title"value="<?=(isset($row['book_title'])) ? $row['book_title']:'' ?>" /> <?php if(in_array("book_title" , $error_fields)) echo "* Please enter book_title" ; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Author Name"  value="<?=(isset($row['author_name'])) ? $row['author_name']:'' ?>" /> <?php if(in_array("author_name" , $error_fields)) echo "* Please enter author name" ; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name="edition" id="edition" placeholder="Book Edition"  value="<?=(isset($row['edition'])) ? $row['edition']:'' ?>" /> <?php if(in_array("edition" , $error_fields)) echo "* Please enter author name" ; ?>
                </div>
               
                <div class="row">
                  <div class="col-12">
                  
                    <input type="submit" name="submit" value="Edit Book" class="btn btn-primary rounded-0 py-2 px-4">
                  
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
    
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

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/main.js"></script>

  </body>
</html>