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
    <div class="page-container">
    <?php
        // define variables and set to empty values
        $name = "";
        require_once("sqlconfig.php");
        //Create Request for all the books
        $SELECT = "SELECT * FROM books";
        $result = $conn->query($SELECT);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = test_input($_POST["name"]);
            require_once("sqlconfig.php");
            //Create request for the books whose title contains the search term
            $SELECT = 
            "SELECT * FROM books
            WHERE title LIKE '%$name%'";
            $result = $conn->query($SELECT);
            $conn->close();
        }


        //Remove extra characters to avoid SQL Injection
        function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
        }
    ?>
    <!--Include Header-->
    <?php include("includes/header.html"); ?>
    <div class="main">

        <!--Search Bar-->
        <h2>Bookfinder Search</h2>
        <form class="flex-between" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            <input class="form-control" type="text" name="name">
            <input class="form-control" type="submit" name="submit" value="Search">  
        </form>

        <!--Area For Books-->
        <div class="books">
                <?php
                    //Print the result
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='book'><b>" . $row["title"]. "</b><br>" . $row["ISBN"] . "</div>";
                        }
                    } else {
                        echo "No results";
                    }
                ?>
        </div>
    </div>
    </div>
</body>
</html>

