<?php
$limitReached = false;
date_default_timezone_set("Indian/Mahe");
$day = date("Y-m-d");
$dbHost = getenv('DB_HOST');
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$API_KEY = getenv('API_KEY');

try {
    $pgsql = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
} catch (Exception $error) {
    echo "<script>alert('$error->getMessage()');</script>";
}

if (isset($_POST['convert'])) {
    // Code for when the convert button is clicked
    echo " ";
} else {
    $currenciesList = array();
    $year = (int)substr($day, 0, 4);
    $month = (int)substr($day, 6, 2);

    $query = $pgsql->query("select * from CurrencyListCalls");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $row = $query->fetch();
    $dbCurrencyListCallsDay = $row['day'];
    $dbCurrencyListCallsYear = (int)substr($dbCurrencyListCallsDay, 0, 4);
    $dbCurrencyListCallsMonth = (int)substr($dbCurrencyListCallsDay, 6, 2);

    if (($year != $dbCurrencyListCallsYear) || ($month != $dbCurrencyListCallsMonth)) {
        $pgsql->query("truncate table ApiCalls");
        $pgsql->query("insert into ApiCalls values ('$day',1)");
        $pgsql->query("truncate table CurrencyListCalls");
        $pgsql->query("inset into CurrencyListCalls values ('$day')");
        // Code to update the list of available currencies
    } else {
        $query = $pgsql->query("select * from CurrenciesList");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $query->fetch()) {
            $currenciesList[$row['code']] = $row['name'];
        }
    }
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
            <option value="default" selected>Select</option>
            <?php
            foreach ($currenciesList as $key => $value) {
                echo "<option value='$key'>$key - $value</option>";
            }
            ?>
        </select>
    </div>
    <div class="dropdown-div">
        <label for="to" class="tags">To</label><br>
        <select class="dropdown" id="to" require>
            <option value="default" selected>Select</option>
            <?php
            foreach ($currenciesList as $key => $value) {
                echo "<option value='$key'>$key - $value</option>";
            }
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