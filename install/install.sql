CREATE TABLE IF NOT EXISTS `axcoto_fontbird_collections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `actived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `axcoto_fontbird_fonts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `source` varchar(10) NOT NULL DEFAULT 'me',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `axcoto_fontbird_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selector` varchar(100) NOT NULL,
  `font_size` varchar(10) NOT NULL,
  `collection_id` int(11) NOT NULL,
  `font_id` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
