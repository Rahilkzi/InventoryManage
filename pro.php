<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['barcodes'])) {
    $barcodeCounts = json_decode($_POST['barcodes'], true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        die("<p>Invalid barcode data received.</p>");
    }

    echo "<h2>Batch Update Summary:</h2><ul>";
    foreach ($barcodeCounts as $code => $count) {
        $code = trim($code);

        // Step 1: Fetch current quantity
        $stmtSelect = mysqli_prepare($conn, "SELECT id, name, unitprice, quantity FROM inventory WHERE id = ?");
        mysqli_stmt_bind_param($stmtSelect, "s", $code);
        mysqli_stmt_execute($stmtSelect);
        $result = mysqli_stmt_get_result($stmtSelect);
        $product = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmtSelect);

        if ($product) {
            $newQuantity = max(0, $product['quantity'] - $count); // Avoid negative stock

            // Step 2: Update quantity
            $stmtUpdate = mysqli_prepare($conn, "UPDATE inventory SET quantity = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmtUpdate, "is", $newQuantity, $code);
            mysqli_stmt_execute($stmtUpdate);
            mysqli_stmt_close($stmtUpdate);

            
            // Step 3: Insert sales record
            $date = date("Y-m-d H:i:s"); // current timestamp
            $stmtInsert = mysqli_prepare($conn, 
                "INSERT INTO sales_report (date, product_id, productname, unitprice, quantity) 
                VALUES (?, ?, ?, ?, ?)"
            );
            mysqli_stmt_bind_param(
                $stmtInsert,
                "sssdi", // date(string), product_id(string), productname(string), unitprice(double), quantity(int)
                $date,
                $product['id'],
                $product['name'],
                $product['unitprice'],
                $count
            );
            mysqli_stmt_execute($stmtInsert);
            mysqli_stmt_close($stmtInsert);


            echo "<li>✅ Product ID <strong>" . htmlspecialchars($code) . "</strong> scanned $count times → New quantity: $newQuantity</li>";
        } else {
            echo "<li>❌ Product ID <strong>" . htmlspecialchars($code) . "</strong> not found in inventory.</li>";
        }
    }
    echo "</ul>";
} else {
    echo "<p>No barcodes received.</p>";
}
?>