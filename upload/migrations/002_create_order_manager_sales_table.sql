CREATE TABLE herrera.oc_order_manager_sales (
        `id` bigint NOT NULL,
        `start` VARCHAR(64) NULL DEFAULT NULL,
        `end` VARCHAR(64) NULL DEFAULT NULL,
        `napomena` VARCHAR(191) NULL DEFAULT NULL,
        `user_id` int NOT NULL,
        `customer_id` int NOT NULL,
        `order_id` int NULL DEFAULT 0,
        `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;