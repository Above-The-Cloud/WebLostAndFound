DROP DATABASE lostfound;
CREATE DATABASE lostfound  DEFAULT CHARACTER SET utf8;
use lostfound;

CREATE TABLE user_info(
        user_id BIGINT NOT NULL,
		nickName varchar(100) NOT NULL,
		avatarUrl varchar(200) NOT NULL,
        submission_time DATETIME,
        PRIMARY KEY ( user_id ))ENGINE=InnoDB DEFAULT CHARSET=utf8; 
		
CREATE TABLE user_openid(
        user_id BIGINT NOT NULL,
        openid VARCHAR(100) NOT NULL,
        submission_time DATETIME,
        PRIMARY KEY ( user_id, openid ),
		FOREIGN KEY (user_id) references user_info(user_id) 
		ON DELETE CASCADE ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8; 

CREATE TABLE contact(
		user_id BIGINT NOT NULL  ,
		type VARCHAR(100) NOT NULL,
		value VARCHAR(100),
		submission_time DATETIME,
		PRIMARY KEY(user_id,type),
		FOREIGN KEY (user_id) references user_info(user_id) ON DELETE CASCADE ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8; 

  
 CREATE TABLE publish(
		publish_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
        user_id BIGINT NOT NULL,
        type VARCHAR(10),
		category VARCHAR(20),
        title VARCHAR(280) ,
        msg VARCHAR(280), 
        image_exist INT,
        submission_time DATETIME,
        PRIMARY KEY ( publish_id ),
		FOREIGN KEY (user_id) references user_info(user_id) ON DELETE CASCADE ON UPDATE CASCADE
		)ENGINE=InnoDB DEFAULT CHARSET=utf8; 

CREATE TABLE image (
		image_id INT unsigned NOT NULL auto_increment,
		publish_id INT UNSIGNED,
		type VARCHAR(100) NOT NULL,
		image_url VARCHAR(300) NOT NULL,
		submission_time DATETIME,
		PRIMARY KEY  ( image_id ),
		FOREIGN KEY (publish_id) references publish(publish_id) ON DELETE CASCADE ON UPDATE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

  
CREATE TABLE comment(
		comment_id INT UNSIGNED AUTO_INCREMENT NOT NULL,
        publish_id INT UNSIGNED NOT NULL,
        content VARCHAR(280) ,
        submission_time DATETIME, 
        PRIMARY KEY ( comment_id ),
		FOREIGN KEY (publish_id) references publish(publish_id) ON DELETE CASCADE ON UPDATE CASCADE)ENGINE=InnoDB DEFAULT CHARSET=utf8;
		
CREATE TABLE student(
		stu_id VARCHAR(20) NOT NULL,
        stu_pass VARCHAR(40) ,
        submission_time DATETIME,
        PRIMARY KEY ( stu_id ))ENGINE=InnoDB DEFAULT CHARSET=utf8;
INSERT INTO student
        (stu_id, stu_pass, submission_time) 
        VALUES
        (10152150127, '123456', current_time()),
		(10152150124, '123456', current_time()),
		(10152130111, '123456', current_time()),
		(10152130109, '123456', current_time());