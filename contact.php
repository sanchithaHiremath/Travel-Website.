<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] !== "POST") { header("Location: index.php#contact"); exit; }
$name = trim($_POST["name"] ?? "");
$email = trim($_POST["email"] ?? "");
$subject = trim($_POST["subject"] ?? "");
$message = trim($_POST["message"] ?? "");
if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $subject === "" || $message === "") {
  $_SESSION["notice"] = "Please complete the contact form with valid details.";
} else {
  // Demo behavior: no email is sent and no data is stored.
  $_SESSION["notice"] = "Thanks, " . $name . "! Your demo message has been validated.";
}
header("Location: index.php#contact"); exit;
?>
