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
            $hashed_password = password_hash($_POST["pwd"], PASSWORD_DEFAULT); 
        }

        if ($success) 
        { 
            authenticateUser();

        } 

        if ($success) 
        { 
            echo "
                <h1>Registration successful!</h1> 
                <h3>Thank you for signing up, ". $fname . $lname . "</h3>";
            echo "<button onclick=\"location.href='index.php'\" class='btn btn-success'>Return to Home</button><br><br>";

        } 

        else 
        { 
            echo "<h1 > Oops!</h1>";
            echo "<h3>The following input errors were detected:</h3>"; 
            echo "<p>" . $errorMsg. "</p>";
            echo "<button onclick=\"location.href='login.php'\"  class='btn btn-warning'>Return to Login</button><br><br>";
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
        * Helper function to authenticate the login.
        */

        /*
        * Helper function to authenticate the login.
        */
        function authenticateUser()
        {
            global $fname, $lname, $email, $passwordhashed, $errorMsg, $success;
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
                    $stmt = $conn->prepare("SELECT fname, lname, password FROM world_of_pets_members WHERE email = ?");
                    // Bind & execute the query statement:
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        // output data of each row
                            $row = $result->fetch_assoc();
                            $fname = $row["fname"];
                            $lname = $row["lname"];
                            $hashed_password = $row["password"];
                            // Verify the password

                            if (password_verify($_POST["pwd"], $hashed_password)) {
                                $success = true;
                                $errorMsg = "success = true.";
                            } else {
                                $errorMsg = "Invalid password.";
                                $success = false;
                            }
                        
                    } else {
                        $errorMsg = "No user found with this email.";
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
