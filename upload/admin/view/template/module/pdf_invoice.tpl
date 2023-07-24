<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
<div id="modal-info" class="modal <?php if ($OC_V2) echo ' fade'; ?>" tabindex="-1" role="dialog" aria-hidden="true"></div>
	<?php if ($OC_V2) { ?>
		<div class="page-header">
		    <div class="container-fluid">
		      <div class="pull-right">
		        <button type="submit" form="form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
		        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			  </div>
		      <h1><?php echo $heading_title; ?></h1>
		      <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
		        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
		      </ul>
		    </div>
  </div>
				<?php } else { ?>
		<div class="breadcrumb">
			<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
				<?php } ?>
		</div>
	<?php } ?>
	
  <div class="container-fluid">
	<?php if (isset($success) && $success) { ?><div class="alert alert-success success"><i class="fa fa-check-circle"></i> <?php echo $success; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><script type="text/javascript">setTimeout("$('.alert-success').slideUp();",5000);</script><?php } ?>
	<?php if (isset($info) && $info) { ?><div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $info; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
	<?php if (isset($error) && $error) { ?><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
    <?php if (isset($error_warning) && $error_warning) { ?><div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?> <button type="button" class="close" data-dismiss="alert">&times;</button></div><?php } ?>
<div class="<?php if(!$OC_V2) echo 'box'; ?> panel panel-default">
  <div class="heading panel-heading">
    <h3 class="panel-title"><img style="vertical-align:top;padding-right:4px" src="<?php echo $_img_path; ?>icon-big.png"/> <?php echo $heading_title; ?></h3>
    <div class="buttons"><a onclick="$('#form').submit();" class="button blue"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button red"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content panel-body">
	<div id="stores" <?php if ($OC_V2) echo 'class="v2"'; ?>>
		Store:
		<select name="store">
			<?php foreach ($stores as $store) { ?>
			<?php if ($store_id == $store['store_id']) { ?>
			<option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
			<?php } else { ?>
			<option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
			<?php } ?>
			<?php } ?>
		</select>
	</div>
		<ul class="nav nav-tabs">
			<?php if (!$store_id) { ?>
			<li class="active"><a href="#tab-1" data-toggle="tab"><i class="fa fa-cog"></i><?php echo $_language->get('text_tab_1'); ?></a></li>
			<?php } ?>
			<li <?php if ($store_id) echo 'class="active"'; ?>><a href="#tab-6" data-toggle="tab"><i class="fa fa-check"></i><?php echo $_language->get('text_tab_6'); ?></a></li>
			<li><a href="#tab-2" data-toggle="tab"><i class="fa fa-file-pdf-o"></i><?php echo $_language->get('text_tab_2'); ?></a></li>
			<li><a href="#tab-4" data-toggle="tab"><i class="fa fa-pencil-square-o"></i><?php echo $_language->get('text_tab_4'); ?></a></li>
			<li><a href="#tab-5" data-toggle="tab"><i class="fa fa-file-text-o"></i><?php echo $_language->get('text_tab_5'); ?></a></li>
			<li><a href="#tab-3" data-toggle="tab"><i class="fa fa-floppy-o"></i><?php echo $_language->get('text_tab_3'); ?></a></li>
			<li><a href="#tab-about" data-toggle="tab"><i class="fa fa-info"></i><?php echo $_language->get('text_tab_about'); ?></a></li>
		</ul>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		<div class="tab-content">
		<?php if (!$store_id) { ?>
		<div class="tab-pane active" id="tab-1">
		  <table class="form">
			<tr>
			  <td><?php echo $_language->get('entry_mail'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_mail" name="pdf_invoice_mail" value="1" <?php if($pdf_invoice_mail) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
			<tr>
			  <td><?php echo $_language->get('entry_admincopy'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_admincopy" name="pdf_invoice_admincopy" value="1" <?php if($pdf_invoice_admincopy) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
      <?php /*
			<tr>
			  <td><?php echo $_language->get('entry_mailcopy'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_adminalertcopy" name="pdf_invoice_adminalertcopy" value="1" <?php if($pdf_invoice_adminalertcopy) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
      */ ?>
			<tr>
			  <td><?php echo $_language->get('entry_invoiced_only'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_invoiced" name="pdf_invoice_invoiced" value="1" <?php if($pdf_invoice_invoiced) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
			<tr>
			  <td><?php echo $_language->get('entry_auto_generate'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_auto_generate" name="pdf_invoice_auto_generate" value="1" <?php if($pdf_invoice_auto_generate) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
			<tr>
			  <td><?php echo $_language->get('entry_manual_inv_no'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_manual_inv_no" name="pdf_invoice_manual_inv_no" value="1" <?php if($pdf_invoice_manual_inv_no) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
			<tr>
				<td><?php echo $_language->get('entry_auto_notify'); ?></td>
				<td class="checkbox_list">
						<?php foreach ($order_statuses as $order_status) { ?>
						<span><input class="checkable" type="checkbox" name="pdf_invoice_auto_notify[]" value="<?php echo $order_status['order_status_id']; ?>" <?php if (in_array($order_status['order_status_id'], (array) $pdf_invoice_auto_notify)) echo ' checked="checked"'; ?> data-label="<?php echo $order_status['name']; ?>"/></span>
						<?php } ?>
				</td>
			</tr>
      <tr>
				<td><?php echo $_language->get('entry_return_pdf'); ?></td>
				<td class="checkbox_list">
						<?php foreach ($return_statuses as $return_status) { ?>
						<span><input class="checkable" type="checkbox" name="pdf_invoice_return_pdf[]" value="<?php echo $return_status['return_status_id']; ?>" <?php if (in_array($return_status['return_status_id'], (array) $pdf_invoice_return_pdf)) echo ' checked="checked"'; ?> data-label="<?php echo $return_status['name']; ?>"/></span>
						<?php } ?>
				</td>
			</tr>
			<tr>
				<td><?php echo $_language->get('entry_refund_invoice'); ?></td>
				<td class="checkbox_list">
						<?php foreach ($order_statuses as $order_status) { ?>
						<span><input class="checkable" type="checkbox" name="pdf_invoice_refund[]" value="<?php echo $order_status['order_status_id']; ?>" <?php if (in_array($order_status['order_status_id'], (array) $pdf_invoice_refund)) echo ' checked="checked"'; ?> data-label="<?php echo $order_status['name']; ?>"/></span>
						<?php } ?>
				</td>
			</tr>
			<tr>
				<td><?php echo $_language->get('entry_forcelanguage'); ?></td>
				<td>
					<select class="form-control" name="pdf_invoice_force_lang">
						<option value=""><?php echo $_language->get('text_order_language'); ?></option>
					<?php foreach ($languages as $language) { ?>
						<?php if ($language['language_id'] == $pdf_invoice_force_lang) { ?>
						<option value="<?php echo $language['language_id']; ?>" selected="selected" style="background:url('<?php echo $language['image']; ?>') 3px 2px no-repeat;padding-left:25px;"><?php echo $language['name']; ?></option>
						<?php } else { ?>
						<option value="<?php echo $language['language_id']; ?>" style="background:url('<?php echo $language['image']; ?>') 3px 2px no-repeat;padding-left:25px"> <?php echo $language['name']; ?></option>
						<?php } ?>
					<?php } ?>
					</select>
				</td>
			</tr>
      <tr>
				<td><?php echo $_language->get('entry_display_mode'); ?></td>
				<td>
					<select class="form-control" name="pdf_invoice_display_mode">
						<option value=""><?php echo $_language->get('text_display_dl'); ?></option>
						<option value="view" <?php if ($pdf_invoice_display_mode == 'view') echo 'selected="selected"';?>><?php echo $_language->get('text_display_view'); ?></option>
						<option value="html" <?php if ($pdf_invoice_display_mode == 'html') echo 'selected="selected"';?>><?php echo $_language->get('text_display_html'); ?></option>
					</select>
				</td>
			</tr>
			<tr>
			  <td><?php echo $_language->get('entry_icon'); ?></td>
			  <td>
				<div style="width:380px">
				<?php foreach ($icons as $icon) { ?>
				  <label style="display:inline-block;width:70px;"><input type="radio" name="pdf_invoice_icon" value="<?php echo $icon; ?>" <?php if($pdf_invoice_icon == $icon) echo 'checked="checked"'; ?>/><img src="../image/invoice/<?php echo $icon; ?>"/></label>
				<?php } ?>
				</div>
			  </td>
			</tr>
		</table>
		</div>
		<?php } /*end: store_id*/ ?>
		<div class="tab-pane <?php if ($store_id) echo 'active'; ?>" id="tab-6">
			<table class="form">
			<tr>
				<td><?php echo $_language->get('entry_company_id'); ?></td>
				<td><input class="form-control" type="text" name="pdf_invoice_company_id" value="<?php echo $pdf_invoice_company_id; ?>" size="63"/></td>
			</tr>
				<tr>
					<td><?php echo $_language->get('entry_vat_number'); ?></td>
					<td><input class="form-control" type="text" name="pdf_invoice_vat_number" value="<?php echo $pdf_invoice_vat_number; ?>" size="63"/></td>
				</tr>
			<?php if ($group_settings && !$store_id) { ?>
			<tr>
				<td><?php echo $_language->get('entry_customer_vat'); ?></td>
				<td class="customer_groups">
					<div class="inlineEdit">
						<div class="switchBtn"><?php echo $_language->get('entry_customer_vat_btn'); ?></div>
						<div class="switchContent">
							<?php $i=0; foreach ($customer_groups as $group) { ?>
								<h4><?php echo $group['name']; ?></h4>
								<div>
									<span><?php echo $_language->get('entry_custom_comp_display'); ?></span>
									<input class="switch" type="checkbox"  id="customergroup<?php echo $i++; ?>" name="customer_groups[<?php echo $group['customer_group_id']; ?>][company_id_display]" value="1" <?php if($group['company_id_display']) echo 'checked="checked"'; ?> />
								</div>
								<div>
									<span><?php echo $_language->get('entry_custom_comp_required'); ?></span>
									<input class="switch" type="checkbox"  id="customergroup<?php echo $i++; ?>" name="customer_groups[<?php echo $group['customer_group_id']; ?>][company_id_required]" value="1" <?php if($group['company_id_required']) echo 'checked="checked"'; ?> />
								</div>
								<br />
								<div>
									<span><?php echo $_language->get('entry_custom_tax_display'); ?></span>
									<input class="switch" type="checkbox"  id="customergroup<?php echo $i++; ?>" name="customer_groups[<?php echo $group['customer_group_id']; ?>][tax_id_display]" value="1" <?php if($group['tax_id_display']) echo 'checked="checked"'; ?> />
								</div>
								<div>
									<span><?php echo $_language->get('entry_custom_tax_required'); ?></span>
									<input class="switch" type="checkbox"  id="customergroup<?php echo $i++; ?>" name="customer_groups[<?php echo $group['customer_group_id']; ?>][tax_id_required]" value="1" <?php if($group['tax_id_required']) echo 'checked="checked"'; ?> />
								</div>
							<?php } ?>
						</div>
					</div>
				</td>
			</tr>
			<?php } ?>
      <?php if ($OC_V2) { ?>
      <tr>
        <td><?php echo $_language->get('entry_custom_fields'); ?></td>
        <td class="colors">
        <?php if (!$custom_fields) { echo $_language->get('entry_custom_fields_empty'); } ?>
        <?php foreach ($custom_fields as $item) { ?>
        <div>
          <span><?php echo $item['name']; ?></span>
          <!--<input type="hidden" name="pdf_invoice_custom_fields[<?php echo $item['custom_field_id']; ?>]" value="0"/>-->
          <input class="switch" type="checkbox"  id="pdf_invoice_custom_fields_<?php echo $item['custom_field_id']; ?>" name="pdf_invoice_custom_fields[]" value="<?php echo $item['custom_field_id']; ?>" <?php echo in_array($item['custom_field_id'], (array) $_config->get('pdf_invoice_custom_fields')) ? 'checked="checked"':''; ?>/>
        </div>
        <?php } ?>
        </td>
      </tr>
      <?php } ?>
			<tr>
			  <td><?php echo $_language->get('entry_customer_id'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_customerid" name="pdf_invoice_customerid" value="1" <?php if($pdf_invoice_customerid) echo 'checked="checked"'; ?>/>
			  </td>
		  </tr>
      <tr>
			  <td><?php echo $_language->get('entry_user_comment'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_usercomment" name="pdf_invoice_usercomment" value="1" <?php if($_config->get('pdf_invoice_usercomment')) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
		  <tr>
				<td><?php echo $_language->get('entry_customer_format'); ?></td>
				<td>
					<?php echo $_language->get('entry_customer_prefix'); ?> <input class="form-control" type="text" name="pdf_invoice_customerprefix" value="<?php echo $pdf_invoice_customerprefix; ?>" size="9"  style="margin-right:30px"/>
					<?php echo $_language->get('entry_customer_size'); ?> <input class="form-control" type="text" name="pdf_invoice_customersize" value="<?php echo $pdf_invoice_customersize; ?>" size="1"/>
				</td>
			</tr>
			<tr>
				<td><?php echo $_language->get('entry_duedate'); ?></td>
				<td><input class="form-control" type="text" name="pdf_invoice_duedate" value="<?php echo $pdf_invoice_duedate; ?>" size="3"/></td>
			</tr>
      <tr>
			  <td><?php echo $_language->get('entry_duedate_invoice'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_duedate_invoice" name="pdf_invoice_duedate_invoice" value="1" <?php if($_config->get('pdf_invoice_duedate_invoice')) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
      <tr>
			  <td><?php echo $_language->get('entry_date_invoice'); ?></td>
			  <td>
				<input class="switch" type="checkbox" id="pdf_invoice_date_invoice" name="pdf_invoice_date_invoice" value="1" <?php if($_config->get('pdf_invoice_date_invoice')) echo 'checked="checked"'; ?>/>
			  </td>
			</tr>
      <tr>
					<td><?php echo $_language->get('entry_filename'); ?></td>
					<td>
						<div class="inlineEdit">
							<div class="switchBtn">
								<?php
								$pdfFilename = array();
								if($_config->get('pdf_invoice_filename_prefix') && $_config->get('pdf_invoice_filename_'.$_config->get('config_language')))
									$pdfFilename[] = trim($_language->get('entry_filename_prefix'));
								if($_config->get('pdf_invoice_filename_invnum'))
									$pdfFilename[] = $_language->get('entry_filename_invnum');
								if($_config->get('pdf_invoice_filename_ordnum'))
									$pdfFilename[] =  $_language->get('entry_filename_ordnum');
								$pdfFilename = implode('-', $pdfFilename) ? implode('-', $pdfFilename).'.pdf' : 'invoice.pdf';
								?>
								<img style="position:relative;top:3px" src="<?php echo $_img_path; ?>pdf.png" alt="filename"/> <?php echo $pdfFilename; ?>
							</div>
							<div class="switchContent">
								<img style="position:relative;top:3px" src="<?php echo $_img_path; ?>pdf.png" alt="filename"/>
						<label><input type="checkbox" name="pdf_invoice_filename_prefix" value="1" <?php if($pdf_invoice_filename_prefix) echo 'checked="checked"'; ?> /><?php echo $_language->get('entry_filename_prefix'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label><input type="checkbox" name="pdf_invoice_filename_invnum" value="1" <?php if($pdf_invoice_filename_invnum) echo 'checked="checked"'; ?> /><?php echo $_language->get('entry_filename_invnum'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<label><input type="checkbox" name="pdf_invoice_filename_ordnum" value="1" <?php if($pdf_invoice_filename_ordnum) echo 'checked="checked"'; ?> /><?php echo $_language->get('entry_filename_ordnum'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.pdf
							</div>
						</div>
					</td>
				</tr>
			</table>
			<table class="form">
			<tr>
			  <td colspan="2">
					<ul class="nav nav-tabs">
						<?php $f=0; foreach ($languages as $language) { ?>
							<li<?php if(!$f) { echo ' class="active"'; $f=1;} ?>><a href="#tab-language-<?php echo  $language['code']; ?>" data-toggle="tab"><img src="<?php echo $language['image']; ?>" alt=""/> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
					<div class="tab-content">
						<?php $f=0; foreach ($languages as $language) { ?>
							<div id="tab-language-<?php echo $language['code']; ?>" class="tab-pane<?php if(!$f) {echo ' active'; $f=1;} ?>">
								<table class="form">
									<tr>
										<td><?php echo $_language->get('entry_filename_prefix_text'); ?></td>
										<td><input class="form-control" type="text" name="pdf_invoice_filename_<?php echo $language['language_id']; ?>" value="<?php echo ${'pdf_invoice_filename_'.$language['language_id'] }; ?>" size="63"/></td>
									</tr>
									<tr>
										<td><?php echo $_language->get('entry_size'); ?></td>
										<td>
											<select class="form-control" name="pdf_invoice_size_<?php echo $language['language_id']; ?>">
												<option value="A4" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'A4') echo 'selected="selected"'; ?>>A4</option>
												<option value="A4-L" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'A4-L') echo 'selected="selected"'; ?>>A4 landscape</option>
												<option value="Letter" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'Letter') echo 'selected="selected"'; ?>>Letter</option>
												<option value="Letter-L" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'Letter-L') echo 'selected="selected"'; ?>>Letter landscape</option>
												<option value="Legal" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'Legal') echo 'selected="selected"'; ?>>Legal</option>
												<option value="Legal-L" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'Legal-L') echo 'selected="selected"'; ?>>Legal landscape</option>
                        <option value="A5" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'A5') echo 'selected="selected"'; ?>>A5</option>
												<option value="A5-L" <?php if(${'pdf_invoice_size_'.$language['language_id']} == 'A5-L') echo 'selected="selected"'; ?>>A5 landscape</option>
											</select>
										</td>
									</tr>
									<tr>
										<td><?php echo $_language->get('entry_footer'); ?></td>
										<td>
                      						<textarea name="pdf_invoice_footer_<?php echo $language['language_id']; ?>" id="pdf_invoice_footer_<?php echo $language['language_id']; ?>"><?php echo ${'pdf_invoice_footer_'.$language['language_id'] }; ?></textarea>
										</td>
									</tr>
								</table>
							</div>
						<?php } ?>
					</div>
				</td>
			</tr>
		</table>
		</div>
		<div class="tab-pane" id="tab-2">
			<table class="form">
				<tr>
				  <td><?php echo $_language->get('entry_logo'); ?></td>
				  <td valign="top">
					  
					  <?php if ($OC_V2) { ?>
							<a href="" id="thumb-image" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb_header; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
							<input type="hidden" name="pdf_invoice_logo" value="<?php echo $pdf_invoice_logo; ?>" id="input-image" />
					  <?php } else { ?>
						<div class="image" style="text-align:center; float:left;"><img src="<?php echo $thumb_header; ?>" alt="" id="thumb_header" />
					  <input type="hidden" name="pdf_invoice_logo" value="<?php echo $pdf_invoice_logo; ?>" id="pdf_invoice_logo" />
					  <br />
					  </div>
					  <div style="margin-left:10px;float:left;"><br /><a onclick="image_upload('pdf_invoice_logo', 'thumb_header');"><?php echo $_language->get('text_browse'); ?></a><br /><br /><a onclick="$('#thumb_header').attr('src', '<?php echo $no_image; ?>'); $('#pdf_invoice_logo').attr('value', '');"><?php echo $_language->get('text_clear'); ?></a></div>
					  <?php } ?>
					</td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_template'); ?></td>
				  <td><select class="form-control" name="pdf_invoice_template">
					  <?php foreach ($templates as $template) { ?>
					  <?php if ($template == $pdf_invoice_template) { ?>
					  <option value="<?php echo $template; ?>" selected="selected"><?php echo $template; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select></td>
				</tr>
				<tr>
				  <td></td>
				  <td id="template"><img src="<?php echo HTTP_CATALOG . 'catalog/view/theme/default/template/pdf/' . $pdf_invoice_template . '.png'; ?>" alt="No preview available for this template"/></td>
				</tr>
        <tr>
				  <td><?php echo $_language->get('entry_template_group'); ?> </td>
				  <td>
            <?php foreach ($customer_groups as $value) { ?>
            <?php echo $value['name']; ?>
            <select class="form-control" name="pdf_invoice_template_group_<?php echo $value['customer_group_id']; ?>">
              <option value=""><?php echo $_language->get('text_template_use_main'); ?></option>
              <?php foreach ($templates as $template) { ?>
              <?php if (isset(${'pdf_invoice_template_group_'.$value['customer_group_id']}) && $template == ${'pdf_invoice_template_group_'.$value['customer_group_id']}) { ?>
              <option value="<?php echo $template; ?>" selected="selected"><?php echo $template; ?></option>
              <?php } else { ?>
              <option value="<?php echo $template; ?>"><?php echo $template; ?></option>
              <?php } ?>
              <?php } ?>
            </select><br/>
            <?php } ?>
          </td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_columns'); ?></td>
				  <td class="sortable">
					<?php foreach ($pdf_invoice_columns as $col => $val) { ?>
					<div class="sortable_div">
						<i class="fa fa-arrows-v"></i> <span class="label"><?php echo $_language->get('entry_col_'.$col); ?></span>
						<input type="hidden" name="pdf_invoice_columns[<?php echo $col; ?>]" value="0"/>
						<input class="switch" type="checkbox"  id="pdf_invoice_col_<?php echo $col; ?>" name="pdf_invoice_columns[<?php echo $col; ?>]" value="1" <?php echo $val ? 'checked="checked"':''; ?>/>
						<div class="clear"></div>
					</div>
					<?php } ?>
					<div class="unsortable_div">
						<span class="label"><?php echo $_language->get('entry_col_total_tax'); ?></span>
						<div class="clear"></div>
					</div>
				   </td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_tax'); ?></td>
				  <td class="colors">
					<div>
							<input type="hidden" name="pdf_invoice_total_tax" value="0"/>
							<input class="switch" type="checkbox"  id="pdf_invoice_total_tax" name="pdf_invoice_total_tax" value="1" <?php echo $pdf_invoice_total_tax ? 'checked="checked"':''; ?>/>
						</div>
				  </td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_totals_tax'); ?></td>
				  <td><select class="form-control" name="pdf_invoice_totals_tax">
					  <option value="0"><?php echo $_language->get('text_none'); ?></option>
					  <?php foreach ($tax_classes as $tax_class) { ?>
					  <?php if ($tax_class['tax_class_id'] == $pdf_invoice_totals_tax) { ?>
					  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select></td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_product_options'); ?></td>
				  <td class="colors">
					<?php foreach ($pdf_invoice_options as $col => $val) { ?>
					<div>
						<span><?php echo $_language->get('entry_col_'.$col); ?></span>
						<input type="hidden" name="pdf_invoice_options[<?php echo $col; ?>]" value="0"/>
						<input class="switch" type="checkbox"  id="pdf_invoice_opt_<?php echo $col; ?>" name="pdf_invoice_options[<?php echo $col; ?>]" value="1" <?php echo $val ? 'checked="checked"':''; ?>/>
					</div>
					<?php } ?>
				  </td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_thumbsize'); ?></td>
				  <td class="form-inline"><input class="form-control" type="text" name="pdf_invoice_thumbwidth" value="<?php echo $pdf_invoice_thumbwidth; ?>" size="5"/>
					x
					<input class="form-control" type="text" name="pdf_invoice_thumbheight" value="<?php echo $pdf_invoice_thumbheight; ?>" size="5" />
				  </td>
				</tr>
       			<tr>
				  <td><?php echo $_language->get('entry_barcode_column'); ?></td>
				  <td class="multiple">
            <div>
              <?php echo $_language->get('entry_barcode_type'); ?>
              <select class="form-control" class="form-control" name="pdf_invoice_col_barcode[type]">
              <?php foreach ($barcode_types as $bcode) { ?>
                <option <?php if(!empty($pdf_invoice_col_barcode['type']) && $pdf_invoice_col_barcode['type'] == $bcode) echo 'selected="selected"'; ?>><?php echo $bcode; ?></option>
              <?php } ?>
              </select>
						</div>
            <div>
              <?php echo $_language->get('entry_barcode_value'); ?>
              <select class="form-control" class="form-control" name="pdf_invoice_col_barcode[value]">
                <option <?php if(!empty($pdf_invoice_col_barcode['value']) && $pdf_invoice_col_barcode['value'] == 'product_id') echo 'selected="selected"'; ?> value="product_id"><?php echo $_language->get('entry_col_product_id'); ?></option>
                <option <?php if(!empty($pdf_invoice_col_barcode['value']) && $pdf_invoice_col_barcode['value'] == 'sku') echo 'selected="selected"'; ?> value="sku"><?php echo $_language->get('entry_col_sku'); ?></option>
                <option <?php if(!empty($pdf_invoice_col_barcode['value']) && $pdf_invoice_col_barcode['value'] == 'upc') echo 'selected="selected"'; ?> value="upc"><?php echo $_language->get('entry_col_upc'); ?></option>
                <option <?php if(!empty($pdf_invoice_col_barcode['value']) && $pdf_invoice_col_barcode['value'] == 'ean') echo 'selected="selected"'; ?> value="ean"><?php echo $_language->get('entry_col_ean'); ?></option>
              </select>
						</div>
				  </td>
				</tr>
       	<tr>
				  <td><?php echo $_language->get('entry_barcode'); ?></td>
				  <td class="multiple">
            <div>
							<input type="hidden" name="pdf_invoice_barcode[status]" value="0"/>
							<input class="switch" type="checkbox" id="pdf_invoice_barcode_status" name="pdf_invoice_barcode[status]" value="1" <?php echo !empty($pdf_invoice_barcode['status']) ? 'checked="checked"':''; ?>/>
						</div>
            <div>
              	<?php echo $_language->get('entry_barcode_type'); ?>
                <select class="form-control" name="pdf_invoice_barcode[type]">
                <?php foreach ($barcode_types as $bcode) { ?>
                  <option <?php if(!empty($pdf_invoice_barcode['type']) && $pdf_invoice_barcode['type'] == $bcode) echo 'selected="selected"'; ?>><?php echo $bcode; ?></option>
                <?php } ?>
              </select>
						</div>
            <div>
              	<?php echo $_language->get('entry_barcode_value'); ?>
                <select class="form-control" name="pdf_invoice_barcode[value]">
                  <option <?php if(!empty($pdf_invoice_barcode['value']) && $pdf_invoice_barcode['value'] == '{order_id}') echo 'selected="selected"'; ?> value="{order_id}"><?php echo $_language->get('text_barcode_order_id'); ?></option>
                  <option <?php if(!empty($pdf_invoice_barcode['value']) && $pdf_invoice_barcode['value'] == '{invoice_no}') echo 'selected="selected"'; ?> value="{invoice_no}"><?php echo $_language->get('text_barcode_invoice_no'); ?></option>
                  <option <?php if(!empty($pdf_invoice_barcode['value']) && $pdf_invoice_barcode['value'] == '{invoice_prefix}{invoice_no}') echo 'selected="selected"'; ?> value="{invoice_prefix}{invoice_no}"><?php echo $_language->get('text_barcode_full_invoice_no'); ?></option>
                  <option <?php if(!empty($pdf_invoice_barcode['value']) && $pdf_invoice_barcode['value'] == '{customer_id}') echo 'selected="selected"'; ?> value="{customer_id}"><?php echo $_language->get('text_barcode_customer_id'); ?></option>
                  <option <?php if(!empty($pdf_invoice_barcode['value']) && $pdf_invoice_barcode['value'] == '{order_url}') echo 'selected="selected"'; ?> value="{order_url}"><?php echo $_language->get('text_barcode_order_url'); ?></option>
              </select>
						</div>
				  </td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_colors'); ?></td>
				  <td class="colors">
					<div>
						<span><?php echo $_language->get('entry_color_text'); ?></span>
						<input name="pdf_invoice_color_text" class="colorpicker" value="<?php echo $pdf_invoice_color_text; ?>" />
					</div>
					<div>
						<span><?php echo $_language->get('entry_color_title'); ?></span>
						<input name="pdf_invoice_color_title" class="colorpicker" value="<?php echo $pdf_invoice_color_title; ?>" />
					</div>
					<div>
						<span><?php echo $_language->get('entry_color_thead'); ?></span>
						<input name="pdf_invoice_color_thead" class="colorpicker" value="<?php echo $pdf_invoice_color_thead; ?>" />
					</div>
					<div>
						<span><?php echo $_language->get('entry_color_theadtxt'); ?></span>
						<input name="pdf_invoice_color_theadtxt" class="colorpicker" value="<?php echo $pdf_invoice_color_theadtxt; ?>" />
					</div>
					<div>
						<span><?php echo $_language->get('entry_color_tborder'); ?></span>
						<input name="pdf_invoice_color_tborder" class="colorpicker" value="<?php echo $pdf_invoice_color_tborder; ?>" />
					</div>
					<div>
						<span><?php echo $_language->get('entry_color_footertxt'); ?></span>
						<input name="pdf_invoice_color_footertxt" class="colorpicker" value="<?php echo $pdf_invoice_color_footertxt; ?>" />
					</div>
				   </td>
				</tr>
        <tr>
				  <td><?php echo $_language->get('entry_watermark'); ?></td>
				  <td valign="top">
					  <?php if ($OC_V2) { ?>
							<a href="" id="thumb-watermark" data-toggle="image" class="img-thumbnail"><img src="<?php echo $thumb_watermark; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a>
							<input type="hidden" name="pdf_invoice_watermark" value="<?php echo $pdf_invoice_watermark; ?>" id="input-watermark" />
					  <?php } else { ?>
						<div class="image" style="text-align:center; float:left;"><img src="<?php echo $thumb_watermark; ?>" alt="" id="thumb_header" />
					  <input type="hidden" name="pdf_invoice_watermark" value="<?php echo $pdf_invoice_watermark; ?>" id="pdf_invoice_watermark" />
					  <br />
					  </div>
					  <div style="margin-left:10px;float:left;"><br /><a onclick="image_upload('pdf_invoice_watermark', 'thumb_watermark');"><?php echo $_language->get('text_browse'); ?></a><br /><br /><a onclick="$('#thumb_watermark').attr('src', '<?php echo $no_image; ?>'); $('#pdf_invoice_watermark').attr('value', '');"><?php echo $_language->get('text_clear'); ?></a></div>
					  <?php } ?>
					</td>
				</tr>
		</table>
		</div>
		<div class="tab-pane" id="tab-4">
			<input type="hidden" name="pdf_invoice_blocks" value=""/>
			<ul class="nav nav-pills nav-stacked col-md-2" id="custom_blocks_tabs">
				<?php $module_row = 1; ?>
				 <?php foreach ($pdf_invoice_blocks as $module) { ?>
					<li<?php if($module_row === 1) echo ' class="active"'; ?>><a href="#tab-module-<?php echo $module_row; ?>" data-toggle="pill"><i class="fa fa-minus-circle" onclick="$('#tab-module-<?php echo $module_row; ?>').remove(); $(this).closest('li').remove(); $('#custom_blocks_tabs li:first a').trigger('click'); return false;"></i><?php echo $_language->get('tab_block') . ' ' . $module_row; ?></a></li>
					<?php $module_row++; ?>
				<?php } ?>
				<li id="module-add"><a><i onclick="addModule();" class="fa fa-plus-circle"></i><?php echo $_language->get('tab_add_block'); ?></a></li>
			</ul>
			<div class="tab-content col-md-10">
				<?php $module_row = 1; ?>
				<?php foreach ($pdf_invoice_blocks as $module) { ?>
				<div class="tab-pane <?php if($module_row === 1) echo ' active'; ?>" id="tab-module-<?php echo $module_row; ?>" class="vtabs-content">
					<ul class="nav nav-tabs">
						<?php $f=0; foreach ($languages as $language) { ?>
							<li class="<?php if(!$f) echo ' active'; $f=1; ?>"><a href="#tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
						<?php } ?>
					</ul>
				   <div class="tab-content">
					  <?php $f=0; foreach ($languages as $language) { ?>
					  <div class="tab-pane<?php if(!$f) echo ' active'; $f=1; ?>" id="tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>">
						<table class="form">
						 <tr>
							<td><?php echo $_language->get('entry_block_title'); ?></td>
							<td><input class="form-control" type="text" name="pdf_invoice_blocks[<?php echo $module_row; ?>][title][<?php echo $language['language_id']; ?>]; ?>" value="<?php echo isset($module['title'][$language['language_id']]) ? $module['title'][$language['language_id']] : ''; ?>" size="63"/></td>
						 </tr>
						  <tr>
							<td><button type="button" class="btn btn-default btn-xs info-btn" data-toggle="modal" data-target="#modal-info" data-info="tags"><i class="fa fa-info"></i></button><?php echo $_language->get('entry_block_message'); ?></td>
							<td>
                <?php if (defined('JPATH_MIJOSHOP_OC')) {
                    $desc = isset($module['description'][$language['language_id']]) ? $module['description'][$language['language_id']] : '';
                    echo MijoShop::get('base')->editor()->display("pdf_invoice_blocks[".$module_row."][description][".$language['language_id']."]", $desc, '97% !important', '320', '50', '11');
                  } else { ?>
                  <textarea name="pdf_invoice_blocks[<?php echo $module_row; ?>][description][<?php echo $language['language_id']; ?>]" id="description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><?php echo isset($module['description'][$language['language_id']]) ? $module['description'][$language['language_id']] : ''; ?></textarea>
                <?php } ?>
              </td>
						  </tr>
						</table>
					  </div>
					  <?php } ?>
					</div>
				  <table class="form">
          <tr>
					  <td><?php echo $_language->get('entry_block_target'); ?></td>
					  <td><select class="form-control" name="pdf_invoice_blocks[<?php echo $module_row; ?>][target]">
						  <?php foreach ($block_targets as $key => $name) { ?>
						  <?php if ($key == $module['target']) { ?>
						  <option value="<?php echo $key; ?>" selected="selected"><?php echo $name; ?></option>
						  <?php } else { ?>
						  <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
						  <?php } ?>
						  <?php } ?>
						</select></td>
					</tr>
					<tr>
					  <td><?php echo $_language->get('entry_block_position'); ?></td>
					  <td><select class="form-control" name="pdf_invoice_blocks[<?php echo $module_row; ?>][position]">
						  <?php foreach ($block_positions as $key => $name) { ?>
						  <?php if ($key == $module['position']) { ?>
						  <option value="<?php echo $key; ?>" selected="selected"><?php echo $name; ?></option>
						  <?php } else { ?>
						  <option value="<?php echo $key; ?>"><?php echo $name; ?></option>
						  <?php } ?>
						  <?php } ?>
						</select></td>
					</tr>
          <tr>
					  <td><?php echo $_language->get('entry_block_inline'); ?></td>
					  <td><select class="form-control" name="pdf_invoice_blocks[<?php echo $module_row; ?>][inline]">
              <option value=""<?php echo (empty($module['inline'])) ? ' selected="selected"' : ''; ?>><?php echo $text_enabled; ?></option>
              <option value="1"<?php echo (!empty($module['inline'])) ? ' selected="selected"' : ''; ?>><?php echo $text_disabled; ?></option>
						</select></td>
					</tr>
					<tr>
					  <td><?php echo $_language->get('entry_block_display'); ?></td>
					  <td><select class="form-control" name="pdf_invoice_blocks[<?php echo $module_row; ?>][display]">
						<optgroup label="<?php echo $_language->get('entry_display_always'); ?>">
							<option value="always|1"<?php echo ($module['display'] == 'always|1') ? ' selected="selected"' : ''; ?>><?php echo $text_enabled; ?></option>
							<option value="always|0"<?php echo ($module['display'] == 'always|0') ? ' selected="selected"' : ''; ?>><?php echo $text_disabled; ?></option>
						</optgroup>
            <optgroup label="<?php echo $_language->get('entry_display_comment'); ?>">
							<option value="comment|1"<?php echo ($module['display'] == 'comment|1') ? ' selected="selected"' : ''; ?>><?php echo $text_enabled; ?></option>
						</optgroup>
						<optgroup label="<?php echo $_language->get('entry_display_group'); ?>">
						<?php foreach ($customer_groups as $value) { ?>
							 <option value="customer_group_id|<?php echo $value['customer_group_id']; ?>"<?php echo ($module['display'] == 'customer_group_id|'.$value['customer_group_id']) ? ' selected="selected"' : ''; ?>><?php echo  $value['name']; ?></option>
						<?php } ?>
						</optgroup>
						<optgroup label="<?php echo $_language->get('entry_display_orderstatus'); ?>">
						<?php foreach ($order_statuses as $value) { ?>
							 <option value="order_status_id|<?php echo $value['order_status_id']; ?>"<?php echo ($module['display'] == 'order_status_id|'.$value['order_status_id']) ? ' selected="selected"' : ''; ?>><?php echo  $value['name']; ?></option>
						<?php } ?>
						</optgroup>
            <optgroup label="<?php echo $_language->get('entry_display_credit'); ?>">
							<option value="credit|1"<?php echo ($module['display'] == 'credit|1') ? ' selected="selected"' : ''; ?>><?php echo $_language->get('text_is_credit'); ?></option>
							<option value="credit|0"<?php echo ($module['display'] == 'credit|0') ? ' selected="selected"' : ''; ?>><?php echo $_language->get('text_isnot_credit'); ?></option>
						</optgroup>
            <optgroup label="<?php echo $_language->get('entry_display_invnum'); ?>">
							<option value="invnum|1"<?php echo ($module['display'] == 'invnum|1') ? ' selected="selected"' : ''; ?>><?php echo $_language->get('text_has_invnum'); ?></option>
							<option value="invnum|0"<?php echo ($module['display'] == 'invnum|0') ? ' selected="selected"' : ''; ?>><?php echo $_language->get('text_no_invnum'); ?></option>
						</optgroup>
						<optgroup label="<?php echo $_language->get('entry_display_payment'); ?>">
						<?php foreach ($payment_methods as $value) { ?>
							 <option value="payment_code|<?php echo $value['code']; ?>"<?php echo ($module['display'] == 'payment_code|'.$value['code']) ? ' selected="selected"' : ''; ?>><?php echo  $value['name']; ?></option>
						<?php } ?>
						</optgroup>
						<optgroup label="<?php echo $_language->get('entry_display_shipping'); ?>">
						<?php foreach ($shipping_methods as $value) { ?>
							 <option value="shipping_code|<?php echo $value['code']; ?>"<?php echo ($module['display'] == 'shipping_code|'.$value['code']) ? ' selected="selected"' : ''; ?>><?php echo  $value['name']; ?></option>
						<?php } ?>
						</optgroup>
						<optgroup label="<?php echo $_language->get('entry_display_payment_zone'); ?>">
						<?php foreach ($geo_zones as $value) { ?>
							 <option value="shipping_zone|<?php echo $value['geo_zone_id']; ?>"<?php echo ($module['display'] == 'shipping_zone|'.$value['geo_zone_id']) ? ' selected="selected"' : ''; ?>><?php echo  $value['name']; ?></option>
						<?php } ?>
						</optgroup>
						<optgroup label="<?php echo $_language->get('entry_display_shipping_zone'); ?>">
						<?php foreach ($geo_zones as $value) { ?>
							 <option value="payment_zone|<?php echo $value['geo_zone_id']; ?>"<?php echo ($module['display'] == 'payment_zone|'.$value['geo_zone_id']) ? ' selected="selected"' : ''; ?>><?php echo  $value['name']; ?></option>
						<?php } ?>
						</optgroup>
            <?php if (in_array('quick_status_updater', $installed_modules)) { ?>
            <optgroup label="<?php echo $_language->get('entry_display_qosu'); ?>">
							 <option value="tracking|1"<?php echo ($module['display'] == 'tracking|1') ? ' selected="selected"' : ''; ?>><?php echo $_language->get('entry_display_qosu_tracking'); ?></option>
						</optgroup>
						<?php } ?>
						</select></td>
					</tr>
					<tr>
					  <td><?php echo $_language->get('entry_sort_order'); ?></td>
					  <td><input class="form-control" type="text" name="pdf_invoice_blocks[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
					</tr>
				  </table>
				</div>
				<?php $module_row++; ?>
				<?php } ?>
			</div>
      <div class="clearfix"></div>
		</div>
		<?php if (true || !$store_id) { ?>
		<div class="tab-pane" id="tab-5">
			<table class="form">
				<tr>
				  <td><?php echo $_language->get('entry_packingslip'); ?></td>
				  <td>
					<input class="switch" type="checkbox" id="pdf_invoice_packingslip" name="pdf_invoice_packingslip" value="1" <?php if($pdf_invoice_packingslip) echo 'checked="checked"'; ?>/>
				  </td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_template'); ?></td>
				  <td><select class="form-control" name="pdf_invoice_sliptemplate">
					  <?php foreach ($slip_templates as $slip_template) { ?>
					  <?php if ($slip_template == $pdf_invoice_sliptemplate) { ?>
					  <option value="<?php echo $slip_template; ?>" selected="selected"><?php echo $slip_template; ?></option>
					  <?php } else { ?>
					  <option value="<?php echo $slip_template; ?>"><?php echo $slip_template; ?></option>
					  <?php } ?>
					  <?php } ?>
					</select></td>
				</tr>
        <tr>
          <td><?php echo $_language->get('entry_adminlanguage'); ?></td>
          <td>
            <select class="form-control" name="pdf_invoice_adminlang">
              <option value=""><?php echo $_language->get('text_order_language'); ?></option>
            <?php foreach ($languages as $language) { ?>
              <?php if ($language['language_id'] == $pdf_invoice_adminlang) { ?>
              <option value="<?php echo $language['language_id']; ?>" selected="selected" style="background:url('<?php echo $language['image']; ?>') 3px 2px no-repeat;padding-left:25px;"><?php echo $language['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $language['language_id']; ?>" style="background:url('<?php echo $language['image']; ?>') 3px 2px no-repeat;padding-left:25px"> <?php echo $language['name']; ?></option>
              <?php } ?>
            <?php } ?>
            </select>
          </td>
        </tr>
				<tr>
				  <td></td>
				  <td id="sliptemplate"><img src="<?php echo HTTP_CATALOG . 'catalog/view/theme/default/template/pdf/packingslip/' . $pdf_invoice_sliptemplate . '.png'; ?>" alt="No preview available for this template"/></td>
				</tr>
				<tr>
				  <td><?php echo $_language->get('entry_logo'); ?></td>
				  <td>
					<input class="switch" type="checkbox" id="pdf_invoice_sliplogo" name="pdf_invoice_sliplogo" value="1" <?php if($pdf_invoice_sliplogo) echo 'checked="checked"'; ?>/>
				  </td>
				</tr>
        <tr>
          <td><?php echo $_language->get('entry_user_comment_slip'); ?></td>
          <td>
          <input class="switch" type="checkbox" id="pdf_invoice_slip_usercomment" name="pdf_invoice_slip_usercomment" value="1" <?php if($_config->get('pdf_invoice_slip_usercomment')) echo 'checked="checked"'; ?>/>
          </td>
        </tr>
        <tr>
          <td><?php echo $_language->get('entry_slip_summary'); ?></td>
          <td>
          <input class="switch" type="checkbox" id="pdf_invoice_slip_summary" name="pdf_invoice_slip_summary" value="1" <?php if($_config->get('pdf_invoice_slip_summary')) echo 'checked="checked"'; ?>/>
          </td>
        </tr>
				<tr>
				  <td><?php echo $_language->get('entry_columns'); ?></td>
				  <td class="sortable">
					<?php foreach ($pdf_invoice_slip_columns as $col => $val) { ?>
					<div class="sortable_div">
						<i class="fa fa-arrows-v"></i> <span class="label"><?php echo $_language->get('entry_col_'.$col); ?></span>
						<input type="hidden" name="pdf_invoice_slip_columns[<?php echo $col; ?>]" value="0"/>
						<input class="switch" type="checkbox"  id="pdf_invoice_slip_col_<?php echo $col; ?>" name="pdf_invoice_slip_columns[<?php echo $col; ?>]" value="1" <?php echo $val ? 'checked="checked"':''; ?>/>
						<div class="clear"></div>
					</div>
					<?php } ?>
				   </td>
				</tr>
        </tr>
        <tr>
				  <td><?php echo $_language->get('entry_thumbsize'); ?></td>
				  <td class="form-inline"><input class="form-control" type="text" name="pdf_invoice_packingslip_thumbwidth" value="<?php echo $pdf_invoice_packingslip_thumbwidth; ?>" size="5"/>
					x
					<input class="form-control" type="text" name="pdf_invoice_packingslip_thumbheight" value="<?php echo $pdf_invoice_packingslip_thumbheight; ?>" size="5" />
				  </td>
				</tr>
       			<tr>
				  <td><?php echo $_language->get('entry_barcode_column'); ?></td>
				  <td class="multiple">
            <div>
              <?php echo $_language->get('entry_barcode_type'); ?>
              <select class="form-control" class="form-control" name="pdf_invoice_slip_col_barcode[type]">
              <?php foreach ($barcode_types as $bcode) { ?>
                <option <?php if(!empty($pdf_invoice_slip_col_barcode['type']) && $pdf_invoice_slip_col_barcode['type'] == $bcode) echo 'selected="selected"'; ?>><?php echo $bcode; ?></option>
              <?php } ?>
              </select>
						</div>
            <div>
              	<?php echo $_language->get('entry_barcode_value'); ?>
                <select class="form-control" class="form-control" name="pdf_invoice_slip_col_barcode[value]">
                  <option <?php if(!empty($pdf_invoice_slip_col_barcode['value']) && $pdf_invoice_slip_col_barcode['value'] == 'product_id') echo 'selected="selected"'; ?> value="product_id"><?php echo $_language->get('entry_col_product_id'); ?></option>
                  <option <?php if(!empty($pdf_invoice_slip_col_barcode['value']) && $pdf_invoice_slip_col_barcode['value'] == 'sku') echo 'selected="selected"'; ?> value="sku"><?php echo $_language->get('entry_col_sku'); ?></option>
                  <option <?php if(!empty($pdf_invoice_slip_col_barcode['value']) && $pdf_invoice_slip_col_barcode['value'] == 'upc') echo 'selected="selected"'; ?> value="upc"><?php echo $_language->get('entry_col_upc'); ?></option>
                  <option <?php if(!empty($pdf_invoice_slip_col_barcode['value']) && $pdf_invoice_slip_col_barcode['value'] == 'ean') echo 'selected="selected"'; ?> value="ean"><?php echo $_language->get('entry_col_ean'); ?></option>
              </select>
						</div>
				  </td>
				</tr>
       	<tr>
				  <td><?php echo $_language->get('entry_barcode'); ?></td>
				  <td class="multiple">
            <div>
							<input type="hidden" name="pdf_invoice_slip_barcode[status]" value="0"/>
							<input class="switch" type="checkbox" id="pdf_invoice_slip_barcode_status" name="pdf_invoice_slip_barcode[status]" value="1" <?php echo !empty($pdf_invoice_slip_barcode['status']) ? 'checked="checked"':''; ?>/>
						</div>
            <div>
              	<?php echo $_language->get('entry_barcode_type'); ?>
                <select class="form-control" class="form-control" name="pdf_invoice_slip_barcode[type]">
                <?php foreach ($barcode_types as $bcode) { ?>
                  <option <?php if(!empty($pdf_invoice_slip_barcode['type']) && $pdf_invoice_slip_barcode['type'] == $bcode) echo 'selected="selected"'; ?>><?php echo $bcode; ?></option>
                <?php } ?>
              </select>
						</div>
            <div>
              	<?php echo $_language->get('entry_barcode_value'); ?>
                <select class="form-control" class="form-control" name="pdf_invoice_slip_barcode[value]">
                  <option <?php if(!empty($pdf_invoice_slip_barcode['value']) && $pdf_invoice_slip_barcode['value'] == '{order_id}') echo 'selected="selected"'; ?> value="{order_id}"><?php echo $_language->get('text_barcode_order_id'); ?></option>
                  <option <?php if(!empty($pdf_invoice_slip_barcode['value']) && $pdf_invoice_slip_barcode['value'] == '{invoice_no}') echo 'selected="selected"'; ?> value="{invoice_no}"><?php echo $_language->get('text_barcode_invoice_no'); ?></option>
                  <option <?php if(!empty($pdf_invoice_slip_barcode['value']) && $pdf_invoice_slip_barcode['value'] == '{invoice_prefix}{invoice_no}') echo 'selected="selected"'; ?> value="{invoice_prefix}{invoice_no}"><?php echo $_language->get('text_barcode_full_invoice_no'); ?></option>
                  <option <?php if(!empty($pdf_invoice_slip_barcode['value']) && $pdf_invoice_slip_barcode['value'] == '{customer_id}') echo 'selected="selected"'; ?> value="{customer_id}"><?php echo $_language->get('text_barcode_customer_id'); ?></option>
                  <option <?php if(!empty($pdf_invoice_slip_barcode['value']) && $pdf_invoice_slip_barcode['value'] == '{order_url}') echo 'selected="selected"'; ?> value="{order_url}"><?php echo $_language->get('text_barcode_order_url'); ?></option>
              </select>
						</div>
				  </td>
				</tr>
			</table>
		</div>
		<div class="tab-pane" id="tab-3">
			<table class="form">
				<tr>
				  <td><?php echo $_language->get('entry_backup'); ?></td>
				  <td>
					<input class="switch" type="checkbox" id="pdf_invoice_backup" name="pdf_invoice_backup" value="1" <?php if($pdf_invoice_backup) echo 'checked="checked"'; ?>/>
				  </td>
				</tr>
				<tr>
					<td><?php echo $_language->get('entry_backup_on'); ?></td>
					<td>
						<select class="form-control" name="pdf_invoice_backup_moment">
							<option value="order" <?php if($pdf_invoice_backup_moment == 'order') echo 'selected="selected"'; ?>><?php echo $_language->get('entry_backup_onorder'); ?></option>
							<option value="invoiceno" <?php if($pdf_invoice_backup_moment == 'invoiceno') echo 'selected="selected"'; ?>><?php echo $_language->get('entry_backup_oninvoice'); ?></option>
							<option value="manual" <?php if($pdf_invoice_backup_moment == 'manual') echo 'selected="selected"'; ?>><?php echo $_language->get('entry_backup_onmanual'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $_language->get('entry_backup_structure'); ?></td>
					<td>
						<select class="form-control" name="pdf_invoice_backup_structure">
							<option value="" <?php if($pdf_invoice_backup_structure == '') echo 'selected="selected"'; ?>><?php echo $_language->get('entry_structure_1'); ?></option>
							<option value="Y" <?php if($pdf_invoice_backup_structure == 'Y') echo 'selected="selected"'; ?>><?php echo $_language->get('entry_structure_2'); ?></option>
							<option value="Y/m" <?php if($pdf_invoice_backup_structure == 'Y/m') echo 'selected="selected"'; ?>><?php echo $_language->get('entry_structure_3'); ?></option>
							<option value="Y/m/d" <?php if($pdf_invoice_backup_structure == 'Y/m/d') echo 'selected="selected"'; ?>><?php echo $_language->get('entry_structure_4'); ?></option>
						</select>
					</td>
				</tr>
				<tr>
					<td><?php echo $_language->get('entry_size'); ?></td>
					<td>
						<select class="form-control" name="pdf_invoice_backup_size">
							<option value="A4" <?php if($pdf_invoice_backup_size == 'A4') echo 'selected="selected"'; ?>>A4</option>
							<option value="A4-L" <?php if($pdf_invoice_backup_size == 'A4-L') echo 'selected="selected"'; ?>>A4 landscape</option>
							<option value="Letter" <?php if($pdf_invoice_backup_size == 'Letter') echo 'selected="selected"'; ?>>Letter</option>
							<option value="Letter-L" <?php if($pdf_invoice_backup_size == 'Letter-L') echo 'selected="selected"'; ?>>Letter landscape</option>
							<option value="Legal" <?php if($pdf_invoice_backup_size == 'Legal') echo 'selected="selected"'; ?>>Legal</option>
							<option value="Legal-L" <?php if($pdf_invoice_backup_size == 'Legal-L') echo 'selected="selected"'; ?>>Legal landscape</option>
						</select>
					</td>
				</tr>
				<?php
				$pdfFilename = array();
				if($_config->get('pdf_invoice_backup_prefix'))
					$pdfFilename[] = trim($_config->get('pdf_invoice_backup_prefix'));
				if($_config->get('pdf_invoice_backup_invnum'))
					$pdfFilename[] = $_language->get('entry_filename_invnum');
				if($_config->get('pdf_invoice_backup_ordnum'))
					$pdfFilename[] = $_language->get('entry_filename_ordnum');
				$pdfFilename = implode('-', $pdfFilename);
				?>
				<tr>
					<td><?php echo $_language->get('entry_filename'); ?></td>
					<td>
						<div class="inlineEdit">
							<div class="switchBtn">
								<img style="position:relative;top:3px" src="<?php echo $_img_path; ?>pdf.png" alt="filename"/> <?php echo $pdfFilename; ?>.pdf
							</div>
							<div class="switchContent form-inline">
								<img style="position:relative;top:3px" src="<?php echo $_img_path; ?>pdf.png" alt="filename"/>
								<input class="form-control" type="text" name="pdf_invoice_backup_prefix" value="<?php echo $pdf_invoice_backup_prefix; ?>"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label><input type="checkbox" name="pdf_invoice_backup_invnum" value="1" <?php if($pdf_invoice_backup_invnum) echo 'checked="checked"'; ?> /><?php echo $_language->get('entry_filename_invnum'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<label><input type="checkbox" name="pdf_invoice_backup_ordnum" value="1" <?php if($pdf_invoice_backup_ordnum) echo 'checked="checked"'; ?> /><?php echo $_language->get('entry_filename_ordnum'); ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.pdf
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td style="vertical-align:top"><?php echo $_language->get('entry_backup_folder'); ?></td>
					<td>
						<div class="inlineEdit">
							<div class="switchBtn"><img style="position:relative;top:2px" src="<?php echo $_img_path; ?>directory.png" alt="folder"/> <?php echo $pdf_invoice_backup_folder; ?></div>
							<div class="switchContent form-inline">
								<img style="position:relative;top:2px" src="<?php echo $_img_path; ?>directory.png" alt="folder"/> <input class="form-control" type="text" name="pdf_invoice_backup_folder" value="<?php echo $pdf_invoice_backup_folder; ?>" size="63"/>
								<br /><br /><span style="color:#049606" onclick="$('.backup_folder').hide();$('.backup_folder_btn').show();"><?php echo $_language->get('text_backup_folder_warning'); ?>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td><?php echo $_language->get('entry_backup_browser'); ?></td>
					<td><div id="pdfbrowser"></div></td>
				</tr>
			</table>
		</div>
		    <div class="tab-pane" id="tab-about">
      <div class="row">
        <div class="col-md-4">
          <h3><i class="fa fa-info-circle"></i> Extension details</h3>
          <div class="table-responsive">
            <table class="table"><tbody>
              <tr>
                <td>Module</td>
                <td><?php echo strip_tags($heading_title); ?></td>
              </tr>
              <tr>
                <td>Version</td>
                <td><?php echo $module_version; ?> - <?php echo $module_type; ?></td>
              </tr>
            <?php if (!empty($license_info)) { ?>
              <tr>
                <td colspan="2" style="padding:0;">
                  <h3 style="padding-top:40px;margin-bottom:10px;"><i class="fa fa-check-square"></i> Your License</h3>
                </td>
              </tr>
              <tr>
                <td>License holder</td>
                <td><?php echo $license_info['email']; ?></td>
              </tr>
              <tr>
                <td>Registered domain</td>
                <td><?php echo $license_info['website']; ?></td>
              </tr>
              <tr>
                <td>License expires on</td>
                <td><?php echo date('F d, Y', strtotime($license_info['support_date'])); ?></td>
              </tr>
              <tr>
                <td>License status</td>
                <td style="vertical-align:middle">
                  <?php if (time() > strtotime($license_info['support_date'])) { ?>
                    <span class="label label-danger" style="font-size:12px">Expired</span>
                  <?php } else { ?>
                    <span class="label label-success" style="font-size:12px"><i class="fa fa-check"></i> Valid</span>
                  <?php } ?>
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding:20px 0;">
                <?php if (time() > strtotime($license_info['support_date'])) { ?>
                  <a target="_blank" href="http://geekodev.com/renewal?module=<?php echo $module_code; ?>&license=<?php echo $license_info['license']; ?>" class="btn btn-success btn-block" style="font-size:14px;"><i class="fa fa-refresh"></i> Renew my license</a>
                  <?php } else { ?>
                  <a target="_blank" href="http://geekodev.com/login" class="btn btn-grey btn-block" style="font-size:14px;"><i class="fa fa-cog"></i> Manage my license</a>
                <?php } ?>
                </td>
              </tr>
            <?php } else { ?>
              <tr><td colspan="2"></td></tr>
            <?php } ?>
            </tbody></table>
          </div>
        </div>
        <div class="col-md-8">
          <h3><i class="fa fa-external-link"></i> Connect with us</h3>
          <div class="row">
            <div class="col-md-12">
              <div class="well text-center">
                <div style="height:80px"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAACXBIWXMAAAsTAAALEwEAmpwYAAA5z2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS41LWMwMTQgNzkuMTUxNDgxLCAyMDEzLzAzLzEzLTEyOjA5OjE1ICAgICAgICAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgICAgICAgICB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIgogICAgICAgICAgICB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iCiAgICAgICAgICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgICAgICAgICAgeG1sbnM6dGlmZj0iaHR0cDovL25zLmFkb2JlLmNvbS90aWZmLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOmV4aWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vZXhpZi8xLjAvIj4KICAgICAgICAgPHhtcDpDcmVhdG9yVG9vbD5BZG9iZSBQaG90b3Nob3AgQ0MgKFdpbmRvd3MpPC94bXA6Q3JlYXRvclRvb2w+CiAgICAgICAgIDx4bXA6Q3JlYXRlRGF0ZT4yMDE2LTA2LTEzVDE4OjMyOjA2KzAyOjAwPC94bXA6Q3JlYXRlRGF0ZT4KICAgICAgICAgPHhtcDpNZXRhZGF0YURhdGU+MjAxNi0wNi0xM1QxODozMjowNiswMjowMDwveG1wOk1ldGFkYXRhRGF0ZT4KICAgICAgICAgPHhtcDpNb2RpZnlEYXRlPjIwMTYtMDYtMTNUMTg6MzI6MDYrMDI6MDA8L3htcDpNb2RpZnlEYXRlPgogICAgICAgICA8eG1wTU06SW5zdGFuY2VJRD54bXAuaWlkOjRlN2U2MGY0LTdiYzYtMDY0Ni04ZTJhLThhNWRhNWRlMjEyYjwveG1wTU06SW5zdGFuY2VJRD4KICAgICAgICAgPHhtcE1NOkRvY3VtZW50SUQ+eG1wLmRpZDowMjgzNzFmNC00MzJlLTY5NDctYjk4ZS1hZGJmNTBiZWViMDk8L3htcE1NOkRvY3VtZW50SUQ+CiAgICAgICAgIDx4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ+eG1wLmRpZDowMjgzNzFmNC00MzJlLTY5NDctYjk4ZS1hZGJmNTBiZWViMDk8L3htcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD4KICAgICAgICAgPHhtcE1NOkhpc3Rvcnk+CiAgICAgICAgICAgIDxyZGY6U2VxPgogICAgICAgICAgICAgICA8cmRmOmxpIHJkZjpwYXJzZVR5cGU9IlJlc291cmNlIj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmFjdGlvbj5jcmVhdGVkPC9zdEV2dDphY3Rpb24+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDppbnN0YW5jZUlEPnhtcC5paWQ6MDI4MzcxZjQtNDMyZS02OTQ3LWI5OGUtYWRiZjUwYmVlYjA5PC9zdEV2dDppbnN0YW5jZUlEPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6d2hlbj4yMDE2LTA2LTEzVDE4OjMyOjA2KzAyOjAwPC9zdEV2dDp3aGVuPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6c29mdHdhcmVBZ2VudD5BZG9iZSBQaG90b3Nob3AgQ0MgKFdpbmRvd3MpPC9zdEV2dDpzb2Z0d2FyZUFnZW50PgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgICAgPHJkZjpsaSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDphY3Rpb24+c2F2ZWQ8L3N0RXZ0OmFjdGlvbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0Omluc3RhbmNlSUQ+eG1wLmlpZDo0ZTdlNjBmNC03YmM2LTA2NDYtOGUyYS04YTVkYTVkZTIxMmI8L3N0RXZ0Omluc3RhbmNlSUQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDp3aGVuPjIwMTYtMDYtMTNUMTg6MzI6MDYrMDI6MDA8L3N0RXZ0OndoZW4+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpzb2Z0d2FyZUFnZW50PkFkb2JlIFBob3Rvc2hvcCBDQyAoV2luZG93cyk8L3N0RXZ0OnNvZnR3YXJlQWdlbnQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpjaGFuZ2VkPi88L3N0RXZ0OmNoYW5nZWQ+CiAgICAgICAgICAgICAgIDwvcmRmOmxpPgogICAgICAgICAgICA8L3JkZjpTZXE+CiAgICAgICAgIDwveG1wTU06SGlzdG9yeT4KICAgICAgICAgPGRjOmZvcm1hdD5pbWFnZS9wbmc8L2RjOmZvcm1hdD4KICAgICAgICAgPHBob3Rvc2hvcDpDb2xvck1vZGU+MzwvcGhvdG9zaG9wOkNvbG9yTW9kZT4KICAgICAgICAgPHRpZmY6T3JpZW50YXRpb24+MTwvdGlmZjpPcmllbnRhdGlvbj4KICAgICAgICAgPHRpZmY6WFJlc29sdXRpb24+NzIwMDAwLzEwMDAwPC90aWZmOlhSZXNvbHV0aW9uPgogICAgICAgICA8dGlmZjpZUmVzb2x1dGlvbj43MjAwMDAvMTAwMDA8L3RpZmY6WVJlc29sdXRpb24+CiAgICAgICAgIDx0aWZmOlJlc29sdXRpb25Vbml0PjI8L3RpZmY6UmVzb2x1dGlvblVuaXQ+CiAgICAgICAgIDxleGlmOkNvbG9yU3BhY2U+NjU1MzU8L2V4aWY6Q29sb3JTcGFjZT4KICAgICAgICAgPGV4aWY6UGl4ZWxYRGltZW5zaW9uPjYwPC9leGlmOlBpeGVsWERpbWVuc2lvbj4KICAgICAgICAgPGV4aWY6UGl4ZWxZRGltZW5zaW9uPjYwPC9leGlmOlBpeGVsWURpbWVuc2lvbj4KICAgICAgPC9yZGY6RGVzY3JpcHRpb24+CiAgIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgCjw/eHBhY2tldCBlbmQ9InciPz75HNQxAAAAIGNIUk0AAHolAACAgwAA+f8AAIDpAAB1MAAA6mAAADqYAAAXb5JfxUYAAAeeSURBVHja5Jt7cBXVHcc/NyEIhA1gJO2oPAQhsUAplFbrM8cOKBWoLzoWaEdbbXOmlbZOp04ftrVlSuuMWgZ1o44tVTRTUSOotRlHFrFIW0FrgEKFxIRHjGBQcqCBhJj+sb9LN8t97I13N+v4/Yfd88r97u9xfr/fOSR6enpIIpFI0F+wHasA+DKwADgPOANIAAeAfwF/BdZoZXblunYvjnEgbDvWSGA18IUAwzcADwI1WpnOjyrhx4H5OU7bA9wJ2NmIx4qw7VjFwLvAoD4usRO4RSvzbBDCBfQ/5n8IsgATgGdsx3rYdqzh2Qb3q4RtxxoEbAHOztOSTcA8rcyW2EnYdqxC4P48kgUYC7xiO9aloUtYpHUuMA2oECIjgE6gWb5+I7AfKAVulO0nDHQAc7Qya/PutGzHOgu4GfgmUEJ8cBiYrpXZmRfCtmNNAX4FzIuJ80uFN4AZVZXtx5MNA/qourcBP+rL/HwikShk9KkzGVFcQUfnAXa31dHR9a53yFTg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" alt="" style="position:relative;top:6px;"/></div>
                <h3>Made by GeekoDev</h3>
                <p>Developed with love and skill.<br/>Check our other great extensions on our website.</p>
                <a href="https://geekodev.com" target="_blank" class="btn btn-lg btn-grey">Visit our website</a>
              </div>
            </div>
          
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="well text-center">
                <div style="height:80px"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAD8AAABGCAYAAAB7ckzWAAAACXBIWXMAAAsTAAALEwEAmpwYAABCt2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS41LWMwMTQgNzkuMTUxNDgxLCAyMDEzLzAzLzEzLTEyOjA5OjE1ICAgICAgICAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIKICAgICAgICAgICAgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iCiAgICAgICAgICAgIHhtbG5zOnN0RXZ0PSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VFdmVudCMiCiAgICAgICAgICAgIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIgogICAgICAgICAgICB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIgogICAgICAgICAgICB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyI+CiAgICAgICAgIDx4bXA6Q3JlYXRvclRvb2w+QWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKTwveG1wOkNyZWF0b3JUb29sPgogICAgICAgICA8eG1wOkNyZWF0ZURhdGU+MjAxOC0xMi0xNFQxNDoyNjowMyswMTowMDwveG1wOkNyZWF0ZURhdGU+CiAgICAgICAgIDx4bXA6TWV0YWRhdGFEYXRlPjIwMTktMDUtMjFUMTE6NTA6MTMrMDI6MDA8L3htcDpNZXRhZGF0YURhdGU+CiAgICAgICAgIDx4bXA6TW9kaWZ5RGF0ZT4yMDE5LTA1LTIxVDExOjUwOjEzKzAyOjAwPC94bXA6TW9kaWZ5RGF0ZT4KICAgICAgICAgPGRjOmZvcm1hdD5pbWFnZS9wbmc8L2RjOmZvcm1hdD4KICAgICAgICAgPHhtcE1NOkluc3RhbmNlSUQ+eG1wLmlpZDphMmU2OTE0Yy01MGNkLTU5NDItYWE5OS1lNDhlYWM5YmU4MDU8L3htcE1NOkluc3RhbmNlSUQ+CiAgICAgICAgIDx4bXBNTTpEb2N1bWVudElEPmFkb2JlOmRvY2lkOnBob3Rvc2hvcDpmY2E3ZDJkYy0wNzNkLTRiNDgtOTc3Zi0zNzJiZWJiMzRmYjk8L3htcE1NOkRvY3VtZW50SUQ+CiAgICAgICAgIDx4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ+eG1wLmRpZDpmZGE2ZjBiMC0xZWM4LTM5NDYtYjZiMy1lZjViNzgwNjNlZjk8L3htcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD4KICAgICAgICAgPHhtcE1NOkhpc3Rvcnk+CiAgICAgICAgICAgIDxyZGY6U2VxPgogICAgICAgICAgICAgICA8cmRmOmxpIHJkZjpwYXJzZVR5cGU9IlJlc291cmNlIj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmFjdGlvbj5jcmVhdGVkPC9zdEV2dDphY3Rpb24+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDppbnN0YW5jZUlEPnhtcC5paWQ6ZmRhNmYwYjAtMWVjOC0zOTQ2LWI2YjMtZWY1Yjc4MDYzZWY5PC9zdEV2dDppbnN0YW5jZUlEPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6d2hlbj4yMDE4LTEyLTE0VDE0OjI2OjAzKzAxOjAwPC9zdEV2dDp3aGVuPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6c29mdHdhcmVBZ2VudD5BZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cyk8L3N0RXZ0OnNvZnR3YXJlQWdlbnQ+CiAgICAgICAgICAgICAgIDwvcmRmOmxpPgogICAgICAgICAgICAgICA8cmRmOmxpIHJkZjpwYXJzZVR5cGU9IlJlc291cmNlIj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmFjdGlvbj5zYXZlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6aW5zdGFuY2VJRD54bXAuaWlkOjhmNDYyYTFiLTljZWYtNDI0Zi1iMGQ2LTE1OTZhYTJiMGZjYjwvc3RFdnQ6aW5zdGFuY2VJRD4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OndoZW4+MjAxOC0xMi0xNFQxNToxOTozOSswMTowMDwvc3RFdnQ6d2hlbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OnNvZnR3YXJlQWdlbnQ+QWRvYmUgUGhvdG9zaG9wIENDIDIwMTkgKFdpbmRvd3MpPC9zdEV2dDpzb2Z0d2FyZUFnZW50PgogICAgICAgICAgICAgICAgICA8c3RFdnQ6Y2hhbmdlZD4vPC9zdEV2dDpjaGFuZ2VkPgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgICAgPHJkZjpsaSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDphY3Rpb24+c2F2ZWQ8L3N0RXZ0OmFjdGlvbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0Omluc3RhbmNlSUQ+eG1wLmlpZDo4NDY1OTc0ZS1iODJmLWZjNGEtODMyNy01Y2Q1YjQ3ODM1MjY8L3N0RXZ0Omluc3RhbmNlSUQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDp3aGVuPjIwMTgtMTItMTRUMTU6MjE6NDYrMDE6MDA8L3N0RXZ0OndoZW4+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpzb2Z0d2FyZUFnZW50PkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE5IChXaW5kb3dzKTwvc3RFdnQ6c29mdHdhcmVBZ2VudD4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmNoYW5nZWQ+Lzwvc3RFdnQ6Y2hhbmdlZD4KICAgICAgICAgICAgICAgPC9yZGY6bGk+CiAgICAgICAgICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6YWN0aW9uPmNvbnZlcnRlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6cGFyYW1ldGVycz5mcm9tIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AgdG8gaW1hZ2UvcG5nPC9zdEV2dDpwYXJhbWV0ZXJzPgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgICAgPHJkZjpsaSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDphY3Rpb24+ZGVyaXZlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6cGFyYW1ldGVycz5jb252ZXJ0ZWQgZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL3BuZzwvc3RFdnQ6cGFyYW1ldGVycz4KICAgICAgICAgICAgICAgPC9yZGY6bGk+CiAgICAgICAgICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6YWN0aW9uPnNhdmVkPC9zdEV2dDphY3Rpb24+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDppbnN0YW5jZUlEPnhtcC5paWQ6ZjU3NWU5YTYtOGM3YS1iYjQwLWE5ZGUtYThjMjIzODQ4NTU3PC9zdEV2dDppbnN0YW5jZUlEPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6d2hlbj4yMDE4LTEyLTE0VDE1OjIxOjQ2KzAxOjAwPC9zdEV2dDp3aGVuPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6c29mdHdhcmVBZ2VudD5BZG9iZSBQaG90b3Nob3AgQ0MgMjAxOSAoV2luZG93cyk8L3N0RXZ0OnNvZnR3YXJlQWdlbnQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpjaGFuZ2VkPi88L3N0RXZ0OmNoYW5nZWQ+CiAgICAgICAgICAgICAgIDwvcmRmOmxpPgogICAgICAgICAgICAgICA8cmRmOmxpIHJkZjpwYXJzZVR5cGU9IlJlc291cmNlIj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmFjdGlvbj5zYXZlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6aW5zdGFuY2VJRD54bXAuaWlkOmEyZTY5MTRjLTUwY2QtNTk0Mi1hYTk5LWU0OGVhYzliZTgwNTwvc3RFdnQ6aW5zdGFuY2VJRD4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OndoZW4+MjAxOS0wNS0yMVQxMTo1MDoxMyswMjowMDwvc3RFdnQ6d2hlbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OnNvZnR3YXJlQWdlbnQ+QWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKTwvc3RFdnQ6c29mdHdhcmVBZ2VudD4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmNoYW5nZWQ+Lzwvc3RFdnQ6Y2hhbmdlZD4KICAgICAgICAgICAgICAgPC9yZGY6bGk+CiAgICAgICAgICAgIDwvcmRmOlNlcT4KICAgICAgICAgPC94bXBNTTpIaXN0b3J5PgogICAgICAgICA8eG1wTU06RGVyaXZlZEZyb20gcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICA8c3RSZWY6aW5zdGFuY2VJRD54bXAuaWlkOjg0NjU5NzRlLWI4MmYtZmM0YS04MzI3LTVjZDViNDc4MzUyNjwvc3RSZWY6aW5zdGFuY2VJRD4KICAgICAgICAgICAgPHN0UmVmOmRvY3VtZW50SUQ+eG1wLmRpZDpmZGE2ZjBiMC0xZWM4LTM5NDYtYjZiMy1lZjViNzgwNjNlZjk8L3N0UmVmOmRvY3VtZW50SUQ+CiAgICAgICAgICAgIDxzdFJlZjpvcmlnaW5hbERvY3VtZW50SUQ+eG1wLmRpZDpmZGE2ZjBiMC0xZWM4LTM5NDYtYjZiMy1lZjViNzgwNjNlZjk8L3N0UmVmOm9yaWdpbmFsRG9jdW1lbnRJRD4KICAgICAgICAgPC94bXBNTTpEZXJpdmVkRnJvbT4KICAgICAgICAgPHBob3Rvc2hvcDpDb2xvck1vZGU+MzwvcGhvdG9zaG9wOkNvbG9yTW9kZT4KICAgICAgICAgPHRpZmY6T3JpZW50YXRpb24+MTwvdGlmZjpPcmllbnRhdGlvbj4KICAgICAgICAgPHRpZmY6WFJlc29sdXRpb24+NzIwMDAwLzEwMDAwPC90aWZmOlhSZXNvbHV0aW9uPgogICAgICAgICA8dGlmZjpZUmVzb2x1dGlvbj43MjAwMDAvMTAwMDA8L3RpZmY6WVJlc29sdXRpb24+CiAgICAgICAgIDx0aWZmOlJlc29sdXRpb25Vbml0PjI8L3RpZmY6UmVzb2x1dGlvblVuaXQ+CiAgICAgICAgIDxleGlmOkNvbG9yU3BhY2U+NjU1MzU8L2V4aWY6Q29sb3JTcGFjZT4KICAgICAgICAgPGV4aWY6UGl4ZWxYRGltZW5zaW9uPjYzPC9leGlmOlBpeGVsWERpbWVuc2lvbj4KICAgICAgICAgPGV4aWY6UGl4ZWxZRGltZW5zaW9uPjcwPC9leGlmOlBpeGVsWURpbWVuc2lvbj4KICAgICAgPC9yZGY6RGVzY3JpcHRpb24+CiAgIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+CiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAg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" alt=""/></div>
                <h3>Get support</h3>
                <p>You have an issue or need help about module usage?<br/>You have some idea or feature request?</p>
                <a href="https://support.geekodev.com" target="_blank" class="btn btn-lg btn-grey">Open a ticket</a>
              </div>
            </div>
            <div class="col-md-6">
              <div class="well text-center">
                <div style="height:80px"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEYAAABLCAYAAADNsPFaAAAACXBIWXMAAAsTAAALEwEAmpwYAABERGlUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS41LWMwMTQgNzkuMTUxNDgxLCAyMDEzLzAzLzEzLTEyOjA5OjE1ICAgICAgICAiPgogICA8cmRmOlJERiB4bWxuczpyZGY9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkvMDIvMjItcmRmLXN5bnRheC1ucyMiPgogICAgICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgICAgICAgICB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iCiAgICAgICAgICAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIKICAgICAgICAgICAgeG1sbnM6cGhvdG9zaG9wPSJodHRwOi8vbnMuYWRvYmUuY29tL3Bob3Rvc2hvcC8xLjAvIgogICAgICAgICAgICB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIKICAgICAgICAgICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgICAgICAgICAgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiCiAgICAgICAgICAgIHhtbG5zOnRpZmY9Imh0dHA6Ly9ucy5hZG9iZS5jb20vdGlmZi8xLjAvIgogICAgICAgICAgICB4bWxuczpleGlmPSJodHRwOi8vbnMuYWRvYmUuY29tL2V4aWYvMS4wLyI+CiAgICAgICAgIDx4bXA6Q3JlYXRvclRvb2w+QWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKTwveG1wOkNyZWF0b3JUb29sPgogICAgICAgICA8eG1wOkNyZWF0ZURhdGU+MjAxNi0xMi0yMVQyMTowNSswMTowMDwveG1wOkNyZWF0ZURhdGU+CiAgICAgICAgIDx4bXA6TW9kaWZ5RGF0ZT4yMDE5LTA1LTE4VDIxOjA2OjA4KzAyOjAwPC94bXA6TW9kaWZ5RGF0ZT4KICAgICAgICAgPHhtcDpNZXRhZGF0YURhdGU+MjAxOS0wNS0xOFQyMTowNjowOCswMjowMDwveG1wOk1ldGFkYXRhRGF0ZT4KICAgICAgICAgPGRjOmZvcm1hdD5pbWFnZS9wbmc8L2RjOmZvcm1hdD4KICAgICAgICAgPHBob3Rvc2hvcDpDb2xvck1vZGU+MzwvcGhvdG9zaG9wOkNvbG9yTW9kZT4KICAgICAgICAgPHBob3Rvc2hvcDpEb2N1bWVudEFuY2VzdG9ycz4KICAgICAgICAgICAgPHJkZjpCYWc+CiAgICAgICAgICAgICAgIDxyZGY6bGk+eG1wLmRpZDo2NDI2N2M4Mi0wN2JmLWYwNDMtOTQyMS0yMzk3NzliODZjNTU8L3JkZjpsaT4KICAgICAgICAgICAgPC9yZGY6QmFnPgogICAgICAgICA8L3Bob3Rvc2hvcDpEb2N1bWVudEFuY2VzdG9ycz4KICAgICAgICAgPHhtcE1NOkluc3RhbmNlSUQ+eG1wLmlpZDpiNmNjZWQzYS1hZDQxLTY4NDMtODhhOC0xNjQyZWY2ZTljMTE8L3htcE1NOkluc3RhbmNlSUQ+CiAgICAgICAgIDx4bXBNTTpEb2N1bWVudElEPnhtcC5kaWQ6NjQyNjdjODItMDdiZi1mMDQzLTk0MjEtMjM5Nzc5Yjg2YzU1PC94bXBNTTpEb2N1bWVudElEPgogICAgICAgICA8eG1wTU06T3JpZ2luYWxEb2N1bWVudElEPnhtcC5kaWQ6NjQyNjdjODItMDdiZi1mMDQzLTk0MjEtMjM5Nzc5Yjg2YzU1PC94bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ+CiAgICAgICAgIDx4bXBNTTpIaXN0b3J5PgogICAgICAgICAgICA8cmRmOlNlcT4KICAgICAgICAgICAgICAgPHJkZjpsaSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDphY3Rpb24+Y3JlYXRlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6aW5zdGFuY2VJRD54bXAuaWlkOjY0MjY3YzgyLTA3YmYtZjA0My05NDIxLTIzOTc3OWI4NmM1NTwvc3RFdnQ6aW5zdGFuY2VJRD4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OndoZW4+MjAxNi0xMi0yMVQyMTowNSswMTowMDwvc3RFdnQ6d2hlbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OnNvZnR3YXJlQWdlbnQ+QWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKTwvc3RFdnQ6c29mdHdhcmVBZ2VudD4KICAgICAgICAgICAgICAgPC9yZGY6bGk+CiAgICAgICAgICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6YWN0aW9uPmNvbnZlcnRlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6cGFyYW1ldGVycz5mcm9tIGltYWdlL3BuZyB0byBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wPC9zdEV2dDpwYXJhbWV0ZXJzPgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgICAgPHJkZjpsaSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDphY3Rpb24+c2F2ZWQ8L3N0RXZ0OmFjdGlvbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0Omluc3RhbmNlSUQ+eG1wLmlpZDo3YzgwNzlhZi04Zjc5LTkzNGQtYjkwZi05ZWI1NjYwZTk5YjA8L3N0RXZ0Omluc3RhbmNlSUQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDp3aGVuPjIwMTYtMTItMjJUMDk6NDg6NTgrMDE6MDA8L3N0RXZ0OndoZW4+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpzb2Z0d2FyZUFnZW50PkFkb2JlIFBob3Rvc2hvcCBDQyAoV2luZG93cyk8L3N0RXZ0OnNvZnR3YXJlQWdlbnQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpjaGFuZ2VkPi88L3N0RXZ0OmNoYW5nZWQ+CiAgICAgICAgICAgICAgIDwvcmRmOmxpPgogICAgICAgICAgICAgICA8cmRmOmxpIHJkZjpwYXJzZVR5cGU9IlJlc291cmNlIj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmFjdGlvbj5zYXZlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6aW5zdGFuY2VJRD54bXAuaWlkOmQ4YTVkOGQ2LTc4ODctNDk0OC1hZTkzLWU5ZTc4YjI0Yzk2ODwvc3RFdnQ6aW5zdGFuY2VJRD4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OndoZW4+MjAxOS0wNC0yM1QxNTo0NDo0MiswMjowMDwvc3RFdnQ6d2hlbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OnNvZnR3YXJlQWdlbnQ+QWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKTwvc3RFdnQ6c29mdHdhcmVBZ2VudD4KICAgICAgICAgICAgICAgICAgPHN0RXZ0OmNoYW5nZWQ+Lzwvc3RFdnQ6Y2hhbmdlZD4KICAgICAgICAgICAgICAgPC9yZGY6bGk+CiAgICAgICAgICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6YWN0aW9uPmNvbnZlcnRlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6cGFyYW1ldGVycz5mcm9tIGFwcGxpY2F0aW9uL3ZuZC5hZG9iZS5waG90b3Nob3AgdG8gaW1hZ2UvcG5nPC9zdEV2dDpwYXJhbWV0ZXJzPgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgICAgPHJkZjpsaSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDphY3Rpb24+ZGVyaXZlZDwvc3RFdnQ6YWN0aW9uPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6cGFyYW1ldGVycz5jb252ZXJ0ZWQgZnJvbSBhcHBsaWNhdGlvbi92bmQuYWRvYmUucGhvdG9zaG9wIHRvIGltYWdlL3BuZzwvc3RFdnQ6cGFyYW1ldGVycz4KICAgICAgICAgICAgICAgPC9yZGY6bGk+CiAgICAgICAgICAgICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0iUmVzb3VyY2UiPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6YWN0aW9uPnNhdmVkPC9zdEV2dDphY3Rpb24+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDppbnN0YW5jZUlEPnhtcC5paWQ6ZjFhMTdkOTUtODQ1NC1lNTQwLThmMTItMDY4ZDBkNTE5NWRiPC9zdEV2dDppbnN0YW5jZUlEPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6d2hlbj4yMDE5LTA0LTIzVDE1OjQ0OjQyKzAyOjAwPC9zdEV2dDp3aGVuPgogICAgICAgICAgICAgICAgICA8c3RFdnQ6c29mdHdhcmVBZ2VudD5BZG9iZSBQaG90b3Nob3AgQ0MgKFdpbmRvd3MpPC9zdEV2dDpzb2Z0d2FyZUFnZW50PgogICAgICAgICAgICAgICAgICA8c3RFdnQ6Y2hhbmdlZD4vPC9zdEV2dDpjaGFuZ2VkPgogICAgICAgICAgICAgICA8L3JkZjpsaT4KICAgICAgICAgICAgICAgPHJkZjpsaSByZGY6cGFyc2VUeXBlPSJSZXNvdXJjZSI+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDphY3Rpb24+c2F2ZWQ8L3N0RXZ0OmFjdGlvbj4KICAgICAgICAgICAgICAgICAgPHN0RXZ0Omluc3RhbmNlSUQ+eG1wLmlpZDpiNmNjZWQzYS1hZDQxLTY4NDMtODhhOC0xNjQyZWY2ZTljMTE8L3N0RXZ0Omluc3RhbmNlSUQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDp3aGVuPjIwMTktMDUtMThUMjE6MDY6MDgrMDI6MDA8L3N0RXZ0OndoZW4+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpzb2Z0d2FyZUFnZW50PkFkb2JlIFBob3Rvc2hvcCBDQyAoV2luZG93cyk8L3N0RXZ0OnNvZnR3YXJlQWdlbnQ+CiAgICAgICAgICAgICAgICAgIDxzdEV2dDpjaGFuZ2VkPi88L3N0RXZ0OmNoYW5nZWQ+CiAgICAgICAgICAgICAgIDwvcmRmOmxpPgogICAgICAgICAgICA8L3JkZjpTZXE+CiAgICAgICAgIDwveG1wTU06SGlzdG9yeT4KICAgICAgICAgPHhtcE1NOkRlcml2ZWRGcm9tIHJkZjpwYXJzZVR5cGU9IlJlc291cmNlIj4KICAgICAgICAgICAgPHN0UmVmOmluc3RhbmNlSUQ+eG1wLmlpZDpkOGE1ZDhkNi03ODg3LTQ5NDgtYWU5My1lOWU3OGIyNGM5Njg8L3N0UmVmOmluc3RhbmNlSUQ+CiAgICAgICAgICAgIDxzdFJlZjpkb2N1bWVudElEPnhtcC5kaWQ6NjQyNjdjODItMDdiZi1mMDQzLTk0MjEtMjM5Nzc5Yjg2YzU1PC9zdFJlZjpkb2N1bWVudElEPgogICAgICAgICAgICA8c3RSZWY6b3JpZ2luYWxEb2N1bWVudElEPnhtcC5kaWQ6NjQyNjdjODItMDdiZi1mMDQzLTk0MjEtMjM5Nzc5Yjg2YzU1PC9zdFJlZjpvcmlnaW5hbERvY3VtZW50SUQ+CiAgICAgICAgIDwveG1wTU06RGVyaXZlZEZyb20+CiAgICAgICAgIDx0aWZmOk9yaWVudGF0aW9uPjE8L3RpZmY6T3JpZW50YXRpb24+CiAgICAgICAgIDx0aWZmOlhSZXNvbHV0aW9uPjcyMDAwMC8xMDAwMDwvdGlmZjpYUmVzb2x1dGlvbj4KICAgICAgICAgPHRpZmY6WVJlc29sdXRpb24+NzIwMDAwLzEwMDAwPC90aWZmOllSZXNvbHV0aW9uPgogICAgICAgICA8dGlmZjpSZXNvbHV0aW9uVW5pdD4yPC90aWZmOlJlc29sdXRpb25Vbml0PgogICAgICAgICA8ZXhpZjpDb2xvclNwYWNlPjY1NTM1PC9leGlmOkNvbG9yU3BhY2U+CiAgICAgICAgIDxleGlmOlBpeGVsWERpbWVuc2lvbj43MDwvZXhpZjpQaXhlbFhEaW1lbnNpb24+CiAgICAgICAgIDxleGlmOlBpeGVsWURpbWVuc2lvbj43NTwvZXhpZjpQaXhlbFlEaW1lbnNpb24+CiAgICAgIDwvcmRmOkRlc2NyaXB0aW9uPgogICA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAKICAgICAgICAgICAgICAgICAgICAgICAgICAgIAo8P3hwYWNrZXQgZW5kPSJ3Ij8+F5l64gAAACBjSFJNAAB6JQAAgIMAAPn/AACA6QAAdTAAAOpgAAA6mAAAF2+SX8VGAAAF5ElEQVR42uyba4hUVRzAf/fOax/q7K6PXR8rhj0RMbUtUyos7YMEmkUiERTRh0KLIgqiKCEhEIkkI0wi6ENE0AvrQ7uiBj7SzKSXEkGpWGrqXDVdZ2fu6cP5j3ud5525O87seP5wmLlnzj337O/+z/9xzllLKYWRXLENAgPGgDFgDBgDxoAxYAyYxpLw7B3OWOCEQZGrMeuBGw2KXDAK+A242eC4HMzDwDlgH/CSQTIIJgXMEs1ZDRwEVgLtxivB70APcB64HlgngNYDdwPW1QbGmrU94b2+CdgMjM9qdxjoA7YD3wKHgItXExiATmAjcF+R+44C3wF/imb9Ii7/BHCqUcFk5FngRQHlV04KnGMyLR3gtHyeAdJ5pqWSKd0BhAHX57NCwAXp3xuoWtLHKflMe17WWRnLSak7VwkYgFHAU8CTwOQGmin9npd2QDzyfmCTgCwJxvt2lgDLgLuAcQ1qWg4Ba4C3/YLxykhgHjBfPNm0BgS1wpq5PRHUF7cD14qbnw50A1OkjBO7MdzkYDhkQdrVVsrKsogWYJemdhrYI8UrUaBNAHWLvWoWjWuRz3QZg1UCud2TyijPy4lIfZdcj5TnV7KCkAiHbAjbELUHn5Jh0Z+CpAuWVVGElwSOS9ldg7ceB8aKNs8AHgRu8XnvBqtnV4KoDSNCg2AycBRwZgAupHxrT73LcuBd0d5C8j3QEwZQCtIqFwxAaxgiFpxP6TbDHM5H4qY3FUhz/gYWUWr+KcBVEA1BPAaxEKSUrhvGsq1A/TFgrgSouR6jb3a8YI8L9jpEbG17BkR7hqECrcijLfuBxcBf2dl1SSiZ35tCMDIKLWKT0sNLe+YBb2TVbQHmeKEAWD27Euy+LV72ExbudUi6gT3XlZRpwF4g5qn7FHgg73pMJVDI2B4b4lFojQzapDqVbmBrFpT3C0EBsIKcj5m728FCa0syDSm3LrWmDfgBuMZTtwZ4oeiyQ9CDQ7N3Olr1hIhSutSJRCUume6pex5YW+rGwHlMdlxjWbrUCaDeLCiPAR/4ubFqCZ7l0aAayefAnZ7rJcAXfm8ODCbtXh4Q5oNTA7uzUeISJNJdBOwop4PAYNwsILYXRG20ZTXwuHw/AixEr9KVp/FBjO/MHc6lv92mLjzSSvTWD8DPwL2S/5RvO4OMIiVUQvUBZbkHyhbg1kqhBNKYqdscwrJcYdU+uJsD7JTvnwAPBfa2QbSl2YaQVXMoY9CbgADvDAWUiozv5K0OKRdawhCzB6dTjcRGrw5GgFeA14eq47LBDLg6NmkN1UVuZANvicbsG9I4rLMvwT/3lE4kOzc7WBZcTEM8Al0xvSbTqGKnFIzpc4pP4j4HV0F/GsIWdET976MOVwlnXvpoD5yTC+K09TqWpd2wssTYphSMb9G25aLb2GdD8tqYjl4HF1TI44HSCiY1Q1tEFqYGmz8CLBXv0A98BbwH/BdwbLdL0neDBNh7ZA3lwJUAY3X0JnIqldI7YbaE9SkFE5v1FEq6l4zuGPQK2B15+v0DuB/4qcJxrQWeK/DbM55ArqpWvagkXehqgtExPX089ravABSAqRJwdVUwpleLQEG80NKagbGApNIeqCOmV+i4fPrMKNF3K/BymeMZD7zmo906qnx4u2DnaaU9UGeThpS1ybzMZ/+LJJXyK4t9tpsouVD1wXh3yJVMoc4YNIdzjC1lTJGx6A18vzKpjLbdVfdKrhjczBmtlEBpj+gplMctH/PZ/7/oI2d+5UgZbQ9XVWPSCkZHYUqL9jyTmmFKq55CbuGs+WOf/X9NeUc9vvTZ7ihVPkFhK3TANiKs859MUcX3qD8EfizR91lgVZnjOerT+K6gysG3DRpAKquUSIMU+mB0oXXUQ+iF6OMVjGkV8GaR5z4NfFb1AG/UNwkmNGm3PFDZO3gCfSZ4gtiULegzKGcCjm0+8ChwHTAg2fMG4NcrEvma/9SvMPI1YIwYMAaMAWPAGDAGjAFjwBgwBowBY8SAMWAMmCGV/wcAW96kU8ix6wIAAAAASUVORK5CYII=" alt=""/></div>
                <h3>Feedback</h3>
                <p>If you like this module, please consider to leave a comment on module page, or <a href="https://www.opencart.com/index.php?route=account/rating" target="_blank">a rating</a> from your account.</p>
                <a href="https://www.opencart.com/index.php?route=extension/extension/info&extension_id=<?php echo $OCID; ?>" target="_blank" class="btn btn-lg btn-grey">OC module page</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <style type="text/css">
        #tab-about .well p{font-size:13px; min-height:55px}
        #tab-about table td{font-size:13px; padding: 13px 5px;}
        #tab-about table tr td:first-child{font-weight:bold;}
        #tab-about .btn-grey{background: #818181; color: white; border-color: #6b6b6b;}
        #tab-about .btn-grey:hover{background: #646464; color: white; border-color: #727272;}
      </style>
		</div>
		<?php } /*end: store_id*/ ?>
		</div>
      </form>
    </div>
  </div>
</div>
</div>
<script type="text/javascript"><!--
$('input.switch').iToggle({easing: 'swing',speed: 200});
jQuery.each( jQuery('input.checkable'), function(){ jQuery(this).prettyCheckable(); });

$('select[name=store]').change(function(){
	document.location = 'index.php?route=module/pdf_invoice&<?php echo $token; ?>&store_id='+$(this).val();
});

$('select[name=pdf_invoice_template]').change(function(){
	$('#template img').attr('src', '<?php echo HTTP_CATALOG; ?>catalog/view/theme/default/template/pdf/'+$(this).val()+'.png');
});
$('select[name=pdf_invoice_sliptemplate]').change(function(){
	$('#sliptemplate img').attr('src', '<?php echo HTTP_CATALOG; ?>catalog/view/theme/default/template/pdf/packingslip/'+$(this).val()+'.png');
});
$('#template img, #sliptemplate img').click(function(){$(this).toggleClass('full');});

$('#pdfbrowser').fileTree({script:'index.php?route=module/pdf_invoice/tree&<?php echo $token; ?>'});
--></script>
<script type="text/javascript"><!--
$('.inlineEdit .switchBtn').click(function(){
	$(this).toggle();
	$(this).next().toggle();
});
$(".colorpicker").spectrum({
	preferredFormat: "hex",
    showInput: true,
    allowEmpty:true,
	clickoutFiresChange: true,
	showInitial: true,
	showButtons: false
	//showPalette: true
});
--></script>
<?php if (!defined('_JEXEC_disabled') && !$OC_V2) { ?>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<?php } ?>
<!-- custom blocks -->
<?php if (!defined('_JEXEC_disabled')) { ?>
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
  <?php if ($OC_V2) { ?>
    $('#pdf_invoice_footer_<?php echo $language['language_id']; ?>').summernote({
      height: 300
    });
  <?php } else { ?>
    CKEDITOR.replace('pdf_invoice_footer_<?php echo $language['language_id']; ?>', {
      filebrowserBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
      filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
      filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
      filebrowserUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
      filebrowserImageUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
      filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>'
    });
  <?php } ?>
<?php } ?>
    
<?php $module_row = 1; ?>
<?php foreach ($pdf_invoice_blocks as $module) { ?>
	<?php foreach ($languages as $language) { ?>
		<?php if ($OC_V2) { ?>
			$('#description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>').summernote({
				height: 300
			});
		<?php } else { ?>
			CKEDITOR.replace('description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>', {
				filebrowserBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserImageUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>'
			});
		<?php } ?>
	<?php } ?>
	<?php $module_row++; ?>
<?php } ?>
//--></script> 
<?php } ?>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<div class="tab-pane" id="tab-module-' + module_row + '">';
	html += '  <ul class="nav nav-tabs">';
    <?php $f=0; foreach ($languages as $language) { ?>
    html += '    <li class="<?php if(!$f) echo ' active'; $f=1; ?>"><a href="#tab-language-'+ module_row + '-<?php echo $language['language_id']; ?>" data-toggle="tab"><img src="<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>';
    <?php } ?>
	html += '  </ul>';
	
	html += '  <div class="tab-content">';

	<?php $f=0; foreach ($languages as $language) { ?>
	html += '    <div class="tab-pane<?php if(!$f) echo ' active'; $f=1; ?>" id="tab-language-'+ module_row + '-<?php echo $language['language_id']; ?>">';
	html += '      <table class="form">';
	html += '        <tr>';
	html += '          <td><?php echo htmlspecialchars($_language->get('entry_block_title'), ENT_QUOTES); ?></td>';
	html += '          <td><input class="form-control" type="text" name="pdf_invoice_blocks[' + module_row + '][title][<?php echo $language['language_id']; ?>]; ?>" size="63"/></td>';
	html += '        </tr>';
	html += '        <tr>';
	html += '          <td><button type="button" class="btn btn-default btn-xs info-btn" data-toggle="modal" data-target="#modal-info" data-info="tags"><i class="fa fa-info"></i></button><?php echo htmlspecialchars($_language->get('entry_block_message'), ENT_QUOTES); ?></td>';
  <?php if (defined('JPATH_MIJOSHOP_OC')) { ?>
  html += '          <td><?php echo preg_replace(array('/\s+/',"/'/"), array(' ',"\\'"), MijoShop::get('base')->editor()->display("pdf_invoice_blocks[".$module_row."][description][".$language['language_id']."]", '', '97% !important', '320', '50', '11')); ?></td>';
  <?php } else { ?>
	html += '          <td><textarea name="pdf_invoice_blocks[' + module_row + '][description][<?php echo $language['language_id']; ?>]" id="description-' + module_row + '-<?php echo $language['language_id']; ?>"></textarea></td>';
  <?php } ?>
	html += '        </tr>';
	html += '      </table>';
	html += '    </div>';
	<?php } ?>

	html += '  <table class="form">';
  html += '    <tr>';
	html += '      <td><?php echo $_language->get('entry_block_target'); ?></td>';
	html += '      <td><select class="form-control" name="pdf_invoice_blocks[' + module_row + '][target]">';
	<?php foreach ($block_targets as $key => $block_target) { ?>
	html += '           <option value="<?php echo $key; ?>"><?php echo addslashes($block_target); ?></option>';
	<?php } ?>
	html += '      </select></td>';
	html += '    </tr>';
	html += '    <tr>';
	html += '      <td><?php echo $_language->get('entry_block_position'); ?></td>';
	html += '      <td><select class="form-control" name="pdf_invoice_blocks[' + module_row + '][position]">';
	<?php foreach ($block_positions as $key => $block_position) { ?>
	html += '           <option value="<?php echo $key; ?>"><?php echo addslashes($block_position); ?></option>';
	<?php } ?>
	html += '      </select></td>';
	html += '    </tr>';
  html += '    <tr>';
	html += '				  <td><?php echo $_language->get('entry_block_inline'); ?></td>';
	html += '				  <td><select class="form-control" name="pdf_invoice_blocks[<?php echo $module_row; ?>][inline]">';
  html += '            <option value=""><?php echo $text_enabled; ?></option>';
  html += '            <option value="1"><?php echo $text_disabled; ?></option>';
	html += '					</select></td>';
	html += '		 </tr>';
	html += '    <tr>';
	html += '      <td><?php echo htmlspecialchars($_language->get('entry_block_display'), ENT_QUOTES); ?></td>';
	html += '      <td><select class="form-control" name="pdf_invoice_blocks[' + module_row + '][display]">';
	html += '      <optgroup label="<?php echo $_language->get('entry_display_always'); ?>">';
	html += '        <option value="always|1"><?php echo htmlspecialchars($text_enabled, ENT_QUOTES); ?></option>';
	html += '        <option value="always|0"><?php echo htmlspecialchars($text_disabled, ENT_QUOTES); ?></option>';
	html += '      </optgroup>';
	html += '      <optgroup label="<?php echo htmlspecialchars($_language->get('entry_display_group'), ENT_QUOTES); ?>">';
	<?php foreach ($customer_groups as $value) { ?>
	html += '           <option value="customer_group_id|<?php echo $value['customer_group_id']; ?>"><?php echo htmlspecialchars($value['name'], ENT_QUOTES); ?></option>';
	<?php } ?>
	html += '      </optgroup>';
	html += '      <optgroup label="<?php echo htmlspecialchars($_language->get('entry_display_orderstatus'), ENT_QUOTES); ?>">';
	<?php foreach ($order_statuses as $value) { ?>
	html += '           <option value="order_status_id|<?php echo $value['order_status_id']; ?>"><?php echo htmlspecialchars($value['name'], ENT_QUOTES); ?></option>';
	<?php } ?>
	html += '      </optgroup>';
	html += '      <optgroup label="<?php echo htmlspecialchars($_language->get('entry_display_payment'), ENT_QUOTES); ?>">';
	<?php foreach ($payment_methods as $value) { ?>
	html += '           <option value="payment_code|<?php echo $value['code']; ?>"><?php echo htmlspecialchars($value['name'], ENT_QUOTES); ?></option>';
	<?php } ?>
	html += '      </optgroup>';
	html += '      <optgroup label="<?php echo htmlspecialchars($_language->get('entry_display_shipping'), ENT_QUOTES); ?>">';
	<?php foreach ($shipping_methods as $value) { ?>
	html += '           <option value="shipping_code|<?php echo $value['code']; ?>"><?php echo htmlspecialchars($value['name'], ENT_QUOTES); ?></option>';
	<?php } ?>
	html += '      </optgroup>';
	html += '      <optgroup label="<?php echo htmlspecialchars($_language->get('entry_display_payment_zone'), ENT_QUOTES); ?>">';
	<?php foreach ($geo_zones as $value) { ?>
	html += '           <option value="shipping_zone|<?php echo $value['geo_zone_id']; ?>"><?php echo htmlspecialchars($value['name'], ENT_QUOTES); ?></option>';
	<?php } ?>
	html += '      </optgroup>';
	html += '      <optgroup label="<?php echo htmlspecialchars($_language->get('entry_display_payment'), ENT_QUOTES); ?>">';
	<?php foreach ($geo_zones as $value) { ?>
	html += '           <option value="payment_zone|<?php echo $value['geo_zone_id']; ?>"><?php echo htmlspecialchars($value['name'], ENT_QUOTES); ?></option>';
	<?php } ?>
	html += '      </optgroup>';
	html += '      </select></td>';
	html += '    </tr>';
	html += '    <tr>';
	html += '      <td><?php echo htmlspecialchars($_language->get('entry_sort_order'), ENT_QUOTES); ?></td>';
	html += '      <td><input class="form-control" type="text" name="pdf_invoice_blocks[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    </tr>';
	html += '  </table>'; 
	html += '</div>';
	
	html += '</div>'; //tab-content
	
	$('#tab-4 > .tab-content').append(html);
	
  $('#module-add').before('<li><a href="#tab-module-' + module_row + '" id="module-' + module_row + '" data-toggle="pill"><i class="fa fa-minus-circle" onclick="$(\'#tab-module-' + module_row + '\').remove(); $(this).closest(\'li\').remove(); $(\'#custom_blocks_tabs li:first a\').trigger(\'click\'); return false;"></i><?php echo htmlspecialchars($_language->get('tab_block'), ENT_QUOTES); ?> ' + module_row + '</a></li>');
	//$('.vtabs a').tabs();
	$('#module-' + module_row).trigger('click');
  
	<?php foreach ($languages as $language) { ?>
		<?php if (defined('_JEXEC_disabled')) { ?>
		<?php } else if ($OC_V2) { ?>
			$('#description-' + module_row + '-<?php echo $language['language_id']; ?>').summernote({
				height: 300
			});
		<?php } else { ?>
			CKEDITOR.replace('description-' + module_row + '-<?php echo $language['language_id']; ?>', {
				filebrowserBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserImageUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>',
				filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&<?php echo $token; ?>'
			});  
		<?php } ?>
	<?php } ?>
	
	//$('#language-' + module_row + ' a').tabs();
	
	module_row++;
}
//--></script> 
<script type="text/javascript"><!--
$('.sortable').sortable({
	items: "div:not(.unsortable_div)"
	/*
	update: function() {
		var order = $('#qosu_statuses').sortable('toArray');
		//alert(typeOf(order));
		//order = order.split(',');
		$.each(order, function(i, v) {
			$('input[name="qosu_order_statuses['+v.replace('status-','')+'][sort_order]"]').val(i+1);
		});
		//$.post('ajax.php',order);
	}*/
});

$('body').on('click', '.info-btn', function() {
  $('#modal-info').html('<div style="text-align:center"><img src="view/pdf_invoice/img/loader.gif" alt=""/></div>');
  $('#modal-info').load('index.php?route=module/pdf_invoice/modal_info&<?php echo $token; ?>', {'info': $(this).attr('data-info')});
});
//--></script> 
<?php if(!$OC_V2) { ?>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo htmlspecialchars($_language->get('text_image_manager'), ENT_QUOTES); ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<?php } ?>
<?php if(defined('_JEXEC_disabled') && !$OC_V2) { ?>
<style>
#header *{box-sizing: content-box!important;}
.panel-body{padding: 10px;}
</style>
<?php } ?>
<?php echo $footer; ?>