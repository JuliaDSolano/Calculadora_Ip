<?php include 'classes/class_calc.php'; ?>
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
        font-family: consolas, monospace;
        display: block;
        clear: both;
        padding: 20px;
        background: #90e7c9;
        border: 2px dashed #77bfb7;
        }
    }
    </style>
</head>
<body>
    <header>
        <h1>Cálculo de máscara de sub-rede IP</h1>
        <p>Atividade de programação e redes</p>
        <p>Esta página tem como intuito mostrar como funciona a classe PHP para Cálculo de <a href="http://pt.wikipedia.org/wiki/M%C3%A1scara_de_rede">máscara de sub-rede IPv4</a>.</p>
        <p>Apenas digitando o <a href="http://pt.wikipedia.org/wiki/Endere%C3%A7o_IP">IP</a>/<a href="http://pt.wikipedia.org/wiki/CIDR">CIDR</a> (ex. 192.168.0.1/24), a classe fará os cálculos necessários para retornar o endereço IPv4, CIDR,
            Máscara de sub-rede, IP da rede, IP de <a href="http://pt.wikipedia.org/wiki/Endere%C3%A7o_de_broadcast">broadcast da rede</a>, primeiro IP da rede, último IP da rede, número total de IPs da rede,
            e o número de IPs disponíveis para uso.</p>
        <p>Faça um teste:</p>
    </header>
    
    <section>
        <h1>Calcular máscara de sub-rede IP</h1>
        <form method="POST">

        <b style=" color: #77bfb7;">IP</b> <small>(Ex.: 192.168.0.1/24)</small>
        <br>
        <input style="border:1px solid #77bfb7; line-height: 2; padding: 0 5px;border:1px solid #77bfb7; width: 200px;" type="text" name="ip" value="<?php echo @$_POST['ip'];?>">
        <input style=" border:1px solid #77bfb7; line-height: 2;  padding: 0 5px; background: #77bfb7;color: #fff;font-weight: 700;cursor: pointer;" type="submit" value="Calcular">

            <?php
            // Inclui a classe
            include 'classes/class_calc.php';

            // Cria o objeto da classe já recebendo o IP/CIDR
            $ip = new calc_ip('192.168.0.5/29');

            // Checa se o IP é válido
            if( $ip->valida_endereco() ) {
                // Utiliza os métodos disponíveis
                echo "<b>Endereço/Rede: </b>" . $ip->endereco_completo() . '<br>';
                echo "<b>Endereço: </b>" . $ip->endereco() . '<br>';


            } else {
                echo 'Endereço IP inválido!';
            }
            ?>
    </form>
    </section>
   
   <footer> 
        <p style="font-size: 8pt; text-align: center; color: #9d9d9d">Criado por <a href="http://www.github.com/juliaDsolano/Calculadora_Ip">Julia Solano</a></p>
   </footer>
</body>
</html>

