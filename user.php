<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable with AJAX</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "your_data_source.php",
                    "type": "POST"
                },
                "columns": [
                    { "data": "orderNumber" },
                    { "data": "orderDate" },
                    { "data": "orderstatus" },
                    { "data": "orderComment" },
                    { "data": "productName" },
                    { "data": "productDescription" },
                    { "data": "buyPrice" },
                    { "data": "MSRP" },
                    { "data": "productLine" },
                    // { "data": "textDescription" },
                    { "data": "customerName" },
                    { "data": "contactFullName" },
                    { "data": "phone" },
                    { "data": "addressLine1" },
                    { "data": "addressLine2" },
                    { "data": "city" },
                    { "data": "state" },
                    { "data": "postalCode" },
                    { "data": "country" },
                    { "data": "creditLimit" },
                ],
                "paging": true
            });
        });
    </script>
</head>
<body>
    <div>
        <h2>Order List</h2>
    </div>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>orderNumber</th>
                <th>orderDate</th>
                <th>orderstatus</th>
                <th>orderComment</th>
                <th>productName</th>
                <th>productDescription</th>
                <th>buyPrice</th>
                <th>MSRP</th>
                <th>productLine</th>
                <!-- <th>textDescription</th> -->
                <th>customerName</th>
                <th>contactFullName</th>
                <th>phone</th>
                <th>addressLine1</th>
                <th>addressLine2</th>
                <th>city</th>
                <th>state</th>
                <th>postalCode</th>
                <th>country</th>
                <th>creditLimit</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>orderNumber</th>
                <th>orderDate</th>
                <th>orderstatus</th>
                <th>orderComment</th>
                <th>productName</th>
                <th>productDescription</th>
                <th>buyPrice</th>
                <th>MSRP</th>
                <th>productLine</th>
                <!-- <th>textDescription</th> -->
                <th>customerName</th>
                <th>contactFullName</th>
                <th>phone</th>
                <th>addressLine1</th>
                <th>addressLine2</th>
                <th>city</th>
                <th>state</th>
                <th>postalCode</th>
                <th>country</th>
                <th>creditLimit</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>
