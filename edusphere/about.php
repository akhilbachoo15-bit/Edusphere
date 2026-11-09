<?php
require_once 'includes/config.php';
$pageTitle = 'About';
require_once 'includes/header.php';
?>

<header class="section-tight" style="background:var(--navy); color:#fff; padding-top:56px;">
  <div class="container">
    <p class="eyebrow" style="color:rgba(255,255,255,.7)">About EduSphere</p>
    <h1 style="color:#fff; margin:10px 0; max-width:600px;">A small platform, built around one idea: learning sticks when you build things.</h1>
  </div>
</header>

<section class="section">
  <div class="container grid-2">
    <div class="reveal in-view">
      <h2 style="margin-bottom:16px;">Our approach</h2>
      <p style="color:var(--ink-soft); margin-bottom:16px;">EduSphere was built as a demonstration project for Web Page Design 2B — a responsive educational website showing how HTML, CSS, JavaScript and PHP work together in a real application.</p>
      <p style="color:var(--ink-soft);">Every course pairs a short explanation with a hands-on project, and your dashboard keeps track of exactly how far you've come, course by course.</p>
    </div>
    <div class="reveal in-view">
      <h2 style="margin-bottom:16px;">What's under the hood</h2>
      <p style="color:var(--ink-soft); margin-bottom:16px;">The front end uses semantic HTML5, a custom CSS design system built on Flexbox and Grid, and vanilla JavaScript for interactivity — no frameworks required.</p>
      <p style="color:var(--ink-soft);">The back end runs on PHP and MySQL: user accounts are stored with hashed passwords, and enrolments are processed and tracked through a relational database.</p>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-header reveal in-view">
      <p class="eyebrow">Our values</p>
      <h2>What we build around</h2>
    </div>
    <div class="grid-3">
      <div class="card reveal in-view">
        <div class="card-icon">🧭</div>
        <h3>Clarity first</h3>
        <p>Every page has one job. We'd rather explain one thing well than ten things badly.</p>
      </div>
      <div class="card reveal in-view">
        <div class="card-icon">🛠️</div>
        <h3>Build to learn</h3>
        <p>Every course ends in something you can point to — not just a certificate.</p>
      </div>
      <div class="card reveal in-view">
        <div class="card-icon">📶</div>
        <h3>Works everywhere</h3>
        <p>Fully responsive, from a small phone screen to a wide desktop monitor.</p>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
