<?php
class User {
    public $username;
    public $password;
    public $email;
    public $firstName;
   public $lastName;

    public function __construct($username = null, $password = null, $email = null, $firstName = null, $lastName = null) {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
// write user to the database .
     public static function addUser($username, $password, $email, $firstName, $lastName) {
    // Replace with your actual database connection details
    $hostname = "localhost";  // This is the default hostname for a local MySQL server
    $usernames = "root";
    $passwords = "";
    $database = "product";

    // Create a new database connection
    $conn = new mysqli($hostname, $usernames, $passwords, $database);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize inputs to prevent SQL injection (use prepared statements)
    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $firstName = $conn->real_escape_string($firstName);
    $lastName = $conn->real_escape_string($lastName);

    // Hash the password using a secure hashing algorithm (e.g., password_hash)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert the new user
    $query = "INSERT INTO user (FirstName, LastName, UserName, email, Password) VALUES ('$firstName', '$lastName', '$username', '$email', '$hashedPassword')";

    // Execute the query
    if ($conn->query($query) === TRUE) {
        echo "New user added successfully.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

//check  login  input
      public static function userExists($username, $password) {
    // Replace with your actual database connection details
        // Replace with your actual database connection details
       $hostname = "localhost";  // This is the default hostname for a local MySQL server
$usernames = "root";
$passwords = "";
$database = "product";

        // Create a new database connection
        $conn = new mysqli($hostname, $usernames, $passwords, $database);

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize inputs to prevent SQL injection (use prepared statements)
        $username = $conn->real_escape_string($username);
        $password = $conn->real_escape_string($password);

        // Hash the password using a secure hashing algorithm (e.g., password_hash)
        // This is to ensure the stored password in the database is securely hashed
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Query to check if the user exists
        $query = "SELECT * FROM user WHERE UserName = '$username'";

        // Execute the query
        $result = $conn->query($query);

        // Check if a user with the provided username exists
        if ($result->num_rows > 0) {
            $userRow = $result->fetch_assoc();
            // Verify the password against the stored hashed password
            if (password_verify($password, $userRow['Password'])) {
                return true; // User with matching username and password exists
            }
        }

        // Close the database connection
        $conn->close();

        return false; // User not found or incorrect password
    }
    //check username availability
     public static function existusername($username) {
        // Replace with your actual database connection details
       $hostname = "localhost";  // This is the default hostname for a local MySQL server
$usernames = "root";
$passwords = "";
$database = "product";

        // Create a new database connection
        $conn = new mysqli($hostname, $usernames, $passwords, $database);

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize inputs to prevent SQL injection (use prepared statements)
        $username = $conn->real_escape_string($username);

        // Query to check if the user exists based on username or email
        $query = "SELECT * FROM user WHERE username = '$username'"; 

        // Execute the query
        $result = $conn->query($query);

        // Check if a user with the provided username or email exists
        if ($result->num_rows > 0) {
            // User exists
            return true;
        } else {
            // User does not exist
            return false;
        }

        // Close the database connection
        $conn->close();
    }
    //check email availability
      public static function existemail($email) {
        // Replace with your actual database connection details
       $hostname = "localhost";  // This is the default hostname for a local MySQL server
$usernames = "root";
$passwords = "";
$database = "product";

        // Create a new database connection
        $conn = new mysqli($hostname, $usernames, $passwords, $database);

        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize inputs to prevent SQL injection (use prepared statements)
        $email = $conn->real_escape_string($email);

        // Query to check if the user exists based on username or email
        $query = "SELECT * FROM user WHERE  email = '$email'";

        // Execute the query
        $result = $conn->query($query);

        // Check if a user with the provided username or email exists
        if ($result->num_rows > 0) {
            // User exists
            return true;
        } else {
            // User does not exist
            return false;
        }

        // Close the database connection
        $conn->close();
    }

    //get the userid by username : for setting the id of the logged in account
      public static function getUserIdByUsername($username) {
        // Replace with your actual database connection details
            $hostname = "localhost";  // This is the default hostname for a local MySQL server
$usernames = "root";
$passwords = "";
$database = "product";

        // Create a new database connection
        $conn = new mysqli($hostname, $usernames, $passwords, $database);


        // Check for connection errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Sanitize input to prevent SQL injection (use prepared statements)
        $username = $conn->real_escape_string($username);

        // Query to get the user's ID based on username
        $query = "SELECT IdU FROM user WHERE UserName = '$username'";

        // Execute the query
        $result = $conn->query($query);

        // Check if a user with the provided username exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userId = $row['IdU'];
            return $userId;
        } else {
            return null; // User does not exist
        }

        // Close the database connection
        $conn->close();
    }







    public static function getUserInfoByUsername($username) {
    // Replace with your actual database connection details
    $hostname = "localhost";  // This is the default hostname for a local MySQL server
    $usernames = "root";
    $passwords = "";
    $database = "product";

    // Create a new database connection
    $conn = new mysqli($hostname, $usernames, $passwords, $database);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize input to prevent SQL injection (use prepared statements)
    $username = $conn->real_escape_string($username);

    // Query to fetch user data based on username
    $query = "SELECT * FROM user WHERE UserName = ?";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    // Bind the username parameter to the statement
    $stmt->bind_param("s", $username);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $userData = $result->fetch_assoc();
        
        // Close the statement and the database connection
        $stmt->close();
        $conn->close();

        // Create a new User object with the retrieved data
        $user = new User(
            $userData['UserName'],
            $userData['Password'],
            $userData['email'],
            $userData['FirstName'],
            $userData['LastName']
        );

        return $user;
    } else {
        // User not found
        $stmt->close();
        $conn->close();
        return null;
    }
}


}
  ?>