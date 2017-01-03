<head>
    <title>Via-Me.lk</title>
    <link rel="shortcut icon" href="../img/favicon.png" type="image/x-icon" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <script type="text/javascript" src="tableExport.js"></script>
    <script type="text/javascript" src="jquery.base64.js"></script>
    <script type="text/javascript" src="html2canvas.js"></script>
    <script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="jspdf/jspdf.js"></script>
    <script type="text/javascript" src="jspdf/libs/base64.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<?php
 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autohub";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$qry="SELECT * FROM `orders`  ";
$result=mysqli_query($conn, $qry);


$records = array();

while($row = mysqli_fetch_assoc($result)){
    $records[] = $row;

}

?>


                <!-------------body conten goes here ------------------>
<div class="row" style="background-color: #7487b1;height:70px;">
    <img src="../logos/logo.png" style="margin-left:50px;">
</div><br><br>
<div class="container">
    <div class="row">
        <div class="row">
            <button class="btn btn-warning" style="width:500px;height:75px;"><a href="home.php"><i class="glyphicon glyphicon-chevron-left"></i>GO BACK</a></button>
            <div class="btn-group pull-right" style=" padding: 10px;">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <span class="glyphicon glyphicon-th-list"></span> Import AS

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="Import as">
                       <!-- <li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'false'});"> <img src="rimages/json.jpg" width="24px"> JSON</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src="rimages/json.jpg" width="24px">JSON (ignoreColumn)</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'true'});"> <img src="rimages/json.jpg" width="24px"> JSON (with Escape)</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'xml',escape:'false'});"> <img src="rimages/xml.png" width="24px"> XML</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'sql'});"> <img src="rimages/sql.png" width="24px"> SQL</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'csv',escape:'false'});"> <img src="rimages/csv.png" width="24px"> CSV</a></li>-->
                        <li><a href="#" onclick="$('#employees').tableExport({type:'txt',escape:'false'});"> <img src="rimages/txt.png" width="24px"> TXT</a></li>
                        <li class="divider"></li>

                        <li><a href="#" onclick="$('#employees').tableExport({type:'excel',escape:'false'});"> <img src="rimages/xls.png" width="24px"> XLS</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'doc',escape:'false'});"> <img src="rimages/word.png" width="24px"> Word</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'powerpoint',escape:'false'});"> <img src="rimages/ppt.png" width="24px"> PowerPoint</a></li>
                        <li class="divider"></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'png',escape:'false'});"> <img src="rimages/png.png" width="24px"> PNG</a></li>
                        <li><a href="#" onclick="$('#employees').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src="rimages/pdf.png" width="24px"> PDF</a></li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row" style="height:600px !important;overflow:scroll;">
            <hr>
            <table id="employees" class="table">
                <thead>
                <tr >
                    <th>ORDER ID</th>
                    <th>PRODUCT NO</th>
                    <th>BUYER UNAME(*)</th>
                    <th>PICKUP METHOD(ADDRESS OR PICKUP)</th>
                    <th>ORDER INCLUDE VALUE</th>
 
                </tr>
                </thead>
                <tbody>
                <?php foreach($records as $rec):?>
                    <tr>
                        <td><?php echo $rec['id']?></td>
                        <td><?php echo $rec['orderDate']?></td>
                        <td><?php echo $rec['orderTotal']?></td>
                        <td><?php echo $rec['shippingAddress']?></td>
                        <td><?php echo $rec['user_id']?></td>
 
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>




</div>
</div>





                <!----------------------------------------------------->

<script type="text/javascript">
    //$('#employees').tableExport();
    $(function(){
        $('#example').DataTable();
    });
</script>