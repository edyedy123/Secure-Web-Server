/*
CREATE TABLE users2 (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO users2 (username, password)
VALUES ('Admin', '$2y$10$HS81rs60ri4aGFLY42iHEu9x.kIW8bJdZZbdnto3kIUS5q6WZiRCC');

--INSERT INTO users (username, password)
--VALUES ('easorozabal', '$2y$10$Y9bP/sRhl.1j6Qp7ASYr/.JsKIL6jFLuU4a6227Gopqw6kdFuQjjG');


ALTER TABLE users
ADD Roles varchar(30);

INSERT INTO users (username, password, Roles)
VALUES ('Smith', '$2y$10$EKJ5OJdj1tW/2/6cnpRrI.ko7FCFypiFlCCBNJUNX1vZfbUc30X3y','Human Resources');

UPDATE users
SET Roles = 'All'
WHERE username='Admin';

CREATE USER 'lessPower'@'localhost' IDENTIFIED BY 'G00gleCrome!23';
GRANT SELECT ON `user`.* TO 'lessPower'@'localhost';

*/

