<?php

define("newCell", "</td><td>", false);

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
		echo "<tr><td>" . $this->numba . newCell . $this->name . newCell . $this->exp . newCell . $this->lead . newCell . $this->tcv . "</td></tr>" ;
	}
}

function check($s) {
	
	return htmlspecialchars(stripslashes(trim($s)));
}

// ---------- main ---------- //

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
	$team[$i] = new Player($i, check($_POST['pname' . $i]), check($_POST['pnum' . $i]), check($_POST['pexp' . $i]), check($_POST['plead' . $i]));
	$team[$i]->outF();
}

echo "</table>";

/*
for($i = 0; $i < count($_values[0]); $i++) 
    echo $i." ".$_values[1][$i]."<br>";*/
