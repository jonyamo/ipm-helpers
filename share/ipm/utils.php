<?php
function get_current_rvl() {
    $matches = array();
    preg_match('/r\d{2}v\d{2}l\d{2}/', getcwd(), $matches);
    return $matches[0];
}

function set_ipm_base_dir() {
    if (!$rvl = get_current_rvl()) {
        fwrite(STDOUT, "Which rvl? ");
        $rvl = read_stdin();
    }
    return putenv('IPM_BASE_DIR='
        .  getenv('HOME') . "/hacking/ipm/rvl/{$rvl}");
}

function read_stdin() {
    return chop(fgets(STDIN));
}
