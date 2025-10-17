CREATE TABLE herrera.oc_impersonation_session
(
    `id`               BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `session_id`       VARCHAR(128) NOT NULL, -- PHP session id
    `admin_id`         BIGINT UNSIGNED NOT NULL,
    `customer_id`      BIGINT UNSIGNED NOT NULL,
    `store_id`         INT UNSIGNED NULL,
    `store_host`       VARCHAR(191) NOT NULL, -- e.g. b2b.example.hr
    `admin_from_url`   VARCHAR(255) NULL,     -- admin page where it was initiated
    `ip`               VARBINARY(16) NULL,
    `user_agent`       VARCHAR(1024) NULL,

    `started_at`       DATETIME     NOT NULL,
    `last_activity_at` DATETIME     NOT NULL,
    `ended_at`         DATETIME NULL,
    `duration_seconds` INT NULL,

    `created_at`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY                `sess_open` (`session_id`,`ended_at`),
    KEY                `by_admin_start` (`admin_id`,`started_at`),
    KEY                `by_customer_start` (`customer_id`,`started_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE herrera.oc_impersonation_event
(
    `id`                       BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `impersonation_session_id` BIGINT UNSIGNED NOT NULL,
    `occurred_at`              DATETIME     NOT NULL,
    `method`                   VARCHAR(8)   NOT NULL,
    `route`                    VARCHAR(191) NULL,
    `path`                     VARCHAR(255) NOT NULL,
    `status`                   SMALLINT UNSIGNED NOT NULL DEFAULT 200,
    `referrer`                 VARCHAR(255) NULL,
    `query`                    JSON NULL,
    `meta`                     JSON NULL,

    `created_at`               DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY                        `by_session_time` (`impersonation_session_id`,`occurred_at`),
    CONSTRAINT `fk_impersonation_session`
        FOREIGN KEY (`impersonation_session_id`)
            REFERENCES `oc_impersonation_session` (`id`)
            ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE herrera.oc_impersonation_geoip_cache
(
    `ip`           VARBINARY(16) NOT NULL,
    `ip_text`      VARCHAR(45) NOT NULL,
    `country_code` CHAR(2) NULL,
    `country_name` VARCHAR(64) NULL,
    `region`       VARCHAR(128) NULL,
    `city`         VARCHAR(128) NULL,
    `latitude`     DECIMAL(10, 6) NULL,
    `longitude`    DECIMAL(10, 6) NULL,
    `timezone`     VARCHAR(64) NULL,
    `org`          VARCHAR(128) NULL,
    `asn`          VARCHAR(32) NULL,
    `source`       VARCHAR(32) NULL,
    `created_at`   DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   DATETIME    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`ip`),
    KEY            `ip_text` (`ip_text`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE herrera.oc_impersonation_event
    ADD COLUMN `entity_type` ENUM('product','category','manufacturer','information','search','cart','checkout','page') NULL AFTER `route`,
  ADD COLUMN `entity_id`   BIGINT UNSIGNED NULL AFTER `entity_type`,
  ADD INDEX  `idx_ie_entity` (`entity_type`,`entity_id`,`occurred_at`);


ALTER TABLE herrera.oc_impersonation_session
    ADD INDEX `idx_sess_actor` (`session_id`, `admin_id`, `customer_id`, `store_id`, `ended_at`);

ALTER TABLE herrera.oc_order_manager_sales
    ADD INDEX `idx_oms_range` (`user_id`,`customer_id`,`date_added`);
