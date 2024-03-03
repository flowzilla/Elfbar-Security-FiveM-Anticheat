const { Client, EmbedBuilder } = require('discord.js');
const { SlashCommandBuilder } = require('@discordjs/builders');
const mysql = require('mysql2/promise');

const HOST = 'localhost';
const USER = '';
const PASSWORD = '';

module.exports = {
  data: new SlashCommandBuilder()
    .setName('stats')
    .setDescription('Your Elfbar-Securitys Server Stats'),
  async execute(interaction) {
    try {
      const auth = await mysql.createConnection({
        host: HOST,
        user: USER,
        password: PASSWORD,
        database: 'counter',
      });

      const auth2 = await mysql.createConnection({
        host: HOST,
        user: USER,
        password: PASSWORD,
        database: 'panel',
      });

      const serverID = interaction.guild.id;
      const query = `SELECT server.botAccessRole , server.logsChannel FROM server WHERE server.server_id = "${serverID}"`;

      const [result] = await auth2.execute(query);

      const logChannelId = result.length > 0 ? result[0].logsChannel : 0;
      const logChannel = interaction.guild.channels.cache.get(logChannelId);


      const allowedRoleId = result.length > 0 ? result[0].botAccessRole : 0;

      const role = interaction.guild.roles.cache.get(allowedRoleId);

      const [rows, fields] = await auth2.execute(
        `SELECT redem_license.license FROM server JOIN redem_license USING(serverid) WHERE server.server_id = "${serverID}"`
      );

      const license = rows.length > 0 ? rows[0].license : 0;

      const queryAuths = `SELECT count(*) AS count FROM totaljoins WHERE license = "${license}"`;
      const queryJoins = `SELECT count(*) AS count FROM totalbans WHERE license = "${license}"`;
      const queryBans = `SELECT count(*) AS count FROM totalauths WHERE license = "${license}"`;

      const [auths] = await auth.execute(queryAuths);
      const [joins] = await auth.execute(queryJoins);
      const [bans] = await auth.execute(queryBans);

      if (interaction.member.roles.cache.has(allowedRoleId)) {

        const embed = new EmbedBuilder()
          .setColor('#0099ff')
          .setTitle('Stats')
          .setAuthor({
            url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            name: "Elfbar-Security | FiveM Anticheat"
          })
          .setDescription('Overview of your server activities while Elfbar-Security was active')
          .addFields(
            { name: 'Total Player Joins:', value: auths[0].count.toString() },
            { name: 'Total Authentications:', value: bans[0].count.toString() },
            { name: 'Total Bans:', value: joins[0].count.toString() },
          )
          .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
          .setTimestamp()
          .setFooter({
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            text: "Elfbar-Security | FiveM Anticheat"
          });

        await interaction.reply({ embeds: [embed] });

        const logsembed = new EmbedBuilder()
          .setAuthor({
            url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            name: "ricoo1812"
          })
          .setTitle('**__Elfbar-Security__**')
          .setColor('#00ff00')
          .setDescription(`/stats command was used`)
          .addFields(
            { name: 'Command was used by:', value: `<@!${interaction.member.id}>` },
          )
          .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
          .setTimestamp(Date.now())
          .setFooter({
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            text: "Elfbar-Security | FiveM Anticheat"
          })

        logChannel.send({ embeds: [logsembed] });

      }
    } catch (err) {
      console.error(err);
      await interaction.reply({
        content: 'Be sure that you have started **/setup**, if you still get the error contact Elfbar-Security support.',
        ephemeral: true,
      });
    }
  },
};