$(function () {
	
	// test of jQuery
	//$("h1").append(" :)");
	
	const values = [ 
		[ "nem létező", "katasztrofális", "pocsék", "csapnivaló", "gyenge", "középszerű", "megfelelő", "jó", "remek", "nagyszerű", "kiemelkedő", "ragyogó", "lenyűgöző", "világklasszis", "természetfeletti", "titáni", "földöntúli", "legendás", "varázslatos", "csodás", "isteni" ], 
		[ "non-existent", "disastrous", "wretched", "poor", "weak", "inadequate", "passable", "solid", "excellent", "formidable", "outstanding", "brilliant", "magnificent", "world class", "supernatural", "titanic", "extra-terrestrial", "mythical", "magical", "utopian", "divine" ], 
		[ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20" ]
	];

	function hideSomePlaya(num) {
		
		for (var i = 1; i < 100; i++) {
			if (i <= num)
				$("[name='tr" + i + "']").show();
			else
				$("[name='tr" + i + "']").hide();
		}
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
	
	$("[name='valuesmode']").change(function (e) {
		
		//$("td.refresh").show();
		var j;
		for (var i = minSize; i <= maxSize; i++) {
			for (j = minIndex; j <= maxExp; j++)
				$("[name='pexp" + i + "']>option:eq(" + j + ")").text(values[e.target.value][j]);
			for (j = minIndex; j <= maxLead; j++)
				$("[name='plead" + i + "']>option:eq(" + j + ")").text(values[e.target.value][j]);
		}
		//$("td.refresh").hide();
	});
	
	$("#help").click(function () {
		
		
	});
	
	hideSomePlaya(16);
	
	//alert(isPosted);
	if (isPosted)
		$("table.players").hide();
	
	//$("td.refresh").hide();
	
	//setInterval(function () { $("td.refresh").toggle(); }, 1000);
	//setTimeout(function(){}, 5000);
	
	// <input type="number" min="1" max="50" value="16" id='teamsize' />
});