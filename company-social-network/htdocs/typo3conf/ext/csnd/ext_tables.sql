#
# Table structure for table 'tx_csnd_domain_model_user'
#
CREATE TABLE tx_csnd_domain_model_user (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

<<<<<<< HEAD

	username varchar(255) DEFAULT '' NOT NULL,
=======
	username varchar(255) DEFAULT '' NOT NULL,
	avatar int(11) unsigned NOT NULL default '0',
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
	email varchar(255) DEFAULT '' NOT NULL,
	password varchar(255) DEFAULT '' NOT NULL,
	nome varchar(255) DEFAULT '' NOT NULL,
	cognome varchar(255) DEFAULT '' NOT NULL,
<<<<<<< HEAD
	post_list int(11) unsigned DEFAULT '0' NOT NULL,


=======
	online tinyint(1) unsigned DEFAULT '0' NOT NULL,
	post_list int(11) unsigned DEFAULT '0' NOT NULL,

>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

<<<<<<< HEAD

=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

#
# Table structure for table 'tx_csnd_domain_model_post'
#
CREATE TABLE tx_csnd_domain_model_post (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	user int(11) unsigned DEFAULT '0' NOT NULL,

	text text NOT NULL,
	likes int(11) DEFAULT '0' NOT NULL,
	user int(11) unsigned DEFAULT '0',

<<<<<<< HEAD

=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,

	t3ver_oid int(11) DEFAULT '0' NOT NULL,
	t3ver_id int(11) DEFAULT '0' NOT NULL,
	t3ver_wsid int(11) DEFAULT '0' NOT NULL,
	t3ver_label varchar(255) DEFAULT '' NOT NULL,
	t3ver_state tinyint(4) DEFAULT '0' NOT NULL,
	t3ver_stage int(11) DEFAULT '0' NOT NULL,
	t3ver_count int(11) DEFAULT '0' NOT NULL,
	t3ver_tstamp int(11) DEFAULT '0' NOT NULL,
	t3ver_move_id int(11) DEFAULT '0' NOT NULL,

<<<<<<< HEAD

=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
	KEY t3ver_oid (t3ver_oid,t3ver_wsid),
	KEY language (l10n_parent,sys_language_uid)

);

<<<<<<< HEAD

   
      
        
=======
>>>>>>> 25e4e879971a131c95fd893f19eacb7117d82a2a
#
# Table structure for table 'tx_csnd_domain_model_post'
#
CREATE TABLE tx_csnd_domain_model_post (

	user int(11) unsigned DEFAULT '0' NOT NULL,

);
