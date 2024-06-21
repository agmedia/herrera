	<fieldset>
		<legend><i class="fa fa-user"></i> <?php echo $text_action_customer_group; ?></legend>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
						<td class="text-center"><?php echo $text_enabled; ?>/<?php echo $text_disabled; ?></td>
						<td class="text-center"><?php echo $entry_update_existing; ?></td>
						<td><?php echo $entry_customer_group; ?></td>
						<td><?php echo $entry_base_price; ?></td>
						<td><?php echo $entry_type; ?></td>
						<td><?php echo $entry_value; ?></td>
						<td><?php echo $entry_action; ?></td>
				</thead>
				<tbody>
						<?php foreach ($customer_groups as $key => $customer_group) { ?>
							<tr id="customer-group-<?php echo $customer_group['customer_group_id']; ?>">
									<td class="text-center">
											<label class="switch">
													<input type="checkbox" name="customer_group_price[<?php echo $customer_group['customer_group_id']; ?>][status]" value="1" <?php if(!empty($customer_group_price[$customer_group['customer_group_id']]['status'])) { ?>checked="checked"<?php } ?> />
													<div class="slider round"></div>
										</label>                </td>
									<td class="text-center">
											<label class="switch">
													<input type="checkbox" name="customer_group_price[<?php echo $customer_group['customer_group_id']; ?>][update_existing]" value="1" <?php if(!empty($customer_group_price[$customer_group['customer_group_id']]['update_existing'])) { ?>checked="checked"<?php } ?> />
													<div class="slider round"></div>
										</label>                </td>
									<td><?php echo $customer_group['name']; ?></td>
									<td>
											<select name="customer_group_price[<?php echo $customer_group['customer_group_id']; ?>][basedon]" class="form-control" onchange="basedonprice('<?php echo $customer_group['customer_group_id']; ?>',this.value);" id="input-basedon-<?php echo $customer_group['customer_group_id']; ?>">
													<option value="1" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['basedon']) { ?>selected="selected"<?php } ?>><?php echo $entry_price; ?></option>
													<option value="0" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && empty($customer_group_price[$customer_group['customer_group_id']]['basedon'])) { ?>selected="selected"<?php } ?>><?php echo $entry_custom_price; ?></option>
											</select>
											<div class="custom_price hide">
													<br/>
												<input type="text" name="customer_group_price[<?php echo $customer_group['customer_group_id']; ?>][custom_price]" value="<?php echo isset($customer_group_price[$customer_group['customer_group_id']]) ? $customer_group_price[$customer_group['customer_group_id']]['custom_price'] : ''; ?>" class="form-control" placeholder="<?php echo $entry_custom_price; ?>" id="input-custom_price-<?php echo $customer_group['customer_group_id']; ?>">
											</div>
									</td>
									<td>
											<select name="customer_group_price[<?php echo $customer_group['customer_group_id']; ?>][type]" class="form-control" id="input-type-<?php echo $customer_group['customer_group_id']; ?>" onchange="priceaction('<?php echo $customer_group['customer_group_id']; ?>',this.value);">
													<option value="F" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['type'] == 'F') { ?>selected="selected"<?php } ?>><?php echo $entry_fixed_amount; ?></option>
													<option value="P" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['type'] == 'P') { ?>selected="selected"<?php } ?>><?php echo $entry_percentage; ?></option>
											</select>
									</td>
									<td>
											<input type="text" name="customer_group_price[<?php echo $customer_group['customer_group_id']; ?>][value]" value="<?php echo isset($customer_group_price[$customer_group['customer_group_id']]) ? $customer_group_price[$customer_group['customer_group_id']]['value'] : ''; ?>" class="form-control" placeholder="<?php echo $entry_value; ?>" id="input-value-<?php echo $customer_group['customer_group_id']; ?>">
									</td>
									<td>
											<select name="customer_group_price[<?php echo $customer_group['customer_group_id']; ?>][action]" class="form-control" id="input-action-<?php echo $customer_group['customer_group_id']; ?>">
													<option value="+" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['action'] == '+') { ?>selected="selected"<?php } ?>>+ (Plus)</option>
													<option value="-" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['action'] == '-') { ?>selected="selected"<?php } ?>>- (Minus)</option>
													<option value="=" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['action'] == '=') { ?>selected="selected"<?php } ?>>= (Equal)</option>
													<option value="x" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['action'] == 'x') { ?>selected="selected"<?php } ?>>x (Multiply)</option>
													<option value="/" <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['action'] == '/') { ?>selected="selected"<?php } ?>>/ (Divide)</option>
											</select>
									</td>
							</tr>
							 <?php if(isset($customer_group_price[$customer_group['customer_group_id']]) && $customer_group_price[$customer_group['customer_group_id']]['type'] == 'P') { ?>
								<script>
										priceaction(<?php echo $customer_group['customer_group_id']; ?>,'P');
								 </script>
							 <?php } ?>
						<?php } ?>
				</tbody>
			</table>
		</div>
	</fieldset>

	<fieldset>
		<legend><i class="fa fa-tag"></i> <?php echo $text_applyon_catalog; ?></legend>
		<div class="form-group">
			<label class="col-sm-2 control-label"><?php echo $text_applyon_catalog; ?></label>
			<div class="col-sm-10">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-primary filter_type <?php if(isset($filter_type) && $filter_type == 'all') { ?>active<?php } ?>">
						<input name="filter_type" <?php if(isset($filter_type) && $filter_type == 'all') { ?>checked="checked"<?php } ?> autocomplete="off" value="all" type="radio"><?php echo $entry_all_products; ?>
					</label>
					<label class="btn btn-primary filter_type <?php if(isset($filter_type) && $filter_type == 'custom_product') { ?>active<?php } ?>">
						<input name="filter_type" autocomplete="off" <?php if(isset($filter_type) && $filter_type == 'custom_product') { ?>checked="checked"<?php } ?> value="custom_product" type="radio"><?php echo $entry_custom_products; ?>
					</label>
					<label class="btn btn-primary filter_type <?php if(isset($filter_type) && $filter_type == 'custom_category') { ?>active<?php } ?>">
						<input name="filter_type" autocomplete="off" <?php if(isset($filter_type) && $filter_type == 'custom_category') { ?>checked="checked"<?php } ?> value="custom_category" type="radio"><?php echo $entry_categories; ?>
					</label>
					 <label class="btn btn-primary filter_type <?php if(isset($filter_type) && $filter_type == 'custom_manufacturer') { ?>active<?php } ?>">
						<input name="filter_type" autocomplete="off" <?php if(isset($filter_type) && $filter_type == 'custom_manufacturer') { ?>checked="checked"<?php } ?> value="custom_manufacturer" type="radio"><?php echo $entry_manufacturers; ?>
					</label>
				</div>
			</div>
		</div>

		<div class="form-group custom_products <?php if(isset($filter_type) && $filter_type != 'custom_product') { ?>hide<?php } ?>">
			<label class="col-sm-2 control-label"><?php echo $entry_product; ?></label>
			<div class="col-sm-10">
				<input type="text" name="filter_product_name" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
				<div id="selected-product" class="well well-sm" style="height: 150px; overflow: auto;">
						<?php foreach ($products as $product) { ?>
								<div id="selected-product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
									<input type="hidden" name="filter_products[]" value="<?php echo $product['product_id']; ?>" />
								</div>
								<?php } ?>
				</div>
			</div>
		</div>

		<div class="form-group custom_categories <?php if(isset($filter_type) && $filter_type != 'custom_category') { ?>hide<?php } ?>">
			<label class="col-sm-2 control-label"><?php echo $entry_category; ?></label>
			<div class="col-sm-10">
				<div id="selected-category" class="well well-sm" style="height: 150px; overflow: auto;">
						<?php foreach ($categories as $category) { ?>
								<div class="checkbox">
										<label>
											<input type="checkbox" name="categories[]" value="<?php echo $category['category_id']; ?>" <?php if(in_array($category['category_id'], $filter_categories)) { ?>checked="checked"<?php } ?> />
											<?php echo $category['name']; ?>
										</label>
									</div>
						<?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a>
			</div>
		</div>

		<div class="form-group custom_manufacturers <?php if(isset($filter_type) && $filter_type != 'custom_manufacturer') { ?>hide<?php } ?>">
			<label class="col-sm-2 control-label"><?php echo $entry_manufacturer; ?></label>
			<div class="col-sm-10">
				<div id="selected-manufacturer" class="well well-sm" style="height: 150px; overflow: auto;">
						<?php foreach ($manufacturers as $manufacturer) { ?>
								<div class="checkbox">
										<label>
											<input type="checkbox" name="manufacturers[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" <?php if(in_array($manufacturer['manufacturer_id'], $filter_manufacturers)) { ?>checked="checked"<?php } ?> />
											<?php echo $manufacturer['name']; ?>
										</label>
									</div>
						<?php } ?>
				</div>
				<a onclick="$(this).parent().find(':checkbox').prop('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').prop('checked', false);"><?php echo $text_unselect_all; ?></a>
			</div>
		</div>

		<div class="form-group exclude_products <?php if(isset($filter_type) && $filter_type == 'custom_product') { ?>hide<?php } ?>">
			<label class="col-sm-2 control-label"><?php echo $entry_exclude_product; ?></label>
			<div class="col-sm-10">
				<input type="text" name="filter_exclude_product_name" value="" placeholder="<?php echo $entry_exclude_product; ?>" id="input-product" class="form-control" />
				<div id="exclude-product" class="well well-sm" style="height: 150px; overflow: auto;">
						<?php foreach ($exclude_products as $exclude_product) { ?>
								<div id="exclude-product<?php echo $exclude_product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $exclude_product['name']; ?>
									<input type="hidden" name="filter_exclude_products[]" value="<?php echo $exclude_product['product_id']; ?>" />
								</div>
								<?php } ?>
				</div>
			</div>
		</div>
	</fieldset>

	<?php if($page_type == 'product_option') { ?>
	<fieldset>
		<legend><i class="fa fa-cube"></i> <?php echo $text_choose_option; ?></legend>
		<div class="row" id="tab-option">
			<div class="col-sm-2">
				<ul class="nav nav-pills nav-stacked" id="option">
					<?php $option_row = 0; ?>
					<?php foreach ($product_options as $product_option) { ?>
					<li><a href="#tab-option<?php echo $option_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('a[href=\'#tab-option<?php echo $option_row; ?>\']').parent().remove(); $('#tab-option<?php echo $option_row; ?>').remove(); $('#option a:first').tab('show');"></i> <?php echo $product_option['name']; ?></a></li>
					<?php $option_row++; ?>
					<?php } ?>
					<li>
						<input type="text" name="option" value="" placeholder="<?php echo $entry_option; ?>" id="input-option" class="form-control" />
					</li>
				</ul>
			</div>
			<div class="col-sm-10">
				<div class="tab-content">
					<?php $option_row = 0; ?>
					<?php $option_value_row = 0; ?>
					<?php foreach ($product_options as $product_option) { ?>
					<div class="tab-pane" id="tab-option<?php echo $option_row; ?>">
							 <input type="hidden" name="product_option[<?php echo $option_row; ?>][option_id]" value="<?php echo $product_option['option_id']; ?>" />
							 <input type="hidden" name="product_option[<?php echo $option_row; ?>][type]" value="<?php echo $product_option['type']; ?>" />
							<input type="hidden" name="product_option[<?php echo $option_row; ?>][name]" value="<?php echo $product_option['name']; ?>" />
						 <div class="form-group">
						 <label class="col-sm-2 control-label"><?php echo $text_choose; ?></label>
						 <div class="col-sm-10">
							<div class="btn-group" data-toggle="buttons">
							<label class="btn btn-primary filter_option <?php if(isset($product_option['filter_option']) && $product_option['filter_option'] == 'all') { ?>active<?php } ?>">
							 <input name="product_option[<?php echo $option_row; ?>][filter_option]" <?php if(isset($product_option['filter_option']) && $product_option['filter_option'] == 'all') { ?>checked="checked"<?php } ?> autocomplete="off" value="all" rel="<?php echo $option_row; ?>" type="radio"><?php echo $entry_all_options; ?>
							</label>
							 <label class="btn btn-primary filter_option <?php if(isset($product_option['filter_option']) && $product_option['filter_option'] == 'custom_option') { ?>active<?php } ?>">
								<input name="product_option[<?php echo $option_row; ?>][filter_option]" <?php if(isset($product_option['filter_option']) && $product_option['filter_option'] == 'custom_option') { ?>checked="checked"<?php } ?> autocomplete="off" value="custom_option" rel="<?php echo $option_row; ?>" type="radio"><?php echo $entry_custom_options; ?>
								</label>
							</div>
						 </div>
						 </div>
						<div class="form-group <?php if(isset($product_option['filter_option']) && $product_option['filter_option'] == 'all') { ?>hide<?php } ?>" id="option-values<?php echo $option_row; ?>">
						<label class="col-sm-2 control-label"><?php echo $entry_custom_options; ?></label>
						<div class="col-sm-10">
						<div class="well well-sm" style="height: 150px; overflow: auto;">
						<?php if (isset($option_values[$product_option['option_id']])) { ?>
							<?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
					 <div class="checkbox">
					 <label>
						<input type="checkbox" name="product_option[<?php echo $option_row; ?>][filter_option_value][]" value="<?php echo $option_value['option_value_id']; ?>" <?php if(isset($product_option['filter_option_value']) && in_array($option_value['option_value_id'],$product_option['filter_option_value'])) { ?>checked="checked"<?php } ?>/>  <?php echo $option_value['name']; ?>
					 </label>
					 </div>
						<?php } ?>
							<?php } ?>
					 </div>
						</div>
					 </div>
					</div>
					<?php $option_row++; ?>
					<?php } ?>
				</div>
			</div>
		</div>
	</fieldset>
	<?php } ?>

	<fieldset>
		<br />
		<div class="text-center">
			<button type="button" id="button-apply" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-success btn-lg"><i class="fa fa-check-circle"></i> <?php echo $button_apply; ?></button>
		</div>
		<br />
	</fieldset>

