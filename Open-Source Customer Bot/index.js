const { EmbedBuilder } = require('discord.js');
const { Client, GatewayIntentBits, ActivityType } = require('discord.js');
const { register, unregister } = require('./deploy');
require('dotenv').config();
const client = new Client({ intents: [GatewayIntentBits.Guilds] });
const fs = require('fs');
const path = require('path');

const commandsPath = path.join(__dirname, 'commands');
client.commands = new Map();

const commandFiles = fs.readdirSync(commandsPath).filter(file => file.endsWith('.js'));

for (const file of commandFiles) {
  const command = require(path.join(commandsPath, file));
  client.commands.set(command.data.name, command);
}

client.on('interactionCreate', async (interaction) => {
  if (!interaction.isCommand()) return;

  const command = client.commands.get(interaction.commandName);
  if (!command) return;

  try {
    console.log(`Command: ${interaction.commandName}`);
    console.log(`Server: ${interaction.guild.name} (${interaction.guild.id})`);
    console.log(`User: ${interaction.user.tag} (${interaction.user.id})`);

    const serverId = ''; // Your Server ID, please you know how to get it....
    const server = client.guilds.cache.get(serverId);

    const channelId = ''; // Command logs channel
    const channel = server.channels.cache.get(channelId);

    const embed = new EmbedBuilder()
      .setAuthor({
        url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
        iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
        name: "Elfbar-Security | FiveM Anticheat"
      })
      .setTitle('**__Elfbar-Security__**')
      .setDescription('Command was used')
      .setColor('#00ff00')
      .addFields(
        { name: 'Command:', value: interaction.commandName },
        { name: 'Server:', value: `${interaction.guild.name} (${interaction.guild.id})` },
        { name: 'User:', value: `${interaction.user.tag} (${interaction.user.id})` }
      )
      .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
      .setTimestamp(Date.now())
      .setFooter({
        iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
        text: "Elfbar-Security | FiveM Anticheat"
      });


    channel.send({ embeds: [embed] });

  } catch (err) {
    console.error('Error:', err);
  }

  try {
    await command.execute(interaction);
  } catch (error) {
    console.error(error);
    await interaction.reply({
      content: 'There was an error while executing this command.',
      ephemeral: true
    });
  }
});


client.once('ready', async () => {
  await register(client, 'global');

  const activities = [
    { name: 'https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat', type: ActivityType.Watching },
    { name: `Users: ${client.users.cache.size}`, type: ActivityType.Watching }
  ];

  let activityIndex = 0;
  client.user.setActivity(activities[activityIndex]);

  setInterval(() => {
    activityIndex = (activityIndex + 1) % activities.length;
    client.user.setActivity(activities[activityIndex]);
  }, 30000);
});


client.on('guildCreate', async (guild) => { // Global Bot join logs
  try {
    await register(client, 'global');
    console.log(`Joined a new guild: ${guild.name}`);

    const serverId = ''; // Server ID ....
    const server = client.guilds.cache.get(serverId);

    const channelId = ''; // Logs channel id for guild joins
    const channel = server.channels.cache.get(channelId);
    const embed = new EmbedBuilder()
      .setAuthor({
        url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
        iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
        name: "Elfbar-Security | FiveM Anticheat"
      })
      .setTitle('**__Elfbar-Security__**')
      .setDescription(`New Guild`)
      .setColor('#00ff00')
      .addFields(
        { name: 'Joined a new guild:', value: `${guild.name}` },
      )
      .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
      .setTimestamp(Date.now())
      .setFooter({
        iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
        text: "Elfbar-Security | FiveM Anticheat"
      })

    channel.send({ embeds: [embed] });
  } catch (err) {
    console.error('Error:', err);
  }
});

client.login(process.env.BOT_TOKEN);