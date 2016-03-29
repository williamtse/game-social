/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  xiewenfeng
 * Created: 2016-3-25
 */
drop table if exists users;create table users(
    userId int(11) not null primary key auto_increment,
    `name` varchar(30),
    password varchar(255),
    email varchar(128),
    token varchar(128)
)engine=innodb default charset=utf8;
drop table if exists user_profiles;create table user_profiles(
userId int(11) not null primary key auto_increment,
`name` varchar(30),
email varchar(128),
sex enum('女','男'),
locationId int(11),
qq int(30),
favGameStyleId int(11),
favGameCategoryId int(11)
)engine=innodb default charset=utf8;

drop table if exists relationships;
create table relationships(
id int(255) not null primary key auto_increment,
followerId int(11),
followingId int(11),
create_time datetime,
update_time datetime
)engine=innodb default charset=utf8;

drop table if exists games;create table games(
gameId int(11) not null primary key auto_increment,
gameName varchar(50),
preCharacter varchar(1),
intro text,
startRunTime date,
whichD varchar(5),
developCompany varchar(50),
gameBigCategoryId tinyint(2),
gameCategoryId tinyint(5),
gameStyleId tinyint(5),
imgIds varchar(255),
video text
)engine=innodb default charset=utf8;

drop table if exists upload_files;create table upload_files(
id int(255) not null primary key auto_increment,
md5file varchar(50),
ext varchar(20),
rowId int(11),
create_time datetime
)engine=innodb default charset=utf8;


drop table if exists game_categories;create table game_categories()engine=innodb default charset=utf8;
drop table if exists favorite_games;create table favorite_games()engine=innodb default charset=utf8;

drop table if exists goods;create table goods()engine=innodb default charset=utf8;
drop table if exists orders;create table orders()engine=innodb default charset=utf8;

drop table if exists teams;create table teams(
id int(11) not null primary key auto_increment,
createrId int(11),
create_time datetime,
intro text,
teamName varchar(128),
logoId int(255)
)engine=innodb default charset=utf8;
drop table if exists team_members;create table team_members(
id int(11) not null primary key auto_increment,
teamId int(11),
userId int(11),
joinTime datetime,
status tinyint(1) not null default 1 comment '1-申请加入，2-成功加入,3-禁止' 
)engine=innodb default charset=utf8;
drop table if exists team_announcements;create table team_announcements(
id int(255) not null primary key auto_increment,
teamId int(11),
content text,
create_time datetime
)engine=innodb default charset=utf8;

drop table if exists videos;create table videos()engine=innodb default charset=utf8;
drop table if exists articles;create table articles()engine=innodb default charset=utf8;
drop table if exists moods;create table moods()engine=innodb default charset=utf8;

drop table if exists comments;create table comments(
id int(11) not null primary key auto_increment,
content text,
`type` varchar(128),
rowId int(11),
userId int(11),
score tinyint(1),
create_time datetime
)engine=innodb default charset=utf8;
drop table if exists comment_comments;create table comment_comments()engine=innodb default charset=utf8;

drop table if exists actions;create table actions()engine=innodb default charset=utf8;

drop table if exists thirds;create table thirds()engine=innodb default charset=utf8;

