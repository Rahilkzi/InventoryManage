<?php
session_start();
require_once "config.php";

isset($_SESSION['login']) && $_SESSION['login']===true? '': header("Location:Login.php");

$successDelete = false;
$successDeleteMessage = "";
$successEdit = isset($_SESSION['successEdit']) ? $_SESSION['successEdit'] : false;
$successEditMessage = isset($_SESSION['successEditMessage']) ? $_SESSION['successEditMessage'] : "";

unset($_SESSION['successEdit']);
unset($_SESSION['successEditMessage']);

// Check if delid is set and not empty
if (isset($_GET['delid']) && !empty($_GET['delid'])) {
    $delid = $_GET['delid'];

    // Fetch the product details before deletion for logging and insertion into deletedproducts
    $productDetailsQuery = "SELECT * FROM inventory WHERE id = ?";
    $stmtDetails = mysqli_prepare($conn, $productDetailsQuery);
    mysqli_stmt_bind_param($stmtDetails, "s", $delid);

    if (mysqli_stmt_execute($stmtDetails)) {
        $resultDetails = mysqli_stmt_get_result($stmtDetails);
        $productDetails = mysqli_fetch_assoc($resultDetails);
        mysqli_stmt_close($stmtDetails);

        // Use prepared statement to prevent SQL injection
        $stmtDelete = mysqli_prepare($conn, "DELETE FROM inventory WHERE id = ?");
        mysqli_stmt_bind_param($stmtDelete, "s", $delid);

        if (mysqli_stmt_execute($stmtDelete)) {
            // Product deleted successfully, log the deletion action
            $username = $_SESSION['username'];  // Assuming the user is logged in
            $deleteAction = "Delete Product: " . $productDetails['name'];
            $auditTrailQuery = "INSERT INTO audittrails (datetime, username, action) VALUES (CURRENT_TIMESTAMP, ?, ?)";

            $stmtAuditTrail = mysqli_prepare($conn, $auditTrailQuery);
            mysqli_stmt_bind_param($stmtAuditTrail, "ss", $username, $deleteAction);

            $successDelete = true;
            $successDeleteMessage = "Product deleted successfully!";

          

            if (mysqli_stmt_execute($stmtAuditTrail)) {
                // Logging successful
                $actionDescription = "Product deleted";
                $deletestatus = "Deleted";

                // Use prepared statement to prevent SQL injection
                $stmtInsertDeletedProduct = mysqli_prepare($conn, "INSERT INTO report (id, name, quantity, unitprice, description, category, variant, status, image, Action, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
                mysqli_stmt_bind_param($stmtInsertDeletedProduct, "ssdsbsssss", $productDetails['id'], $productDetails['name'], $productDetails['quantity'], $productDetails['unitprice'], $productDetails['description'], $productDetails['category'], $productDetails['variant'], $deletestatus, $productDetails['image'], $actionDescription);

               

                mysqli_stmt_close($stmtInsertDeletedProduct);
            } else {
                // Handle the case when there is an error in logging the deletion action
                echo "<script>alert('Error logging deletion action: " . mysqli_error($conn) . "');</script>";
            }

            mysqli_stmt_close($stmtAuditTrail);
        } else {
            // Error in deletion
            echo "<script>alert('Error deleting product: " . mysqli_error($conn) . "');</script>";
        }

        mysqli_stmt_close($stmtDelete);
    } else {
        // Error in fetching product details
        echo "<script>alert('Error fetching product details: " . mysqli_error($conn) . "');</script>";
    }
}


$companyId = 1; 
$query = "SELECT * FROM companyprofile WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $companyId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$companyProfile = mysqli_fetch_assoc($result);
$companyProfileImagePath = $companyProfile['profilepicture'];
$companyName = $companyProfile['name'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="testin3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery-all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/css/lightgallery.min.css">
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
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
<li class="navList active">
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
        <a href="Order.php">
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
        <div class="top">
            <ion-icon class="navToggle" name="menu-outline"></ion-icon>
           
            
        </div>
        <div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="display:flex;">
                
                <h2><ion-icon name="file-tray-full"></ion-icon>     Inventory</h2>
                <a href="generatepdf.php" class="allButton" style="margin-left:auto; background-color:green; border-color:green;"><b>Print</b></a>
                </div>
            </div>


            <?php if ($successDelete): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert" style="margin-top:20px;">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
  <?php echo $successDeleteMessage; ?>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left:auto;"></button>
</div>
<?php endif; ?>

<?php if ($successEdit): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert" style="margin-top:20px;">
  <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
  <div>
  <?php echo $successEditMessage; ?>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="margin-left:auto;"></button>
</div>
<?php endif; ?>

                <div class="row">
                <div class="col-md-4">
    <select name="category" id="category" class="form-control" onchange="filterTable()" style="margin-bottom:10px;">
        <option value="">All category</option>
        <?php
        // Fetch category names from the category table
        $categoryQuery = mysqli_query($conn, "SELECT categoryname FROM category");
        
        // Check if the query was successful
        if ($categoryQuery) {
            // Loop through the results and populate the dropdown
            while ($row = mysqli_fetch_assoc($categoryQuery)) {
                echo "<option value='" . $row['categoryname'] . "'>" . $row['categoryname'] . "</option>";
            }
        }
        ?>
    </select>
</div>
                    </div>
                    
        <div class="row" id="lightgallery">
            <div class="col-md-12">
                <div class="table-responsive">
                <table class="table table-bordered table-striped" id="inventory" style="border-top: 1px solid #dee2e6; border-left: 1px solid #dee2e6; border-bottom: 1px solid #dee2e6;">
                        <thead>
                            <th style="width:30px;">Image</th>
                            <th style="width:40px;">ID</th>
                            <th style="width:60px;">Name</th>
                            <th style="width:10px;">Quantity</th>
                            <th style="width:10px;">UnitPrice(RM)</th>
                            <th style="width:20px;">Variant</th>
                            <th style="width:100px;">Description</th>
                            <th style="width:30px;">Category</th>
                            <th style="width:30px;">Status</th>
                            <th style="max-width:90px;">Actions</th>
                        </thead>
                        <tbody>
                            <?php
                            require_once "config.php";

                            if(isset($_GET['page_no']) && $_GET['page_no']!=""){
                                $page_no=$_GET['page_no'];
                            }else{
                                $page_no=1;
                            }

                           


                            $sql=mysqli_query($conn, "SELECT * FROM inventory ");
                            $count=1;
                            $row=mysqli_num_rows($sql);
                            if($row >0){
                                while($row =mysqli_fetch_array($sql)){

                                    ?>
                                    <tr style="vertical-align: middle;">                                      
                                        <td><img src="<?php echo $row['image'];?>" alt="Product Image" onclick="toggleImageSize(this)" class="zoomable-image" style="text-align:center; width:50px; height:50;"></td>
                                        <td><?php echo $row['id'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['quantity'];?></td>
                                        <td><?php echo $row['unitprice'];?></td>
                                        <td><?php echo ($row['variant'] !== null) ? $row['variant'] : '---'; ?></td>
                                        <td><?php echo $row['description'];?></td>
                                        <td><?php echo $row['category'];?></td>
                                        <td><?php echo $row['status'];?></td>
                                        <td>
                                            
                                            <a href="edit.php?editid=<?php echo htmlentities($row['id']);?>" class="btn btn-sm" style="background-color:#1988F5; margin-right:5px;"> <ion-icon name="create-outline"></ion-icon>
</a>
                                            <a href="Inventory.php?delid=<?php echo htmlentities($row['id']);?>" onClick ="return confirm('Are you sure you want to delete this product ?');" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span><ion-icon name="trash-outline"></ion-icon></a>

                                            <a href="printbarcode.php?barcodeid=<?php echo htmlentities($row['id']);?>" class="btn btn-sm" style="background-color: #EDF015; margin-left: 5px;">
                                            <ion-icon name="print-outline"></ion-icon>
</a>
                                        </td>
                                    </tr>

                                    <?php
                                    $count=$count+1;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    
                </div>

                

            </div>
        </div>
    </div>
                        </div>

    </section>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./index.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>


<script>
      $(document).ready(function () {
    $('#inventory').DataTable({
      "searching": true,
    
    });
  });

  

  $(document).ready(function () {
    $("#category").on("change", function () {
        filterTable(); // Call the filter function when the category filter changes
    });

    function filterTable() {
        var selectedCategory = $("#category").val().toLowerCase(); // Convert to lowercase

        $("#inventory tbody tr").each(function () {
            var rowCategory = $(this).find('td:eq(7)').text().toLowerCase(); // Assuming the category is in the 8th cell (index 7)
            var rowText = $(this).text().toLowerCase();

            // If the selected category is empty or the row's category matches the filter, display the row
            var showRow = (selectedCategory === "" || rowCategory === selectedCategory) && rowText.indexOf(selectedCategory) > -1;
            $(this).toggle(showRow);
        });
    }
});

function generateBarcode() {
        var productId = $row['id'];
        var barcodeContainer = document.getElementById('barcodeContainer');

        // Use an image tag to display the barcode
        barcodeContainer.innerHTML = '<img src="barcode/barcode.php?text=' + productId + '" alt="Barcode">';
    }

    function generatePDF() {
        // Generate the barcode before creating the PDF
        generateBarcode();

        // Use html2pdf to convert the content to a PDF
        var element = document.getElementById('print-section');
        html2pdf(element);

        // Optionally, you can save or download the generated PDF
        // html2pdf(element, { filename: 'your_filename.pdf', output: 'save' });
    }

    // Call the function initially to display the barcode
    generateBarcode();

    // Attach an event listener to update the barcode when the product ID changes
    document.getElementById('product_id').addEventListener('input', generateBarcode);
    </script>

</body>
</html>