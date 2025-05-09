<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <script src="/projetoweb/Login/lang.js"></script>
   
   <link rel="stylesheet" href="/projetoweb/CSS/styleTest1.css">
   <script src="/projetoweb/CSS/theme.js" defer></script>
   <title>Remove Permission</title>
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

        $devID = $_SESSION['userIDChange'];
        $permID = $_POST['permIDRemove'];
        
        $removerPerm = "DELETE FROM srsDevPerm WHERE DevID = '$devID' AND PermissionID = '$permID'";
        $permRemoved = mysqli_query($ligacao, $removerPerm);

        if($permRemoved){
            header("Location: /projetoweb/adminUser.html");
        } else {
            echo "Error removing permission $permID to developer '$devID'.</br>";
            echo '</br><a href="/projetoweb/adminUser.html"><input type="button" value="Back to menu"></a>';
        }
?>
    </div>
</body>
</html>