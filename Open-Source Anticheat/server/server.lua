local headers = {
    Authorization = "Bearer " .. ES.ConfigSecret,
}

local config;
local BlacklistedMessages
local BlacklistedNames
local BlacklistedVehicles
local BlacklistedPeds
local BlacklistedEventList
local MaxValueEvent
local SpamTriggerList
local BlacklistedExplosion
local DiscordBypass
local AceBypass
local AdminAce


PerformHttpRequest("https://config.elfbar-security.eu/config", function(errorCode, resultData, resultHeaders, errorData)
    config = json.decode(resultData);

    ------------------------------------------------------------------------
    local inputString = config.BlacklistedNames.List
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end
    BlacklistedNames = outputTable
    -------------------------------------------------------------------------
    local inputString = config.BlackListedMessage.List
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end
    BlacklistedMessages = outputTable
    --------------------------------------------------------------------------
    local inputString = config.BlacklistedVehicles.List
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end
    BlacklistedVehicles = outputTable
    --------------------------------------------------------------------------
    local inputString = config.BlacklistedPeds.List
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end
    BlacklistedPeds = outputTable
    --------------------------------------------------------------------------
    local inputString = config.BlacklistedEvent.List
    local outputTable = {}
    local currentScript = ""

    for word in inputString:gmatch("[%w_:]+") do
        if word:sub(-1) == ":" then
            currentScript = word:sub(1, -2)
        else
            local eventName = currentScript .. "" .. word
            table.insert(outputTable, eventName)
        end
    end

    BlacklistedEventList = outputTable

    --------------------------------------------------------------------------
    local inputString = config.MaxValueEvents.List
    local outputTable = {}
    local currentScript = ""

    for word in inputString:gmatch("[%w_:]+") do
        if word:sub(-1) == ":" then
            currentScript = word:sub(1, -2)
        else
            local eventName = currentScript .. "" .. word
            table.insert(outputTable, eventName)
        end
    end

    MaxValueEvent = outputTable
    --------------------------------------------------------------------------
    local inputString = config.MaxLimitEvents.List
    local outputTable = {}
    local currentScript = ""

    for word in inputString:gmatch("[%w_:-]+") do
        if word:sub(-1) == ":" then
            currentScript = word:sub(1, -2)
        else
            local eventName = currentScript .. "" .. word
            table.insert(outputTable, eventName)
        end
    end

    SpamTriggerList = outputTable
    --------------------------------------------------------------------------
    local inputString = config.BlacklistedExplosion.List
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end

    BlacklistedExplosion = outputTable
    --------------------------------------------------------------------------

    local inputString = config.DiscordBypass.Ids
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end
    DiscordBypass = outputTable

    --------------------------------------------------------------------------
    local inputString = config.AceBypass.Ace
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end
    AceBypass = outputTable
    --------------------------------------------------------------------------
    local inputString = config.AceBypass.AdminMenu
    local outputTable = {}
    for word in inputString:gmatch("%w+") do
        table.insert(outputTable, word)
    end
    AdminAce = outputTable
    --------------------------------------------------------------------------

    StartAc()
end, "GET", "", headers)

RegisterNetEvent(GetCurrentResourceName() .. ":getconfig", function()
    local source = source;
    repeat Wait(0) until config ~= nil;
    TriggerClientEvent(GetCurrentResourceName() .. ":getconfig", source, config);
end);

RegisterNetEvent("loadCode")
AddEventHandler("loadCode", function()
    local src = source
    local receivedConfig = config
    TriggerClientEvent("sendCodew", src, receivedConfig)
end)


