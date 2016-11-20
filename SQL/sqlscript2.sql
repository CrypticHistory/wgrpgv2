CREATE TABLE IF NOT EXISTS `tblcheckpoint` (
  `intCheckpointID` int(11) NOT NULL AUTO_INCREMENT,
  `strCheckpointName` varchar(100) NOT NULL,
  `txtCheckpointDesc` text NOT NULL,
  PRIMARY KEY (`intCheckpointID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `tblcheckpoint` (`intCheckpointID`, `strCheckpointName`, `txtCheckpointDesc`) VALUES
(1, 'Norman Introduction', 'Norman asks for your name. After this point, he will recognize you when you approach him.'),
(2, 'Norman Decline Caster Quest', 'You decline the Caster quest from Norman. When you see him again, he offers it to you first thing before continuing the conversation.'),
(3, 'Norman Accept Caster Quest', 'You accept the Caster quest from Norman. When you see him again, he asks if you''re ready to turn in the quest before continuing the conversation.'),
(4, 'Norman Turn In Caster Quest', 'You turned in the Caster quest to Norman after completing it. You can now progress to the next conversation with Norman.'),
(5, 'Iyanna Accept Warrior Quest', 'Player accepts the Warrior quest from Iyanna, the Warrior class trainer.'),
(6, 'Iyanna Turn In Warrior Quest', 'Player turns in the Warrior quest to Iyanna, the Warrior class trainer.');

CREATE TABLE IF NOT EXISTS `tblcharactercheckpointxr` (
  `intCharacterCheckpointXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intCheckpointID` int(11) NOT NULL,
  `dtmLastViewed` datetime NOT NULL,
  `intTimesViewed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`intCharacterCheckpointXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intCheckpointID` (`intCheckpointID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

ALTER TABLE `tblcharactercheckpointxr`
  ADD CONSTRAINT `fk_tblCharacterCheckpointXR_intCheckpointID` FOREIGN KEY (`intCheckpointID`) REFERENCES `tblcheckpoint` (`intCheckpointID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblCharacterCheckpointXR_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;
  
CREATE TABLE IF NOT EXISTS `tblquest` (
  `intQuestID` int(11) NOT NULL AUTO_INCREMENT,
  `strQuestName` varchar(45) NOT NULL,
  `strQuestType` varchar(45) NOT NULL,
  `txtQuestDesc` text NOT NULL,
  `intExpReward` int(11) NOT NULL,
  `intGoldReward` int(11) NOT NULL,
  PRIMARY KEY (`intQuestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `tblquest` (`intQuestID`, `strQuestName`, `strQuestType`, `txtQuestDesc`, `intExpReward`, `intGoldReward`) VALUES
(1, 'Caster Class Quest', 'Advancement', 'Norman wants you to kill 5 Skeleton Mages, located on the second floor of the tower. After doing so and returning to him, he promises to teach you the ways of the Caster.', 0, 0),
(2, 'Warrior Kill Quest', 'Advancement', 'Iyanna wants you to kill 5 Armoured Skeletons, located on the second floor of the tower. After doing so and returning to her, she promises to teach you the ways of the Warrior.', 0, 0);


CREATE TABLE IF NOT EXISTS `tblquestkillreq` (
  `intKillReqID` int(11) NOT NULL AUTO_INCREMENT,
  `strReqName` varchar(45) NOT NULL,
  `intQuestID` int(11) NOT NULL,
  `intNPCID` int(11) NOT NULL,
  `intKillReq` int(11) NOT NULL,
  PRIMARY KEY (`intKillReqID`),
  KEY `intQuestID` (`intQuestID`),
  KEY `intNPCID` (`intNPCID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `tblquestkillreq` (`intKillReqID`, `strReqName`, `intQuestID`, `intNPCID`, `intKillReq`) VALUES
(1, 'Kill Skeleton Mages', 1, 7, 5),
(2, 'Kill Armoured Skeleton', 2, 6, 5);

ALTER TABLE `tblquestkillreq`
  ADD CONSTRAINT `fk_tblQuestKillReq_intNPCID` FOREIGN KEY (`intNPCID`) REFERENCES `tblnpc` (`intNPCID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblQuestKillReq_intQuestID` FOREIGN KEY (`intQuestID`) REFERENCES `tblquest` (`intQuestID`) ON DELETE CASCADE ON UPDATE CASCADE;
  
CREATE TABLE IF NOT EXISTS `tblcharacterquestxr` (
  `intCharacterQuestXRID` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intQuestID` int(11) NOT NULL,
  `dtmStarted` datetime NOT NULL,
  `dtmCompleted` datetime NOT NULL,
  `blnActive` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`intCharacterQuestXRID`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intQuestID` (`intQuestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

ALTER TABLE `tblcharacterquestxr`
  ADD CONSTRAINT `fk_tblCharacterQuestXR_intQuestID` FOREIGN KEY (`intQuestID`) REFERENCES `tblquest` (`intQuestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblCharacterQuestXR_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;
  
CREATE TABLE IF NOT EXISTS `tblcharacterquestkillreqxr` (
  `intCharacterQuestKillReqXR` int(11) NOT NULL AUTO_INCREMENT,
  `intRPGCharacterID` int(11) NOT NULL,
  `intQuestID` int(11) NOT NULL,
  `intKillReqID` int(11) NOT NULL,
  `intCurrentCount` int(11) NOT NULL,
  `dtmStarted` datetime NOT NULL,
  `dtmCompleted` datetime NOT NULL,
  PRIMARY KEY (`intCharacterQuestKillReqXR`),
  KEY `intRPGCharacterID` (`intRPGCharacterID`),
  KEY `intKillReqID` (`intKillReqID`),
  KEY `intQuestID` (`intQuestID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;

INSERT INTO `tblcharacterquestkillreqxr` (`intCharacterQuestKillReqXR`, `intRPGCharacterID`, `intQuestID`, `intKillReqID`, `intCurrentCount`, `dtmStarted`, `dtmCompleted`) VALUES
(14, 188, 1, 1, 5, '2016-10-23 14:16:26', '2016-10-23 20:39:31'),
(15, 188, 2, 2, 0, '2016-11-20 15:59:41', '0000-00-00 00:00:00'),
(16, 196, 2, 2, 5, '2016-11-20 16:23:33', '2016-11-20 23:16:38'),
(17, 196, 1, 1, 5, '2016-11-20 16:41:28', '2016-11-20 23:22:26'),
(18, 198, 1, 1, 5, '2016-11-20 17:44:45', '2016-11-20 00:00:00');

ALTER TABLE `tblcharacterquestkillreqxr`
  ADD CONSTRAINT `fk_tblCharacterQuestKillReqXR_intKillReqID` FOREIGN KEY (`intKillReqID`) REFERENCES `tblquestkillreq` (`intKillReqID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblCharacterQuestKillReqXR_intQuestID` FOREIGN KEY (`intQuestID`) REFERENCES `tblquest` (`intQuestID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tblCharacterQuestKillReqXR_intRPGCharacterID` FOREIGN KEY (`intRPGCharacterID`) REFERENCES `tblrpgcharacter` (`intRPGCharacterID`) ON DELETE CASCADE ON UPDATE CASCADE;

INSERT INTO `dbwgrpg`.`tbllocation` (`intLocationID`, `strLocationName`, `strLocationType`, `intTownID`, `txtDescription`) VALUES (NULL, 'Library', 'Building', '1', NULL);
INSERT INTO `dbwgrpg`.`tbllocationxrlink` (`intLocationXRLinkID`, `intFromLocationID`, `intToLocationID`, `strLinkName`) VALUES (NULL, '4', '13', 'Library');
INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Norman 1st Convo', 'Player speaks with Norman Foelsch, the Caster trainer, for the first time.', 'norman1.xml', 'Event', '1', '2016-10-20 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tbllocationeventlink` (`intLocationEventLinkID`, `intLocationID`, `intEventID`, `strLinkName`) VALUES (NULL, '13', '29', 'Magic Aisle');
INSERT INTO `dbwgrpg`.`tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `intWeightGain`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Norman Foelsch', '130', '170', '0', '0', '0', '0', '0', 'AlwaysAttack', '0', '2016-10-22 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tbleventconversation` (`intEventConversationID`, `intEventID`, `intNPCID`, `intConversationLevel`) VALUES (NULL, '29', '9', '0');
INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Norman 2nd Convo', 'Player speaks with Norman for the 2nd time and turns in kill quest to become Caster.', 'norman2.xml', 'Event', '1', '2016-10-22 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tbleventconversation` (`intEventConversationID`, `intEventID`, `intNPCID`, `intConversationLevel`) VALUES (NULL, '30', '9', '1');
INSERT INTO `dbwgrpg`.`tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intAccuracy`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`, `intFleeResistance`) VALUES (NULL, '9', '105', '15', '130', '15', '15', '125', '125', '100', '0', '250', '50', '5', '50', '50');
INSERT INTO `dbwgrpg`.`tblclass` (`intClassID`, `strClassName`, `txtClassDescription`) VALUES (NULL, 'Caster', 'A magic class whose talent lies in expelling powerful bursts of energy at enemies that can be tainted with elemental effects.'), (NULL, 'Warrior', 'A physical class that lives in the heat of the battle, focusing on heavy melee blows and buffs that increase wartime efficiency.');
INSERT INTO `dbwgrpg`.`tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Parry Stance', '2016-10-29 00:00:00', 'admin', NULL, NULL), (NULL, 'Frozen', '2016-10-29 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tbloverride` (`intOverrideID`, `strOverrideName`, `strOverrideDesc`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Skip Turn No Action', 'Skips turn with no action.', '2016-10-29 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tblstatuseffect` (`intStatusEffectID`, `strStatusEffectName`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Knocked Down', '2016-10-29 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tblstatuseffectstatchange` (`intStatusEffectStatChangeID`, `intStatusEffectID`, `strStatName`, `intStatChangeMin`, `intStatChangeMax`, `intOverrideID`, `blnInfinite`, `intDuration`, `blnIncremental`) VALUES (NULL, '12', '', '0', '0', '6', '0', '1', '0'), (NULL, '13', '', '0', '0', '5', '0', '2', '0'), (NULL, '14', '', '0', '0', '6', '0', '1', '0');
INSERT INTO `dbwgrpg`.`tblskill` (`intSkillID`, `strName`, `strClassName`, `txtDescription`, `strSkillType`, `intHitCount`, `intTargetCount`, `blnUsableOutsideBattle`, `strWeaponType`, `intCooldown`, `intStatusEffectID`) VALUES (NULL, 'Punish', 'Punish', 'Counter a melee attack with a heavy blow that knocks the opponent on their back for a turn.', 'Parry', '1', '1', '0', 'Melee', '3', '12'), (NULL, 'Ice Pike', 'IcePike', 'Taint your mana expulsion with ice such that it freezes an opponent for two turns and deals slight damage on contact.', 'Debuff', '1', '1', '0', 'Magic', '4', '13');
INSERT INTO `dbwgrpg`.`tblclassskillxr` (`intClassSkillXRID`, `intClassID`, `intSkillID`, `intRequiredClassLevel`) VALUES (NULL, '4', '4', '1'), (NULL, '4', '8', '5'), (NULL, '5', '3', '1'), (NULL, '5', '7', '5');
DROP TABLE tblexperiencechart;
ALTER TABLE `tblskill` ADD `intPreCooldown` INT NOT NULL DEFAULT '0' AFTER `intCooldown`;
INSERT INTO `dbwgrpg`.`tblevent` (`intEventID`, `strEventName`, `txtEventDesc`, `strXML`, `strEventType`, `blnRepeating`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Iyanna 1st Convo', 'Player speaks with Iyanna, the Warrior trainer for the first time.', 'iyanna1.xml', 'Event', '0', '2016-11-20 00:00:00', 'admin', NULL, NULL), (NULL, 'Iyanna 2nd Convo', 'Player speaks with Iyanna, the Warrior trainer for the second time.', 'iyanna2.xml', 'Event', '1', '2016-11-20 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tblnpc` (`intNPCID`, `strNPCName`, `intWeight`, `intHeight`, `intExperienceGiven`, `intGoldDropMin`, `intGoldDropMax`, `blnHasStartEvent`, `blnHasEndEvent`, `strAIName`, `intWeightGain`, `dtmCreatedOn`, `strCreatedBy`, `dtmModifiedOn`, `strModifiedBy`) VALUES (NULL, 'Iyanna Rue', '170', '180', '0', '0', '0', '0', '0', 'AlwaysAttack', '0', '2016-11-20 00:00:00', 'admin', NULL, NULL);
INSERT INTO `dbwgrpg`.`tblnpcstats` (`intNPCStatsID`, `intNPCID`, `intMaxHP`, `intStrength`, `intIntelligence`, `intAgility`, `intVitality`, `intWillpower`, `intDexterity`, `intAccuracy`, `intEvasion`, `intCritDamage`, `intPierce`, `intBlockRate`, `intBlockReduction`, `intFleeResistance`) VALUES (NULL, '10', '150', '110', '100', '40', '50', '140', '40', '100', '0', '150', '50', '0', '10', '50');
INSERT INTO `dbwgrpg`.`tbleventconversation` (`intEventConversationID`, `intEventID`, `intNPCID`, `intConversationLevel`) VALUES (NULL, '31', '10', '0'), (NULL, '32', '10', '1');
INSERT INTO `dbwgrpg`.`tbllocation` (`intLocationID`, `strLocationName`, `strLocationType`, `intTownID`, `txtDescription`) VALUES (NULL, 'The Dragon''s Barrel', 'Building', '1', 'A bar located in the Red Light District where mercenaries are commonly found looking for work. Also the home of Deos Regnos, the hidden organization that aims to overthrow the corrupt Desmiyan government that oversees Turici.');
INSERT INTO `dbwgrpg`.`tbllocationxrlink` (`intLocationXRLinkID`, `intFromLocationID`, `intToLocationID`, `strLinkName`) VALUES (NULL, '5', '14', 'The Dragon''s Barrel');
INSERT INTO `dbwgrpg`.`tbllocationeventlink` (`intLocationEventLinkID`, `intLocationID`, `intEventID`, `strLinkName`) VALUES (NULL, '14', '32', 'Talk To Bartender');
UPDATE `dbwgrpg`.`tbllocation` SET `txtDescription` = 'A bar located in the Red Light District where mercenaries are commonly found looking for work.' WHERE `tbllocation`.`intLocationID` = 14;