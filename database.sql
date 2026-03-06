-- Database: rsoa_20

CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    excerpt TEXT,
    content LONGTEXT NOT NULL,
    author_name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    likes INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    author_name VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
);

-- Sample Data
INSERT INTO posts (title, slug, excerpt, content, author_name, category) VALUES
('The Future of Web Development', 'future-of-web-dev', 'Explore the latest trends in web development for 2026.', '<p>Web development is evolving rapidly. From AI-driven designs to ultra-fast frameworks...</p>', 'Alex Dev', 'Technology'),
('Top 10 Travel Destinations', 'top-10-travel', 'Discover the most breathtaking places to visit this year.', '<p>If you are looking for adventure, these 10 destinations are a must-visit...</p>', 'Sarah Traveler', 'Travel'),
('Healthy Living Tips', 'healthy-living-tips', 'Simple changes for a healthier lifestyle.', '<p>Living healthy does not have to be hard. diverse diet and regular exercise...</p>', 'Dr. Wellness', 'Lifestyle');
