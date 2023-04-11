ALTER TABLE `users_reactions`
  ADD CONSTRAINT `fk_users_reactions_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`),
  ADD CONSTRAINT `fk_users_reactions_reactions` FOREIGN KEY (`reactionId`) REFERENCES `reactions` (`reactionId`);
