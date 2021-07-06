<?php
$query = $pgsql->query("select * from ApiCalls");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row = $query->fetch();
$dbApiCallsDay = $row['day'];
$dbApiCallsCount = (int)$row['count'];

if ($dbApiCallsDay != $day) {
    $pgsql->query("truncate table ApiCalls");
    $pgsql->query("insert into ApiCalls values ('$day',0)");
    $dbApiCallsCount = 0;
}

$query = null;
?>

<div class="footer">
    <h4 class="made-by">
        Made by Kevin Joshi
    </h4>
    <p class="lower-text">
        <span class="disclaimer">DISCLAIMER:</span>
        The following project uses Currency Converter API from
        <a class="link" href="https://rapidapi.com/natkapral/api/currency-converter5">RAPIDAPI</a>
        with a Basic plan.
        The following plan only provides 100 requests for free per day.
        <?php
        if ($dbApiCallsCount < 80) {
            echo "<span class='green'>$dbApiCallsCount</span>";
        } elseif ($dbApiCallsCount >= 98) {
            echo "<span class='red'>100</span>";
        } else {
            echo "<span class='red'>$dbApiCallsCount</span>";
        }
        ?> / 100 requests have already been made today. [<a class="link" href="https://github.com/KevinJ-hub/CurCon">Source Code</a>]
    </p>
</div>