<?php
$_['heading_title'] = 'Digital XML/CSV Price List';

$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Digital price list settings have been saved.';
$_['text_generated'] = 'Digital price list generated. Products: %d.';
$_['text_edit'] = 'Digital price list settings';
$_['text_enabled'] = 'Enabled';
$_['text_disabled'] = 'Disabled';
$_['text_yes'] = 'Yes';
$_['text_no'] = 'No';
$_['text_none'] = '— Not applicable / not selected —';
$_['text_never'] = 'Not generated yet';
$_['text_feed_urls'] = 'Public URLs';
$_['text_cron'] = 'Automatic generation';
$_['text_storage'] = 'File status';
$_['text_legal_fields'] = 'Store identity and required fields';
$_['text_recent_runs'] = 'Recent generations';
$_['text_no_runs'] = 'No generation runs recorded.';
$_['text_generate_help'] = 'Run the cron once per day before 08:00. The recommended example runs daily at 07:30 and therefore also covers the required business-day schedule. The scheduler must use the Europe/Zagreb timezone.';
$_['text_large_catalog_warning'] = 'Large catalogue: use the CLI cron for regular or initial generation. “Generate now” runs in one administrator HTTP request and a web server or reverse proxy can time it out even though the generator uses bounded memory.';

$_['entry_status'] = 'Status';
$_['entry_archive_days'] = 'Archive retention (days)';
$_['entry_include_disabled'] = 'Include disabled products';
$_['entry_cron_token'] = 'Secure cron token';
$_['entry_xml_url'] = 'Current XML';
$_['entry_csv_url'] = 'Current CSV';
$_['entry_archives_url'] = 'Public archive index';
$_['entry_cron_url'] = 'Protected web cron URL';
$_['entry_cli_command'] = 'CLI command';
$_['entry_last_generated'] = 'Last generated';
$_['entry_current_filename'] = 'Current archive name';
$_['entry_archive_files'] = 'Archive files';
$_['entry_xml_size'] = 'XML size';
$_['entry_csv_size'] = 'CSV size';
$_['entry_customer_group'] = 'B2C customer group';
$_['entry_language'] = 'Price list language';
$_['entry_unit_attribute'] = 'Unit-of-measure attribute';
$_['entry_unit_price_attribute'] = 'Unit-price attribute';
$_['entry_special_sale_name'] = 'Special sale type name';
$_['entry_object_type'] = 'Object type';
$_['entry_object_address'] = 'Object address';
$_['entry_object_code'] = 'Object code';

$_['column_generated_at'] = 'Time';
$_['column_status'] = 'Status';
$_['column_products'] = 'Products';
$_['column_duration'] = 'Duration';
$_['column_message'] = 'Message';

$_['button_save'] = 'Save';
$_['button_cancel'] = 'Cancel';
$_['button_generate'] = 'Generate now';

$_['help_archive_days'] = 'At least 30 days. Archives remain publicly available through a safe read-only route.';
$_['help_include_disabled'] = 'Normally leave disabled so the feed contains products offered publicly.';
$_['help_cron_token'] = '32 characters minimum. Used only for web cron; CLI mode does not expose a token in the process list.';
$_['help_customer_group'] = 'The public B2C price always uses this group, never the currently logged-in customer price.';
$_['help_language'] = 'Fixed language for names, stock status and mapped attributes; it does not depend on the administrator or visitor language.';
$_['help_unit_attribute'] = 'When applicable, select the OpenCart attribute containing each product’s unit of measure.';
$_['help_unit_price_attribute'] = 'When applicable, select the attribute containing a unit price such as “4.99 EUR/kg”.';
$_['help_special_sale_name'] = 'Published when a product has an active special or quantity-one discount.';
$_['help_object_identity'] = 'These values are included in XML and every archive filename together with its archive number and timestamp.';

$_['error_permission'] = 'You do not have permission to modify the digital price list.';
$_['error_archive_days'] = 'Retention must be between 30 and 3650 days.';
$_['error_cron_token'] = 'The cron token must contain 32 to 128 letters, digits, hyphens or underscores.';
$_['error_special_sale_name'] = 'The special sale type name is required.';
$_['error_object_identity'] = 'Object type, address and code are required.';
$_['error_generation'] = 'Generation failed: %s';
