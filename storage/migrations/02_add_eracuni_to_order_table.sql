ALTER TABLE `oc_order`
    ADD COLUMN `number_quote` VARCHAR(45) NOT NULL AFTER `scanimage`,
    ADD COLUMN `number_order` VARCHAR(45) NOT NULL AFTER `number_quote`;