/* create our table for users */
CREATE TABLE users (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(128),
    `password` VARCHAR(128),
    `email` VARCHAR(128),
    `role` ENUM('author', 'admin') NOT NULL
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    `status` tinyint(1) NOT NULL DEFAULT '1'
);

/* create our table for articles */
CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(256),
    body TEXT,
    created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL,
	`status` tinyint(1) NOT NULL DEFAULT '1'
);