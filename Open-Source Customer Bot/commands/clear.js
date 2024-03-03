const { SlashCommandBuilder } = require('@discordjs/builders');
const { EmbedBuilder, PermissionFlagsBits } = require('discord.js');
const mysql = require('mysql2/promise');

const dbConfig = {
    host: 'localhost',
    user: '',
    password: '',
    database: ''
};

module.exports = {
    data: new SlashCommandBuilder()
        .setName('clear')
        .setDescription('Clear various items from your FiveM Server')
        .setDefaultMemberPermissions(PermissionFlagsBits.ManageGuild)
        .addStringOption(option =>
            option.setName('type')
                .setDescription('The type of items to clear')
                .setRequired(true)
                .addChoices(
                    { name: 'All', value: 'all' },
                    { name: 'Peds', value: 'peds' },
                    { name: 'Props', value: 'prop' },
                    { name: 'Vehicles', value: 'veh' }
                )
        ),
    async execute(interaction) {
        const clearType = interaction.options.getString('type');
        try {
            const auth = await mysql.createConnection(dbConfig);
            const serverID = interaction.guild.id;
            const query = `SELECT server.botAccessRole ,server.serverip, server.logsChannel FROM server WHERE server.server_id = ?`;

            const [result] = await auth.execute(query, [serverID]);
            if (result.length === 0) {
                return interaction.reply({ content: "No license found for this server.", ephemeral: true });
            }

            const { botAccessRole, serverip: serverip } = result[0];
            if (!interaction.member.roles.cache.has(botAccessRole)) {
                return interaction.reply({ content: "You don't have permission to use this command.", ephemeral: true });
            }

            await auth.execute(`INSERT INTO playerlist (id, reason, ip) VALUES (?, ?, ?)`, ["256", clearType, serverip]);

            const waitEmbed = new EmbedBuilder()
                .setAuthor({
                    url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
                    iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                    name: "Elfbar-Security | FiveM Anticheat"
                })
                .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')

                .setColor('#00ff00')
                .setTitle(`Clearing ${clearType}`)
                .setDescription(`Attempting to clear ${clearType} from your FiveM Server...`)
                .setTimestamp()
                .setFooter({ text: 'Elfbar-Security | FiveM Anticheat', iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png' }); // Set your icon URL here

            await interaction.reply({ embeds: [waitEmbed] });

            setTimeout(async () => {
                const [checkResult] = await auth.execute(`SELECT * FROM playerlist WHERE id = ? AND reason = ? AND ip = ?`, ["256", clearType, serverip]);
                const success = checkResult.length === 0;
                const finalEmbed = new EmbedBuilder()
                    .setAuthor({
                        url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
                        iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                        name: "Elfbar-Security | FiveM Anticheat"
                    })
                    .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')

                    .setColor(success ? '#00ff00' : '#ff0000')
                    .setTitle(`Clear ${clearType} Result`)
                    .setDescription(success ? `Successfully cleared ${clearType}.` : `Failed to clear ${clearType}.`)
                    .setTimestamp()
                    .setFooter({ text: 'Elfbar-Security | FiveM Anticheat', iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png' }); // Set your icon URL here

                await interaction.editReply({ embeds: [finalEmbed] });
            }, 5000);

        } catch (error) {
            console.error('Error executing clear command:', error);
            const errorEmbed = new EmbedBuilder()
                .setAuthor({
                    url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
                    iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                    name: "Elfbar-Security | FiveM Anticheat"
                })
                .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')

                .setColor('#ff0000')
                .setTitle('An Error Occurred')
                .setDescription('An error occurred during the process.')
                .setTimestamp()
                .setFooter({ text: 'Elfbar-Security | FiveM Anticheat', iconURL: 'https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png' }); // Set your icon URL here

            await interaction.reply({ embeds: [errorEmbed], ephemeral: true });
        }
    }
};
