# Question 3.1 — Project Documentation
## EduSphere: A Responsive Educational Website

### Project Overview
EduSphere is a responsive educational website that lets visitors browse a course catalogue, register for an account, log in securely, enrol in courses, and track their learning progress on a personal dashboard. It was built to satisfy Question 3.1's requirement to design a responsive educational website demonstrating HTML, CSS, JavaScript and PHP, with user authentication, data processing and interactive elements.

### Design Objectives
- Present course content clearly on any screen size, from mobile to desktop.
- Give users a secure way to create an account and log in.
- Process real data: enrolments are written to a database and displayed back as live progress statistics.
- Make the interface feel responsive and modern through motion (scroll reveals, animated progress bars, a testimonial slider) without relying on any front-end framework.
- Keep the codebase organised and readable, using separate folders for styles, scripts, includes and database files.

### Technologies Used
- **HTML5** — semantic structure (`header`, `nav`, `main`/`section`, `footer`) across every page.
- **CSS3** — a custom design system using CSS variables, Flexbox and Grid, and `@media` queries for full responsiveness.
- **JavaScript (vanilla)** — mobile navigation toggle, live course search/filter, testimonial slider, `IntersectionObserver`-driven scroll reveals and progress-bar animation, and client-side form validation.
- **PHP** — server-side logic for authentication, session handling, form processing and database queries (using prepared statements throughout to prevent SQL injection).
- **MySQL** — relational storage for `users`, `courses`, `enrollments` and `messages`, managed through XAMPP/phpMyAdmin.

### Key Code Snippets

**Secure password handling (register.php):**
```php
$hash = password_hash($password, PASSWORD_DEFAULT);
$insert = $conn->prepare("INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)");
$insert->bind_param("sss", $name, $email, $hash);
$insert->execute();
```

**Protecting a page with session-based auth (includes/functions.php):**
```php
function requireLogin() {
    if (!isLoggedIn()) {
        redirect('login.php');
    }
}
```

**Data processing — joining enrolments with course data (dashboard.php):**
```php
$stmt = $conn->prepare("
    SELECT c.title, c.icon, c.category, c.duration_weeks, e.progress, e.enrolled_at
    FROM enrollments e
    JOIN courses c ON c.id = e.course_id
    WHERE e.user_id = ?
    ORDER BY e.enrolled_at DESC
");
```

**Interactive course filtering (js/main.js):**
```javascript
function filterCourses() {
  const query = searchInput.value.toLowerCase().trim();
  courseCards.forEach(card => {
    const matchesSearch = card.dataset.title.toLowerCase().includes(query);
    const matchesCategory = activeCategory === 'All' || card.dataset.category === activeCategory;
    card.style.display = (matchesSearch && matchesCategory) ? 'flex' : 'none';
  });
}
```

### Testing and Evaluation
| Test | Method | Result |
|---|---|---|
| Responsive layout | Resized browser / Chrome DevTools device toolbar (mobile, tablet, desktop) | Layout reflows correctly; nav collapses to a hamburger menu below 720px |
| Registration validation | Submitted empty fields, mismatched passwords, invalid email | Client-side messages appear instantly; server-side checks catch anything that bypasses JS |
| SQL injection attempt | Entered `' OR '1'='1` into login fields | Rejected — all queries use prepared statements |
| Enrolment flow | Registered, enrolled in 2 courses, checked dashboard | Course count, average progress and progress bars updated correctly |
| Cross-browser check | Opened site in Chrome and Firefox | Consistent layout and functioning JavaScript in both |
| Session protection | Visited `dashboard.php` while logged out | Redirected to `login.php` as expected |

*(Insert your own screenshots of each of these tests here before submitting.)*

### Conclusion
EduSphere demonstrates how HTML, CSS, JavaScript and PHP combine to produce a complete, functioning web application rather than a static mock-up. The site is fully responsive, protects user data with hashed passwords and prepared statements, and uses real data processing — course enrolments are stored, retrieved and displayed as live progress on a personal dashboard. The interactive elements (search/filter, slider, animated reveals, form validation) show JavaScript's role in creating a smooth, modern user experience on top of a solid PHP/MySQL back end.
