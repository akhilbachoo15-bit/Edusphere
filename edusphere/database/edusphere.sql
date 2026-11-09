-- =========================================================
-- EduSphere - Educational Website Database
-- Web Page Design 2B | Question 3.1
-- Import this file via phpMyAdmin (XAMPP) before running the site
-- =========================================================

CREATE DATABASE IF NOT EXISTS edusphere;
USE edusphere;

-- ---------------------------------------------------------
-- Table: users  (handles user authentication)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Table: courses  (educational content catalogue)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    category VARCHAR(50) NOT NULL,
    level VARCHAR(20) NOT NULL,
    duration_weeks INT NOT NULL,
    instructor VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    icon VARCHAR(10) DEFAULT '📘'
);

-- ---------------------------------------------------------
-- Table: enrollments (links users to courses - data processing)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    progress INT DEFAULT 0,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- ---------------------------------------------------------
-- Table: messages (contact form submissions)
-- ---------------------------------------------------------
CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    subject VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ---------------------------------------------------------
-- Seed data: sample courses
-- ---------------------------------------------------------
INSERT INTO courses (title, category, level, duration_weeks, instructor, description, icon) VALUES
('Web Design Fundamentals', 'Web Development', 'Beginner', 6, 'Ms. N. Dlamini', 'Learn the building blocks of the web: semantic HTML, CSS layout systems and responsive design principles.', '🌐'),
('JavaScript for Interactive UIs', 'Web Development', 'Intermediate', 8, 'Mr. T. Naidoo', 'Master DOM manipulation, events, form validation and building dynamic, interactive interfaces.', '⚡'),
('PHP & MySQL Essentials', 'Server-Side Development', 'Intermediate', 8, 'Mr. S. Mokoena', 'Connect the front end to a real database: authentication, CRUD operations and secure form handling.', '🗄️'),
('UI/UX Design Principles', 'Design', 'Beginner', 4, 'Ms. L. Govender', 'Explore usability heuristics, colour theory, typography and building user-friendly navigation.', '🎨'),
('Responsive Design with Flexbox & Grid', 'Web Development', 'Intermediate', 5, 'Mr. K. Botha', 'Build layouts that adapt beautifully to any screen size using modern CSS layout tools.', '📱'),
('Networking Fundamentals for Developers', 'Networking', 'Beginner', 6, 'Mr. P. Zulu', 'Understand how the web works under the hood: HTTP, DNS, hosting and client-server communication.', '🔌');
