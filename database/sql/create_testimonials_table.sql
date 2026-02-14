-- Create testimonials table
CREATE TABLE `testimonials` (
    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
    `user_id` bigint unsigned NOT NULL,
    `customer_name` varchar(255) NOT NULL,
    `customer_company` varchar(255) DEFAULT NULL,
    `project_type` varchar(255) DEFAULT NULL,
    `testimonial_text` text NOT NULL,
    `rating` int DEFAULT NULL COMMENT '1-5 stars',
    `customer_image` varchar(255) DEFAULT NULL,
    `show_on_frontend` tinyint(1) NOT NULL DEFAULT '1',
    `is_approved` tinyint(1) NOT NULL DEFAULT '0',
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `testimonials_user_id_show_on_frontend_index` (`user_id`,`show_on_frontend`),
    KEY `testimonials_is_approved_show_on_frontend_index` (`is_approved`,`show_on_frontend`),
    CONSTRAINT `testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
