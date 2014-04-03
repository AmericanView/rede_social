-- MySQL dump 9.11
--
-- Host: localhost    Database: yogurt
-- ------------------------------------------------------
-- Server version	4.0.18-max-debug

--
-- Table structure for table `bugs`
--

CREATE TABLE bugs (
  id bigint(20) NOT NULL auto_increment,
  header blob NOT NULL,
  ip varchar(100) NOT NULL default '',
  message varchar(200) NOT NULL default '',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  user bigint(20) NOT NULL default '0',
  form blob NOT NULL,
  querystring blob NOT NULL,
  confirmed int(11) NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `communities`
--

CREATE TABLE communities (
  id bigint(20) NOT NULL auto_increment,
  name varchar(100) NOT NULL default '',
  description blob NOT NULL,
  anonymous tinyint(1) NOT NULL default '0',
  public tinyint(1) NOT NULL default '0',
  location int(11) default '0',
  category int(11) NOT NULL default '0',
  owner bigint(20) NOT NULL default '0',
  creation_date datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `community_categories`
--

CREATE TABLE community_categories (
  id int(11) NOT NULL default '0',
  name varchar(100) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Dumping data for table `community_categories`
--

INSERT INTO community_categories VALUES (1,'Activities');
INSERT INTO community_categories VALUES (2,'Alumni & Schools');
INSERT INTO community_categories VALUES (3,'Arts & Entertainment');
INSERT INTO community_categories VALUES (4,'Automotive');
INSERT INTO community_categories VALUES (5,'Business');
INSERT INTO community_categories VALUES (6,'Cities & Neighborhoods');
INSERT INTO community_categories VALUES (7,'Company');
INSERT INTO community_categories VALUES (8,'Computers & Internet');
INSERT INTO community_categories VALUES (9,'Countries & Regional');
INSERT INTO community_categories VALUES (10,'Cultures & Community');
INSERT INTO community_categories VALUES (11,'Family & Home');
INSERT INTO community_categories VALUES (12,'Fashion & Beauty');
INSERT INTO community_categories VALUES (13,'Food, Drink & Wine');
INSERT INTO community_categories VALUES (14,'Games');
INSERT INTO community_categories VALUES (15,'Gay, Lesbian & Bi');
INSERT INTO community_categories VALUES (16,'Government & Politics');
INSERT INTO community_categories VALUES (17,'Health, Wellness & Fitness');
INSERT INTO community_categories VALUES (18,'Hobbies & Crafts');
INSERT INTO community_categories VALUES (19,'Individuals');
INSERT INTO community_categories VALUES (20,'Music');
INSERT INTO community_categories VALUES (21,'Pets & Animals');
INSERT INTO community_categories VALUES (22,'Recreation & Sports');
INSERT INTO community_categories VALUES (23,'Religion & Beliefs');
INSERT INTO community_categories VALUES (24,'Romance & Relationships');
INSERT INTO community_categories VALUES (25,'Schools & Education');
INSERT INTO community_categories VALUES (26,'Science & History');
INSERT INTO community_categories VALUES (27,'Travel');
INSERT INTO community_categories VALUES (28,'Other');

--
-- Table structure for table `community_events`
--

CREATE TABLE community_events (
  id bigint(20) NOT NULL auto_increment,
  community bigint(20) NOT NULL default '0',
  title varchar(80) NOT NULL default '',
  description blob NOT NULL,
  date datetime NOT NULL default '0000-00-00 00:00:00',
  location1 varchar(100) NOT NULL default '',
  location2 varchar(100) NOT NULL default '',
  parent bigint(20) default '0',
  creator bigint(20) NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `community_messages`
--

CREATE TABLE community_messages (
  id bigint(20) NOT NULL auto_increment,
  community bigint(20) NOT NULL default '0',
  parent bigint(20) default '0',
  title varchar(100) NOT NULL default '',
  body blob NOT NULL,
  sender bigint(20) NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `community_users`
--

CREATE TABLE community_users (
  community bigint(20) NOT NULL default '0',
  user bigint(20) NOT NULL default '0',
  moderator tinyint(11) NOT NULL default '0',
  approved tinyint(1) NOT NULL default '0'
) TYPE=MyISAM COMMENT='0.normal, 1.owner 2.moderator';

--
-- Table structure for table `countries`
--

CREATE TABLE countries (
  id bigint(20) NOT NULL auto_increment,
  name varchar(100) default '',
  code varchar(50) default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Dumping data for table `countries`
--

insert into countries (name, code) values ( 'Afghanistan', '9AF');
insert into countries (name, code) values ( 'Albania', '9AL');
insert into countries (name, code) values ( 'Algeria', '9AG');
insert into countries (name, code) values ( 'Andorra', '9AN');
insert into countries (name, code) values ( 'Angola', '9AO');
insert into countries (name, code) values ( 'Anguilla', '9AV');
insert into countries (name, code) values ( 'Antigua and Barbuda', '9AC');
insert into countries (name, code) values ( 'Argentina', '9AR');
insert into countries (name, code) values ( 'Ashmore Cartier Islands', '9AT');
insert into countries (name, code) values ( 'Australia', '9AS');
insert into countries (name, code) values ( 'Austria', '9AU');
insert into countries (name, code) values ( 'Bahamas, The', '9BF');
insert into countries (name, code) values ( 'Bahrain', '9BA');
insert into countries (name, code) values ( 'Bangladesh', '9BG');
insert into countries (name, code) values ( 'Barbados', '9BB');
insert into countries (name, code) values ( 'Bassa da India', '9BS');
insert into countries (name, code) values ( 'Belgium', '9BE');
insert into countries (name, code) values ( 'Belize', '9BH');
insert into countries (name, code) values ( 'Benin', '9DM');
insert into countries (name, code) values ( 'Bermuda', '9BD');
insert into countries (name, code) values ( 'Bhutan', '9BT');
insert into countries (name, code) values ( 'Bolivia', '9BL');
insert into countries (name, code) values ( 'Botswana', '9BC');
insert into countries (name, code) values ( 'Bouvet Island', '9BV');
insert into countries (name, code) values ( 'Brazil', '9BR');
insert into countries (name, code) values ( 'British Indian Ocean Territory', '910');
insert into countries (name, code) values ( 'British Virgin Islands', '9VI');
insert into countries (name, code) values ( 'Brunei', '9BX');
insert into countries (name, code) values ( 'Bulgaria', '9BU');
insert into countries (name, code) values ( 'Burma', '9BM');
insert into countries (name, code) values ( 'Burundi', '9BY');
insert into countries (name, code) values ( 'Cameroon', '9CM');
insert into countries (name, code) values ( 'Canada', '9CA');
insert into countries (name, code) values ( 'Cape Verde', '9CV');
insert into countries (name, code) values ( 'Cayman Islands', '90');
insert into countries (name, code) values ( 'Central African Republic', '9CT');
insert into countries (name, code) values ( 'Chad', '9CD');
insert into countries (name, code) values ( 'Chile', '9CI');
insert into countries (name, code) values ( 'China', '9CH');
insert into countries (name, code) values ( 'Christmas Island', '9KT');
insert into countries (name, code) values ( 'Clipperton Island', '91P');
insert into countries (name, code) values ( 'Coco (Keeling) Islands', '9CK');
insert into countries (name, code) values ( 'Colombia', '9CO');
insert into countries (name, code) values ( 'Comoros', '9CN');
insert into countries (name, code) values ( 'Congo', '9CF');
insert into countries (name, code) values ( 'Cook Islands', '9CW');
insert into countries (name, code) values ( 'Coral Sea Islands', '9CR');
insert into countries (name, code) values ( 'Costa Rica', '9CS');
insert into countries (name, code) values ( 'Cuba', '9CU');
insert into countries (name, code) values ( 'Cyprus', '9CY');
insert into countries (name, code) values ( 'Czechoslovakia', '9CZ');
insert into countries (name, code) values ( 'Denmark', '9DA');
insert into countries (name, code) values ( 'Djibouti', '9DJ');
insert into countries (name, code) values ( 'Dominica', '9DO');
insert into countries (name, code) values ( 'Dominican Republic', '9DR');
insert into countries (name, code) values ( 'Ecuador', '9EC');
insert into countries (name, code) values ( 'Egypt', '9EG');
insert into countries (name, code) values ( 'El Salvador', '9ES');
insert into countries (name, code) values ( 'Equatorial Guinea', '9EK');
insert into countries (name, code) values ( 'Ethiopia', '9ET');
insert into countries (name, code) values ( 'Europa Island', '9EU');
insert into countries (name, code) values ( 'Faeroe Islands', '9FO');
insert into countries (name, code) values ( 'Falkland Islands (Islas Malvinas)', '9FA');
insert into countries (name, code) values ( 'Fiji', '9FJ');
insert into countries (name, code) values ( 'Finland', '9FI');
insert into countries (name, code) values ( 'France', '9FR');
insert into countries (name, code) values ( 'French Guiana', '9FG');
insert into countries (name, code) values ( 'French Polynesia', '9FP');
insert into countries (name, code) values ( 'French Southern Antarctic Lands', '9FS');
insert into countries (name, code) values ( 'Gabon', '9GB');
insert into countries (name, code) values ( 'Gambia, The', '9GA');
insert into countries (name, code) values ( 'Gaza Strip', '9GZ');
insert into countries (name, code) values ( 'German Democractic Republic (E)', '9GC');
insert into countries (name, code) values ( 'Germany, Berlin', '9BZ');
insert into countries (name, code) values ( 'Germany, Federal Republic of (W)', '9GE');
insert into countries (name, code) values ( 'Ghana', '9GH');
insert into countries (name, code) values ( 'Gibraltar', '9GI');
insert into countries (name, code) values ( 'Glorioso Islands', '9GO');
insert into countries (name, code) values ( 'Greece', '9GR');
insert into countries (name, code) values ( 'Greenland', '9GL');
insert into countries (name, code) values ( 'Grenada', '9GJ');
insert into countries (name, code) values ( 'Guadeloupe', '9GP');
insert into countries (name, code) values ( 'Guatemala', '9GT');
insert into countries (name, code) values ( 'Guernsey', '9GK');
insert into countries (name, code) values ( 'Guinea', '9GV');
insert into countries (name, code) values ( 'Guinea Bissau', '9PU');
insert into countries (name, code) values ( 'Guyana', '9GY');
insert into countries (name, code) values ( 'Haiti', '9HA');
insert into countries (name, code) values ( 'Heard Island McDonald Islands', '9HM');
insert into countries (name, code) values ( 'Hondurus', '9HO');
insert into countries (name, code) values ( 'Hong Kong', '9HK');
insert into countries (name, code) values ( 'Hungary', '9HU');
insert into countries (name, code) values ( 'Iceland', '9IC');
insert into countries (name, code) values ( 'India', '9IN');
insert into countries (name, code) values ( 'Indonesia', '9ID');
insert into countries (name, code) values ( 'Iran', '9IR');
insert into countries (name, code) values ( 'Iraq', '9IZ');
insert into countries (name, code) values ( 'Iraq-Saudi Arabia Neutral Zone', '9IY');
insert into countries (name, code) values ( 'Ireland', '9EI');
insert into countries (name, code) values ( 'Israel', '9IS');
insert into countries (name, code) values ( 'Italy', '9IT');
insert into countries (name, code) values ( 'Ivory Coast', '9IV');
insert into countries (name, code) values ( 'Jamaica', '9JM');
insert into countries (name, code) values ( 'Jan Mayen', '9JN');
insert into countries (name, code) values ( 'Japan', '9JA');
insert into countries (name, code) values ( 'Jersey', '9JE');
insert into countries (name, code) values ( 'Jordan', '9JO');
insert into countries (name, code) values ( 'Juan DeNova Island', '9JU');
insert into countries (name, code) values ( 'Kampuchea', '9CB');
insert into countries (name, code) values ( 'Kenya', '9KE');
insert into countries (name, code) values ( 'Kiribati', '9KR');
insert into countries (name, code) values ( 'Korea, Dem People''s Republic of', '9KN');
insert into countries (name, code) values ( 'Kroea, Republic of', '9KS');
insert into countries (name, code) values ( 'Kuwait', '9KU');
insert into countries (name, code) values ( 'Laos', '9LA');
insert into countries (name, code) values ( 'Lebanon', '9LE');
insert into countries (name, code) values ( 'Lesotho', '9LT');
insert into countries (name, code) values ( 'Liberia', '9LI');
insert into countries (name, code) values ( 'Libya', '9LY');
insert into countries (name, code) values ( 'Liechtenstein', '9LS');
insert into countries (name, code) values ( 'Luxembourg', '9LU');
insert into countries (name, code) values ( 'Macau', '9MC');
insert into countries (name, code) values ( 'Madagascar (Malagasy Republic)', '9MA');
insert into countries (name, code) values ( 'Malaysia', '9MY');
insert into countries (name, code) values ( 'Maldives', '9MV');
insert into countries (name, code) values ( 'Mali', '9ML');
insert into countries (name, code) values ( 'Malta', '9MT');
insert into countries (name, code) values ( 'Martinique', '9MB');
insert into countries (name, code) values ( 'Mauritania', '9MR');
insert into countries (name, code) values ( 'Maurititus', '9MP');
insert into countries (name, code) values ( 'Mayotte', '9MF');
insert into countries (name, code) values ( 'Mexico', '9MX');
insert into countries (name, code) values ( 'Milawi', '9MI');
insert into countries (name, code) values ( 'Monaco', '9MN');
insert into countries (name, code) values ( 'Mongolia', '9MG');
insert into countries (name, code) values ( 'Montserrat', '9MH');
insert into countries (name, code) values ( 'Morocco', '9MO');
insert into countries (name, code) values ( 'Mozambique', '9MZ');
insert into countries (name, code) values ( 'Namibia', '9WA');
insert into countries (name, code) values ( 'Nauru', '9NR');
insert into countries (name, code) values ( 'Nepal', '9NP');
insert into countries (name, code) values ( 'Netherlands', '9NL');
insert into countries (name, code) values ( 'Netherlands Antilles', '9NA');
insert into countries (name, code) values ( 'New Caledonia', '9NC');
insert into countries (name, code) values ( 'New Zealand', '9NZ');
insert into countries (name, code) values ( 'Nicaragua', '9NU');
insert into countries (name, code) values ( 'Niger', '9NG');
insert into countries (name, code) values ( 'Nigeria', '9NI');
insert into countries (name, code) values ( 'Niue', '9NE');
insert into countries (name, code) values ( 'Norfolk Island', '9NF');
insert into countries (name, code) values ( 'Norway', '9NO');
insert into countries (name, code) values ( 'Oman', '9MU');
insert into countries (name, code) values ( 'Pakistan', '9PK');
insert into countries (name, code) values ( 'Panama', '9PN');
insert into countries (name, code) values ( 'Papua New Guinea', '9PP');
insert into countries (name, code) values ( 'ParacelIslands', '9PF');
insert into countries (name, code) values ( 'Paraguay', '9PA');
insert into countries (name, code) values ( 'Peru', '9PE');
insert into countries (name, code) values ( 'Philippines', '9RP');
insert into countries (name, code) values ( 'Pitcairn Island', '9PC');
insert into countries (name, code) values ( 'Poland', '9PL');
insert into countries (name, code) values ( 'Portugal', '9PO');
insert into countries (name, code) values ( 'Qator', '9QA');
insert into countries (name, code) values ( 'Reunion', '9RE');
insert into countries (name, code) values ( 'Romania', '9RO');
insert into countries (name, code) values ( 'Rwanda', '9RW');
insert into countries (name, code) values ( 'San Marino', '9SM');
insert into countries (name, code) values ( 'Sao Tome Principe', '9TP');
insert into countries (name, code) values ( 'Saudi Arabia', '9SA');
insert into countries (name, code) values ( 'Senegal', '9SG');
insert into countries (name, code) values ( 'Seychelles', '9SE');
insert into countries (name, code) values ( 'Sierra Leone', '9SL');
insert into countries (name, code) values ( 'Singapore', '9SN');
insert into countries (name, code) values ( 'Soloman Islands', '9BP');
insert into countries (name, code) values ( 'Somalia', '9SO');
insert into countries (name, code) values ( 'South Africa', '9SF');
insert into countries (name, code) values ( 'Spain', '9SP');
insert into countries (name, code) values ( 'Spratly Island', '9PG');
insert into countries (name, code) values ( 'Sri Lanka (Ceylon)', '9CE');
insert into countries (name, code) values ( 'St. Christopher-Nevis', '9SC');
insert into countries (name, code) values ( 'St. Helena', '9SH');
insert into countries (name, code) values ( 'St. Lucia', '9ST');
insert into countries (name, code) values ( 'St. Pierre Miquelon', '9SB');
insert into countries (name, code) values ( 'St. Vincent and the Grenadines', '9VC');
insert into countries (name, code) values ( 'Sudan', '9SU');
insert into countries (name, code) values ( 'Suriname', '9NS');
insert into countries (name, code) values ( 'Svalbard', '9SV');
insert into countries (name, code) values ( 'Swaziland', '9WZ');
insert into countries (name, code) values ( 'Sweden', '9SW');
insert into countries (name, code) values ( 'Switzerland', '9SZ');
insert into countries (name, code) values ( 'Syria', '9SY');
insert into countries (name, code) values ( 'Taiwan', '9TW');
insert into countries (name, code) values ( 'Tanzania, United Republic of', '9TZ');
insert into countries (name, code) values ( 'Thailand', '9TH');
insert into countries (name, code) values ( 'Togo', '9TO');
insert into countries (name, code) values ( 'Tokelau', '9TL');
insert into countries (name, code) values ( 'Tonga', '9TN');
insert into countries (name, code) values ( 'Trinidad Tobago', '9TD');
insert into countries (name, code) values ( 'Tromelin Island', '9TE');
insert into countries (name, code) values ( 'Tunisia', '9TS');
insert into countries (name, code) values ( 'Turkey', '9TU');
insert into countries (name, code) values ( 'Turks and Caicos Island', '9TK');
insert into countries (name, code) values ( 'Tuvalu', '9TV');
insert into countries (name, code) values ( 'Uganda', '9UG');
insert into countries (name, code) values ( 'Union of Soviet Socialist Republics', '9UR');
insert into countries (name, code) values ( 'United Arab Emirates', '9TC');
insert into countries (name, code) values ( 'United Kingdom', '9UK');
insert into countries (name, code) values ( 'United Kingdom - England', '9UKE');
insert into countries (name, code) values ( 'United Kingdom - Scotland', '9UKS');
insert into countries (name, code) values ( 'United States', '9US');
insert into countries (name, code) values ( 'Upper Volta', '9UV');
insert into countries (name, code) values ( 'Uruguay', '9UY');
insert into countries (name, code) values ( 'Vanuatu', '9NH');
insert into countries (name, code) values ( 'Vatican City', '9VT');
insert into countries (name, code) values ( 'Venezuela', '9VE');
insert into countries (name, code) values ( 'Vietnam', '9VM');
insert into countries (name, code) values ( 'Wallis and Futuna', '9WF');
insert into countries (name, code) values ( 'West Berlin', '9WB');
insert into countries (name, code) values ( 'Western Sahara', '9WI');
insert into countries (name, code) values ( 'Western Samoa', '9WS');
insert into countries (name, code) values ( 'Yemen (Aden)', '9YS');
insert into countries (name, code) values ( 'Yemen (Sanaa)', '9YE');
insert into countries (name, code) values ( 'Yugoslavia', '9YO');
insert into countries (name, code) values ( 'Zaire', '9CG');
insert into countries (name, code) values ( 'Zambia', '9ZA');
insert into countries (name, code) values ( 'Zimbabwe', '9ZI');


--
-- Table structure for table `messages`
--

CREATE TABLE messages (
  id bigint(20) NOT NULL auto_increment,
  subject varchar(200) default '',
  body blob,
  sender bigint(20) NOT NULL default '0',
  dest bigint(20) NOT NULL default '0',
  date datetime NOT NULL default '0000-00-00 00:00:00',
  system tinyint(1) NOT NULL default '1',
  seen tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

--
-- Table structure for table `user_friends`
--

CREATE TABLE user_friends (
  user bigint(20) NOT NULL default '0',
  friend bigint(20) NOT NULL default '0',
  approved smallint(1) NOT NULL default '0',
  level int(1) NOT NULL default '3'
) TYPE=MyISAM COMMENT='0.not set, 1.approved 2.rejected (not implemented yet)';

--
-- Table structure for table `user_profiles`
--

--
-- Table structure for table `users`
--

CREATE TABLE users (
  id bigint(20) NOT NULL auto_increment,
  username varchar(20) NOT NULL default '',
  password varchar(20) NOT NULL default '',
  first_name varchar(20) NOT NULL default '',
  last_name varchar(20) NOT NULL default '',
  status int(1) default '0',
  gender int(1) default '0',
  looking_friends tinyint(1) NOT NULL default '0',
  looking_business tinyint(1) NOT NULL default '0',
  looking_dating tinyint(1) NOT NULL default '0',
  dating_type int(11) default '0',
  country bigint(20) default '0',
  last_login datetime NOT NULL default '0000-00-00 00:00:00',
  current_login datetime NOT NULL default '0000-00-00 00:00:00',
  about_me blob,
  email varchar(60) default '',
  PRIMARY KEY  (id,username),
  UNIQUE KEY id (id),
  UNIQUE KEY id_2 (id),
  UNIQUE KEY id_3 (id)
) TYPE=MyISAM COMMENT='0-single 1-committed 2-married 3-open relation';

--
-- Dumping data for table `users`
--

INSERT INTO users VALUES (1,'sansao','123','Ricardo','Staudt',0,0,1,0,1,2,6,'2004-10-16 19:11:12','2004-10-16 19:48:00','I&#039;m a nice guy, no, really!','braindrain@terra.com.br');
