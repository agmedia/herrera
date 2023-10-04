var rfmultiprod_row = false;
var rfmultiprod_lang = [];
var rfmultiprod = {	
	'add': function(row) {
		if(rfmultiprod_row == false) {
			rfmultiprod_row = row;
		}
 		html = '<div id="multiprod-row' + rfmultiprod_row + '">';    
		html += '<legend> &nbsp;</legend>';    
			html += '<div class="form-group required"> <label class="col-sm-2 control-label" for="input-product">' + rfmultiprod_lang['entry_product'] + '</label>';
			html += '<div class="col-sm-10"> <input type="text" name="product[' + rfmultiprod_row + ']" value="" placeholder="' + rfmultiprod_lang['entry_product'] + '" id="input-product' + rfmultiprod_row + '" class="form-control" /></div>';
			html += '</div>';
			
			html += '<div class="form-group required"> <label class="col-sm-2 control-label" for="input-model">' + rfmultiprod_lang['entry_model'] + '</label>';
			html += '<div class="col-sm-10"> <input type="text" name="model[' + rfmultiprod_row + ']" value="" placeholder="' + rfmultiprod_lang['entry_model'] + '" id="input-model' + rfmultiprod_row + '" class="form-control" /></div>';
			html += '</div>';
			
			html += '<div class="form-group required"> <label class="col-sm-2 control-label" for="input-quantity">' + rfmultiprod_lang['entry_quantity'] + '</label>';
			html += '<div class="col-sm-10"> <input type="text" name="quantity[' + rfmultiprod_row + ']" value="" placeholder="' + rfmultiprod_lang['entry_quantity'] + '" id="input-quantity' + rfmultiprod_row + '" class="form-control" /></div>';
			html += '</div>';
			
			html += '<button type="button" onclick="$(\'#multiprod-row' + rfmultiprod_row + '\').remove();" class="btn btn-danger pull-right"><i class="fa fa-minus-circle"></i></button>';
		html += '</div>';
		
		$('#multiprod').append(html);
		
		rfmultiprod_row++;
 	},
	'initjson': function() {
		$.ajax({
			url: 'index.php?route=account/return/rfmultiprod_lang',
			dataType: 'json',
			cache: true,
			success: function(json) {
				rfmultiprod_lang = json;
 			}
 		});
	}
}
$(document).ready(function() {
rfmultiprod.initjson();
});