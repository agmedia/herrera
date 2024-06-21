<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h2><?php echo $heading_title; ?></h2>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-users"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cigroup" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-export" data-toggle="tab"><i class="fa fa-download"></i> <?php echo $tab_export; ?></a></li>
            <li><a href="#tab-import" data-toggle="tab"><i class="fa fa-upload"></i> <?php echo $tab_import; ?></a></li>

          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-export">
              <fieldset>
                <legend><i class="fa fa-file-excel-o"></i> <?php echo $legend_export; ?></legend>
                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label class="col-sm-12 control-label"><?php echo $entry_filter_type; ?></label>
                      <div class="col-sm-12">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default filter_type active">
                            <input name="filter_type" checked="checked" autocomplete="off" value="CUSTOM" type="radio"><?php echo $type_custom_products; ?>
                          </label>
                          <label class="btn btn-default filter_type">
                            <input name="filter_type" autocomplete="off" value="ALL" type="radio"><?php echo $type_all_products; ?>
                          </label>
                          <label class="btn btn-default filter_type">
                            <input name="filter_type" autocomplete="off" value="ONLY_CIGROUP" type="radio"><?php echo $type_only_customer_group_prices; ?>
                          </label>
                          <label class="btn btn-default filter_type">
                            <input name="filter_type" autocomplete="off" value="IGNORE_CIGROUP" type="radio"><?php echo $type_ignore_customer_group_prices; ?>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label class="col-sm-12 control-label"><?php echo $entry_store; ?></label>
                      <div class="col-sm-12">
                        <select name="filter_store_id" class="form-control">
                          <?php foreach ($stores as $store) { ?>
                          <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row group-product">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-sm-12 control-label"><?php echo $entry_category; ?></label>
                      <div class="col-sm-12">
                        <input type="text" name="filter_category_name" value="" placeholder="<?php echo $entry_category; ?>" id="input-category" class="form-control" />
                        <div id="export-category" class="well well-sm" style="height: 150px; overflow: auto;">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-sm-12 control-label"><?php echo $entry_product; ?></label>
                      <div class="col-sm-12">
                        <input type="text" name="filter_product_name" value="" placeholder="<?php echo $entry_product; ?>" id="input-product" class="form-control" />
                        <div id="export-product" class="well well-sm" style="height: 150px; overflow: auto;">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="col-sm-12 control-label"><?php echo $entry_format; ?></label>
                      <div class="col-sm-6">
                        <select name="filter_format" class="form-control">
                          <option value="xlsx"><?php echo $text_xlsx; ?></option>
                          <option value="xls"><?php echo $text_xls; ?></option>
                          <option value="csv"><?php echo $text_csv; ?></option>
                        </select>
                      </div>
                      <button type="button" class="btn btn-success" data-toggle="tooltip" title="<?php echo $button_export; ?>" id="button-export"><i class="fa fa-download"></i> <?php echo $button_export; ?></button>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="tab-pane" id="tab-import">
              <fieldset>
                <legend>
                  <i class="fa fa-file-excel-o"></i> <?php echo $legend_import; ?>
                  <a href="<?php echo $excel_sample; ?>" download class="btn btn-warning btn-sm pull-right"><i class="fa fa-file-excel-o"></i> <?php echo $button_example; ?></a>
                </legend>
                <div class="form-group">
                  <label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_import_excel; ?>"><?php echo $entry_import_excel; ?></span></label>
                  <div class="col-sm-10">
                    <input type="file" name="file_excel">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label"> </label>
                  <div class="col-sm-10">
                    <button type="button" class="btn btn-success" id="button-import"><i class="fa fa-send"></i> <?php echo $button_import; ?></button>
                  </div>
                </div>
              </fieldset>
            </div>

            <?php /* CodingInspect Support Starts */ ?>
            <div class="tab-pane text-center" id="tab-support">
              <div class="support-wrap">
                <i class="fa fa-life-ring" aria-hidden="true"></i>
                <div class="ciinfo">
                  <h4>For any type of support please contact us at</h4>
                  <h3>codinginspect@gmail.com</h3>
                </div>
              </div>
            </div>
            <?php /* CodingInspect Support Ends */ ?>

          </div>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
// Category
$('input[name=\'filter_category_name\']').autocomplete({
  'source': function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&<?php echo $module_token; ?>=<?php echo $ci_token; ?>&filter_name=' +  encodeURIComponent(request),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          return {
            label: item['name'],
            value: item['category_id']
          }
        }));
      }
    });
  },
  'select': function(item) {
    $('input[name=\'filter_category_name\']').val('');

    $('#export-category' + item['value']).remove();

    $('#export-category').append('<div id="export-category' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filter_categories[]" value="' + item['value'] + '" /></div>');
  }
});

