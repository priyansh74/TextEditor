<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
   exit; // Ensure script stops after redirection
}

// Include database connection
include_once 'database.php';

$username = $_SESSION["email"];
$query = "SELECT text_data FROM users WHERE email='$username'";
$result = mysqli_query($conn, $query);

// Check if the query returned a result
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $text_from_db = $row['text_data'];
} else {
    // Set a default value if no data found
    $text_from_db = '';
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Text Editor</title>
  <a href="logout.php" class="btn btn-warning">Logout</a>
  <link rel="icon" href="icon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <!-- fontawesome cdn For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" integrity="sha512-PgQMlq+nqFLV4ylk1gwUOgm6CtIIXkKwaIHp/PAIWHzig/lKZSEGKEys
h0TCVbHJXCLN7WetD8TFecIky75ZfQ==" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="">
  <h1 class="shadow-sm">TEXT EDITOR</h1>
    <div class="flex-box">
      <div class="row">
        <div class="col">
          <button type="button" onclick="f1()" class=" shadow-sm btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Bold Text">Bold</button>
          <button type="button" onclick="f2()" class="shadow-sm btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Italic Text">Italic</button>
          <button type="button" onclick="f3()" class=" shadow-sm btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Left Align"><i class="fas fa-align-left"></i></button>
          <button type="button" onclick="f4()" class="btn shadow-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Center Align"><i class="fas fa-align-center"></i></button>
          <button type="button" onclick="f5()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Right Align"><i class="fas fa-align-right"></i></button>
          <button type="button" onclick="f6()" class="btn shadow-sm btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Uppercase Text">Upper Case</button>
          <button type="button" onclick="f7()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Lowercase Text">Lower Case</button>
          <button type="button" onclick="f8()" class="btn shadow-sm btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Capitalize Text">Capitalize</button>
          <button type="button" onclick="f9()" class="btn shadow-sm btn-outline-primary side" data-toggle="tooltip" data-placement="top" title="Tooltip on top">Clear Text</button>
          <button type="button" onclick="f10()" class="btn shadow-sm btn-outline-primary side" data-toggle="tooltip" data-placement="top" title="Download">Download</button>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-3 col-sm-3">
      </div>
      <div class="col-md-6 col-sm-9">
        <div class="flex-box">
          <form method="post">
            <textarea id="textarea1" class="input shadow" name="text" rows="15" cols="100" placeholder="Your text here"><?php echo $text_from_db; ?></textarea>
            <button type="submit" name="save" class="btn shadow-sm btn-outline-primary side">Save</button>
            <button type="submit" name="load" class="btn shadow-sm btn-outline-primary side">Load</button>
          </form>

        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>
  </section>
<br>
<br>

  <script src="home.js"></script>
</body>

</html>

<?php

// Save text to database
if(isset($_POST['save'])){
  $text = $_POST['text']; // Accessing textarea value using $_POST['text']
  $username = $_SESSION["email"];
  $query = "UPDATE users SET text_data='$text' WHERE email='$username'";
  mysqli_query($conn, $query);
}

// Load text from database
$username = $_SESSION["email"]; // Assuming $_SESSION["user"] contains email
$query = "SELECT text_data FROM users WHERE email='$username'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$text_from_db = $row['text_data'] ?? '';
?>


