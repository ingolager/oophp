--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a testuser
--
-- CREATE DATABASE IF NOT EXISTS oophp;
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
-- USE oophp;

-- Ensure UTF8 as chacrter encoding within connection.
SET NAMES utf8;


--
-- Create table for my own movie database
--
DROP TABLE IF EXISTS `movie`;
CREATE TABLE `movie`
(
    `id` INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `director` VARCHAR(100),
    `length` INT DEFAULT NULL,            -- Length in minutes
    `year` INT NOT NULL DEFAULT 1900,
    `plot` TEXT,                          -- Short intro to the movie
    `image` VARCHAR(100) DEFAULT NULL,    -- Link to an image
    `subtext` CHAR(3) DEFAULT NULL,       -- swe, fin, en, etc
    `speech` CHAR(3) DEFAULT NULL,        -- swe, fin, en, etc
    `quality` CHAR(3) DEFAULT NULL,
    `format` CHAR(3) DEFAULT NULL         -- mp4, divx, etc
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

DELETE FROM `movie`;
INSERT INTO `movie` (`title`, `year`, `director`, `image`) VALUES
    ('Järnbäraren', 1911, 'Gustaf Lindén', 'img/Gustaf_Linden.jpg'),
    ('Dunungen', 1919, 'Ivan Hedqvist', 'img/Ivan_Hedqvist.jpg'),
    ('En lyckoriddare', 1922, 'John W. Brunius', 'img/John_Brunius.png'),
    ('Gösta Berlings saga', 1924, 'Mauritz Stiller', 'img/Mauritz_Stiller.jpg'),
    ('Ingmarssönerna', 1919, 'Victor Sjöström', 'img/Victor_Sjostrom.jpg')
;

SELECT * FROM `movie`;
