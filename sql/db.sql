CREATE DATABASE `cakephp_twitter`;

use cakephp_twitter;

-- 基本情報
CREATE TABLE `tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  `reply_tweet_id` int(11),
  `content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB;

ALTER TABLE tweets add FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL UNIQUE,
  `name` varchar(255),
  `image` varchar(255),
  `encrypted_password` varchar(255) NOT NULL,
  `created_at` datetime,
  `updated_at` datetime
) ENGINE=InnoDB;

ALTER TABLE users ADD `profile` varchar(255) AFTER `image_dir`;
ALTER TABLE users ADD `profile` varchar(255) NOT NULL AFTER `image_dir`;


CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB;

ALTER TABLE favorites CHANGE updated_at updated datetime;
ALTER TABLE favorites ADD PRIMARY KEY(`tweet_id`, `user_id`);
ALTER TABLE favorites ADD FOREIGN KEY (`user_id`) REFERENCES `users`(`id`);
ALTER TABLE favorites ADD FOREIGN KEY(`tweet_id`) REFERENCES `tweets`(`id`);
ALTER TABLE favorites ADD PRIMARY KEY(`tweet_id`, `user_id`);
ALTER TABLE favorites ADD UNIQUE KEY(`id`);
ALTER TABLE favorites RENAME INDEX PRIMARY TO TWEET_ID_USER_ID_UNIQUE;
CREATE INDEX TWEET_ID_USER_ID_UNIQUE ON favorites (`tweet_id`, `user_id`);
alter table favorites add FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`) ON DELETE CASCADE;
alter table favorites add FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
ALTER TABLE favorites DROP FOREIGN KEY favorites_ibfk_1;

-- Listensテーブルの作詞絵
CREATE TABLE `listens` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11) NOT NULL,
  FOREIGN KEY(`user_id`) REFERENCES `users`(`id`),
  `record_id` int(11) NOT NULL,
  FOREIGN KEY(`record_id`) REFERENCES `records`(`id`)
) ENGINE=InnoDB;
