create database login DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use login;

create table user  (
  `uid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` char(60) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户表';

create table article  (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  `updatetime` int(11) DEFAULT NULL,
  `uid` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='文章表';


-- 创建名为freeuser的用户，%表示可以远程操作，ip不限。
CREATE USER 'freeuser'@'%' IDENTIFIED BY 'free99';
-- 分配login库的所有权限给freeuser用户
GRANT ALL PRIVILEGES ON login.* TO 'freeuser'@'%';
