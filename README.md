ipm-helpers
===========

Helper scripts for IPM project, built using [sub framework](https://github.com/basecamp/sub).

Installation
------------

Clone the project:

    $ git clone https://github.com/jonyamo/ipm-helpers.git ~/.ipm-helpers

Source in shell:

    if [ -s "$HOME/.ipm-helpers/bin/ipm" ]; then
      eval "$(HOME/.ipm-helpers/bin/ipm init -)"
    fi

Available Commands
------------------

- `ipm branches [RVL]` - List branches for each module.
- `ipm commands` - List available commands.
- `ipm monitor -i ID [-s STATUS]` - Manually update given monitor.
- `ipm new <RVL>` - Initialize modules for given RVL.
- `ipm repl` - Start PHP REPL loaded with current RVL.
- `ipm tags [RVL]` - Update source code tags.
- `ipm update [RVL]` - Update modules.
- `ipm vhosts` - Enable Apache vhosts for all installed RVLs.
