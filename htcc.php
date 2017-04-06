<?php
$_values = array(
	array(1 => "non-existent", 2 => "nem létező", 3 => "00", 4 => "00 - non-existent", 5 => "00 - nem létező"),
	array(1 => "disastrous", 2 => "katasztrofális", 3 => "01", 4 => "01 - disastrous", 5 => "01 - katasztrofális"),
	array(1 => "wretched", 2 => "pocsék", 3 => "02", 4 => "02 - wretched", 5 => "02 - pocsék"),
	array(1 => "poor", 2 => "csapnivaló", 3 => "03", 4 => "03 - poor", 5 => "03 - csapnivaló"),
	array(1 => "weak", 2 => "gyenge", 3 => "04", 4 => "04 - weak", 5 => "04 - gyenge"),
	array(1 => "inadequate", 2 => "középszerű", 3 => "05", 4 => "05 - inadequate", 5 => "05 - középszerű"),
	array(1 => "passable", 2 => "megfelelő", 3 => "06", 4 => "06 - passable", 5 => "06 - megfelelő"),
	array(1 => "solid", 2 => "jó", 3 => "07", 4 => "07 - solid", 5 => "07 - jó"),
	array(1 => "excellent", 2 => "remek", 3 => "08", 4 => "08 - excellent", 5 => "08 - remek"),
	array(1 => "formidable", 2 => "nagyszerű", 3 => "09", 4 => "09 - formidable", 5 => "09 - nagyszerű"),
	array(1 => "outstanding", 2 => "kiemelkedő", 3 => "10", 4 => "10 - outstanding", 5 => "10 - kiemelkedő"),
	array(1 => "brilliant", 2 => "ragyogó", 3 => "11", 4 => "11 - brilliant", 5 => "11 - ragyogó"),
	array(1 => "magnificent", 2 => "lenyűgöző", 3 => "12", 4 => "12 - magnificent", 5 => "12 - lenyűgöző"),
	array(1 => "world class", 2 => "világklasszis", 3 => "13", 4 => "13 - world class", 5 => "13 - világklasszis"),
	array(1 => "supernatural", 2 => "természetfeletti", 3 => "14", 4 => "14 - supernatural", 5 => "14 - természetfeletti"),
	array(1 => "titanic", 2 => "titáni", 3 => "15", 4 => "15 - titanic", 5 => "15 - titáni"),
	array(1 => "extra-terrestrial", 2 => "földöntúli", 3 => "16", 4 => "16 - extra-terrestrial", 5 => "16 - földöntúli"),
	array(1 => "mythical", 2 => "legendás", 3 => "17", 4 => "17 - mythical", 5 => "17 - legendás"),
	array(1 => "magical", 2 => "varázslatos", 3 => "18", 4 => "18 - magical", 5 => "18 - varázslatos"),
	array(1 => "utopian", 2 => "csodás", 3 => "19", 4 => "19 - utopian", 5 => "19 - csodás"),
	array(1 => "divine", 2 => "isteni", 3 => "20", 4 => "20 - divine", 5 => "20 - isteni"),
);	

define("newCell", "</td><td>", false);

define("maxExp", 20, true);
define("maxLead", 8, true);
define("minIndex", 0, true);
define("minSize", 1, true);		
define("maxSize", 50, true);
define("minJersey", 1, true);
define("maxJersey", 99, true);
define("defaultSize", 16, true);

define("ENG", 1, true);
define("HUN", 2, true);
define("NUM", 3, true);
define("NUM_ENG", 4, true);
define("NUM_HUN", 5, true);

const modes = array(
	array(ENG, 'English'),
	array(HUN, 'Magyar'),
	array(NUM, '#'),
	array(NUM_ENG, '# - English'),
	array(NUM_HUN, '# - Magyar')
);

/**
 * Returns the mode options.
 */
function getModes($selected) {
	$out = '';
	if (!$selected)
		$selected = ENG;
	for ($i = 0, $max = count(modes); $i < $max; $i++)
		$out .= '<option value="' . modes[$i][0] . '"'
		      . ($selected == modes[$i][0] ? " selected" : '') . '>'
			  . modes[$i][1]
			  . '</option>';
	return $out;
}

/**
 * Returns a long-long string with options (HTML <option> tags).
 *
 * @param $min Minimum index
 * @param $max Maximum index
 * @param $selected The selected index by default
 * @param $needvalues If it is not false, it'll write the needed type of value
 * @return The needed options as string.
 */
function getOptions($min, $max, $selected = 0, $needvalues = 1) {
	
	if ($needvalues)
		global $_values;
	
	$out = '';
	for ($i = $min; $i <= $max; $i++)
		$out .= "<option value='"
		     . $i . ($i == $selected ? "' selected " : "'") . ">"
		     . ($needvalues ? $_values[$i][$needvalues] : $i) . "</option>\n";
	return $out;
}

function check($s) {
	
	return htmlspecialchars(stripslashes(trim($s)));
}

class Player {
	private $id;
	private $name;
	private $numba;
	private $exp;
	private $lead;
	private $tcv;
	
	public function __construct($id0, $name0, $numba0, $exp0, $lead0) {
		$this->id = $id0;
		$this->name = $name0;
		$this->numba = $numba0;
		$this->exp = $exp0;
		$this->lead = $lead0;
		$this->tcv = $this->tcvCalc();
	}
	
