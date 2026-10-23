<?php
session_start();
$destinations = [
  ["name"=>"Goa Beaches","country"=>"India","price"=>299.99,"rating"=>"4.8","image"=>"https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=900&q=85","description"=>"Relax on sunny beaches and enjoy coastal adventures."],
  ["name"=>"Kerala Backwaters","country"=>"India","price"=>399.99,"rating"=>"4.9","image"=>"https://images.unsplash.com/photo-1602216056096-3b40cc0c9944?auto=format&fit=crop&w=900&q=85","description"=>"Explore peaceful waterways and lush green landscapes."],
  ["name"=>"Paris City Tour","country"=>"France","price"=>599.99,"rating"=>"4.7","image"=>"https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=900&q=85","description"=>"Discover iconic landmarks, cafés, and city streets."],
  ["name"=>"Tokyo Adventure","country"=>"Japan","price"=>729.99,"rating"=>"4.8","image"=>"https://images.unsplash.com/photo-1540959733332-eab4dezne4?auto=format&fit=crop&w=900&q=85","description"=>"Experience vibrant neighborhoods and modern culture."],
  ["name"=>"Bangkok Temple Tour","country"=>"Thailand","price"=>389.99,"rating"=>"4.6","image"=>"https://images.unsplash.com/photo-1508009603885-50cf7c579365?auto=format&fit=crop&w=900&q=85","description"=>"Visit beautiful temples and explore local markets."],
  ["name"=>"Rome Historic Tour","country"=>"Italy","price"=>579.99,"rating"=>"4.7","image"=>"https://images.unsplash.com/photo-1552832230-c0197dd311b5?auto=format&fit=crop&w=900&q=85","description"=>"Step into history with landmarks and Italian cuisine."]
];
$selected = $_GET["country"] ?? "All";
$filtered = array_values(array_filter($destinations, fn($d) => $selected === "All" || $d["country"] === $selected));
$notice = $_SESSION["notice"] ?? "";
unset($_SESSION["notice"]);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Travel Paradise | Discover Your Next Adventure</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="site-header">
  <a class="brand" href="index.php">Travel Paradise</a>
  <button class="menu-toggle" id="menuToggle" aria-label="Open navigation">☰</button>
  <nav id="mainNav"><a href="#home">Home</a><a href="#destinations">Destinations</a><a href="#about">About Us</a><a href="#contact">Contact</a></nav>
</header>
<main>
  <?php if ($notice): ?><div class="notice"><?= htmlspecialchars($notice) ?></div><?php endif; ?>
  <section class="hero" id="home">
    <div class="hero-content"><p class="eyebrow">MAKE MEMORIES THAT LAST</p><h1>Discover Your Next Adventure</h1>
    <p>Explore amazing destinations and plan your dream vacation with our carefully curated travel packages.</p>
    <a class="btn" href="#destinations">Explore Destinations</a></div>
  </section>

  <section class="section" id="destinations">
    <div class="section-heading"><h2>Featured Destinations</h2><span></span><p>Find your next unforgettable getaway.</p></div>
    <form class="filter-bar" method="get" action="index.php#destinations">
      <label for="country">Filter by Country:</label>
      <select id="country" name="country" onchange="this.form.submit()">
        <?php foreach (["All","India","France","Japan","Thailand","Italy"] as $country): ?>
          <option value="<?= htmlspecialchars($country) ?>" <?= $selected === $country ? "selected" : "" ?>><?= htmlspecialchars($country) ?></option>
        <?php endforeach; ?>
      </select>
    </form>
    <div class="destination-grid">
      <?php foreach ($filtered as $d): ?>
      <article class="destination-card">
        <img src="<?= htmlspecialchars($d["image"]) ?>" alt="<?= htmlspecialchars($d["name"]) ?>" loading="lazy">
        <div class="card-body"><div class="card-title-row"><h3><?= htmlspecialchars($d["name"]) ?></h3><span class="rating">★ <?= $d["rating"] ?></span></div>
          <p><?= htmlspecialchars($d["description"]) ?></p><div class="card-footer"><strong>$<?= number_format($d["price"],2) ?> <small>/ person</small></strong>
          <a class="btn btn-small" href="booking.php?destination=<?= urlencode($d["name"]) ?>">Book Now</a></div>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="about-band" id="about"><div><p class="eyebrow">TRAVEL WITH CONFIDENCE</p><h2>Your journey, thoughtfully planned.</h2><p>From relaxing beach escapes to exciting city tours, Travel Paradise helps you explore more and worry less.</p></div><a class="btn btn-light" href="#contact">Plan a Trip</a></section>

  <section class="section contact-section" id="contact">
    <div class="section-heading"><h2>Get In Touch</h2><span></span><p>Have questions about our destinations or need help planning your trip? We'd love to hear from you.</p></div>
    <div class="contact-layout"><div class="contact-info"><h3>Let's talk travel</h3><p>☎ &nbsp; +91 98765 43210</p><p>✉ &nbsp; hello@travelparadise.example</p><p>⌖ &nbsp; 123 Travel Street, Bengaluru, India</p><p class="muted">Our team is happy to help with your next adventure.</p></div>
      <form class="contact-form" action="contact.php" method="post">
        <label>Full Name<input name="name" required maxlength="100" placeholder="Your full name"></label>
        <label>Email Address<input type="email" name="email" required maxlength="150" placeholder="you@example.com"></label>
        <label>Subject<input name="subject" required maxlength="150" placeholder="How can we help?"></label>
        <label>Message<textarea name="message" rows="4" required maxlength="2000" placeholder="Write your message..."></textarea></label>
        <button class="btn" type="submit">Send Message</button>
      </form>
    </div>
  </section>
</main>
<footer><a class="brand" href="index.php">Travel Paradise</a><p>Explore the world, one journey at a time.</p><small>© <?= date("Y") ?> Travel Paradise. Demo project.</small><a class="admin-link" href="admin.php">Admin demo</a></footer>
<button id="backToTop" class="back-to-top" aria-label="Back to top">↑</button>
<script src="script.js"></script>
</body></html>
