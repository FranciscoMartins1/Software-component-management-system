<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <script src="/projetoweb/Login/lang.js"></script>
   
   <link rel="stylesheet" href="/projetoweb/CSS/styleTest1.css">
   <script src="/projetoweb/CSS/theme.js" defer></script>

   <link href="http://mottie.github.io/tablesorter/css/theme.default.css" rel="stylesheet">
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.9.1/jquery.tablesorter.min.js"></script>

   <title>Permissions</title>
</head>
<body>
    <div class="form">
    <?php
        session_start();
        function getAllPerms($ligacao){
            $consultaAllPerms = "SELECT PermID, PermDescr FROM srsPerm";
            $resultadoAllPerms = mysqli_query($ligacao, $consultaAllPerms);


            if($resultadoAllPerms){
                return $resultadoAllPerms;
            } else {
                return false;
            }
        }

        function getUserPermsByID($ligacao, $username){
            $consultaNome = "SELECT UserID FROM srsUser WHERE LoginUsername = '$username'";
            $resultadoNome = mysqli_query($ligacao, $consultaNome);
            if($resultadoNome){
                $row = mysqli_fetch_assoc($resultadoNome);
                $userID = $row['UserID'];
                $_SESSION['userIDChange'] = $userID;
                
                $consultaUserPerms = "SELECT PermID, PermDescr FROM srsPerm INNER JOIN srsDevPerm ON PermID = PermissionID WHERE DevID = '$userID' ORDER BY PermID";
                
                $resultadoUserPerms = mysqli_query($ligacao, $consultaUserPerms);


                if($resultadoUserPerms){
                    return $resultadoUserPerms;
                } else {
                    return false;
                }
            }
        }


        $servidor = 'localhost';
        $user = 'root';
        $dbname = 'srsWeb';


        $ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
        mysqli_select_db($ligacao, $dbname) or die("Sem DB");


        $username = $_POST['UsernamechangePermission'];
        $_SESSION['usernameChange'] = $username;

        $userAllPermissions = getAllPerms($ligacao);
        $userPermissions = [];


        if($userAllPermissions){
        $userPermissions = getUserPermsByID($ligacao, $username);
        }

        echo "<h2>All Permissions</h2>";
        if($userAllPermissions){
            echo "<table id='permTable' class='table'>
            <thead>
            <tr>
            <th>Permission ID</th>
            <th>Permission Description</th>
            </tr>
            </thead>
            <tbody>";
            while($row = $userAllPermissions->fetch_assoc()){
                echo
                "<tr>"
                ."<td>" .$row["PermID"] . "</td>"
                ."<td>" .$row["PermDescr"] . "</td>"
                ."</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "There are no permissions registered.";
        }


        echo "<br/><br/>";
        if($userPermissions->num_rows > 0){
            echo "<h2>User Permissions</h2>";
            echo "<table id='permUserTable' class='table'>
            <thead>
            <tr>
            <th>Permission ID</th>
            <th>Permission Description</th>
            </tr>
            </thead>
            <tbody>";
            while($row = $userPermissions->fetch_assoc()){
                echo
                "<tr>"
                ."<td>" .$row["PermID"] . "</td>"
                ."<td>" .$row["PermDescr"] . "</td>"
                ."</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "This user has no permissions.";
        }
    ?>
    <script>
        $(function() {
            $("#permTable").tablesorter();
        });
    </script>

    <script>
        $(function() {
            $("#permUserTable").tablesorter();
        });
    </script>

    </br>
    </br>

    <form action="addPerm.php" method="post">
    Permission to add<input type="text" name="permID" placeholder="ID">
    <input type="submit" name="add" value="Add">
    </form>
    </br>
    <form action="removePerm.php" method="post">
    Permission to remove<input type="text" name="permIDRemove" placeholder="ID">
    <input type="submit" name="remove" value="Remove">
    </form>

    </br>
    <input type="button" value="Back to menu" onClick="window.location.href='/projetoweb/adminUser.html'">
</body>
</html>