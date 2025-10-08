
<?php
session_start();
require_once "config.php";

isset($_SESSION['login']) && $_SESSION['login']===true? '': header("Location:Login.php");


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
<html>
<head>
    <title>Bulk Barcode Scanner</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="testin3.css">
    <script src="https://unpkg.com/@zxing/library@latest"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        #video {
            border: 1px solid black;
            width: 1000px;
            height: 700px;
        }

        .Scnned-data {
    margin-top: 20px;
    padding: 20px;
    background-color: #f7f7f7; /* light background for readability */
    border: 1px solid #ccc;
    border-radius: 12px;
    width: 350px; /* fixed width */
    max-height: 600px;
    overflow-y: auto; /* scroll if too many items */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    /* display: flex; */
    float: right;
    flex-direction: column;
    position: absolute;
    right: 190px;
    top: 40px;
    cursor: grab; /* show draggable cursor */
    
       

}



.Scnned-data h3 {
    margin-top: 15px;
    font-size: 20px;
    color: #333;
    border-bottom: 1px solid #ddd;
    padding-bottom: 5px;
}

.Scnned-data p {
    font-size: 16px;
    color: #555;
}

#scanned-list {
    list-style: none;
    padding: 0;
    margin-top: 10px;
}

#scanned-list li {
    background-color: #e0f7fa;
    margin: 5px 0;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 16px;
    color: #00796b;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

#scanned-list li:hover {
    background-color: #b2ebf2;
}

.Scnned-data button {
    margin-top: 15px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
    font-size: 16px;
}

.Scnned-data button:hover {
    background-color: #0056b3;
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
<li class="navList active">
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
    <h2>Bulk Barcode Scanner</h2>
    <video id="video" autoplay muted playsinline></video>

    <div class="Scnned-data">
    <p>Latest Scan: <span id="latest">None</span></p>
    <h3>Scanned Barcodes:</h3>
    <ul id="scanned-list"></ul>
    <form id="barcodeForm" method="POST" action="pro.php">
        <input type="hidden" name="barcodes" id="barcodeInput">
        <button type="submit">Submit All</button>
    </form>
    </div>
</section>

    <script>
        const codeReader = new ZXing.BrowserMultiFormatReader();
        const videoElement = document.getElementById('video');
        const latestElement = document.getElementById('latest');
        const scannedList = document.getElementById('scanned-list');
        const barcodeInput = document.getElementById('barcodeInput');

        let scannedBarcodes = {}; // barcode => count
        let lastScanTime = 0;
        let scanning = false;

        async function startScanner() {
            if (scanning) return;
            scanning = true;

            try {
                await codeReader.reset();
            } catch (e) {
                console.log("No previous camera session to reset");
            }

            codeReader.decodeFromVideoDevice(null, videoElement, (result, err) => {
                const now = Date.now();

                if (result && (now - lastScanTime > 1000)) {
                    lastScanTime = now;
                    const code = result.text;

                    // Update count
                    if (!scannedBarcodes[code]) {
                        scannedBarcodes[code] = 1;
                    } else {
                        scannedBarcodes[code]++;
                    }

                    // Update latest scanned
                    latestElement.textContent = code;

                    // Add to list or update count
                    let existingLi = document.querySelector(`li[data-code="${code}"]`);
                    if (existingLi) {
                        existingLi.textContent = `${code} (x${scannedBarcodes[code]})`;
                    } else {
                        let li = document.createElement("li");
                        li.textContent = `${code} (x1)`;
                        li.setAttribute("data-code", code);
                        scannedList.appendChild(li);
                    }

                    // Update hidden form input as JSON
                    barcodeInput.value = JSON.stringify(scannedBarcodes);
                }

                if (err && !(err instanceof ZXing.NotFoundException)) {
                    console.error("Scanner error:", err);
                }
            });
        }

        window.onload = startScanner;

        window.onbeforeunload = () => {
            codeReader.reset();
        };



        const scannedData = document.querySelector('.Scnned-data');

let isDragging = false;
let offsetX = 0;
let offsetY = 0;

scannedData.addEventListener('mousedown', (e) => {
    isDragging = true;
    offsetX = e.clientX - scannedData.getBoundingClientRect().left;
    offsetY = e.clientY - scannedData.getBoundingClientRect().top;
    scannedData.style.cursor = 'grabbing';
});

document.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    scannedData.style.left = e.clientX - offsetX + 'px';
    scannedData.style.top = e.clientY - offsetY + 'px';
    scannedData.style.right = 'auto'; // remove right when dragging
});

document.addEventListener('mouseup', () => {
    if (isDragging) {
        isDragging = false;
        scannedData.style.cursor = 'grab';
    }
});

        </script>
        
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
            <script src="./index.js"></script>
</body>

</html>
