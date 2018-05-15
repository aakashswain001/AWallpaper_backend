# AWallpaper_backend
 

Database setup
-----------------------------------
Category
-----------------------------------

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(20) NOT NULL,
  `category_url` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

-----------------------------------
Images
-----------------------------------

CREATE TABLE `images` (
  `id` int(20) NOT NULL,
  `image` varchar(60) NOT NULL,
  `category` varchar(30) NOT NULL,
  `tag` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `images`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-----------------------------------
Users
-----------------------------------

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;