$('#export-category').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});

// Category
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

    $('#export-product' + item['value']).remove();

    $('#export-product').append('<div id="export-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="filter_products[]" value="' + item['value'] + '" /></div>');
  }
});

$('#export-product').delegate('.fa-minus-circle', 'click', function() {
  $(this).parent().remove();
});
//--></script>
<script type="text/javascript"><!--
$('#button-import').click(function() {
  var formdata = new FormData();
  formdata.append('file_excel', $("#tab-import input[type=\'file\']").prop("files")[0]);

  $.ajax({
    url: 'index.php?route=extension/cigroupprice/ImportExcel&<?php echo $module_token; ?>=<?php echo $ci_token; ?>',
    type: 'post',
    cache: false,
    contentType: false,
    processData: false,
    async: false,
    data: formdata,
    dataType: 'json',
    beforeSend: function() {
      $('#button-import').button('loading');
    },
    complete: function() {
    },
    success: function(json) {
      $('#button-import').button('reset');

      $('.alert').remove();

      if(json['warning']) {
        $('#tab-import > fieldset').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['warning'] +'<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }

      if(json['success']) {
        var html = '';
        html += '<div class="alert alert-info">';
        html += '<div class="">';
        html += '  <a class="btn btn-success"><i class="fa fa-check-circle"></i> '+ json['success'] +'</a>';
        html += '</div>';

        html += '<br><br>';

        html += '<h5><b><?php echo $text_main_product; ?></b></h5>';
        html += '<p><?php echo $text_total_rows; ?>: '+ json['count_row']['excel_row'] +'</p>';
        html += '<p><?php echo $text_ignore; ?>: '+ json['count_row']['fixed_row'] +'</p>';
        html += '<p><?php echo $text_inserted; ?>: <label class="label label-success">'+ json['count_row']['new_row'] +'</label></p>';
        html += '<p><?php echo $text_updated; ?>: <label class="label label-success">'+ json['count_row']['edit_row'] +'</label></p>';
        html += '<p><?php echo $text_skip; ?>: <label class="label label-danger">'+ json['count_row']['skip_row'] +'</label></p>';
        if(json['count_row']['reason_text']) {
        html += '<p><?php echo $text_reason; ?>: '+ json['count_option_row']['reason_text'] +'</p>';
        }

        html += '<br><br><br>';

        html += '<h5><b><?php echo $text_option_value; ?></b></h5>';
        html += '<p><?php echo $text_total_rows; ?>: '+ json['count_option_row']['excel_row'] +'</p>';
        html += '<p><?php echo $text_ignore; ?>: '+ json['count_option_row']['fixed_row'] +'</p>';
        html += '<p><?php echo $text_inserted; ?>: <label class="label label-success">'+ json['count_option_row']['new_row'] +'</label></p>';
        html += '<p><?php echo $text_updated; ?>: <label class="label label-success">'+ json['count_option_row']['edit_row'] +'</label></p>';
        html += '<p><?php echo $text_skip; ?>: <label class="label label-danger">'+ json['count_option_row']['skip_row'] +'</label></p>';
        if(json['count_option_row']['reason_text']) {
        html += '<p><?php echo $text_reason; ?>: '+ json['count_option_row']['reason_text'] +'</p>';
        }

        html += '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        html += '</div>';

        $('#tab-import > fieldset').prepend(html)

        $("#tab-import input[type=\'file\']").val('');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});


$('#button-export').click(function() {
  $.ajax({
    url: 'index.php?route=extension/cigroupprice/ExportExcel&<?php echo $module_token; ?>=<?php echo $ci_token; ?>',
    type: 'post',
    data: $('#tab-export input[type=\'hidden\'], #tab-export input[type=\'radio\']:checked, #tab-export select'),
    dataType: 'json',
    beforeSend: function() {
      $('#button-export').button('loading');
    },
    complete: function() {
      $('#button-export').button('reset');
    },
    success: function(json) {
      $('.alert').remove();

      if(json['error']) {
        $('#tab-export > fieldset').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> '+ json['error'] +'<button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        $('html, body').animate({ scrollTop: 0 }, 'slow');
      }

      if(json['download_excel']) {
        location = json['download_excel'];
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$('.filter_type').click(function() {
  if($(this).find('input').val() == 'ALL') {
    $('.group-product').addClass('hide');
  } else if($(this).find('input').val() == 'CUSTOM') {
    $('.group-product').removeClass('hide');
  } else {
    $('.group-product').addClass('hide');
  }
});
//--></script>
<style type="text/css">
.form-group .control-label.col-sm-12 { text-align: left; padding-bottom: 5px; }
.alert-success .label { font-size: 11px; }
</style>
</div>
<?php echo $footer; ?>