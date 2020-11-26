<?php
$conn = mysqli_connect("localhost", "root", "ilovejesus1", "LOVE");
$sql  = "
	INSERT INTO topic (
		title,
		description,
		created
	) VALUES (
		'MySQL',
		'MySQL is ....',
		NOW()
	)";
$result = mysqli_query($conn, $sql);
if($result === false){
    echo mysqli_error($conn);
}

?>
