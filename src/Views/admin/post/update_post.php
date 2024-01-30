<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Post</title>
</head>

<body>
    <h2>Update Post</h2>
    <form action="" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="id" name="id" value="<?php echo $post['id']; ?>"><br>

        <input type="text" id="title" name="title" value="<?php echo $post['title']; ?>"><br>
        <label for="content">Content:</label><br>
        <textarea id="content" name="content"><?php echo $post['content']; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>