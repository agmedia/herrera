<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
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
        <form method="post" enctype="multipart/form-data" id="form-cigroupprice" class="form-horizontal">
          <fieldset id="choose-template">
            <div class="form-group">
              <label class="col-sm-3 control-label"><i class="fa fa-refresh"></i> <?php echo $entry_select_template; ?></label>
              <div class="col-sm-5">
                  <select name="template_id" class="form-control" id="input-template-id">
                      <option value=""><?php echo $text_select; ?></option>
                      <?php foreach($templates as $template) { ?>
                          <option value="<?php echo $template['template_id']; ?>"><?php echo $template['name']; ?></option>
                      <?php } ?>
                  </select>
              </div>
            </div>
          </fieldset>

          <div id="cigroupprice-loadaction"><?php echo $cigroupprice_loadaction; ?></div>

          <fieldset id="template">
            <legend>
              <button class="btn btn-default btn-lg" data-toggle="collapse" href="#collapseTemplate" role="button" aria-expanded="false" aria-controls="collapseTemplate"><i class="fa fa-cog"></i> <?php echo $entry_template_setting; ?></button>

              <div class="pull-right">
                <button type="button" id="button-delete" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-danger btn-sm hide"><i class="fa fa-trash"></i> <?php echo $button_delete; ?></button>
              </div>
            </legend>
            <div class="collapse" id="collapseTemplate">
              <div class="form-group required">
                <label class="col-sm-2 control-label"><?php echo $entry_template_name; ?></label>
                <div class="col-sm-10">
                    <input type="text" name="template_name" placeholder="<?php echo $entry_template_name; ?>" value="" class="form-control" />
                </div>
              </div>
              <div class="text-center">
                <button type="button" id="button-add" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus"></i> <?php echo $button_add; ?></button>
                <button type="button" id="button-edit" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary hide"><i class="fa fa-pencil"></i> <?php echo $button_edit; ?></button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
