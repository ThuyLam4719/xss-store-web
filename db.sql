CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    passwd VARCHAR(100),
    display_name VARCHAR(100) NOT NULL,
    avatar_url VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    image_url VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    comment_text TEXT,
    image_url VARCHAR(500),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

INSERT INTO users (username, passwd, display_name, avatar_url) VALUES
('mike', '12121212', 'Mike', '/images/mike.jpg'),
('will', '12121212', 'Will', '/images/will.jpg'),
('eleven', '12121212', 'Eleven', '/images/el.jpg'),
('max', '12121212', 'Madmax', '/images/max.jpg'),
('dustin', '12121212', 'Dustin', '/images/dustin.jpg'),
('lucas', '12121212', 'Lucas', '/images/lucas.jpg');

INSERT INTO posts (title, content, image_url, user_id)
VALUES
('Con mèo này đáng yêu quá!', '/images/meo-anh-long-ngan-1.jpg', 1),
('Heo nhà mình mới chụp', '/images/nuoi-heo-1.png', 2),
('Xem lũ sóc nhà mình nè', '/images/sochuot.jpg', 3);