	private function tcvCalc() {
		return $this->exp * 3 + $this->lead * 2;
	}
	
	public function outF() {
		echo "<tr><td>"
		   . $this->numba . newCell
		   . $this->name . newCell
		   . $this->exp . newCell
		   . $this->lead . newCell
		   . $this->tcv
		   . "</td></tr>" ;
	}
}

function writeTable() {
	echo "<script src='sorttable.js'></script>\n" .
		"<table class='sortable'>" .
		"<caption>" . check($_POST['teamname']) . "</caption>" .
		"<tr>" .
		"<th>#</th>" .
		"<th>Name</th>" .
		"<th>Experience</th>" .
		"<th>Leadership</th>" .
		"<th>TCV</th>" .
		"</tr>";

	for ($i = minSize; $i <= check($_POST['teamsize']); $i++) {
		$pname = check($_POST['pname' . $i]);
		if ($pname) {
			$team[$i] = new Player($i,
								   $pname,
								   check($_POST['pnum' . $i]),
								   check($_POST['pexp' . $i]),
								   check($_POST['plead' . $i]));
			$team[$i]->outF();
		}
	}

	echo "</table>";
}

function writeJSON() {
	$arr = array();
	$arr['teamname'] = check($_POST['teamname']);
	$arr['team'] = array();
	for ($i = minSize, $max = check($_POST['teamsize']), $y = $i-1; $i <= $max; $i++) {
		$pname = check($_POST['pname' . $i]);
		if ($pname) {
			$y++;
			$arr['team']["pname$y"] = $pname;
			$arr['team']["pexp$y"] = check($_POST["pexp$i"]);
			$arr['team']["plead$y"] = check($_POST["plead$i"]);
			$arr['team']["pnum$y"] = check($_POST["pnum$i"]);
		}
	}
	$arr['teamsize'] = $y;
	$out = json_encode($arr);
	echo "<div class='json'>" . $out . '</div>';
	return $out;
}

// ---------- main ---------- //

?>

<script>
	const maxExp = <?php echo maxExp; ?>;
	const maxLead = <?php echo maxLead; ?>;
	const minIndex = <?php echo minIndex; ?>;
	const minSize = <?php echo minSize; ?>;
	const maxSize = <?php echo maxSize; ?>;
	const minJersey = <?php echo minJersey; ?>;
	const maxJersey = <?php echo maxJersey; ?>;
	const defaultSize = <?php echo (isset($_POST['teamsize']) ? $_POST['teamsize'] : defaultSize); ?>;
	const isPosted = <?php echo (int)($_SERVER['REQUEST_METHOD'] == 'POST') ?>;
</script>
<script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
<script src="htcc.js"></script>

<div class='body'>

<h1>Hattrick (Team) Captain Chooser</h1>

<form method="post">
	Team's name: <input type='text' name='teamname' value='<?php echo isset($_POST['teamname']) ? $_POST['teamname'] : ''; ?>' required />&nbsp;&nbsp;&nbsp;&nbsp;
	Team's size: <input type='number' name='teamsize' min='<?php echo minSize; ?>' max='<?php echo maxSize; ?>' value='<?php echo isset($_POST['teamsize']) ? $_POST['teamsize'] : 16; ?>' />
	Values: <select name='valuesmode'><?php
		echo getModes($_POST['valuesmode']);
	?></select>
	<!-- <input type='checkbox' name='teamfilecheck' />
	Team's file: <input type='file' name='teamfile' disabled /><input type='button' value='Read' name='teamfileread' disabled /> -->
	<input type='submit' name='generate' value='Generate' />
</form>

<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
?>

<form method='post' name='team'>
	<input name='teamname' value='<?php echo $_POST['teamname']; ?>' hidden />
	<input name='teamsize' value='<?php echo $_POST['teamsize']; ?>' hidden />
	<input name='valuesmode' value='<?php echo $_POST['valuesmode']; ?>' hidden />
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
			echo "<tr name='tr" . $i . "'>"
			    . "<td class='right'>"
				. $i
				. "</td>"
				. "<td><input type='text' name='pname$i' value='"
				. ($_POST["pname$i"] ?: '')
				. "'/>\n</td>"
				. "<td><select class='gen' name='pexp$i'>\n"
				. getOptions(minIndex,
				             maxExp,
							 ($_POST["pexp$i"] ?: 0),
							 $_POST['valuesmode'])
				. "</select></td>"
				. "<td><select class='gen' name='plead$i'>\n"
				. getOptions(minIndex,
				             maxLead,
							 ($_POST["plead$i"] ?: 0),
							 $_POST['valuesmode'])
				. "</select></td>\n"
				. "<td><input type='number' name='pnum$i' "
				. "min='" . minJersey . "' max='" . maxJersey . "' "
				. "value='" . ($_POST["pnum$i"] ?: $i) . "'</td></tr>\n\n";
		}
		?>
		<tr><td colspan='5'>
		<div class='submit'><input type='submit' name='data' value='Send'/></div>
		</td></tr>
	</table>
</form>

<?php
		if (isset($_POST['data'])) {
			writeTable();
			$json = writeJSON();
			echo "<form method='post' action='dl_json.php'>"
			   . "<input type='submit' value='Download JSON' />"
               . "<input type='hidden' name='json' value='" . $json . "' />"
			   . "</form>";
		}
	}
	else {
		//echo "There's nothing to show.";
	};
?>

</div> <!-- end of div.body -->
