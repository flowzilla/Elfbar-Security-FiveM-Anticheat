const { EmbedBuilder, PermissionFlagsBits } = require('discord.js');
const { SlashCommandBuilder } = require('@discordjs/builders');
const Discord = require('discord.js');
const mysql = require('mysql2/promise');

const HOST = 'localhost';
const USER = '';
const PASSWORD = '';

module.exports = {
  data: new SlashCommandBuilder()
    .setName('reload')
    .setDescription('Reload the Elfbar-Security Config')
    .setDefaultMemberPermissions(PermissionFlagsBits.everyone),
  async execute(interaction) {
    const playerID = "256";
    try {
      const auth = await mysql.createConnection({
        host: HOST,
        user: USER,
        password: PASSWORD,
        database: 'acpanel',
      });

      const serverID = interaction.guild.id;
      const query = `SELECT server.botAccessRole , server.logsChannel FROM server WHERE server.server_id = "${serverID}";`;

      const [result] = await auth.execute(query);

      const allowedRoleId = result.length > 0 ? result[0].botAccessRole : 0;
      const serverip = result.length > 0 ? result[0].ip : 0;

      const role = interaction.guild.roles.cache.get(allowedRoleId);

      if (interaction.member.roles.cache.has(allowedRoleId)) {
        const [rows, fields] = await auth.execute(`INSERT INTO playerlist (id, reason, ip) VALUES ("${playerID}", "reload", "${serverip}")`);

        const waitEmbed = new EmbedBuilder()
          .setAuthor({
            url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            name: "Elfbar-Security | FiveM Anticheat"
          })
          .setTitle('**Elfbar-Security**')
          .setColor('#00ff00')
          .setDescription(`Please wait while we try to re-load the Anticheat config for your FiveM Server...`)
          .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
          .setTimestamp(Date.now())
          .setFooter({
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            text: "Elfbar-Security | FiveM Anticheat"
          });

        interaction.reply({
          embeds: [waitEmbed],
          ephemeral: false,
        });

        setTimeout(async () => {
          const [selectRows, selectFields] = await auth.execute(`SELECT * FROM playerlist WHERE id = "${playerID}" AND reason = "reload" AND ip = "${serverip}"`);

          if (selectRows.length > 0) {
            const nosuccessEmbed = new EmbedBuilder()
              .setAuthor({
                url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
                iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                name: "Elfbar-Security | FiveM Anticheat"
              })
              .setTitle('**Elfbar-Security**')
              .setColor('#00ff00')
              .setDescription(`Anticheat config was not reloaded`)
              .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
              .setTimestamp(Date.now())
              .setFooter({
                iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                text: "Elfbar-Security | FiveM Anticheat"
              });

            const deleteResult = await auth.query(`DELETE FROM playerlist WHERE id = "${playerID}" AND reason = "reload" AND ip = "${serverip}"`);

            interaction.editReply({
              embeds: [nosuccessEmbed],
              ephemeral: false,
            });
          } else {
            const successEmbed = new EmbedBuilder()
              .setAuthor({
                url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
                iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                name: "Elfbar-Security | FiveM Anticheat"
              })
              .setTitle('**Elfbar-Security**')
              .setColor('#00ff00')
              .setDescription(`Anticheat config was reloaded.`)
              .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
              .setTimestamp(Date.now())
              .setFooter({
                iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                text: "Elfbar-Security | FiveM Anticheat"
              });

            interaction.editReply({
              embeds: [successEmbed],
              ephemeral: false,
            });
          }
        }, 5000);
      } else {
        interaction.reply({
          content: `You don't have the **${role.name}** role to use the bot.`,
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
