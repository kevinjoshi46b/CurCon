<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CurCon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>
    <?php include "html/header.html" ?>

    <form>
        <div class="page">
            <div class="input">
                <select class="form-select" require>
                    <option selected>Select</option>
                    <?php 
                    // loop to list all the available options
                    ?>
                </select>
                <label for="amount">Amount:</label>
                <input type="number" class="form-control" id="amount" require>
            </div>
            <div class="buttons">
                <input type="submit" class="btn btn-dark" value="Convert">
                <input type="reset" class="btn btn-dark" value="Reset">
            </div>
            <div class="output">
                <select class="form-select" require>
                    <option selected>Select</option>
                    <?php 
                    // loop to list all the available options
                    ?>
                </select>
            </div>
        </div>
    </form>

    <?php include "html/footer.html" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>