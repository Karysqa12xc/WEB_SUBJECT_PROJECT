<?php
require 'conn.php';
$post_id = $_POST['postID'];
$sql = "UPDATE posts
        SET likes = likes + 1
        WHERE post_id = '$post_id'";
$conn->query($sql);
$sqlReadLike = "SELECT likes FROM posts WHERE post_id = $post_id";
$result = $conn->query(($sqlReadLike));
if($result->num_rows>0){
    $row = $result->fetch_assoc();
}
echo $row['likes'];
$conn->close();
?>