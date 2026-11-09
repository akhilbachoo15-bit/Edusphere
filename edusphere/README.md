# EduSphere — Responsive Educational Website
### Web Page Design 2B — Question 3.1 Project

A responsive educational website built with **HTML5, CSS3, JavaScript and PHP**, backed by a **MySQL** database via XAMPP. It includes user authentication, an enrolment/progress system (data processing), and a set of interactive front-end features.

---

## 1. What's included

| Feature | Where |
|---|---|
| Responsive layout (mobile → desktop) | `css/style.css` |
| Semantic HTML structure | all `.php` pages |
| User registration & login (hashed passwords) | `register.php`, `login.php` |
| Session-based authentication | `includes/config.php`, `includes/functions.php` |
| Data processing (enrolments + progress, joined queries) | `enroll.php`, `dashboard.php` |
| Contact form saved to database | `contact.php` |
| Course search & category filter (JS) | `courses.php`, `js/main.js` |
| Mobile nav menu, scroll reveal, testimonial slider, animated progress bars, client-side form validation | `js/main.js` |

## 2. Setting up in XAMPP + VS Code

1. **Copy the project folder** `edusphere/` into your XAMPP `htdocs` directory, e.g.
   `C:\xampp\htdocs\edusphere` (Windows) or `/Applications/XAMPP/htdocs/edusphere` (Mac).
2. **Start XAMPP** — switch on **Apache** and **MySQL** in the control panel.
3. **Create the database:**
   - Open `http://localhost/phpmyadmin`
   - Click **Import**, choose `database/edusphere.sql`, and click **Go**.
   - This creates the `edusphere` database with `users`, `courses`, `enrollments` and `messages` tables, and seeds 6 sample courses.
4. **Open the project folder in VS Code** (`File → Open Folder → edusphere`).
5. **Run it** by visiting `http://localhost/edusphere/index.php` in your browser.

No `npm install` or build step is needed — this is plain PHP, so XAMPP's Apache server runs it directly.

## 3. Default connection settings

`includes/config.php` uses XAMPP's defaults out of the box:
```
DB_HOST = localhost
DB_USER = root
DB_PASS = (empty)
DB_NAME = edusphere
```
If your MySQL root user has a password set, update `DB_PASS` in that file.

## 4. Suggested test flow

1. Visit the homepage — check the responsive layout by resizing the browser / using DevTools device toolbar.
2. Click **Get started** → register a new account (try submitting empty fields to see validation).
3. Go to **Courses** → search for a course, filter by category, and enrol in one or two.
4. Visit your **Dashboard** → watch the progress bars animate in, and check the stats update.
5. Submit the **Contact** form and confirm it's saved (check the `messages` table in phpMyAdmin).
6. Log out and confirm protected pages (`dashboard.php`) redirect back to the login page.

## 5. Folder structure

```
edusphere/
├── index.php            Home page
├── courses.php          Course catalogue (search + filter)
├── about.php             About page
├── contact.php           Contact form
├── register.php          Sign up
├── login.php              Log in
├── logout.php             Ends session
├── dashboard.php          Protected: enrolled courses + progress
├── enroll.php             Handles enrolment (POST)
├── includes/
│   ├── config.php         DB connection + session start
│   ├── functions.php      Helper functions (auth, sanitising)
│   ├── header.php         Shared nav
│   └── footer.php          Shared footer
├── css/style.css          Design system + responsive styles
├── js/main.js              Interactivity
└── database/edusphere.sql  Schema + seed data
```
