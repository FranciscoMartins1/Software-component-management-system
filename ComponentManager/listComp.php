<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="/projetoweb/Login/lang.js"></script>

    <link rel="stylesheet" href="CSS/styleTest1.css">
    <script src="CSS/theme.js"></script>

    <link href="http://mottie.github.io/tablesorter/css/theme.default.css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js"></script>

    <title>List Components</title>
</head>

<body>
    <?php
        session_start();
        
        function getComponents($userID) {
            $servidor = "localhost";
            $user = "root";
            $dbname= "srsWeb";

            $ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
            mysqli_select_db($ligacao, $dbname) or die("Sem DB");

            $consulta = "SELECT CompID, CompName, UserName, CompDepend FROM srsComp INNER JOIN srsUser ON CompUserID = UserID";
            return mysqli_query($ligacao, $consulta);
        }

        if (!isset($_SESSION['UserID'])) {
            header("Location: Login/login.html");
            exit();
        }

        $userID = $_SESSION['UserID'];

        $resultado = getComponents($userID);
            if($resultado->num_rows > 0){
            echo "<h2>Components</h2>";
            echo "<table id='compTable' class='table'>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Dependence</th>
                </tr>
                </thead>
                <tbody>";
                while($row = $resultado->fetch_assoc()){
                    echo
                    "<tr>"
                        ."<td>" .$row["CompID"] . "</td>"
                        ."<td>" .$row["CompName"] . "</td>"
                        ."<td>" .$row["UserName"] . "</td>"
                        ."<td>" .$row["CompDepend"] . "</td>"
                    ."</tr>";
                }
                echo "</tbody></table>";
            }
                else{
                    echo "No components.";
                }    
    ?>
    <script>
        $(function() {
            $("#compTable").tablesorter();
        });
    </script>
</body>
</html>