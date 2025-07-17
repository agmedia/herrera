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
?>
<script type="text/javascript">

$(".<?php echo $extension_id; ?>").on("click", ".top-buttons", function()
{
	if (!$(this).attr("href")) {		
		values = $(this).attr("id").split("-");
		task = values[1];

		if (task == "apply") {
			$(".<?php echo $extension_id; ?> input[name='apply']").attr("value", "1");
		} else if (task == "save") {
			$(".<?php echo $extension_id; ?> input[name='apply']").attr("value", "0");
		}

		$(".<?php echo $extension_id; ?> #form-<?php echo $extension_id; ?>").submit();
	
		return false;
	}
});

</script>