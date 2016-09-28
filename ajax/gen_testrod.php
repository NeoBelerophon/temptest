<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/lib/utilities.php';

session_start();

$bedtemp = json_decode(stripslashes($_POST['bedtemp']));
$bedtemp1 = json_decode(stripslashes($_POST['bedtemp1']));
$temp1 = json_decode(stripslashes($_POST['temp1']));
$testtemps = json_decode(stripslashes($_POST['testtemps']));

$tempstring = "";
foreach($testtemps as $d){
	$tempstring .= $d . " ";
}
$tempstring = rtrim($tempstring, " ");

/** CONNECT DATABASE */
$db = new Database();

/** CHECK FOR OBJ OR CREATE IT */
$_user = $_SESSION['user']['id'];
$cmd  = "SELECT id FROM sys_objects WHERE obj_name='temptest' AND user=$_user";
$obj_id  = $db->query($cmd)['id'];
if (!$obj_id){
	$_obj_insert['obj_name'] = "Temptest";
	$_obj_insert['obj_description'] = "Objects created by Temptest plugin";
	$_obj_insert['private'] = "false";
	$_obj_insert['date_insert'] = 'now()';
	$_obj_insert['user'] = $_SESSION['user']['id'];
	$obj_id = $db->insert('sys_objects', $_obj_insert);
}

$_file_id = $db->insert('sys_files', array());

$_file_name = 'test_rod' . $_file_id . '.gcode';
$_file_path = UPLOAD_PATH . $_file_name;

/** WAIT JUST 1 SECOND */
sleep(1);
/** EXEC COMMAND */
$_command = "sudo python ../assets/lib/gen_testrod.py --file=$_file_path --bedtemp1=$bedtemp1 --temp1=$temp1 --bedtemp=$bedtemp $tempstring";
$_output_command = shell_exec($_command);
/** WAIT JUST 1 SECOND */
sleep(1);

/** GET TYPE OF PRINT */
$_print_type = print_type($_file_path);

$_file_size = filesize($_file_path);

/** UPDATE FILE INFO */
$_file_update['file_name'] = $_file_name;
$_file_update['file_type'] = 'text/plain';
$_file_update['file_path'] = UPLOAD_PATH;
$_file_update['full_path'] = $_file_path;
$_file_update['raw_name'] = 'test_rod' . $_file_id;
$_file_update['orig_name'] = $_file_name;
$_file_update['client_name'] = $_file_name;
$_file_update['file_ext'] = '.gcode';
$_file_update['file_size'] = $_file_size;
$_file_update['print_type'] = $_print_type;
$_file_update['insert_date'] = 'now()';

$db->update('sys_files', array('column' => 'id', 'value' => $_file_id, 'sign' => '='), $_file_update);

//** ADD FILE TO OBJ */
$_obj_file_insert['id_obj'] = $obj_id;
$_obj_file_insert['id_file'] = $_file_id;
$db->insert('sys_obj_files', $_obj_file_insert);

$db->close();

/** GCODE ANALYZER */
shell_exec('sudo php /var/www/fabui/script/gcode_analyzer.php '.$_file_id.' > /dev/null & echo $!');

sleep(1);

echo "Testrod generated and stored to object manager";
?>