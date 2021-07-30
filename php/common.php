<?php
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
    $result = 0;

    $query = $pgsql->query("select * from ApiCalls");
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $row = $query->fetch();
    $dbApiCallsCount = (int)$row['count'];

    $amount = $_POST['amount'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    if ($from === 'default' || $from === null) {
        echo "<script>alert('Please select a \'from\' currency!');</script>";
        $result = 'INPUT MISSING!';
    } elseif ($to === 'default' || $to === null) {
        echo "<script>alert('Please select a \'to\' currency!');</script>";
        $result = 'INPUT MISSING!';
    } else {
        if ($dbApiCallsCount >= 248) {
            $result = 'Maximum API Requests Reached!';
        } else {
            $dbApiCallsCount += 1;
            $pgsql->query("truncate table ApiCalls");
            $pgsql->query("insert into ApiCalls values ($dbApiCallsCount)");

            $ch = curl_init('http://api.currencylayer.com/live?access_key=' . $API_KEY . '&currencies=' . $from . ',' . $to);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($ch);
            curl_close($ch);
            $apiResult = json_decode($json, true)['quotes'];
            $result = round(($apiResult['USD' . $to] * $amount) / $apiResult['USD' . $from], 2);
        }
    }
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
        $pgsql->query("insert into ApiCalls values (1)");
        $pgsql->query("truncate table CurrencyListCalls");
        $pgsql->query("insert into CurrencyListCalls values ('$day')");

        $ch = curl_init('http://api.currencylayer.com/?access_key=' . $API_KEY);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $currenciesList = json_decode($json, true);
        $currenciesList = $currenciesList['currencies'];

        $currenciesInsertionList = "";
        foreach ($currenciesList as $key => $value) {
            $currenciesInsertionList = $currenciesInsertionList . "('$key','$value'),";
        }
        $currenciesInsertionListLen = strlen($currenciesInsertionList) - 1;
        $currenciesInsertionList = substr($currenciesInsertionList, 0, $currenciesInsertionListLen);
        $pgsql->query("truncate table CurrenciesList");
        $pgsql->query("insert into CurrenciesList values $currenciesInsertionList ;");
    } else {
        $query = $pgsql->query("select * from CurrenciesList");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        while ($row = $query->fetch()) {
            $currenciesList[$row['code']] = $row['name'];
        }
    }
}
?>

<div class="page">
    <div class="amount-div">
        <label for="amount" class="tags">Amount</label><br>
        <input type="number" step="0.01" class="amount" id="amount" name="amount" required>
    </div>
    <div class="dropdown-div">
        <label for="from" class="tags">From</label><br>
        <select class="dropdown" id="from" name="from" required>
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
        <select class="dropdown" id="to" name="to" required>
            <option value="default" selected>Select</option>
            <?php
            foreach ($currenciesList as $key => $value) {
                echo "<option value='$key'>$key - $value</option>";
            }
            ?>
        </select>
    </div>
    <div class="result-div">
        <?php
        if (isset($_POST['convert'])) {
            echo "<p class='tags'>Result</p>";
            echo "<p class='result'>$result</p>";
        }
        ?>
    </div>
    <div class="convert-div">
        <input type="submit" name="convert" class="convert" value="Convert">
    </div>
</div>