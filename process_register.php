<!DOCTYPE html>
<html lang="en">
    <head>
        <title>World of Pets</title>
        <?php 
            include "inc/head.inc.php"; 
        ?> 
    </head>

    <body>
        <?php 
            include "inc/nav.inc.php"; 
        ?>
        <main class="container">
        <?php

        $email = $errorMsg = "";
        $success = true;
        $errorMsgLname = "";
        $errorMsgPass = "";
        $fname = "";
        $lname = "";
        $passwordhashed = "";
        $confirm_passwordhashed = "";
        $hashed_password = "";

        //email sanitization
        if (empty($_POST["email"]))
        {
            $errorMsg .= "Email is required.<br>";
            $success = false;
        }
        else
        {
            $email = sanitize_input($_POST["email"]);
        // Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
        }

        //last name sanitization
        if (empty($_POST["email"]))
        {
            $errorMsg .= "Last name is required.<br>";
            $success = false;
        }
        else
        {
            $fname = sanitize_input($_POST["fname"]);
            $lname = sanitize_input($_POST["lname"]);
        }

        //password sanitization
        if (empty($_POST["pwd"]))
        {
            $errorMsg .= "Password is required.<br>";
            $success = false;
        }
        else
        {
            $passwordhashed = sha1($_POST["pwd"]);
            $confirm_passwordhashed = sha1($_POST["pwd_confirm"]);
            if ($passwordhashed !== $confirm_passwordhashed) {
                $errorMsgPass .= "Password does not match.<br>";
                $success = false;           
            }
            else {
                $hashed_password = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
            }
        }


        //successful submission
        if ($success)
        {
            echo "
            <h1>Registration successful!</h1> 
            <h3>Thank you for signing up, ". $fname . $lname . "</h3>";
            echo "<button onclick=\"location.href='index.php'\" class='btn btn-success'>Log-in</button><br><br>";
            saveMemberToDB();

        }
        else
        {
            echo "<h1 > Oops!</h1>";
            echo "<h3>The following input errors were detected:</h3>"; 
            echo "<p>" . $errorMsgLname . "</p>";
            echo "<p>" . $errorMsgPass . "</p>";
            echo "<p>" . $errorMsgEmail . "</p>";
            echo "<button onclick=\"location.href='register.php'\"  class='btn btn-danger'>Return to Sign Up</button><br><br>"; 
        }


        /*
        * Helper function that checks input for malicious or unwanted content.
        */
        function sanitize_input($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

/*
* Helper function to write the member data to the database.
*/
function saveMemberToDB()
{ 
    global $fname, $lname, $email, $hashed_password, $errorMsg, $success;
    // Create database connection.
    $config = parse_ini_file('/var/www/private/db-config.ini');
    if (!$config)
    { 
        $errorMsg = "Failed to read database config file.";
        $success = false;
    } 
    else
    { 
        $conn = new mysqli(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        // Check connection
        if ($conn->connect_error)
        { 
            $errorMsg = "Connection failed: " . $conn->connect_error;
            $success = false;
        } 
        else
        { 
            // Prepare the statement:
            $stmt = $conn->prepare("INSERT INTO world_of_pets_members
            (fname, lname, email, password) VALUES (?, ?, ?, ?)");
            // Bind & execute the query statement:
            $stmt->bind_param("ssss", $fname, $lname, $email, $hashed_password);
            if (!$stmt->execute())
            { 
                $errorMsg = "Execute failed: (" . $stmt->errno . ") " .
                $stmt->error;
                $success = false;
            } 
            $stmt->close();
        } 
        $conn->close();
    } 
}


        ?>

    </main>
    </body>
    <?php 
        include "inc/footer.inc.php"; 
    ?>
</html>
