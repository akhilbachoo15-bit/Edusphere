<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = clean($_POST['name'] ?? '');
    $email = clean($_POST['email'] ?? '');
    $subject = clean($_POST['subject'] ?? '');
    $message = clean($_POST['message'] ?? '');

    if (strlen($name) < 2) $errors[] = 'Please enter your name.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
    if (strlen($subject) < 3) $errors[] = 'Please enter a subject.';
    if (strlen($message) < 10) $errors[] = 'Your message should be at least 10 characters.';

    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        $stmt->execute();
        $success = true;
    }
}

$pageTitle = 'Contact';
require_once 'includes/header.php';
?>

<section class="section">
  <div class="container">
    <div class="form-shell reveal in-view">
      <div class="text-center" style="margin-bottom:28px;">
        <p class="eyebrow">Get in touch</p>
        <h2 style="margin-top:10px;">Send us a message</h2>
      </div>

      <?php if ($success): ?>
        <div class="alert alert-success">Thanks — your message has been sent. We'll reply within a day or two.</div>
      <?php elseif (!empty($errors)): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($errors[0]); ?></div>
      <?php endif; ?>

      <form method="POST" action="contact.php" data-validate novalidate>
        <div class="form-group">
          <label for="name">Your name</label>
          <input type="text" id="name" name="name" data-rule="required" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
          <span class="form-error">Please enter your name.</span>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" id="email" name="email" data-rule="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
          <span class="form-error">Please enter a valid email address.</span>
        </div>
        <div class="form-group">
          <label for="subject">Subject</label>
          <input type="text" id="subject" name="subject" data-rule="required" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">
          <span class="form-error">Please enter a subject.</span>
        </div>
        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" data-rule="minlength" data-min="10"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
          <span class="form-error">Your message should be at least 10 characters.</span>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Send message</button>
      </form>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
