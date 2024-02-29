<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
</head>

<body>
    <h2>Update User</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" id="id" name="id" value="<?php echo $user['id']; ?>">

        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>"><br>

        <label for="img">New Image:</label><br>
        <input type="file" id="img" name="img"><br>

        <?php if (!empty($user['img'])): ?>
        <img src="<?php echo $user['img']; ?>" alt="User Image"><br>
        <?php endif; ?>

        <input type="submit" value="Update">
    </form>
</body>

</html>