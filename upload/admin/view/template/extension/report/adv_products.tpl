<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right" style="white-space:nowrap;"><span style="padding-top:5px; padding-right:5px; font-size:11px; color:#666; text-align:right;"><?php echo $heading_version; ?></span></div>    
      <h1 class="panel-title"><i class="fa fa-bar-chart"></i> <?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
      <div align="right">
      <button type="button" onclick="filter()" title="<?php echo $button_filter; ?> Report" class="btn btn-primary" style="margin-bottom:10px;"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>&nbsp;
      <button type="button" onclick="$(':input').not(':button, :submit, :reset, :hidden, :checkbox, :radio').val(''); $('option', $('.clear')).each(function(element) {$(this).removeAttr('selected').prop('selected', false);}); $('.clear').multiselect('refresh');" title="<?php echo $button_clear; ?> Filters" id="clear-filter" class="btn btn-primary" style="margin-bottom:10px;"><i class="fa fa-eraser"></i> <?php echo $button_clear; ?></button>&nbsp;
      <button type="button" data-toggle="modal" data-target="#load_save" data-backdrop="static" title="<?php echo $button_load_save; ?> Report" class="btn btn-load-save" style="margin-bottom:10px;"><i class="fa fa-search-plus"></i> <?php echo $button_load_save; ?></button>&nbsp;
      <button type="button" data-toggle="modal" data-target="#export" data-backdrop="static" title="<?php echo $button_export; ?> Report" class="btn btn-success" style="margin-bottom:10px;"><i class="fa fa-save"></i> <?php echo $button_export; ?></button>&nbsp;
	  <div class="btn-group" style="margin-bottom:10px;">
		<button type="button" class="btn btn-set dropdown-toggle" data-toggle="dropdown" title="<?php echo $button_settings; ?>"><i class="fa fa-cog"></i> <?php echo $button_settings; ?> <span class="caret"></span></button>
		  <ul class="dropdown-menu">
			<li><a href="#" data-toggle="modal" data-target="#settings"><?php echo $text_report_settings; ?></a></li>           
            <li><a href="#" data-toggle="modal" data-target="#cron"><?php echo $text_cron_settings; ?></a></li>
		  </ul>
	  </div>
      <div class="row">
      	  <div class="col-lg-3" style="z-index:5;"><div class="input-group" style="width:100%;"><span class="input-group-addon" style="width:35%; text-align:left; font-weight:bold; color:#666;"><?php echo $entry_report; ?></span>
          <select name="filter_report" id="filter_report" onchange="checkValidOptions(); filter();" data-style="btn-type" data-width="65%" class="select show-tick"> 
			<?php foreach ($report as $report) { ?>
			<?php if ($report['value'] == $filter_report) { ?>
			<option value="<?php echo $report['value']; ?>" title="<?php echo $report['text']; ?>" data-subtext="<?php echo $report['subtext']; ?>" data-divider="<?php echo $report['divider']; ?>" selected="selected"><?php echo $report['text']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $report['value']; ?>" title="<?php echo $report['text']; ?>" data-subtext="<?php echo $report['subtext']; ?>" data-divider="<?php echo $report['divider']; ?>"><?php echo $report['text']; ?></option>
			<?php } ?>
			<?php } ?>
          </select></div></div>
          <div class="col-lg-2" style="z-index:4;"><div class="input-group" style="width:100%;"><span class="input-group-addon" style="width:35%; text-align:left; font-weight:bold; color:#666;"><?php echo $entry_show_details; ?></span>
		  <select name="filter_details" id="filter_details" onchange="checkValidOptions();" data-style="btn-select" data-width="65%" class="select" <?php echo ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? 'disabled="disabled"' : '' ?>>                      
			<?php foreach ($details as $details) { ?>
			<?php if ($details['value'] == $filter_details) { ?>
			<option value="<?php echo $details['value']; ?>" title="<?php echo $details['text']; ?>" data-subtext="<?php echo $details['subtext']; ?>" selected="selected"><?php echo $details['text']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $details['value']; ?>" title="<?php echo $details['text']; ?>" data-subtext="<?php echo $details['subtext']; ?>"><?php echo $details['text']; ?></option>
			<?php } ?> 
            <?php } ?>              
          	<?php if ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>
			<option value="" selected="selected"></option>
			<?php } ?>               
          </select></div></div>          
      	  <div class="col-lg-2" style="z-index:3;"><div class="input-group" style="width:100%;"><span class="input-group-addon" style="width:35%; text-align:left; font-weight:bold; color:#666;"><?php echo $entry_group; ?></span>
          <select name="filter_group" id="filter_group" data-style="btn-select" data-width="65%" class="select" <?php echo ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders' or $filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? 'disabled="disabled"' : '' ?>> 
			<?php foreach ($group as $group) { ?>
			<?php if ($group['value'] == $filter_group) { ?>
			<option value="<?php echo $group['value']; ?>" title="<?php echo $group['text']; ?>" selected="selected"><?php echo $group['text']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $group['value']; ?>" title="<?php echo $group['text']; ?>"><?php echo $group['text']; ?></option>
			<?php } ?>
			<?php } ?> 
          	<?php if ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders' or $filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>
			<option value="" selected="selected"></option>
			<?php } ?>                        
          </select></div></div>
          <div class="col-lg-3" style="z-index:2;"><div class="input-group" style="width:100%;"><span class="input-group-addon" style="width:35%; text-align:left; font-weight:bold; color:#666;"><?php echo $entry_sort_by; ?></span>
		  <select name="filter_sort" id="filter_sort" data-style="btn-select" data-width="40%" class="select" <?php echo ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders' or $filter_report == 'products_options') ? 'disabled="disabled"' : '' ?>>
			<?php foreach ($sort as $sort) { ?>
			<?php if ($sort['value'] == $filter_sort) { ?>
			<option id="<?php echo $sort['value']; ?>" value="<?php echo $sort['value']; ?>" title="<?php echo $sort['text']; ?>" selected="selected"><?php echo $sort['text']; ?></option>
			<?php } else { ?>
			<option id="<?php echo $sort['value']; ?>" value="<?php echo $sort['value']; ?>" title="<?php echo $sort['text']; ?>"><?php echo $sort['text']; ?></option>
			<?php } ?> 
            <?php } ?>         
          	<?php if ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders' or $filter_report == 'products_options') { ?>
			<option value="" selected="selected"></option>
			<?php } ?>            
          </select>
		  <select name="filter_order" id="filter_order" data-style="btn-select" data-width="25%" class="select" <?php echo ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders' or $filter_report == 'products_options') ? 'disabled="disabled"' : '' ?>>
			<?php foreach ($order as $order) { ?>
			<?php if ($order['value'] == $filter_order) { ?>
			<option value="<?php echo $order['value']; ?>" title="<?php echo $order['text']; ?>" selected="selected"><?php echo $order['text']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $order['value']; ?>" title="<?php echo $order['text']; ?>"><?php echo $order['text']; ?></option>
			<?php } ?> 
            <?php } ?>         
          	<?php if ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders' or $filter_report == 'products_options') { ?>
			<option value="" selected="selected"></option>
			<?php } ?>            
          </select></div></div>
          <div class="col-lg-2" style="z-index:1;"><div class="input-group" style="width:100%;"><span class="input-group-addon" style="width:35%; text-align:left; font-weight:bold; color:#666;"><?php echo $entry_limit; ?></span>
		  <select name="filter_limit" id="filter_limit" data-style="btn-select" data-width="65%" class="select"> 
			<?php foreach ($limit as $limit) { ?>
			<?php if ($limit['value'] == $filter_limit) { ?>
			<option value="<?php echo $limit['value']; ?>" title="<?php echo $limit['text']; ?>" data-subtext="<?php echo $limit['subtext']; ?>" selected="selected"><?php echo $limit['text']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $limit['value']; ?>" title="<?php echo $limit['text']; ?>" data-subtext="<?php echo $limit['subtext']; ?>"><?php echo $limit['text']; ?></option>
			<?php } ?> 
            <?php } ?>            
          </select></div></div>
		</div>          
	  </div>
	</div>
<div class="panel-body">
<div class="loader"></div>
<style type="text/css">
.loader {
	position: fixed;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('view/image/adv_reports/page_loading.gif') 50% 50% no-repeat rgb(255,255,255);
}

.list_main {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;	
	margin-bottom: 10px;
}
.list_main td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;	
}
.list_main thead td {
	background-color: #F0F0F0;
	padding: 0px 5px;
	font-weight: bold;
}
.list_main tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list_main .left {
	text-align: left;
	padding: 7px;
}
.list_main .right {
	text-align: right;
	padding: 7px;
}
.list_main .center {
	text-align: center;
	padding: 3px;
}
.list_main .noresult {
	text-align: center;
	padding: 7px;
}
.list_detail {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-top: 10px;
	margin-bottom: 10px;
}
.list_detail td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.list_detail thead td {
	background-color: #f5f5f5;
	padding: 0px 3px;
	font-size: 11px;
	font-weight: bold;
}
.list_detail tbody td {
	padding: 0px 3px;
	font-size: 11px;	
}
.list_detail .left {
	text-align: left;
	padding: 3px;
}
.list_detail .right {
	text-align: right;
	padding: 3px;
}
.list_detail .center {
	text-align: center;
	padding: 3px;
}
table.list_detail tr:hover {
	background-color: #F9F9F9;
}

.btn-set {
  color: #fff;
  background-color: #777;
  border-color: #888;
}
.btn-set:hover,
.btn-set:focus,
.btn-set:active,
.btn-set.active,
.open > .dropdown-toggle.btn-set {
  color: #fff;
  background-color: #666;
  border-color: #777;
}
.btn-set:active,
.btn-set.active,
.open > .dropdown-toggle.btn-set {
  background-image: none;
}
.btn-set.disabled,
.btn-set[disabled],
fieldset[disabled] .btn-set,
.btn-set.disabled:hover,
.btn-set[disabled]:hover,
fieldset[disabled] .btn-set:hover,
.btn-set.disabled:focus,
.btn-set[disabled]:focus,
fieldset[disabled] .btn-set:focus,
.btn-set.disabled:active,
.btn-set[disabled]:active,
fieldset[disabled] .btn-set:active,
.btn-set.disabled.active,
.btn-set[disabled].active,
fieldset[disabled] .btn-set.active {
  background-color: #777;
  border-color: #888;
}
.btn-set .badge {
  color: #777;
  background-color: #fff;
}
.btn-load-save {
  color: #fff;
  background-color: #6ab0d6;
  border-color: #64a9cd;
}
.btn-load-save:hover,
.btn-load-save:focus,
.btn-load-save:active,
.btn-load-save.active,
.open > .dropdown-toggle.btn-load-save {
  color: #fff;
  background-color: #5097bd;
  border-color: #3293c7;
}
.btn-load-save:active,
.btn-load-save.active,
.open > .dropdown-toggle.btn-load-save {
  background-image: none;
}
.btn-load-save.disabled,
.btn-load-save[disabled],
fieldset[disabled] .btn-load-save,
.btn-load-save.disabled:hover,
.btn-load-save[disabled]:hover,
fieldset[disabled] .btn-load-save:hover,
.btn-load-save.disabled:focus,
.btn-load-save[disabled]:focus,
fieldset[disabled] .btn-load-save:focus,
.btn-load-save.disabled:active,
.btn-load-save[disabled]:active,
fieldset[disabled] .btn-load-save:active,
.btn-load-save.disabled.active,
.btn-load-save[disabled].active,
fieldset[disabled] .btn-load-save.active {
  background-color: #5097bd;
  border-color: #3293c7;
}
.btn-load-save .badge {
  color: #5097bd;
  background-color: #fff;
}

.form-control {
	border: solid 1px #CCC;
	background-color: #fcfcfc;
}

.btn-type {
	background-color: #ffcc99;
	border: 1px solid #CCC;
}
.btn-select {
	background-color: #fcfcfc;
	border: 1px solid #CCC;
}
.icon-green {
	color: #008040;
}
.icon-dark-green {
	color: #008000;
}
.icon-red {
	color: #F00;
}
.icon-black {
	color: #000;
}

#settings .checkbox {
	margin-top: 1px;
	margin-bottom: 1px;
}
#settings .checkbox + .checkbox {
	margin-top: 1px;
	margin-bottom: 1px;
}


.btn-group-ms {
	width: 100%;
}
.btn-group-ms > .multiselect.btn {
	width: 100%;
}
.multiselect ul {
	width: 100%;
}

