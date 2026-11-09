<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

if (isLoggedIn()) redirect('dashboard.php');

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = clean($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, full_name, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            redirect('dashboard.php');
        } else {
            $errors[] = 'Incorrect email or password.';
        }
    } else {
        $errors[] = 'Incorrect email or password.';
    }
}

$pageTitle = 'Log In';
require_once 'includes/header.php';
?>

<section class="section">
  <div class="container">
    <div class="form-shell reveal in-view">
      <div class="text-center" style="margin-bottom:28px;">
        <p class="eyebrow">Welcome back</p>
        <h2 style="margin-top:10px;">Log in to your account</h2>
      </div>

      <?php if (!empty($errors)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($errors[0]); ?></div>
      <?php endif; ?>

      <form method="POST" action="login.php" data-validate novalidate>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" id="email" name="email" data-rule="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
          <span class="form-error">Please enter a valid email address.</span>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" data-rule="required">
          <span class="form-error">Please enter your password.</span>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
      </form>

      <p class="form-note">Don't have an account? <a href="register.php">Create one</a></p>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
