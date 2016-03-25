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
drop table if exists user_profiles;create table user_profiles()engine=innodb default charset=utf8;
drop table if exists relationships;create table relationships()engine=innodb default charset=utf8;

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
gameStyleId tinyint(5)
)engine=innodb default charset=utf8;
drop table if exists game_categories;create table game_categories()engine=innodb default charset=utf8;
drop table if exists favorite_games;create table favorite_games()engine=innodb default charset=utf8;

drop table if exists goods;create table goods()engine=innodb default charset=utf8;
drop table if exists orders;create table orders()engine=innodb default charset=utf8;

drop table if exists teams;create table teams()engine=innodb default charset=utf8;
drop table if exists team_members;create table team_members()engine=innodb default charset=utf8;
drop table if exists team_announcements;create table team_announcements()engine=innodb default charset=utf8;

drop table if exists videos;create table videos()engine=innodb default charset=utf8;
drop table if exists articles;create table articles()engine=innodb default charset=utf8;
drop table if exists moods;create table moods()engine=innodb default charset=utf8;

drop table if exists comments;create table comments()engine=innodb default charset=utf8;
drop table if exists comment_comments;create table comment_comments()engine=innodb default charset=utf8;

drop table if exists actions;create table actions()engine=innodb default charset=utf8;

drop table if exists thirds;create table thirds()engine=innodb default charset=utf8;