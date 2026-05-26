# khanzaar-travels
Khanzaar Travels is a responsive travel website for tour booking and destination management.

**Setup instructions (how to run  locally)**
install xampp
then start appache and mysql in xampp
then in browser search bar type localhost/phpmyadmin/
create a database book_db
**In book_db write sql query in sql**

-- 1. Create Packages table
CREATE TABLE IF NOT EXISTS `packages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `price` VARCHAR(100) NOT NULL,
  `duration` VARCHAR(100) NOT NULL,
  `description` TEXT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Create users table
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Ensure book_forms has all necessary columns
ALTER TABLE `book_forms` ADD COLUMN IF NOT EXISTS `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;
ALTER TABLE `book_forms` ADD COLUMN IF NOT EXISTS `user_id` int(11) DEFAULT NULL;
ALTER TABLE `book_forms` ADD COLUMN IF NOT EXISTS `status` VARCHAR(20) DEFAULT 'pending';
ALTER TABLE `book_forms` ADD COLUMN IF NOT EXISTS `booking_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP;

-- 4. Insert default packages
INSERT IGNORE INTO `packages` (id, name, price, duration, description, image) VALUES 
(1, 'Lahore Tour', '12,000', '2 Days', 'Badshahi Mosque, Lahore Fort, Shalimar Gardens', 'qila.jpg'),
(2, 'Hunza Valley', '25,000', '5 Days', 'Attabad Lake, Rakaposhi View, Karimabad Bazaar', 'hunza.jpg'),
(3, 'Islamabad Tour', '10,000', '2 Days', 'Faisal Mosque, Daman-e-Koh, Lok Virsa', 'masjid.jpg');

**click on go**
**all required tabels will get created** 

**then write** http://localhost/MRH1/MRH1/create_admin.php in the  browser searchbar **note** the path should be correct like my path include these folders MRH1/MRH1/

**admin login will get created and then add the pasword and email provided for admin  login**


**Environment variables**(database name book_db , host localhost xampp ,  deployment at infinityfree domain)

**Live deployment URL** — https://khanzaaar.infinityfreeapp.com/home.php
