<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/projetoweb/CSS/styleTest1.css">
    <script src="/projetoweb/CSS/theme.js" defer></script>
    <title>Edit User</title>
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

            $servidor = 'localhost';
            $user = 'root';
            $dbname = 'srsWeb';

            $ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
            mysqli_select_db($ligacao, $dbname) or die("Sem DB");

            $userEdit = $_POST['userEdit'];
            $userLogin = getUserLogin($ligacao, $userEdit);

            if($userLogin == -1){
                echo "User '$userEdit' isn't registered.</br>";
                echo '</br><a href="/projetoweb/adminUser.html"><input type="button" value="Back to menu"></a>';
            } else {
                if($userLogin != -1) {
                    echo '<form action="" method="post">
                    Password: <input type="password" name="editPassword"></br>
                    Name: <input type="text" name="editName"></br>
                    Address: <input type="text" name="editAddress"></br>
                    NIF: <input type="text" name="editNIF"></br>
                    Email: <input type="email" name="editEmail"></br>
                    </br>
                    <input type="submit" value="Edit"></br>
                    </form>';
                
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $update_user = "UPDATE srsUser SET LoginPassword = '".$_POST['editPassword']."', 
                                            UserName = '".$_POST['editName']."', 
                                            UserAddress = '".$_POST['editAddress']."', 
                                            UserNIF = '".$_POST['editNIF']."', 
                                            UserEmail = '".$_POST['editEmail']."'
                                        WHERE LoginUsername = '".$_POST['userEdit']."'"; 

                        if ($ligacao -> query($update_user) === TRUE) {
                            header("Location: /projetoweb/adminUser.html");
                        } else {
                            echo "Error: " . $ligacao . "<br>" . $ligacao->error;
                        }
                    }
                }
            }
        ?>
    </div>
</body>
</html>