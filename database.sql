SHOW TABLES;

USE laravel_todolist_database;

DROP DATABASE laravel_todolist_database;

DESC users;

DESC todolist;

INSERT INTO users (username, password) VALUES ("doni", "rahasia");

INSERT INTO users (username, password) VALUES ("guest", "guest");

SELECT * FROM users;

SELECT * FROM todolist;

DELETE FROM todolist;