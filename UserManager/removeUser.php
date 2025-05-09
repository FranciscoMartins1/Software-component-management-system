<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/projetoweb/CSS/styleTest1.css">
    <script src="/projetoweb/CSS/theme.js" defer></script>
    <title>Deactivate User</title>
</head>
<body>
    <div class="form">
        <?php
            function getUserLogin($ligacao, $user_srs){
                $consulta = "SELECT LoginUsername FROM srsUser WHERE LoginUsername = '" . $user_srs."'";
                $resultado = mysqli_query($ligacao, $consulta);

                if($resultado -> num_rows > 0){
                    $row = $resultado->fetch_assoc();
                    return $row["LoginUsername"];
                } else {
                    return -1;
                }
            }

            function getUserRole($ligacao, $userID) {
                $consultaRole = "SELECT UserRoleID FROM srsUser WHERE UserID = '" . $userID."'";
                $roleID = mysqli_query($ligacao, $consultaRole);
                if($roleID -> num_rows > 0){
                    $row = $roleID->fetch_assoc();
                    return $row["UserRoleID"];
                } else {
                    return -1;
                }
            }

            $servidor = 'localhost';
            $user = 'root';
            $dbname = 'srsWeb';

            $ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
            mysqli_select_db($ligacao, $dbname) or die("Sem DB");
            
            $userRemove = $_POST['userRemove'];
            $userLogin = getUserLogin($ligacao, $userRemove);
            $userRole = getUserRole($ligacao, $userRemove);

            if($userLogin == -1){
                echo "User '$userRemove' isn't registered.</br>";
                echo '</br><a href="/projetoweb/adminUser.html"><input type="button" value="Back to menu"></a>';
            } else {
                if($userLogin != -1) {
                    $id = $_POST['userRemove'];
                    if($userRole != 2){
                        #admin normal
                        $remove = "DELETE FROM srsUser WHERE UserID = '" . $id."'";
                        $resultadoRemove = mysqli_query($ligacao, $remove);
                        header("Location: /projetoweb/adminUser.html");
                    }
                    else{
                        $removePerms = "DELETE FROM srsDevPerm WHERE DevID = '" . $id."'";
                        $resultPerm = mysqli_query($ligacao, $removePerms);
                        
                        $remove = "DELETE FROM srsUser WHERE UserID = '" . $id."'";
                        $resultPerm = mysqli_query($ligacao, $remove);
                        header("Location: /projetoweb/adminUser.html");
                    }
                }
                else{
                    echo"Error";
                }
            }
        ?>
    </div>
</body>
</html>