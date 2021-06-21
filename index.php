<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurCon</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
    <?php ?>
    <!-- <link rel="stylesheet" href="css/light-theme.css"> -->
    <link rel="stylesheet" href="css/dark-theme.css">
</head>

<body>
    <?php include "html/header.html" ?>
    <form action="index.php" method="POST">
        <div class="page">
            <div class="dropdown-div">
                <label for="from" class="tags">From</label><br>
                <select class="dropdown" id="from" require>
                    <option selected>Select</option>
                    <?php
                    // loop to list all the available options
                    ?>
                </select>
            </div>
            <div class="dropdown-div">
                <label for="to" class="tags">To</label><br>
                <select class="dropdown" id="to" require>
                    <option selected>Select</option>
                    <?php
                    // loop to list all the available options
                    ?>
                </select>
            </div>
            <div class="amount-div">
                <label for="amount" class="tags">Amount</label><br>
                <input type="number" class="amount" id="amount" require>
            </div>
            <div class="result-div">
                <p class="tags">Result</p>
                <p class="result">1440 AUD</p>
                <?php ?>
            </div>
            <div class="convert-div">
                <input type="submit" class="convert" value="Convert">
            </div>
        </div>
    </form>

    <?php include "html/footer.html" ?>
</body>

</html>