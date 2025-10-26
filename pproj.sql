CREATE DATABASE IF NOT EXISTS `dynamic_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dynamic_project`;

CREATE TABLE `students` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `enrollment_date` DATE DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `students` (`first_name`, `last_name`, `email`, `enrollment_date`) VALUES
('Alice', 'john', 'alice.smith@example.com', '2025-09-01'),
('Boby', 'chemmanur', 'bob.johnson@example.com', '2025-09-05'),
('Charlie', 'dq', 'charlie.brown@example.com', '2025-09-10');

