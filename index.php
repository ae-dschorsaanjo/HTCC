<!DOCTYPE html>
<?php
	$_values = array( 
		array( "nem létező", "katasztrofális", "pocsék", "csapnivaló", "gyenge", "középszerű", "megfelelő", "jó", "remek", "nagyszerű", "kiemelkedő", "ragyogó", "lenyűgöző", "világklasszis", "természetfeletti", "titáni", "földöntúli", "legendás", "varázslatos", "csodás", "isteni" ), 
		array( "non-existent", "disastrous", "wretched", "poor", "weak", "inadequate", "passable", "solid", "excellent", "formidable", "outstanding", "brilliant", "magnificent", "world class", "supernatural", "titanic", "extra-terrestrial", "mythical", "magical", "utopian", "divine" ), 
		array( "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20" )
	);
	
	define("maxExp", 20, true);
	define("maxLead", 8, true);
	define("minIndex", 0, true);
	define("minSize", 1, true);		
	define("maxSize", 50, true);
	define("minJersey", 1, true);
	define("maxJersey", 99, true);
	define("defaultSize", 16, true);
	
	function getOptions($min, $max, $selected = 0, $needvalues = true) {
		
		if ($needvalues)
			global $_values;
		$out = '';
		for ($i = $min; $i <= $max; $i++)
			$out .= "<option value='" . $i . ($i == $selected ? "' selected " : "'") . ">" . ($needvalues ? $_values[1][$i] : $i) . "</option>\n";
		return $out;
	}
?>
<html>
	<head>
		<title>Hattrick Captain Chooser</title>
		<meta name="generator" content="Bluefish 2.2.6" >
		<meta name="author" content="root" >
		<meta name="copyright" content="">
		<meta name="keywords" content="Hattrick, Hattrick Captain Chooser">
		<meta name="description" content="Hattrick (Team) Captain Chooser, because we are listening to every single details!">
		<meta name="ROBOTS" content="NOINDEX, NOFOLLOW">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="htcc.css" />
		<script>
			const maxExp = <?php echo maxExp; ?>;
			const maxLead = <?php echo maxLead; ?>;
			const minIndex = <?php echo minIndex; ?>;
			const minSize = <?php echo minSize; ?>;
			const maxSize = <?php echo maxSize; ?>;
			const minJersey = <?php echo minJersey; ?>;
			const maxJersey = <?php echo maxJersey; ?>;
			const defaultSize = <?php echo defaultSize; ?>;
			const isPosted = <?php echo (int)($_SERVER['REQUEST_METHOD'] == 'POST') ?>;
		</script>
		<script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
		<script src="htcc.js"></script>
	</head>
	<body>
	<table class='body'><tr><td>
	
		<h1>Hattrick (Team) Captain Chooser</h1>
		<form  method="post"><!-- action="index.php" -->
			Team's name: <input type='text' name='teamname' />&nbsp;&nbsp;&nbsp;&nbsp;
			Team's size: <select name='teamsize'><?php echo getOptions(minSize, maxSize, defaultSize, false); ?></select>
			Values: <select name='valuesmode'>
				<option value='1'>English</option>
				<option value='0'>Hungarian</option>
				<option value='2'>#</option>
			</select>
			<input type='button' id='help' value="?" />
			<br>
		    <!-- <input type='checkbox' name='teamfilecheck' />
		    Team's file: <input type='file' name='teamfile' disabled /><input type='button' value='Read' name='teamfileread' disabled /> -->
			<table class='players'>
				<tr class='head'>
					<th>id</th>
					<th>Name</th>
					<th>Experience</th>
					<th>Leadership</th>
					<th>Num</th>
				</tr>
				<!-- <tr><td class="refresh" colspan="5">Refreshing is quiet slow, please wait a bit.</td></tr> -->
				<tr><td class='small'>&nbsp;</td></tr>
				<?php
					for ($i = 1; $i <= 50; $i++) {
						echo "<tr name='tr" . $i . "'><td class='right'>" .
							$i . 
							"</td><td><input type='text' name='pname" . 
							$i . 
							"' />\n</td><td><select name='pexp" . $i . "'>\n" . 
							getOptions(minIndex, maxExp) .
							"</select>" .
							"</td><td><select name='plead" . $i . "'>\n" . 
							getOptions(minIndex, maxLead) .
							"</select>\n" .
							"</td><td><select name='pnum" . $i . "'>\n" .
							getOptions(minJersey, maxJersey, $i, false) .
							"</select></td></tr>\n\n";
					}
				?>
				<tr><td colspan='5'><div class='submit'><input type='submit' /></div></td></tr>
			</table>
		</form>
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
				require "htcc.php";
			else
				echo "There's nothing to show.";
		?>
	</td></tr></table>
	</body>
</html>
