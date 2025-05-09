<html>
<head>
    <meta charset="UTF-8">
    <script src="/projetoweb/Login/lang.js"></script>

    <link rel="stylesheet" href="/projetoweb/CSS/styleTest1.css">
    <script src="/projetoweb/CSS/theme.js" defer></script>
    <title>Register Version</title>
</head>
<body>
    <div class="form">
        <?php
            session_start();

            function getVersion($ligacao, $versionName, $compID){
                if (!isset($_SESSION['UserID'])) {
                    header("Location: Login/login.html");
                    exit();
                }

                $consulta_version = "SELECT VersionName FROM srsCompVersion WHERE VersionName = '" . $versionName . "' AND VersionCompID = " . $compID;
                $resultado_version = mysqli_query($ligacao, $consulta_version);

                if($resultado_version->num_rows > 0){
                    $row = $resultado_version->fetch_assoc();
                    return $row["VersionName"];
                } else {
                    return -1;
                }
            }

            $servidor = 'localhost';
            $user = 'root';
            $dbname = 'srsWeb';

            $ligacao = mysqli_connect($servidor, $user) or die("Sem ligação");
            mysqli_select_db($ligacao, $dbname) or die("Sem DB");

            $versionName = $_POST['newVersionName'];
            $compID = $_POST['compID'];

            $compName = getVersion($ligacao, $versionName, $compID);

            if($compName != -1){
                echo "Version '$versionName' already registered.</br>";
                echo '</br><a href="registerVersion.html"><input type="button" value="Return"></a>';
            } else {
                $register_version = "INSERT INTO srsCompVersion(VersionName, VersionDate, VersionCode, VersionCompID) VALUES('" . $_POST['newVersionName'] . "','" . $_POST['newVersionDate'] . "','" . $_POST['newVersionCode'] . "','" . $compID . "')";
                if ($ligacao->query($register_version) === TRUE) {
                    header("Location: /projetoweb/devUser.html");
                } else {
                    echo "Erro: " . $register_version . "<br>" . $ligacao->error;
                }
            }
        ?>
    </div>
</body>
</html>