.hide-chart {
	display: none;
}
.disabled {
    pointer-events: none;
    opacity: 0.4;
}
</style>
<div class="well">
    <div class="row" style="margin-bottom:10px;">
      <div class=<?php echo (($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_abandoned_orders') ? "col-lg-6" : (($filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? "col-lg-12" : "col-lg-4")) ?> style="background:#f2f2f2; border:1px solid #DDD; margin-top:1px;">
        <div align="center" style="margin-top:5px;"><label class="control-label">
        <?php if ($filter_report == 'products_abandoned_orders') { ?>
        	<?php echo $entry_order_abandoned; ?> 
		<?php } elseif ($filter_report == 'products_shopping_carts') { ?>
        	<?php echo $entry_added_to_cart; ?>
		<?php } elseif ($filter_report == 'products_wishlists') { ?>
        	<?php echo $entry_added_to_wishlist; ?>            
		<?php } elseif ($filter_report == 'all_products_with_without_orders') { ?>
        	<?php echo $entry_product_added; ?>  
		<?php } else { ?>
        	<?php echo $entry_order_created; ?>
		<?php } ?>     	
        </label></div>     
        <div class="row">
          <div class="col-sm-6" style="padding-bottom:15px;"><?php echo $entry_range; ?><br /> 
            <select name="filter_range" id="filter_range" data-style="btn-select" class="form-control select" style="z-index:5;">
              <?php foreach ($ranges as $range) { ?>
              <?php if ($range['value'] == $filter_range) { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>" selected="selected"><?php echo $range['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>"><?php echo $range['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></div>
          <div class="col-sm-3" style="padding-bottom:15px;"><span style="white-space:nowrap;"><?php echo $entry_date_start; ?></span><br />
            <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" data-date-format="YYYY-MM-DD" id="date-start" class="form-control" style="color:#F90;" />
		  </div>
          <div class="col-sm-3" style="padding-bottom:15px;"><span style="white-space:nowrap;"><?php echo $entry_date_end; ?></span><br />
            <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" data-date-format="YYYY-MM-DD" id="date-end" class="form-control" style="color:#F90;" />
          </div>
        </div>  
      </div> 
	  <?php if ($filter_report != 'products_without_orders' && $filter_report != 'products_abandoned_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
      <div class=<?php echo ($filter_report == 'all_products_with_without_orders') ? "col-lg-6" : "col-lg-4" ?> style="background:#f2f2f2; border:1px solid #DDD; margin-top:1px;">
        <div align="center" style="margin-top:5px;"><label class="control-label"><?php echo ($filter_report == 'all_products_with_without_orders') ? substr($entry_status,0,-1) : $entry_status_changed ?></label></div>       
        <div class="row">
          <?php if ($filter_report != 'all_products_with_without_orders') { ?>
          <div class="col-sm-3" style="padding-bottom:15px;"><span style="white-space:nowrap;"><?php echo $entry_date_start; ?></span><br />
            <input type="text" name="filter_status_date_start" value="<?php echo $filter_status_date_start; ?>" data-date-format="YYYY-MM-DD" id="status-date-start" class="form-control" style="color:#F90;">
		  </div>
          <div class="col-sm-3" style="padding-bottom:15px;"><span style="white-space:nowrap;"><?php echo $entry_date_end; ?></span><br />
            <input type="text" name="filter_status_date_end" value="<?php echo $filter_status_date_end; ?>" data-date-format="YYYY-MM-DD" id="status-date-end" class="form-control" style="color:#F90;">
          </div>
          <?php } ?>      
          <div class=<?php echo ($filter_report == 'all_products_with_without_orders') ? "col-sm-12" : "col-sm-6" ?> style="padding-bottom:15px;"><?php echo $entry_status; ?><br />
            <select name="filter_order_status_id" id="filter_order_status_id" class="form-control clear" multiple="multiple" size="1">
              <?php foreach ($order_statuses as $order_status) { ?>
              <?php if (in_array($order_status['order_status_id'], $filter_order_status_id)) { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></div>
        </div>  
      </div> 
	  <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <div class=<?php echo ($filter_report == 'products_abandoned_orders' ? "col-lg-3" : "col-lg-2") ?> style="background:#f2f2f2; border:1px solid #DDD; margin-top:1px;">
        <div align="center" style="margin-top:5px;"><label class="control-label"><?php echo $entry_order_id; ?></label></div>       
        <div class="row">
          <div class="col-sm-6" style="padding-bottom:15px;"><?php echo $entry_order_id_from; ?><br />
            <input type="text" name="filter_order_id_from" value="<?php echo $filter_order_id_from; ?>" size="12" class="form-control">
		  </div>
          <div class="col-sm-6" style="padding-bottom:15px;"><?php echo $entry_order_id_to; ?><br />
            <input type="text" name="filter_order_id_to" value="<?php echo $filter_order_id_to; ?>" size="12" class="form-control">
          </div>
        </div>  
      </div> 
      <div class=<?php echo ($filter_report == 'products_abandoned_orders' ? "col-lg-3" : "col-lg-2") ?> style="background:#f2f2f2; border:1px solid #DDD; margin-top:1px;">
        <div align="center" style="margin-top:5px;"><label class="control-label"><?php echo $entry_price_value; ?></label></div>       
        <div class="row">
          <div class="col-sm-6" style="padding-bottom:15px;"><?php echo $entry_price_value_min; ?><br />
            <input type="text" name="filter_prod_price_min" value="<?php echo $filter_prod_price_min; ?>" size="12" class="form-control" />
		  </div>
          <div class="col-sm-6" style="padding-bottom:15px;"><?php echo $entry_price_value_max; ?><br />
            <input type="text" name="filter_prod_price_max" value="<?php echo $filter_prod_price_max; ?>" size="12" class="form-control" />
          </div>
        </div>  
      </div>        
      <?php } ?>      
    </div>
    <div class="row">
	<div class="col-sm-12" align="right">
	<a class="btn btn-primary btn-xs filters-button"><i class="fa fa-search"></i> <span class="filters_button"><?php echo $button_filters; ?></span></a>
	</div> 
    </div> 
    <div id="filters" class="row filters-switcher <?php echo (isset($_COOKIE['show-pp-filters']) && $_COOKIE['show-pp-filters'] == 1) ? '' : 'row hide-filters'; ?>">   
      <?php if (in_array('store', $advpp_settings_filters)) { ?>
   		<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_store_id" style="white-space:nowrap;"><?php echo $entry_store; ?></label>
          <select name="filter_store_id" id="filter_store_id" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($stores as $store) { ?>   
            <?php if (in_array($store['store_id'], $filter_store_id)) { ?>        
            <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['store_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $store['store_id']; ?>"><?php echo $store['store_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
	  <?php } ?>      
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	  <?php if (in_array('currency', $advpp_settings_filters)) { ?>  
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_currency" style="white-space:nowrap;"><?php echo $entry_currency; ?></label>
          <select name="filter_currency" id="filter_currency" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($currencies as $currency) { ?>
            <?php if (in_array($currency['currency_id'], $filter_currency)) { ?>
            <option value="<?php echo $currency['currency_id']; ?>" selected="selected"><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)</option>
            <?php } else { ?>
            <option value="<?php echo $currency['currency_id']; ?>"><?php echo $currency['title']; ?> (<?php echo $currency['code']; ?>)</option>
            <?php } ?>
            <?php } ?>
          </select></div>
	  <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
	  <?php if (in_array('tax', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_taxes" style="white-space:nowrap;"><?php echo $entry_tax; ?></label>
		  <select name="filter_taxes" id="filter_taxes" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($taxes as $tax) { ?>
            <?php if (in_array($tax['tax'], $filter_taxes)) { ?> 
            <option value="<?php echo $tax['tax']; ?>" selected="selected"><?php echo $tax['tax_title']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $tax['tax']; ?>"><?php echo $tax['tax_title']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
	  <?php } ?>
      <?php } ?>
	  <?php if (in_array('tax_class', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
   		<label class="control-label" for="filter_tax_classes" style="white-space:nowrap;"><?php echo $entry_tax_classes; ?></label>
		  <select name="filter_tax_classes" id="filter_tax_classes" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($tax_classes as $tax_class) { ?>
            <?php if (in_array($tax_class['tax_class'], $filter_tax_classes)) { ?>              
            <option value="<?php echo $tax_class['tax_class']; ?>" selected="selected"><?php echo $tax_class['tax_class_title']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $tax_class['tax_class']; ?>"><?php echo $tax_class['tax_class_title']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
	  <?php if (in_array('geo_zone', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_geo_zones" style="white-space:nowrap;"><?php echo $entry_geo_zone; ?></label>
		  <select name="filter_geo_zones" id="filter_geo_zones" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($geo_zones as $geo_zone) { ?>
            <?php if (in_array($geo_zone['geo_zone_country_id'], $filter_geo_zones)) { ?>
            <option value="<?php echo $geo_zone['geo_zone_country_id']; ?>" selected="selected"><?php echo $geo_zone['geo_zone_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $geo_zone['geo_zone_country_id']; ?>"><?php echo $geo_zone['geo_zone_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
	  <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
	  <?php if (in_array('customer_group', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_customer_group_id" style="white-space:nowrap;"><?php echo $entry_customer_group; ?></label>
          <select name="filter_customer_group_id" id="filter_customer_group_id" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($customer_groups as $customer_group) { ?>
            <?php if (in_array($customer_group['customer_group_id'], $filter_customer_group_id)) { ?>
            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>   
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('customer_name', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_customer_name" style="white-space:nowrap;"><?php echo $entry_customer_name; ?></label>
        <input type="text" name="filter_customer_name" id="filter_customer_name" value="<?php echo $filter_customer_name; ?>" class="form-control" style="color:#F90;" />
		</div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('customer_email', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_customer_email" style="white-space:nowrap;"><?php echo $entry_customer_email; ?></label>
        <input type="text" name="filter_customer_email" id="filter_customer_email" value="<?php echo $filter_customer_email; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>   
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('customer_telephone', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_customer_telephone" style="white-space:nowrap;"><?php echo $entry_customer_telephone; ?></label>
        <input type="text" name="filter_customer_telephone" id="filter_customer_telephone" value="<?php echo $filter_customer_telephone; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('ip', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_ip" style="white-space:nowrap;"><?php echo $entry_ip; ?></label>
        <input type="text" name="filter_ip" id="filter_ip" value="<?php echo $filter_ip; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('payment_company', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_payment_company" style="white-space:nowrap;"><?php echo ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? substr(strstr($entry_payment_company,' '), 1) : $entry_payment_company ?></label>
        <input type="text" name="filter_payment_company" id="filter_payment_company" value="<?php echo $filter_payment_company; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('payment_address', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_payment_address" style="white-space:nowrap;"><?php echo ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? substr(strstr($entry_payment_address,' '), 1) : $entry_payment_address ?></label>
        <input type="text" name="filter_payment_address" id="filter_payment_address" value="<?php echo $filter_payment_address; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('payment_city', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_payment_city" style="white-space:nowrap;"><?php echo ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? substr(strstr($entry_payment_city,' '), 1) : $entry_payment_city ?></label>
        <input type="text" name="filter_payment_city" id="filter_payment_city" value="<?php echo $filter_payment_city; ?>" class="form-control" style="color:#F90;" />
		</div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>     
      <?php if (in_array('payment_zone', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_payment_zone" style="white-space:nowrap;"><?php echo ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? substr(strstr($entry_payment_zone,' '), 1) : $entry_payment_zone ?></label>
        <input type="text" name="filter_payment_zone" id="filter_payment_zone" value="<?php echo $filter_payment_zone; ?>" class="form-control" style="color:#F90;" />
		</div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>       
      <?php if (in_array('payment_postcode', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_payment_postcode" style="white-space:nowrap;"><?php echo ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? substr(strstr($entry_payment_postcode,' '), 1) : $entry_payment_postcode ?></label>
        <input type="text" name="filter_payment_postcode" id="filter_payment_postcode" value="<?php echo $filter_payment_postcode; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
	  <?php } ?>   
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>       
      <?php if (in_array('payment_country', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_payment_country" style="white-space:nowrap;"><?php echo ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') ? substr(strstr($entry_payment_country,' '), 1) : $entry_payment_country ?></label>
        <input type="text" name="filter_payment_country" id="filter_payment_country" value="<?php echo $filter_payment_country; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>      
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>       
      <?php if (in_array('payment_method', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_payment_method" style="white-space:nowrap;"><?php echo $entry_payment_method; ?></label>
		  <select name="filter_payment_method" id="filter_payment_method" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($payment_methods as $payment_method) { ?>
            <?php if (in_array($payment_method['payment_code'], $filter_payment_method)) { ?>
            <option value="<?php echo $payment_method['payment_code']; ?>" selected="selected"><?php echo preg_replace('~\(.*?\)~', '', $payment_method['payment_method']); ?></option>
            <?php } else { ?>
            <option value="<?php echo $payment_method['payment_code']; ?>"><?php echo preg_replace('~\(.*?\)~', '', $payment_method['payment_method']); ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>       
      <?php if (in_array('shipping_company', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_shipping_company" style="white-space:nowrap;"><?php echo $entry_shipping_company; ?></label>
        <input type="text" name="filter_shipping_company" id="filter_shipping_company" value="<?php echo $filter_shipping_company; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>       
      <?php if (in_array('shipping_address', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_shipping_address" style="white-space:nowrap;"><?php echo $entry_shipping_address; ?></label>
        <input type="text" name="filter_shipping_address" id="filter_shipping_address" value="<?php echo $filter_shipping_address; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('shipping_city', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_shipping_city" style="white-space:nowrap;"><?php echo $entry_shipping_city; ?></label>
        <input type="text" name="filter_shipping_city" id="filter_shipping_city" value="<?php echo $filter_shipping_city; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('shipping_zone', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_shipping_zone" style="white-space:nowrap;"><?php echo $entry_shipping_zone; ?></label>
        <input type="text" name="filter_shipping_zone" id="filter_shipping_zone" value="<?php echo $filter_shipping_zone; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('shipping_postcode', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_shipping_postcode" style="white-space:nowrap;"><?php echo $entry_shipping_postcode; ?></label>
        <input type="text" name="filter_shipping_postcode" id="filter_shipping_postcode" value="<?php echo $filter_shipping_postcode; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('shipping_country', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_shipping_country" style="white-space:nowrap;"><?php echo $entry_shipping_country; ?></label>
        <input type="text" name="filter_shipping_country" id="filter_shipping_country" value="<?php echo $filter_shipping_country; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('shipping_method', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_shipping_method" style="white-space:nowrap;"><?php echo $entry_shipping_method; ?></label>
		  <select name="filter_shipping_method" id="filter_shipping_method" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($shipping_methods as $shipping_method) { ?>
            <?php if (in_array($shipping_method['shipping_code'], $filter_shipping_method)) { ?>
            <option value="<?php echo $shipping_method['shipping_code']; ?>" selected="selected"><?php echo preg_replace('~\(.*?\)~', '', $shipping_method['shipping_method']); ?></option>
            <?php } else { ?>
            <option value="<?php echo $shipping_method['shipping_code']; ?>"><?php echo preg_replace('~\(.*?\)~', '', $shipping_method['shipping_method']); ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php } ?>
      <?php if (in_array('category', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_category" style="white-space:nowrap;"><?php echo $entry_category; ?></label>
          <select name="filter_category" id="filter_category" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($categories as $category) { ?>          
			<?php if (in_array($category['category_id'], $filter_category)) { ?>
			<option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
			<?php } ?>
			<?php } ?>
          </select></div>
      <?php } ?>
      <?php if (in_array('manufacturer', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_manufacturer" style="white-space:nowrap;"><?php echo $entry_manufacturer; ?></label>
          <select name="filter_manufacturer" id="filter_manufacturer" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($manufacturers as $manufacturer) { ?>
            <?php if (in_array($manufacturer['manufacturer_id'], $filter_manufacturer)) { ?>
            <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option> 
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>    
      <?php if (in_array('product', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_product_name" style="white-space:nowrap;"><?php echo $entry_product; ?></label>
        <input type="text" name="filter_product_name" id="filter_product_name" value="<?php echo $filter_product_name; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php if (in_array('sku', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_sku" style="white-space:nowrap;"><?php echo $entry_sku; ?></label>
        <input type="text" name="filter_sku" id="filter_sku" value="<?php echo $filter_sku; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php if (in_array('upc', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_upc" style="white-space:nowrap;"><?php echo $entry_upc; ?></label>
        <input type="text" name="filter_upc" id="filter_upc" value="<?php echo $filter_upc; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php if (in_array('ean', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_ean" style="white-space:nowrap;"><?php echo $entry_ean; ?></label>
        <input type="text" name="filter_ean" id="filter_ean" value="<?php echo $filter_ean; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php if (in_array('jan', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_jan" style="white-space:nowrap;"><?php echo $entry_jan; ?></label>
        <input type="text" name="filter_jan" id="filter_jan" value="<?php echo $filter_jan; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php if (in_array('isbn', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_isbn" style="white-space:nowrap;"><?php echo $entry_isbn; ?></label>
        <input type="text" name="filter_isbn" id="filter_isbn" value="<?php echo $filter_isbn; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php if (in_array('mpn', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_mpn" style="white-space:nowrap;"><?php echo $entry_mpn; ?></label>
        <input type="text" name="filter_mpn" id="filter_mpn" value="<?php echo $filter_mpn; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>  
      <?php if (in_array('model', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_model" style="white-space:nowrap;"><?php echo $entry_model; ?></label>
        <input type="text" name="filter_model" id="filter_model" value="<?php echo $filter_model; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('option', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_option" style="white-space:nowrap;"><?php echo $entry_option; ?></label>
          <select name="filter_option" id="filter_option" class="form-control clear" multiple="multiple" size="1" <?php echo ($filter_report == 'products_purchased_with_options' or $filter_report == 'products_options') ? '' : 'disabled="disabled"' ?>>
            <?php foreach ($order_options as $order_option) { ?>
            <?php if (in_array($order_option['options'], $filter_option)) { ?>
            <option value="<?php echo $order_option['options']; ?>" selected="selected"><?php echo $order_option['option_name']; ?>: <?php echo $order_option['option_value']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_option['options']; ?>"><?php echo $order_option['option_name']; ?>: <?php echo $order_option['option_value']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php } ?>
      <?php if (in_array('attribute', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_attribute" style="white-space:nowrap;"><?php echo $entry_attributes; ?></label>
		  <select name="filter_attribute" id="filter_attribute" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($attributes as $attribute) { ?>
            <?php if (in_array($attribute['attribute_title'], $filter_attribute)) { ?>
            <option value="<?php echo $attribute['attribute_title']; ?>" selected="selected"><?php echo $attribute['attribute_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $attribute['attribute_title']; ?>"><?php echo $attribute['attribute_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php if (in_array('product_status', $advpp_settings_filters)) { ?>
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_product_status" style="white-space:nowrap;"><?php echo $entry_product_status; ?></label>
          <select name="filter_product_status" id="filter_product_status" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($product_statuses as $product_status) { ?>
            <?php if (in_array($product_status['status'], $filter_product_status) && $product_status['status'] == 1) { ?>
            <option value="<?php echo $product_status['status']; ?>" selected="selected"><?php echo $text_enabled; ?></option>
            <?php } elseif (!in_array($product_status['status'], $filter_product_status) && $product_status['status'] == 1) { ?>
            <option value="<?php echo $product_status['status']; ?>"><?php echo $text_enabled; ?></option>
            <?php } ?>
            <?php if (in_array($product_status['status'], $filter_product_status) && $product_status['status'] == 0) { ?>
            <option value="<?php echo $product_status['status']; ?>" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } elseif (!in_array($product_status['status'], $filter_product_status) && $product_status['status'] == 0) { ?>
            <option value="<?php echo $product_status['status']; ?>"><?php echo $text_disabled; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>        
      <?php if (in_array('location', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_location" style="white-space:nowrap;"><?php echo $entry_location; ?></label>
		  <select name="filter_location" id="filter_location" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($locations as $location) { ?>
            <?php if (in_array($location['location_title'], $filter_location)) { ?>
            <option value="<?php echo $location['location_title']; ?>" selected="selected"><?php echo $location['location_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $location['location_title']; ?>"><?php echo $location['location_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('coupon_name', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_coupon_name" style="white-space:nowrap;"><?php echo $entry_coupon_name; ?></label>
          <select name="filter_coupon_name" id="filter_coupon_name" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($coupon_names as $coupon_name) { ?>
            <?php if (in_array($coupon_name['coupon_id'], $filter_coupon_name)) { ?>
            <option value="<?php echo $coupon_name['coupon_id']; ?>" selected="selected"><?php echo $coupon_name['coupon_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $coupon_name['coupon_id']; ?>"><?php echo $coupon_name['coupon_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('coupon_code', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_coupon_code" style="white-space:nowrap;"><?php echo $entry_coupon_code; ?></label>
        <input type="text" name="filter_coupon_code" id="filter_coupon_code" value="<?php echo $filter_coupon_code; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('voucher_code', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_voucher_code" style="white-space:nowrap;"><?php echo $entry_voucher_code; ?></label>
        <input type="text" name="filter_voucher_code" id="filter_voucher_code" value="<?php echo $filter_voucher_code; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>  
      <?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?> 
      <?php if (in_array('campaign_name', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_campaign_name" style="white-space:nowrap;"><?php echo $entry_campaign_name; ?></label>
          <select name="filter_campaign_name" id="filter_campaign_name" class="form-control clear" multiple="multiple" size="1">
            <?php foreach ($campaign_names as $campaign_name) { ?>
            <?php if (in_array($campaign_name['marketing_id'], $filter_campaign_name)) { ?>
            <option value="<?php echo $campaign_name['marketing_id']; ?>" selected="selected"><?php echo $campaign_name['campaign_name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $campaign_name['marketing_id']; ?>"><?php echo $campaign_name['campaign_name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>
      <?php } ?>
      <?php if (in_array('campaign_code', $advpp_settings_filters)) { ?>      
    	<div class="col-lg-2" style="height:75px;">
    	<label class="control-label" for="filter_campaign_code" style="white-space:nowrap;"><?php echo $entry_campaign_code; ?></label>
        <input type="text" name="filter_campaign_code" id="filter_campaign_code" value="<?php echo $filter_campaign_code; ?>" class="form-control" style="color:#F90;" />
        </div>
      <?php } ?>
      <?php } ?>
	</div>
</div>
<div class="modal fade" id="load_save" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-info">
    <div class="modal-content" id="modal-content">
      <div class="modal-header" style="background-color:#6ab0d6;">
        <button type="button" class="close" data-dismiss="modal" style="color:#FFF;"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
        <h4 class="modal-title" style="color:#FFF;"><?php echo $button_load_save; ?> Report</h4>
      </div>
      <div class="modal-body">
      <fieldset>
      <legend><?php echo $text_load_save_options; ?></legend> 
      <div class="table-responsive">
      <div><?php echo $text_load_save; ?></div><br />
        <table width="100%" id="adv_load_save" class="table table-bordered table-hover">
          <thead>
            <tr>
              <td width="5%"></td>
              <td width="50%" class="text-left"><?php echo $entry_title; ?></td>
              <td width="40%" class="text-left"><?php echo $entry_link; ?></td>              
              <td width="5%"></td>
            </tr>
          </thead>        
          <?php if ($advpp_load_save_reports) { ?>
		   <?php $adv_load_save_reports_row = 0; ?>
			<?php foreach ($advpp_load_save_reports as $advpp_load_save_report) { ?>
			  <tbody id="adv_load_save_reports_row<?php echo $adv_load_save_reports_row; ?>">
				<tr> 
				  <td width="5%" class="text-center"><button type="button" onclick="$('#adv_load_save_reports_row<?php echo $adv_load_save_reports_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>                
				  <td width="45%" class="text-left"><input type="text" name="advpp_load_save_report[<?php echo $adv_load_save_reports_row; ?>][save_report_title]" value="<?php echo $advpp_load_save_report['save_report_title']; ?>" placeholder="<?php echo $text_report_title; ?>" class="form-control" /></td>
				  <td width="40%" class="text-left"><textarea readonly name="advpp_load_save_report[<?php echo $adv_load_save_reports_row; ?>][save_report_link]" class="form-control"><?php echo $advpp_load_save_report['save_report_link']; ?></textarea></td>    
				  <td width="10%" class="text-center"><button type="button" onclick="location = '<?php echo ($report_link . str_replace('index.php?route=extension/report/adv_products', '', $advpp_load_save_report['save_report_link'])); ?>'" data-toggle="tooltip" title="<?php echo $button_load; ?> Report" class="btn btn-primary"><i class="fa fa-circle-o-notch"></i> <?php echo $button_load; ?></button></td>                                
				</tr>
			  </tbody>
            <?php $adv_load_save_reports_row++; ?>
  		    <?php } ?>
          <?php } else { ?>
		     <?php $adv_load_save_reports_row = 0; ?>
		  <?php } ?>
		  <tfoot>
            <tr>
              <td colspan="3"></td>
              <td class="text-left"> <button type="button" onclick="addSaveReport(); this.parentNode.parentNode.style.display = 'none';" title="<?php echo $button_add_report; ?> Report" class="btn btn-load-save"><i class="fa fa-plus-circle"></i> <?php echo $button_add_report; ?></button></td>
            </tr>
          </tfoot>          
        </table>
        </div>
		</fieldset>
        <div align="right" style="padding-top:10px;">
		  <button type="button" class="btn btn-default" title="<?php echo $button_close; ?>" data-dismiss="modal"><i class="fa fa-close"></i> <?php echo $button_close; ?></button>
		  <button type="button" class="btn btn-primary" id="save_report" title="<?php echo $button_save; ?>" data-loading-text="<?php echo $text_loading; ?>"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
		</div>
      </div>
    </div>
  </div>
</div>     
<div class="modal fade" id="export" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-info">
    <div class="modal-content" id="modal-content">
      <div class="modal-header" style="background-color:#5cb85c;">
        <button type="button" class="close" data-dismiss="modal" style="color:#FFF;"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
        <h4 class="modal-title" style="color:#FFF;"><?php echo $button_export; ?></h4>
      </div>
      <div class="modal-body">
      <fieldset>
        <legend><?php echo $text_export_options; ?></legend> 
		<div class="row" style="padding:2px;">
			<div class="col-sm-6" style="padding-bottom:15px;"><div id="report_to_export">
				<label for="report_type" class="control-label"><span data-toggle="tooltip" title="<?php echo $help_report_type; ?>"><?php echo $text_report_type; ?></span></label>
				<select id="report_type" name="report_type" data-style="btn-select" class="form-control select">
                	<?php foreach ($report_types as $report_type) { ?>                  
					<?php if ($report_type == $report_type['type']) { ?>
                    <option data-icon="<?php echo $report_type['icon']; ?>" value="<?php echo $report_type['type']; ?>" title="<?php echo $report_type['name']; ?>" selected="selected"><?php echo $report_type['name']; ?></option>
					<?php } else { ?>
					<option data-icon="<?php echo $report_type['icon']; ?>" value="<?php echo $report_type['type']; ?>" title="<?php echo $report_type['name']; ?>"><?php echo $report_type['name']; ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div></div>
			<div class="col-sm-6" style="padding-bottom:15px;"><div id="type_to_export" class="required">
				<label for="export_type" class="control-label"><?php echo $text_export_type; ?></label>
				<select id="export_type" name="export_type" data-style="btn-select" class="form-control select" title="<?php echo $text_select_export_type; ?>">
                	<option value=""></option>
                	<?php foreach ($export_types as $export_type) { ?>                
					<?php if ($export_type == $export_type['type']) { ?>
                    <option data-icon="<?php echo $export_type['icon']; ?>" value="<?php echo $export_type['type']; ?>" title="<?php echo $export_type['name']; ?>" selected="selected"><?php echo $export_type['name']; ?></option>
					<?php } else { ?>
					<option data-icon="<?php echo $export_type['icon']; ?>" value="<?php echo $export_type['type']; ?>" title="<?php echo $export_type['name']; ?>"><?php echo $export_type['name']; ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div></div>            
		</div> 
		<div class="row" style="padding:2px; padding-bottom:20px;">              
			<div class="col-sm-6" style="z-index:5;"><div class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:80%; text-align:left;"><?php echo $text_export_logo_criteria; ?></span>
				<select name="export_logo_criteria" data-style="btn-select" data-width="20%" class="select">
    				<?php if ($export_logo_criteria) { ?>
					<option value="1" title="<?php echo $text_yes; ?>" selected="selected"><?php echo $text_yes; ?></option>
					<option value="0" title="<?php echo $text_no; ?>"><?php echo $text_no; ?></option>
					<?php } else { ?>
					<option value="1" title="<?php echo $text_yes; ?>"><?php echo $text_yes; ?></option>
					<option value="0" title="<?php echo $text_no; ?>" selected="selected"><?php echo $text_no; ?></option>
					<?php } ?>
				</select>
			</div></div>
			<div class="col-sm-6"><div id="csv_delimiter" class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:55%; text-align:left;"><?php echo $text_export_csv_delimiter; ?></span>
				<select id="export_csv_delimiter" name="export_csv_delimiter" data-style="btn-select" data-width="45%" class="select">
                	<?php foreach ($export_csv_delimiters as $export_csv_delimiter) { ?>                
					<?php if ($export_csv_delimiter == $export_csv_delimiter['type']) { ?>
                    <option value="<?php echo $export_csv_delimiter['type']; ?>" title="<?php echo $export_csv_delimiter['name']; ?>" selected="selected"><?php echo $export_csv_delimiter['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $export_csv_delimiter['type']; ?>" title="<?php echo $export_csv_delimiter['name']; ?>"><?php echo $export_csv_delimiter['name']; ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div></div>
		</div>
        <div class="text-danger">* <?php echo $text_export_notice1; ?> <a href="http://www.opencartreports.com/documentation/pp/index.html#req_limit" target="_blank"><strong><?php echo $text_export_limit; ?></strong></a> <?php echo $text_export_notice2; ?></div>      
		</fieldset>
        <div align="right">
		  <button type="button" class="btn btn-default" title="<?php echo $button_close; ?>" data-dismiss="modal"><i class="fa fa-close"></i> <?php echo $button_close; ?></button>
		  <button type="button" id="export_report" class="btn btn-primary" title="<?php echo $button_export; ?>" data-loading-text="<?php echo $text_loading; ?>"><i class="fa fa-save"></i> <?php echo $button_export; ?></button>
		</div>
      </div>
    </div>
  </div>
</div>               
<div class="modal fade" id="settings" data-backdrop="static" data-keyboard="false" style="z-index:9999;">
  <div class="modal-dialog modal-lg modal-info">
    <div class="modal-content" id="modal-content">
      <div class="modal-header" style="background-color:#777;">
        <button type="button" class="close" data-dismiss="modal" style="color:#FFF;"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
        <h4 class="modal-title" style="color:#FFF;"><?php echo $text_report_settings; ?></h4>
      </div>
      <div class="modal-body">
      <fieldset>
		<legend><?php echo $text_local_settings; ?></legend> 
		<div class="row" style="padding:2px; padding-bottom:20px;">
			<div class="col-lg-4"><div class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:45%; text-align:left;"><?php echo $text_format_date; ?></span>
				<select name="advpp<?php echo $user; ?>_date_format" data-style="btn-select" data-width="55%" class="select">
					<?php if ($advpp_date_format == 'DDMMYYYY') { ?>
					<option value="DDMMYYYY" selected="selected"><?php echo $text_format_date_eu; ?></option>
					<option value="MMDDYYYY"><?php echo $text_format_date_us; ?></option>
					<?php } else { ?>
					<option value="DDMMYYYY"><?php echo $text_format_date_eu; ?></option>
					<option value="MMDDYYYY" selected="selected"><?php echo $text_format_date_us; ?></option>
					<?php } ?>
				</select>
			</div></div>
			<div class="col-lg-4"><div class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:45%; text-align:left;"><?php echo $text_format_hour; ?></span>
				<select name="advpp<?php echo $user; ?>_hour_format" data-style="btn-select" data-width="55%" class="select">
					<?php if ($advpp_hour_format == '24') { ?>
					<option value="24" selected="selected"><?php echo $text_format_hour_24; ?></option>
					<option value="12"><?php echo $text_format_hour_12; ?></option>
					<?php } else { ?>
					<option value="24"><?php echo $text_format_hour_24; ?></option>
					<option value="12" selected="selected"><?php echo $text_format_hour_12; ?></option>
					<?php } ?>
				</select>
			</div></div>            
			<div class="col-lg-4"><div class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:45%; text-align:left;"><?php echo $text_format_week; ?></span>
				<select name="advpp<?php echo $user; ?>_week_days" data-style="btn-select" data-width="55%" class="select">
					<?php if ($advpp_week_days == 'mon_sun') { ?>
					<option value="mon_sun" selected="selected"><?php echo $text_format_week_mon_sun; ?></option>
					<option value="sun_sat"><?php echo $text_format_week_sun_sat; ?></option>
					<?php } else { ?>
					<option value="mon_sun"><?php echo $text_format_week_mon_sun; ?></option>
					<option value="sun_sat" selected="selected"><?php echo $text_format_week_sun_sat; ?></option>
					<?php } ?>
				</select>
			</div></div>
		</div>        
    	<legend><?php echo $text_filtering_options; ?></legend>
<?php if ($filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_abandoned_orders' or $filter_report == 'products_options' or $filter_report == 'manufacturers' or $filter_report == 'categories') { ?>           
		<div id="checkbox_filter" class="row">
			<div class="col-sm-12">
				<div class="well well-sm" style="background:#f5f5f5; height:295px; overflow:auto;">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_filter').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_filter').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="filters_null" name="advpp<?php echo $user; ?>_settings_filters[]" checked="checked"/>                 
					<?php foreach ($filters as $key => $filter) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_filters)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_filters[]" checked="checked"/> <?php echo $filter; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_filters[]" /> <?php echo $filter; ?>
                        <?php } ?>
						</label>
						</div>
					<?php } ?>
				</div>										
			</div>
		</div>
<?php } ?>         
<?php if ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders' or $filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>
		<div id="checkbox_filter_scw_pnp_alp" class="row">
			<div class="col-sm-12">
				<div class="well well-sm" style="background:#f5f5f5; height:155px; overflow:auto;">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_filter_scw_pnp_alp').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_filter_scw_pnp_alp').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="filters_null" name="advpp<?php echo $user; ?>_settings_filters[]" checked="checked"/>                 
					<?php foreach ($filters_scw_pnp_alp as $key => $filter_scw_pnp_alp) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_filters)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_filters[]" checked="checked"/> <?php echo $filter_scw_pnp_alp; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_filters[]" /> <?php echo $filter_scw_pnp_alp; ?>
                        <?php } ?>
						</label>
						</div>
					<?php } ?>
				</div>										
			</div>
		</div>
					<?php foreach ($filters_fill as $key => $filter_fill) { ?>
                        <?php if (in_array($key, $advpp_settings_filters)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_filters[]" checked="checked"/>
                        <?php } ?>
                    <?php } ?>
<?php } ?>
<?php if ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_abandoned_orders') { ?>   
		<legend><?php echo $text_column_settings; ?> <span style="color:#390; font-size:small;"> [<?php echo $text_export_note; ?>]</span></legend>  
		<div id="checkbox_mv_column" class="row">
			<div class="col-sm-12">
<?php if ($filter_report != 'all_products_with_without_orders') { ?>            
               	<label class="control-label"><i class="fa fa-columns"></i> <?php echo $text_mv_columns; ?></label>
<?php } ?>                
				<div class="well well-sm" style="background:#f5f5f5; height:230px; overflow:auto;">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_mv_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_mv_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="mv_null" name="advpp<?php echo $user; ?>_settings_mv_columns[]" checked="checked"/>                 
					<?php foreach ($mv_columns as $key => $mv_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_mv_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_mv_columns[]" checked="checked"/> <?php echo $mv_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_mv_columns[]" /> <?php echo $mv_column; ?>
                        <?php } ?>
						</label>
						</div>
                    <?php } ?>
				</div>		               								
			</div>
		</div>
<?php } else { ?>
                    <input type="hidden" value="mv_null" name="advpp<?php echo $user; ?>_settings_mv_columns[]" checked="checked"/> 
					<?php foreach ($mv_columns as $key => $mv_column) { ?>
                        <?php if (in_array($key, $advpp_settings_mv_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_mv_columns[]" checked="checked"/>
                        <?php } ?>
                    <?php } ?>
<?php } ?>
<?php if ($filter_report == 'products_without_orders') { ?>      
		<legend><?php echo $text_column_settings; ?> <span style="color:#390; font-size:small;"> [<?php echo $text_export_note; ?>]</span></legend>  
		<div id="checkbox_pnp_column" class="row">
			<div class="col-sm-12">
				<div class="well well-sm" style="background:#f5f5f5; height:190px; overflow:auto;">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_pnp_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_pnp_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="pnp_null" name="advpp<?php echo $user; ?>_settings_pnp_columns[]" checked="checked"/>                 
					<?php foreach ($pnp_columns as $key => $pnp_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_pnp_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_pnp_columns[]" checked="checked"/> <?php echo $pnp_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_pnp_columns[]" /> <?php echo $pnp_column; ?>
                        <?php } ?>
						</label>
						</div>
                    <?php } ?>
				</div>		               								
			</div>
		</div>
<?php } else { ?>
                    <input type="hidden" value="pnp_null" name="advpp<?php echo $user; ?>_settings_pnp_columns[]" checked="checked"/>                 
					<?php foreach ($pnp_columns as $key => $pnp_column) { ?>
                        <?php if (in_array($key, $advpp_settings_pnp_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_pnp_columns[]" checked="checked"/>
                        <?php } ?>                            
					<?php } ?>                         
<?php } ?>
<?php if ($filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>   
		<legend><?php echo $text_column_settings; ?> <span style="color:#390; font-size:small;"> [<?php echo $text_export_note; ?>]</span></legend>  
		<div id="checkbox_scw_column" class="row">
			<div class="col-sm-12">
				<div class="well well-sm" style="background:#f5f5f5; height:270px; overflow:auto;">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_scw_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_scw_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="scw_null" name="advpp<?php echo $user; ?>_settings_scw_columns[]" checked="checked"/>                 
					<?php foreach ($scw_columns as $key => $scw_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_scw_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_scw_columns[]" checked="checked"/> <?php echo $scw_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_scw_columns[]" /> <?php echo $scw_column; ?>
                        <?php } ?>
						</label>
						</div>
                    <?php } ?>
				</div>		               								
			</div>
		</div>
<?php } else { ?>
                    <input type="hidden" value="scw_null" name="advpp<?php echo $user; ?>_settings_scw_columns[]" checked="checked"/>                 
					<?php foreach ($scw_columns as $key => $scw_column) { ?>
                        <?php if (in_array($key, $advpp_settings_scw_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_scw_columns[]" checked="checked"/>
                        <?php } ?>
					<?php } ?>                         
<?php } ?>
<?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>     
		<legend><?php echo $text_column_settings; ?> <span style="color:#390; font-size:small;"> [<?php echo $text_export_note; ?>]</span></legend>  
		<div id="checkbox_cm_column" class="row">
			<div class="col-sm-12">
            	<label class="control-label"><i class="fa fa-columns"></i> <?php echo $text_mv_columns; ?></label>
				<div class="well well-sm" style="background:#f5f5f5; height:165px; overflow:auto;">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_cm_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_cm_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="cm_null" name="advpp<?php echo $user; ?>_settings_cm_columns[]" checked="checked"/>                 
					<?php foreach ($cm_columns as $key => $cm_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_cm_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_cm_columns[]" checked="checked"/> <?php echo $cm_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_cm_columns[]" /> <?php echo $cm_column; ?>
                        <?php } ?>
						</label>
						</div>
                    <?php } ?>
				</div>		               								
			</div>
		</div>
<?php } else { ?>
                    <input type="hidden" value="cm_null" name="advpp<?php echo $user; ?>_settings_cm_columns[]" checked="checked"/>                 
					<?php foreach ($cm_columns as $key => $cm_column) { ?>
                        <?php if (in_array($key, $advpp_settings_cm_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_cm_columns[]" checked="checked"/>
                        <?php } ?>
					<?php } ?>                         
<?php } ?>
<?php if ($filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_options' or $filter_report == 'manufacturers' or $filter_report == 'categories' or $filter_report == 'products_abandoned_orders') { ?>
		<div class="row">
			<div class="col-sm-12">
               	<label class="control-label"><i class="fa fa-columns"></i> <?php echo $text_bd_columns; ?></label>
				<div class="well well-sm" style="background:#f5f5f5; height:310px; overflow:auto;">
<?php } ?>                
<?php if ($filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_abandoned_orders') { ?>
					<div id="checkbox_ol_column">          
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_ol_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_ol_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="ol_null" name="advpp<?php echo $user; ?>_settings_ol_columns[]" checked="checked"/>                     
					<?php foreach ($ol_columns as $key => $ol_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_ol_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_ol_columns[]" checked="checked"/> <?php echo $ol_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_ol_columns[]" /> <?php echo $ol_column; ?>
                        <?php } ?>
						</label>
						</div>
					<?php } ?>
                    </div>
<?php } else { ?>  
                    <input type="hidden" value="ol_null" name="advpp<?php echo $user; ?>_settings_ol_columns[]" checked="checked"/>                     
					<?php foreach ($ol_columns as $key => $ol_column) { ?>
                        <?php if (in_array($key, $advpp_settings_ol_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_ol_columns[]" checked="checked"/>
                        <?php } ?>
					<?php } ?>                         
<?php } ?>      
<?php if ($filter_report == 'manufacturers' or $filter_report == 'categories' or $filter_report == 'products_options') { ?>
					<div id="checkbox_pl_column">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_pl_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_pl_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="pl_null" name="advpp<?php echo $user; ?>_settings_pl_columns[]" checked="checked"/>                     
					<?php foreach ($pl_columns as $key => $pl_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_pl_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_pl_columns[]" checked="checked"/> <?php echo $pl_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_pl_columns[]" /> <?php echo $pl_column; ?>
                        <?php } ?>
						</label>
						</div>
					<?php } ?> 
                    </div> 
<?php } else { ?>  
                    <input type="hidden" value="pl_null" name="advpp<?php echo $user; ?>_settings_pl_columns[]" checked="checked"/>                     
					<?php foreach ($pl_columns as $key => $pl_column) { ?>
                        <?php if (in_array($key, $advpp_settings_pl_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_pl_columns[]" checked="checked"/>
                        <?php } ?>
					<?php } ?>                         
<?php } ?>      
<?php if ($filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_options' or $filter_report == 'manufacturers' or $filter_report == 'categories' or $filter_report == 'products_abandoned_orders') { ?>
					<div id="checkbox_cl_column">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_cl_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_cl_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="cl_null" name="advpp<?php echo $user; ?>_settings_cl_columns[]" checked="checked"/>                    
					<?php foreach ($cl_columns as $key => $cl_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_cl_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_cl_columns[]" checked="checked"/> <?php echo $cl_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_cl_columns[]" /> <?php echo $cl_column; ?>
                        <?php } ?>
						</label>
						</div>
					<?php } ?> 
                    </div>
<?php } else { ?>  
                    <input type="hidden" value="cl_null" name="advpp<?php echo $user; ?>_settings_cl_columns[]" checked="checked"/>                    
					<?php foreach ($cl_columns as $key => $cl_column) { ?>
                        <?php if (in_array($key, $advpp_settings_cl_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_cl_columns[]" checked="checked"/>
                        <?php } ?>
					<?php } ?> 
<?php } ?>  
<?php if ($filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_options' or $filter_report == 'manufacturers' or $filter_report == 'categories' or $filter_report == 'products_abandoned_orders') { ?>                                
				</div>		               								
			</div>
		</div> 
<?php } ?>         
<?php if ($filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_options' or $filter_report == 'manufacturers' or $filter_report == 'categories' or $filter_report == 'products_abandoned_orders') { ?>      
		<div id="checkbox_all_column" class="row">
			<div class="col-sm-12">
               	<label class="control-label"><i class="fa fa-columns"></i> <?php echo $text_all_columns; ?></label>
				<div class="well well-sm" style="background:#f5f5f5; height:510px; overflow:auto;">
                	<div class="col-sm-12" align="right" style="margin-top:10px;">
                    <a class="btn btn-info btn-xs" onclick="$('#checkbox_all_column').find(':checkbox').prop('checked', true);"><?php echo $text_check_all; ?></a>&nbsp;<a class="btn btn-info btn-xs" onclick="$('#checkbox_all_column').find(':checkbox').prop('checked', false);"><?php echo $text_uncheck_all; ?></a>
                    </div>   
                    <input type="hidden" value="all_null" name="advpp<?php echo $user; ?>_settings_all_columns[]" checked="checked"/>                 
					<?php foreach ($all_columns as $key => $all_column) { ?>
						<div class="checkbox col-md-3">
						<label>
                        <?php if (in_array($key, $advpp_settings_all_columns)) { ?>
                        	<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_all_columns[]" checked="checked"/> <?php echo $all_column; ?>
                        <?php } else { ?>
							<input type="checkbox" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_all_columns[]" /> <?php echo $all_column; ?>
                        <?php } ?>
						</label>
						</div>
					<?php } ?>
				</div>		               								
			</div>
		</div>
<?php } else { ?>  
                    <input type="hidden" value="all_null" name="advpp<?php echo $user; ?>_settings_all_columns[]" checked="checked"/>                 
					<?php foreach ($all_columns as $key => $all_column) { ?>
                        <?php if (in_array($key, $advpp_settings_all_columns)) { ?>
                        	<input type="hidden" value="<?php echo $key; ?>" name="advpp<?php echo $user; ?>_settings_all_columns[]" checked="checked"/>
                        <?php } ?>
					<?php } ?>
<?php } ?>         
		</fieldset>
        <div align="right">
		  <button type="button" class="btn btn-default" title="<?php echo $button_close; ?>" data-dismiss="modal"><i class="fa fa-close"></i> <?php echo $button_close; ?></button>
		  <button type="button" class="btn btn-primary" id="save_settings" title="<?php echo $button_save; ?>" data-loading-text="<?php echo $text_loading; ?>"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
		</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="cron" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-info">
    <div class="modal-content" id="modal-content">
      <div class="modal-header" style="background-color:#777;">
        <button type="button" class="close" data-dismiss="modal" style="color:#FFF;"><span aria-hidden="true">&times;</span><span class="sr-only"><?php echo $button_close; ?></span></button>
        <h4 class="modal-title" style="color:#FFF;"><?php echo $text_cron_settings; ?></h4>
      </div>
      <div class="modal-body">
      <div align="justify"><?php echo $text_cron; ?></div><br />      
      <fieldset>
        <legend><?php echo $text_cron_1; ?></legend> 
        <div><?php echo $text_cron_1_text; ?></div><br />     
        <legend><?php echo $text_cron_2; ?></legend> 
		<div class="row" style="padding:2px;">
			<div class="col-sm-6" style="padding-bottom:15px;"><div id="cron_report_to_export">
                <label for="cron_report_type" class="control-label"><span data-toggle="tooltip" title="<?php echo $help_report_type; ?>"><?php echo $text_report_type; ?></span></label>
				<select name="cron_report_type" id="cron_report_type" data-style="btn-select" class="form-control select">
                	<?php foreach ($report_types as $report_type) { ?>                  
					<?php if ($report_type == $report_type['type']) { ?>
                    <option data-icon="<?php echo $report_type['icon']; ?>" value="<?php echo $report_type['type']; ?>" title="<?php echo $report_type['name']; ?>" selected="selected"><?php echo $report_type['name']; ?></option>
					<?php } else { ?>
					<option data-icon="<?php echo $report_type['icon']; ?>" value="<?php echo $report_type['type']; ?>" title="<?php echo $report_type['name']; ?>"><?php echo $report_type['name']; ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div></div>
			<div class="col-sm-6" style="padding-bottom:15px;"><div id="cron_type_to_export">
				<label for="cron_export_type" class="control-label"><?php echo $text_export_type; ?></label>
				<select name="cron_export_type" id="cron_export_type" data-style="btn-select" class="form-control select" title="<?php echo $text_select_export_type; ?>">
                	<option value=""></option>
                	<?php foreach ($export_types as $export_type) { ?>                
					<?php if ($export_type == $export_type['type']) { ?>
                    <option data-icon="<?php echo $export_type['icon']; ?>" value="<?php echo $export_type['type']; ?>" title="<?php echo $export_type['name']; ?>" selected="selected"><?php echo $export_type['name']; ?></option>
					<?php } else { ?>
					<option data-icon="<?php echo $export_type['icon']; ?>" value="<?php echo $export_type['type']; ?>" title="<?php echo $export_type['name']; ?>"><?php echo $export_type['name']; ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div></div>            
		</div> 
		<div class="row" style="padding:2px; padding-bottom:20px;">              
			<div class="col-sm-6" style="z-index:5;"><div class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:80%; text-align:left;"><?php echo $text_export_logo_criteria; ?></span>
				<select name="cron_export_logo_criteria" id="cron_export_logo_criteria" data-style="btn-select" data-width="20%" class="select">
    				<?php if ($export_logo_criteria == '1') { ?>
					<option value="1" title="<?php echo $text_yes; ?>" selected="selected"><?php echo $text_yes; ?></option>
					<option value="0" title="<?php echo $text_no; ?>"><?php echo $text_no; ?></option>
					<?php } else { ?>
					<option value="1" title="<?php echo $text_yes; ?>"><?php echo $text_yes; ?></option>
					<option value="0" title="<?php echo $text_no; ?>" selected="selected"><?php echo $text_no; ?></option>
					<?php } ?>
				</select>
			</div></div>
			<div class="col-sm-6"><div id="cron_csv_delimiter" class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:55%; text-align:left;"><?php echo $text_export_csv_delimiter; ?></span>
				<select name="cron_export_csv_delimiter" id="cron_export_csv_delimiter" data-style="btn-select" data-width="45%" class="select">
                	<?php foreach ($export_csv_delimiters as $export_csv_delimiter) { ?>                
					<?php if ($export_csv_delimiter == $export_csv_delimiter['type']) { ?>
                    <option value="<?php echo $export_csv_delimiter['type']; ?>" title="<?php echo $export_csv_delimiter['name']; ?>" selected="selected"><?php echo $export_csv_delimiter['name']; ?></option>
					<?php } else { ?>
					<option value="<?php echo $export_csv_delimiter['type']; ?>" title="<?php echo $export_csv_delimiter['name']; ?>"><?php echo $export_csv_delimiter['name']; ?></option>
					<?php } ?>
					<?php } ?>
				</select>
			</div></div>
		</div>																								 
       <legend><?php echo $text_cron_3; ?></legend> 
		<div class="row" style="padding:2px;">
			<div class="col-sm-12"><div class="input-group" style="width:100%;">
				<span class="input-group-addon" style="width:65%; white-space:normal; text-align:left;"><?php echo $text_cron_3_text; ?></span>
				<select name="cron_export_file" id="cron_export_file" data-style="btn-select" data-width="35%" class="select">
					<?php if ($cron_export_file == 'send_to_email') { ?>
					<option id="send_to_email" value="send_to_email" selected="selected"><?php echo $text_cron_3_option1; ?></option>
					<option id="save_on_server" value="save_on_server"><?php echo $text_cron_3_option2; ?></option>
					<?php } else { ?>
					<option id="send_to_email" value="send_to_email"><?php echo $text_cron_3_option1; ?></option>
					<option id="save_on_server" value="save_on_server" selected="selected"><?php echo $text_cron_3_option2; ?></option>
					<?php } ?>
				</select>
			</div></div>
		</div>   
		<div class="row" style="padding:2px; padding-top:10px;">
			<div class="col-sm-3" style="padding-bottom:15px;">
				<label for="cron_email" class="control-label"><span data-toggle="tooltip" data-original-title="<?php echo $help_cron_email ;?>"><?php echo $text_cron_email; ?></span></label>            
				<input type="text" name="cron_email" id="cron_email" placeholder="<?php echo $text_cron_email; ?>" class="form-control" value="" />	
			</div>
			<div class="col-sm-3" style="padding-bottom:15px;">
				<label for="cron_file_name" class="control-label"><span data-toggle="tooltip" data-original-title="<?php echo $help_cron_file_name ;?>"><?php echo $text_cron_file_name; ?></span></label>            
				<input type="text" name="cron_file_name" id="cron_file_name" placeholder="<?php echo $text_cron_file_name; ?>" class="form-control" value="" />	
			</div>     
			<div class="col-sm-6" style="padding-bottom:15px;">
				<label for="cron_file_save_path" class="control-label"><span data-toggle="tooltip" data-original-title="<?php echo $help_save_path ;?>"><?php echo $text_save_path; ?></span></label> <span><?php echo $root_dir; ?></span>
                <div class="input-group" style="width:100%;">
				<input type="text" name="cron_file_save_path" id="cron_file_save_path" class="form-control" data-width="95%" value="" /><span class="input-group-addon" style="width:5%;"><?php echo $dir_sep; ?></span>
				</div>
			</div>         
		</div>  
        <legend><?php echo $text_cron_4; ?></legend>   
		<div class="row" style="padding:2px;">
			<div class="col-sm-3" style="padding-bottom:20px;">
				<label for="cron_user" class="control-label"><span data-toggle="tooltip" data-original-title="<?php echo $help_cron_user ;?>"><?php echo $text_cron_user; ?></span></label>            
				<input type="text" name="cron_user" id="cron_user" placeholder="<?php echo $text_cron_user; ?>" class="form-control" value="" />	
			</div>
			<div class="col-sm-3" style="padding-bottom:20px;">
				<label for="cron_pass" class="control-label"><span data-toggle="tooltip" data-original-title="<?php echo $help_cron_pass ;?>"><?php echo $text_cron_pass; ?></span></label>            
				<input type="password" name="cron_pass" id="cron_pass" placeholder="<?php echo $text_cron_pass; ?>" class="form-control" value="" />	
			</div>    
			<div class="col-sm-6" style="padding-bottom:20px;">
              <div class="input-group">
				<label for="cron_token" class="control-label"><span data-toggle="tooltip" data-original-title="<?php echo $help_cron_token ;?>"><?php echo $text_cron_token; ?></span></label>            
				<input type="text" name="cron_token" id="cron_token" placeholder="<?php echo $text_cron_token; ?>" class="form-control" value="" readonly />
				<span class="input-group-btn" style="padding-top:23px;"><button class="btn btn-primary" type="button" id="token_generate" onclick="addCron(); cron_token_gen(); cron_id_gen(); cron_command(); document.getElementById('token_generate').disabled = true;"><?php echo $text_token_generate; ?></button></span>
              </div>
			</div>               
		</div>    
        <legend><?php echo $text_cron_5; ?></legend> 
        <div align="justify"><?php echo $text_cpanel_setting; ?></div>
		<div class="row" style="padding:2px;">
			<div class="col-sm-12" style="padding-bottom:10px;">
				<label for="cpanel" class="control-label"><?php echo $text_cron_command; ?></label>            
				<div id="cpanel" onclick="selectText('cpanel')" style="border:1px solid #CCC; background-color:#EEE; padding:3px;"><span style="font-size:smaller;"><?php echo $text_cron_command_empty; ?></span></div>	
			</div>             
		</div> 
        <div><?php echo $text_cpanel_setting_note; ?></div><br />
        <legend><?php echo $text_cron_6; ?></legend> 
        <table width="100%" id="adv_cron_setting" class="table table-bordered table-hover">
          <thead>
            <tr>
              <td width="45%" class="text-left"><?php echo $entry_cron_title; ?></td>
              <td width="45%" class="text-left"><?php echo $entry_cron_command; ?></td>              
              <td width="10%"></td>
            </tr>
          </thead>                         
          <?php if ($advpp_cron_settings) { ?>
		   <?php $adv_cron_settings_row = 0; ?>
			<?php foreach ($advpp_cron_settings as $advpp_cron_setting) { ?>
			  <tbody id="adv_cron_settings_row<?php echo $adv_cron_settings_row; ?>">
				<tr>                
				  <td width="45%" class="text-left">
            	  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_id]" value="<?php echo $advpp_cron_setting['cron_id']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_report_type]" value="<?php echo $advpp_cron_setting['cron_report_type']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_export_type]" value="<?php echo $advpp_cron_setting['cron_export_type']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_export_logo_criteria]" value="<?php echo $advpp_cron_setting['cron_export_logo_criteria']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_export_csv_delimiter]" value="<?php echo $advpp_cron_setting['cron_export_csv_delimiter']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_export_file]" value="<?php echo $advpp_cron_setting['cron_export_file']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_file_save_path]" value="<?php echo $advpp_cron_setting['cron_file_save_path']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_file_name]" value="<?php echo $advpp_cron_setting['cron_file_name']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_email]" value="<?php echo $advpp_cron_setting['cron_email']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_user]" value="<?php echo $advpp_cron_setting['cron_user']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_pass]" value="<?php echo $advpp_cron_setting['cron_pass']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_token]" value="<?php echo $advpp_cron_setting['cron_token']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_user_id]" value="<?php echo $advpp_cron_setting['cron_user_id']; ?>" />
                  
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_report]" value="<?php echo $advpp_cron_setting['cron_filter_report']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_details]" value="<?php echo $advpp_cron_setting['cron_filter_details']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_group]" value="<?php echo $advpp_cron_setting['cron_filter_group']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_sort]" value="<?php echo $advpp_cron_setting['cron_filter_sort']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_order]" value="<?php echo $advpp_cron_setting['cron_filter_order']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_limit]" value="<?php echo $advpp_cron_setting['cron_filter_limit']; ?>" />
                  
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_range]" value="<?php echo $advpp_cron_setting['cron_filter_range']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_date_start]" value="<?php echo $advpp_cron_setting['cron_date_start']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_date_end]" value="<?php echo $advpp_cron_setting['cron_date_end']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_order_status_id]" value="<?php echo $advpp_cron_setting['cron_filter_order_status_id']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_status_date_start]" value="<?php echo $advpp_cron_setting['cron_status_date_start']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_status_date_end]" value="<?php echo $advpp_cron_setting['cron_status_date_end']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_order_id_from]" value="<?php echo $advpp_cron_setting['cron_filter_order_id_from']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_order_id_to]" value="<?php echo $advpp_cron_setting['cron_filter_order_id_to']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_prod_price_min]" value="<?php echo $advpp_cron_setting['cron_filter_prod_price_min']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_prod_price_max]" value="<?php echo $advpp_cron_setting['cron_filter_prod_price_max']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_store_id]" value="<?php echo $advpp_cron_setting['cron_filter_store_id']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_currency]" value="<?php echo $advpp_cron_setting['cron_filter_currency']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_taxes]" value="<?php echo $advpp_cron_setting['cron_filter_taxes']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_tax_classes]" value="<?php echo $advpp_cron_setting['cron_filter_tax_classes']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_geo_zones]" value="<?php echo $advpp_cron_setting['cron_filter_geo_zones']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_customer_group_id]" value="<?php echo $advpp_cron_setting['cron_filter_customer_group_id']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_customer_name]" value="<?php echo $advpp_cron_setting['cron_filter_customer_name']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_customer_email]" value="<?php echo $advpp_cron_setting['cron_filter_customer_email']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_customer_telephone]" value="<?php echo $advpp_cron_setting['cron_filter_customer_telephone']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_ip]" value="<?php echo $advpp_cron_setting['cron_filter_ip']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_payment_company]" value="<?php echo $advpp_cron_setting['cron_filter_payment_company']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_payment_address]" value="<?php echo $advpp_cron_setting['cron_filter_payment_address']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_payment_city]" value="<?php echo $advpp_cron_setting['cron_filter_payment_city']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_payment_zone]" value="<?php echo $advpp_cron_setting['cron_filter_payment_zone']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_payment_postcode]" value="<?php echo $advpp_cron_setting['cron_filter_payment_postcode']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_payment_country]" value="<?php echo $advpp_cron_setting['cron_filter_payment_country']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_payment_method]" value="<?php echo $advpp_cron_setting['cron_filter_payment_method']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_shipping_company]" value="<?php echo $advpp_cron_setting['cron_filter_shipping_company']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_shipping_address]" value="<?php echo $advpp_cron_setting['cron_filter_shipping_address']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_shipping_city]" value="<?php echo $advpp_cron_setting['cron_filter_shipping_city']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_shipping_zone]" value="<?php echo $advpp_cron_setting['cron_filter_shipping_zone']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_shipping_postcode]" value="<?php echo $advpp_cron_setting['cron_filter_shipping_postcode']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_shipping_country]" value="<?php echo $advpp_cron_setting['cron_filter_shipping_country']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_shipping_method]" value="<?php echo $advpp_cron_setting['cron_filter_shipping_method']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_category]" value="<?php echo $advpp_cron_setting['cron_filter_category']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_manufacturer]" value="<?php echo $advpp_cron_setting['cron_filter_manufacturer']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_sku]" value="<?php echo $advpp_cron_setting['cron_filter_sku']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_upc]" value="<?php echo $advpp_cron_setting['cron_filter_upc']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_ean]" value="<?php echo $advpp_cron_setting['cron_filter_ean']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_jan]" value="<?php echo $advpp_cron_setting['cron_filter_jan']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_isbn]" value="<?php echo $advpp_cron_setting['cron_filter_isbn']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_mpn]" value="<?php echo $advpp_cron_setting['cron_filter_mpn']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_product_name]" value="<?php echo $advpp_cron_setting['cron_filter_product_name']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_model]" value="<?php echo $advpp_cron_setting['cron_filter_model']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_option]" value="<?php echo $advpp_cron_setting['cron_filter_option']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_attribute]" value="<?php echo $advpp_cron_setting['cron_filter_attribute']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_product_status]" value="<?php echo $advpp_cron_setting['cron_filter_product_status']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_location]" value="<?php echo $advpp_cron_setting['cron_filter_location']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_coupon_name]" value="<?php echo $advpp_cron_setting['cron_filter_coupon_name']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_coupon_code]" value="<?php echo $advpp_cron_setting['cron_filter_coupon_code']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_voucher_code]" value="<?php echo $advpp_cron_setting['cron_filter_voucher_code']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_campaign_name]" value="<?php echo $advpp_cron_setting['cron_filter_campaign_name']; ?>" />
                  <input type="hidden" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_filter_campaign_code]" value="<?php echo $advpp_cron_setting['cron_filter_campaign_code']; ?>" />
		  
                  <input type="text" name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_title]" value="<?php echo $advpp_cron_setting['cron_title']; ?>" placeholder="<?php echo $text_cron_title; ?>" class="form-control" /></td>
				  <td width="45%" class="text-left"><textarea readonly name="advpp_cron_setting[<?php echo $adv_cron_settings_row; ?>][cron_command]" class="form-control"><?php echo $advpp_cron_setting['cron_command']; ?></textarea></td>    
				  <td width="10%" class="text-center"><button type="button" onclick="$('#adv_cron_settings_row<?php echo $adv_cron_settings_row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>                   
				</tr>
			  </tbody>
            <?php $adv_cron_settings_row++; ?>
  		    <?php } ?>
          <?php } else { ?>
		     <?php $adv_cron_settings_row = 0; ?>
		  <?php } ?>
		  <tfoot>
          </tfoot>          
        </table>        
        <div><?php echo $text_save_cron; ?></div> 
        <input type="hidden" name="cron_user_id" id="cron_user_id" value="<?php echo $cron_user_id ?>" />                  
	  </fieldset>
	  <div align="right" style="padding-top:10px;">
		<button type="button" class="btn btn-default" title="<?php echo $button_close; ?>" data-dismiss="modal"><i class="fa fa-close"></i> <?php echo $button_close; ?></button>
		<button type="button" class="btn btn-primary" id="save_cron" title="<?php echo $button_save; ?>" data-loading-text="<?php echo $text_loading; ?>"><i class="fa fa-save"></i> <?php echo $button_save; ?></button>
      </div>
      </div>
    </div>
  </div>
</div>  
<?php if ($products) { ?>
<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_options' && $filter_report != 'products_abandoned_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists' && $filter_details != 'all_details_products' && $filter_details != 'all_details_orders' && $filter_group == 'no_group' && $filter_limit != '999999') { ?>
<div class="col-sm-12" align="right" style="margin-bottom:10px;display:none">
<a class="btn btn-danger btn-xs chart-button"><i class="fa fa-area-chart"></i> <span class="chart_button"><?php echo $button_chart; ?></span></a>
</div> 
<?php } ?>
<div id="charts"  class="chart-switcher <?php echo (isset($_COOKIE['show-pp-chart']) && $_COOKIE['show-pp-chart'] == 1) ? '' : 'hide-chart'; ?>" style="margin-bottom:15px;">  
	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_options' && $filter_report != 'products_abandoned_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists' && $filter_details != 'all_details_products' && $filter_details != 'all_details_orders' && $filter_group == 'no_group' && $filter_limit != '999999') { ?>       
		<script type="text/javascript"><!--
		$(document).ready(function() {
  $(function() {  
			var data1 = [
				<?php 
				$d = 0;
				if ($filter_report == 'products_purchased_without_options' || $filter_report == 'products_purchased_with_options' || $filter_report == 'new_products_purchased' || $filter_report == 'old_products_purchased') {					
					foreach ($products as $product) {
					if ($filter_report == 'products_purchased_with_options') {
					if ($product['option']) {
		  			echo '{ label: " <strong>'.$product['gname'].'</strong><small><br /></small>';
					foreach ($product['option'] as $option) {
					echo '<small> &#9679; '.$option['name'].': '.$option['value'].'</small>';
					}
					echo '",  data: '.$product['gsold'].' },';
					} else {
					echo '{ label: " <strong>'.$product['gname'].'</strong>",  data: '.$product['gsold'].' },';
					}
					} else {
					echo '{ label: " '.$product['gname'].'",  data: '.$product['gsold'].' },';
					}
					if (++$d > 9) break;
					}
				} elseif ($filter_report == 'manufacturers') {
					foreach ($products as $product) {
					echo '{ label: " '.$product['gmanufacturer'].'",  data: '.$product['gsold'].' },';
					if (++$d > 9) break;
					}
				} elseif ($filter_report == 'categories') {
					foreach ($products as $product) {
					echo '{ label: " '.$product['gcategories'].'",  data: '.$product['gsold'].' },';
					if (++$d > 9) break;
					}
				}
				;?>
			];

			var rawd2 = [
				<?php 
				$s = 0;
				$r = 0;
				foreach ($products as $product) {
				echo '['.$product['gtotal'].', '.$r++.'], ';
				if (++$s > 9) break;
				}
				;?>
			];

			var data2 = [
				{ label: '<?php echo $column_gtotal; ?>', data: rawd2, color: "#b5e08b" }
			];

			var ticks = [
				<?php 
				$i = 0;
				$t = 0;
				if ($filter_report == 'products_purchased_without_options' || $filter_report == 'products_purchased_with_options' || $filter_report == 'new_products_purchased' || $filter_report == 'old_products_purchased') {					
					foreach ($products as $product) {
					if ($filter_report == 'products_purchased_with_options') {
					if ($product['option']) {
		  			echo '['.$t++.', "<strong>'.$product['gname'].'</strong><small><br /></small>';
					foreach ($product['option'] as $option) {
					echo '<small> &#9679; '.$option['name'].': '.$option['value'].'</small>';
					}
					echo '"], ';
					} else {
					echo '['.$t++.', "<strong>'.$product['gname'].'</strong>"], ';
					}
					} else {
					echo '['.$t++.', "'.$product['gname'].'"], ';
					}
					if (++$i > 9) break;
					}
				} elseif ($filter_report == 'manufacturers') {
					foreach ($products as $product) {
					echo '['.$t++.', "'.$product['gmanufacturer'].'"], ';
					if (++$i > 9) break;
					}
				} elseif ($filter_report == 'categories') {
					foreach ($products as $product) {
					echo '['.$t++.', "'.$product['gcategories'].'"], ';
					if (++$i > 9) break;
					}
				}
				;?>
			];
			
			var option1 = {	
    			series: {
        			pie: {
            			show: true,
            			radius: 1,
            			label: {
                			show: true,
                			radius: 1,
                			formatter: function(label, series) {
                    			return '<div style="font-size:11px; text-align:left; padding:2px; color:white;">'+series.label+'<br /><strong><?php echo $column_sold_quantity; ?>: '+series.data[0][1]+'</strong></div>';
                			},
                			background: {
                    			opacity: 0.8
                			}
            			}
        			}
    			},
        		grid: {
            		hoverable: true
        		},
    			legend: {
        			show: false
			    }
			}

			var option2 = {	
            	series: {
	                bars: {
						show: true
					}
    	        },
            	bars: {
                	align: "center",
	                barWidth: 0.6,
    	            horizontal: true,
        	        lineWidth: 1.5
            	},
	            yaxis: {
            	    ticks: ticks,
					transform: function (v) { return -v; },  
        			inverseTransform: function (v) { return -v; }  
				},
				grid: {
					backgroundColor: '#FFFFFF',
					borderWidth: 1,
					hoverable: true
				}	
			}
			
			$.plot('#chart1', data1, option1);
			$("#chart1").bind("plothover", pieHover);
			
			$.plot('#chart2', data2, option2);	
			$('#chart2').bind('plothover', function(event, pos, item) {
				$('.tooltip').remove();
			  
				if (item) {
					$('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">'+item.series.label+': <b>' + item.datapoint[0].toFixed(2) + '</b></div></div>').prependTo('body');
					
					$('#tooltip').css({
						position: 'absolute',
						left: item.pageX - ($('#tooltip').outerWidth() / 2),
						top: item.pageY - $('#tooltip').outerHeight(),
						pointer: 'cusror'
					}).fadeIn('slow');	
					
					$('#chart2').css('cursor', 'pointer');		
			  	} else {
					$('#chart2').css('cursor', 'auto');
				}
			});
  });
	
  function pieHover(event, pos, obj) {
    if (!obj)
        return;
 
    $("#pieHover").html('<span style="font-size:11px; color:'+obj.series.color+'">'+obj.series.label+'<br /><strong><?php echo $column_sold_quantity; ?>: '+obj.series.data[0][1]+'</strong></span>');
  }
});
//--></script> 
    <div class="row">
	<div align="center" style="display:none"><strong>
    <?php if ($filter_report != 'manufacturers' && $filter_report != 'categories') { ?> 
    Top Sold Products
    <?php } elseif ($filter_report == 'manufacturers') { ?>
    Top Manufacturers
    <?php } elseif ($filter_report == 'categories') { ?>
    Top Categories
    <?php } ?>
    </strong></div>
      <div class="col-lg-6">
      	<div id="chart1" style="width:100%; height:300px;display:none"></div><div id="pieHover">&nbsp;</div>
      </div>
      <div class="col-lg-6">      
        <div id="chart2" style="width:100%; height:300px;display:none"></div>
      </div>
    </div>
    <?php } ?> 
