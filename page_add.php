<?php
	require_once("config.php");
	// if a form was submitted, update page
	if (isset($_POST['title']) && isset($_POST['content'])) {
		$title=addslashes($_POST['title']);
		$content=addslashes($_POST['content']);
		$userID=$_POST['uid'];
		$parentID=$_POST['pid'];
		$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		if (mysqli_connect_errno()) {
			echo "Connection failed: ". mysqli_connect_error();
			exit();
		}
		$sql = "INSERT INTO pages (title, content, userID, parentID) VALUES ('{$title}','{$content}', {$userID}, {$parentID})";
		$result = $db->query($sql);		
		$db->close();
		header("Location: page_admin.php?id={$userID}");
	} else {
		if(isset($_GET['pid'])&& isset($_GET['uid'])){
		$pid=$_GET['pid'];
		$uid=$_GET['uid'];
		include ('header.php');
		echo "<hr /><p style='text-align:right;'>";
		echo "<a href='page_list.php'>view all</a> ";
		echo "</p><hr />";
		echo "<form method='post' action='page_add.php'>";
		echo "<p>Title: <input type='text' size=55 name='title' value=''></p>";
		echo "<p>Content:<br /><textarea name='content' rows=10 cols=65></textarea>";
		echo "<input type='hidden' name='pid' value={$pid}><input type='hidden' name='uid' value='{$uid}'>";
		echo "<p style='text-align:center;'><input type='submit' value='Add Page'></p></form>";
		include ('footer.php');
		}
	}	
	
?>