<?php
require_once 'includes/config.php';
$pageTitle = 'Home';
require_once 'includes/header.php';

// Pull a few courses from the database to feature on the homepage
$featured = $conn->query("SELECT * FROM courses LIMIT 3");
?>

<header class="hero">
  <div class="container hero-inner">
    <div>
      <p class="eyebrow" style="color:rgba(255,255,255,.75)">Online learning, done properly</p>
      <h1>Build real skills with <em>guided</em>, project-based courses.</h1>
      <p>EduSphere pairs short, focused lessons with hands-on projects so you learn web development the way it's actually practised — not just the theory.</p>
      <div class="hero-actions">
        <a href="courses.php" class="btn btn-accent">Browse courses</a>
        <a href="register.php" class="btn btn-outline-light">Create free account</a>
      </div>
      <div class="hero-stats">
        <div class="hero-stat"><div class="num">6</div><div class="label">Active courses</div></div>
        <div class="hero-stat"><div class="num">120+</div><div class="label">Students enrolled</div></div>
        <div class="hero-stat"><div class="num">4.8/5</div><div class="label">Average rating</div></div>
      </div>
    </div>

    <div class="hero-path">
      <h3>Your learning path</h3>
      <div class="path-step">
        <div class="path-num">1</div>
        <div>
          <div class="path-title">Explore courses</div>
          <div class="path-desc">Filter by category and skill level to find your fit.</div>
        </div>
      </div>
      <div class="path-step">
        <div class="path-num">2</div>
        <div>
          <div class="path-title">Create an account</div>
          <div class="path-desc">Secure sign-up, takes less than a minute.</div>
        </div>
      </div>
      <div class="path-step">
        <div class="path-num">3</div>
        <div>
          <div class="path-title">Enrol & learn</div>
          <div class="path-desc">Work through lessons at your own pace.</div>
        </div>
      </div>
      <div class="path-step">
        <div class="path-num">4</div>
        <div>
          <div class="path-title">Track your progress</div>
          <div class="path-desc">Your dashboard keeps every course in view.</div>
        </div>
      </div>
    </div>
  </div>
</header>

<section class="section">
  <div class="container">
    <div class="section-header reveal">
      <p class="eyebrow">Why EduSphere</p>
      <h2>Designed around how people actually learn</h2>
      <p>Every part of the platform is built to remove friction between you and the skill you're trying to build.</p>
    </div>

    <div class="grid-3">
      <div class="card reveal">
        <div class="card-icon">🎯</div>
        <h3>Focused curriculum</h3>
        <p>Short modules with a clear outcome — no filler, no wasted time.</p>
      </div>
      <div class="card reveal">
        <div class="card-icon">📊</div>
        <h3>Visible progress</h3>
        <p>A dashboard that shows exactly how far you've come in every course.</p>
      </div>
      <div class="card reveal">
        <div class="card-icon">💬</div>
        <h3>Real instructors</h3>
        <p>Courses built and taught by practising developers and designers.</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-alt">
  <div class="container">
    <div class="section-header reveal">
      <p class="eyebrow">Popular right now</p>
      <h2>Featured courses</h2>
    </div>

    <div class="grid-3">
      <?php while ($course = $featured->fetch_assoc()): ?>
        <div class="course-card reveal">
          <div class="course-banner"><?php echo $course['icon']; ?></div>
          <div class="course-body">
            <div class="course-meta">
              <span class="tag"><?php echo htmlspecialchars($course['category']); ?></span>
              <span class="tag level"><?php echo htmlspecialchars($course['level']); ?></span>
            </div>
            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
            <p><?php echo htmlspecialchars($course['description']); ?></p>
            <div class="course-footer">
              <span><?php echo (int)$course['duration_weeks']; ?> weeks</span>
              <span><?php echo htmlspecialchars($course['instructor']); ?></span>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="text-center" style="margin-top:40px;">
      <a href="courses.php" class="btn btn-primary">View all courses</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-header reveal">
      <p class="eyebrow">Student voices</p>
      <h2>What learners are saying</h2>
    </div>

    <div class="testimonial-track reveal">
      <div class="testimonial-slide active">
        <p>"The JavaScript course finally made event handling click for me — the projects forced me to actually build things instead of just watching."</p>
        <div class="author">Amahle Khumalo</div>
        <div class="role">Web Design student</div>
      </div>
      <div class="testimonial-slide">
        <p>"I liked being able to see my progress bar fill up after every module. Small thing, but it kept me coming back."</p>
        <div class="author">Sipho Mahlangu</div>
        <div class="role">PC Support & Networking student</div>
      </div>
      <div class="testimonial-slide">
        <p>"Clear explanations, real code, and instructors who actually respond. Exactly what I needed to get past tutorial hell."</p>
        <div class="author">Rethabile Moloi</div>
        <div class="role">Diploma student</div>
      </div>
      <div class="slider-dots">
        <button class="dot active"></button>
        <button class="dot"></button>
        <button class="dot"></button>
      </div>
    </div>
  </div>
</section>

<section class="section-tight">
  <div class="container">
    <div class="cta-band reveal">
      <div>
        <h2>Ready to start learning?</h2>
        <p>Create a free account and enrol in your first course today.</p>
      </div>
      <a href="register.php" class="btn btn-accent">Get started free</a>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
