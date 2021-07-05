<?php
date_default_timezone_set("Indian/Mahe");
$date = date("Y-m-d");

$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');

try {
    $pgsql = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
} catch (Exception $error) {
    echo "<script>alert('$error->getMessage()');</script>";
}

$query = $pgsql->query("select * from ApiCalls");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row = $query->fetch();
$db_apicalls_day = $row['day'];
$db_apicalls_count = $row['count'];

if ($db_apicalls_day === $date) {
    // code block where the api call count increases
    echo "<script>alert('$db_apicalls_day $db_apicalls_count');</script>";
} else {
    // code block where its a different day so the api call count is reset
    echo "<script>alert('$date');</script>";
    $pgsql->query("truncate table ApiCalls");
    $pgsql->query("insert into ApiCalls values ('$date',0)");
}

$query = null;
?>

<div class="page">
    <div class="amount-div">
        <label for="amount" class="tags">Amount</label><br>
        <input type="number" class="amount" id="amount" require>
    </div>
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
    <div class="result-div">
        <p class="tags">Result</p>
        <p class="result">1440 AUD</p>
        <?php ?>
    </div>
    <div class="convert-div">
        <input type="submit" name="convert" class="convert" value="Convert">
    </div>
</div>