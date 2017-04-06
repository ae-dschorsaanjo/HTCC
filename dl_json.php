<?php
    header('Content-Type: application/json');
    header('Pragma: public');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false);
    header('Content-Disposition: attachment; filename=team.json');
    
    echo $_POST['json'];
    exit;
