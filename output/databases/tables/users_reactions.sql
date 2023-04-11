CREATE TABLE `users_reactions` (
  `userReactionId` int(11) unsigned PRIMARY KEY,
  `userId` int(11) unsigned,
  `reactionId` int(11) unsigned
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