<script type="text/javascript"><!--
function basedonprice(customer_group_id,value) {
	if(value == 1) {
			$('#customer-group-'+ customer_group_id +' .custom_price').addClass('hide');
	} else if(value == 0) {
			$('#customer-group-'+ customer_group_id +' .custom_price').removeClass('hide');
	}
}

function priceaction(customer_group_id,value) {
	$('#input-action-'+customer_group_id+' option:selected').prop("selected", false);
	if(value == 'P') {
			$('#input-action-'+customer_group_id+' option[value="="]').hide();
			$('#input-action-'+customer_group_id+' option[value="x"]').hide();
			$('#input-action-'+customer_group_id+' option[value="/"]').hide();
	} else if(value == 'F') {
			$('#input-action-'+customer_group_id+' option[value="="]').show();
			$('#input-action-'+customer_group_id+' option[value="x"]').show();
			$('#input-action-'+customer_group_id+' option[value="/"]').show();
	}
}

// Product
$('input[name=\'filter_product_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&<?php echo $module_token; ?>=<?php echo $ci_token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_product_name\']').val('');

		$('#selected-product' + item['value']).remove();

		$('#selected-product').append('<div id="selected-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filter_products[]" value="' + item['value'] + '" /></div>');
	}
});

$('#selected-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});

$('input[name=\'filter_exclude_product_name\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&<?php echo $module_token; ?>=<?php echo $ci_token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['product_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_exclude_product_name\']').val('');

		$('#exclude-product' + item['value']).remove();

		$('#exclude-product').append('<div id="exclude-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filter_exclude_products[]" value="' + item['value'] + '" /></div>');
	}
});

