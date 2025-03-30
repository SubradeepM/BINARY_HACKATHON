<?php
session_start();
$conn = new mysqli("localhost", "root", "", "loopbreakers");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user"] = $row["name"];
            echo "Login successful! <a href='dashboard.html'>Go to Dashboard</a>";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with this email.";
    }
}
?>
