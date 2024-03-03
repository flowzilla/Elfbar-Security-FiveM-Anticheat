fx_version 'adamant'
lua54 'yes'
author 'Elfbar-Security by ricoo1812 and remoteshell'
description 'Made to Protect and Secure'
game 'gta5'

client_scripts {
    'client/client.lua',
    'client/menu.lua'

}

server_script {
    'config/Config.lua',
    'server/server.lua'
}

files {
	'hashes.json',
	'stream/*.gfx',
	'html/index.html',
	'html/reset.css',
	'html/*.css',
	'html/index.js',
	'html/**/*',
}

ui_page 'html/index.html'