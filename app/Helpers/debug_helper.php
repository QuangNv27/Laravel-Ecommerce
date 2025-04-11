<?php

if (!function_exists('ddp')) {
    function ddp(...$vars)
    {
        echo "<pre style='background:#1e1e1e;color:#dcdcdc;padding:15px;border-radius:10px;font-size:14px;line-height:1.5;'>";
        $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        echo "📍 <b>File:</b> {$backtrace['file']}<br>";
        echo "📍 <b>Line:</b> {$backtrace['line']}<br><br>";

        foreach ($vars as $index => $var) {
            echo "<b style='color:#00ff99;'>[Variable #".($index + 1)."]</b>\n";
            print_r($var);
            echo "\n-----------------------------\n";
        }

        echo "</pre>";
        exit;
    }
}
