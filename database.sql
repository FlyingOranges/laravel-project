DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) DEFAULT NULL COMMENT '用户昵称',
  `username` varchar(50) DEFAULT NULL COMMENT '用户账号',
  `password` varchar(64) DEFAULT NULL COMMENT '用户密码',
  `token` varchar(64) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

INSERT INTO `member` (`id`, `nickname`, `username`, `password`, `token`, `created_at`, `updated_at`, `deleted_at`, `status`)
VALUES
	(1,'13123456789','13123456789','846e6e9c4e43735ca04c6af632ce565e','$2y$10$BnYvVbqMvuQeuh5QIDFHeOjlZ4r0j1tUziM6QCVAnvpz3n.6yhtEC',1545980315,1545980315,NULL,1),
	(2,'13123456788','13123456788','846e6e9c4e43735ca04c6af632ce565e','$2y$10$v9JD.n72VtnKe9MmsbKZJOgrn/eSOQyCyjLe.gDkXqMyxaPKuJAu2',1545980472,1545980472,NULL,1),
	(3,'13123456787','13123456787','846e6e9c4e43735ca04c6af632ce565e','$2y$10$ZFiN5vN/wtmn9G6JjqHwz.Inji4X6lLtnnhJcJ5epEJnJFfRiAkYu',1545980513,1545980513,NULL,1),
	(4,'13123456786','13123456786','846e6e9c4e43735ca04c6af632ce565e','$2y$10$y4wcVXld7dZQ2TeDrCRLXO2aIOlqKyDoXz4PUUYfASRpvITcTluG6',1545980521,1545980521,NULL,1);