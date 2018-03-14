CREATE database exercise_3;
 
 CREATE TABLE movie (
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(255),
	actors VARCHAR(255),
	director VARCHAR(255),
	producer VARCHAR(255),
	year_of_prod year,
	language VARCHAR(255),
	category enum('Action', 'Romance', 'Horror', 'SF'),
    storyline TEXT,
    video TEXT
    )ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_bin;