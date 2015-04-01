<?php
define(IPM_ROOT_DIR, "/home/" . getenv('USER') . "/hacking/ipm");
define(RVL_REGEX, "/r\d{2}v\d{2}l\d{2}/");

function get_rvls() {
    $rvls = new SplQueue;
    foreach (glob(IPM_ROOT_DIR . "/rvl/*", GLOB_ONLYDIR) as $dir) {
        $rvl = substr($dir, strrpos($dir, "/") + 1);
        if (@preg_match(RVL_REGEX, $rvl)) {
            $rvls->push($rvl);
        }
    }
    return $rvls;
}

function get_current_rvl($path=null) {
    if ($path === null) {
        $path = getcwd();
    }
    $matches = array();
    preg_match(RVL_REGEX, $path, $matches);
    return $matches[0];
}

function get_ipm_base_dir($filepath) {
    return IPM_ROOT_DIR . "/rvl/" . get_current_rvl($filepath);
}

function set_ipm_base_dir($rvl=null) {
    if ($rvl === null) {
        if (!$rvl = get_current_rvl()) {
            $rvls = get_rvls();
            if (!count($rvls)) {
                throw new Exception("No available RVLs");
            }
            fwrite(STDOUT, "Which rvl?" . PHP_EOL);
            $rvls->rewind();
            while ($rvls->valid()) {
                fwrite(STDOUT, "{$rvls->key()}: {$rvls->current()}" . PHP_EOL);
                $rvls->next();
            }
            do {
                do {
                    $selection = fgetc(STDIN);
                } while (trim($selection) == "");

                if ($rvls->offsetExists($selection)) {
                    $rvl = $rvls->offsetGet($selection);
                } else {
                    fwrite(STDOUT, "Invalid selection" . PHP_EOL);
                }
            } while ($rvl === null);
        }
    }
    putenv("IPM_BASE_DIR=" . IPM_ROOT_DIR . "/rvl/$rvl");
    return $rvl;
}
