<?php
$_['heading_title'] = 'Anchor Prices';

$_['text_extension'] = 'Extensions';
$_['text_success'] = 'Anchor Price settings have been saved.';
$_['text_edit'] = 'Settings and bulk import';
$_['text_enabled'] = 'Enabled';
$_['text_disabled'] = 'Disabled';
$_['text_import'] = 'CSV import';
$_['text_import_help'] = 'The CSV must contain an anchor price, a reference date and at least one product identifier. Price and date must both be supplied; leaving both fields empty removes an existing record. Anchor prices must be greater than zero. Semicolon, comma and tab delimiters are supported. The general reference date is 10 September 2026; food, drink, hygiene and household products retain 2 May 2025.';
$_['text_import_scale_help'] = 'Large catalogs: product_id is the fastest identifier because it uses the product primary-key index. The importer streams the file and commits batches of 500 rows. Files up to 100 MB are accepted, but PHP upload_max_filesize/post_max_size and the web-server timeout must also permit the upload; split exceptionally large imports if the proxy timeout is shorter.';
$_['text_import_columns'] = 'Columns: product_id, sku, model, anchor_price, reference_date (date: YYYY-MM-DD, DD.MM.YYYY or DD/MM/YYYY).';
$_['text_download_template'] = 'Download CSV template';
$_['text_import_complete'] = 'Import complete: %d updated, %d cleared, %d skipped rows.';
$_['text_import_error_line'] = 'Row %d: %s';
$_['text_ocmod_notice'] = 'After first installation or an OCMOD file change, refresh Modifications (Extensions → Modifications).';
$_['warning_customer_price'] = '“Login Display Prices” is enabled. Guests cannot see the current product price, so the anchor price is deliberately hidden from them as well. Disable that store setting if both prices must be public.';

$_['entry_status'] = 'Storefront display';
$_['entry_show_date'] = 'Show reference date';
$_['entry_csv'] = 'CSV file';
$_['entry_anchor_price'] = 'Anchor price';
$_['entry_anchor_reference_date'] = 'Reference date';

$_['help_anchor_price'] = 'The product price on the prescribed reference date. Enter a value greater than zero in the store base currency, without a currency symbol.';
$_['help_anchor_reference_date'] = 'The date to which the anchor price applies. It is stored per product; the general date is 10 September 2026 and prescribed existing categories use 2 May 2025.';

$_['button_save'] = 'Save';
$_['button_cancel'] = 'Cancel';
$_['button_import'] = 'Import CSV';

$_['error_permission'] = 'You do not have permission to modify Anchor Prices.';
$_['error_upload'] = 'The CSV file could not be uploaded.';
$_['error_file_size'] = 'The file must be no larger than 100 MB.';
$_['error_file_type'] = 'Only CSV and TXT files are allowed.';
$_['error_empty_file'] = 'The CSV file is empty.';
$_['error_columns'] = 'Required columns are missing. Include anchor_price, reference_date and at least one of product_id, sku or model.';
$_['error_truncated_row'] = 'the row is missing the mapped anchor_price or reference_date field; no data was changed.';
$_['error_product_id'] = 'product_id must be a whole number from 1 to 2147483647.';
$_['error_identifier_length'] = 'SKU and model identifiers may contain at most 64 characters.';
$_['error_import_locked'] = 'Another anchor-price import is already running. Wait for it to finish and try again.';
$_['error_ambiguous_product'] = 'The SKU or model matches multiple products; use product_id.';
$_['error_product_not_found'] = 'product not found.';
$_['error_price'] = 'invalid anchor price; enter a value greater than zero with at most four decimal places.';
$_['error_date'] = 'invalid reference date.';
$_['error_pair'] = 'anchor price and reference date must both be supplied, or both left empty to clear the record.';
$_['error_anchor_price_pair'] = 'Anchor price and reference date must either both be empty or both be valid. The anchor price must be greater than zero.';
$_['error_row'] = 'data could not be saved.';
