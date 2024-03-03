const { REST } = require('@discordjs/rest');
const { Routes } = require('discord-api-types/v9');
const fs = require('fs');
const path = require('path');
require('dotenv').config();

async function readCommandsFolder() {
  const commands = [];

  const commandsPath = path.join(__dirname, 'commands');
  const commandFiles = fs.readdirSync(commandsPath).filter(file => file.endsWith('.js'));

  for (const file of commandFiles) {
    const filePath = path.join(commandsPath, file);
    const command = require(filePath);

    if ('data' in command && 'execute' in command) {
      commands.push(command.data.toJSON());
    }
  }

  return commands;
}

async function register(client, mode) {
  const commands = await readCommandsFolder();

  const rest = new REST({ version: '9' }).setToken(process.env.BOT_TOKEN);

  try {
    switch (mode) {
      case 'local':
        await rest.put(
          Routes.applicationGuildCommands(client.application.id, process.env.LOCAL_GUILD_ID),
          { body: commands },
        );
        break;
      case 'global':
        await rest.put(
          Routes.applicationCommands(client.application.id),
          { body: commands },
        );
        break;
      default:
        throw new Error("You need to choose a mode to register your commands.");
    }

    console.log('Successfully registered application commands.');
  } catch (error) {
    console.error('Error occurred while registering application commands:', error);
  }
}

async function unregister(client) {
  const rest = new REST({ version: '9' }).setToken(process.env.BOT_TOKEN);

  try {
    await rest.put(
      Routes.applicationGuildCommands(client.application.id, process.env.LOCAL_GUILD_ID),
      { body: [] },
    );

    await rest.put(
      Routes.applicationCommands(client.application.id),
      { body: [] },
    );

    console.log('Successfully unregistered application commands.');
  } catch (error) {
    console.error('Error occurred while unregistering application commands:', error);
  }
}

module.exports = { register, unregister };