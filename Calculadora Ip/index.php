<?php include 'classes/class_ipv4.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">

    <title>Cálculo de máscara de sub-rede IPv4</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }
        .resultado b {
            width: 170px;
            display: inline-block;
        }
        pre {
            font-family: Consolas, monospace;
            display: block;
            clear: both;
            padding: 20px;
            background: #ffffff;
            border: 2px dashed #77bfb7;
        }
    </style>
</head>
<body>
<header>

    <h1>Cálculo de máscara de sub-rede IPv4</h1>
    <p>Esta página tem como intuito mostrar como funciona a classe PHP para Cálculo de máscara de sub-rede IPv4.</p>
    <p>Apenas digitando o IP CIDR</a> (ex. 192.168.0.1/24), a classe fará os cálculos necessários para retornar o endereço IPv4, CIDR,
        Máscara de sub-rede, IP da rede, IP de broadcast da rede, primeiro IP da rede, último IP da rede, número total de IPs da rede,
        e o número de IPs disponíveis para uso.</p>
    <p>Faça um teste:</p>

</header>

<section>
    <h1>Calcular máscara de sub-rede IP</h1>

    <form method="POST">

        <b style="color: #77bfb7">IP/CIDR</b> <small>(Ex.: 192.168.0.1/24)</small> <br>
        <input style="border:1px solid #77bfb7; line-height: 2; padding: 0 5px; width: 200px;" type="text" name="ip" value="<?php echo @$_POST['ip'];?>">
        <input style="border:1px solid #77bfb7; background: #77bfb7; color: #fff; font-weight: 700; cursor: pointer; line-height: 2; padding: 0 5px;" type="submit" value="Calcular">

    </form>

    <?php


    if ( $_SERVER['REQUEST_METHOD'] === 'POST' && ! empty( $_POST['ip'] ) ) {
        $ip = new calc_ipv4( $_POST['ip'] );

        if( $ip->valida_endereco() ) {

            echo '<h2>Configurações de rede para <span style="color: #77bfb7;">' . $_POST['ip'] . '</span> </h2>';
            echo "<pre class='resultado'>";

            echo "<b>Endereço/Rede: </b>" . $ip->endereco_completo() . '<br>';
            echo "<b>Endereço: </b>" . $ip->endereco() . '<br>';
            echo "<b>Prefixo CIDR: </b>/" . $ip->cidr() . '<br>';
            echo "<b>Máscara de sub-rede: </b>" . $ip->mascara() . '<br>';
            echo "<b>IP da Rede: </b>" . $ip->rede() . '/' . $ip->cidr() . '<br>';
            echo "<b>Broadcast da Rede: </b>" . $ip->broadcast() . '<br>';
            echo "<b>Primeiro Host: </b>" . $ip->primeiro_ip() . '<br>';
            echo "<b>Último Host: </b>" . $ip->ultimo_ip() . '<br>';
            echo "<b>Total de IPs:  </b>" . $ip->total_ips() . '<br>';
            echo "<b>Hosts: </b>" . $ip->ips_rede() . '<br>';
            echo "<b>Status da rede: </b>".$ip->statusRede() . '<br>';
            echo "<b>Classe da rede: </b>" . $ip->classe();
            echo "</pre>";
        } else {
            echo 'Endereço IPv4 inválido!';
        }
    }
    ?>
</section>

<footer>
    <p style="font-size: 8pt; text-align: center;">Julia Duarte Solano - 3INFOI3 <a href="http://www.github.com/juliaDsolano/Calculadora_IP/">Github</a></p>
</footer>
</body>
</html>

