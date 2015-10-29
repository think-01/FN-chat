DELIMITER $$

DROP PROCEDURE IF EXISTS `chat`.`Make`$$

CREATE PROCEDURE `chat`.`Make`()
    BEGIN
        DECLARE x  INT;
	DECLARE u TEXT;
	DECLARE r INT;
	DECLARE rm INT;
	DECLARE f INT;
	DECLARE y  INT;

	DROP TABLE IF EXISTS messages;
	DROP TABLE IF EXISTS subscriptions;
	DROP TABLE IF EXISTS users;

	CREATE TABLE `messages` (
	  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `from` bigint(20) unsigned NOT NULL,
	  `when` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  `message` text CHARACTER SET latin2,
	  `room` bigint(20) unsigned NOT NULL,
	  PRIMARY KEY (`id`),
	  KEY `room` (`room`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

	CREATE TABLE `subscriptions` (
	  `user` bigint(20) unsigned NOT NULL,
	  `room` bigint(20) unsigned NOT NULL,
	  PRIMARY KEY (`user`,`room`),
	  KEY `user` (`user`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;

	CREATE TABLE `users` (
	  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

	CREATE TEMPORARY TABLE `words` (
	  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  `word` varchar(255) NOT NULL,
	  PRIMARY KEY (`id`)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

	insert  into `words`(`id`,`word`) values (1,'Lorem');
	insert  into `words`(`id`,`word`) values (2,'ipsum');
	insert  into `words`(`id`,`word`) values (3,'dolor');
	insert  into `words`(`id`,`word`) values (4,'sit');
	insert  into `words`(`id`,`word`) values (5,'amet');
	insert  into `words`(`id`,`word`) values (6,'consectetur');
	insert  into `words`(`id`,`word`) values (7,'adipiscing');
	insert  into `words`(`id`,`word`) values (8,'elit');
	insert  into `words`(`id`,`word`) values (9,'Integer');
	insert  into `words`(`id`,`word`) values (10,'nec');
	insert  into `words`(`id`,`word`) values (11,'odio');
	insert  into `words`(`id`,`word`) values (12,'Praesent');
	insert  into `words`(`id`,`word`) values (13,'libero');
	insert  into `words`(`id`,`word`) values (14,'Sed');
	insert  into `words`(`id`,`word`) values (15,'cursus');
	insert  into `words`(`id`,`word`) values (16,'ante');
	insert  into `words`(`id`,`word`) values (17,'dapibus');
	insert  into `words`(`id`,`word`) values (18,'diam');
	insert  into `words`(`id`,`word`) values (19,'Sed');
	insert  into `words`(`id`,`word`) values (20,'nisi');
	insert  into `words`(`id`,`word`) values (21,'Nulla');
	insert  into `words`(`id`,`word`) values (22,'quis');
	insert  into `words`(`id`,`word`) values (23,'sem');
	insert  into `words`(`id`,`word`) values (24,'at');
	insert  into `words`(`id`,`word`) values (25,'nibh');
	insert  into `words`(`id`,`word`) values (26,'elementum');
	insert  into `words`(`id`,`word`) values (27,'imperdiet');
	insert  into `words`(`id`,`word`) values (28,'Duis');
	insert  into `words`(`id`,`word`) values (29,'sagittis');
	insert  into `words`(`id`,`word`) values (30,'ipsum');
	insert  into `words`(`id`,`word`) values (31,'Praesent');
	insert  into `words`(`id`,`word`) values (32,'mauris');
	insert  into `words`(`id`,`word`) values (33,'Fusce');
	insert  into `words`(`id`,`word`) values (34,'nec');
	insert  into `words`(`id`,`word`) values (35,'tellus');
	insert  into `words`(`id`,`word`) values (36,'sed');
	insert  into `words`(`id`,`word`) values (37,'augue');
	insert  into `words`(`id`,`word`) values (38,'semper');
	insert  into `words`(`id`,`word`) values (39,'porta');
	insert  into `words`(`id`,`word`) values (40,'Mauris');
	insert  into `words`(`id`,`word`) values (41,'massa');
	insert  into `words`(`id`,`word`) values (42,'Vestibulum');
	insert  into `words`(`id`,`word`) values (43,'lacinia');
	insert  into `words`(`id`,`word`) values (44,'arcu');
	insert  into `words`(`id`,`word`) values (45,'eget');
	insert  into `words`(`id`,`word`) values (46,'nulla');
	insert  into `words`(`id`,`word`) values (47,'Class');
	insert  into `words`(`id`,`word`) values (48,'aptent');
	insert  into `words`(`id`,`word`) values (49,'taciti');
	insert  into `words`(`id`,`word`) values (50,'sociosqu');
	insert  into `words`(`id`,`word`) values (51,'ad');
	insert  into `words`(`id`,`word`) values (52,'litora');
	insert  into `words`(`id`,`word`) values (53,'torquent');
	insert  into `words`(`id`,`word`) values (54,'per');
	insert  into `words`(`id`,`word`) values (55,'conubia');
	insert  into `words`(`id`,`word`) values (56,'nostra');
	insert  into `words`(`id`,`word`) values (57,'per');
	insert  into `words`(`id`,`word`) values (58,'inceptos');
	insert  into `words`(`id`,`word`) values (59,'himenaeos');
	insert  into `words`(`id`,`word`) values (60,'Curabitur');
	insert  into `words`(`id`,`word`) values (61,'sodales');
	insert  into `words`(`id`,`word`) values (62,'ligula');
	insert  into `words`(`id`,`word`) values (63,'in');
	insert  into `words`(`id`,`word`) values (64,'libero');
	insert  into `words`(`id`,`word`) values (65,'Sed');
	insert  into `words`(`id`,`word`) values (66,'dignissim');
	insert  into `words`(`id`,`word`) values (67,'lacinia');
	insert  into `words`(`id`,`word`) values (68,'nunc');
	insert  into `words`(`id`,`word`) values (69,'Curabitur');
	insert  into `words`(`id`,`word`) values (70,'tortor');
	insert  into `words`(`id`,`word`) values (71,'Pellentesque');
	insert  into `words`(`id`,`word`) values (72,'nibh');
	insert  into `words`(`id`,`word`) values (73,'Aenean');
	insert  into `words`(`id`,`word`) values (74,'quam');
	insert  into `words`(`id`,`word`) values (75,'In');
	insert  into `words`(`id`,`word`) values (76,'scelerisque');
	insert  into `words`(`id`,`word`) values (77,'sem');
	insert  into `words`(`id`,`word`) values (78,'at');
	insert  into `words`(`id`,`word`) values (79,'dolor');
	insert  into `words`(`id`,`word`) values (80,'Maecenas');
	insert  into `words`(`id`,`word`) values (81,'mattis');
	insert  into `words`(`id`,`word`) values (82,'Sed');
	insert  into `words`(`id`,`word`) values (83,'convallis');
	insert  into `words`(`id`,`word`) values (84,'tristique');
	insert  into `words`(`id`,`word`) values (85,'sem');
	insert  into `words`(`id`,`word`) values (86,'Proin');
	insert  into `words`(`id`,`word`) values (87,'ut');
	insert  into `words`(`id`,`word`) values (88,'ligula');
	insert  into `words`(`id`,`word`) values (89,'vel');
	insert  into `words`(`id`,`word`) values (90,'nunc');
	insert  into `words`(`id`,`word`) values (91,'egestas');
	insert  into `words`(`id`,`word`) values (92,'porttitor');
	insert  into `words`(`id`,`word`) values (93,'Morbi');
	insert  into `words`(`id`,`word`) values (94,'lectus');
	insert  into `words`(`id`,`word`) values (95,'risus');
	insert  into `words`(`id`,`word`) values (96,'iaculis');
	insert  into `words`(`id`,`word`) values (97,'vel');
	insert  into `words`(`id`,`word`) values (98,'suscipit');
	insert  into `words`(`id`,`word`) values (99,'quis');
	insert  into `words`(`id`,`word`) values (100,'luctu');

	start transaction;
        SET x = 200000;
        WHILE x > 0 DO
		INSERT INTO users (id) VALUES (0);
		SET x=x-1;
        END WHILE;
	commit;
	
	SET y = 10;
	WHILE y > 0 DO

		start transaction;
		SET x = 1000000;
		WHILE x > 0 DO
			SET r = ceil( rand()*100 );
			SET rm = ceil( rand()*200000 );
			SET f = ceil( rand()*200000 );
			select GROUP_CONCAT( t.word SEPARATOR ' ') into u from ( select word from words order by rand() limit 0,r) as t;
			INSERT INTO messages ( message, `from`, `when`, room ) VALUES ( u, f, DATE_SUB( now(),INTERVAL round(rand()*12341) MINUTE),rm );
			INSERT INTO subscriptions ( `user`,room ) values ( f, rm ) ON DUPLICATE KEY UPDATE room=room;
			SET x=x-1;
		END WHILE;
		commit;

		SET y=y-1;
	END WHILE;

	DROP TABLE words;
    END$$

DELIMITER ;