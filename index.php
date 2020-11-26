<?php
$conn = mysqli_connect(
  'localhost',
  'root',
  'ilovejesus1',
  'LOVE');

$sql = "SELECT * FROM topic";
$result = mysqli_query($conn, $sql);
$list = '';
while($row = mysqli_fetch_array($result)) {
  $escaped_title = htmlspecialchars($row['title']);
  $list = $list."<li><a href=\"index.php?id={$row['id']}\">{$escaped_title}</a></li>";
}

$article = array(
  'title'=>'목표 자가진단 웹페이지에 온 것을',
  'description'=>'환영합니다. ^^'
);
$update_link = '';
$delete_link = '';
$author = '';
if(isset($_GET['id'])) {
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
  $sql = "SELECT * FROM topic LEFT JOIN author ON topic.author_id = author.id WHERE topic.id={$filtered_id}";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $article['title'] = htmlspecialchars($row['title']);
  $article['description'] = htmlspecialchars($row['description']);
  $article['name'] = htmlspecialchars($row['name']);

  $update_link = '<a href="update.php?id='.$_GET['id'].'">update</a>';
  $delete_link = '
    <form action="process_delete.php" method="post">
      <input type="hidden" name="id" value="'.$_GET['id'].'">
      <input type="submit" value="delete">
    </form>
  ';
  $author = "<p>by {$article['name']}</p>";
}

?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>우리가족 일기장</title>
  </head>
  <body>
    <h1><a href="index.php">우리가족 일기장</a></h1>
    <a href="author.php">저자</a>
    <ol>
      <?=$list?>
    </ol>
    <p><a href="create.php">새로 쓰기</a></p>
    <?=$update_link?>
    <?=$delete_link?>
    <h2><?=$article['title']?></h2>
    <?=$article['description']?>
    <?=$author?>
  </body>
</html>
