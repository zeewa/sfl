<!DOCTYPE html>
<html>
<head>
<style>
.btn {
    border: none;
    color: white;
    padding: 14px 28px;
    font-size: 16px;
    cursor: pointer;
}

.success {background-color: #4CAF50;} /* Green */
.success:hover {background-color: #46a049;}

.info {background-color: #2196F3;} /* Blue */
.info:hover {background: #0b7dda;}

.warning {background-color: #ff9800;} /* Orange */
.warning:hover {background: #e68a00;}

.danger {background-color: #f44336;} /* Red */ 
.danger:hover {background: #da190b;}

.default {background-color: #e7e7e7; color: black;} /* Gray */ 
.default:hover {background: #ddd;}
</style>
</head>
<body>

<h1>Alert Buttons</h1>

<button class="btn success">Success</button>
<button class="btn info">Info</button>
<button class="btn warning">Warning</button>
<button class="btn danger">Danger</button>
<button class="btn default">Default</button>
<?php
$servername = "localhost";
$username = "jm";
$password = "jeeva";
$dbname = "mydb";
#$link = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", "$username", "$password");

try {
    $dbh = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", "$username", "$password");

    echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
    foreach($dbh->query('SELECT * from assets') as $row) {
        print_r($row);
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>

</body>
</html>