$('#exclude-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script>
<script type="text/javascript"><!--
$('.filter_type').click(function() {
	if($(this).find('input').val() == 'custom_product') {
		$('.custom_products').removeClass('hide');
		$('.custom_categories').addClass('hide');
		$('.custom_manufacturers').addClass('hide');
		$('.exclude_products').addClass('hide');
	} else if($(this).find('input').val() == 'custom_category') {
			 $('.custom_products').addClass('hide');
			$('.custom_categories').removeClass('hide');
			$('.exclude_products').removeClass('hide');
			$('.custom_manufacturers').addClass('hide');
	} else if($(this).find('input').val() == 'custom_manufacturer') {
			 $('.custom_products').addClass('hide');
			$('.custom_categories').addClass('hide');
			$('.exclude_products').removeClass('hide');
			$('.custom_manufacturers').removeClass('hide');
	} else {
		$('.custom_products').addClass('hide');
		$('.custom_categories').addClass('hide');
		$('.custom_manufacturers').addClass('hide');
		$('.exclude_products').removeClass('hide');
	}
});
//--></script>
<?php if($page_type == 'product_option') { ?>
<script type="text/javascript"><!--
var option_row = <?php echo $option_row; ?>;

$('input[name=\'option\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=extension/cigroupprice_option/optionAutocomplete&<?php echo $module_token; ?>=<?php echo $ci_token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						// category: item['category'],
						label: item['name'],
						value: item['option_id'],
						type: item['type'],
						option_value: item['option_value']
					}
				}));
			}
		});
	},
	'select': function(item) {
		html  = '<div class="tab-pane" id="tab-option' + option_row + '">';
		html += ' <input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + item['value'] + '" />';
		html += ' <input type="hidden" name="product_option[' + option_row + '][type]" value="' + item['type'] + '" />';
		html += ' <input type="hidden" name="product_option[' + option_row + '][name]" value="' + item['label'] + '" />';

		html += '<div class="form-group">';
		html += '<label class="col-sm-2 control-label"><?php echo $text_choose; ?></label>';
		html += '<div class="col-sm-10">';
		html += '  <div class="btn-group" data-toggle="buttons">';
		 html += '   <label class="btn btn-primary filter_option active">';
			html += '    <input name="product_option[' + option_row + '][filter_option]" checked="checked" autocomplete="off" value="all" rel="' + option_row + '" type="radio"><?php echo $entry_all_options; ?>';
		html += '    </label>';
		html += '    <label class="btn btn-primary filter_option ">';
		html += '      <input name="product_option[' + option_row + '][filter_option]" autocomplete="off" value="custom_option" rel="' + option_row + '" type="radio"><?php echo $entry_custom_options; ?>';
		 html += '     </label>';
		 html += '   </div>';
		 html += ' </div>';
		 html += ' </div>';

		html += '<div class="form-group hide" id="option-values' + option_row + '">';
		html += '<label class="col-sm-2 control-label"><?php echo $entry_custom_options; ?></label>';
		html += '<div class="col-sm-10">';
		html += '<div class="well well-sm" style="height: 150px; overflow: auto;">';
		for (i = 0; i < item['option_value'].length; i++) {
		 	html += '<div class="checkbox">';
		 	html += '<label>';
			html += ' <input type="checkbox" name="product_option[' + option_row + '][filter_option_value][]" value="' + item['option_value'][i]['option_value_id'] + '" />  ' + item['option_value'][i]['name'];
		 	html += '   </label>';
		 	html += ' </div>';
	 	}

	 	html += ' </div>';
		html += '</div>';
		html += '</div>';
		html += '</div>';

		$('#tab-option .tab-content').append(html);

		$('#option > li:last-child').before('<li><a href="#tab-option' + option_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick=" $(\'#option a:first\').tab(\'show\');$(\'a[href=\\\'#tab-option' + option_row + '\\\']\').parent().remove(); $(\'#tab-option' + option_row + '\').remove();"></i> ' + item['label'] + '</li>');

		$('#option a[href=\'#tab-option' + option_row + '\']').tab('show');

		$('[data-toggle=\'tooltip\']').tooltip({
			container: 'body',
			html: true
		});

		$('.filter_option').click(function() {
			var row = $(this).find('input').attr('rel');
			if($(this).find('input').val() == 'custom_option') {
				$('#option-values'+row).removeClass('hide');
			} else if($(this).find('input').val() == 'all') {
				$('#option-values'+row).addClass('hide');
			}
		});

		option_row++;
	}
});

$('#option a:first').tab('show');
//--></script>
<?php } ?>
