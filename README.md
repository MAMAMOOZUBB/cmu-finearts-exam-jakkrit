1.Clone GIT

2.นำไฟล์ไปวางในไฟล์ web server จำลอง (เช่น "C:\xampp\htdocs\cmu-finearts-exam-jakkrit")

3.สร้างฐานข้อมูล จากโค้ด SQL ด้านล่าง

4.Run http://localhost/cmu-finearts-exam-jakkrit/login.html

5.Login หรือ Register เพื่อเข้าใช้งาน ^^

DB --------------------------------------------->>>

CREATE DATABASE cmu_test;

USE cmu_test;

CREATE TABLE `article` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`content` TEXT NULL DEFAULT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB
AUTO_INCREMENT=25;

CREATE TABLE `user` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`username` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`password` VARCHAR(255) NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	`role` ENUM('admin', 'user') NOT NULL COLLATE 'utf8mb4_0900_ai_ci',
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_0900_ai_ci'
ENGINE=InnoDB;
AUTO_INCREMENT=5
;

