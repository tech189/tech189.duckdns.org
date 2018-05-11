<html>
    <head>
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        <title>Minecraft Server Information</title>
    </head>
    <body>
        <?php
            ob_start();
            passthru("mcstatus tech189.duckdns.org:25567 status");
            $online = ob_get_clean();
            list($a, $b) = explode("players: ", $online);
            list($c, $d) = explode("No", $b);
            if($d == ""){
                $c = "[No data, the server is likely off]";
            };
            echo("Players online: $c");
        ?>
    </body>
</html>
