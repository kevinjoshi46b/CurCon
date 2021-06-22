<h1 class="title">Currency Converter</h1>

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