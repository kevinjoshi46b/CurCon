<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurCon</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div>
        <?php
        if (isset($_POST['dark'])) {
            header("Location: dark.php");
        }
        if (isset($_POST['light'])) {
            header("Location: light.php");
        }
        ?>
        <form method="post">
            <button type="submit" name="dark" class="button dark-button">DARK</button>
            <button type="submit" name="light" class="button light-button">LIGHT</button>
        </form>
    </div>
</body>

</html>