</div>
<?php } ?>
<?php if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) { ?>
<div style="overflow:scroll; padding:1px;"> 
<?php } else { ?>
<div style="overflow:auto; padding:1px;">     
<?php } ?>
<?php if ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders') { ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">       
	<tr> 
    <td>     
	<?php if ($products && $filter_limit != '999999') { ?>          
		<table class="list_detail">
		<thead>
		<tr>
          <td class="left" nowrap="nowrap"><?php echo $column_order_order_id; ?></td>        
          <td class="left" nowrap="nowrap"><?php echo $column_order_date_added; ?></td> 
          <?php if (in_array('all_order_inv_no', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_order_inv_no; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_customer_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_order_customer; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_email', $advpp_settings_all_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_order_email; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_customer_group', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_customer_group; ?></td>
          <?php } ?>
          <?php if ($filter_details == 'all_details_products') { ?>
          <?php if (in_array('all_prod_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_prod_id; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_sku', $advpp_settings_all_columns)) { ?>           
		  <td class="left" nowrap="nowrap"><?php echo $column_prod_sku; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_upc', $advpp_settings_all_columns)) { ?>           
		  <td class="left" nowrap="nowrap"><?php echo $column_prod_upc; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_ean', $advpp_settings_all_columns)) { ?>           
		  <td class="left" nowrap="nowrap"><?php echo $column_prod_ean; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_jan', $advpp_settings_all_columns)) { ?>           
		  <td class="left" nowrap="nowrap"><?php echo $column_prod_jan; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_isbn', $advpp_settings_all_columns)) { ?>           
		  <td class="left" nowrap="nowrap"><?php echo $column_prod_isbn; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_mpn', $advpp_settings_all_columns)) { ?>           
		  <td class="left" nowrap="nowrap"><?php echo $column_prod_mpn; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_model', $advpp_settings_all_columns)) { ?>           
		  <td class="left" nowrap="nowrap"><?php echo $column_prod_model; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_prod_name; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_option', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_prod_option; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_attributes', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_prod_attributes; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_category', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_prod_category; ?></td>
          <?php } ?>          
          <?php if (in_array('all_prod_manu', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_prod_manu; ?></td>
          <?php } ?>
          <?php } ?>
          <?php if ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders') { ?>
          <?php if (in_array('all_prod_currency', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_prod_currency; ?></td>
          <?php } ?>          
          <?php } ?>
          <?php if ($filter_details == 'all_details_products') { ?>           
          <?php if (in_array('all_prod_price', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $column_prod_price; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_quantity', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $column_prod_quantity; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_total_excl_vat', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $column_prod_total_excl_vat; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_tax', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $column_prod_tax; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_total_incl_vat', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $column_prod_total_incl_vat; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_qty_refund', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_qty_refunded; ?></td>
          <?php } ?> 
          <?php if (in_array('all_prod_refund', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_refunded; ?></td>
          <?php } ?>     
          <?php if (in_array('all_prod_reward_points', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_reward_points; ?></td>
          <?php } ?>
          <?php } ?>     
          <?php if (in_array('all_sub_total', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_sub_total; ?></td>
          <?php } ?>              
          <?php if (in_array('all_handling', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_handling; ?></td>
          <?php } ?>
          <?php if (in_array('all_loworder', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_loworder; ?></td>
          <?php } ?>                  
          <?php if (in_array('all_shipping', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_order_shipping; ?></td>
          <?php } ?>
          <?php if (in_array('all_reward', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_reward; ?></td>
          <?php } ?>
          <?php if (in_array('all_reward_points', $advpp_settings_all_columns)) { ?>          
          <td class="right" style="min-width:85px;"><?php echo $column_earned_reward_points; ?></td>
          <?php } ?>  
          <?php if (in_array('all_reward_points', $advpp_settings_all_columns)) { ?>          
          <td class="right" style="min-width:85px;"><?php echo $column_used_reward_points; ?></td>
          <?php } ?>           
          <?php if (in_array('all_coupon', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_coupon; ?></td>
          <?php } ?>
          <?php if (in_array('all_coupon_name', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_coupon_name; ?></td>
          <?php } ?> 
          <?php if (in_array('all_coupon_code', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_coupon_code; ?></td>
          <?php } ?>                                           
          <?php if (in_array('all_order_tax', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_order_tax; ?></td>
          <?php } ?>
          <?php if (in_array('all_credit', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_credit; ?></td>
          <?php } ?>
          <?php if (in_array('all_voucher', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_voucher; ?></td>
          <?php } ?>
          <?php if (in_array('all_voucher_code', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_voucher_code; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_commission', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_order_commission; ?></td>
          <?php } ?>          
          <?php if (in_array('all_order_value', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_order_value; ?></td>
          <?php } ?>
          <?php if (in_array('all_refund', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_order_refund; ?></td>
          <?php } ?>                        
          <?php if (in_array('all_order_shipping_method', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_shipping_method; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_payment_method', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_payment_method; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_status', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_status; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_store', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_store; ?></td>
          <?php } ?>
          <?php if (in_array('all_campaign_name', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_campaign_name; ?></td>
          <?php } ?> 
          <?php if (in_array('all_campaign_code', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_campaign_code; ?></td>
          <?php } ?>  
          <?php if (in_array('all_customer_cust_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_customer_cust_id; ?></td>
          <?php } ?>
          <?php if (in_array('all_custom_fields', $advpp_settings_all_columns)) { ?>          
          <?php if ($custom_fields) { ?>
          <?php foreach ($custom_fields as $custom_field) { ?>
          <td class="left" nowrap="nowrap"><?php echo $custom_field['name']; ?></td>
          <?php } ?>
          <?php } ?>
          <?php } ?>                   
          <?php if (in_array('all_billing_first_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_first_name; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_last_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_last_name; ?></td>
          <?php } ?>          
          <?php if (in_array('all_billing_company', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_company; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_address_1', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_address_1; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_address_2', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_address_2; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_city', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_city; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_zone', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_zone; ?></td> 
          <?php } ?>
          <?php if (in_array('all_billing_zone_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_zone_id; ?></td> 
          <?php } ?>
          <?php if (in_array('all_billing_zone_code', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_zone_code; ?></td> 
          <?php } ?>                    
          <?php if (in_array('all_billing_postcode', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_postcode; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_country', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_country; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_country_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_country_id; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_country_code', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_billing_country_code; ?></td>
          <?php } ?>                    
          <?php if (in_array('all_customer_telephone', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_customer_telephone; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_first_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_first_name; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_last_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_last_name; ?></td> 
          <?php } ?>          
          <?php if (in_array('all_shipping_company', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_company; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_address_1', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_address_1; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_address_2', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_address_2; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_city', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_city; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_zone', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_zone; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_zone_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_zone_id; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_zone_code', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_zone_code; ?></td> 
          <?php } ?>                    
          <?php if (in_array('all_shipping_postcode', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_postcode; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_country', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_country; ?></td>
          <?php } ?> 
          <?php if (in_array('all_shipping_country_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_country_id; ?></td>
          <?php } ?> 
          <?php if (in_array('all_shipping_country_code', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_country_code; ?></td>
          <?php } ?>                     
          <?php if (in_array('all_order_weight', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $column_order_weight; ?></td>
          <?php } ?>           
          <?php if (in_array('all_order_comment', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $column_order_comment; ?></td>
          <?php } ?>        
		</tr>
		</thead>
        <tbody>
		<?php foreach ($products as $product) { ?>
    	<?php if ($product['product_id']) { ?>          
		<tr bgcolor="#FFFFFF">
          <td class="left" nowrap="nowrap" style="background-color:#fff2d0;" title="<?php echo $column_order_order_id; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><a><?php echo $product['order_id_link']; ?></a></td>        
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_date_added; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['date_added']; ?></td>
          <?php if (in_array('all_order_inv_no', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_inv_no; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['invoice']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_customer_name', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_customer; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['name']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_email', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_email; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['email']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_customer_group', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_customer_group; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['cust_group']; ?></td>
          <?php } ?>
          <?php if ($filter_details == 'all_details_products') { ?>
          <?php if (in_array('all_prod_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_id; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_id_link']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_sku', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_sku; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_sku']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_upc', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_upc; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_upc']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_ean', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_ean; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_ean']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_jan', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_jan; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_jan']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_isbn', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_isbn; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_isbn']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_mpn', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_mpn; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_mpn']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_model', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_model; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_model']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_name; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_name']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_option', $advpp_settings_all_columns)) { ?>    
		  <td class="left" nowrap="nowrap" title="<?php echo $column_prod_option; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_options']; ?></td>               
          <?php } ?>
          <?php if (in_array('all_prod_attributes', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_attributes; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_attributes']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_category', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_category; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_category']; ?></td>
          <?php } ?>            
          <?php if (in_array('all_prod_manu', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_manu; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['product_manu']; ?></td>
          <?php } ?>
          <?php } ?>
          <?php if ($filter_details == 'all_details_products' or $filter_details == 'all_details_orders') { ?>
          <?php if (in_array('all_prod_currency', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_prod_currency; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['currency_code']; ?></td>
          <?php } ?>    
          <?php } ?>
          <?php if ($filter_details == 'all_details_products') { ?>
          <?php if (in_array('all_prod_price', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_price; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_price']; ?></td>
          <?php } ?>                  
          <?php if (in_array('all_prod_quantity', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_quantity; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_quantity']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_total_excl_vat', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_total_excl_vat; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_total_excl_vat']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_tax', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_tax; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_tax']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_total_incl_vat', $advpp_settings_all_columns)) { ?>           
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_total_incl_vat; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_total_incl_vat']; ?></td>
          <?php } ?>
          <?php if (in_array('all_prod_qty_refund', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_qty_refunded; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_qty_refund']; ?></td>
          <?php } ?>   
          <?php if (in_array('all_prod_refund', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_refunded; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_refund']; ?></td>
          <?php } ?>       
          <?php if (in_array('all_prod_reward_points', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_prod_reward_points; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['product_reward_points']; ?></td>
          <?php } ?>
          <?php } ?> 
          <?php if (in_array('all_sub_total', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_sub_total; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_sub_total']; ?></td>
          <?php } ?>
          <?php if (in_array('all_handling', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_handling; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_handling']; ?></td>
          <?php } ?>
          <?php if (in_array('all_loworder', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_loworder; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_low_order_fee']; ?></td>
          <?php } ?>                    
          <?php if (in_array('all_shipping', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_shipping; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_shipping']; ?></td>
          <?php } ?>
          <?php if (in_array('all_reward', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_reward; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_reward']; ?></td>
          <?php } ?>
          <?php if (in_array('all_reward_points', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_earned_reward_points; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_earned_points']; ?></td>
          <?php } ?> 
          <?php if (in_array('all_reward_points', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_used_reward_points; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_used_points']; ?></td>
          <?php } ?>           
          <?php if (in_array('all_coupon', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_coupon; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_coupon']; ?></td>
          <?php } ?>
          <?php if (in_array('all_coupon_name', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_coupon_name; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_coupon_name']; ?></td>
          <?php } ?>   
          <?php if (in_array('all_coupon_code', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_coupon_code; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_coupon_code']; ?></td>
          <?php } ?>                                      
          <?php if (in_array('all_order_tax', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_order_tax; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_tax']; ?></td>
          <?php } ?>
          <?php if (in_array('all_credit', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_credit; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_credit']; ?></td>
          <?php } ?>
          <?php if (in_array('all_voucher', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_voucher; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_voucher']; ?></td>
          <?php } ?>
          <?php if (in_array('all_voucher_code', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_voucher_code; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_voucher_code']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_commission', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_order_commission; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_commission']; ?></td>
          <?php } ?>          
          <?php if (in_array('all_order_value', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_order_value; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_value']; ?></td>
          <?php } ?>
          <?php if (in_array('all_refund', $advpp_settings_all_columns)) { ?>          
          <td class="right" nowrap="nowrap" title="<?php echo $column_order_refund; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_refund']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_shipping_method', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_shipping_method; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_method']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_payment_method', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_payment_method; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_method']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_status', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_status; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['order_status']; ?></td>
          <?php } ?>
          <?php if (in_array('all_order_store', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_store; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['store_name']; ?></td> 
          <?php } ?>
          <?php if (in_array('all_campaign_name', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_campaign_name; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_campaign_name']; ?></td>
          <?php } ?>   
          <?php if (in_array('all_campaign_code', $advpp_settings_all_columns)) { ?>          
          <td class="left" nowrap="nowrap" title="<?php echo $column_campaign_code; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_campaign_code']; ?></td>
          <?php } ?>   
          <?php if (in_array('all_customer_cust_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_customer_cust_id; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]">
          <?php if ($product['customer_id'] == 0) { ?>
          <?php echo $product['customer_id']; ?>       
          <?php } else { ?>
          <?php echo $product['customer_id_link']; ?>
          <?php } ?></td>
          <?php } ?>
          <?php if (in_array('all_custom_fields', $advpp_settings_all_columns)) { ?>           
          <?php if ($product['custom_fields']) { ?>
          <?php foreach ($product['custom_fields'] as $custom_field) { ?>
          <td class="left" nowrap="nowrap" title="<?php echo $custom_field['name']; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $custom_field['value']; ?></td>
          <?php } ?>
          <?php } else { ?>
          <?php foreach ($custom_fields as $custom_field) { ?>
          <td class="left" nowrap="nowrap" title="<?php echo $custom_field['name']; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"></td>
          <?php } ?>          
          <?php } ?>
          <?php } ?>
          <?php if (in_array('all_billing_first_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_first_name); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_firstname']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_last_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_last_name); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_lastname']; ?></td>
          <?php } ?>          
          <?php if (in_array('all_billing_company', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_company); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_company']; ?></td> 
          <?php } ?>
          <?php if (in_array('all_billing_address_1', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_address_1); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_address_1']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_address_2', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_address_2); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_address_2']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_city', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_city); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_city']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_zone', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_zone); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_zone']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_zone_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_zone_id); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_zone_id']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_zone_code', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_zone_code); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_zone_code']; ?></td>
          <?php } ?>                    
          <?php if (in_array('all_billing_postcode', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_postcode); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_postcode']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_country', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_country); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_country']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_country_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_country_id); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_country_id']; ?></td>
          <?php } ?>
          <?php if (in_array('all_billing_country_code', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_billing_country_code); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['payment_country_code']; ?></td>
          <?php } ?>                    
          <?php if (in_array('all_customer_telephone', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo $column_customer_telephone; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['telephone']; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_first_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_first_name); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_firstname']; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_last_name', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_last_name); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_lastname']; ?></td>
          <?php } ?>          
          <?php if (in_array('all_shipping_company', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_company); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_company']; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_address_1', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_address_1); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_address_1']; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_address_2', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_address_2); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_address_2']; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_city', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_city); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_city']; ?></td> 
          <?php } ?>                
          <?php if (in_array('all_shipping_zone', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_zone); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_zone']; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_zone_id', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_zone_id); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_zone_id']; ?></td> 
          <?php } ?>
          <?php if (in_array('all_shipping_zone_code', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_zone_code); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_zone_code']; ?></td> 
          <?php } ?>                    
          <?php if (in_array('all_shipping_postcode', $advpp_settings_all_columns)) { ?>           
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_postcode); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_postcode']; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_country', $advpp_settings_all_columns)) { ?> 
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_country); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_country']; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_country_id', $advpp_settings_all_columns)) { ?> 
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_country_id); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_country_id']; ?></td>
          <?php } ?>
          <?php if (in_array('all_shipping_country_code', $advpp_settings_all_columns)) { ?> 
          <td class="left" nowrap="nowrap" title="<?php echo strip_tags($column_shipping_country_code); ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['shipping_country_code']; ?></td>
          <?php } ?>                    
          <?php if (in_array('all_order_weight', $advpp_settings_all_columns)) { ?> 
          <td class="right" nowrap="nowrap" title="<?php echo $column_order_weight; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['order_weight']; ?></td>
          <?php } ?>           
          <?php if (in_array('all_order_comment', $advpp_settings_all_columns)) { ?> 
          <td class="left" nowrap="nowrap" title="<?php echo $column_order_comment; ?> [<?php echo $column_order_order_id; ?>: <?php echo $product['order_id']; ?>]"><?php echo $product['order_comment']; ?></td>
          <?php } ?>               
        </tr>   
		<?php } ?>
		<?php } ?>    
 	   </tbody>
	   </table>    
	<?php } else { ?>
    <?php if ($filter_limit != '999999') { ?>
	<table width="100%">    
	<tr>
	<td align="center"><?php echo $text_no_results; ?></td>
	</tr>
	</table>          
	<?php } ?>   
    <?php } ?>          
    </td>
    </tr>
    </table>  
<?php } ?>
<?php if ($filter_details != 'all_details_products' && $filter_details != 'all_details_orders' && $filter_limit != '999999') { ?>
    <table class="list_main">
        <thead>
          <tr>
          <?php $c = 0; ?>
          <?php if ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders') { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_date_added; $c++; ?></td>
		  <?php } elseif ($filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_start; $c++; ?></td>
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_end; $c++; ?></td>
          <?php } else { ?> 
		  <?php if ($filter_group == 'year') { ?>           
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_year; $c++; ?></td>
		  <?php } elseif ($filter_group == 'quarter') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_year; $c++; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_quarter; $c++; ?></td>       
		  <?php } elseif ($filter_group == 'month') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_year; $c++; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_month; $c++; ?></td> 
		  <?php } elseif ($filter_group == 'day') { ?> 
          <td class="left" colspan="2" nowrap="nowrap"><?php echo $column_date; $c++; ?></td>
		  <?php } elseif ($filter_group == 'order') { ?> 
          <td class="left" nowrap="nowrap"><?php echo $column_order_order_id; $c++; ?></td>
          <td class="left" nowrap="nowrap"><?php echo $column_order_date_added; $c++; ?></td>             
		  <?php } else { ?>    
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_start; $c++; ?></td>
          <td class="left" width="70" nowrap="nowrap"><?php echo $column_date_end; $c++; ?></td>
		  <?php } ?>
          <?php } ?>
          <?php if ($filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>
          <?php if (in_array('scw_id', $advpp_settings_scw_columns)) { ?>            
          <td class="right"><?php echo $column_id; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('scw_image', $advpp_settings_scw_columns)) { ?>            
          <td class="center"><?php echo $column_image; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_name', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php if ($filter_report == 'products_shopping_carts') { ?><?php echo $column_name; $c++; ?><?php } else { ?><?php echo $column_prod_name; $c++; ?><?php } ?></td>
          <?php } ?>  
          <?php if (in_array('scw_sku', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_sku; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('scw_upc', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_upc; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_ean', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_ean; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_jan', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_jan; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_isbn', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_isbn; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_mpn', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_mpn; $c++; ?></td>
          <?php } ?>     
          <?php if (in_array('scw_model', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_model; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('scw_category', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_category; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('scw_manufacturer', $advpp_settings_scw_columns)) { ?>
          <td class="left"><?php echo $column_manufacturer; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('scw_attribute', $advpp_settings_scw_columns)) { ?>
          <td class="left"><?php echo $column_attribute; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('scw_status', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $column_status; $c++; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_location', $advpp_settings_scw_columns)) { ?>            
          <td class="left"><?php echo $column_location; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('scw_tax_class', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $column_tax_class; $c++; ?></td>
          <?php } ?>                    
          <?php if (in_array('scw_price', $advpp_settings_scw_columns)) { ?>          
          <td class="right"><?php echo $column_price; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('scw_viewed', $advpp_settings_scw_columns)) { ?>          
          <td class="right"><?php echo $column_viewed; $c++; ?></td> 
          <?php } ?>           
          <?php if (in_array('scw_stock_quantity', $advpp_settings_scw_columns)) { ?>                           
          <td class="right"><?php echo $column_stock_quantity; $c++; ?></td>
          <?php } ?>
          <?php if ($filter_report == 'products_shopping_carts') { ?>
          <?php if (in_array('scw_cart_quantity', $advpp_settings_scw_columns)) { ?>                           
          <td class="right"><?php echo $column_cart_quantity; $c++; ?></td>
          <?php } ?>
          <?php } elseif ($filter_report == 'products_wishlists') { ?>
          <?php if (in_array('scw_wishlist_quantity', $advpp_settings_scw_columns)) { ?>                           
          <td class="right"><?php echo $column_wishlist_quantity; $c++; ?></td>
          <?php } ?>
          <?php } ?>
          <td class="center"><?php $c++; ?><a class="btn btn-info btn-sm toggle-all expand" data-original-title="<?php echo $button_expand; ?>" data-toggle="tooltip"><i id="circle" class="fa fa-arrow-circle-down"></i></a></td>
          <?php } elseif ($filter_report == 'products_without_orders') { ?>
          <?php if (in_array('pnp_id', $advpp_settings_pnp_columns)) { ?>            
          <td class="right"><?php echo $column_id; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('pnp_image', $advpp_settings_pnp_columns)) { ?>            
          <td class="center"><?php echo $column_image; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_name', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_prod_name; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_sku', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_sku; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('pnp_upc', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_upc; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_ean', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_ean; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_jan', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_jan; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_isbn', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_isbn; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_mpn', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_mpn; $c++; ?></td>
          <?php } ?>     
          <?php if (in_array('pnp_model', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_model; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('pnp_category', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_category; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('pnp_manufacturer', $advpp_settings_pnp_columns)) { ?>
          <td class="left"><?php echo $column_manufacturer; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('pnp_attribute', $advpp_settings_pnp_columns)) { ?>
          <td class="left"><?php echo $column_attribute; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('pnp_status', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $column_status; $c++; ?></td> 
          <?php } ?>
          <?php if (in_array('pnp_location', $advpp_settings_pnp_columns)) { ?>            
          <td class="left"><?php echo $column_location; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('pnp_tax_class', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $column_tax_class; $c++; ?></td>
          <?php } ?>                    
          <?php if (in_array('pnp_price', $advpp_settings_pnp_columns)) { ?>          
          <td class="right"><?php echo $column_price; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('pnp_viewed', $advpp_settings_pnp_columns)) { ?>          
          <td class="right"><?php echo $column_viewed; $c++; ?></td> 
          <?php } ?>           
          <?php if (in_array('pnp_stock_quantity', $advpp_settings_pnp_columns)) { ?>                           
          <td class="right"><?php echo $column_stock_quantity; $c++; ?></td>
          <?php } ?>
          <?php } elseif ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>
          <?php if ($filter_report == 'manufacturers') { ?> 
          <?php if (in_array('cm_manufacturer', $advpp_settings_cm_columns)) { ?>
          <td class="left"><?php echo $column_manufacturer; $c++; ?></td>
          <?php } ?>
		  <?php } elseif ($filter_report == 'categories') { ?>
          <?php if (in_array('cm_category', $advpp_settings_cm_columns)) { ?>            
          <td class="left"><?php echo $column_category; $c++; ?></td>
          <?php } ?>   
		  <?php } ?>  
          <?php if (in_array('cm_orders', $advpp_settings_cm_columns)) { ?>          
          <td class="right"><?php echo $column_orders; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('cm_customers', $advpp_settings_cm_columns)) { ?>          
          <td class="right"><?php echo $column_customers; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('cm_sold_quantity', $advpp_settings_cm_columns)) { ?>          
          <td class="right"><?php echo $column_sold_quantity; $c++; ?></td>
          <?php } ?>                  
          <?php if (in_array('cm_sold_percent', $advpp_settings_cm_columns)) { ?>          
          <td class="right"><?php echo $column_sold_percent; $c++; ?></td>
          <?php } ?>    
          <?php if (in_array('cm_total_excl_vat', $advpp_settings_cm_columns)) { ?>          
          <td class="right" style="min-width:75px;"><?php echo $column_prod_total_excl_vat; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('cm_total_tax', $advpp_settings_cm_columns)) { ?>          
          <td class="right"><?php echo $column_total_tax; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('cm_total_incl_vat', $advpp_settings_cm_columns)) { ?>          
          <td class="right" style="min-width:75px;"><?php echo $column_prod_total_incl_vat; $c++; ?></td>
          <?php } ?>                 
          <?php if (in_array('cm_app', $advpp_settings_cm_columns)) { ?>          
          <td class="right" style="min-width:90px;"><?php echo $column_app; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('cm_refunds', $advpp_settings_cm_columns)) { ?>          
          <td class="right"><?php echo $column_product_refunds; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('cm_reward_points', $advpp_settings_cm_columns)) { ?>          
          <td class="right"><?php echo $column_product_reward_points; $c++; ?></td>
          <?php } ?>
          <?php if ($filter_details == 'basic_details') { ?><td class="center"><?php $c++; ?><a class="btn btn-info btn-sm toggle-all expand" data-original-title="<?php echo $button_expand; ?>" data-toggle="tooltip"><i id="circle" class="fa fa-arrow-circle-down"></i></a></td><?php } ?> 
          <?php } elseif ($filter_report == 'products_options') { ?>
          <td class="left"><?php echo $column_prod_option; $c++; ?></td>
          <?php if (in_array('mv_orders', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_orders; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_customers', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_customers; $c++; ?></td>
          <?php } ?> 
          <td class="right"><?php echo $column_sold_quantity; $c++; ?></td>
          <td class="right"><?php echo $column_sold_percent; $c++; ?></td> 
          <?php if ($filter_details == 'basic_details') { ?><td class="center"><?php $c++; ?><a class="btn btn-info btn-sm toggle-all expand" data-original-title="<?php echo $button_expand; ?>" data-toggle="tooltip"><i id="circle" class="fa fa-arrow-circle-down"></i></a></td><?php } ?>          
          <?php } else { ?>
          <?php if (in_array('mv_id', $advpp_settings_mv_columns)) { ?>            
          <td class="right"><?php echo $column_id; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('mv_image', $advpp_settings_mv_columns)) { ?>            
          <td class="center"><?php echo $column_image; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('mv_name', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php if ($filter_report == 'products_purchased_with_options' or $filter_report == 'products_abandoned_orders') { ?><?php echo $column_name; $c++; ?><?php } else { ?><?php echo $column_prod_name; $c++; ?><?php } ?></td>
          <?php } ?>  
          <?php if (in_array('mv_sku', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_sku; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_upc', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_upc; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_ean', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_ean; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_jan', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_jan; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_isbn', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_isbn; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_mpn', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_mpn; $c++; ?></td>
          <?php } ?>     
          <?php if (in_array('mv_model', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_model; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('mv_category', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_category; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('mv_manufacturer', $advpp_settings_mv_columns)) { ?>
          <td class="left"><?php echo $column_manufacturer; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_attribute', $advpp_settings_mv_columns)) { ?>
          <td class="left"><?php echo $column_attribute; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_status', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $column_status; $c++; ?></td> 
          <?php } ?>
          <?php if (in_array('mv_location', $advpp_settings_mv_columns)) { ?>            
          <td class="left"><?php echo $column_location; $c++; ?></td>
          <?php } ?>   
          <?php if (in_array('mv_tax_class', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $column_tax_class; $c++; ?></td>
          <?php } ?>                    
          <?php if (in_array('mv_price', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_price; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_viewed', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_viewed; $c++; ?></td> 
          <?php } ?>           
          <?php if (in_array('mv_stock_quantity', $advpp_settings_mv_columns)) { ?>                           
          <td class="right"><?php echo $column_stock_quantity; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_orders', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_orders; $c++; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_customers', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_customers; $c++; ?></td>
          <?php } ?> 
          <?php if (in_array('mv_sold_quantity', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_sold_quantity; $c++; ?></td>
          <?php } ?>                  
          <?php if (in_array('mv_sold_percent', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_sold_percent; $c++; ?></td>
          <?php } ?>     
          <?php if (in_array('mv_total_excl_vat', $advpp_settings_mv_columns)) { ?>          
          <td class="right" style="min-width:75px;"><?php echo $column_prod_total_excl_vat; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_total_tax', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_total_tax; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_total_incl_vat', $advpp_settings_mv_columns)) { ?>          
          <td class="right" style="min-width:75px;"><?php echo $column_prod_total_incl_vat; $c++; ?></td>
          <?php } ?>                 
          <?php if (in_array('mv_app', $advpp_settings_mv_columns)) { ?>          
          <td class="right" style="min-width:90px;"><?php echo $column_app; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_refunds', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_product_refunds; $c++; ?></td>
          <?php } ?>
          <?php if (in_array('mv_reward_points', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $column_product_reward_points; $c++; ?></td>
          <?php } ?>          
          <?php if ($filter_details == 'basic_details') { ?><td class="center"><?php $c++; ?><a class="btn btn-info btn-sm toggle-all expand" data-original-title="<?php echo $button_expand; ?>" data-toggle="tooltip"><i id="circle" class="fa fa-arrow-circle-down"></i></a></td><?php } ?> 
          <?php } ?>
          </tr>
      	  </thead>
      	  <tbody>          
          <?php if ($products) { ?>
          <?php foreach ($products as $product) { ?>
          <?php if ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_without_orders') { ?>
          <tr> 
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['date_added']; ?></td>  
		  <?php } elseif ($filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>
          <tr style="cursor:pointer;" title="<?php echo $text_customer_list; ?>" id="show_details_<?php echo $product['date']; ?>">          
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['date_start']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['date_end']; ?></td>          
          <?php } else { ?>
          <?php if ($filter_report == 'products_options') { ?>
          <tr <?php echo ($filter_details == 'basic_details') ? 'style="cursor:pointer;" title="' . $text_detail . '"' : '' ?> id="show_details_<?php echo $product['option_details']; ?>">
          <?php } else { ?>
          <tr <?php echo ($filter_details == 'basic_details') ? 'style="cursor:pointer;" title="' . $text_detail . '"' : '' ?> id="show_details_<?php echo $product['order_product_id']; ?>">
          <?php } ?>            
		  <?php if ($filter_group == 'year') { ?>           
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['year']; ?></td>
		  <?php } elseif ($filter_group == 'quarter') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['year']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['quarter']; ?></td>  
		  <?php } elseif ($filter_group == 'month') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['year']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['month']; ?></td>
		  <?php } elseif ($filter_group == 'day') { ?> 
          <td class="left" colspan="2" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['date_start']; ?></td>
		  <?php } elseif ($filter_group == 'order') { ?> 
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['order_id']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['date_start']; ?></td>         
		  <?php } else { ?>    
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['date_start']; ?></td>
          <td class="left" nowrap="nowrap" style="background-color:#F9F9F9;"><?php echo $product['date_end']; ?></td>         
		  <?php } ?>
          <?php } ?>
          <?php if ($filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') { ?>
          <?php if (in_array('scw_id', $advpp_settings_scw_columns)) { ?>          
          <td class="right"><?php echo $product['product_id']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_image', $advpp_settings_scw_columns)) { ?>          
          <td class="center"><img src="<?php echo $product['image']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
          <?php } ?>   
          <?php if (in_array('scw_name', $advpp_settings_scw_columns)) { ?>          
          <td class="left">
          <?php if ($product['status'] != NULL) { ?>
          <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php } else { ?>
          <?php echo $product['name']; ?>
          <?php } ?>
          <?php if ($filter_report == 'products_shopping_carts') { ?>
          <?php if ($product['option']) { ?>          
          <div style="display:table; margin-left:3px;">
          <?php foreach ($product['option'] as $option) { ?>            
          <div style="display:table-row; white-space:nowrap;">   
		  <div style="display:table-cell; white-space:nowrap; font-size:smaller;"><?php echo $option['name']; ?>:</div>
          <div style="display:table-cell; white-space:nowrap; padding-left:5px; font-size:smaller;"><?php echo $option['value']; ?></div>
          </div>
          <?php } ?>
          </div>
          <?php } ?><?php } ?>         
          </td>          
          <?php } ?>    
          <?php if (in_array('scw_sku', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['sku']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_upc', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['upc']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_ean', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['ean']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_jan', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['jan']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_isbn', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['isbn']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_mpn', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['mpn']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_model', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['model']; ?></td>
          <?php } ?> 
          <?php if (in_array('scw_category', $advpp_settings_scw_columns)) { ?>          
          <td class="left">
          <?php foreach ($categories as $category) { ?>
          <?php if (in_array($category['category_id'], $product['category'])) { ?>
          <?php echo $category['name'];?><br />
          <?php } ?> <?php } ?></td>  
          <?php } ?>
          <?php if (in_array('scw_manufacturer', $advpp_settings_scw_columns)) { ?>          
          <td class="left">
		  <?php foreach ($manufacturers as $manufacturer) { ?>
          <?php if (in_array($manufacturer['manufacturer_id'], $product['manufacturer'])) { ?>
          <?php echo $manufacturer['name'];?>
          <?php } ?> <?php } ?></td>          
          <?php } ?>
          <?php if (in_array('scw_attribute', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['attribute']; ?></td>
          <?php } ?>          
          <?php if (in_array('scw_status', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['status']; ?></td>
          <?php } ?>
          <?php if (in_array('scw_location', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['location']; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_tax_class', $advpp_settings_scw_columns)) { ?>          
          <td class="left"><?php echo $product['tax_class']; ?></td>
          <?php } ?>                     
          <?php if (in_array('scw_price', $advpp_settings_scw_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['price']; ?></td>  
          <?php } ?>
          <?php if (in_array('scw_viewed', $advpp_settings_scw_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['viewed']; ?></td>
          <?php } ?>           
          <?php if (in_array('scw_stock_quantity', $advpp_settings_scw_columns)) { ?>          
          <td class="right" nowrap="nowrap">
          <?php if ($product['stock_quantity'] <= 0) { ?>
		  <span style="color:#FF0000;"><?php echo $product['stock_quantity']; ?></span>
		  <?php } elseif ($product['stock_quantity'] <= 5) { ?>
		  <span style="color:#FFA500;"><?php echo $product['stock_quantity']; ?></span>
		  <?php } else { ?>
		  <?php echo $product['stock_quantity']; ?>
		  <?php } ?>
		  <?php if ($filter_report == 'products_shopping_carts') { ?> 
		  <?php if ($product['option']) { ?><br />
          <?php foreach ($product['option'] as $option) { ?> 
          <div style="font-size:smaller;"><?php echo $option['quantity']; ?><br /></div>
		  <?php } ?><?php } ?>
		  <?php } ?>
          </td>          
          <?php } ?>
          <?php if ($filter_report == 'products_shopping_carts') { ?>
          <?php if (in_array('scw_cart_quantity', $advpp_settings_scw_columns)) { ?>  
          <td class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['cart_quantity']; ?></td>
          <?php } ?>
          <?php } ?>
          <?php if ($filter_report == 'products_wishlists') { ?>
          <?php if (in_array('scw_wishlist_quantity', $advpp_settings_scw_columns)) { ?>  
          <td class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['wishlist_quantity']; ?></td>
          <?php } ?>
          <?php } ?>
          <td class="center" nowrap="nowrap">[ <a><?php echo $text_customer_list; ?></a> ]</td>          
          <?php } elseif ($filter_report == 'products_without_orders') { ?>
          <?php if (in_array('pnp_id', $advpp_settings_pnp_columns)) { ?>          
          <td class="right"><?php echo $product['product_id']; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_image', $advpp_settings_pnp_columns)) { ?>          
          <td class="center"><img src="<?php echo $product['image']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
          <?php } ?>
          <?php if (in_array('pnp_name', $advpp_settings_pnp_columns)) { ?>          
          <td class="left">
          <?php if ($product['status'] != NULL) { ?>
          <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php } else { ?>
          <?php echo $product['name']; ?>
          <?php } ?></td>          
          <?php } ?>    
          <?php if (in_array('pnp_sku', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['sku']; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_upc', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['upc']; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_ean', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['ean']; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_jan', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['jan']; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_isbn', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['isbn']; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_mpn', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['mpn']; ?></td>
          <?php } ?>   
          <?php if (in_array('pnp_model', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['model']; ?></td>
          <?php } ?> 
          <?php if (in_array('pnp_category', $advpp_settings_pnp_columns)) { ?>          
          <td class="left">
          <?php foreach ($categories as $category) { ?>
          <?php if (in_array($category['category_id'], $product['category'])) { ?>
          <?php echo $category['name'];?><br />
          <?php } ?> <?php } ?></td>  
          <?php } ?>
          <?php if (in_array('pnp_manufacturer', $advpp_settings_pnp_columns)) { ?>          
          <td class="left">
		  <?php foreach ($manufacturers as $manufacturer) { ?>
          <?php if (in_array($manufacturer['manufacturer_id'], $product['manufacturer'])) { ?>
          <?php echo $manufacturer['name'];?>
          <?php } ?> <?php } ?></td>          
          <?php } ?>
          <?php if (in_array('pnp_attribute', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['attribute']; ?></td>
          <?php } ?>
          <?php if (in_array('pnp_status', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['status']; ?></td>
          <?php } ?>
          <?php if (in_array('pnp_location', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['location']; ?></td>
          <?php } ?>  
          <?php if (in_array('pnp_tax_class', $advpp_settings_pnp_columns)) { ?>          
          <td class="left"><?php echo $product['tax_class']; ?></td>
          <?php } ?>                     
          <?php if (in_array('pnp_price', $advpp_settings_pnp_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['price']; ?></td>  
          <?php } ?>  
          <?php if (in_array('pnp_viewed', $advpp_settings_pnp_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['viewed']; ?></td>
          <?php } ?>           
          <?php if (in_array('pnp_stock_quantity', $advpp_settings_pnp_columns)) { ?>          
          <td class="right" nowrap="nowrap">
          <?php if ($product['stock_quantity'] <= 0) { ?>
		  <span style="color:#FF0000;"><?php echo $product['stock_quantity']; ?></span>
		  <?php } elseif ($product['stock_quantity'] <= 5) { ?>
		  <span style="color:#FFA500;"><?php echo $product['stock_quantity']; ?></span>
		  <?php } else { ?>
		  <?php echo $product['stock_quantity']; ?>
		  <?php } ?></td>
          <?php } ?>
          <?php } elseif ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>
          <?php if ($filter_report == 'manufacturers') { ?> 
          <?php if (in_array('cm_manufacturer', $advpp_settings_cm_columns)) { ?>          
          <td class="left">
		  <?php foreach ($manufacturers as $manufacturer) { ?>
          <?php if (in_array($manufacturer['manufacturer_id'], $product['manufacturer'])) { ?>
          <?php echo $manufacturer['name'];?>
          <?php } ?> <?php } ?></td>          
          <?php } ?>
		  <?php } elseif ($filter_report == 'categories') { ?>
          <?php if (in_array('cm_category', $advpp_settings_cm_columns)) { ?>          
          <td class="left">
          <?php foreach ($categories as $category) { ?>
          <?php if (in_array($category['category_id'], $product['category'])) { ?>
          <?php echo $category['name'];?><br />
          <?php } ?> <?php } ?></td>  
          <?php } ?>           
		  <?php } ?> 
          <?php if (in_array('cm_orders', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['orders']; ?></td>
          <?php } ?>
          <?php if (in_array('cm_customers', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['customers']; ?></td>
          <?php } ?>      
          <?php if (in_array('cm_sold_quantity', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['sold_quantity']; ?></td>
          <?php } ?>
          <?php if (in_array('cm_sold_percent', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['sold_percent']; ?></td>
          <?php } ?>
          <?php if (in_array('cm_total_excl_vat', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['total_excl_vat']; ?></td>
          <?php } ?>
          <?php if (in_array('cm_total_tax', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['total_tax']; ?></td>
          <?php } ?>
          <?php if (in_array('cm_total_incl_vat', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['total_incl_vat']; ?></td>
          <?php } ?>    
          <?php if (in_array('cm_app', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['app']; ?></td>
          <?php } ?> 
          <?php if (in_array('cm_refunds', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['refunds']; ?></td>
          <?php } ?> 
          <?php if (in_array('cm_reward_points', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['reward_points']; ?></td>
          <?php } ?>
          <?php if ($filter_details == 'basic_details') { ?><td class="center"><a class="btn btn-info btn-xs"><?php echo $text_detail; ?></a></td><?php } ?> 
          <?php } elseif ($filter_report == 'products_options') { ?>
          <td class="left" nowrap="nowrap"><?php echo $product['option_name']; ?></td>
          <?php if (in_array('mv_orders', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $product['orders']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_customers', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $product['customers']; ?></td>
          <?php } ?>
          <td class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['sold_quantity']; ?></td>
          <td class="right" nowrap="nowrap" style="background-color:#FFC;"><?php echo $product['sold_percent']; ?></td>
          <?php if ($filter_details == 'basic_details') { ?><td class="center"><a class="btn btn-info btn-xs"><?php echo $text_detail; ?></a></td><?php } ?>
          <?php } else { ?>
          <?php if (in_array('mv_id', $advpp_settings_mv_columns)) { ?>          
          <td class="right"><?php echo $product['product_id']; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_image', $advpp_settings_mv_columns)) { ?>          
          <td class="center"><img src="<?php echo $product['image']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
          <?php } ?>   
          <?php if (in_array('mv_name', $advpp_settings_mv_columns)) { ?>          
          <td class="left">
          <?php if ($product['status'] != NULL) { ?>
          <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
          <?php } else { ?>
          <?php echo $product['name']; ?>
          <?php } ?>
          <?php if ($filter_report == 'products_purchased_with_options' or $filter_report == 'products_abandoned_orders') { ?>
          <?php if ($product['option']) { ?>          
          <div style="display:table; margin-left:3px;">
          <?php foreach ($product['option'] as $option) { ?>            
          <div style="display:table-row; white-space:nowrap;">         
		  <div style="display:table-cell; white-space:nowrap; font-size:smaller;"><?php echo $option['name']; ?>:</div>
          <div style="display:table-cell; white-space:nowrap; padding-left:5px; font-size:smaller;"><?php echo $option['value']; ?></div>
          </div>
          <?php } ?>
          </div>
          <?php } ?><?php } ?>
          </td>          
          <?php } ?>   
          <?php if (in_array('mv_sku', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['sku']; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_upc', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['upc']; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_ean', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['ean']; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_jan', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['jan']; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_isbn', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['isbn']; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_mpn', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['mpn']; ?></td>
          <?php } ?>   
          <?php if (in_array('mv_model', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['model']; ?></td>
          <?php } ?> 
          <?php if (in_array('mv_category', $advpp_settings_mv_columns)) { ?>          
          <td class="left">
          <?php foreach ($categories as $category) { ?>
          <?php if (in_array($category['category_id'], $product['category'])) { ?>
          <?php echo $category['name'];?><br />
          <?php } ?> <?php } ?></td>  
          <?php } ?>
          <?php if (in_array('mv_manufacturer', $advpp_settings_mv_columns)) { ?>          
          <td class="left">
		  <?php foreach ($manufacturers as $manufacturer) { ?>
          <?php if (in_array($manufacturer['manufacturer_id'], $product['manufacturer'])) { ?>
          <?php echo $manufacturer['name'];?>
          <?php } ?> <?php } ?></td>          
          <?php } ?>
          <?php if (in_array('mv_attribute', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['attribute']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_status', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['status']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_location', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['location']; ?></td>
          <?php } ?>  
          <?php if (in_array('mv_tax_class', $advpp_settings_mv_columns)) { ?>          
          <td class="left"><?php echo $product['tax_class']; ?></td>
          <?php } ?>                     
          <?php if (in_array('mv_price', $advpp_settings_mv_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['price']; ?></td>  
          <?php } ?>
          <?php if (in_array('mv_viewed', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['viewed']; ?></td>
          <?php } ?>           
          <?php if (in_array('mv_stock_quantity', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap">
          <?php if ($product['stock_quantity'] <= 0) { ?>
		  <span style="color:#FF0000;"><?php echo $product['stock_quantity']; ?></span>
		  <?php } elseif ($product['stock_quantity'] <= 5) { ?>
		  <span style="color:#FFA500;"><?php echo $product['stock_quantity']; ?></span>
		  <?php } else { ?>
		  <?php echo $product['stock_quantity']; ?>
		  <?php } ?>
		  <?php if ($filter_report == 'products_purchased_with_options' or $filter_report == 'products_abandoned_orders') { ?> 
		  <?php if ($product['option']) { ?><br />
          <?php foreach ($product['option'] as $option) { ?> 
          <div style="font-size:smaller;"><?php echo $option['quantity']; ?><br /></div>
          <?php } ?>
		  <?php } ?>
		  <?php } ?>
          </td>
          <?php } ?>
          <?php if (in_array('mv_orders', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['orders']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_customers', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['customers']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_sold_quantity', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#FFC; text-decoration:line-through;"' : 'style="background-color:#FFC;"' ?> ><?php echo $product['sold_quantity']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_sold_percent', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#FFC; text-decoration:line-through;"' : 'style="background-color:#FFC;"' ?> ><?php echo $product['sold_percent']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_total_excl_vat', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['total_excl_vat']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_total_tax', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['total_tax']; ?></td>
          <?php } ?>
          <?php if (in_array('mv_total_incl_vat', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['total_incl_vat']; ?></td>
          <?php } ?>    
          <?php if (in_array('mv_app', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['app']; ?></td>
          <?php } ?> 
          <?php if (in_array('mv_refunds', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['refunds']; ?></td>
          <?php } ?> 
          <?php if (in_array('mv_reward_points', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['reward_points']; ?></td>
          <?php } ?>          
          <?php if ($filter_details == 'basic_details') { ?><td class="center"><a class="btn btn-info btn-xs"><?php echo $text_detail; ?></a></td><?php } ?> 
          <?php } ?>
          </tr>        
<tr>
<td colspan="<?php echo $c; ?>" class="center">
<?php if (($filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') && $filter_details == 'no_details') { ?>
<script type="text/javascript">
$('#show_details_<?php echo $product["date"]; ?>').click(function() {
	$('#tab_details_<?php echo $product["date"]; ?>').slideToggle('slow');
});
</script>
<div id="tab_details_<?php echo $product['date']; ?>" class="more" style="display:none;">
    <table class="list_detail">
      <thead>
        <tr>
          <?php if (in_array('scw_customer_id', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_customer_cust_id; ?></td>
          <?php } ?>        
          <?php if (in_array('scw_date_added', $advpp_settings_scw_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_customer_date_added; ?></td>
          <?php } ?>           
          <?php if (in_array('scw_customer_name', $advpp_settings_scw_columns)) { ?>                           
          <td class="left" nowrap="nowrap"><?php echo $column_order_customer; ?></td>
          <?php } ?>
          <?php if (in_array('scw_customer_email', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_email; ?></td>
          <?php } ?>
          <?php if (in_array('scw_customer_telephone', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_customer_telephone; ?></td>
          <?php } ?>            
          <?php if (in_array('scw_customer_group', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_customer_group; ?></td>
          <?php } ?>  
          <?php if (in_array('scw_billing_company', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_company; ?></td>
          <?php } ?>
          <?php if (in_array('scw_billing_address_1', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_address_1; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_address_2', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_address_2; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_city', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_city; ?></td>
          <?php } ?>
          <?php if (in_array('scw_billing_zone', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_region_state; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_postcode', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_postcode; ?></td>
          <?php } ?>
          <?php if (in_array('scw_billing_country', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_country; ?></td>
          <?php } ?>                
        </tr>
      </thead>
      <?php foreach ($product['customer'] as $customer) { ?> 
        <tr bgcolor="#FFFFFF">
          <?php if (in_array('scw_customer_id', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap" style="background-color:#fff2d0;"><a href="<?php echo $customer['href']; ?>"><?php echo $customer['customer_id']; ?></a></td>
          <?php } ?>        
          <?php if (in_array('scw_date_added', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['date_added']; ?></td>
          <?php } ?>        
          <?php if (in_array('scw_customer_name', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['customer_name']; ?></td>
          <?php } ?>
          <?php if (in_array('scw_customer_email', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['email']; ?></td>
          <?php } ?>
          <?php if (in_array('scw_customer_telephone', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['telephone']; ?></td> 
          <?php } ?>              
          <?php if (in_array('scw_customer_group', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['customer_group']; ?></td>
          <?php } ?> 
          <?php if (in_array('scw_billing_company', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['company']; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_address_1', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['address_1']; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_address_2', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['address_2']; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_city', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['city']; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_zone', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['zone']; ?></td> 
          <?php } ?>
          <?php if (in_array('scw_billing_postcode', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['postcode']; ?></td>
          <?php } ?>
          <?php if (in_array('scw_billing_country', $advpp_settings_scw_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $customer['country']; ?></td>
          <?php } ?>               
         </tr>
      <?php } ?> 
    </table> 
</div>
<?php } ?>
<?php if (($filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_abandoned_orders') && $filter_details == 'basic_details') { ?>
<script type="text/javascript">
$('#show_details_<?php echo $product["order_product_id"]; ?>').click(function() {
	$('#tab_details_<?php echo $product["order_product_id"]; ?>').slideToggle('slow');
});
</script>
<div id="tab_details_<?php echo $product['order_product_id']; ?>" class="more" style="display:none;">
    <table class="list_detail">
      <thead>
        <tr>
          <?php if (in_array('ol_order_order_id', $advpp_settings_ol_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_order_order_id; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_date_added', $advpp_settings_ol_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_order_date_added; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_inv_no', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_inv_no; ?></td> 
          <?php } ?>
          <?php if (in_array('ol_order_customer', $advpp_settings_ol_columns)) { ?>                           
          <td class="left" nowrap="nowrap"><?php echo $column_order_customer; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_email', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_email; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_customer_group', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_customer_group; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_shipping_method', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_shipping_method; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_payment_method', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_payment_method; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_status', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_status; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_store', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_order_store; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_currency', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_order_currency; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_price', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_price; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_quantity', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_quantity; ?></td>  
          <?php } ?>          
          <?php if (in_array('ol_prod_total_excl_vat', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_total_excl_vat; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_tax', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_tax; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_total_incl_vat', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_total_incl_vat; ?></td>
          <?php } ?>
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <?php if (in_array('ol_order_order_id', $advpp_settings_ol_columns)) { ?>
          <td class="left" nowrap="nowrap" style="background-color:#fff2d0;"><a><?php echo $product['order_prod_ord_id_link']; ?></a></td>
          <?php } ?>
          <?php if (in_array('ol_order_date_added', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_ord_date']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_inv_no', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_inv_no']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_customer', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_name']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_email', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_email']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_customer_group', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_group']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_shipping_method', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_shipping_method']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_payment_method', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_payment_method']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_status', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_status']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_store', $advpp_settings_ol_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['order_prod_store']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_order_currency', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $product['order_prod_currency']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_price', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_prod_price']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_quantity', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_prod_quantity']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_total_excl_vat', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'text-decoration:line-through;"' : '' ?> ><?php echo $product['order_prod_total_excl_vat']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_tax', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_prod_tax']; ?></td>
          <?php } ?>
          <?php if (in_array('ol_prod_total_incl_vat', $advpp_settings_ol_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="text-decoration:line-through;"' : '' ?> ><?php echo $product['order_prod_total_incl_vat']; ?></td>
          <?php } ?>
         </tr>
    </table> 
<?php } ?>    
<?php if (($filter_report == 'manufacturers' or $filter_report == 'categories' or $filter_report == 'products_options') && $filter_details == 'basic_details') { ?>
<?php if ($filter_report == 'products_options') { ?>
<script type="text/javascript">$(function(){ 
$('#show_details_<?php echo $product["option_details"]; ?>').click(function() {
		$('#tab_details_<?php echo $product["option_details"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $product['option_details']; ?>" class="more" style="display:none">
<?php } else { ?>
<script type="text/javascript">$(function(){ 
$('#show_details_<?php echo $product["order_product_id"]; ?>').click(function() {
		$('#tab_details_<?php echo $product["order_product_id"]; ?>').slideToggle('slow');
	});
});
</script>
<div id="tab_details_<?php echo $product['order_product_id']; ?>" class="more" style="display:none">
<?php } ?>
    <table class="list_detail">
      <thead>
        <tr>
          <?php if (in_array('pl_prod_order_id', $advpp_settings_pl_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_prod_order_id; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_date_added', $advpp_settings_pl_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_prod_date_added; ?></td>
          <?php } ?>     
          <?php if (in_array('pl_prod_inv_no', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_inv_no; ?></td>
          <?php } ?>               
          <?php if (in_array('pl_prod_id', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_id; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_sku', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_sku; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_model', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_model; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_name', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_name; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_option', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_option; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_attributes', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_attributes; ?></td>
          <?php } ?>
          <?php if ($filter_report == 'categories') { ?>          
          <?php if (in_array('pl_prod_manu', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_manu; ?></td>
          <?php } ?>
          <?php } ?>
          <?php if ($filter_report == 'manufacturers') { ?>          
          <?php if (in_array('pl_prod_category', $advpp_settings_pl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_prod_category; ?></td>
          <?php } ?>
          <?php } ?>                
          <?php if (in_array('pl_prod_currency', $advpp_settings_pl_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_currency; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_price', $advpp_settings_pl_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_price; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_quantity', $advpp_settings_pl_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_quantity; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_total_excl_vat', $advpp_settings_pl_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_total_excl_vat; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_tax', $advpp_settings_pl_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_tax; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_total_incl_vat', $advpp_settings_pl_columns)) { ?>          
          <td class="right" nowrap="nowrap"><?php echo $column_prod_total_incl_vat; ?></td>
          <?php } ?>
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <?php if (in_array('pl_prod_order_id', $advpp_settings_pl_columns)) { ?>
          <td class="left" nowrap="nowrap" style="background-color:#fff2d0;"><a><?php echo $product['product_ord_id_link']; ?></a></td>
          <?php } ?>
          <?php if (in_array('pl_prod_date_added', $advpp_settings_pl_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $product['product_ord_date']; ?></td>
          <?php } ?>     
          <?php if (in_array('pl_prod_inv_no', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_inv_no']; ?></td>
          <?php } ?>                   
          <?php if (in_array('pl_prod_id', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_prod_id_link']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_sku', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_sku']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_model', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_model']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_name', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_name']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_option', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_option']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_attributes', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_attributes']; ?></td>
          <?php } ?>
          <?php if ($filter_report == 'categories') { ?>          
          <?php if (in_array('pl_prod_manu', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_manu']; ?></td>
          <?php } ?>
          <?php } ?>           
          <?php if ($filter_report == 'manufacturers') { ?>          
          <?php if (in_array('pl_prod_category', $advpp_settings_pl_columns)) { ?>           
          <td class="left" nowrap="nowrap"><?php echo $product['product_category']; ?></td>
          <?php } ?>
          <?php } ?>          
          <?php if (in_array('pl_prod_currency', $advpp_settings_pl_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['product_currency']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_price', $advpp_settings_pl_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['product_price']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_quantity', $advpp_settings_pl_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['product_quantity']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_total_excl_vat', $advpp_settings_pl_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['product_total_excl_vat']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_tax', $advpp_settings_pl_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['product_tax']; ?></td>
          <?php } ?>
          <?php if (in_array('pl_prod_total_incl_vat', $advpp_settings_pl_columns)) { ?>           
          <td class="right" nowrap="nowrap"><?php echo $product['product_total_incl_vat']; ?></td>
          <?php } ?>                  
         </tr>       
    </table>
<?php } ?>
<?php if ($filter_details == 'basic_details') { ?>   
    <table class="list_detail">
      <thead>
        <tr>
          <?php if (in_array('cl_customer_order_id', $advpp_settings_cl_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_customer_order_id; ?></td>
          <?php } ?>
          <?php if (in_array('cl_customer_date_added', $advpp_settings_cl_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $column_customer_date_added; ?></td>
          <?php } ?>         
          <?php if (in_array('cl_customer_cust_id', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_customer_cust_id; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_name', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_name; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_company', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_company; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_address_1', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_address_1; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_address_2', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_address_2; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_city', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_city; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_zone', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_zone; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_postcode', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_postcode; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_country', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_billing_country; ?></td>
          <?php } ?>
          <?php if (in_array('cl_customer_telephone', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_customer_telephone; ?></td>
          <?php } ?>
          <?php if (in_array('cl_shipping_name', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_name; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_company', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_company; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_address_1', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_address_1; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_address_2', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_address_2; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_city', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_city; ?></td>
          <?php } ?>
          <?php if (in_array('cl_shipping_zone', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_zone; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_postcode', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_postcode; ?></td>
          <?php } ?>
          <?php if (in_array('cl_shipping_country', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $column_shipping_country; ?></td>
          <?php } ?>          
        </tr>
      </thead>
        <tr bgcolor="#FFFFFF">
          <?php if (in_array('cl_customer_order_id', $advpp_settings_cl_columns)) { ?>
          <td class="left" nowrap="nowrap" style="background-color:#fff2d0;"><a><?php echo $product['customer_ord_id_link']; ?></a></td>
          <?php } ?>
          <?php if (in_array('cl_customer_date_added', $advpp_settings_cl_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $product['customer_ord_date']; ?></td>
          <?php } ?>          
          <?php if (in_array('cl_customer_cust_id', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['customer_cust_id_link']; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_name', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_name']; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_company', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_company']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_address_1', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_address_1']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_address_2', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_address_2']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_city', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_city']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_zone', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_zone']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_billing_postcode', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_postcode']; ?></td>
          <?php } ?>
          <?php if (in_array('cl_billing_country', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['billing_country']; ?></td>
          <?php } ?>
          <?php if (in_array('cl_customer_telephone', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['customer_telephone']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_name', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_name']; ?></td>
          <?php } ?>
          <?php if (in_array('cl_shipping_company', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_company']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_address_1', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_address_1']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_address_2', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_address_2']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_city', $advpp_settings_cl_columns)) { ?>
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_city']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_zone', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_zone']; ?></td> 
          <?php } ?>
          <?php if (in_array('cl_shipping_postcode', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_postcode']; ?></td>
          <?php } ?>
          <?php if (in_array('cl_shipping_country', $advpp_settings_cl_columns)) { ?>          
          <td class="left" nowrap="nowrap"><?php echo $product['shipping_country']; ?></td>
          <?php } ?>           
         </tr>
    </table>
</div> 
<?php } ?>
</td>
</tr>
          <?php } ?>
		<?php if ($filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>            
        <tr>
        <td colspan="<?php echo $c; ?>"></td>
        </tr>
        <tr>
          <td <?php echo ($filter_report == 'all_products_with_without_orders') ? '' : 'colspan="2"' ?> class="right" style="background-color:#E5E5E5;"><strong><?php echo $text_filter_total; ?></strong></td>
          <?php if ($filter_report == 'manufacturers' or $filter_report == 'categories') { ?>
          <?php if ($filter_report == 'manufacturers') { ?>
          <?php if (in_array('cm_manufacturer', $advpp_settings_cm_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php } elseif ($filter_report == 'categories') { ?>
          <?php if (in_array('cm_category', $advpp_settings_cm_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php } ?>
          <?php if (in_array('cm_orders', $advpp_settings_cm_columns)) { ?>          
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('cm_customers', $advpp_settings_cm_columns)) { ?>          
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('cm_sold_quantity', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap" style="background-color:#FFC; color:#003A88;"><strong><?php echo $product['sold_quantity_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('cm_sold_percent', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap" style="background-color:#FFC; color:#003A88;"><strong><?php echo $product['sold_percent_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('cm_total_excl_vat', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['total_excl_vat_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('cm_total_tax', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['total_tax_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('cm_total_incl_vat', $advpp_settings_cm_columns)) { ?>          
          <td class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['total_incl_vat_total']; ?></strong></td>
          <?php } ?>               
          <?php if (in_array('cm_app', $advpp_settings_cm_columns)) { ?>            
          <td class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['app_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('cm_refunds', $advpp_settings_cm_columns)) { ?>            
          <td class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['refunds_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('cm_reward_points', $advpp_settings_cm_columns)) { ?>            
          <td class="right" nowrap="nowrap" style="background-color:#E7EFEF; color:#003A88;"><strong><?php echo $product['reward_points_total']; ?></strong></td>
          <?php } ?>   
          <?php } elseif ($filter_report == 'products_options') { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php if (in_array('mv_orders', $advpp_settings_mv_columns)) { ?>          
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_customers', $advpp_settings_mv_columns)) { ?>          
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <td class="right" nowrap="nowrap" style="background-color:#FFC; color:#003A88;"><strong><?php echo $product['sold_quantity_total']; ?></strong></td>
          <td class="right" nowrap="nowrap" style="background-color:#FFC; color:#003A88;"><strong><?php echo $product['sold_percent_total']; ?></strong></td>
		  <?php } elseif ($filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists' && $filter_report != 'products_options' && $filter_report != 'manufacturers' && $filter_report != 'categories') { ?>
          <?php if (in_array('mv_id', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_image', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_name', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_sku', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_upc', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_ean', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_jan', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_isbn', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_mpn', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_model', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_category', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_manufacturer', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>          
          <?php if (in_array('mv_attribute', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_status', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_location', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_tax_class', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_price', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_viewed', $advpp_settings_mv_columns)) { ?>
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>                                                                      
          <?php if (in_array('mv_stock_quantity', $advpp_settings_mv_columns)) { ?>          
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>   
          <?php if (in_array('mv_orders', $advpp_settings_mv_columns)) { ?>          
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>
          <?php if (in_array('mv_customers', $advpp_settings_mv_columns)) { ?>          
          <td style="background-color:#E5E5E5;"></td>
          <?php } ?>  
          <?php if (in_array('mv_sold_quantity', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#FFC; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#FFC; color:#003A88;"' ?> ><strong><?php echo $product['sold_quantity_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('mv_sold_percent', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#FFC; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#FFC; color:#003A88;"' ?> ><strong><?php echo $product['sold_percent_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('mv_total_excl_vat', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#E7EFEF; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#E7EFEF; color:#003A88;"' ?> ><strong><?php echo $product['total_excl_vat_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('mv_total_tax', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#E7EFEF; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#E7EFEF; color:#003A88;"' ?> ><strong><?php echo $product['total_tax_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('mv_total_incl_vat', $advpp_settings_mv_columns)) { ?>          
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#E7EFEF; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#E7EFEF; color:#003A88;"' ?> ><strong><?php echo $product['total_incl_vat_total']; ?></strong></td>
          <?php } ?>               
          <?php if (in_array('mv_app', $advpp_settings_mv_columns)) { ?>            
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#E7EFEF; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#E7EFEF; color:#003A88;"' ?> ><strong><?php echo $product['app_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('mv_refunds', $advpp_settings_mv_columns)) { ?>            
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#E7EFEF; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#E7EFEF; color:#003A88;"' ?> ><strong><?php echo $product['refunds_total']; ?></strong></td>
          <?php } ?>
          <?php if (in_array('mv_reward_points', $advpp_settings_mv_columns)) { ?>            
          <td class="right" nowrap="nowrap" <?php echo ($filter_report == 'products_abandoned_orders') ? 'style="background-color:#E7EFEF; color:#003A88; text-decoration:line-through;"' : 'style="background-color:#E7EFEF; color:#003A88;"' ?> ><strong><?php echo $product['reward_points_total']; ?></strong></td>
          <?php } ?>          
          <?php } ?>       
          <?php if ($filter_details == 'basic_details') { ?><td></td><?php } ?>                 
        </tr>   
		<?php } ?>                      
          <?php } else { ?>
          <tr>
          <td class="noresult" colspan="<?php echo $c; ?>"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>  
          </tbody>
      </table>
<?php } ?>
	<?php if ($filter_limit != '999999') { ?>
    </div> 
        <div>
          <div style="float:left;"><?php echo $pagination; ?></div>
          <div style="float:right;"><?php echo $results; ?></div>
        </div>          
    </div>
	<?php } ?>    
  </div>
</div>
<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.js"></script> 
<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="view/javascript/jquery/flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript">
function filter() {
	url = 'index.php?route=extension/report/adv_products&user_token=<?php echo $user_token; ?>';										 

	var filter_report = $('select[name=\'filter_report\']').val();
	if (filter_report) {
		url += '&filter_report=' + encodeURIComponent(filter_report);
	}
	
	var filter_group = $('select[name=\'filter_group\']').val();
	if (filter_group) {
		url += '&filter_group=' + encodeURIComponent(filter_group);
	}
	
	var filter_sort = $('select[name=\'filter_sort\']').val();
	if (filter_sort) {
		url += '&filter_sort=' + encodeURIComponent(filter_sort);
	}

	var filter_order = $('select[name=\'filter_order\']').val();
	if (filter_order) {
		url += '&filter_order=' + encodeURIComponent(filter_order);
	}
	
	var filter_details = $('select[name=\'filter_details\']').val();
	if (filter_details) {
		url += '&filter_details=' + encodeURIComponent(filter_details);
	}
	
	var filter_limit = $('select[name=\'filter_limit\']').val();
	if (filter_limit) {
		url += '&filter_limit=' + encodeURIComponent(filter_limit);
	}
	
	var filter_range = $('select[name=\'filter_range\']').val();
	if (filter_range) {
		url += '&filter_range=' + encodeURIComponent(filter_range);
	}
	
	var filter_date_start = $('input[name=\'filter_date_start\']').val();
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').val();
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}

	var filter_status_date_start = $('input[name=\'filter_status_date_start\']').val();
	if (filter_status_date_start) {
		url += '&filter_status_date_start=' + encodeURIComponent(filter_status_date_start);
	}

	var filter_status_date_end = $('input[name=\'filter_status_date_end\']').val();
	if (filter_status_date_end) {
		url += '&filter_status_date_end=' + encodeURIComponent(filter_status_date_end);
	}
	
	var order_status_id = [];
	$('#filter_order_status_id option:selected').each(function() {
		order_status_id.push($(this).val());
	});
	var filter_order_status_id = order_status_id.join(',');
	if (filter_order_status_id) {
		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
	}

	var filter_order_id_from = $('input[name=\'filter_order_id_from\']').val();
	if (filter_order_id_from) {
		url += '&filter_order_id_from=' + encodeURIComponent(filter_order_id_from);
	}

	var filter_order_id_to = $('input[name=\'filter_order_id_to\']').val();
	if (filter_order_id_to) {
		url += '&filter_order_id_to=' + encodeURIComponent(filter_order_id_to);
	}

	var filter_prod_price_min = $('input[name=\'filter_prod_price_min\']').val();
	if (filter_prod_price_min) {
		url += '&filter_prod_price_min=' + encodeURIComponent(filter_prod_price_min);
	}

	var filter_prod_price_max = $('input[name=\'filter_prod_price_max\']').val();
	if (filter_prod_price_max) {
		url += '&filter_prod_price_max=' + encodeURIComponent(filter_prod_price_max);
	}
	
	var store_id = [];
	$('#filter_store_id option:selected').each(function() {
		store_id.push($(this).val());
	});
	var filter_store_id = store_id.join(',');
	if (filter_store_id) {
		url += '&filter_store_id=' + encodeURIComponent(filter_store_id);
	}
	
	var currency = [];
	$('#filter_currency option:selected').each(function() {
		currency.push($(this).val());
	});
	var filter_currency = currency.join(',');
	if (filter_currency) {
		url += '&filter_currency=' + encodeURIComponent(filter_currency);
	}	
	
	var taxes = [];
	$('#filter_taxes option:selected').each(function() {
		taxes.push($(this).val());
	});
	var filter_taxes = taxes.join(',');
	if (filter_taxes) {
		url += '&filter_taxes=' + encodeURIComponent(filter_taxes);
	}

	var tax_classes = [];
	$('#filter_tax_classes option:selected').each(function() {
		tax_classes.push($(this).val());
	});
	var filter_tax_classes = tax_classes.join(',');
	if (filter_tax_classes) {
		url += '&filter_tax_classes=' + encodeURIComponent(filter_tax_classes);
	}

	var geo_zones = [];
	$('#filter_geo_zones option:selected').each(function() {
		geo_zones.push($(this).val());
	});
	var filter_geo_zones = geo_zones.join(',');
	if (filter_geo_zones) {
		url += '&filter_geo_zones=' + encodeURIComponent(filter_geo_zones);
	}
	
	var customer_group_id = [];
	$('#filter_customer_group_id option:selected').each(function() {
		customer_group_id.push($(this).val());
	});
	var filter_customer_group_id = customer_group_id.join(',');
	if (filter_customer_group_id) {
		url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
	}
	
	var filter_customer_name = $('input[name=\'filter_customer_name\']').val();
	if (filter_customer_name) {
		url += '&filter_customer_name=' + encodeURIComponent(filter_customer_name);
	}

	var filter_customer_email = $('input[name=\'filter_customer_email\']').val();
	if (filter_customer_email) {
		url += '&filter_customer_email=' + encodeURIComponent(filter_customer_email);
	}
	
	var filter_customer_telephone = $('input[name=\'filter_customer_telephone\']').val();
	if (filter_customer_telephone) {
		url += '&filter_customer_telephone=' + encodeURIComponent(filter_customer_telephone);
	}
	
	var filter_ip = $('input[name=\'filter_ip\']').val();
	if (filter_ip) {
		url += '&filter_ip=' + encodeURIComponent(filter_ip);
	}
	
	var filter_payment_company = $('input[name=\'filter_payment_company\']').val();
	if (filter_payment_company) {
		url += '&filter_payment_company=' + encodeURIComponent(filter_payment_company);
	}
	
	var filter_payment_address = $('input[name=\'filter_payment_address\']').val();
	if (filter_payment_address) {
		url += '&filter_payment_address=' + encodeURIComponent(filter_payment_address);
	}
	
	var filter_payment_city = $('input[name=\'filter_payment_city\']').val();
	if (filter_payment_city) {
		url += '&filter_payment_city=' + encodeURIComponent(filter_payment_city);
	}

	var filter_payment_zone = $('input[name=\'filter_payment_zone\']').val();
	if (filter_payment_zone) {
		url += '&filter_payment_zone=' + encodeURIComponent(filter_payment_zone);
	}
	
	var filter_payment_postcode = $('input[name=\'filter_payment_postcode\']').val();
	if (filter_payment_postcode) {
		url += '&filter_payment_postcode=' + encodeURIComponent(filter_payment_postcode);
	}
	
	var filter_payment_country = $('input[name=\'filter_payment_country\']').val();
	if (filter_payment_country) {
		url += '&filter_payment_country=' + encodeURIComponent(filter_payment_country);
	}
	
	var payment_method = [];
	$('#filter_payment_method option:selected').each(function() {
		payment_method.push($(this).val());
	});
	var filter_payment_method = payment_method.join(',');
	if (filter_payment_method) {
		url += '&filter_payment_method=' + encodeURIComponent(filter_payment_method);
	}

	var filter_shipping_company = $('input[name=\'filter_shipping_company\']').val();
	if (filter_shipping_company) {
		url += '&filter_shipping_company=' + encodeURIComponent(filter_shipping_company);
	}
	
	var filter_shipping_address = $('input[name=\'filter_shipping_address\']').val();
	if (filter_shipping_address) {
		url += '&filter_shipping_address=' + encodeURIComponent(filter_shipping_address);
	}
	
	var filter_shipping_city = $('input[name=\'filter_shipping_city\']').val();
	if (filter_shipping_city) {
		url += '&filter_shipping_city=' + encodeURIComponent(filter_shipping_city);
	}

	var filter_shipping_zone = $('input[name=\'filter_shipping_zone\']').val();
	if (filter_shipping_zone) {
		url += '&filter_shipping_zone=' + encodeURIComponent(filter_shipping_zone);
	}
	
	var filter_shipping_postcode = $('input[name=\'filter_shipping_postcode\']').val();
	if (filter_shipping_postcode) {
		url += '&filter_shipping_postcode=' + encodeURIComponent(filter_shipping_postcode);
	}
	
	var filter_shipping_country = $('input[name=\'filter_shipping_country\']').val();
	if (filter_shipping_country) {
		url += '&filter_shipping_country=' + encodeURIComponent(filter_shipping_country);
	}
	
	var shipping_method = [];
	$('#filter_shipping_method option:selected').each(function() {
		shipping_method.push($(this).val());
	});
	var filter_shipping_method = shipping_method.join(',');
	if (filter_shipping_method) {
		url += '&filter_shipping_method=' + encodeURIComponent(filter_shipping_method);
	}

	var category = [];
	$('#filter_category option:selected').each(function() {
		category.push($(this).val());
	});
	var filter_category = category.join(',');
	if (filter_category) {
		url += '&filter_category=' + encodeURIComponent(filter_category);
	}

	var manufacturer = [];
	$('#filter_manufacturer option:selected').each(function() {
		manufacturer.push($(this).val());
	});
	var filter_manufacturer = manufacturer.join(',');
	if (filter_manufacturer) {
		url += '&filter_manufacturer=' + encodeURIComponent(filter_manufacturer);
	}
	
	var filter_sku = $('input[name=\'filter_sku\']').val();
	if (filter_sku) {
		url += '&filter_sku=' + encodeURIComponent(filter_sku);
	}

	var filter_upc = $('input[name=\'filter_upc\']').val();
	if (filter_upc) {
		url += '&filter_upc=' + encodeURIComponent(filter_upc);
	}
	
	var filter_ean = $('input[name=\'filter_ean\']').val();
	if (filter_ean) {
		url += '&filter_ean=' + encodeURIComponent(filter_ean);
	}
	
	var filter_jan = $('input[name=\'filter_jan\']').val();
	if (filter_jan) {
		url += '&filter_jan=' + encodeURIComponent(filter_jan);
	}
	
	var filter_isbn = $('input[name=\'filter_isbn\']').val();
	if (filter_isbn) {
		url += '&filter_isbn=' + encodeURIComponent(filter_isbn);
	}
	
	var filter_mpn = $('input[name=\'filter_mpn\']').val();
	if (filter_mpn) {
		url += '&filter_mpn=' + encodeURIComponent(filter_mpn);
	}
	
	var filter_product_name = $('input[name=\'filter_product_name\']').val();
	if (filter_product_name) {
		url += '&filter_product_name=' + encodeURIComponent(filter_product_name);
	}
	
	var filter_model = $('input[name=\'filter_model\']').val();
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var option = [];
	$('#filter_option option:selected').each(function() {
		option.push($(this).val());
	});
	var filter_option = option.join(',');
	if (filter_option) {
		url += '&filter_option=' + encodeURIComponent(filter_option);
	}
	
	var attribute = [];
	$('#filter_attribute option:selected').each(function() {
		attribute.push($(this).val());
	});
	var filter_attribute = attribute.join(',');
	if (filter_attribute) {
		url += '&filter_attribute=' + encodeURIComponent(filter_attribute);
	}

	var product_statuses = [];
	$('#filter_product_status option:selected').each(function() {
		product_statuses.push($(this).val());
	});
	var filter_product_status = product_statuses.join(',');
	if (filter_product_status) {
		url += '&filter_product_status=' + encodeURIComponent(filter_product_status);
	}
	
	var locations = [];
	$('#filter_location option:selected').each(function() {
		locations.push($(this).val());
	});
	var filter_location = locations.join(',');
	if (filter_location) {
		url += '&filter_location=' + encodeURIComponent(filter_location);
	}

	var coupon_name = [];
	$('#filter_coupon_name option:selected').each(function() {
		coupon_name.push($(this).val());
	});
	var filter_coupon_name = coupon_name.join(',');
	if (filter_coupon_name) {
		url += '&filter_coupon_name=' + encodeURIComponent(filter_coupon_name);
	}

	var filter_coupon_code = $('input[name=\'filter_coupon_code\']').val();
	if (filter_coupon_code) {
		url += '&filter_coupon_code=' + encodeURIComponent(filter_coupon_code);
	}
	
	var filter_voucher_code = $('input[name=\'filter_voucher_code\']').val();
	if (filter_voucher_code) {
		url += '&filter_voucher_code=' + encodeURIComponent(filter_voucher_code);
	}

	var campaign_name = [];
	$('#filter_campaign_name option:selected').each(function() {
		campaign_name.push($(this).val());
	});
	var filter_campaign_name = campaign_name.join(',');
	if (filter_campaign_name) {
		url += '&filter_campaign_name=' + encodeURIComponent(filter_campaign_name);
	}

	var filter_campaign_code = $('input[name=\'filter_campaign_code\']').val();
	if (filter_campaign_code) {
		url += '&filter_campaign_code=' + encodeURIComponent(filter_campaign_code);
	}
	
	location = url;
}	
</script>  
<script type="text/javascript">
$(document).ready(function() {
		$('#filter_order_status_id').multiselect({
			checkboxName: 'order_status_id[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_status; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});		

	<?php if (in_array('store', $advpp_settings_filters)) { ?>
		$('#filter_store_id').multiselect({
			checkboxName: 'store_id[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_stores; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});		
	<?php } ?>

	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('currency', $advpp_settings_filters)) { ?>
		$('#filter_currency').multiselect({
			checkboxName: 'currency[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_currencies; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});
	<?php } ?>
	<?php } ?>

	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('tax', $advpp_settings_filters)) { ?>
		$('#filter_taxes').multiselect({
			checkboxName: 'taxes[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_taxes; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>
	<?php } ?>

	<?php if (in_array('tax_class', $advpp_settings_filters)) { ?>
		$('#filter_tax_classes').multiselect({
			checkboxName: 'tax_classes[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_tax_classes; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>

	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('geo_zone', $advpp_settings_filters)) { ?>
		$('#filter_geo_zones').multiselect({
			checkboxName: 'geo_zones[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_zones; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>
	<?php } ?>

	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('customer_group', $advpp_settings_filters)) { ?>
		$('#filter_customer_group_id').multiselect({
			checkboxName: 'customer_group_id[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_groups; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>
	<?php } ?>

	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('payment_method', $advpp_settings_filters)) { ?>
		$('#filter_payment_method').multiselect({
			checkboxName: 'payment_method[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_payment_methods; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>
	<?php } ?>

	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('shipping_method', $advpp_settings_filters)) { ?>
		$('#filter_shipping_method').multiselect({
			checkboxName: 'shipping_method[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_shipping_methods; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>
	<?php } ?>

	<?php if (in_array('category', $advpp_settings_filters)) { ?>
		$('#filter_category').multiselect({
			checkboxName: 'category[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_categories; ?>',
			numberDisplayed: 0,
			enableClickableOptGroups: true,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>

	<?php if (in_array('manufacturer', $advpp_settings_filters)) { ?>
		$('#filter_manufacturer').multiselect({
			checkboxName: 'manufacturer[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_manufacturers; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>
	
	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('option', $advpp_settings_filters)) { ?>
		$('#filter_option').multiselect({
			checkboxName: 'option[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_options; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>
	<?php } ?>

	<?php if (in_array('attribute', $advpp_settings_filters)) { ?>
		$('#filter_attribute').multiselect({
			checkboxName: 'attribute[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_attributes; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>

	<?php if (in_array('product_status', $advpp_settings_filters)) { ?>
		$('#filter_product_status').multiselect({
			checkboxName: 'product_statuses[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_status; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300

		});	
	<?php } ?>
	
	<?php if (in_array('location', $advpp_settings_filters)) { ?>
		$('#filter_location').multiselect({
			checkboxName: 'locations[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_locations; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});	
	<?php } ?>

	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('coupon_name', $advpp_settings_filters)) { ?>
		$('#filter_coupon_name').multiselect({
			checkboxName: 'coupon_name[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_coupon_names; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});		
	<?php } ?>
	<?php } ?>
	
	<?php if ($filter_report != 'all_products_with_without_orders' && $filter_report != 'products_without_orders' && $filter_report != 'products_shopping_carts' && $filter_report != 'products_wishlists') { ?>
	<?php if (in_array('campaign_name', $advpp_settings_filters)) { ?>
		$('#filter_campaign_name').multiselect({
			checkboxName: 'campaign_name[]',
			includeSelectAllOption: true,
			enableFiltering: true,
			selectAllText: '<?php echo $text_select_all; ?>',
			allSelectedText: '<?php echo $text_selected; ?>',
			nonSelectedText: '<?php echo $text_all_campaign_names; ?>',
			numberDisplayed: 0,
			disableIfEmpty: true,
			maxHeight: 300
		});		
	<?php } ?>
	<?php } ?>
});
</script>  
<script type="text/javascript">
function setCookie(name,value,days) {
	var expires;
	if (days) {
	var date = new Date();
	date.setTime(date.getTime()+(days*24*60*60*1000));
	expires = "; expires="+date.toGMTString();
	} else {
	expires = "";
	}
	document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
	var c = ca[i];
	while (c.charAt(0)==' ') c = c.substring(1,c.length);
	if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function deleteCookie(name) {
	setCookie(name,"",-1);
}

	var initCookies = function() {
		setCookie('show-pp-chart', 1, 365);
		$('.chart-switcher').removeClass('hide-chart');
		$(".chart_button").html('<span>Hide <?php echo $button_chart; ?></span>');
	};

	if (getCookie('show-pp-chart') == 1) {
		$('.chart-switcher').show();
		$(".chart_button").html('<span>Hide <?php echo $button_chart; ?></span>');
	} else if (getCookie('show-pp-chart') == 2) {
		$('.chart-switcher').hide();
		$(".chart_button").html('<span>Show <?php echo $button_chart; ?></span>');
	} else {
		$('.chart-switcher').show();
		$(".chart_button").html('<span>Hide <?php echo $button_chart; ?></span>');
	}
	
	$(document).on('click', '.chart-button', function(e) {
		e.preventDefault();
		if (getCookie('show-pp-chart') == 1) {
			$('.chart-switcher').hide();
			setCookie('show-pp-chart', 2, 365);
			$(".chart_button").html('<span>Show <?php echo $button_chart; ?></span>');
		} else if (getCookie('show-pp-chart') == 2) {
			$('.chart-switcher').show();
			setCookie('show-pp-chart', 1, 365);
			$(".chart_button").html('<span>Hide <?php echo $button_chart; ?></span>');
		} else {
			$('.chart-switcher').hide();
			setCookie('show-pp-chart', 2, 365);
			$(".chart_button").html('<span>Show <?php echo $button_chart; ?></span>');
		}
	});
	
	var initCookies = function() {
		setCookie('show-pp-filters', 1, 365);
		$('.filters-switcher').removeClass('hide-filters');
		$(".filters_button").html('<span>Hide <?php echo $button_filters; ?></span>');
	};
	
	if (getCookie('show-pp-filters') == 1) {
		$('.filters-switcher').show();
		$(".filters_button").html('<span>Hide <?php echo $button_filters; ?></span>');
	} else if (getCookie('show-pp-filters') == 2) {
		$('.filters-switcher').hide();
		$(".filters_button").html('<span>Show <?php echo $button_filters; ?></span>');
	} else {
		$('.filters-switcher').show();
		$(".filters_button").html('<span>Hide <?php echo $button_filters; ?></span>');
	}
	
	$(document).on('click', '.filters-button', function(e) {
		e.preventDefault();
		if (getCookie('show-pp-filters') == 1) {
			$('.filters-switcher').hide();
			setCookie('show-pp-filters', 2, 365);
			$(".filters_button").html('<span>Show <?php echo $button_filters; ?></span>');
		} else if (getCookie('show-pp-filters') == 2) {
			$('.filters-switcher').show();
			setCookie('show-pp-filters', 1, 365);
			$(".filters_button").html('<span>Hide <?php echo $button_filters; ?></span>');
		} else {
			$('.filters-switcher').hide();
			setCookie('show-pp-filters', 2, 365);
			$(".filters_button").html('<span>Show <?php echo $button_filters; ?></span>');
		}
	});		
</script> 
<script type="text/javascript"><!--
$('input[name=\'filter_customer_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_customer_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_name'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_customer_name\']').val(item['label']);
	}
});

$('input[name=\'filter_customer_email\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_customer_email=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_email'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_customer_email\']').val(item['label']);
	}
});

$('input[name=\'filter_customer_telephone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_customer_telephone=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_telephone'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_customer_telephone\']').val(item['label']);
	}
});

$('input[name=\'filter_ip\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_ip=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['cust_ip'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_ip\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_company\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_payment_company=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_company'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_company\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_address\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_payment_address=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_address'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_address\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_city\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_payment_city=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_city'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_city\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_zone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_payment_zone=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_zone'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_zone\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_postcode\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_payment_postcode=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_postcode'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_postcode\']').val(item['label']);
	}
});

$('input[name=\'filter_payment_country\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_payment_country=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['payment_country'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_payment_country\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_company\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_shipping_company=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_company'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_company\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_address\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_shipping_address=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_address'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_address\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_city\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_shipping_city=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_city'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_city\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_zone\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_shipping_zone=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_zone'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_zone\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_postcode\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_shipping_postcode=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_postcode'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_postcode\']').val(item['label']);
	}
});

$('input[name=\'filter_shipping_country\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/customer_autocomplete&user_token=<?php echo $user_token; ?>&filter_shipping_country=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['shipping_country'],
						value: item['customer_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_shipping_country\']').val(item['label']);
	}
});

$('input[name=\'filter_sku\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_sku=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_sku'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_sku\']').val(item['label']);
	}
});

$('input[name=\'filter_upc\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_upc=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_upc'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_upc\']').val(item['label']);
	}
});

$('input[name=\'filter_ean\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_ean=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_ean'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_ean\']').val(item['label']);
	}
});

$('input[name=\'filter_jan\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_jan=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_jan'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_jan\']').val(item['label']);
	}
});

$('input[name=\'filter_isbn\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_isbn=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_isbn'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_isbn\']').val(item['label']);
	}
});

$('input[name=\'filter_mpn\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_mpn=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_mpn'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_mpn\']').val(item['label']);
	}
});

$('input[name=\'filter_product_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_product_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_name'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_product_name\']').val(item['label']);
	}
});

$('input[name=\'filter_model\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/product_autocomplete&user_token=<?php echo $user_token; ?>&filter_model=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['prod_model'],
						value: item['product_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_model\']').val(item['label']);
	}
});

$('input[name=\'filter_coupon_code\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/coupon_autocomplete&user_token=<?php echo $user_token; ?>&filter_coupon_code=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['coupon_code'],
						value: item['coupon_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_coupon_code\']').val(item['label']);
	}
});

$('input[name=\'filter_voucher_code\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/voucher_autocomplete&user_token=<?php echo $user_token; ?>&filter_voucher_code=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['voucher_code'],
						value: item['voucher_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_voucher_code\']').val(item['label']);
	}
});

$('input[name=\'filter_campaign_code\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/report/adv_products/campaign_autocomplete&user_token=<?php echo $user_token; ?>&filter_campaign_code=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item['campaign_code'],
						value: item['marketing_id']
					}
				}));
			}
		});
	}, 
	'select': function(item) {
		$('input[name=\'filter_campaign_code\']').val(item['label']);
	}
});
//--></script> 
<script type="text/javascript"><!--
$('#date-start').datetimepicker({
	pickTime: false
});
$('#date-end').datetimepicker({
	pickTime: false
});
$('#status-date-start').datetimepicker({
	pickTime: false
});
$('#status-date-end').datetimepicker({
	pickTime: false
});
$('.select').selectpicker();
//--></script>
<script type="text/javascript"><!--
$('#save_settings').on('click', function(){
	$.ajax ({
		url: 'index.php?route=extension/report/adv_products/settings&user_token=<?php echo $user_token; ?>',		
		type: 'post',
		data: $('#settings input[type=\'text\'], #settings input[type=\'hidden\'], #settings input[type=\'radio\']:checked, #settings input[type=\'checkbox\']:checked, #settings select'),
		dataType: 'json',
    	beforeSend: function() {
			$('.alert').remove();
			$('#save_settings').button('loading');
		},  
		complete: function() {
				$('#save_settings').button('reset');
		},          
		success: function(json) {
			if (json['error']) {
				$('#settings').animate({scrollTop:0});				
				$('#settings .modal-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				$(".alert-danger").show(0).delay(1500).fadeOut(2500);
			}
			if (json['success']) {
				$('#settings').animate({scrollTop:0});				
				$('#settings .modal-body').prepend('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
				location=('<?php echo $url; ?>').replace(/&amp;/g, '&');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#save_report').on('click', function(){
	$.ajax ({
		url: 'index.php?route=extension/report/adv_products/load_save_report&user_token=<?php echo $user_token; ?>',		
		type: 'post',
		data: $('#load_save input[type=\'text\'], #load_save textarea'),
		dataType: 'json',
    	beforeSend: function() {
			$('.alert').remove();
			$('#save_report').button('loading');			
		},  
		complete: function() {
				$('#save_report').button('reset');			
		},          
		success: function(json) {
			if (json['error']) {
				$('#load_save').animate({scrollTop:0});				
				$('#load_save .modal-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');				
				$(".alert-danger").show(0).delay(1500).fadeOut(2500);
			}
			if (json['success']) {
				$('#load_save').animate({scrollTop:0});				
				$('#load_save .modal-body').prepend('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');	
				location=('<?php echo $url; ?>').replace(/&amp;/g, '&');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

var adv_load_save_reports_row = <?php echo $adv_load_save_reports_row; ?>;
function addSaveReport() {
	html  = '<tbody id="adv_load_save_reports_row' + adv_load_save_reports_row + '">';
	html += '<tr>';
	html += '<td width="5%"></td>';	
	html += '<td width="45%" class="text-left"><input type="text" name="advpp_load_save_report[' + adv_load_save_reports_row + '][save_report_title]" placeholder="<?php echo $text_report_title; ?>" value="" class="form-control" style="background-color:#f7e9e3;" /></td>';
	html += '<td width="40%" class="text-left"><textarea readonly name="advpp_load_save_report[' + adv_load_save_reports_row + '][save_report_link]" class="form-control"><?php echo $save_report_link; ?></textarea></td>';
	html += '<td width="10%"></td>';
	html += '</tr>';
	html += '</tbody>';

	$('#adv_load_save > tfoot').before(html);

	adv_load_save_reports_row++;
}

var adv_cron_settings_row = <?php echo $adv_cron_settings_row; ?>;
function addCron() {
	html  = '<tbody id="adv_cron_settings_row' + adv_cron_settings_row + '">';
	html += '<tr>';
	html += '<td width="45%" class="text-left">';
	html += '<input type="hidden" id="cron_id_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_id]" value="" />';
	html += '<input type="hidden" id="cron_report_type_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_report_type]" value="" />';
	html += '<input type="hidden" id="cron_export_type_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_export_type]" value="" />';
	html += '<input type="hidden" id="cron_export_logo_criteria_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_export_logo_criteria]" value="" />';
	html += '<input type="hidden" id="cron_export_csv_delimiter_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_export_csv_delimiter]" value="" />';
	html += '<input type="hidden" id="cron_export_file_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_export_file]" value="" />';
	html += '<input type="hidden" id="cron_file_save_path_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_file_save_path]" value="" />';
	html += '<input type="hidden" id="cron_file_name_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_file_name]" value="" />';
	html += '<input type="hidden" id="cron_email_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_email]" value="" />';
	html += '<input type="hidden" id="cron_user_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_user]" value="" />';
	html += '<input type="hidden" id="cron_pass_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_pass]" value="" />';
	html += '<input type="hidden" id="cron_token_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_token]" value="" />';
	html += '<input type="hidden" id="cron_user_id_save" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_user_id]" value="" />';
	
	html += '<input type="hidden" id="cron_filter_report" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_report]" value="" />';
	html += '<input type="hidden" id="cron_filter_details" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_details]" value="" />';
	html += '<input type="hidden" id="cron_filter_group" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_group]" value="" />';
	html += '<input type="hidden" id="cron_filter_sort" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_sort]" value="" />';
	html += '<input type="hidden" id="cron_filter_order" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_order]" value="" />';
	html += '<input type="hidden" id="cron_filter_limit" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_limit]" value="" />';
	
	html += '<input type="hidden" id="cron_filter_range" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_range]" value="" />';
	html += '<input type="hidden" id="cron_date_start" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_date_start]" value="" />';
	html += '<input type="hidden" id="cron_date_end" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_date_end]" value="" />';
	html += '<input type="hidden" id="cron_filter_order_status_id" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_order_status_id]" value="" />';
	html += '<input type="hidden" id="cron_status_date_start" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_status_date_start]" value="" />';
	html += '<input type="hidden" id="cron_status_date_end" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_status_date_end]" value="" />';
	html += '<input type="hidden" id="cron_filter_order_id_from" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_order_id_from]" value="" />';
	html += '<input type="hidden" id="cron_filter_order_id_to" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_order_id_to]" value="" />';
	html += '<input type="hidden" id="cron_filter_prod_price_min" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_prod_price_min]" value="" />';
	html += '<input type="hidden" id="cron_filter_prod_price_max" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_prod_price_max]" value="" />';
	html += '<input type="hidden" id="cron_filter_store_id" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_store_id]" value="" />';
	html += '<input type="hidden" id="cron_filter_currency" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_currency]" value="" />';
	html += '<input type="hidden" id="cron_filter_taxes" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_taxes]" value="" />';
	html += '<input type="hidden" id="cron_filter_tax_classes" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_tax_classes]" value="" />';
	html += '<input type="hidden" id="cron_filter_geo_zones" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_geo_zones]" value="" />';
	html += '<input type="hidden" id="cron_filter_customer_group_id" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_customer_group_id]" value="" />';
	html += '<input type="hidden" id="cron_filter_customer_name" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_customer_name]" value="" />';
	html += '<input type="hidden" id="cron_filter_customer_email" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_customer_email]" value="" />';
	html += '<input type="hidden" id="cron_filter_customer_telephone" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_customer_telephone]" value="" />';
	html += '<input type="hidden" id="cron_filter_ip" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_ip]" value="" />';
	html += '<input type="hidden" id="cron_filter_payment_company" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_payment_company]" value="" />';
	html += '<input type="hidden" id="cron_filter_payment_address" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_payment_address]" value="" />';
	html += '<input type="hidden" id="cron_filter_payment_city" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_payment_city]" value="" />';
	html += '<input type="hidden" id="cron_filter_payment_zone" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_payment_zone]" value="" />';
	html += '<input type="hidden" id="cron_filter_payment_postcode" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_payment_postcode]" value="" />';
	html += '<input type="hidden" id="cron_filter_payment_country" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_payment_country]" value="" />';
	html += '<input type="hidden" id="cron_filter_payment_method" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_payment_method]" value="" />';
	html += '<input type="hidden" id="cron_filter_shipping_company" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_shipping_company]" value="" />';
	html += '<input type="hidden" id="cron_filter_shipping_address" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_shipping_address]" value="" />';
	html += '<input type="hidden" id="cron_filter_shipping_city" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_shipping_city]" value="" />';
	html += '<input type="hidden" id="cron_filter_shipping_zone" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_shipping_zone]" value="" />';
	html += '<input type="hidden" id="cron_filter_shipping_postcode" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_shipping_postcode]" value="" />';
	html += '<input type="hidden" id="cron_filter_shipping_country" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_shipping_country]" value="" />';
	html += '<input type="hidden" id="cron_filter_shipping_method" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_shipping_method]" value="" />';
	html += '<input type="hidden" id="cron_filter_category" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_category]" value="" />';
	html += '<input type="hidden" id="cron_filter_manufacturer" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_manufacturer]" value="" />';
	html += '<input type="hidden" id="cron_filter_sku" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_sku]" value="" />';
	html += '<input type="hidden" id="cron_filter_upc" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_upc]" value="" />';
	html += '<input type="hidden" id="cron_filter_ean" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_ean]" value="" />';
	html += '<input type="hidden" id="cron_filter_jan" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_jan]" value="" />';
	html += '<input type="hidden" id="cron_filter_isbn" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_isbn]" value="" />';
	html += '<input type="hidden" id="cron_filter_mpn" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_mpn]" value="" />';
	html += '<input type="hidden" id="cron_filter_product_name" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_product_name]" value="" />';
	html += '<input type="hidden" id="cron_filter_model" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_model]" value="" />';
	html += '<input type="hidden" id="cron_filter_option" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_option]" value="" />';
	html += '<input type="hidden" id="cron_filter_attribute" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_attribute]" value="" />';
	html += '<input type="hidden" id="cron_filter_product_status" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_product_status]" value="" />';
	html += '<input type="hidden" id="cron_filter_location" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_location]" value="" />';
	html += '<input type="hidden" id="cron_filter_coupon_name" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_coupon_name]" value="" />';
	html += '<input type="hidden" id="cron_filter_coupon_code" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_coupon_code]" value="" />';
	html += '<input type="hidden" id="cron_filter_voucher_code" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_voucher_code]" value="" />';
	html += '<input type="hidden" id="cron_filter_campaign_name" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_campaign_name]" value="" />';
	html += '<input type="hidden" id="cron_filter_campaign_code" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_filter_campaign_code]" value="" />';
	
	html += '<input type="text" name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_title]" placeholder="<?php echo $text_cron_title; ?>" value="" class="form-control" style="background-color:#f7e9e3;" /></td>';
	html += '<td width="45%" class="text-left"><textarea id="cron_command" readonly name="advpp_cron_setting[' + adv_cron_settings_row + '][cron_command]" class="form-control"></textarea></td>';
	html += '<td width="10%"></td>';
	html += '</tr>';
	html += '</tbody>';

	$('#adv_cron_setting > tfoot').before(html);

	adv_cron_settings_row++;
}

$('#export_report').on('click', function(){
	var url_exp ='index.php?route=extension/report/adv_products/export&user_token=<?php echo $user_token; ?>';

	var report_type = $('select[name=\'report_type\']').val();
	if (report_type) {
		url_exp += '&report_type=' + encodeURIComponent(report_type);
	}
	
	var export_type = $('select[name=\'export_type\']').val();
	if (export_type) {
		url_exp += '&export_type=' + encodeURIComponent(export_type);
	}
	
	var export_logo_criteria = $('select[name=\'export_logo_criteria\']').val();
	if (export_logo_criteria) {
		url_exp += '&export_logo_criteria=' + encodeURIComponent(export_logo_criteria);
	}
	
	var export_csv_delimiter = $('select[name=\'export_csv_delimiter\']').val();
	if (export_csv_delimiter) {
		url_exp += '&export_csv_delimiter=' + encodeURIComponent(export_csv_delimiter);
	}
	
	$.ajax ({
		url: 'index.php?route=extension/report/adv_products/export_validate&user_token=<?php echo $user_token; ?>',
		type: 'post',
		data: $('#export input[type=\'text\'], #export input[type=\'hidden\'], #export input[type=\'radio\']:checked, #export input[type=\'checkbox\']:checked, #export select'),
		dataType: 'json',
    	beforeSend: function() {
			$('.alert').remove();
			$('#export_report').button('loading');
		},  
		complete: function() {
			$('#export_report').button('reset');
		},          
		success: function(json) {
			if (json['error']) {
					$('#export .modal-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					$(".alert-danger").show(0).delay(2000).fadeOut(2000);
			} else {
				location = url_exp;
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#save_cron').on('click', function(){
	$('#cron_report_type_save').val($('#cron_report_type').val());
	$('#cron_export_type_save').val($('#cron_export_type').val());
	$('#cron_export_logo_criteria_save').val($('#cron_export_logo_criteria').val());
	$('#cron_export_csv_delimiter_save').val($('#cron_export_csv_delimiter').val());
	$('#cron_export_file_save').val($('#cron_export_file').val());
	$('#cron_file_save_path_save').val($('#cron_file_save_path').val());
	$('#cron_file_name_save').val($('#cron_file_name').val());
	$('#cron_email_save').val($('#cron_email').val());
	$('#cron_user_save').val($('#cron_user').val());
	$('#cron_pass_save').val(btoa(btoa($("#cron_pass").val())));
	$('#cron_token_save').val($('#cron_token').val());
	$('#cron_user_id_save').val($('#cron_user_id').val());
	
	$('#cron_filter_report').val($('#filter_report').val());
	$('#cron_filter_details').val($('#filter_details').val());
	$('#cron_filter_group').val($('#filter_group').val());
	$('#cron_filter_sort').val($('#filter_sort').val());
	$('#cron_filter_order').val($('#filter_order').val());
	$('#cron_filter_limit').val($('#filter_limit').val());
	
	$('#cron_filter_range').val($('#filter_range').val());
	$('#cron_date_start').val($('#date-start').val());
	$('#cron_date_end').val($('#date-end').val());
	if ($("#filter_order_status_id").val() != null) { $('#cron_filter_order_status_id').val($("#filter_order_status_id").val().join(',')) };
	$('#cron_status_date_start').val($('#status-date-start').val());
	$('#cron_status_date_end').val($('#status-date-end').val());
	$('#cron_filter_order_id_from').val($('#filter_order_id_from').val());
	$('#cron_filter_order_id_to').val($('#filter_order_id_to').val());
	$('#cron_filter_prod_price_min').val($('#filter_prod_price_min').val());
	$('#cron_filter_prod_price_max').val($('#filter_prod_price_max').val());
	if ($("#filter_store_id").val() != null) { $('#cron_filter_store_id').val($("#filter_store_id").val().join(',')) };
	if ($("#filter_currency").val() != null) { $('#cron_filter_currency').val($("#filter_currency").val().join(',')) };
	if ($("#filter_taxes").val() != null) { $('#cron_filter_taxes').val($("#filter_taxes").val().join(',')) };
	if ($("#filter_tax_classes").val() != null) { $('#cron_filter_tax_classes').val($("#filter_tax_classes").val().join(',')) };
	if ($("#filter_geo_zones").val() != null) { $('#cron_filter_geo_zones').val($("#filter_geo_zones").val().join(',')) };
	if ($("#filter_customer_group_id").val() != null) { $('#cron_filter_customer_group_id').val($("#filter_customer_group_id").val().join(',')) };
	$('#cron_filter_customer_name').val($('#filter_customer_name').val());
	$('#cron_filter_customer_email').val($('#filter_customer_email').val());
	$('#cron_filter_customer_telephone').val($('#filter_customer_telephone').val());
	$('#cron_filter_ip').val($('#filter_ip').val());
	$('#cron_filter_payment_company').val($('#filter_payment_company').val());
	$('#cron_filter_payment_address').val($('#filter_payment_address').val());
	$('#cron_filter_payment_city').val($('#filter_payment_city').val());
	$('#cron_filter_payment_zone').val($('#filter_payment_zone').val());
	$('#cron_filter_payment_postcode').val($('#filter_payment_postcode').val());
	$('#cron_filter_payment_country').val($('#filter_payment_country').val());
	if ($("#filter_payment_method").val() != null) { $('#cron_filter_payment_method').val($("#filter_payment_method").val().join(',')) };
	$('#cron_filter_shipping_company').val($('#filter_shipping_company').val());
	$('#cron_filter_shipping_address').val($('#filter_shipping_address').val());
	$('#cron_filter_shipping_city').val($('#filter_shipping_city').val());
	$('#cron_filter_shipping_zone').val($('#filter_shipping_zone').val());
	$('#cron_filter_shipping_postcode').val($('#filter_shipping_postcode').val());
	$('#cron_filter_shipping_country').val($('#filter_shipping_country').val());
	if ($("#filter_shipping_method").val() != null) { $('#cron_filter_shipping_method').val($("#filter_shipping_method").val().join(',')) };
	if ($("#filter_category").val() != null) { $('#cron_filter_category').val($("#filter_category").val().join(',')) };
	if ($("#filter_manufacturer").val() != null) { $('#cron_filter_manufacturer').val($("#filter_manufacturer").val().join(',')) };
	$('#cron_filter_sku').val($('#filter_sku').val());
	$('#cron_filter_upc').val($('#filter_upc').val());
	$('#cron_filter_ean').val($('#filter_ean').val());
	$('#cron_filter_jan').val($('#filter_jan').val());
	$('#cron_filter_isbn').val($('#filter_isbn').val());
	$('#cron_filter_mpn').val($('#filter_mpn').val());
	$('#cron_filter_product_name').val($('#filter_product_name').val());
	$('#cron_filter_model').val($('#filter_model').val());
	if ($("#filter_option").val() != null) { $('#cron_filter_option').val($("#filter_option").val().join(',')) };
	if ($("#filter_attribute").val() != null) { $('#cron_filter_attribute').val($("#filter_attribute").val().join(',')) };
	if ($("#filter_product_status").val() != null) { $('#cron_filter_product_status').val($("#filter_product_status").val().join(',')) };
	if ($("#filter_location").val() != null) { $('#cron_filter_location').val($("#filter_location").val().join(',')) };
	if ($("#filter_coupon_name").val() != null) { $('#cron_filter_coupon_name').val($("#filter_coupon_name").val().join(',')) };
	$('#cron_filter_coupon_code').val($('#filter_coupon_code').val());
	$('#cron_filter_voucher_code').val($('#filter_voucher_code').val());
	if ($("#filter_campaign_name").val() != null) { $('#cron_filter_campaign_name').val($("#filter_campaign_name").val().join(',')) };
	$('#cron_filter_campaign_code').val($('#filter_campaign_code').val());
	
	$.ajax ({
		url: 'index.php?route=extension/report/adv_products/cron&user_token=<?php echo $user_token; ?>',		
		type: 'post',
		data: $('#cron input[type=\'text\'], #cron input[type=\'password\'], #cron input[type=\'hidden\'], #cron textarea, #cron select'),
		dataType: 'json',
    	beforeSend: function() {
			$('.alert').remove();
			$('#save_cron').button('loading');			
		},  
		complete: function() {
				$('#save_cron').button('reset');			
		},          
		success: function(json) {
			if (json['error']) {
				$('#cron').animate({scrollTop:0});				
				$('#cron .modal-body').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');				
				$(".alert-danger").show(0).delay(1500).fadeOut(2500);
			}
			if (json['success']) {
				$('#cron').animate({scrollTop:0});				
				$('#cron .modal-body').prepend('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> ' + json['success'] + '<button type="button" class="close" data-dismiss="alert">&times;</button></div>');	
				location=('<?php echo $url; ?>').replace(/&amp;/g, '&');
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

function cron_id_gen() {
	var text = "";
	var arr = "123456789";
	for(var i=0; i<5; i++) { text += arr.charAt(Math.floor(Math.random() * arr.length)); }
	$("#cron_id_save").val(text);
}

function cron_token_gen() {
	var text = "";
	var arr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	for(var i=0; i<25; i++) { text += arr.charAt(Math.floor(Math.random() * arr.length)); }
	$("#cron_token").val(text);
}

function cron_command() {
	var link = window.location+'';
	link = link.split("index.php");
	link = link[0] + "index.php?route=common/login";
	var user = $("#cron_user_id").val();	
	var id = $("#cron_id_save").val();	
	var token = $("#cron_token").val();
	var addr = link+"&cron_route="+"extension/report/adv_products"+"&user_id="+user+"&cron_token="+token+"&cron_id="+id+"&cron=1";
	$("#cpanel").html('wget -q "'+addr+'"')
	$("#cron_command").html('wget -q "'+addr+'"')
}

function selectText(containerid) {
	var node = document.getElementById(containerid);
	if (document.selection) {
		var range = document.body.createTextRange();
		range.moveToElementText(node);
		range.select();
	} else if (window.getSelection) {
		var range = document.createRange();
		range.selectNodeContents(node);
		window.getSelection().removeAllRanges();
		window.getSelection().addRange(range);
	}
}
//--></script>
<script type="text/javascript"><!--
function checkValidOptions() {
  var filter_report = document.getElementById('filter_report');
  var filter_details = document.getElementById('filter_details');
    if (filter_report.options[0].selected === true || filter_report.options[5].selected === true || filter_report.options[11].selected === true || filter_report.options[12].selected === true) {
        document.getElementById("filter_details").options[0].disabled = true;		
        document.getElementById("filter_details").options[1].disabled = true;
        document.getElementById("filter_details").options[2].disabled = true;
		document.getElementById("filter_details").options[3].disabled = true;
		
        document.getElementById("filter_group").options[0].disabled = true;
        document.getElementById("filter_group").options[1].disabled = true;		
        document.getElementById("filter_group").options[2].disabled = true;
        document.getElementById("filter_group").options[3].disabled = true;
		document.getElementById("filter_group").options[4].disabled = true;
		document.getElementById("filter_group").options[5].disabled = true;
		document.getElementById("filter_group").options[6].disabled = true;
	}
    if (filter_report.options[0].selected === true || filter_report.options[1].selected === true || filter_report.options[2].selected === true || filter_report.options[3].selected === true || filter_report.options[4].selected === true || filter_report.options[8].selected === true) {	
		<?php if ($filter_report == 'products_shopping_carts') { ?>
		<?php if (in_array('scw_cart_quantity', $advpp_settings_scw_columns)) { ?>document.getElementById("cart_quantity").disabled = true;<?php } ?>
		<?php } ?>			
		<?php if ($filter_report == 'products_wishlists') { ?>
		<?php if (in_array('scw_wishlist_quantity', $advpp_settings_scw_columns)) { ?>document.getElementById("wishlist_quantity").disabled = true;<?php } ?>
		<?php } ?>		
	}
    if (filter_report.options[6].selected === true || filter_report.options[7].selected === true || filter_details.options[2].selected === true || filter_details.options[3].selected === true) {
		<?php if ($filter_report == 'categories') { ?>
		<?php if (in_array('cm_category', $advpp_settings_cm_columns)) { ?>document.getElementById("category").disabled = true;<?php } ?>
		<?php } ?>			
		<?php if ($filter_report == 'manufacturers') { ?>
		<?php if (in_array('cm_manufacturer', $advpp_settings_cm_columns)) { ?>document.getElementById("manufacturer").disabled = true;<?php } ?>	
		<?php } ?>
		<?php if ($filter_report == 'products_wishlists' or $filter_report == 'products_shopping_carts') { ?>
		<?php if (in_array('scw_id', $advpp_settings_scw_columns)) { ?>document.getElementById("id").disabled = true;<?php } ?>
		<?php if (in_array('scw_sku', $advpp_settings_scw_columns)) { ?>document.getElementById("sku").disabled = true;<?php } ?>
		<?php if (in_array('scw_upc', $advpp_settings_scw_columns)) { ?>document.getElementById("upc").disabled = true;<?php } ?>
		<?php if (in_array('scw_ean', $advpp_settings_scw_columns)) { ?>document.getElementById("ean").disabled = true;<?php } ?>
		<?php if (in_array('scw_jan', $advpp_settings_scw_columns)) { ?>document.getElementById("jan").disabled = true;<?php } ?>
		<?php if (in_array('scw_isbn', $advpp_settings_scw_columns)) { ?>document.getElementById("isbn").disabled = true;<?php } ?>
		<?php if (in_array('scw_mpn', $advpp_settings_scw_columns)) { ?>document.getElementById("mpn").disabled = true;<?php } ?>
		<?php if (in_array('scw_name', $advpp_settings_scw_columns)) { ?>document.getElementById("name").disabled = true;<?php } ?>
		<?php if (in_array('scw_model', $advpp_settings_scw_columns)) { ?>document.getElementById("model").disabled = true;<?php } ?>
		<?php if (in_array('scw_category', $advpp_settings_scw_columns)) { ?>document.getElementById("category").disabled = true;<?php } ?>
		<?php if (in_array('scw_manufacturer', $advpp_settings_scw_columns)) { ?>document.getElementById("manufacturer").disabled = true;<?php } ?>
		<?php if (in_array('scw_attribute', $advpp_settings_scw_columns)) { ?>document.getElementById("attribute").disabled = true;<?php } ?>
		<?php if (in_array('scw_status', $advpp_settings_scw_columns)) { ?>document.getElementById("status").disabled = true;<?php } ?>
		<?php if (in_array('scw_location', $advpp_settings_scw_columns)) { ?>document.getElementById("location").disabled = true;<?php } ?>
		<?php if (in_array('scw_tax_class', $advpp_settings_scw_columns)) { ?>document.getElementById("tax_class").disabled = true;<?php } ?>
		<?php if (in_array('scw_price', $advpp_settings_scw_columns)) { ?>document.getElementById("price").disabled = true;<?php } ?>
		<?php if (in_array('scw_viewed', $advpp_settings_scw_columns)) { ?>document.getElementById("viewed").disabled = true;<?php } ?>
		<?php if (in_array('scw_stock_quantity', $advpp_settings_scw_columns)) { ?>document.getElementById("stock_quantity").disabled = true;<?php } ?>		
		<?php if ($filter_report == 'products_shopping_carts') { ?>
		<?php if (in_array('scw_cart_quantity', $advpp_settings_scw_columns)) { ?>document.getElementById("cart_quantity").disabled = true;<?php } ?>
		<?php } ?>
		<?php if ($filter_report == 'products_wishlists') { ?>
		<?php if (in_array('scw_wishlist_quantity', $advpp_settings_scw_columns)) { ?>document.getElementById("wishlist_quantity").disabled = true;<?php } ?>
		<?php } ?>		
		<?php } ?>
		<?php if ($filter_report == 'products_without_orders') { ?>
		<?php if (in_array('pnp_id', $advpp_settings_pnp_columns)) { ?>document.getElementById("id").disabled = true;<?php } ?>
		<?php if (in_array('pnp_sku', $advpp_settings_pnp_columns)) { ?>document.getElementById("sku").disabled = true;<?php } ?>
		<?php if (in_array('pnp_upc', $advpp_settings_pnp_columns)) { ?>document.getElementById("upc").disabled = true;<?php } ?>
		<?php if (in_array('pnp_ean', $advpp_settings_pnp_columns)) { ?>document.getElementById("ean").disabled = true;<?php } ?>
		<?php if (in_array('pnp_jan', $advpp_settings_pnp_columns)) { ?>document.getElementById("jan").disabled = true;<?php } ?>
		<?php if (in_array('pnp_isbn', $advpp_settings_pnp_columns)) { ?>document.getElementById("isbn").disabled = true;<?php } ?>
		<?php if (in_array('pnp_mpn', $advpp_settings_pnp_columns)) { ?>document.getElementById("mpn").disabled = true;<?php } ?>
		<?php if (in_array('pnp_name', $advpp_settings_pnp_columns)) { ?>document.getElementById("name").disabled = true;<?php } ?>
		<?php if (in_array('pnp_model', $advpp_settings_pnp_columns)) { ?>document.getElementById("model").disabled = true;<?php } ?>
		<?php if (in_array('pnp_category', $advpp_settings_pnp_columns)) { ?>document.getElementById("category").disabled = true;<?php } ?>
		<?php if (in_array('pnp_manufacturer', $advpp_settings_pnp_columns)) { ?>document.getElementById("manufacturer").disabled = true;<?php } ?>
		<?php if (in_array('pnp_attribute', $advpp_settings_pnp_columns)) { ?>document.getElementById("attribute").disabled = true;<?php } ?>
		<?php if (in_array('pnp_status', $advpp_settings_pnp_columns)) { ?>document.getElementById("status").disabled = true;<?php } ?>
		<?php if (in_array('pnp_location', $advpp_settings_pnp_columns)) { ?>document.getElementById("location").disabled = true;<?php } ?>
		<?php if (in_array('pnp_tax_class', $advpp_settings_pnp_columns)) { ?>document.getElementById("tax_class").disabled = true;<?php } ?>
		<?php if (in_array('pnp_price', $advpp_settings_pnp_columns)) { ?>document.getElementById("price").disabled = true;<?php } ?>
		<?php if (in_array('pnp_viewed', $advpp_settings_pnp_columns)) { ?>document.getElementById("viewed").disabled = true;<?php } ?>
		<?php if (in_array('pnp_stock_quantity', $advpp_settings_pnp_columns)) { ?>document.getElementById("stock_quantity").disabled = true;<?php } ?>	
		<?php } ?>
		<?php if ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_abandoned_orders') { ?>		
		<?php if (in_array('mv_id', $advpp_settings_mv_columns)) { ?>document.getElementById("id").disabled = true;<?php } ?>
		<?php if (in_array('mv_sku', $advpp_settings_mv_columns)) { ?>document.getElementById("sku").disabled = true;<?php } ?>
		<?php if (in_array('mv_upc', $advpp_settings_mv_columns)) { ?>document.getElementById("upc").disabled = true;<?php } ?>
		<?php if (in_array('mv_ean', $advpp_settings_mv_columns)) { ?>document.getElementById("ean").disabled = true;<?php } ?>
		<?php if (in_array('mv_jan', $advpp_settings_mv_columns)) { ?>document.getElementById("jan").disabled = true;<?php } ?>
		<?php if (in_array('mv_isbn', $advpp_settings_mv_columns)) { ?>document.getElementById("isbn").disabled = true;<?php } ?>
		<?php if (in_array('mv_mpn', $advpp_settings_mv_columns)) { ?>document.getElementById("mpn").disabled = true;<?php } ?>
		<?php if (in_array('mv_name', $advpp_settings_mv_columns)) { ?>document.getElementById("name").disabled = true;<?php } ?>
		<?php if (in_array('mv_model', $advpp_settings_mv_columns)) { ?>document.getElementById("model").disabled = true;<?php } ?>
		<?php if (in_array('mv_category', $advpp_settings_mv_columns)) { ?>document.getElementById("category").disabled = true;<?php } ?>
		<?php if (in_array('mv_manufacturer', $advpp_settings_mv_columns)) { ?>document.getElementById("manufacturer").disabled = true;<?php } ?>	
		<?php if (in_array('mv_attribute', $advpp_settings_mv_columns)) { ?>document.getElementById("attribute").disabled = true;<?php } ?>
		<?php if (in_array('mv_status', $advpp_settings_mv_columns)) { ?>document.getElementById("status").disabled = true;<?php } ?>
		<?php if (in_array('mv_location', $advpp_settings_mv_columns)) { ?>document.getElementById("location").disabled = true;<?php } ?>
		<?php if (in_array('mv_tax_class', $advpp_settings_mv_columns)) { ?>document.getElementById("tax_class").disabled = true;<?php } ?>
		<?php if (in_array('mv_price', $advpp_settings_mv_columns)) { ?>document.getElementById("price").disabled = true;<?php } ?>
		<?php if (in_array('mv_viewed', $advpp_settings_mv_columns)) { ?>document.getElementById("viewed").disabled = true;<?php } ?>
		<?php if (in_array('mv_stock_quantity', $advpp_settings_mv_columns)) { ?>document.getElementById("stock_quantity").disabled = true;<?php } ?>
		<?php } ?>		
	}
    if (filter_report.options[5].selected === true || filter_report.options[11].selected === true || filter_report.options[12].selected === true || filter_details.options[2].selected === true || filter_details.options[3].selected === true) {
		<?php if ($filter_report == 'all_products_with_without_orders' or $filter_report == 'products_purchased_without_options' or $filter_report == 'products_purchased_with_options' or $filter_report == 'new_products_purchased' or $filter_report == 'old_products_purchased' or $filter_report == 'products_abandoned_orders') { ?>
		<?php if (in_array('mv_orders', $advpp_settings_mv_columns)) { ?>document.getElementById("orders").disabled = true;<?php } ?>
		<?php if (in_array('mv_customers', $advpp_settings_mv_columns)) { ?>document.getElementById("customers").disabled = true;<?php } ?>
		<?php if (in_array('mv_sold_quantity', $advpp_settings_mv_columns)) { ?>document.getElementById("sold_quantity").disabled = true;<?php } ?>
		<?php if (in_array('mv_total_excl_vat', $advpp_settings_mv_columns)) { ?>document.getElementById("total_excl_vat").disabled = true;<?php } ?>
		<?php if (in_array('mv_total_tax', $advpp_settings_mv_columns)) { ?>document.getElementById("total_tax").disabled = true;<?php } ?>
		<?php if (in_array('mv_total_incl_vat', $advpp_settings_mv_columns)) { ?>document.getElementById("total_incl_vat").disabled = true;<?php } ?>
		<?php if (in_array('mv_app', $advpp_settings_mv_columns)) { ?>document.getElementById("app").disabled = true;<?php } ?>
		<?php if (in_array('mv_refunds', $advpp_settings_mv_columns)) { ?>document.getElementById("refunds").disabled = true;<?php } ?>
		<?php if (in_array('mv_reward_points', $advpp_settings_mv_columns)) { ?>document.getElementById("reward_points").disabled = true;<?php } ?>
		<?php } ?>
		<?php if ($filter_report == 'categories' or $filter_report == 'manufacturers') { ?>
		<?php if (in_array('cm_orders', $advpp_settings_cm_columns)) { ?>document.getElementById("orders").disabled = true;<?php } ?>
		<?php if (in_array('cm_customers', $advpp_settings_cm_columns)) { ?>document.getElementById("customers").disabled = true;<?php } ?>
		<?php if (in_array('cm_sold_quantity', $advpp_settings_cm_columns)) { ?>document.getElementById("sold_quantity").disabled = true;<?php } ?>
		<?php if (in_array('cm_total_excl_vat', $advpp_settings_cm_columns)) { ?>document.getElementById("total_excl_vat").disabled = true;<?php } ?>
		<?php if (in_array('cm_total_tax', $advpp_settings_cm_columns)) { ?>document.getElementById("total_tax").disabled = true;<?php } ?>
		<?php if (in_array('cm_total_incl_vat', $advpp_settings_cm_columns)) { ?>document.getElementById("total_incl_vat").disabled = true;<?php } ?>
		<?php if (in_array('cm_app', $advpp_settings_cm_columns)) { ?>document.getElementById("app").disabled = true;<?php } ?>
		<?php if (in_array('cm_refunds', $advpp_settings_cm_columns)) { ?>document.getElementById("refunds").disabled = true;<?php } ?>
		<?php if (in_array('cm_reward_points', $advpp_settings_cm_columns)) { ?>document.getElementById("reward_points").disabled = true;<?php } ?>
		<?php } ?>		
		<?php if ($filter_report == 'products_shopping_carts') { ?>
		<?php if (in_array('scw_cart_quantity', $advpp_settings_scw_columns)) { ?>document.getElementById("cart_quantity").disabled = true;<?php } ?>
		<?php } ?>			
		<?php if ($filter_report == 'products_wishlists') { ?>
		<?php if (in_array('scw_wishlist_quantity', $advpp_settings_scw_columns)) { ?>document.getElementById("wishlist_quantity").disabled = true;<?php } ?>
		<?php } ?>		
	}
    if (filter_details.options[2].selected === true || filter_details.options[3].selected === true) {
        document.getElementById("filter_group").options[0].disabled = true;
        document.getElementById("filter_group").options[1].disabled = true;		
        document.getElementById("filter_group").options[2].disabled = true;
        document.getElementById("filter_group").options[3].disabled = true;
		document.getElementById("filter_group").options[4].disabled = true;
		document.getElementById("filter_group").options[5].disabled = true;
		document.getElementById("filter_group").options[6].disabled = true;
	}		
}
//--></script> 
<script type="text/javascript">
$(document).ready(function() {
var $filter_range = $('#filter_range'), $date_start = $('#date-start'), $date_end = $('#date-end');
$filter_range.change(function () {
    if ($filter_range.val() == 'custom') {
        $date_start.removeAttr('disabled');
		$date_start.css('background-color', '#F9F9F9');	
        $date_end.removeAttr('disabled');
		$date_end.css('background-color', '#F9F9F9');	
    } else {	
        $date_start.attr('disabled', 'disabled').val('');
		$date_start.css('background-color', '#EEE');
        $date_end.attr('disabled', 'disabled').val('');
		$date_end.css('background-color', '#EEE');
    }
}).trigger('change');

var $filter_report_to_export = $('select[name=\'filter_report\']');
var $filter_details_to_export = $('select[name=\'filter_details\']');
	if ($filter_report_to_export.val() == 'all_products_with_without_orders' || $filter_report_to_export.val() == 'products_without_orders' || $filter_report_to_export.val() == 'products_shopping_carts' || $filter_report_to_export.val() == 'products_wishlists') {
		$("#report_to_export option[value='export_no_details']").prop('disabled', false); 
		$("#report_to_export option[value='export_no_details']").prop('selected', true); 		
		$("#report_to_export option[value='export_basic_details']").prop('disabled', true);		
		$("#report_to_export option[value='export_all_details_products']").prop('disabled', true);
		$("#report_to_export option[value='export_all_details_orders']").prop('disabled', true);
		$("#type_to_export option[value='']").prop('selected', true); 
		$('#csv_delimiter select').prop('disabled', true);
		$("#type_to_export option[value='export_xls']").prop('disabled', false); 
		$("#type_to_export option[value='export_xlsx']").prop('disabled', false); 
		$("#type_to_export option[value='export_csv']").prop('disabled', false); 
		$("#type_to_export option[value='export_pdf']").prop('disabled', false); 
		$("#type_to_export option[value='export_html']").prop('disabled', false); 		
	} else {
		if ($filter_details_to_export.val() == 'no_details') {
			$("#report_to_export option[value='export_no_details']").prop('disabled', false); 
			$("#report_to_export option[value='export_no_details']").prop('selected', true); 			
			$("#report_to_export option[value='export_basic_details']").prop('disabled', true); 
			$("#report_to_export option[value='export_all_details_products']").prop('disabled', true);
			$("#report_to_export option[value='export_all_details_orders']").prop('disabled', true);			
			$("#type_to_export option[value='']").prop('selected', true); 
			$('#csv_delimiter select').prop('disabled', true);
			$("#type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#type_to_export option[value='export_pdf']").prop('disabled', false); 
			$("#type_to_export option[value='export_html']").prop('disabled', false); 			
		} else if ($filter_details_to_export.val() == 'basic_details') {
			$("#report_to_export option[value='export_no_details']").prop('disabled', true); 
			$("#report_to_export option[value='export_basic_details']").prop('disabled', false); 
			$("#report_to_export option[value='export_basic_details']").prop('selected', true); 
			$("#report_to_export option[value='export_all_details_products']").prop('disabled', true);
			$("#report_to_export option[value='export_all_details_orders']").prop('disabled', true);			
			$("#type_to_export option[value='']").prop('selected', true); 
			$('#csv_delimiter select').prop('disabled', true);
			$("#type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#type_to_export option[value='export_pdf']").prop('disabled', false); 
			$("#type_to_export option[value='export_html']").prop('disabled', false); 
		} else if ($filter_details_to_export.val() == 'all_details_products') {
			$("#report_to_export option[value='export_no_details']").prop('disabled', true); 
			$("#report_to_export option[value='export_basic_details']").prop('disabled', true); 
			$("#report_to_export option[value='export_all_details_products']").prop('disabled', false);
			$("#report_to_export option[value='export_all_details_products']").prop('selected', true);
			$("#report_to_export option[value='export_all_details_orders']").prop('disabled', true);
			$("#type_to_export option[value='']").prop('selected', true); 
			$('#csv_delimiter select').prop('disabled', true);
			$("#type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#type_to_export option[value='export_pdf']").prop('disabled', true); 
			$("#type_to_export option[value='export_html']").prop('disabled', true); 			
		} else if ($filter_details_to_export.val() == 'all_details_orders') {
			$("#report_to_export option[value='export_no_details']").prop('disabled', true); 
			$("#report_to_export option[value='export_basic_details']").prop('disabled', true); 
			$("#report_to_export option[value='export_all_details_products']").prop('disabled', true);
			$("#report_to_export option[value='export_all_details_orders']").prop('disabled', false);
			$("#report_to_export option[value='export_all_details_orders']").prop('selected', true);
			$("#type_to_export option[value='']").prop('selected', true); 
			$('#csv_delimiter select').prop('disabled', true);
			$("#type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#type_to_export option[value='export_pdf']").prop('disabled', true); 
			$("#type_to_export option[value='export_html']").prop('disabled', true); 			
		} else {
			$("#report_to_export option[value='export_no_details']").prop('disabled', false); 
			$("#report_to_export option[value='export_basic_details']").prop('disabled', false); 		
			$("#report_to_export option[value='export_all_details_products']").prop('disabled', false); 
			$("#report_to_export option[value='export_all_details_orders']").prop('disabled', false); 
			$("#type_to_export option[value='']").prop('selected', true); 
			$('#csv_delimiter select').prop('disabled', true);
			$("#type_to_export option[value='export_xls']").prop('disabled', true); 
			$("#type_to_export option[value='export_xlsx']").prop('disabled', true); 
			$("#type_to_export option[value='export_csv']").prop('disabled', true); 
			$("#type_to_export option[value='export_pdf']").prop('disabled', true); 
			$("#type_to_export option[value='export_html']").prop('disabled', true);  			
		}
	}
	$('#report_to_export .select').selectpicker('refresh');
	$('#type_to_export .select').selectpicker('refresh');
	$('#csv_delimiter .select').selectpicker('refresh');
	
	if ($filter_report_to_export.val() == 'all_products_with_without_orders' || $filter_report_to_export.val() == 'products_without_orders' || $filter_report_to_export.val() == 'products_shopping_carts' || $filter_report_to_export.val() == 'products_wishlists') {
		$("#cron_report_to_export option[value='export_no_details']").prop('disabled', false); 
		$("#cron_report_to_export option[value='export_no_details']").prop('selected', true); 		
		$("#cron_report_to_export option[value='export_basic_details']").prop('disabled', true);		
		$("#cron_report_to_export option[value='export_all_details_products']").prop('disabled', true); 
		$("#cron_report_to_export option[value='export_all_details_orders']").prop('disabled', true); 
		$("#cron_type_to_export option[value='']").prop('selected', true); 
		$('#cron_csv_delimiter select').prop('disabled', true);
		$("#cron_type_to_export option[value='export_xls']").prop('disabled', false); 
		$("#cron_type_to_export option[value='export_xlsx']").prop('disabled', false); 
		$("#cron_type_to_export option[value='export_csv']").prop('disabled', false); 
		$("#cron_type_to_export option[value='export_pdf']").prop('disabled', false); 
		$("#cron_type_to_export option[value='export_html']").prop('disabled', false); 		
	} else {
		if ($filter_details_to_export.val() == 'no_details') {
			$("#cron_report_to_export option[value='export_no_details']").prop('disabled', false); 
			$("#cron_report_to_export option[value='export_no_details']").prop('selected', true); 			
			$("#cron_report_to_export option[value='export_basic_details']").prop('disabled', true); 
			$("#cron_report_to_export option[value='export_all_details_products']").prop('disabled', true);
			$("#cron_report_to_export option[value='export_all_details_orders']").prop('disabled', true);
			$("#cron_type_to_export option[value='']").prop('selected', true); 
			$('#cron_csv_delimiter select').prop('disabled', true);
			$("#cron_type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_pdf']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_html']").prop('disabled', false); 			
		} else if ($filter_details_to_export.val() == 'basic_details') {
			$("#cron_report_to_export option[value='export_no_details']").prop('disabled', true); 
			$("#cron_report_to_export option[value='export_basic_details']").prop('disabled', false); 
			$("#cron_report_to_export option[value='export_basic_details']").prop('selected', true); 
			$("#cron_report_to_export option[value='export_all_details_products']").prop('disabled', true);
			$("#cron_report_to_export option[value='export_all_details_orders']").prop('disabled', true);
			$("#cron_type_to_export option[value='']").prop('selected', true); 
			$('#cron_csv_delimiter select').prop('disabled', true);
			$("#cron_type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_pdf']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_html']").prop('disabled', false); 	
		} else if ($filter_details_to_export.val() == 'all_details_products') {
			$("#cron_report_to_export option[value='export_no_details']").prop('disabled', true); 
			$("#cron_report_to_export option[value='export_basic_details']").prop('disabled', true); 
			$("#cron_report_to_export option[value='export_all_details_products']").prop('disabled', false);	
			$("#cron_report_to_export option[value='export_all_details_products']").prop('selected', true);
			$("#cron_report_to_export option[value='export_all_details_orders']").prop('disabled', true);
			$("#cron_type_to_export option[value='']").prop('selected', true); 
			$('#cron_csv_delimiter select').prop('disabled', true);
			$("#cron_type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_pdf']").prop('disabled', true); 
			$("#cron_type_to_export option[value='export_html']").prop('disabled', true); 				
		} else if ($filter_details_to_export.val() == 'all_details_orders') {
			$("#cron_report_to_export option[value='export_no_details']").prop('disabled', true); 
			$("#cron_report_to_export option[value='export_basic_details']").prop('disabled', true); 
			$("#cron_report_to_export option[value='export_all_details_products']").prop('disabled', true);
			$("#cron_report_to_export option[value='export_all_details_orders']").prop('disabled', false);	
			$("#cron_report_to_export option[value='export_all_details_orders']").prop('selected', true);
			$("#cron_type_to_export option[value='']").prop('selected', true); 
			$('#cron_csv_delimiter select').prop('disabled', true);
			$("#cron_type_to_export option[value='export_xls']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_xlsx']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_csv']").prop('disabled', false); 
			$("#cron_type_to_export option[value='export_pdf']").prop('disabled', true); 
			$("#cron_type_to_export option[value='export_html']").prop('disabled', true); 			
		} else {
			$("#cron_report_to_export option[value='export_no_details']").prop('disabled', false); 
			$("#cron_report_to_export option[value='export_basic_details']").prop('disabled', false); 		
			$("#cron_report_to_export option[value='export_all_details_products']").prop('disabled', false); 
			$("#cron_report_to_export option[value='export_all_details_orders']").prop('disabled', false); 
			$("#cron_type_to_export option[value='']").prop('selected', true); 
			$('#cron_csv_delimiter select').prop('disabled', true);
			$("#cron_type_to_export option[value='export_xls']").prop('disabled', true); 
			$("#cron_type_to_export option[value='export_xlsx']").prop('disabled', true); 
			$("#cron_type_to_export option[value='export_csv']").prop('disabled', true); 
			$("#cron_type_to_export option[value='export_pdf']").prop('disabled', true); 
			$("#cron_type_to_export option[value='export_html']").prop('disabled', true);  			
		}		
	}
	$('#cron_report_to_export .select').selectpicker('refresh');
	$('#cron_type_to_export .select').selectpicker('refresh');
	$('#cron_csv_delimiter .select').selectpicker('refresh');	
	document.getElementById("cron_file_save_path").defaultValue = "report";
	
	$('#cron_export_file').on('change', function() {
		if ($("#send_to_email").is(":selected")) {
			$("#save_path_status").addClass("disabled");
		} else if ($("#save_on_server").is(":selected")) {
			$("#save_path_status").removeClass("disabled");
		}
	});		
});

$('select[name=\'export_type\']').on('change', function() {
	var export_type = $('select[name=\'export_type\']').val();
	if (export_type == 'export_csv') {
		$('#csv_delimiter select').prop('disabled', false);
	} else {
		$('#csv_delimiter select').prop('disabled', true);
	}
	$('#csv_delimiter .select').selectpicker('refresh');
});
$('select[name=\'export_type\']').trigger('change');

$('select[name=\'cron_export_type\']').on('change', function() {
	var cron_export_type = $('select[name=\'cron_export_type\']').val();
	if (cron_export_type == 'export_csv') {
		$('#cron_csv_delimiter select').prop('disabled', false);
	} else {
		$('#cron_csv_delimiter select').prop('disabled', true);
	}
	$('#cron_csv_delimiter .select').selectpicker('refresh');
});
$('select[name=\'cron_export_type\']').trigger('change');
</script> 
<script type="text/javascript">
$(window).on("load", function() {
	$(".loader").fadeOut("slow");
});
</script>
<?php if (($filter_details == 'basic_details') or (($filter_report == 'products_shopping_carts' or $filter_report == 'products_wishlists') && $filter_details == 'no_details')) { ?>  
<script type="text/javascript">
$(".toggle-all").click(function() {
	if ($(this).hasClass("expand")) {
		$(this).removeClass("expand");
		$(".more").show();
		$("#circle").removeClass("fa fa-arrow-circle-down");
		$("#circle").addClass("fa fa-arrow-circle-up");
		$(".toggle-all").attr('data-original-title', '<?php echo $button_collapse; ?>')
	} else {
		$(this).addClass("expand");
		$(".more").hide();
		$("#circle").removeClass("fa fa-arrow-circle-up");
		$("#circle").addClass("fa fa-arrow-circle-down");	
		$(".toggle-all").attr('data-original-title', '<?php echo $button_expand; ?>')
	}
});
</script>
<?php } ?>
<?php if ($initialise) { ?>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function(){$('#settings').modal('show');},800);
	$('#settings .modal-body').prepend('<div class="alert alert-warning"><i class="fa fa-info"></i> <?php echo $text_initialise_use; ?><button type="button" class="close" data-dismiss="alert">&times;</button></div>');
});
</script>
<?php } ?>
<?php if ($filter_limit == '999999') { ?>
<script type="text/javascript">
$(window).on("load", function() {
    setTimeout(function(){$('#export').modal('show');},300);
	
});
</script>
<?php } ?>
<?php echo $footer; ?>