CREATE TABLE `herrera`.`oc_customer_to_user` (
        `customer_id` bigint NOT NULL,
        `user_id` bigint NOT NULL,
        PRIMARY KEY (`customer_id`, `user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;