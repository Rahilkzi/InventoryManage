<?php
include 'config.php';
require_once "fpdf/fpdf186/fpdf.php";

// Handle delete request
if (isset($_GET['delete'])) {
    $deleteId = intval($_GET['delete']);
    $stmt = mysqli_prepare($conn, "DELETE FROM sales_report WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $deleteId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: sales_report.php");
    exit;
}



if (isset($_POST['search'])) {
    $date1 = $_POST['date1'] . " 00:00:00";
    $date2 = $_POST['date2'] . " 23:59:59";


    $query = "SELECT * FROM sales_report WHERE date BETWEEN ? AND ? ORDER BY date DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $date1, $date2);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    // Fetch sales data
    $result = mysqli_query($conn, "SELECT * FROM sales_report ORDER BY date DESC");
}

// Fetch sales data
// $result = mysqli_query($conn, "SELECT * FROM sales_report ORDER BY date DESC");

// Variables for totals
$totalQuantity = 0;
$totalAmount   = 0;



$companyId = 1; 
$query = "SELECT * FROM companyprofile WHERE id = ?";
$stmt1 = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt1, "i", $companyId);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);
$companyProfile = mysqli_fetch_assoc($result1);
$companyProfileImagePath = $companyProfile['profilepicture'];
$companyName = $companyProfile['name'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="testin3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('table').DataTable(); // Click-to-sort enabled by default
});
</script>
    <title>Sales Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #f4f4f4;
        }
        a {
            text-decoration: none;
            margin: 0 5px;
            padding: 4px 8px;
            border-radius: 4px;
        }
        .edit { background: #007BFF; color: white; }
        .copy { background: #28A745; color: white; }
        .delete { background: #DC3545; color: white; }

        .grand-total {
            font-weight: bold;
            background: #f9f9f9;
        }
    </style>
</head>

<body>
<nav>
<div class="logo">
<div class="logo-image">
    <!-- Display the company profile image fetched from the database -->
    <?php
    if (!empty($companyProfileImagePath)) {
        echo '<img src="' . $companyProfileImagePath . '" alt="Company Logo" class="logoimage">';
    } else {
        echo '<img src="path/to/placeholder/image.jpg" alt="No Image" style="">';
    }
    ?>
</div>

    <div class="logo-name">
    <?php echo $companyName; ?>
    </div>
</div>

 <div class="menu-items">
            <ul class="navLinks">
            <li class="navList">
    <a href="Dashboard.php">
    <ion-icon name="stats-chart"></ion-icon>
        <span class="links">Dashboard</span>
    </a>
</li>
<li class="navList">
    <a href="Inventory.php">
        <ion-icon name="file-tray-full"></ion-icon> <!-- Change to the desired icon name, e.g., "apps-outline" for inventory -->
        <span class="links">Inventory</span>
    </a>
</li>
<li class="navList">
    <a href="pro1.php">
        <ion-icon name="scan-outline"></ion-icon> <!-- Change to the desired icon name, e.g., "apps-outline" for inventory -->
        <span class="links">Scan Product</span>
    </a>
</li>

<li class="navList">
    <a href="Product.php">
        <ion-icon name="add-circle"></ion-icon> <!-- Change to the desired icon name, e.g., "bag-outline" for product -->
        <span class="links">Add Product</span>
    </a>
</li>

    <li class="navList">
        <a href="Category.php">
            <ion-icon name="grid"></ion-icon> <!-- Change to the desired icon name, e.g., "person-outline" for account -->
            <span class="links">Category</span>
        </a>
    </li>  
    <li class="navList">
        <a href="Order.php">
        <ion-icon name="swap-horizontal"></ion-icon> <!-- Change to the desired icon name, e.g., "person-outline" for account -->
            <span class="links">Product Transfer</span>
        </a>
    </li> 

   <li class="navList">
        <a href="sales_report.php">
        <ion-icon name="albums-outline"></ion-icon> <!-- Change to the desired icon name, e.g., "person-outline" for account -->
            <span class="links">Sales Report</span>
        </a>
    </li> 


    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>

    <li class="navList">
        <a href="Reports.php">
            <ion-icon name="reader"></ion-icon> <!-- Change to the desired icon name, e.g., "person-outline" for account -->
            <span class="links">Inventory Journal</span>
        </a>
    </li> 

    <li class="navList">
        <a href="audittrails.php">
        <ion-icon name="receipt"></ion-icon> <!-- Change to the desired icon name, e.g., "person-outline" for account -->
            <span class="links">Audit trails</span>
        </a>
    </li> 

    <li class="navList">
        <a href="Settings.php">
            <ion-icon name="cog"></ion-icon> <!-- Change to the desired icon name, e.g., "person-outline" for account -->
            <span class="links">Settings</span>
        </a>
    </li>          

<?php endif; ?>          
            </ul>
            <ul class="bottom-link">
                <li>
                <a href="logout.php">
                    <ion-icon name="log-out"></ion-icon>
                    <span class="links">Logout</span>
                </a>

                </li>
        </div>
    </nav>
    <section class="dashboard">
<div class="container mb-4">
    <form method="POST" id="orderForm" action="">
        <div class="row g-3 align-items-end">
            <div class="col-md-4">
                <label for="date1" class="form-label">Date From:</label>
                <input type="date" class="form-control" name="date1"
                    value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>" />
            </div>
            <div class="col-md-4">
                <label for="date2" class="form-label">To:</label>
                <input type="date" class="form-control" name="date2"
                    value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>" />
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary" name="search">
                    <ion-icon name="search-outline"></ion-icon> Search
                </button>
                 </form>
                <form method="POST" action="sales_report_pdf.php" target="_blank">
                    <input type="hidden" name="date1" value="<?= $_POST['date1'] ?? '' ?>">
                    <input type="hidden" name="date2" value="<?= $_POST['date2'] ?? '' ?>">
                    <button type="submit" class="btn btn-success">Download Report</button>
                </form>
            </div>
        </div>
    <!-- </form> -->
</div>
<hr>
<h2>Sales Report</h2>

<table class="table table-bordered table-hover">
    <thead class="table-light">

    <tr>
        <th>ID</th>
        <th>Date</th>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Unit Price</th>
        <th>Quantity</th>
        <th>Amount</th>
        <!-- <th>Actions</th> -->
    </tr>
</thead>
<tbody>
     <?php while ($row = mysqli_fetch_assoc($result)) { 
        $amount = $row['unitprice'] * $row['quantity'];
        $totalQuantity += $row['quantity'];
        $totalAmount   += $amount;
    ?>
  

        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['date']) ?></td>
            <td><?= htmlspecialchars($row['product_id']) ?></td>
            <td><?= htmlspecialchars($row['productname']) ?></td>
            <td><?= number_format($row['unitprice'], 2) ?></td>
            <td><?= htmlspecialchars($row['quantity']) ?></td>
            <td><?= number_format($amount, 2) ?></td>
            <!-- <td>
                <a href="edit_sales.php?id=<?= $row['id'] ?>" class="edit">Edit</a>
                <a href="copy_sales.php?id=<?= $row['id'] ?>" class="copy">Copy</a>
                
                <a href="sales_report.php?delete=<?= $row['id'] ?>" class="delete" onclick="return confirm('Delete this record?')">Delete</a>
            </td> -->
        </tr>
    <?php } ?>

     <!-- Grand Total Row -->
    <!-- <tr class="table-secondary fw-bold grand-total">
        <td colspan="5">Grand Total</td>
        <td><?= $totalQuantity ?></td>
        <td><?= number_format($totalAmount, 2) ?></td>
        <td>—</td>
    </tr> -->
    </tbody>
     <tfoot>
    <tr class="table-secondary fw-bold grand-total">
      <td colspan="5">Grand Total</td>
      <td><?= $totalQuantity ?></td>
      <td><?= number_format($totalAmount, 2) ?></td>
      <!-- <td>—</td> -->
    </tr>
  </tfoot>

</table>

</section>
</body>

     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./index.js"></script>
</html>
