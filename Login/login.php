<?php
    session_start();
    
    $servidor = 'localhost';
    $user = 'root';
    $dbname = 'srsWeb';

	$ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
	mysqli_select_db($ligacao, $dbname) or die("Sem DB");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($ligacao, $_POST['username']);
    $password = mysqli_real_escape_string($ligacao, $_POST['password']);

    $consulta_login = "SELECT * FROM srsUser WHERE LoginUsername = '$username' AND LoginPassword = '$password'";
    $resultado_login = mysqli_query($ligacao, $consulta_login);


    if (mysqli_num_rows($resultado_login) === 1) {
        $userRow = mysqli_fetch_assoc($resultado_login);
        $userID = $userRow['UserID'];
        $_SESSION['LoginUsername'] = $username;
        $_SESSION['LoginPassword'] = $password;
        $_SESSION['UserID'] = $userID;
        
        
        $consulta_role = "SELECT RoleName FROM srsUserRole WHERE RoleID = " . $userRow['UserRoleID'];
        
        $resultado_role = mysqli_query($ligacao, $consulta_role);
        $role = mysqli_fetch_assoc($resultado_role);
        $_SESSION['RoleName'] = $role['RoleName'];

        $consultaUsername = "SELECT UserName FROM srsUser WHERE UserID = " . $userID;
        $resultadoUsername = mysqli_query($ligacao , $consultaUsername);
        $userNameLog = mysqli_fetch_assoc($resultadoUsername);
        $_SESSION['UserName'] = $userNameLog['UserName'];


        if ($_SESSION['RoleName'] == 'admin') {
            header("Location: /projetoweb/adminUser.html");
            exit();
        } else if ($_SESSION['RoleName'] == 'developer') {
            header("Location: /projetoweb/devUser.html");
            exit();
        } else {
            header("Location: login.html");
        }
    } else {
        header("Location: login.html");
    }
?>