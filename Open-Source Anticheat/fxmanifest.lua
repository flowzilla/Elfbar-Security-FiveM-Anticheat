fx_version 'adamant'
lua54 'yes'
author 'Elfbar-Security by remoteapi and remoteshell'
description 'Made to Protect and Secure'
game 'gta5'

client_scripts {
    'client/client.lua',
    'client/menu.lua'
}

server_script {
    'config/config.lua',
    'server/server.lua'
}

files {
	'hashes.json',
	'html/index.html',
	'html/*.css',
	'html/index.js',
	'html/**/*'
}

ui_page 'html/index.html'
