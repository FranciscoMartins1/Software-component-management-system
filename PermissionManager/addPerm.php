<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <script src="/projetoweb/Login/lang.js"></script>
   
   <link rel="stylesheet" href="/projetoweb/CSS/styleTest1.css">
   <script src="/projetoweb/CSS/theme.js" defer></script>
   <title>Add permission</title>
</head>
<body>
    <div class="form">
        <?php
            session_start();

            $servidor = 'localhost';
            $user = 'root';
            $dbname = 'srsWeb';

            $ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
            mysqli_select_db($ligacao, $dbname) or die("Sem DB");

            $devUser = $_SESSION['usernameChange'];
            $permID = $_POST['permID'];

            $searchID = "SELECT UserID FROM srsUser WHERE LoginUsername = '$devUser'";
            $resultadoID = mysqli_query($ligacao, $searchID);
            
            if ($resultadoID) {
                $row = mysqli_fetch_assoc($resultadoID);
                $devID = $row['UserID'];
            }
            
            $verificarPerm = "SELECT * FROM srsDevPerm WHERE DevID = '$devID' AND PermissionID = '$permID'";
            $resultado = mysqli_query($ligacao, $verificarPerm);

            $verificarPermExiste = "SELECT * FROM srsPerm WHERE PermID = '$permID'";
            $resultadoExist = mysqli_query($ligacao, $verificarPermExiste);

            if($resultado && mysqli_num_rows($resultado) > 0){
                echo "Permission $permID already registered to the developer '$devID'.</br>";
                echo '</br><a href="/projetoweb/adminUser.html"><input type="button" value="Back to menu"></a>';
            } else {
                if($resultadoExist && mysqli_num_rows($resultadoExist) > 0){
                    $addPerm = "INSERT INTO srsDevPerm (DevID, PermissionID) VALUES ('$devID', '$permID')";
                    mysqli_query($ligacao, $addPerm);
                    header("Location: /projetoweb/adminUser.html");
                }
                else{
                    header("Location: /projetoweb/adminUser.html");
                }
            }
        ?>
    </div>
</body>
</html>