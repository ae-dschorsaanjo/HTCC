$(function () {

	function hideSomePlaya(num) {
		
		for (var i = 1; i < 100; i++) {
			if (i <= num)
				$("[name='tr" + i + "']").show();
			else
				$("[name='tr" + i + "']").hide();
		}

		$("form[name='team'] input[name='teamsize']").val(num);
	}

	$("form").keypress(function(e) {
	  
	  if (e.which == 13)
	    return false;
	});

	$("[name='teamfilecheck']").change(function(e) {
		
		$("[name='teamfile']").prop("disabled", !$("[name='teamfilecheck']").prop("checked"));
		$("[name='teamfileread']").prop("disabled", !$("[name='teamfilecheck']").prop("checked"));
		$("[name='teamname']").prop("disabled", $("[name='teamfilecheck']").prop("checked"));
		$("[name='teamsize']").prop("disabled", $("[name='teamfilecheck']").prop("checked"));
	});
	
	$("[name='teamsize']").change(function (e) {
		
		hideSomePlaya(e.target.value);
	});
	
	hideSomePlaya(defaultSize);
	if (!isPosted)
		$("input[name='teamname']").focus();
	
	//alert(isPosted);
	//if (isPosted)
		//$("table.players").hide();
});