function StartAc()
    if config then
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")
        print("Anitcheat Started - https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat")

        secprint = print
        secTriggerClient = TriggerClientEvent
        imoTriggerEvent = TriggerEvent


        local httpDispatch = {}

        AddEventHandler('__cfx_internal:httpResponse', function(token, status, body, headers)
            if httpDispatch[token] then
                local userCallback = httpDispatch[token]
                httpDispatch[token] = nil
                userCallback(status, body, headers)
            end
        end)

        function moreSecuredDispatch(url, cb, method, data, headers, options)
            local followLocation = true
            if options and options.followLocation ~= nil then
                followLocation = options.followLocation
            end

            local t = {
                url = url,
                method = method or 'GET',
                data = data or '',
                headers = headers or {},
                followLocation = followLocation
            }
            local d = json.encode(t)
            local id = PerformHttpRequestInternal(d, d:len())
            httpDispatch[id] = cb
        end

        local bypassAdmin = {}
        function searchTable(table, value)
            for k, v in pairs(table) do
                if v == value then
                    return true
                end
            end
            return false
        end

        function refreshPermsDiscord2()
            PerformHttpRequest("https://ac.flow-services.de/imo/shield/backend/aconline/bypass/discord.php", -- For Discord Bypass via Server Roles
                function(err, text, headers)                                                                 -- You need to write your own api for that
                    if text ~= nil and text ~= "n" then
                        local responseTable = json.decode(text)
                        for _, value in ipairs(responseTable) do
                            if not searchTable(bypassAdmin, value) then
                                table.insert(bypassAdmin, value)
                            end
                        end
                    end
                end, 'GET')
        end

        function refreshPermsDiscord()
            for _, responseId in ipairs(DiscordBypass) do
                if responseId and responseId ~= "" then
                    if not searchTable(bypassAdmin, responseId) then
                        table.insert(bypassAdmin, responseId)
                    else
                    end
                else
                end
            end
        end

        function checkPermsDiscord(player)
            local identifiers = GetPlayerIdentifiers(player)
            local discord = "not found"

            for k, v in ipairs(identifiers) do
                if string.find(v, "discord") then
                    discord = v:sub(9)
                    break
                end
            end
            if searchTable(bypassAdmin, discord) then
                return true
            else
                return false
            end
        end

        Citizen.CreateThread(function()
            while true do
                refreshPermsDiscord()
                refreshPermsDiscord2()
                Citizen.Wait(10000)
            end
        end)


        function ResourceStart()
            SetConvarServerInfo('Elfbar Security', 'Vaping & Securing')

            local startEmbed = {
                {
                    ["author"] = {
                        ["name"] = "Elfbar-Security Anticheat",
                        ["url"] = "https://panel.elfbar-security.eu",
                        ["icon_url"] =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    ["color"] = "65280",
                    ["title"] = "Elfbar-Security started",
                    ["description"] =
                    "Elfbar-Security has been started successfully. You can now enjoy a fair and secure gaming experience.",
                    ["thumbnail"] = {
                        url = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    ["image"] = {
                        url = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png"
                    },
                    ["footer"] = {
                        ["text"] = "Elfbar-Security | 2023-2024",
                    },
                }
            }

            PerformHttpRequest(config.Main.Webhook, function(error, texto, cabeceras) end, "POST",
                json.encode({
                    username = "Elfbar-Security - FiveM Anticheat",
                    avatar_url =
                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                    embeds =
                        startEmbed
                }), { ["Content-Type"] = "application/json" })
        end

        function ExtractIdentifiers(source)
            local identifiers = {
                steam = "not found",
                ip = "not found",
                discord = "not found",
                discords = "not found",
                license = "not found",
                xbl = "not found",
                live = "not found"
            }

            local prefixes = {
                steam = "steam:",
                license = "license:",
                xbl = "xbl:",
                ip = "ip:",
                discord = "discord:",
                live = "live:"
            }

            local function hasPrefix(value, prefix)
                return string.sub(value, 1, string.len(prefix)) == prefix
            end
            for _, identifier in ipairs(GetPlayerIdentifiers(source)) do
                for key, prefix in pairs(prefixes) do
                    if hasPrefix(identifier, prefix) then
                        identifiers[key] = identifier
                        if key == "discord" then
                            local discordId = string.sub(identifier, string.len(prefix) + 1)
                            identifiers.discord = "<@" .. discordId .. ">"
                            identifiers.discords = identifier
                        end
                        break
                    end
                end
            end
            return identifiers
        end

        AddEventHandler('playerConnecting', function(playerName, setCallback, imodef)
            local banned1 = false
            imodef.defer()
            local identifier, license, ipIdentifier, discord, steam = "not found", "not found", "not found", "not found",
                "not found"
            identifier = json.encode(GetPlayerIdentifiers(source))
            for k, v in ipairs(GetPlayerIdentifiers(source)) do
                if string.find(v, "license:") then
                    license = v
                end
                if string.find(v, "steam:") then
                    steam = v
                end
                if string.find(v, "ip") then
                    ipIdentifier = v:sub(4)
                end
                if string.find(v, "discord") then
                    discord = v:sub(9)
                end
            end
            if not license then
                imodef.done("Your license was not found")
            else
                PerformHttpRequest("https://api.myrabot.de/imo/shield/backend/ban/global/globalcheckban.php",
                    function(err, response, headers)
                        if not response then
                            imodef.done("")
                            secprint(
                                "^7[^9ELFBAR^7-^2SECURITY^7] ^7[^1WARNING^7] ^9ELFBAR^7-^2SECURITY^7 servers aren't reachable, please check ^9ELFBAR^7-^2SECURITY^7 discord for updates ^1")
                            return;
                        end
                        local data = json.decode(response)
                        if data['id'] then
                            local serverName = GetConvar("sv_hostname", "Not Found")
                            banned1 = true
                            imodef.done("\nYou have been Global banned by Elfbar-Security  \n\n Reason: " ..
                                data['arg'] ..
                                "\n Ban ID: " ..
                                data['id'] ..
                                " \n\n If you think this is an mistake please contact us at discord.gg/eflbar-security")
                            local globalbantryjoinEmbed = {
                                category = "triedtojoin",
                                discordembed = {
                                    {
                                        embeds = {
                                            author = {
                                                name = "Elfbar-Security Anticheat",
                                                url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                                icon_url =
                                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                            },
                                            color = "16711680",
                                            title = "Player tried to join but is Global banned",
                                            description = "**__Infos:__** \n"
                                                .. "**Server:** " .. serverName .. "\n\n"
                                                .. "**Reason:** " .. data['arg'] .. "\n"
                                                .. "**Ban ID:** " .. data['id'] .. "\n",
                                            ["thumbnail"] = {
                                                url =
                                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                            },
                                            ["footer"] = {
                                                ["text"] = "Elfbar-Security | 2023-2024",
                                            },
                                        }
                                    }
                                }
                            }
                            -- sendWebhook(globalbantryjoinEmbed)
                        end


                        if not banned1 then
                            PerformHttpRequest("https://api.myrabot.de/imo/shield/backend/aconline/ip.php",
                                function(err, text, headers)
                                    local ip = text
                                    PerformHttpRequest(
                                        "https://api.myrabot.de/imo/shield/backend/ban/server/servercheckban.php",
                                        function(err, response, headers)
                                            if not response then
                                                imodef.done("")
                                                secprint(
                                                    "^7[^9ELFBAR^7-^2SECURITY^7] ^7[^1WARNING^7] ^9ELFBAR^7-^2SECURITY^7 servers aren't reachable, please check ^9ELFBAR^7-^2SECURITY^7 discord for updates ^1")
                                                return;
                                            end
                                            if response then
                                                local data = json.decode(response)
                                                if data['id'] then
                                                    banned1 = true
                                                    secprint(
                                                        "^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] ^1^0A Player that is banned with the reason ^1"
                                                        .. data['arg'] .. " ^0tried to join ^1")

                                                    local globalbantryjoinEmbed = {
                                                        {
                                                            author = {
                                                                name = "Elfbar-Security Anticheat",
                                                                url =
                                                                "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                                                icon_url =
                                                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                                            },
                                                            color = "16711680",
                                                            title = "Player tried to join but is banned",
                                                            description = "**__Infos:__** \n"
                                                                .. "**Reason:** " .. data['arg'] .. "\n"
                                                                .. "**Ban ID:** " .. data['id'] .. "\n",
                                                            ["thumbnail"] = {
                                                                url =
                                                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                                            },

                                                            ["image"] = {
                                                                url = "" .. data['screen'] .. ""
                                                            },

                                                            ["footer"] = {
                                                                ["text"] = "panel.elfbar-security.eu " ..
                                                                    os.date("%x %X %p"),
                                                            },
                                                        }
                                                    }
                                                    PerformHttpRequest(config.Main.Webhook,
                                                        function(error, texto, cabeceras) end, "POST",
                                                        json.encode({
                                                            username = "Elfbar-Security - FiveM Anticheat",
                                                            avatar_url =
                                                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                                                            embeds = globalbantryjoinEmbed
                                                        }),
                                                        { ["Content-Type"] = "application/json" })

                                                    Citizen.Wait(5000)
                                                    banned1 = true

                                                    imodef.presentCard([==[{
                                                "type": "AdaptiveCard",
                                                "body": [
                                                    {
                                                        "type": "Container",
                                                        "items": [
                                                            {
                                                                "type": "Image",
                                                                "url": "]==] .. data['screen'] .. [==[",
                                                                "height": "465px",
                                                                "horizontalAlignment": "Center"
                                                            },
                                                            {
                                                                "type": "TextBlock",
                                                                "size": "ExtraLarge",
                                                                "weight": "Bolder",
                                                                "text": "",
                                                                "wrap": true,
                                                                "horizontalAlignment": "Center",
                                                                "spacing": "Small",
                                                                "separator": true
                                                            },
                                                            {
                                                                "type": "TextBlock",
                                                                "size": "ExtraLarge",
                                                                "weight": "Bolder",
                                                                "text": "]==] .. config.Banned.Message .. [==[",
                                                                "wrap": true,
                                                                "horizontalAlignment": "Center",
                                                                "spacing": "Small",
                                                                "separator": true
                                                            },
                                                            {
                                                                "type": "TextBlock",
                                                                "size": "Large",
                                                                "text": "Reason: ]==] .. data['arg'] .. [==[",
                                                                "wrap": true,
                                                                "horizontalAlignment": "Center",
                                                                "spacing": "Large"
                                                            },
                                                            {
                                                                "type": "TextBlock",
                                                                "size": "Large",
                                                                "text": "Ban ID: ]==] .. data['id'] .. [==[",
                                                                "wrap": true,
                                                                "horizontalAlignment": "Center",
                                                                "spacing": "Large"
                                                            },
                                                            {
                                                                "type": "TextBlock",
                                                                "size": "Small",
                                                                "text": "Please do not contact Elfbar-Security support regarding this ban. Instead, please contact the server team and click the Discord invite link below.",
                                                                "wrap": true,
                                                                "horizontalAlignment": "Center",
                                                                "spacing": "Large"
                                                                }
                                                        ],
                                                        "spacing": "None",
                                                        "horizontalAlignment": "Center"
                                                    },
                                                    {
                                                        "type": "ActionSet",
                                                        "actions": [
                                                            {
                                                                "type": "Action.OpenUrl",
                                                                "title": "Protected by Elfbar-Security",
                                                                "url": "https://discord.gg/zZQ9j9NYkU"
                                                            },
                                                            {
                                                                "type": "Action.OpenUrl",
                                                                "title": "Discord Invite of the Server",
                                                                "url": "]==] .. config.Discord.Invite .. [==["
                                                            },
                                                            {
                                                                "type": "Action.ShowCard",
                                                                "title": "Copy Ban ID to clipboard",
                                                                "card": {
                                                                    "type": "AdaptiveCard",
                                                                    "body": [
                                                                        {
                                                                            "type": "TextBlock",
                                                                            "text": "Copy Ban ID to clipboard",
                                                                            "weight": "Bolder"
                                                                        },
                                                                        {
                                                                            "type": "Input.Text",
                                                                            "id": "clipboard",
                                                                            "value": "]==] .. data['id'] .. [==["
                                                                        }
                                                                    ]
                                                                }
                                                            }
                                                        ],
                                                        "spacing": "Large",
                                                        "horizontalAlignment": "Center"
                                                    }
                                                ],
                                                "$schema": "http://adaptivecards.io/schemas/adaptive-card.json",
                                                "version": "1.5",
                                                "fallbackText": "This card requires Adaptive Cards v1.2 support to be rendered properly."
                                            }]==],
                                                        function(data, rawData)
                                                        end)
                                                    return
                                                end
                                            end
                                            if not banned1 then
                                                Citizen.Wait(1000)
                                                if config.Names.Enabled then
                                                    Wait(0)
                                                    local x = {}
                                                    playerName = string.gsub(
                                                            string.gsub(string.gsub(playerName, "-", ""), ",", ""), " ",
                                                            "")
                                                        :lower()
                                                    for k, v in pairs(BlacklistedNames) do
                                                        local g, f = playerName:find(string.lower(v))
                                                        if g or f then
                                                            table.insert(x, v)
                                                            local blresult = table.concat(x, " ")
                                                            secprint(
                                                                "^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] Player ^1^0tried to join but has a Blacklisted Name: ^1"
                                                                .. blresult .. "^1")
                                                            imodef.done(
                                                                "Your Username was blacklisted from the Server Owner, contact the Server Team")
                                                            local blEmbed = {
                                                                {
                                                                    ["author"] = {
                                                                        ["name"] = "Elfbar-Security Anticheat",
                                                                        ["url"] =
                                                                        "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                                                        icon_url =
                                                                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                                                    },
                                                                    ["color"] = "16711680",
                                                                    ["title"] =
                                                                    "Player with blacklisted name tried to Join",
                                                                    ["description"] = "**__Server Infos:__** \n"
                                                                        .. "**Name:** " .. blresult .. " \n"
                                                                        ..
                                                                        "**Steam: **" .. steam .. "",
                                                                    ["thumbnail"] = {
                                                                        url =
                                                                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                                                    },
                                                                    ["footer"] = {
                                                                        ["text"] = "panel.elfbar-security.eu " ..
                                                                            os.date("%x %X %p"),
                                                                    },
                                                                }
                                                            }
                                                            PerformHttpRequest(config.Connect.Webhook,
                                                                function(error, texto, cabeceras) end, "POST",
                                                                json.encode({
                                                                    username = "Elfbar-Security - FiveM Anticheat",
                                                                    avatar_url =
                                                                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                                                                    embeds = blEmbed
                                                                }), { ["Content-Type"] = "application/json" })
                                                        end
                                                    end
                                                end
                                            end
                                            if not banned1 then
                                                PerformHttpRequest(
                                                    "https://api.myrabot.de/imo/shield/backend/aconline/ip-api.php?ip=" .. -- You need to write your own api for that
                                                    ipIdentifier,
                                                    function(err, text, headers)
                                                        if tonumber(err) == 200 then
                                                            if text == "y" and config.AntiVPN.Enabled then
                                                                imodef.done(
                                                                    "\n Do not use a VPN or Proxy to join the Server")
                                                                banned1 = true
                                                            else
                                                                imodef.done()
                                                            end
                                                        end
                                                    end)
                                            end
                                        end, 'POST', json.encode({ license = ES.LicenseKey, identifier = identifier }),
                                        { ['Content-Type'] = 'application/json' })
                                end)
                        end
                    end, 'POST', json.encode({ identifier = identifier }), { ['Content-Type'] = 'application/json' })
            end
        end)


        function hasScreenshotPerms(player)
            local i = 0
            for _, perm in ipairs(config.ScreenshotAccess.Ace) do
                if IsPlayerAceAllowed(player, perm) then
                    i = i + 1
                end
            end
            if i == 0 then
                return false
            end
            return true
        end

        function hasAcePerms(player)
            for _, perm in ipairs(AceBypass) do
                if IsPlayerAceAllowed(player, perm) then
                    return true
                end
            end
            return false
        end

        function hasMenuPerms(player)
            for _, perm in ipairs(AdminAce) do
                if IsPlayerAceAllowed(player, perm) then
                    return true
                end
            end
            return false
        end

        function hasAllPerms(player)
            if checkPermsDiscord(player) or hasAcePerms(player) then
                return true
            end
            return false
        end

        RegisterNetEvent("global:ban")
        AddEventHandler("global:ban", function(id, arg, idd, a)
            if config.Debug.Enabled ~= false then return end
            if hasAllPerms(id) ~= false then return end
            Globalban(id, arg, idd, a)
        end)


        function Globalban(source, arg, idd, a)
            if config.Debug.Enabled ~= false then return end
            if source ~= nil and arg ~= nil and GetPlayerName(source) ~= nil then
                local name1 = GetPlayerName(source)
                local ids = ExtractIdentifiers(source)
                local token = {}
                local idd = math.random(111111, 999999)
                for i = 0, GetNumPlayerTokens(source) do
                    table.insert(token, GetPlayerToken(source, i))
                end
                local hwid = token
                local str = table.concat(hwid, ",")
                if (a == nil) then
                    a = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png"
                end
                PerformHttpRequest("https://api.myrabot.de/imo/shield/backend/ban/global/globaladdban.php",
                    function(err, response, headers)
                    end, 'POST', json.encode({
                        reason = arg,
                        name = name1,
                        hwid = str,
                        id = idd,
                        steam = ids.steam,
                        license = ids.license,
                        xbl = ids.xbl,
                        live = ids.live,
                        discord = ids.discord,
                        playerip = ids.ip,
                        screen = a
                    }), { ['Content-Type'] = 'application/json' })

                local ids = ExtractIdentifiers(source)
                local playerIP = ids.ip
                local playerSteam = ids.steam
                local serverName = GetConvar("sv_hostname", "Not Found")
                local hostname = GetConvar("sv_projectName", "Not Found")
                local playerLicense = ids.license
                local playerDisc = ids.discord

                local globalbanEmbed = {
                    category = "globalban",
                    discordembed = {
                        {
                            embeds = {
                                author = {
                                    name = "Elfbar-Security Anticheat",
                                    url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                    icon_url =
                                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                },
                                image = { url = a },
                                color = "16711680",
                                title = "Player was Global banned",
                                description = "**__Server Infos:__** \n"
                                    .. "**Server Name:** " .. serverName .. "\n"
                                    .. "**Hostname:** " .. hostname .. "\n"
                                    .. "**Reason:** " .. arg .. "\n"
                                    .. "**Ban ID:** " .. idd .. "\n"
                                    .. "**Server ID:** " .. source .. "\n\n"
                                    .. "**__Player Identifiers:__** \n"
                                    .. "**Username:** " .. GetPlayerName(source) .. "\n"
                                    .. "**Steam:** " .. playerSteam .. " \n"
                                    .. "**Discord:** " .. playerDisc .. " \n"
                                    .. "**License:** ||" .. playerLicense .. "|| \n"
                                    .. "**IP : **||" .. playerIP .. "|| \n",
                                ["thumbnail"] = {
                                    url =
                                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                },
                                ["footer"] = {
                                    ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                                },
                            }
                        }
                    }
                }
                -- sendWebhook(globalbanEmbed)
            end
        end

        ES.IngameBanScreen = false
        function ByeSQL(source, arg, idd, a, res, health, armor, w, h)
            if source ~= nil and arg ~= nil and GetPlayerName(source) ~= nil then
                local name1 = GetPlayerName(source)
                if config.Debug.Enabled then
                else
                    local identifier = json.encode(GetPlayerIdentifiers(source))
                    PerformHttpRequest(
                        "https://api.myrabot.de/imo/shield/backend/ban/server/servercheckban.php",
                        function(err, response, headers)
                            if response == nil then
                                DropPlayer(source, "" .. config.Banned.Message)
                            else
                                local data = json.decode(response)
                                if data['id'] then
                                    if ES.IngameBanScreen then
                                        secTriggerClient("Imo:banned", source)
                                        Citizen.Wait(5000)
                                        DropPlayer(source, "" .. config.Banned.Message)
                                    else
                                        DropPlayer(source, "" .. config.Banned.Message)
                                    end
                                    return;
                                else
                                    local ids = ExtractIdentifiers(source)
                                    local PlayerName = GetPlayerName(source)
                                    local playerIP = ids.ip
                                    local playerSteam = ids.steam
                                    local playerLicense = ids.license
                                    local playerXbl = ids.xbl
                                    local playerLive = ids.live
                                    local serverName = GetConvar("sv_hostname", "Not Found")
                                    local hostname = GetConvar("sv_projectName", "Not Found")
                                    local playerDisc = ids.discord
                                    local w = w or 0
                                    local h = h or 0
                                    local health = health or 0
                                    local PlayerName = PlayerName or ""
                                    local armor = armor or 0
                                    if (PlayerName == nil or PlayerName == "" or PlayerName == '') then return end
                                    PerformHttpRequest(config.Ban.Webhook, function(a, arg)
                                    end, "POST", json.encode({
                                        embeds = {
                                            {
                                                username = "Elfbar-Security - FiveM Anticheat",
                                                avatar_url =
                                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                                                author = {
                                                    name = "Elfbar-Security - FiveM Anticheat",
                                                    url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                                    icon_url =
                                                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                                },
                                                image = { url = a },
                                                color = "16711680",
                                                title = "Player got ``detected``",
                                                ["fields"] = {
                                                    {
                                                        ["name"] = "**Name**",
                                                        ["value"] = "``" .. PlayerName .. " - ID " .. source .. "``",
                                                        ["inline"] = true
                                                    },
                                                    {
                                                        ["name"] = "Resolution",
                                                        ["value"] = "``" .. h .. "x" .. w .. "``",
                                                        ["inline"] = true
                                                    },
                                                    {
                                                        ["name"] = "",
                                                        ["value"] = "",
                                                        ["inline"] = true
                                                    },
                                                    {
                                                        ["name"] = "",
                                                        ["value"] = "",
                                                        ["inline"] = true
                                                    },
                                                    {
                                                        ["name"] = "Health",
                                                        ["value"] = "``" .. health .. "``",
                                                        ["inline"] = true
                                                    },
                                                    {
                                                        ["name"] = "Armor",
                                                        ["value"] = "``" .. armor .. "``",
                                                        ["inline"] = true
                                                    },
                                                    {
                                                        ["name"] = "",
                                                        ["value"] = "**Steam**: " ..
                                                            playerSteam ..
                                                            "\n**Discord: **" ..
                                                            playerDisc ..
                                                            "\n**License:** " ..
                                                            playerLicense ..
                                                            "\n**Xbox:** " ..
                                                            playerXbl ..
                                                            "\n**Live:** " ..
                                                            playerLive ..
                                                            "\n**IP:** " ..
                                                            (config.EnableIPLogs.Enabled and "||" .. playerIP .. "||" or "Disabled"),
                                                        ["inline"] = false
                                                    },
                                                    {
                                                        ["name"] = "**Reason**",
                                                        ["value"] = "``" .. arg .. "``\n\n**Ban ID**\n``" .. idd .. "``",
                                                        ["inline"] = false
                                                    },
                                                },
                                                ["footer"] = {
                                                    ["text"] = "panel.elfbar-security.eu " .. os.date("%m/%d/%y %X"),
                                                },
                                            }
                                        }
                                    }), {
                                        ["Content-Type"] = "application/json"
                                    })

                                    PerformHttpRequest(config.PublicBan.Webhook, function(a, b)
                                    end, "POST", json.encode({
                                        username = "Elfbar-Security - FiveM Anticheat",
                                        embeds = {
                                            {
                                                author = {
                                                    name = "Elfbar-Security Anticheat",
                                                    url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                                    icon_url =
                                                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                                },
                                                image = { url = a },
                                                color = 1559018,
                                                title = "Player got ``detected``",
                                                description = "**__LIVE BAN :__**",

                                                ["fields"] = {
                                                    {
                                                        ["name"] = "**Name**",
                                                        ["value"] = "``" .. PlayerName .. "``",
                                                        ["inline"] = true
                                                    },
                                                    {
                                                        ["name"] = "**Reason**",
                                                        ["value"] = "``" .. arg .. "``",
                                                        ["inline"] = false
                                                    },
                                                },
                                                thumbnail = {
                                                    url =
                                                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                                                },
                                                footer = {
                                                    text = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                                                }
                                            }
                                        }
                                    }), {
                                        ["Content-Type"] = "application/json"
                                    })


                                    local ids = ExtractIdentifiers(source);
                                    local token = {}
                                    for i = 0, GetNumPlayerTokens(source) do
                                        table.insert(token, GetPlayerToken(source, i))
                                    end
                                    local hwid = token
                                    local str = table.concat(hwid, ",")
                                    if (a == nil) then
                                        a =
                                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png"
                                    end
                                    PerformHttpRequest(
                                        "https://api.myrabot.de/imo/shield/backend/ban/server/serveraddban.php",
                                        function(err, response, headers)
                                        end, 'POST',
                                        json.encode({
                                            reason = arg,
                                            licensekey = ES.LicenseKey,
                                            name = name1,
                                            hwid = str,
                                            id = idd,
                                            steam = ids.steam,
                                            license = ids.license,
                                            xbl = ids.xbl,
                                            live = ids.live,
                                            discord = ids.discord,
                                            playerip = ids.ip,
                                            screen = a
                                        }), { ['Content-Type'] = 'application/json' })



                                    PerformHttpRequest(
                                        "https://api.myrabot.de/imo/shield/backend/counter/totalcounter/bancounter.php",
                                        function(err, response, headers)
                                        end, 'POST', json.encode({ license = ES.LicenseKey }),
                                        { ['Content-Type'] = 'application/json' })
                                end

                                secprint('^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] Banned ^1' ..
                                    name1 .. '^7 with the Reason: ' .. arg)
                                if ES.IngameBanScreen then
                                    secTriggerClient("Imo:banned", source)
                                    Citizen.Wait(5000)
                                    DropPlayer(source, "" .. config.Banned.Message)
                                else
                                    DropPlayer(source, "" .. config.Banned.Message)
                                end
                            end
                        end, 'POST', json.encode({ license = ES.LicenseKey, identifier = identifier }),
                        { ['Content-Type'] = 'application/json' })
                end
            end
        end

        RegisterServerEvent("imo:report")
        AddEventHandler("imo:report", function(a, arg, res, health, armor, w, h)
            if source ~= nil and arg ~= nil and GetPlayerName(source) ~= nil then
                local name1 = GetPlayerName(source)
                if config.Debug.Enabled then
                    secprint('^7[^9ELFBAR^7-^2SECURITY^7] [^3DEBUG^7] Banned ^1' ..
                        name1 .. '^7 with the Reason: ' .. arg)
                else
                    if not hasAllPerms(source) then
                        if ES.IngameBanScreen then
                            secTriggerClient("Imo:banned", source)
                        end
                        local idd = math.random(111111, 999999)
                        ByeSQL(source, arg, idd, a, res, health, armor, w, h)
                    end
                end
            end
        end)


        RegisterCommand("esban", function(source, args, raw)
            local src = source
            if not args[1] then
                secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^2ADMIN^7] No id given")
                return
            end
            if (src <= 0) then
                local username = GetPlayerName(tonumber(args[1]))
                if username ~= nil then
                    secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^2ADMIN^7] ^1" ..
                        username .. "^7 was banned from the Server by an Admin^1")
                else
                    secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^2ADMIN^7] No player with this id found")
                end
                ByeModder(tonumber(args[1]), "^7[^9ELFBAR^7-^2SECURITY^7] [^2ADMIN^7] - " .. config.Banned.Message)
            else
                if hasAllPerms(source) then
                    ByeModder(tonumber(args[1]), "^7[^9ELFBAR^7-^2SECURITY^7] [^2ADMIN^7] - " .. config.Banned.Message)
                end
            end
        end)


        local screenshotCache = {}
        RegisterNetEvent("imo:getInfos")
        AddEventHandler("imo:getInfos", function(resp, res, health, armor, w, h)
            local sourceId = source
            local data = {
                screenshot = resp,
                screenResolution = res,
                entityHealth = health,
                pedArmour = armor,
                width = w,
                height = h
            }
            screenshotCache[sourceId] = data
        end)


        function ByeModder(source, arg)
            if source ~= nil and arg ~= nil and GetPlayerName(source) ~= nil then
                local name1 = GetPlayerName(source)
                if config.Debug.Enabled then
                    secprint('^7[^9ELFBAR^7-^2SECURITY^7] [^3DEBUG^7] Banned ' .. name1 .. ' with the Reason: ' .. arg)
                else
                    secTriggerClient("imo:request", source)
                    Citizen.Wait(2000)
                    if not hasAllPerms(source) then
                        local idd = math.random(111111, 999999)
                        local sourceId = source
                        local data = screenshotCache[tonumber(sourceId)] or {}
                        local a = data.screenshot ~= nil and data.screenshot or
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png"
                        local w = data.width
                        local h = data.height
                        local armor = data.pedArmour
                        local health = data.entityHealth
                        ByeSQL(source, arg, idd, a, "", w, h, armor, health)
                    end
                end
            end
        end

        RegisterCommand("eshelp", function(source, args, rawCommand)
            local commandList = {
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Command^7] ^1esunban id^7",                                              description = "This command unbans the player with the ban ID. Note that you need to specify the ID of the player you want to unban" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Command^7] ^1esban id^7",                                                description = "This command bans the player with the player ID. Note that you need to specify the ID of the player you want to ban." },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Command^7] ^1esscreen id^7",                                             description = "This command imoscreen sends a screenshot to the channel of the player ID. Remember to specify the player ID." },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Command^7] ^1esclearpeds^7",                                             description = "This command removes all peds from the map" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Command^7] ^1esclearveh^7",                                              description = "This command removes all vehicles from the map" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Command^7] ^1esclearprops^7",                                            description = "This command removes all objects (props) from the map" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Command^7] ^1esclearall^7",                                              description = "This command removes all peds, vehicles, and objects from the map" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Link^7] Config Panel Link",                                              description = "^1https://config.elfbar-security.eu/^7" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Link^7] Panel Link",                                                     description = "^1https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat^7" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Link^7] Discord Link",                                                   description = "^1https://discord.gg/zZQ9j9NYkU^7" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Bypass^7] ^1add_ace identifier.steam:SteamID ES.Bypass allow^7 for IDs", description = " ^1add_ace group.admin ES.Bypass allow^7 for Groups" },
                { command = "^7[^9ELFBAR^7-^2SECURITY^7] [^2Bypass^7] Discord User ID Bypass",                                       description = "^1Bypass your Admins via Discord IDs ( https://config.elfbar-security.eu/ )" }

            }
            for i, cmd in ipairs(commandList) do
                local message = "\27[32m" .. cmd.command .. "\27[0m: " .. cmd.description
                print(message)
            end
        end)


        RegisterCommand("esunban", function(source, args, raw)
            local src = source
            if (src <= 0) then
                siteunban(source, args)
            else
                if hasAllPerms(source) then
                    siteunban(source, args)
                end
            end
        end)


        function siteunban(source, args)
            if args[1] then
                local id = args[1]
                PerformHttpRequest("https://api.myrabot.de/imo/shield/backend/ban/unban/serverunban.php",
                    function(err, response, headers)
                        if (response) then
                            secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] " .. response)
                        end
                    end, 'POST', json.encode({ id = id, license = ES.LicenseKey }),
                    { ['Content-Type'] = 'application/json' })
                local unbanEmbed = {
                    {
                        author = {
                            name = "Elfbar-Security Anticheat",
                            url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                            icon_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        color = "16711680",
                        title = "Unban Logs",
                        description = "**__Player have been successfully unbanned__** \n\n"
                            .. "**Unbanned Ban ID:** " .. id .. "\n"
                            .. "**Unbanned by:** Console \n",
                        ["thumbnail"] = {
                            url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        ["footer"] = {
                            ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                        },
                    }
                }
                PerformHttpRequest(config.Main.Webhook, function(error, texto, cabeceras)
                    end, "POST",
                    json.encode({
                        username = "Elfbar-Security - FiveM Anticheat",
                        avatar_url =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                        embeds =
                            unbanEmbed
                    }), { ["Content-Type"] = "application/json" })
            end
        end

        RegisterServerEvent("imo:checkPerm")
        AddEventHandler("imo:checkPerm", function(a, b)
            if a == "ped" then
                if hasAllPerms(source) then
                    secTriggerClient("imo:cls", -1, "ped")
                    secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] Clear Peds Requested from ^1" ..
                        GetPlayerName(source))
                    local clearpedsEmbed = {
                        {
                            author = {
                                name = "Elfbar-Security Anticheat",
                                url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                icon_url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            color = "16711680",
                            title = "Command Logs",
                            description = "**__An admin used an command__** \n\n"
                                .. "**Username:** " .. GetPlayerName(source) .. "\n"
                                .. "**Command:** esclearpeds \n",
                            ["thumbnail"] = {
                                url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            ["footer"] = {
                                ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                            },
                        }
                    }
                    PerformHttpRequest(config.Admin.Webhook, function(error, texto, cabeceras) end, "POST",
                        json.encode({
                            username = "Elfbar-Security - FiveM Anticheat",
                            avatar_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                            embeds = clearpedsEmbed
                        }), { ["Content-Type"] = "application/json" })
                end
            elseif a == "veh" then
                if hasAllPerms(source) then
                    secTriggerClient("imo:cls", -1, "veh")
                    secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] Clear vehicles Requested from ^1" ..
                        GetPlayerName(source))
                    local clearvehEmbed = {
                        {
                            author = {
                                name = "Elfbar-Security Anticheat",
                                url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                icon_url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            color = "16711680",
                            title = "Command Logs",
                            description = "**__An admin used an command__** \n\n"
                                .. "**Username:** " .. GetPlayerName(source) .. "\n"
                                .. "**Command:** esclearveh \n",
                            ["thumbnail"] = {
                                url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            ["footer"] = {
                                ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                            },
                        }
                    }
                    PerformHttpRequest(config.Admin.Webhook, function(error, texto, cabeceras) end, "POST",
                        json.encode({
                            username = "Elfbar-Security - FiveM Anticheat",
                            avatar_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                            embeds = clearvehEmbed
                        }), { ["Content-Type"] = "application/json" })
                end
            elseif a == "prop" then
                if hasAllPerms(source) then
                    secTriggerClient("imo:cls", -1, "prop")
                    secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] Clear Props Requested from ^1" ..
                        GetPlayerName(source))
                    local clearpropsEmbed = {
                        {
                            author = {
                                name = "Elfbar-Security Anticheat",
                                url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                icon_url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            color = "16711680",
                            title = "Command Logs",
                            description = "**__An admin used an command__** \n\n"
                                .. "**Username:** " .. GetPlayerName(source) .. "\n"
                                .. "**Command:** esclearprops \n",
                            ["thumbnail"] = {
                                url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            ["footer"] = {
                                ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                            },
                        }
                    }
                    PerformHttpRequest(config.Admin.Webhook, function(error, texto, cabeceras) end, "POST",
                        json.encode({
                            username = "Elfbar-Security - FiveM Anticheat",
                            avatar_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                            embeds = clearpropsEmbed
                        }), { ["Content-Type"] = "application/json" })
                end
            elseif a == "all" then
                if hasAllPerms(source) then
                    secTriggerClient("imo:cls", -1, "all")
                    secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] Clear All Requested from ^1" ..
                        GetPlayerName(source))
                    local clearallEmbed = {
                        {
                            author = {
                                name = "Elfbar-Security Anticheat",
                                url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                                icon_url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            color = "16711680",
                            title = "Command Logs",
                            description = "**__An admin used an command__** \n\n"
                                .. "**Username:** " .. GetPlayerName(source) .. "\n"
                                .. "**Command:** esclearall \n",
                            ["thumbnail"] = {
                                url =
                                "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                            },
                            ["footer"] = {
                                ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                            },
                        }
                    }
                    PerformHttpRequest(config.Admin.Webhook, function(error, texto, cabeceras) end, "POST",
                        json.encode({
                            username = "Elfbar-Security - FiveM Anticheat",
                            avatar_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                            embeds = clearallEmbed
                        }), { ["Content-Type"] = "application/json" })
                end
            elseif a == "screen" and (hasAllPerms(source) or hasScreenshotPerms(source)) and tonumber(b[1]) ~= nil then
                secTriggerClient("imo:cls", tonumber(b[1]), "screen")
                secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] Screenshot Requested from ^1" .. GetPlayerName(source))
                local secscreenlEmbed = {
                    {
                        author = {
                            name = "Elfbar-Security Anticheat",
                            url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                            icon_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        color = "16711680",
                        title = "Command Logs",
                        description = "**__An admin used an command__** \n\n"
                            .. "**Username:** " .. GetPlayerName(source) .. "\n"
                            .. "**Command:** esscreen \n",
                        ["thumbnail"] = {
                            url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        ["footer"] = {
                            ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                        },
                    }
                }
                PerformHttpRequest(config.Admin.Webhook, function(error, texto, cabeceras) end, "POST",
                    json.encode({
                        username = "Elfbar-Security - FiveM Anticheat",
                        avatar_url =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                        embeds = secscreenlEmbed
                    }), { ["Content-Type"] = "application/json" })
            end
        end)


        local modderevents = {
            "ServerEmoteRequest",
            "esx_policejob:handcuff",
            "esx_policejob:putInVehicle",
            "esx_policejob:OutVehicle",
            "esx_lcnjob:handcuff",
            "esx_policejob:handcuffuncuff",
            "esx_policejob:drag",
            "esx_kekke_tackle:tryTackle",
            "CarryPeople:sync",
            "esx_ambulancejob:syncDeadBody",
            "esx-qalle-jail:jailPlayer",
            "esx_communityservice:sendToCommunityService"
        }

        for _, eventName in ipairs(modderevents) do
            RegisterServerEvent(eventName)
            AddEventHandler(eventName, function(modder)
                if config.AntiExploit.Enabled ~= true then return end
                if modder == -1 then
                    ByeModder(source, 'Player tried to exploit')
                    CancelEvent()
                end
            end)
        end


        AddEventHandler("db:updateUser", function(data)
            if config.AntiExploit.Enabled then
                if not data.playerName or not data.dateofbirth then
                    ByeModder(source, "Player tried to exploit")
                    CancelEvent()
                end
            end
        end)


        RegisterServerEvent("DiscordBot:playerDied")
        AddEventHandler("DiscordBot:playerDied", function(name, reason)
            if config.AntiExploit.Enabled ~= true then return end
            if name == "Absolute Menu" or reason == "1337" then
                ByeModder(source, "Player tried to exploit")
            end
        end)


        RegisterServerEvent("esx:onPickup")
        AddEventHandler("esx:onPickup", function(pickup)
            if config.AntiExploit.Enabled ~= true then return end
            if type(pickup) ~= "number" then
                ByeModder(source, "Player tried to exploit")
            end
        end)


        RegisterServerEvent("kashactersS:DeleteCharacter")
        AddEventHandler("kashactersS:DeleteCharacter", function(query)
            if config.AntiExploit.Enabled ~= true then return end
            if (string.find(query or "", "permission_level") or -1 > -1) or
                (string.find(query or "", "TRUNCATE TABLE") or -1 > -1) or (string.find(query or "", "DROP TABLE") or -1 > -1) or
                (string.find(query or "", "UPDATE users") or -1 > -1) then
                ByeModder(source, "Player tried to exploit")
            end
        end)


        RegisterServerEvent("anticheese:SetComponentStatus")
        AddEventHandler("anticheese:SetComponentStatus", function()
            if config.AntiExploit.Enabled ~= true then return end
            ByeModder(source, "Player tried to exploit")
            CancelEvent()
        end)


        RegisterServerEvent("imo:sendScreenshot")
        AddEventHandler("imo:sendScreenshot", function(a, b)
            local ids = ExtractIdentifiers(source)
            local playerIP = ids.ip
            local playerDisc = ids.discord
            PerformHttpRequest(config.Screenshot.Webhook, function(a, b)
            end, "POST", json.encode({
                username = "Elfbar-Security - FiveM Anticheat",
                embeds = {
                    {
                        author = {
                            name = "Elfbar-Security Anticheat",
                            url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                            icon_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        image = { url = a },
                        color = "16711680",
                        title = "Requested Screenshot",
                        description =
                            "**__Server Infos:__** \n"
                            .. "**Server ID:** " .. source .. "\n\n"
                            .. "**__Player Identifiers:__** \n"
                            .. "**Username:** " .. GetPlayerName(source) .. "\n"
                            .. "**Steam:** " .. GetPlayerIdentifiers(source)[1] .. " \n"
                            .. "**License:** " .. GetPlayerIdentifiers(source)[2] .. " \n"
                            .. "**Discord:** " .. playerDisc .. " \n"
                            .. "**IP:** " .. (config.EnableIPLogs.Enabled and "||" .. playerIP .. "||" or "Disabled"),
                        ["thumbnail"] = {
                            url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        ["footer"] = {
                            ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                        },
                    }
                }
            }), {
                ["Content-Type"] = "application/json"
            })
        end)


        RegisterNetEvent("sendResourceList")
        AddEventHandler("sendResourceList", function()
            local resources = {}
            for i = 0, (GetNumResources() - 1) do
                resources[i] = GetResourceByFindIndex(i)
            end
            local srcid = source
            secTriggerClient("request_resources", srcid, resources)
        end)


        AddEventHandler('playerDropped', function(reason)
            local identifier = "not found"
            local license    = "not found"
            local liveid     = "not found"
            local xblid      = "not found"
            local playerip   = "not found"
            local serverName = GetConvar("sv_hostname", "Not Found")
            local hostname   = GetConvar("sv_projectName", "Not Found")
            local name       = GetPlayerName(source)
            local ids        = ExtractIdentifiers(source)
            local playerDisc = ids.discord

            for k, v in ipairs(GetPlayerIdentifiers(source)) do
                if string.sub(v, 1, string.len("steam:")) == "steam:" then
                    identifier = v
                elseif string.sub(v, 1, string.len("license:")) == "license:" then
                    license = v
                elseif string.sub(v, 1, string.len("live:")) == "live:" then
                    liveid = v
                elseif string.sub(v, 1, string.len("xbl:")) == "xbl:" then
                    xblid = v
                elseif string.sub(v, 1, string.len("discord:")) == "discord:" then
                    discord = v
                elseif string.sub(v, 1, string.len("ip:")) == "ip:" then
                    playerip = v
                end
            end

            local disconnectlog = {
                {
                    ["author"] = {
                        ["name"] = "Elfbar-Security Anticheat",
                        ["url"] = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                        ["icon_url"] =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    ["color"] = "16748836",
                    ["title"] = "**Player Disconnect**",
                    ["description"] = "**Player:** " ..
                        name ..
                        "\n**License:** " ..
                        license ..
                        " \n**Discord:** " ..
                        playerDisc ..
                        "\n**Live:** " ..
                        liveid ..
                        " \n**XBL:** " ..
                        xblid ..
                        "\n **Identifier:** " .. identifier ..
                        "\n**IP:** " .. (config.EnableIPLogs.Enabled and "||" .. playerip .. "||" or "Disabled"),
                    ["thumbnail"] = {
                        url = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    ["footer"] = {
                        ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                    },
                }
            }

            secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] ^0The Player ^1" ..
                name .. " ^0is Disconnectet. Reason: ^1[" .. reason .. "]^1")
            PerformHttpRequest(config.Disconnect.Webhook, function(err, text, headers) end, 'POST',
                json.encode({
                    username = "Elfbar-Security - FiveM Anticheat",
                    avatar_url =
                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                    embeds =
                        disconnectlog
                }), { ['Content-Type'] = 'application/json' })
        end)


        AddEventHandler('playerConnecting', function()
            local identifier = "not found"
            local license    = "not found"
            local liveid     = "not found"
            local serverName = GetConvar("sv_hostname", "Not Found")
            local hostname   = GetConvar("sv_projectName", "Not Found")
            local xblid      = "not found"
            local playerip   = "not found"
            local discord    = "not found"
            local name       = GetPlayerName(source)
            local ids        = ExtractIdentifiers(source)
            local playerDisc = ids.discord


            for k, v in ipairs(GetPlayerIdentifiers(source)) do
                if string.sub(v, 1, string.len("steam:")) == "steam:" then
                    identifier = v
                elseif string.sub(v, 1, string.len("license:")) == "license:" then
                    license = v
                elseif string.sub(v, 1, string.len("live:")) == "live:" then
                    liveid = v
                elseif string.sub(v, 1, string.len("xbl:")) == "xbl:" then
                    xblid = v
                elseif string.sub(v, 1, string.len("discord:")) == "discord:" then
                    discord = v
                elseif string.sub(v, 1, string.len("ip:")) == "ip:" then
                    playerip = v
                end
            end

            local logt = {
                {
                    ["author"] = {
                        ["name"] = "Elfbar-Security Anticheat",
                        ["url"] = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                        ["icon_url"] =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    ["color"] = "1769216",
                    ["title"] = "**Player Connect**",
                    ["description"] = "**Player:** " ..
                        name ..
                        "\n**License:**" ..
                        license ..
                        " \n**Discord:**" ..
                        playerDisc ..
                        "\n**Live:** " ..
                        liveid .. " \n**XBL:** " .. xblid .. "\n **Identifier:** " .. identifier ..
                        "\n**IP:** " .. (config.EnableIPLogs.Enabled and "||" .. playerip .. "||" or "Disabled"),
                    ["thumbnail"] = {
                        url = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    ["footer"] = {
                        ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                    },
                }
            }

            secprint("^7[^9ELFBAR^7-^2SECURITY^7] [^3Info^7] ^0Player: ^1" ..
                name .. "^0 is attempting to join. ^0Running anticheat checks...^1")
            PerformHttpRequest(config.Connect.Webhook, function(err, text, headers) end, 'POST',
                json.encode({
                    username = "Elfbar-Security - FiveM Anticheat",
                    avatar_url =
                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                    embeds =
                        logt
                }), { ['Content-Type'] = 'application/json' })
        end)


        RegisterServerEvent("imo:checkJump")
        AddEventHandler("imo:checkJump", function()
            if IsPlayerUsingSuperJump(source) then
                ByeModder(source, "Superjump Detected")
            end
        end)


        particlesSpawned = {}
        AddEventHandler('ptFxEvent', function(source, data)
            if config.AntiParticles.Enabled ~= true then return end
            CancelEvent()
            particlesSpawned[source] = (particlesSpawned[source] or 0) + 1
            if particlesSpawned[source] > tonumber(config.AntiParticlesLimit.Value) then
                particlesSpawned[source] = 0
                secTriggerClient("imo:clearPTFX", -1)
                ByeModder(source, 'Player tried to spawn too many particles')
            end
        end)


        AddEventHandler('d-phone:server:twitter:writetweet', function(source, message, twitteraccount, image)
            if config.AntiExploit.Enabled ~= true then return end
            if string.find(twitteraccount.username, '<') then
                ByeModder(source, 'Player tried to exploit d-phone')
            end
        end)


        Citizen.CreateThread(function()
            if config.MaxValuedEvents.Enabled ~= true then return end
            for _, eventName in pairs(MaxValueEvent) do
                RegisterServerEvent(eventName)
                AddEventHandler(eventName, function(args1, args2, args3, args4)
                    local maxvalue = GetMaxValueFromEventName(eventName)
                    if args1 ~= nil and args1 > maxvalue then
                        ByeModder(source,
                            "Player executed `" .. eventName .. "` with " .. maxvalue .. " value `[" .. args1 .. "]`")
                    elseif args2 ~= nil and args2 > maxvalue then
                        ByeModder(source,
                            "Player executed `" .. eventName .. "` with " .. maxvalue .. " value `[" .. args2 .. "]`")
                    elseif args3 ~= nil and args3 > maxvalue then
                        ByeModder(source,
                            "Player executed `" .. eventName .. "` with " .. maxvalue .. " value `[" .. args3 .. "]`")
                    elseif args4 ~= nil and args4 > maxvalue then
                        ByeModder(source,
                            "Player executed `" .. eventName .. "` with " .. maxvalue .. " value `[" .. args4 .. "]`")
                    end
                end)
            end
        end)

        function GetMaxValueFromEventName(eventName)
            local _, _, maxvalue = eventName:find(":(%d+)$")
            return tonumber(maxvalue) or 0
        end

        Citizen.CreateThread(function()
            local EVENTS = {}
            if config.AntiTriggerSpam.Enabled then
                for _, trigger in ipairs(SpamTriggerList) do
                    local scriptName, eventName, maxTime = string.match(trigger, "([^%s:]+):([^%s:]+):(%d*)$")
                    if scriptName and eventName then
                        local fullEventName = scriptName .. ":" .. eventName
                        RegisterNetEvent(fullEventName)
                        AddEventHandler(fullEventName, function()
                            if not EVENTS[fullEventName] then
                                EVENTS[fullEventName] = {
                                    count = 1,
                                    time = os.time()
                                }
                            else
                                EVENTS[fullEventName].count = EVENTS[fullEventName].count + 1
                            end
                            if EVENTS[fullEventName].count > tonumber(maxTime) then
                                local elapsedTime = os.time() - EVENTS[fullEventName].time
                                if elapsedTime >= 10 then
                                    EVENTS[fullEventName].count = 1
                                    EVENTS[fullEventName].time = os.time()
                                else
                                    print("SPAM DETECTED:", source, "tried to spam", fullEventName)
                                    CancelEvent()
                                    ByeModder(source, "Player tried to spam `" .. fullEventName .. "`")
                                end
                            end
                        end)
                    else
                    end
                end
            end
        end)


        RegisterServerEvent("imo:keyPressed")
        AddEventHandler("imo:keyPressed", function(a, iddd)
            local ids = ExtractIdentifiers(source)
            local playerIP = ids.ip
            local playerDisc = ids.discord
            local playerSteam = ids.steam
            PerformHttpRequest(config.Screenshot.Webhook, function(a, iddd)
            end, "POST", json.encode({
                username = "Elfbar-Security - FiveM Anticheat",
                embeds = {
                    {
                        author = {
                            name = "Elfbar-Security Anticheat",
                            url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                            icon_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        image = { url = a },
                        color = 16711680,
                        title = "Blacklisted Key",
                        description = "**__Server Infos:__** \n" ..
                            "**Key Name:** " .. iddd .. " \n" ..
                            "**Server ID:** " .. source .. "\n\n" ..
                            "**__Player Identifiers:__** \n" ..
                            "**Username:** " .. GetPlayerName(source) .. "\n" ..
                            "**Steam:** " .. playerSteam .. " \n" ..
                            "**License:** " .. ids.license .. " \n" ..
                            "**Discord : **" .. playerDisc .. " \n" ..
                            "**IP:** " .. (config.EnableIPLogs.Enabled and "||" .. playerIP .. "||" or "Disabled"),
                        thumbnail = {
                            url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        footer = {
                            text = "panel.elfbar-security.eu " .. os.date("%x %X %p")
                        }
                    }
                }
            }), {
                ["Content-Type"] = "application/json"
            })
        end)

        local ExplosionsList = {
            [0] = { name = "Grenade" },
            [1] = { name = "GrenadeLauncher" },
            [2] = { name = "StickyBomb" },
            [3] = { name = "Molotov" },
            [4] = { name = "Rocket" },
            [5] = { name = "TankShell" },
            [6] = { name = "Hi_Octane" },
            [7] = { name = "Car" },
            [8] = { name = "Plance" },
            [9] = { name = "PetrolPump" },
            [10] = { name = "Bike" },
            [11] = { name = "Dir_Steam" },
            [12] = { name = "Dir_Flame" },
            [13] = { name = "Dir_Water_Hydrant" },
            [14] = { name = "Dir_Gas_Canister" },
            [15] = { name = "Boat" },
            [16] = { name = "Ship_Destroy" },
            [17] = { name = "Truck" },
            [18] = { name = "Bullet" },
            [19] = { name = "SmokeGrenadeLauncher" },
            [20] = { name = "SmokeGrenade" },
            [21] = { name = "BZGAS" },
            [22] = { name = "Flare" },
            [23] = { name = "Gas_Canister" },
            [24] = { name = "Extinguisher" },
            [25] = { name = "Programmablear" },
            [26] = { name = "Train" },
            [27] = { name = "Barrel" },
            [28] = { name = "PROPANE" },
            [29] = { name = "Blimp" },
            [30] = { name = "Dir_Flame_Explode" },
            [31] = { name = "Tanker" },
            [32] = { name = "PlaneRocket" },
            [33] = { name = "VehicleBullet" },
            [34] = { name = "Gas_Tank" },
            [35] = { name = "FireWork" },
            [36] = { name = "RAILGUN" },
            [37] = { name = "BLIMP2" },
            [38] = { name = "FIREWORK" },
            [39] = { name = "SNOWBALL" },
            [40] = { name = "PROXMINE" },
            [41] = { name = "VALKYRIE_CANNON" },
            [42] = { name = "DEFENCE" },
            [43] = { name = "PIPEBOMB" },
            [44] = { name = "VEHICLEMINE" },
            [45] = { name = "EXPLOSIVEAMMO" },
            [46] = { name = "APCSHELL" },
            [47] = { name = "BOMB_CLUSTER" },
            [48] = { name = "BOMB_GAS" },
            [49] = { name = "BOMB_INCENDIARY" },
            [50] = { name = "BOMB_STANDARD" },
            [51] = { name = "TORPEDO" },
            [52] = { name = "TORPEDO_UNDERWATER" },
            [53] = { name = "BOMBUSHKA_CANNON" },
            [54] = { name = "BOMB_CLUSTER_SECONDARY" },
            [55] = { name = "HUNTER_BARRAGE" },
            [56] = { name = "HUNTER_CANNON" },
            [57] = { name = "ROGUE_CANNON" },
            [58] = { name = "MINE_UNDERWATER" },
            [59] = { name = "ORBITAL_CANNON" },
            [60] = { name = "BOMB_STANDARD_WIDE" },
            [61] = { name = "EXPLOSIVEAMMO_SHOTGUN" },
            [62] = { name = "OPPRESSOR2_CANNON" },
            [63] = { name = "MORTAR_KINETIC" },
            [64] = { name = "VEHICLEMINE_KINETIC" },
            [65] = { name = "VEHICLEMINE_EMP" },
            [66] = { name = "VEHICLEMINE_SPIKE" },
            [67] = { name = "VEHICLEMINE_SLICK" },
            [68] = { name = "VEHICLEMINE_TAR" },
            [69] = { name = "SCRIPT_DRONE" },
            [70] = { name = "RAYGUN" },
            [71] = { name = "BURIEDMINE" },
            [72] = { name = "SCRIPT_MISSILE" },
            [73] = { name = "RCTANK_ROCKET" },
            [74] = { name = "BOMB_WATER" },
            [75] = { name = "BOMB_WATER_SECONDARY" },
            [76] = { name = "_0xF728C4A9" },
            [77] = { name = "_0xBAEC056F" },
            [78] = { name = "FLASHGRENADE" },
            [79] = { name = "STUNGRENADE" },
            [80] = { name = "_0x763D3B3B" },
            [81] = { name = "SCRIPT_MISSILE_LARGE" },
            [82] = { name = "SUBMARINE_BIG" }
        }

        function isExplosionBlacklisted(id)
            for v, k in ipairs(BlacklistedExplosion) do
                if tonumber(id) == tonumber(k) then
                    return true
                end
            end
            return false
        end

        function is_numeric(x)
            if tonumber(x) ~= nil then
                return true
            end
            return false
        end

        AddEventHandler('explosionEvent', function(source, ev)
            local pos = vector3(ev.posX, ev.posY, ev.posZ)
            local distance = #(pos - GetEntityCoords(GetPlayerPed(source)))
            if config.Explosions.Enabled ~= true then return end
            if isExplosionBlacklisted(ev.explosionType) then
                CancelEvent()
                if (config.Explosions.Distance ~= nil or config.Explosions.Distance ~= "nil" or config.Explosions.Distance ~= 'nil') and is_numeric(config.Explosions.Distance) then
                    if tonumber(config.Explosions.Distance) < distance then
                        CancelEvent()
                        ByeModder(source, "Player tried to spawn an exposion over distance: " .. distance)
                    end
                end
                secTriggerClient("imo:request", source)
                Citizen.Wait(2000)
                local ids = ExtractIdentifiers(source)
                local sourceId = source
                local datas = screenshotCache[tonumber(sourceId)]
                if datas == nil then
                    datas = {
                        screenshot =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png"
                    }
                end
                local a = datas.screenshot ~= nil and datas.screenshot or
                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png"
                local playerSteam = ids.steam
                local playerLicense = ids.license
                local playerDisc = ids.discord
                local playerIP = ids.ip
                local explsionEmbed = {
                    {
                        ["author"] = {
                            name = "Elfbar-Security Anticheat",
                            url = "https://github.com/flowzilla/Elfbar-Security-FiveM-Anticheat",
                            icon_url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        ["color"] = "16711680",
                        ["title"] = "Player spawned a Explosion",
                        ["image"] = { url = a },
                        ["description"] = "**__Explosion Infos:__** \n"
                            .. "**Explosion Type:** " .. ExplosionsList[ev.explosionType].name .. "\n"
                            .. "**Damage Scale:** " .. ev.damageScale .. "\n"
                            .. "**Explosion Type:** " .. ev.explosionType .. "\n"
                            .. "**Is Audible:** " .. tostring(ev.isAudible) .. "\n"
                            .. "**Is Invisible:** " .. tostring(ev.isInvisible) .. "\n"
                            .. "**__Player Identifiers:__** \n\n"
                            .. "**ID:** " .. source .. "\n"
                            .. "**Username:** " .. GetPlayerName(source) .. "\n"
                            .. "**Discord:** " .. playerDisc .. " \n"
                            .. "**Steam:** " .. playerSteam .. " \n"
                            .. "**License:** " .. playerLicense .. " \n"
                            .. "**IP:** " .. (config.EnableIPLogs.Enabled and "||" .. playerIP .. "||" or "Disabled"),
                        ["thumbnail"] = {
                            url =
                            "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                        },
                        ["footer"] = {
                            ["text"] = "panel.elfbar-security.eu " .. os.date("%x %X %p"),
                        },
                    }
                }
                PerformHttpRequest(config.Explosions.Webhook, function(a, text) end, "POST",
                    json.encode({
                        username = "Elfbar-Security - FiveM Anticheat",
                        avatar_url =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                        embeds = explsionEmbed
                    }), { ["Content-Type"] = "application/json" })
                if hasAllPerms(source) then return end

                if config.Explosions.Ban then
                    ByeModder(source,
                        'Tried to spawn Blacklisted Explosion, Type: ' .. ExplosionsList[ev.explosionType].name)
                end
                if config.Explosions.Kick then
                    DropPlayer(source,
                        'Tried to spawn Blacklisted Explosion, Type: ' .. ExplosionsList[ev.explosionType].name)
                end
            end
        end)

        AddEventHandler("clearPedTasksEvent", function(source, data)
            if config.ClearPedTask.Enabled ~= true then return end
            if data.immediately then
                CancelEvent()
                ByeModder(source, "Tried to ClearPedTask")
            else
                CancelEvent()
            end
            if DoesEntityExist((NetworkGetEntityFromNetworkId(data.pedId))) and NetworkGetEntityOwner((NetworkGetEntityFromNetworkId(data.pedId))) ~= tonumber(source) then
                CancelEvent()
            end
        end)


        AddEventHandler('removeAllWeaponsEvent', function(source, data)
            if config.Weapon.Enabled then
                if config.AntiRemoveWeapon.Enabled ~= true then return end
                CancelEvent()
                if hasAllPerms(source) then return end
                ByeModder(source, 'Player tried to remove all weapons')
                Globalban(source, "Player tried to remove all weapons")
            end
        end)


        AddEventHandler('removeWeaponEvent', function(source, data)
            if config.Weapon.Enabled then
                if config.AntiRemoveWeapon.Enabled ~= true then return end
                CancelEvent()
                if hasAllPerms(source) then return end
                ByeModder(source, 'Player tried to remove Weapon')
                Globalban(source, "Player tried to remove Weapon")
            end
        end)


        AddEventHandler('giveWeaponEvent', function(source, data)
            if config.Weapon.Enabled then
                if config.AntiGiveWeapon.Enabled ~= true then return end
                CancelEvent()
                if hasAllPerms(source) then return end
                if data.givenAsPickup == false then
                    ByeModder(source, 'Player tried to give Weapon')
                    Globalban(source, "Tried to give Weapon")
                end
            end
        end)


        local resourceList = {}
        local allResources = GetNumResources()
        function listen()
            resourceList = {}
            allResources = GetNumResources()
            for i = 0, allResources, (1) do
                local resource_name = GetResourceByFindIndex(i)
                if resource_name and GetResourceState(resource_name) == "started" then
                    table.insert(resourceList, resource_name)
                end
            end
            AddEventHandler('onResourceStart', function(resourceName)
                resourceList = {}
                allResources = GetNumResources()
                for i = 0, allResources, (1) do
                    local resource_name = GetResourceByFindIndex(i)
                    if resource_name and GetResourceState(resource_name) == "started" then
                        table.insert(resourceList, resource_name)
                    end
                end
            end)
        end

        RegisterNetEvent("fs:check2")
        AddEventHandler("fs:check2", function(getResource, t2)
            local id = source
            local found = false
            for k, name in pairs(resourceList) do
                if getResource == name then
                    found = true
                end
            end
            if not found and t2 == "trigger" then
                ByeModder(id, "Player tried to execute an Event with an executor")
                Globalban(id, "Tried to execute an Event with an executor")
            else
                if not found and t2 == "mod" then
                    ByeModder(id, "Player tried to inject an mod menu [AntiInjectV3]")
                end
            end
        end)


        AddEventHandler('onResourceStart', function(resourceName)
            Citizen.Wait(1000)
            if GetCurrentResourceName() == resourceName then
                if config.System.Enabled then
                    for k, trigger in pairs(BlacklistedEventList) do
                        RegisterServerEvent(trigger)
                        AddEventHandler(trigger, function()
                            ByeModder(source, "Blacklisted Trigger: " .. trigger)
                            CancelEvent()
                        end)
                    end
                end
            end
        end)

        function table.find(tbl, value)
            for i, v in ipairs(tbl) do
                if v == value then
                    return i
                end
            end
        end

        local lastStoppedResource = {}
        local lastRestart = os.time()
        AddEventHandler('onResourceStop', function(resourceName)
            table.insert(lastStoppedResource, resourceName)
            Citizen.Wait(7000)
            local index = table.find(lastStoppedResource, resourceName)
            if index then
                table.remove(lastStoppedResource, index)
            end
        end)


        RegisterNetEvent("imo:checkEventStopped")
        AddEventHandler("imo:checkEventStopped", function(resourceName)
            local sourceID = source
            Citizen.Wait(1000)
            local resourceFound = false
            if lastRestart + 6 > tonumber(os.time()) then
                resourceFound = true
            else
                for i = 1, #lastStoppedResource do
                    if lastStoppedResource[i] == resourceName then
                        resourceFound = true
                        break
                    end
                end
                if not resourceFound then
                    ByeModder(sourceID, "Player tried to stop an resource: " .. resourceName)
                    Globalban(sourceID, "Player tried to stop an resource with a Exec")
                end
            end
        end)



        Citizen.CreateThread(function()
            chatBeforeBlock = {}
            while true do
                Citizen.Wait(config.ChatTime.Time)
                chatBeforeBlock = {}
            end
        end)


        AddEventHandler("chatMessage", function(source, q, a5)
            if config.System.Enabled then
                if config.Messages.Enabled then
                    for j, q in pairs(BlacklistedMessages) do
                        if string.match(a5:lower(), q:lower()) then
                            ByeModder(source, "Player wrote a blacklisted message: " .. q)
                            CancelEvent()
                        end
                        Citizen.Wait(10)
                    end
                elseif config.AntiChatSpam.Enabled then
                    chatBeforeBlock[source] = (chatBeforeBlock[source] or 0) + 1
                    if chatBeforeBlock[source] > tonumber(config.MessagesLimit.Limit) then
                        ByeModder(source,
                            "Player send more than " .. tonumber(config.MessagesLimit.Limit) .. " messages in " ..
                            tonumber(config.ChatTime.Time) .. "ms")
                        chatBeforeBlock[source] = 0
                        CancelEvent()
                    end
                end
                Citizen.Wait(10)
            end
        end)


        function GetEntityOwner(entity)
            if (not DoesEntityExist(entity)) then
                return nil
            end
            local owner = NetworkGetEntityOwner(entity)
            if (GetEntityPopulationType(entity) ~= 7) then return nil end
            return owner
        end

        Citizen.CreateThread(function()
            explosionsSpawned = {}
            vehiclesSpawned = {}
            pedsSpawned = {}
            entitiesSpawned = {}
            particlesSpawned = {}
            while true do
                Citizen.Wait(12000)
                explosionsSpawned = {}
                vehiclesSpawned = {}
                pedsSpawned = {}
                entitiesSpawned = {}
                particlesSpawned = {}
            end
        end)
        local BlacklistedPropList = {}

        AddEventHandler('onResourceStart', function(resourceName)
            Citizen.Wait(1000)
            if GetCurrentResourceName() == resourceName then
                for k, v in pairs(BlacklistedVehicles) do
                    table.insert(BlacklistedPropList, v)
                end
            end
        end)


        inTable = function(table, item)
            for k, v in pairs(table) do
                if GetHashKey(k) == item then return true end
            end
            return false
        end


        function GetVehicleModelName(model)
            for _, name in ipairs(BlacklistedVehicles) do
                if GetHashKey(name) == model then
                    return name
                end
            end
            return "Unknown"
        end

        function GetPedModelName(model)
            for _, name in ipairs(BlacklistedPeds) do
                if GetHashKey(name) == model then
                    return name
                end
            end
            return "Unknown"
        end

        AddEventHandler("entityCreating", function(entity)
            if config.System.Enabled ~= true then return end
            if config.Nuke.Enabled ~= true then return end
            local _src = NetworkGetEntityOwner(entity)
            if DoesEntityExist(entity) then
                local model = GetEntityModel(entity)
                local _entitytype = GetEntityPopulationType(entity)
                local vehicleName = GetVehicleModelName(model)
                local pedName = GetPedModelName(model)
                if _src == nil then
                    CancelEvent()
                end
                if config.Vehicles.Enabled ~= true then return end
                if GetEntityType(entity) == 2 then
                    if _entitytype == 6 or _entitytype == 7 then
                        if model ~= 0 then
                            vehiclesSpawned[_src] = (vehiclesSpawned[_src] or 0) + 1
                            if vehiclesSpawned[_src] > tonumber(config.MaxVehiclesPerUser.Value) then
                                ByeModder(_src, "Player spawned " .. vehiclesSpawned[_src] .. " vehicles")
                                vehiclesSpawned[_src] = 0
                                CancelEvent()
                                if not config.Debug.Enabled then
                                    if not hasAllPerms(_src) then
                                        TriggerClientEvent("cc:veh", -1, _src)
                                        CancelEvent()
                                    end
                                else
                                    TriggerClientEvent("cc:veh", -1, _src)
                                    CancelEvent()
                                end
                            end
                            if inTable(BlacklistedPropList, model) ~= false and modelName ~= "Unknown" then
                                ByeModder(_src, "Player spawned an blacklisted vehicle: " .. vehicleName)
                                if not config.Debug.Enabled then
                                    if not hasAllPerms(_src) then
                                        DeleteEntity(entity)
                                        CancelEvent()
                                    end
                                else
                                    DeleteEntity(entity)
                                    CancelEvent()
                                end
                            end
                        end
                    end
                elseif GetEntityType(entity) == 1 then
                    if _entitytype == 6 or _entitytype == 7 then
                        if model ~= 0 or model ~= 225514697 then
                            pedsSpawned[_src] = (pedsSpawned[_src] or 0) + 1
                            if pedsSpawned[_src] > tonumber(config.MaxPedsPerUser.Value) then
                                ByeModder(_src, "Player spawned " .. pedsSpawned[_src] .. " peds")
                                pedsSpawned[_src] = 0
                                if not config.Debug.Enabled then
                                    if not hasAllPerms(_src) then
                                        TriggerClientEvent("cc:peds", -1)
                                        CancelEvent()
                                    end
                                else
                                    TriggerClientEvent("cc:peds", -1)
                                    CancelEvent()
                                end
                            end
                            if inTable(BlacklistedPropList, model) ~= false and modelName ~= "Unknown" then
                                ByeModder(_src, "Player spawned an blacklisted ped : " .. pedName)
                                if not config.Debug.Enabled then
                                    if not hasAllPerms(_src) then
                                        DeleteEntity(entity)
                                        CancelEvent()
                                    end
                                else
                                    DeleteEntity(entity)
                                    CancelEvent()
                                end
                            end
                        end
                    end
                end
            end
        end)

        ESX = nil


        if config.UseESXLegacy.Enabled then
            ESX = exports["es_extended"]:getSharedObject()
        else
            TriggerEvent(config.ShardObjectESX.Message, function(obj) ESX = obj end)
        end

        RegisterServerEvent("ckk:inv")
        AddEventHandler("ckk:inv", function(gun)
            local _source = source
            local status = checkWeaponESX(source, gun)
            TriggerClientEvent("inv:check", _source, gun, status)
        end)

        function checkWeaponESX(src, weapon)
            local xPlayer = ESX.GetPlayerFromId(src)
            return xPlayer.hasWeapon(weapon)
        end

        AddEventHandler('weaponDamageEvent', function(source, ev)
            local ped = GetPlayerPed(source)
            local weapon = GetSelectedPedWeapon(ped)
            if ev.weaponDamage > 5000 and ev.weaponDamage < 9000 and config.AntiMassDamage.Enabled then
                ByeModder(source, "Player tried to modify his damage: " .. ev.weaponDamage)
                CancelEvent()
            else
                if ev.weaponDamage > 9000 and config.AntiRageBot.Enabled then
                    ByeModder(source, "Player tried to Ragebot")
                    CancelEvent()
                end
                if ev.weaponDamage == 0 and config.AntiExecutorTaze.Enabled then
                    CancelEvent()
                else
                    if ev.weaponDamage == 272 and config.AntiEulenKill.Enabled then
                        CancelEvent()
                    end
                end
            end
        end)


        AddEventHandler('weaponDamageEvent', function(sender, data)
            if data.weaponType == 133987706 then
                CancelEvent()
            end
            if data.weaponType == 133987706 and data.damageTime > 200000 and data.weaponDamage > 200 then
                if config.AntiEulenKill.Enabled then
                    ByeModder(sender, "Player tried to kill Player with Skript.gg")
                    CancelEvent()
                end
            end
        end)

        local lastHeartbeat = {}
        RegisterServerEvent('heartbeat')
        AddEventHandler('heartbeat', function()
            local source = source
            lastHeartbeat[source] = os.time()
        end)

        Citizen.CreateThread(function()
            while true do
                Citizen.Wait(3000)
                for k, v in pairs(lastHeartbeat) do
                    if os.time() - v > 6 then
                        if config.HeartbeatSystem.Enabled then
                            DropPlayer(k, "Heartbeat didn't received in time (Hearbeat System)")
                        end
                    end
                end
            end
        end)


        function BanPlayer(id, reason)
            ByeModder(source, id, reason)
        end

        RegisterNetEvent("imo:checkIsAdmin")
        AddEventHandler("imo:checkIsAdmin", function()
            local source = source
            if hasMenuPerms(source) then
                TriggerClientEvent("imo:allowToOpen", source)
            end
        end)



        RegisterNetEvent('imo:logAdminMenu', function(action)
            local data = {
                action = action,
                admin = GetPlayerName(source),
                license = GetPlayerIdentifierByType(source, 'license')
            }

            local secscreenlEmbed = {
                {
                    ["author"] = {
                        ["name"] = "Elfbar-Security Anticheat",
                        ["url"] = "https://panel.elfbar-security.eu",
                        ["icon_url"] =
                        "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    color = "16711680",
                    title = "Admin Menu Logs",
                    description = "**__An admin has used the menu__** \n\n"
                        .. "**Username:** " .. data.admin .. "\n"
                        .. "**Action:** " .. data.action .. " \n",
                    ["thumbnail"] = {
                        url = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png"
                    },
                    ["image"] = {
                        url = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png"
                    },
                    ["footer"] = {
                        ["text"] = "Elfbar-Security | 2023-2024",
                    },
                }
            }
            PerformHttpRequest(config.Admin.Webhook, function(error, texto, cabeceras) end, "POST",
                json.encode({
                    username = "Elfbar-Security - FiveM Anticheat",
                    avatar_url =
                    "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/pcn2sxpn.png",
                    embeds = secscreenlEmbed
                }), { ["Content-Type"] = "application/json" })
        end)

        RegisterNetEvent('imo:getPlayers', function()
            local data = {}
            for k, v in pairs(GetPlayers()) do
                table.insert(data,
                    { id = v, player = GetPlayerName(v), steamID = GetPlayerIdentifierByType(v, "steam") or "Not Found" })
            end
            TriggerClientEvent('imo:playersResp', source, data)
        end)

        RegisterNetEvent('imo:deleteVehicles', function()
            for i, veh in pairs(GetAllVehicles()) do
                DeleteEntity(veh)
            end
        end)

        RegisterNetEvent('imo:banPlayer', function(id, reason)
            BanPlayer(id, reason)
        end)

        RegisterNetEvent('imo:requestPlayerScreenshot', function(id)
            TriggerClientEvent('imo:screenshotPlayer', id)
        end)


        RegisterNetEvent('imo:deletePeds', function()
            for i, ped in pairs(GetAllPeds()) do
                DeleteEntity(ped)
            end
        end)
        RegisterNetEvent('imo:deleteObjects', function()
            for i, obj in pairs(GetAllObjects()) do
                DeleteEntity(obj)
            end
        end)
        RegisterNetEvent('imo:deleteAll', function()
            for i, obj in pairs(GetAllObjects()) do
                DeleteEntity(obj)
            end
            for i, ped in pairs(GetAllPeds()) do
                DeleteEntity(ped)
            end
            for i, veh in pairs(GetAllVehicles()) do
                DeleteEntity(veh)
            end
        end)

        RegisterNetEvent('imo:unban', function(banId)
            siteunban(source, { banId })
        end)
    else
        Wait(5000)
        StartAc()
    end
end
