const { EmbedBuilder } = require('discord.js')
const { MessageEmbed, MessageButton, PermissionFlagsBits } = require('discord.js');
const { SlashCommandBuilder } = require('@discordjs/builders');
const Discord = require('discord.js');
const mysql = require('mysql2/promise');
const HOST = 'localhost';
const USER = '';
const PASSWORD = '';


module.exports = {
  data: new SlashCommandBuilder()
    .setName('setup')
    .setDescription('Setup the Server ID for Ingame Adminbypass and the Role over')
    .setDefaultMemberPermissions(PermissionFlagsBits.BanMembers)
    .addRoleOption(option =>
      option
        .setName('bypassroleid')
        .setDescription('The ID of the ingame bypass role')
        .setRequired(true)
    )
    .addRoleOption(option =>
      option
        .setName('usebotroleid')
        .setDescription('The role ID that may use the bot')
        .setRequired(true)
    )
    .addChannelOption(option =>
      option
        .setName('logchannel')
        .setDescription('Select the log channel')
        .setRequired(true)
    ),

  async execute(interaction) {
    const role = interaction.options.getRole('bypassroleid');
    const role2 = interaction.options.getRole('usebotroleid');
    const logChannelId = interaction.options.getChannel('logchannel').id;
    const logChannel = interaction.guild.channels.cache.get(logChannelId);

    let roleID = role.id;
    let roleID2 = role2.id;

    try {
      const connection = await mysql.createConnection({
        host: HOST,
        user: USER,
        password: PASSWORD,
        database: 'panel',
      });

      const query = `SELECT server.serverip, redem_license.expires, redem_license.license
        FROM redem_license
        JOIN users ON users.userid = redem_license.userid
        JOIN users_server ON users_server.userid = users.userid
        JOIN server ON server.serverid = users_server.serverid
        WHERE users.discord = ?`;

      const [rows] = await connection.execute(query, [interaction.user.id]);

      const serverIP = rows.length > 0 ? rows[0].serverip : 0;
      const serverID = interaction.guild.id;

      roleID = roleID.replace(/<@&|>/g, '');
      roleID2 = roleID2.replace(/<@&|>/g, '');

      const updateQuery = `
        UPDATE server
        SET server.server_id = ?, server.role_id = ?, server.botAccessRole = ?, server.logsChannel = ?
        WHERE server.serverip = ?
        `;

      const [result] = await connection.execute(updateQuery, [serverID, roleID, roleID2, logChannelId, serverIP]);

      const role = interaction.guild.roles.cache.get(roleID);
      const role2 = interaction.guild.roles.cache.get(roleID2);

      if (result.affectedRows === 1) {
        console.log('Setup success:', {
          serverID,
          bypassRoleName: role.name,
          botAccessRoleName: role2.name,
          logsChannelName: logChannel.name,
        });

        const successEmbed = createSuccessEmbed(serverID, role.name, role2.name, logChannel.name);

        const logsEmbed = createLogsEmbed(logChannel.name, interaction.member.id);
        logChannel.send({ embeds: [logsEmbed] });

        await interaction.reply({ embeds: [successEmbed] });
      } else {
        console.error('Setup failed - Database query affectedRows:', result.affectedRows);

        const errorEmbed = createErrorEmbed('#1', 'Please contact the Elfbar-Security Support');
        await interaction.reply({ embeds: [errorEmbed] });
      }

      connection.end();
    } catch (error) {
      console.error('Setup failed - Exception:', error);

      const errorEmbed = createErrorEmbed('#2', 'Please ensure that you have a valid Elfbar-Security license!');
      await interaction.reply({ embeds: [errorEmbed] });
    }
  },
};

function createSuccessEmbed(serverID, bypassRoleName, botAccessRoleName, logChannelName) {
  return new EmbedBuilder()
    .setAuthor({
      url: 'https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat',
      iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png',
      name: 'Elfbar-Security | FiveM Anticheat',
    })
    .setTitle('**__Elfbar-Security__**')
    .setColor('#00ff00')
    .setDescription('Admin bypass and Bot Access Role were set successfully')
    .addFields(
      { name: 'Server ID:', value: `${serverID}` },
      { name: 'Bypass Role Name:', value: `${bypassRoleName}` },
      { name: 'Bot Access Role Name:', value: `${botAccessRoleName}` },
      { name: 'Logs Channel Name:', value: `${logChannelName}` },
    )
    .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
    .setTimestamp(Date.now())
    .setFooter({
      iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png',
      text: 'Elfbar-Security | FiveM Anticheat',
    });
}

function createLogsEmbed(logChannelName, memberID) {
  return new EmbedBuilder()
    .setAuthor({
      url: 'https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat',
      iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png',
      name: 'Elfbar-Security | FiveM Anticheat',
    })
    .setTitle('**__Elfbar-Security__**')
    .setColor('#00ff00')
    .setDescription('Bot Logs were set successfully')
    .addFields(
      { name: 'Channel Name:', value: `${logChannelName}` },
      { name: 'Command was used by:', value: `<@!${memberID}>` },
    )
    .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
    .setTimestamp(Date.now())
    .setFooter({
      iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png',
      text: 'Elfbar-Security | FiveM Anticheat',
    });
}

function createErrorEmbed(errorTitle, errorDescription) {
  return new EmbedBuilder()
    .setAuthor({
      url: 'https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat',
      iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png',
      name: 'Elfbar-Security | FiveM Anticheat',
    })
    .setTitle('**__Elfbar-Security__**')
    .setColor('#ff0000')
    .setDescription('An error occurred during the setup process')
    .addFields(
      { name: 'Error Title:', value: `${errorTitle}` },
      { name: 'Error Description:', value: `${errorDescription}` },
    )
    .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
    .setTimestamp(Date.now())
    .setFooter({
      iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png',
      text: 'Elfbar-Security | FiveM Anticheat',
    });
}