<?php
session_start();
$packages = [
 "Goa Beaches"=>299.99, "Kerala Backwaters"=>399.99, "Paris City Tour"=>599.99,
 "Tokyo Adventure"=>729.99, "Bangkok Temple Tour"=>389.99, "Rome Historic Tour"=>579.99
];
$destination = $_GET["destination"] ?? ($_POST["destination"] ?? "Kerala Backwaters");
if (!isset($packages[$destination])) $destination = "Kerala Backwaters";
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $phone = trim($_POST["phone"] ?? "");
  $date = $_POST["travel_date"] ?? "";
  $people = filter_var($_POST["people"] ?? 1, FILTER_VALIDATE_INT);
  if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || $phone === "" || $date === "" || !$people || $people < 1 || $people > 20) {
    $error = "Please complete all fields with valid details.";
  } else {
    $total = $packages[$destination] * $people;
    $_SESSION["last_booking"] = ["name"=>$name,"email"=>$email,"destination"=>$destination,"date"=>$date,"people"=>$people,"total"=>$total];
    $_SESSION["notice"] = "Booking request received! This demo does not process real payments.";
    header("Location: booking.php?destination=".urlencode($destination)."&success=1"); exit;
  }
}
$success = isset($_GET["success"]);
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Book Your Trip | Travel Paradise</title><link rel="stylesheet" href="style.css"></head>
<body><header class="site-header"><a class="brand" href="index.php">Travel Paradise</a><nav><a href="index.php#home">Home</a><a href="index.php#destinations">Destinations</a><a href="index.php#contact">Contact</a></nav></header>
<main><section class="booking-hero"><p class="eyebrow">LET'S MAKE IT HAPPEN</p><h1>Book Your Trip</h1><p>Complete your booking for an amazing experience.</p></section>
<section class="booking-layout section">
<div class="booking-package"><img src="https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=900&q=85" alt="Travel destination"><div class="card-body"><h2><?= htmlspecialchars($destination) ?></h2><p>Carefully planned travel experience.</p><strong class="price">$<?= number_format($packages[$destination],2) ?> <small>/ person</small></strong></div></div>
<div class="booking-panel"><h2>Booking Details</h2>
<?php if ($success): ?><div class="success-box"><strong>Booking request received!</strong><p>Thank you. This is a demo booking; no payment has been taken.</p><a href="index.php">Return to destinations</a></div>
<?php else: ?>
<?php if ($error): ?><div class="error-box"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form id="bookingForm" action="booking.php" method="post">
<input type="hidden" name="destination" value="<?= htmlspecialchars($destination) ?>">
<div class="form-grid"><label>Full Name<input name="name" required maxlength="100" placeholder="Enter your name"></label><label>Email Address<input type="email" name="email" required placeholder="you@example.com"></label><label>Phone Number<input name="phone" required type="tel" pattern="[0-9+() -]{7,20}" placeholder="+91 98765 43210"></label><label>Travel Date<input name="travel_date" type="date" required id="travelDate"></label><label class="full-width">Number of People<select name="people" id="people"><option value="1">1 person</option><option value="2">2 people</option><option value="3">3 people</option><option value="4">4 people</option><option value="5">5 people</option><option value="6">6 people</option></select></label></div>
<div class="summary"><h3>Booking Summary</h3><p><span>Price per person</span><strong id="unitPrice" data-price="<?= $packages[$destination] ?>">$<?= number_format($packages[$destination],2) ?></strong></p><p><span>Number of people</span><strong id="peopleCount">1</strong></p><p class="total"><span>Total Amount</span><strong id="totalPrice">$<?= number_format($packages[$destination],2) ?></strong></p></div>
<button class="btn btn-wide" type="submit">Send Booking Request</button><p class="muted tiny">Demo only — no real payment or reservation is made.</p>
</form><?php endif; ?></div></section></main><footer><a class="brand" href="index.php">Travel Paradise</a><p>Explore the world, one journey at a time.</p></footer><script src="script.js"></script></body></html>
