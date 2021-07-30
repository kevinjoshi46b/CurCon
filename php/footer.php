<?php
$query = $pgsql->query("select * from ApiCalls");
$query->setFetchMode(PDO::FETCH_ASSOC);
$row = $query->fetch();
$dbApiCallsCount = (int)$row['count'];

$query = null;
?>

<div class="footer">
    <h4 class="made-by">
        Made by Kevin Joshi
    </h4>
    <p class="lower-text">
        <span class="disclaimer">DISCLAIMER:</span>
        The following project uses a currency converting API from
        <a class="link" href="https://currencylayer.com/">CURRENCYLAYER</a>
        with a Free subscription.
        The following subscription only provides 250 requests for free per month.
        <?php
        if ($dbApiCallsCount < 220) {
            echo "<span class='green'>$dbApiCallsCount</span>";
        } elseif ($dbApiCallsCount >= 248) {
            echo "<span class='red'>250</span>";
        } else {
            echo "<span class='red'>$dbApiCallsCount</span>";
        }
        ?> / 250 requests have already been made this month. [<a class="link" href="https://github.com/KevinJ-hub/CurCon">Source Code</a>]
    </p>
</div>