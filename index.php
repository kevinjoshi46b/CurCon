<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurCon</title>
    <link rel="icon" type="image/png" href="assets/favicon-32x32.png" />
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <div>
        <?php
        if (isset($_POST['dark'])) {
            header("Location: php/dark.php");
        }
        if (isset($_POST['light'])) {
            header("Location: php/light.php");
        }
        ?>
        <form method="post">
            <div class="dark-side">
                <div class="centered">
                    <button type="submit" name="dark" class="button dark-button">
                        <img src="assets/dark mode logo.png" alt="dark mode logo">
                    </button>
                </div>
            </div>
            <div class="light-side">
                <div class="centered">
                    <button type="submit" name="light" class="button light-button">
                        <img src="assets/light mode logo.png" alt="light mode logo">
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>