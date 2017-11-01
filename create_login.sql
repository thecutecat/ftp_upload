CREATE TABLE IF NOT EXISTS `cms_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `group_id` int(11) NOT NULL,
  `create_date` int(11) NOT NULL,
  `edit_date` int(11) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `email` varchar(200) NOT NULL,
  `contactperson` varchar(200) NOT NULL,
  `Employee_Id` int(11) DEFAULT NULL,
  `Block_user` int(1) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;