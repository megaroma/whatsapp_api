<?php
include "vendor/autoload.php";
include "conf.php";


$w->eventManager()->bind("onGetMessage", "onMessage");
$w->eventManager()->bind("onGetImage", "onImage");
$w->eventManager()->bind("onSendMessage", "onSendMessage");

$w->connect(); 

try {
	$w->loginWithPassword($password);
} catch (Exception $e) {
	echo "Login Error!";
	exit;	
}



function onSendMessage($mynumber, $target, $messageId, $node)
    {
    	echo "<b>Sent message</b> Message for: $target <br>";
    }

function onMessage($mynumber, $from, $id, $type, $time, $name, $body)
{
    echo "<b>Received message</b> Message from: $name <br>";
    $sql = "INSERT INTO `tmp_whatsapp_messages` 
    		(`to`,`from`,`whatsapp_id`,`type`,`time`,`name`,`body`,`file`) VALUES 
    		('".db::escape($mynumber)."','".db::escape($from)."','".db::escape($id)."','".db::escape($type)."','".db::escape($time)."','".db::escape($name)."','".db::escape($body)."', '')";
    db::query($sql);
}

function onImage($mynumber, $from, $id, $type, $time, $name, $size, $url, $file, $mimeType, $fileHash, $width, $height, $preview, $caption)
{
	echo "<b>Received image</b> from $from <br>";

	$buf = explode("/", $mimeType);
	$file_type = $buf[1];
	file_put_contents(__DIR__."/attachment/images/".$id.".".$file_type, $file);

    $sql = "INSERT INTO `tmp_whatsapp_messages` 
    		(`to`,`from`,`whatsapp_id`,`type`,`time`,`name`,`body`,`file`) VALUES 
    		('".db::escape($mynumber)."','".db::escape($from)."','".db::escape($id)."','".db::escape($type)."','".db::escape($time)."','".db::escape($name)."','','".db::escape($id.".".$file_type)."' )";
    db::query($sql);
}

?>

<hr>
<p>Send Message:</p>
<form method="post">
Number:<input type="text" name="number" value=""><br>
Message:<br>
<textarea name="text"></textarea><br>
<input type="submit" name="action" value="Send">
</form>
<hr>

<?php


echo "<b>Events:</b><hr>";


if(isset($_POST['action'])) {
	$number = $_POST['number'];
	$text = $_POST['text'];
	if(($number != "") && ($text != "")) {
		$w->sendMessage($number , $text);
	}
}


while($w->pollMessage()) {

}

$sql = "select * from `tmp_whatsapp_messages`";
$res = db::query($sql);
$tbl = array();
while ( $row = mysqli_fetch_assoc($res)) {
	$tbl[] = $row;
}

?><hr>
<b>Data Base:</b><br>
<?php if(count($tbl)>0): ?>
<table border="1">
<tr>
<?php foreach($tbl[0] as $name => $v): ?>
	<th><?php echo $name; ?></th>
<?php endforeach; ?>
</tr>

<?php foreach($tbl as $row): ?>
	<tr>
		<?php foreach($row as  $v): ?>
			<td><?php echo $v; ?></td>
		<?php endforeach; ?>
	</tr>
<?php endforeach; ?>
</table>


<?php endif; ?>
