<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Логи</title>
    <style>
        .table {
            position: absolute;
            border-spacing: 0;
            border-collapse: collapse;
            width: 70%;
        }

        td,
        th {
            padding: 20px;
            border: 1px solid coral;
        }

        tr:nth-child(odd) {
            background-color: lightgray;
        }
    </style>

</head>

<body>
    <?php
    $db_server = '172.28.208.1';
    $db_port = 3306;
    $db_name = 'geekbrains_hw8';
    $db_user = 'jane';
    $db_password = '12345';

    try {
        $db = new PDO(
            "mysql:host=$db_server;port=$db_port;dbname=$db_name",
            $db_user,
            $db_password,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT id, time, duration, ip, url, method, input FROM logs';
        $statement = $db->prepare($sql);

        $statement->execute();

        $result_array = $statement->fetchAll();

        echo "<div class=\"table\">";
        echo "<table><tr><th>id</th><th>time</th><th>duration</th><th>ip</th><th>url</th><th>method</th><th>input</th></tr>";
        foreach ($result_array as $result_row) {
            echo "<tr>";
            echo "<td align=\"center\">" . $result_row['id'] . "</td>";
            echo "<td align=\"center\">" . $result_row['time'] . "</td>";
            echo "<td align=\"center\">" . $result_row['duration'] . "</td>";
            echo "<td align=\"center\">" . $result_row['ip'] . "</td>";
            echo "<td align=\"center\">" . $result_row['url'] . "</td>";
            echo "<td align=\"center\">" . $result_row['method'] . "</td>";
            echo "<td align=\"center\">" . $result_row['input'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    } catch (PDOException $e) {
        echo "Ошибка при создании записи в базе данных: " . $e->getMessage();
    }
    $db = null;
    ?>
</body>

</html>