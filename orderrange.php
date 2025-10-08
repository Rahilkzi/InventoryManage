<?php
require_once "config.php";

$grandTotal = 0; // Initialize grand total

if (isset($_POST['search'])) {
    $date1 = date("Y-m-d", strtotime($_POST['date1']));
    $date2 = date("Y-m-d", strtotime($_POST['date2']));

    $reportQuery = mysqli_query($conn, "SELECT * FROM deliverorder WHERE STR_TO_DATE(`addeddate`, '%Y-%m-%d') BETWEEN '$date1' AND '$date2' ORDER BY `id` DESC") or die(mysqli_error($conn));
} else {
    $reportQuery = mysqli_query($conn, "SELECT * FROM deliverorder ORDER BY `id` DESC") or die(mysqli_error($conn));
}

if (mysqli_num_rows($reportQuery) > 0) {
    while ($reportFetch = mysqli_fetch_array($reportQuery)) {
        $quantity = $reportFetch['quantity'];
        $unitPrice = $reportFetch['unitprice'];
        $total = $quantity * $unitPrice;
        $grandTotal += $total;

        ?>
        <tr>
            <td><?php echo $reportFetch['id']; ?></td>
            <td><?php echo $reportFetch['productid']; ?></td>
            <td><?php echo $reportFetch['name']; ?></td>
            <td><?php echo $quantity; ?></td>
            <td>₹<?php echo number_format($unitPrice, 2); ?></td>
            <td>₹<?php echo number_format($total, 2); ?></td>
            <td><?php echo $reportFetch['location']; ?></td>
            <td><?php echo $reportFetch['addeddate']; ?></td>
        </tr>
        <?php
    }

    // Display Grand Total row
    ?>
    <tr style="font-weight: bold; background-color: #f2f2f2;">
        <td colspan="5" style="text-align:right;">Grand Total:</td>
        <td>₹<?php echo number_format($grandTotal, 2); ?></td>
        <td colspan="2"></td>
    </tr>
    <?php
} else {
    echo '
    <tr>
        <td colspan="8"><center>No records found</center></td>
    </tr>';
}
?>
