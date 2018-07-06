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
        font-family: Consolas, monospace;
        display: block;
        clear: both;
        padding: 20px;
        background: #eee;
        border: 2px dashed #999;
    }
    </style>
</head>
<body>
    <header>

    </header>
    
    <section>
        <h1>Calcular máscara de sub-rede IPv4</h1>
    
    <form method="POST">
        <b style="color: green">IP/CIDR</b> <small>(Ex.: 192.168.0.1/24)</small> <br> 
        <input style="border:1px solid green; line-height: 2; padding: 0 5px; width: 200px;" type="text" name="ip" value="<?php echo @$_POST['ip'];?>">
        <input style="border:1px solid green; background: green; color: #fff; font-weight: 700; cursor: pointer; line-height: 2; padding: 0 5px;" type="submit" value="Calcular">
    </form>
   

   </section>
   
   <footer> 
        <p style="font-size: 8pt; text-align: center;">Criado por <a href="http://www.github.com/juliaDsolano/">Julia Solano</a></p>
   </footer>
</body>
</html>

