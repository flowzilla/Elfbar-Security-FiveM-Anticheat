const { EmbedBuilder, PermissionFlagsBits } = require('discord.js');
const { SlashCommandBuilder } = require('@discordjs/builders');
const Discord = require('discord.js');
const mysql = require('mysql2/promise');

const HOST = 'localhost';
const USER = '';
const PASSWORD = '';

module.exports = {
  data: new SlashCommandBuilder()
    .setName('check-ban')
    .setDescription('Check ban data of a player that is banned from the Anticheat')
    .setDefaultMemberPermissions(PermissionFlagsBits.everyone)
    .addStringOption((option) =>
      option
        .setName('banid')
        .setDescription('The ID of the Player that your want to check')
        .setRequired(true)
    ),
  async execute(interaction) {
    const banID = interaction.options.getString('banid');
    try {
      const auth = await mysql.createConnection({
        host: HOST,
        user: USER,
        password: PASSWORD,
        database: 'acpanel',
      });

      const serverID = interaction.guild.id;
      const query = `SELECT server.botAccessRole , server.logsChannel FROM server WHERE server.server_id = "${serverID}"`;

      const [result] = await auth.execute(query);

      const logChannelId = result.length > 0 ? result[0].logsChannel : 0;
      const logChannel = interaction.guild.channels.cache.get(logChannelId);

      const allowedRoleId = result.length > 0 ? result[0].botAccessRole : 0;

      const role = interaction.guild.roles.cache.get(allowedRoleId);

      if (interaction.member.roles.cache.has(allowedRoleId)) {
        const [rows, fields] = await auth.execute(
          `SELECT redem_license.license FROM server JOIN redem_license USING(serverid) WHERE server.server_id = "${serverID}"`
        );

        const license = rows.length > 0 ? rows[0].license : 0;

        const [banResult, _] = await auth.query(
          `SELECT * FROM \`serverbans\`.\`${license}\` WHERE \`${license}\`.id = '${banID}'`
        );

        if (banResult.length === 0) {

          const errorEmbed = new EmbedBuilder()
            .setAuthor({
              url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
              iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
              name: "Elfbar-Security | FiveM Anticheat"
            })
            .setTitle('**Ban ID was not found**')
            .setColor('#FF0000')
            .setDescription(`The ban with ID **${banID}** was not found.`)
            .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
            .setTimestamp(Date.now())
            .setFooter({
              iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
              text: "Elfbar-Security | FiveM Anticheat"
            })


          const logsembed = new EmbedBuilder()
            .setAuthor({
              url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
              iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
              name: "ricoo1812"
            })
            .setTitle('**__Elfbar-Security__**')
            .setColor('#FF0000')
            .setDescription(`/check-ban command was used`)
            .addFields(
              { name: 'Ban ID:', value: `${banID}` },
              { name: 'Status:', value: `Failed - Ban ID was not found` },
              { name: 'Command was used by:', value: `<@!${interaction.member.id}>` },
            )
            .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
            .setTimestamp(Date.now())
            .setFooter({
              iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
              text: "Elfbar-Security | FiveM Anticheat"
            })

          logChannel.send({ embeds: [logsembed] });

          return interaction.reply({
            embeds: [errorEmbed],
            ephemeral: true,
          });

        }

        const [rows2] = await auth.execute(
          `SELECT * FROM serverbans.\`${license}\` WHERE id = ${banID}`
        );

        const banimage = rows2.length > 0 ? rows2[0].screen : 0;
        const banreason = rows2.length > 0 ? rows2[0].reason : 0;
        const banname = rows2.length > 0 ? rows2[0].name : 0;
        const bandiscord = rows2.length > 0 ? rows2[0].discord : 0;

        const successEmbed = new EmbedBuilder()
          .setAuthor({
            url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            name: "Elfbar-Security | FiveM Anticheat"
          })
          .setTitle('**Ban Informations**')
          .setColor('#00ff00')
          .setDescription(`BanID **${banID}** was found, see the Informations below`)
          .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
          .addFields(
            { name: 'BanID:', value: `${banID}` },
            { name: 'Username:', value: `${banname}` },
            { name: 'Discord:', value: `${bandiscord}` },
            { name: 'Reason:', value: `${banreason}` },
          )
          .setImage(`${banimage}`)
          .setTimestamp(Date.now())
          .setFooter({
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            text: "Elfbar-Security | FiveM Anticheat"
          })

        const logsembed = new EmbedBuilder()
          .setAuthor({
            url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            name: "ricoo1812"
          })
          .setTitle('**__Elfbar-Security__**')
          .setColor('#00ff00')
          .setDescription(`/check-ban command was used`)
          .addFields(
            { name: 'BanID:', value: `${banID}` },
            { name: 'Username:', value: `${banname}` },
            { name: 'Banned User Discord:', value: `${bandiscord}` },
            { name: 'Reason:', value: `${banreason}` },
            { name: 'Status:', value: `Success - Ban ID was found` },
            { name: 'Command was used by:', value: `<@!${interaction.member.id}>` },
          )
          .setImage(`${banimage}`)
          .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
          .setTimestamp(Date.now())
          .setFooter({
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            text: "Elfbar-Security | FiveM Anticheat"
          })

        logChannel.send({ embeds: [logsembed] });

        interaction.reply({
          embeds: [successEmbed],
          ephemeral: false,
        });
      } else {

        const logsembed = new EmbedBuilder()
          .setAuthor({
            url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            name: "ricoo1812"
          })
          .setTitle('**__Elfbar-Security__**')
          .setColor('#FF0000')
          .setDescription(`/check-ban command was used`)
          .addFields(
            { name: 'Ban ID:', value: `${banID}` },
            { name: 'Status:', value: `Failed - User dont have the Role **${role.name}**` },
            { name: 'Command was used by:', value: `<@!${interaction.member.id}>` },
          )
          .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
          .setTimestamp(Date.now())
          .setFooter({
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            text: "Elfbar-Security | FiveM Anticheat"
          })

        logChannel.send({ embeds: [logsembed] });

        interaction.reply({
          content: `You dont have the **${role.name}** role to use the bot.`,
          ephemeral: true,
        });
      }
    } catch (err) {
      console.log(err);
      return interaction.reply({
        content: 'Be sure that you have started **/setup**, if you still get the error contact Elfbar-Security support.',
        ephemeral: true,
      });
    }
  },
};