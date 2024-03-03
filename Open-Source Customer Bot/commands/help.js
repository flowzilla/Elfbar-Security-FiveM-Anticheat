const { SlashCommandBuilder } = require('@discordjs/builders');
const { EmbedBuilder } = require('discord.js');

module.exports = {
    data: new SlashCommandBuilder()
        .setName('help')
        .setDescription('List all available commands'),
    async execute(interaction) {
        const helpEmbed = new EmbedBuilder()
            .setAuthor({
                url: `https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat`,
                iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                name: "Elfbar-Security | FiveM Anticheat"
            })
            .setTitle('**Available Commands**')
            .setColor('#00ff00')
            .setDescription(`For support or inquiries, please open a ticket at [Elfbar-Security Support](https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat).`)
            .addFields(
                { name: 'Setup', value: 'Configure Role ID for Ingame Adminbypass and more.' },
                { name: 'Reload', value: 'Reload the config without script or server restart.' },
                { name: 'Clearall', value: 'Remove all Peds, Vehicles, Props from the server.' },
                { name: 'Clearpeds', value: 'Remove all Peds from the server.' },
                { name: 'Clearvehicles', value: 'Remove all Vehicles from the server.' },
                { name: 'Clearprops', value: 'Remove all Props from the server.' },
                { name: 'Stats', value: 'View your Elfbar-Security stats.' },
                { name: 'Restart', value: 'Restart the FiveM server.' },
                { name: 'Ban', value: 'Ban a player using their in-game ID.' },
                { name: 'Kick', value: 'Kick a player from your FiveM server.' },
                { name: 'check-ban', value: 'Check the ban details of a player.' },
                { name: 'Unban', value: 'Unban a user from Elfbar-Security.' }
            )
            .setThumbnail('https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png')
            .setTimestamp()
            .setFooter({
                iconURL: "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                text: "Elfbar-Security | FiveM Anticheat"
            });

        return interaction.reply({
            embeds: [helpEmbed],
            ephemeral: false,
        });
    }
};
