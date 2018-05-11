<html>
    <head>
        <meta http-equiv="refresh" content="10" />
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        <title>Raspberry Pi 3 Information</title>
    </head>
    <body>
        <?php

        echo("TESTING TESTING ONE TWO THREE (this page updates every ten seconds)");

        echo("<br />");
        date_default_timezone_set('Europe/London');
        echo("The current date is ");
        echo date("d/m/Y");
        echo(" and the time is ");
        echo date("H:i:s!");

        #echo(shell_exec("/opt/vc/bin/vcgencmd measure_temp"));

        echo("<br />");

        $rawtemp = shell_exec("cat /sys/class/thermal/thermal_zone0/temp");
        $temp = substr($rawtemp, 0, -4);
        $tempdecimal = substr($rawtemp, 2);
        echo("The current temperature is $temp.$tempdecimal &deg;C");

        $str   = @file_get_contents('/proc/uptime');
        $num   = floatval($str);
        $secs  = fmod($num, 60); $num = (int)($num / 60);
        $mins  = $num % 60;      $num = (int)($num / 60);
        $hours = $num % 24;      $num = (int)($num / 24);
        $days  = $num;

        echo("<br />");

        #echo("Up for ");
        echo("The system has been up for $days day(s), $hours hour(s), and $mins minute(s)!");

        echo("<br />");
        $disk1 = shell_exec("du -sh /var/www/html/");
        list($c, $d) = explode("/", $disk1);
        echo("Disk space used by web server: $c");

        echo("<br />");
        $disk2 = shell_exec("df -hT /");
        list($e, $f) = explode("%", $disk2);
        list($g, $h) = explode("G ", $f);
        echo("Disk space used on microSD card: $h/13G");

        echo("<br />");
        #$log = shell_exec("sed -n '$=' /var/log/apache2/access.log");
        $uptime = shell_exec("uptime");
        list($a, $b) = explode("e:", $uptime);
        echo ("The load average is $b (averaged over 1, 5, and 15 minutes).");
        #phpinfo();
        
        echo("<br />");

        ob_start();
        passthru("mcstatus tech189.duckdns.org:25567 status");
        $online = ob_get_clean();
        list($q, $r) = explode("players: ", $online);
        list($s, $t) = explode("No", $r);
        if($t == ""){
            $s = "[No data, the server is likely off]";
        };
        echo("Players online the Tekkit server: $s");
        
        ?>
    </body>
</html>