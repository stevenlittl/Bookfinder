<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Set Website Title -->
    <title>BookFinder</title>
    <!-- Set Favicon -->
    <link rel="icon" href="Images/logo.png">
    <link rel="stylesheet" href="CSS/main.css">
    <!-- Add Bootstrap to Style Forms (can do myself but this is easier, "The Best Code is No Code") -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Add Font -->
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>
    <!--Include Header-->
    <?php include("includes/header.html"); ?>
    <?php
        // run sql setup
        require_once("sqlconfig.php");
        
        // define variables and set to empty values
        $name = $description = $isbn = $publishedYear = "";

        //When form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // get form entries
            $name = test_input($_POST["name"]);
            $description = test_input($_POST["description"]);
            $isbn = test_input($_POST["isbn"]);
            $publishedYear = test_input($_POST["publishedYear"]);

            $INSERT = "INSERT Into books (title, description, ISBN, publishedYear) values(?, ?, ?, ?)";
            //prepare statement
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssi", $name, $description, $isbn, $publishedYear);
            $stmt->execute();
            $stmt->close();
        }

        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
        
    ?>
    <!-- New Item Entry -->
    <div class="main">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <br>
            <label for="name">Title</label>
            <input required class="form-control" type="text" id="name" name="name">
            <label for="name">Description</label>
            <textarea class="form-control" name="description"></textarea>
            <label for="name">ISBN</label>
            <input class="form-control" type="text" id="isbn" name="isbn">
            <label for="name">Year Published</label>
            <input class="form-control" type="text" id="year" name="publishedYear">
            <br>
            <input type="submit" name="submit" class="btn" value="Add Book">  
        </form>
    </div>
</body>
</html>

