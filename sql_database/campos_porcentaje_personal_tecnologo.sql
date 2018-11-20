ALTER TABLE `servicios` ADD `por_per` DECIMAL(6,2) NOT NULL AFTER `estatus`, 
ADD `por_tec` DECIMAL(6,2) NOT NULL AFTER `por_per`;