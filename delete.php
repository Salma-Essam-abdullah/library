
<?php

$conn = mysqli_connect("localhost" , "root" , "" ,"books");
if(!$conn){
    echo mysqli_connect_error();
    exit;
}
//select user
$number=filter_input(INPUT_GET, 'number' , FILTER_SANITIZE_NUMBER_INT);
$query ="DELETE FROM `list` WHERE `list`.`number`=" . $number. " LIMIT 1";

if(mysqli_query($conn , $query)){
    
    header("Location: list.php");
    exit;
}
else{
    echo mysqli_error($conn);
}

mysqli_close($conn);
?>



