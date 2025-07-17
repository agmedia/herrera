<?php
/*------------------------------------------------------------------------
# Database Cache
# ------------------------------------------------------------------------
# The Krotek
# Copyright (C) 2011-2021 The Krotek. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website: https://thekrotek.com
# Support: support@thekrotek.com
-------------------------------------------------------------------------*/

$_['heading_title']       					= "Database Cache";
$_['heading_version']   					= "3.2.1";

$_['text_success']    						= "Success: You have modified Database Cache!";

/* Tabs */

$_['tab_general']  							= "Settings";
$_['help_general']  						= "";

/* General */

$_['entry_url']   							= "Action Link";
$_['help_url']  							= "Link to use in cron command or execute in the browser.";

$_['entry_secret']   						= "Action Secret";
$_['help_secret']  							= "Any random sequence of characters for increased security.";

$_['entry_timeout'] 						= "Cache Timeout";
$_['help_timeout'] 							= "Database cache timeout in seconds.";

$_['entry_search'] 							= "Cache Search";
$_['help_search'] 							= "Cache search queries as well.";

$_['entry_tables'] 							= "Cached Tables";
$_['help_tables'] 							= "Disable tables you don't want to be cached to decrease the cache size.";

/* Messages */

$_['message_clear_success'] 				= "Database cache was successfuly cleared.";

/* XML language strings */

$_['text_dbcache_clear'] 					= "Clear database cache";

/* Generic language strings */

$_['heading_latest']   				= "You have the latest version: %s";
$_['heading_future']   				= "Wow! You have version %s and it's from THE FUTURE!";
$_['heading_update']   				= "A new version available: %s. Click <a href='https://thekrotek.com/profile/my-orders' title='Download new version' target='_blank'>here</a> to download.";

$_['entry_license']					= "License ID";
$_['help_license']					= "Your order ID on TheKrotek.com or OpenCart.com site.";

$_['entry_debug']  					= "Debug";
$_['help_debug']  					= "Essential information will be saved in the log for additional debugging. Disable, when not needed!";

$_['entry_version']					= "Check Version";
$_['help_version']					= "Disable, if settings page loads too slow or connection errors displayed.";

$_['entry_store']					= "Stores";
$_['help_store']					= "Limit functionality to selected stores only (not selected - all stores).";

$_['entry_customer_group'] 			= "Customer Groups";
$_['help_customer_group'] 	 		= "Limit functionality to selected customer groups only (not selected - all groups and guests).";

$_['entry_geo_zone']   				= "Geo Zone";
$_['help_geo_zone']   				= "Limit functionality to selected geo zone only.";

$_['entry_tax_class']  				= "Tax Class";
$_['help_tax_class']   				= "Tax class to apply.";

$_['entry_status']     				= "Status";
$_['help_status']   				= "Enable or disable.";

$_['entry_sort_order'] 				= "Sort Order";
$_['help_sort_order']   			= "Position in the list of items of the same type.";

$_['text_edit_title']    	   		= "Edit %s";
$_['text_remove_all']				= "Remove all";
$_['text_none']   	    			= "--- None ---";

$_['text_extension']		 		= "Extensions";
$_['text_total']    				= "Total";
$_['text_module']    				= "Modules";
$_['text_shipping']    				= "Shipping";
$_['text_payment']    				= "Payment";
$_['text_feed']           	  		= "Feeds";

$_['button_apply']      			= "Apply";
$_['button_help']      				= "Help";

$_['text_content_top']    			= "Content Top";
$_['text_content_bottom'] 			= "Content Bottom";
$_['text_column_left']    			= "Column Left";
$_['text_column_right']   			= "Column Right";

$_['entry_module_layout']   		= "Layout:";
$_['entry_module_position'] 		= "Position:";
$_['entry_module_status']  			= "Status:";
$_['entry_module_sort']    			= "Sort Order:";

$_['message_success']     			= "Success: You have modified %s!";

$_['error_permission'] 				= "Warning: You do not have permission to modify %s!";
$_['error_license_empty'] 			= "License ID is missing. Please, enter your order ID from our site or from OpenCart.com.";
$_['error_version_data'] 			= "Impossible to get version information: Data for this product is not found.";
$_['error_version_disabled'] 		= "Impossible to get version information: Version check is disabled.";
$_['error_empty'] 					= "Error: %s value can't be empty.";
$_['error_numerical'] 				= "Error: %s value should be numerical.";
$_['error_percent'] 				= "Error: %s value should be numerical or in percent.";
$_['error_positive'] 				= "Error: %s value should be zero or more.";
$_['error_date'] 					= "Error: %s has wrong date format.";
$_['error_curl']      				= "cURL error: (%s) %s. Fix it (if necessary) and try to reinstall.";

?>