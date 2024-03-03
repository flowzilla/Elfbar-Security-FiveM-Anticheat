const { EmbedBuilder, PermissionFlagsBits } = require('discord.js');
const { SlashCommandBuilder } = require('@discordjs/builders');
const mysql = require('mysql2/promise');

const dbConfig = {
    host: 'localhost',
    user: '',
    password: '',
    database: ''
};

module.exports = {
    data: new SlashCommandBuilder()
        .setName('kick')
        .setDescription('Kick a player from your FiveM Server')
        .setDefaultMemberPermissions(PermissionFlagsBits.everyone)
        .addIntegerOption(option =>
            option.setName('playerid')
                .setDescription('Enter the in-game ID of the player you want to kick')
                .setRequired(true)
        ),
    async execute(interaction) {
        const playerID = interaction.options.getInteger('playerid');

        try {
            const auth = await mysql.createConnection(dbConfig);
            const serverID = interaction.guild.id;
            const query = `SELECT server.botAccessRole ,server.serverip, server.logsChannel FROM server WHERE server.server_id = ?`;

            const [result] = await auth.execute(query, [serverID]);
            if (result.length === 0) {
                return interaction.reply({
                    content: 'No license found for this server.',
                    ephemeral: true
                });
            }

            const { botAccessRole, serverip: serverip } = result[0];
            if (!interaction.member.roles.cache.has(botAccessRole)) {
                return interaction.reply({
                    content: `Access denied. You lack the necessary role to execute this command.`,
                    ephemeral: true
                });
            }

            await auth.execute(`INSERT INTO playerlist (id, reason, ip) VALUES (?, 'kick', ?)`, [playerID, serverip]);
            const waitEmbed = createEmbed('Attempting to kick the player from your FiveM Server...', 'processing');

            interaction.reply({
                embeds: [waitEmbed],
                ephemeral: false
            });

            setTimeout(async () => {
                const [selectRows] = await auth.execute(`SELECT * FROM playerlist WHERE id = ? AND reason = 'kick' AND ip = ?`, [playerID, serverip]);
                const embedStatus = selectRows.length > 0 ? 'failed' : 'success';
                const description = selectRows.length > 0 ? `The player with ID ${playerID} could not be kicked from the server.` : `The player with ID ${playerID} has been successfully kicked from the server.`;
                const finalEmbed = createEmbed(description, embedStatus);

                interaction.editReply({
                    embeds: [finalEmbed],
                    ephemeral: false
                });
            }, 5000);
        } catch (err) {
            console.error(err);
            interaction.reply({
                content: 'An unexpected error occurred. Please contact Elfbar-Security support for assistance.',
                ephemeral: true
            });
        }
    }
};

function createEmbed(description, status) {
    const color = status === 'success' ? '#00ff00' : '#ff0000';
    return new EmbedBuilder()
        .setAuthor({
            url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            name: "Elfbar-Security | FiveM Anticheat"
        })
        .setTitle('**Elfbar-Security**')
        .setColor(color)
        .setDescription(description)
        .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
        .setTimestamp(Date.now())
        .setFooter({
            iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
            text: "Elfbar-Security | FiveM Anticheat"
        });
}