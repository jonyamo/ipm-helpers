basedir="$HOME/hacking/ipm"
ipmhost=ipm.verizon.com
ipmuser="$USER"
ipmcookies="$XDG_CACHE_HOME/ipm/cookies"

if [ -t 1 ]; then
  ncolors=$(tput colors)
  if test -n "$ncolors" && test $ncolors -ge 8; then
    bold="$(tput bold)"
    underline="$(tput smul)"
    standout="$(tput smso)"
    reset="$(tput sgr0)"
    black="$(tput setaf 0)"
    red="$(tput setaf 1)"
    green="$(tput setaf 2)"
    yellow="$(tput setaf 3)"
    blue="$(tput setaf 4)"
    magenta="$(tput setaf 5)"
    cyan="$(tput setaf 6)"
    white="$(tput setaf 7)"
  fi
fi

wrn() {
  printf "${yellow}[WARN]${reset} $1\n" >&2
}

err() {
  printf "${red}[ERROR]${reset} $1\n" >&2
}

fatal() {
    err "$1"
    exit 1
}

get_rvls() {
  local sel="${1:-all}"
  local rvls; typeset -a rvls
  if [[ "$sel" == "all" ]]; then
    for rvl in "$basedir"/rvl/*; do
      [[ -d "$rvl" ]] || continue
      rvls=("${rvls[@]:+${rvls[@]}}" "${rvl##*/}")
    done
  elif [[ -d "$basedir/rvl/$sel" ]]; then
    rvls=("$sel")
  fi
  echo ${rvls[@]:-}
}

get_port() {
  echo "$1" | sed 's/[a-z]//g' | sed 's/01//'
}

validate_rvl() {
    if [[ "$1" =~ r[0-9][0-9]v[0-9][0-9]l[0-9][0-9] ]]
    then
        return 0
    else
        return 1
    fi
}