<script type="text/javascript"><!--
$('#input-template-id').on('change',function(){
    var template = $(this);

    $.ajax({
        url: 'index.php?route=extension/cigroupprice_product/getTemplate&<?php echo $module_token; ?>=<?php echo $ci_token; ?>&filter_id=' +  template.val(),
        dataType: 'html',
        beforeSend: function() {
          $('#choose-template #input-template-id').attr('disabled', true);
        },
        complete: function() {
          $('#choose-template #input-template-id').attr('disabled', false);
        },
        success: function(html) {
          $('.alert,.text-danger').remove();

           $('#cigroupprice-loadaction').html(html);

           if(template.val() > 0) {
              $('input[name=\'template_name\']').val(template.find('option:selected').text());
              $('#button-edit').removeClass('hide');
              $('#button-delete').removeClass('hide');
           } else {
              $('input[name=\'template_name\']').val('');
              $('#button-edit').addClass('hide');
              $('#button-delete').addClass('hide');
           }
        }
      });
});
//--></script>
<script type="text/javascript"><!--
$(document).delegate('#button-apply', 'click', function() {
  $.ajax({
    url: 'index.php?route=extension/cigroupprice_product/applyTemplate&<?php echo $module_token; ?>=<?php echo $ci_token; ?>',
    type: 'post',
    data: $("#form-cigroupprice").serialize(),
    dataType: 'json',
    beforeSend: function() {
      $('#button-apply').button('loading');
    },
    complete: function() {
      $('#button-apply').button('reset');
    },
    success: function(json) {
      $('.alert,.text-danger').remove();

      if(json['error']) {
          if(json['error']['value']) {
              for (i in json['error']['value']) {
                  $('#input-value-'+i).after('<span class="text-danger">'+ json['error']['value'][i] +'</span>');
              }
          }
          if(json['error']['custom_price']) {
              for (i in json['error']['custom_price']) {
                  $('#input-custom_price-'+i).after('<span class="text-danger">'+ json['error']['custom_price'][i] +'</span>');
              }
          }

          if(json['error']['no_selected_product']) {
              $('#selected-product').after('<span class="text-danger">'+ json['error']['no_selected_product'] +'</span>');
          }

          if(json['error']['no_selected_category']) {
              $('#selected-category').after('<span class="text-danger">'+ json['error']['no_selected_category'] +'</span>');
          }

          if(json['error']['no_selected_manufacturer']) {
              $('#selected-manufacturer').after('<span class="text-danger">'+ json['error']['no_selected_manufacturer'] +'</span>');
          }
      }

      if(json['success']) {
        $('#form-cigroupprice').before('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> '+ json['success'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$(document).delegate('#button-edit', 'click', function() {
  $.ajax({
    url: 'index.php?route=extension/cigroupprice_product/editTemplate&<?php echo $module_token; ?>=<?php echo $ci_token; ?>',
    type: 'post',
    data: $("#form-cigroupprice").serialize(),
    dataType: 'json',
    beforeSend: function() {
      $('#button-edit').button('loading');
    },
    complete: function() {
      $('#button-edit').button('reset');
    },
    success: function(json) {
      $('.alert, .text-danger').remove();
      $('#template .form-group').removeClass('has-error');

      if(json['error']) {
         if(json['error']['template_name']) {
              $('input[name="template_name"]').after('<span class="text-danger">'+ json['error']['template_name'] +'</span>');
          }
      }

      $('.text-danger').parent().parent().addClass('has-error');

      if(json['success']) {
        $('#form-cigroupprice').before('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> '+ json['success'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$(document).delegate('#button-add', 'click', function() {
  $.ajax({
    url: 'index.php?route=extension/cigroupprice_product/addTemplate&<?php echo $module_token; ?>=<?php echo $ci_token; ?>',
    type: 'post',
    data: $("#form-cigroupprice").serialize(),
    dataType: 'json',
    beforeSend: function() {
      $('#button-add').button('loading');
    },
    complete: function() {
      $('#button-add').button('reset');
    },
    success: function(json) {
      $('.alert,.text-danger').remove();
      $('#template .form-group').removeClass('has-error');

      if(json['error']) {
         if(json['error']['template_name']) {
              $('input[name="template_name"]').after('<span class="text-danger">'+ json['error']['template_name'] +'</span>');
          }
      }

      $('.text-danger').parent().parent().addClass('has-error');

      if(json['success']) {
        $('#form-cigroupprice').before('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> '+ json['success'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

        $('#button-edit').removeClass('hide');
        $('#button-delete').removeClass('hide');

        html = '<option value=""><?php echo $text_select; ?></option>';

        for(i in json['templates']) {
          if(json['templates'][i]['template_id'] == json['template_id']) {
              html += '<option value="'+ json['templates'][i]['template_id'] +'" selected="selected">'+ json['templates'][i]['name'] +'</option>';  
          } else {
            html += '<option value="'+ json['templates'][i]['template_id'] +'">'+ json['templates'][i]['name'] +'</option>';  
          }
        }

        $('#input-template-id').html(html);
      }
    },
    error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
});

$(document).delegate('#button-delete', 'click', function() {
  if(confirm('<?php echo $text_confirm; ?>')) {
    $.ajax({
    url: 'index.php?route=extension/cigroupprice_product/deleteTemplate&<?php echo $module_token; ?>=<?php echo $ci_token; ?>',
    type: 'post',
    data: $("#form-cigroupprice").serialize(),
    dataType: 'json',
    beforeSend: function() {
      $('#button-delete').button('loading');
    },
    complete: function() {
      $('#button-delete').button('reset');
    },
    success: function(json) {
      $('.alert,.text-danger').remove();

      if(json['error']) {

      }

      if(json['success']) {
        $('#form-cigroupprice').before('<div class="alert alert-success"><i class="fa fa-exclamation-circle"></i> '+ json['success'] +' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        $('input[name="template_name"]').val('');
        html = '<option value=""><?php echo $text_select; ?></option>';
         for(i in json['templates']) {
          if(json['templates'][i]['template_id'] == json['template_id']) {
              html += '<option value="'+ json['templates'][i]['template_id'] +'" selected="selected">'+ json['templates'][i]['name'] +'</option>';
          }else{
            html += '<option value="'+ json['templates'][i]['template_id'] +'">'+ json['templates'][i]['name'] +'</option>';
          }
          }
         $('#input-template-id').html(html);
        $('#cigroupprice-loadaction').html(json['cigroupprice_loadaction']);
         $('#button-edit').addClass('hide');
          $('#button-delete').addClass('hide');
       }
    },
    error: function(xhr, ajaxOptions, thrownError) {
        alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    }
  });
  }

});
//--></script>
<style type="text/css">
.form-group .control-label.col-sm-12 { text-align: left; padding-bottom: 5px; }
.alert-success .label { font-size: 11px; }
</style>
</div>
<?php echo $footer; ?>