<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';
$pageTitle = 'Courses';
require_once 'includes/header.php';

$result = $conn->query("SELECT * FROM courses ORDER BY title ASC");
$categories = $conn->query("SELECT DISTINCT category FROM courses ORDER BY category ASC");
$catList = [];
while ($row = $categories->fetch_assoc()) { $catList[] = $row['category']; }

// If logged in, find which course ids the student is already enrolled in
$enrolledIds = [];
if (isLoggedIn()) {
    $stmt = $conn->prepare("SELECT course_id FROM enrollments WHERE user_id = ?");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();
    while ($row = $res->fetch_assoc()) { $enrolledIds[] = $row['course_id']; }
}
?>

<header class="section-tight" style="background:var(--navy); color:#fff; padding-top:56px;">
  <div class="container">
    <p class="eyebrow" style="color:rgba(255,255,255,.7)">Course catalogue</p>
    <h1 style="color:#fff; margin:10px 0;">Find your next course</h1>
    <p style="color:rgba(255,255,255,.72); max-width:520px;">Search by name or filter by category to find a course that fits what you're trying to build.</p>
  </div>
</header>

<section class="section">
  <div class="container">

    <?php if (isset($_GET['enrolled'])): ?>
      <div class="alert alert-success reveal in-view">You're enrolled! Head to your <a href="dashboard.php">dashboard</a> to start learning.</div>
    <?php endif; ?>

    <div class="toolbar">
      <div class="search-box">
        <span class="icon">🔍</span>
        <input type="text" id="courseSearch" placeholder="Search courses...">
      </div>
      <div class="filter-chips">
        <button class="chip active" data-category="All">All</button>
        <?php foreach ($catList as $cat): ?>
          <button class="chip" data-category="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="course-grid" id="courseGrid">
      <?php while ($course = $result->fetch_assoc()): ?>
        <div class="course-card reveal in-view" data-title="<?php echo htmlspecialchars($course['title']); ?>" data-category="<?php echo htmlspecialchars($course['category']); ?>">
          <div class="course-banner"><?php echo $course['icon']; ?></div>
          <div class="course-body">
            <div class="course-meta">
              <span class="tag"><?php echo htmlspecialchars($course['category']); ?></span>
              <span class="tag level"><?php echo htmlspecialchars($course['level']); ?></span>
            </div>
            <h3><?php echo htmlspecialchars($course['title']); ?></h3>
            <p><?php echo htmlspecialchars($course['description']); ?></p>
            <div class="course-footer">
              <span><?php echo (int)$course['duration_weeks']; ?> weeks · <?php echo htmlspecialchars($course['instructor']); ?></span>
            </div>
            <div style="margin-top:16px;">
              <?php if (in_array($course['id'], $enrolledIds)): ?>
                <a href="dashboard.php" class="btn btn-outline btn-sm btn-block">Already enrolled</a>
              <?php elseif (isLoggedIn()): ?>
                <form action="enroll.php" method="POST">
                  <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
                  <button type="submit" class="btn btn-primary btn-sm btn-block">Enrol now</button>
                </form>
              <?php else: ?>
                <a href="login.php" class="btn btn-primary btn-sm btn-block">Log in to enrol</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div id="coursesEmpty" class="empty-state" style="display:none;">
      <div class="icon">🗂️</div>
      <p>No courses match your search. Try a different keyword or category.</p>
    </div>

  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
