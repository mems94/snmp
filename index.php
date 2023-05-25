<?php
require 'SnmpClient.php';

//Refresh chaque 60 secondes
header("refresh: 60");

//Requete du client SNMP
$address = '172.20.220.55';
$community = 'public';
$snmpClient = new SnmpClient($address, $community);
$sysName = $snmpClient->getName();
$sysUptime = $snmpClient->getUptime();
$sysStatus = $snmpClient->getstatus();
$allInfo = $snmpClient->getSnmpWalk();

$address2 = '192.168.43.124';
$community2 = 'public';
$sysName2 = $snmpClient->getName();
$sysUptime2 = $snmpClient->getUptime();
$sysStatus2 = $snmpClient->getstatus();
$allInfo2 = $snmpClient->getSnmpWalk();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Superviseur </title>
    <style>
        table, th, td{
            border: 1px solid;
            text-align: center;
        }
    </style>
</head>
<body>
    <form action="" method="post">
    <div style="width: 50%; margin: auto">
        <h2 style="text-align: center">Bienvenu sur MONIT</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
            <tr>
                <th>Serveur surveillé</th>
                <th>Status</th>
                <th>Uptime</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $sysName ?></td>
                    <td>
                        <input type="submit" value=" " style="background-color: 
                        <?= $sysStatus === true ? '#4CAF50' : 'red'  ?> ">
                    </td>
                    <td><?= $sysUptime ?></td>
                </tr>
            </tbody>
        </table>
        
        <p>
            <?php foreach($allInfo as $item): ?>
                <li><?= $item  ?></li>
            <?php endforeach ?>
        </p>
        <button style="margin-top: 15px;" type="submit">Refresh</button>
        </form>
    </div>
</body>
</html>