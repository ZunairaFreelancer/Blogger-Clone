:root {
    --primary-color: #ff5722; /* Blogger-like orange */
    --secondary-color: #333;
    --bg-color: #f9f9f9;
    --card-bg: #ffffff;
    --text-color: #333;
    --text-light: #666;
    --border-radius: 8px;
    --shadow: 0 4px 6px rgba(0,0,0,0.1);
    --font-family: 'Inter', sans-serif;
}

body {
    font-family: var(--font-family);
    margin: 0;
    padding: 0;
    background-color: var(--bg-color);
    color: var(--text-color);
    line-height: 1.6;
}

header {
    background: var(--card-bg);
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

nav {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.nav-links {
    display: flex;
    gap: 1.5rem;
    align-items: center;
}

.nav-links a {
    text-decoration: none;
    color: var(--secondary-color);
    font-weight: 500;
    transition: color 0.3s;
}

.nav-links a:hover {
    color: var(--primary-color);
}

.btn {
    background: var(--primary-color);
    color: white !important;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    transition: background 0.3s;
}

.btn:hover {
    background: #e64a19;
}

.main-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 20px;
    min-height: 80vh;
}

/* Homepage */
.hero {
    text-align: center;
    margin-bottom: 3rem;
}

.search-bar {
    max-width: 600px;
    margin: 1rem auto;
    display: flex;
    gap: 0.5rem;
}

.search-bar input {
    flex: 1;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    font-size: 1rem;
}

.search-bar button {
    padding: 0.8rem 1.5rem;
    background: var(--secondary-color);
    color: white;
    border: none;
    border-radius: var(--border-radius);
    cursor: pointer;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
}

.post-card {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
    overflow: hidden;
    transition: transform 0.3s;
    display: flex;
    flex-direction: column;
}

.post-card:hover {
    transform: translateY(-5px);
}

.post-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.post-category {
    text-transform: uppercase;
    font-size: 0.75rem;
    color: var(--primary-color);
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.post-title a {
    text-decoration: none;
    color: var(--secondary-color);
    font-size: 1.25rem;
    font-weight: 700;
}

.post-meta {
    margin-top: auto;
    padding-top: 1rem;
    font-size: 0.85rem;
    color: var(--text-light);
    display: flex;
    justify-content: space-between;
}

/* Post Detail */
.post-detail {
    background: var(--card-bg);
    padding: 2rem;
    border-radius: var(--border-radius);
    box-shadow: var(--shadow);
}

.post-header {
    margin-bottom: 2rem;
    border-bottom: 1px solid #eee;
    padding-bottom: 1rem;
}

.post-body {
    font-size: 1.1rem;
    margin-bottom: 2rem;
}

.actions {
    margin-top: 2rem;
    display: flex;
    gap: 1rem;
}

.comments-section {
    margin-top: 3rem;
}

.comment {
    border-bottom: 1px solid #eee;
    padding: 1rem 0;
}

.comment-author {
    font-weight: bold;
    margin-bottom: 0.25rem;
}

/* Forms */
.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.form-control {
    width: 100%;
    padding: 0.8rem;
    border: 1px solid #ddd;
    border-radius: var(--border-radius);
    font-size: 1rem;
    font-family: inherit;
}

textarea.form-control {
    min-height: 150px;
    resize: vertical;
}

.alert {
    padding: 1rem;
    margin-bottom: 1rem;
    border-radius: var(--border-radius);
}

.alert-success { background: #d4edda; color: #155724; }
.alert-error { background: #f8d7da; color: #721c24; }

@media (max-width: 768px) {
    .posts-grid {
        grid-template-columns: 1fr;
    }
    
    nav {
        flex-direction: column;
        gap: 1rem;
    }
}
