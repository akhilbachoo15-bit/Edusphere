<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo isset($pageTitle) ? $pageTitle . ' | EduSphere' : 'EduSphere — Learn Without Limits'; ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Inter:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar">
  <div class="nav-inner">
    <a href="index.php" class="logo">Edu<span>Sphere</span></a>

    <ul class="nav-links" id="navLinks">
      <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF'])=='index.php'?'active':''; ?>">Home</a></li>
      <li><a href="courses.php" class="<?php echo basename($_SERVER['PHP_SELF'])=='courses.php'?'active':''; ?>">Courses</a></li>
      <li><a href="about.php" class="<?php echo basename($_SERVER['PHP_SELF'])=='about.php'?'active':''; ?>">About</a></li>
      <li><a href="contact.php" class="<?php echo basename($_SERVER['PHP_SELF'])=='contact.php'?'active':''; ?>">Contact</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF'])=='dashboard.php'?'active':''; ?>">Dashboard</a></li>
      <?php endif; ?>
    </ul>

    <div class="nav-actions" id="navActions">
      <?php if (isset($_SESSION['user_id'])): ?>
        <span class="eyebrow">Hi, <?php echo explode(' ', $_SESSION['user_name'])[0]; ?></span>
        <a href="logout.php" class="btn btn-outline btn-sm">Log out</a>
      <?php else: ?>
        <a href="login.php" class="btn btn-outline btn-sm">Log in</a>
        <a href="register.php" class="btn btn-primary btn-sm">Get started</a>
      <?php endif; ?>
    </div>

    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
