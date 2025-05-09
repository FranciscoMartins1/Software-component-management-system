<html>
<head>
    <meta charset="UTF-8">
    <script src="/projetoweb/Login/lang.js"></script>

	<script src="/projetoweb/CSS/theme.js" defer></script>
    <link rel="stylesheet" href="/projetoweb/CSS/styleTest1.css">
    <title>Register Component</title>
</head>
<body>
    <div class='form'>
        <?php
            session_start();

            function getComponent($ligacao, $compName){
                if (!isset($_SESSION['UserID'])) {
                    header("Location: Login/login.html");
                    exit();
                }

                $consulta_component = "SELECT CompName FROM srsComp WHERE CompName = '" . $compName . "'";
                $resultado_component = mysqli_query($ligacao, $consulta_component);

                if($resultado_component->num_rows > 0){
                    $row = $resultado_component->fetch_assoc();
                    return $row["CompName"];
                } else {
                    return -1;
                }
            }

            $servidor = 'localhost';
            $user = 'root';
            $dbname = 'srsWeb';

            $ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
            mysqli_select_db($ligacao, $dbname) or die("Sem DB");

            $compRegister = $_POST['newCompName'];
            $compName = getComponent($ligacao, $compRegister);

            if($compName != -1){
                echo "Component '$compRegister' already registered.</br>";
                echo '</br><a href="/projetoweb/devUser.html"><input type="button" value="Back to menu"></a>';
            } else {
                $register_component = "INSERT INTO srsComp(CompName, CompDescr, CompDate, CompCode, CompUserID)
                                    VALUES('".$_POST['newCompName']."','".$_POST['newCompDescr']."','".$_POST['newCompDate']."','".$_POST['newCompCode']."','".$_SESSION['UserID']."')";
                if ($ligacao->query($register_component) === TRUE) {
                    header("Location: /projetoweb/devUser.html");
                } else {
                    echo "Error: " . $register_component . "<br>" . $ligacao->error;
                }
            }
        ?>
    </div>
</body>
</html>