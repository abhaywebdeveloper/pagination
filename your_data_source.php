<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'testing_datatable';
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$start = $_POST['start'] ?? 0;
$length = $_POST['length'] ?? 10;
$searchValue = $_POST['search']['value'] ?? '';
$draw = $_POST['draw'] ?? 1;

$sql = "SELECT 
            o.orderNumber,
            o.orderDate,
            o.status AS orderstatus,
            o.comments AS orderComment,
            p.productName,
            p.productDescription,
            p.buyPrice,
            p.MSRP,
            pl.productLine,
            pl.textDescription,
            c.customerName,
            TRIM(CONCAT(
                IFNULL(c.contactFirstName, ''),
                ' ',
                IFNULL(c.contactLastName, '')
            )) AS contactFullName,
            c.phone,
            c.addressLine1,
            c.addressLine2,
            c.city,
            c.state,
            c.postalCode,
            c.country,
            c.creditLimit
        FROM 
            `orders` AS o 
        LEFT JOIN  
            `orderdetails` AS od ON o.orderNumber = od.orderNumber 
        LEFT JOIN  
            `products` AS p ON od.productCode = p.productCode  
        LEFT JOIN  
            `productlines` AS pl ON p.productLine = pl.productLine   
        LEFT JOIN  
            `customers` AS c ON o.customerNumber = c.customerNumber
        WHERE
            CONCAT_WS(' ', 
                o.orderNumber,
                p.productName,
                c.contactFirstName,
                c.contactLastName,
                c.phone,
                c.postalCode,
                c.addressLine1,
                p.buyPrice
            ) LIKE '%$searchValue%' ESCAPE '!' 
        ORDER BY  o.orderNumber DESC LIMIT $start, $length";

$countQuery = "SELECT count(*) as totalRecords
                FROM 
                    `orders` AS o 
                LEFT JOIN  
                    `orderdetails` AS od ON o.orderNumber = od.orderNumber 
                LEFT JOIN  
                    `products` AS p ON od.productCode = p.productCode  
                LEFT JOIN  
                    `productlines` AS pl ON p.productLine = pl.productLine   
                LEFT JOIN  
                    `customers` AS c ON o.customerNumber = c.customerNumber
                WHERE
                    CONCAT_WS(' ', 
                        o.orderNumber,
                        p.productName,
                        c.contactFirstName,
                        c.contactLastName,
                        c.phone,
                        c.postalCode,
                        c.addressLine1,
                        p.buyPrice
                    ) LIKE '%$searchValue%' ESCAPE '!'";
                    
$result = $conn->query($sql);
$data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all data as associative array

$countResult = $conn->query($countQuery);
$totalRecords = $countResult->fetch_assoc()['totalRecords'];
$conn->close();

$response = array(
    "draw" => $draw,
    "recordsTotal" => $totalRecords,
    "recordsFiltered" => $totalRecords,
    "data" => $data
);

echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>
