<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

requireLogin();

// Data processing: join enrollments with courses for this user
$stmt = $conn->prepare("
    SELECT c.title, c.icon, c.category, c.duration_weeks, e.progress, e.enrolled_at
    FROM enrollments e
    JOIN courses c ON c.id = e.course_id
    WHERE e.user_id = ?
    ORDER BY e.enrolled_at DESC
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$enrolled = $stmt->get_result();
$courses = $enrolled->fetch_all(MYSQLI_ASSOC);

$totalCourses = count($courses);
$avgProgress = $totalCourses > 0
    ? round(array_sum(array_column($courses, 'progress')) / $totalCourses)
    : 0;
$completed = count(array_filter($courses, fn($c) => $c['progress'] >= 100));

$pageTitle = 'Dashboard';
require_once 'includes/header.php';
?>

<header class="dash-header">
  <div class="container">
    <p class="eyebrow" style="color:rgba(255,255,255,.7)">Your space</p>
    <h1>Welcome back, <?php echo htmlspecialchars(explode(' ', $_SESSION['user_name'])[0]); ?></h1>
    <p>Here's where things stand across your enrolled courses.</p>
  </div>
</header>

<section class="section" style="padding-top:0;">
  <div class="container">
    <div class="dash-grid">
      <div class="stat-card reveal in-view">
        <div class="num"><?php echo $totalCourses; ?></div>
        <div class="label">Enrolled courses</div>
      </div>
      <div class="stat-card reveal in-view">
        <div class="num"><?php echo $avgProgress; ?>%</div>
        <div class="label">Average progress</div>
      </div>
      <div class="stat-card reveal in-view">
        <div class="num"><?php echo $completed; ?></div>
        <div class="label">Completed</div>
      </div>
    </div>

    <div class="enrolled-list">
      <?php if ($totalCourses === 0): ?>
        <div class="empty-state">
          <div class="icon">🎓</div>
          <p>You haven't enrolled in any courses yet.</p>
          <div style="margin-top:18px;"><a href="courses.php" class="btn btn-primary btn-sm">Browse courses</a></div>
        </div>
      <?php else: ?>
        <?php foreach ($courses as $course): ?>
          <div class="enrolled-item reveal in-view">
            <div class="enrolled-icon"><?php echo $course['icon']; ?></div>
            <div class="enrolled-info">
              <h4><?php echo htmlspecialchars($course['title']); ?></h4>
              <span><?php echo htmlspecialchars($course['category']); ?> · <?php echo (int)$course['duration_weeks']; ?> weeks</span>
            </div>
            <div class="progress-wrap">
              <div class="progress-bar-bg">
                <div class="progress-bar-fill" data-progress="<?php echo (int)$course['progress']; ?>"></div>
              </div>
              <span class="progress-label"><?php echo (int)$course['progress']; ?>% complete</span>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
