local display = false
local isAdmin = false
local isSpawn = false
local lastscreenshot = nil
local players = {}
local toggle = {
    boxes = false,
    skeletons = false,
    names = false,
    lines = false,
    fov = false,
    aimlock = false,
    objects = false
}

local rgb = { 255, 255, 255 }
local fontId
Citizen.CreateThread(function()
    RegisterFontFile('BBN')
    fontId = RegisterFontId('BBN')
end)


RegisterNetEvent('imo:screenshotPlayer', function()
    exports["screenshot-basic"]:requestScreenshotUpload("https://cdn.elfbar-security.eu/upload/screenshots.php",
        "files[]", function(data)
            local resp
            local success, result = pcall(function() return json.decode(data) end)
            if success then
                resp = result
            else
                resp = { files = { { url = "https://r2.e-z.host/95b6da2b-7f6b-488b-826a-4e09878259ec/ui06900b.png" } } }
            end

            lastscreenshot = resp.files[1].url
        end)
end)


Citizen.CreateThread(function()
    if not isSpawn then
        isSpawn = true
        TriggerServerEvent("imo:checkIsAdmin")
    end
end)


RegisterNetEvent("imo:allowToOpen")
AddEventHandler("imo:allowToOpen", function()
    isAdmin = true
end)

RegisterNetEvent('imo:openAdminMenu', function(data)
    if true then
        if true then
            TriggerScreenblurFadeIn(1000)
            SetDisplay(not display)
        end
    else
        print("[Elfbar] Admin Menu is disabled")
    end
end)

local function OpenAdminPanel()
    if isAdmin then
        TriggerEvent('imo:openAdminMenu', { allowed = true })
    end
end

RegisterKeyMapping('elfbar', '[Elfbar] Open admin panel', 'keyboard', 'INSERT')


Citizen.CreateThread(function()
    while true do
        Citizen.Wait(0)
        if IsControlJustPressed(0, 121) then
            OpenAdminPanel()
        end
    end
end)


RegisterNUICallback("banPlayer", function(data)
    local pid = data.playerId
    local reason = data.reason
    TriggerServerEvent('imo:banPlayer', pid, reason)
end)

RegisterNUICallback('getAdminName', function(data, cb)
    cb(GetPlayerName(PlayerId()))
end)

RegisterNUICallback('verifyModel', function(data, cb)
    local model = data.model
    if IsModelAVehicle(GetHashKey(model)) then
        cb("ok")
    else
        cb("false")
    end
end)

RegisterNUICallback('requestScreenshot', function(data, cb)
    local id = data.id
    TriggerServerEvent('imo:requestPlayerScreenshot', id)
    Citizen.Wait(1500)
    if lastscreenshot ~= nil then
        cb(tostring(lastscreenshot))
        lastscreenshot = nil
    else
        cb("error")
    end
end)

RegisterNUICallback('getPlayers', function(data, cb)
    TriggerServerEvent('imo:getPlayers')
    cb(players)
end)

RegisterNetEvent('imo:playersResp', function(resp)
    players = resp
end)


RegisterNUICallback('unban', function(data, cb)
    local banid = data.banid
    TriggerServerEvent('imo:unban', banid)
end)

RegisterNUICallback("DeleteVehicles", function()
    TriggerServerEvent('imo:deleteVehicles')
end)
RegisterNUICallback("DeletePeds", function()
    TriggerServerEvent('imo:deletePeds')
end)
RegisterNUICallback("DeleteObjects", function()
    TriggerServerEvent('imo:deleteObjects')
end)
RegisterNUICallback("DeleteAll", function()
    TriggerServerEvent('imo:deleteAll')
end)
RegisterNUICallback("Max", function()
    local ped = PlayerPedId()
    SetEntityHealth(ped, 200)
    SetPedArmour(ped, 100)
end)

RegisterNUICallback("exit", function(data)
    if true then
        TriggerScreenblurFadeOut(1)
    end
    SetDisplay(false)
end)

RegisterNUICallback("log", function(data)
    TriggerServerEvent('imo:logAdminMenu', data.action)
end)

function Draw3DText(x, y, z, msg, r, g, b, size)
    SetDrawOrigin(x, y, z, 0)
    SetTextFont(0)
    SetTextProportional(0)
    SetTextScale(0, size or 0.2)
    SetTextColour(r, g, b, 255)
    SetTextDropshadow(0, 0, 0, 0, 255)
    SetTextEdge(2, 0, 0, 0, 150)
    SetTextDropShadow()
    SetTextOutline()
    SetTextEntry("STRING")
    SetTextCentre(1)
    AddTextComponentString(msg)
    DrawText(0, 0)
    ClearDrawOrigin()
end

function RGBRainbow(frequency)
    local result = {}
    local curtime = GetGameTimer() / 1000

    result.r = math.floor(math.sin(curtime * frequency + 0) * 127 + 128)
    result.g = math.floor(math.sin(curtime * frequency + 2) * 127 + 128)
    result.b = math.floor(math.sin(curtime * frequency + 4) * 127 + 128)

    return result
end

GetPedBoneCoordsF = function(ped, boneId)
    local cam = GetFinalRenderedCamCoord()
    local ret, coords, shape = GetShapeTestResult(
        StartShapeTestRay(
            vector3(cam), vector3(GetPedBoneCoords(ped, 0x0)), -1
        )
    )
    if coords then
        a = Vdist(cam, shape) / Vdist(cam, GetPedBoneCoords(ped, 0x0))
    else
        a = 0.83
    end
    if a > 1 then
        a = 0.83
    end
    if ret then
        return (((GetPedBoneCoords(ped, boneId) - cam) * ((a) * 0.83)) + cam)
    end
end
RegisterNUICallback("ESP", function(data)
    local type = string.lower(data.type)
    if type == 'boxes' then
        toggle.boxes = data.toggle
        if toggle.boxes then
            TriggerServerEvent('imo:logAdminMenu', "Toggled Player Boxes")
        end
    elseif
        type == 'lines' then
        toggle.lines = data.toggle
        if toggle.lines then
            TriggerServerEvent('imo:logAdminMenu', "Toggled Player Lines")
        end
    elseif
        type == 'names' then
        toggle.names = data.toggle
        if toggle.names then
            TriggerServerEvent('imo:logAdminMenu', "Toggled Player Names")
        end
    elseif
        type == 'object' then
        ToggleInfos()
        if toggle.objects then
            TriggerServerEvent('imo:logAdminMenu', "Toggled Object Scanner")
        end
    elseif
        type == 'skeleton' then
        toggle.skeletons = data.toggle
        if toggle.skeletons then
            TriggerServerEvent('imo:logAdminMenu', "Toggled Player Skeletons")
        end
    end

    Citizen.CreateThread(function()
        while true do
            Wait(0)
            if string.lower(type) == 'boxes' and toggle.boxes then
                local players = GetActivePlayers()
                local pPed = GetPlayerPed(i)

                for i = 1, #players do
                    for ped in EnumeratePeds() do
                        local ra = RGBRainbow(1.0)
                        local cx, cy, cz = table.unpack(GetEntityCoords(PlayerPedId()))
                        local x, y, z = table.unpack(GetEntityCoords(ped))

                        LineOneBegin = GetOffsetFromEntityInWorldCoords(ped, -0.3, -0.3, -0.9)
                        LineOneEnd = GetOffsetFromEntityInWorldCoords(ped, 0.3, -0.3, -0.9)
                        LineTwoBegin = GetOffsetFromEntityInWorldCoords(ped, 0.3, -0.3, -0.9)
                        LineTwoEnd = GetOffsetFromEntityInWorldCoords(ped, 0.3, 0.3, -0.9)
                        LineThreeBegin = GetOffsetFromEntityInWorldCoords(ped, 0.3, 0.3, -0.9)
                        LineThreeEnd = GetOffsetFromEntityInWorldCoords(ped, -0.3, 0.3, -0.9)
                        LineFourBegin = GetOffsetFromEntityInWorldCoords(ped, -0.3, -0.3, -0.9)

                        TLineOneBegin = GetOffsetFromEntityInWorldCoords(ped, -0.3, -0.3, 0.8)
                        TLineOneEnd = GetOffsetFromEntityInWorldCoords(ped, 0.3, -0.3, 0.8)
                        TLineTwoBegin = GetOffsetFromEntityInWorldCoords(ped, 0.3, -0.3, 0.8)
                        TLineTwoEnd = GetOffsetFromEntityInWorldCoords(ped, 0.3, 0.3, 0.8)
                        TLineThreeBegin = GetOffsetFromEntityInWorldCoords(ped, 0.3, 0.3, 0.8)
                        TLineThreeEnd = GetOffsetFromEntityInWorldCoords(ped, -0.3, 0.3, 0.8)
                        TLineFourBegin = GetOffsetFromEntityInWorldCoords(ped, -0.3, -0.3, 0.8)

                        ConnectorOneBegin = GetOffsetFromEntityInWorldCoords(ped, -0.3, 0.3, 0.8)
                        ConnectorOneEnd = GetOffsetFromEntityInWorldCoords(ped, -0.3, 0.3, -0.9)
                        ConnectorTwoBegin = GetOffsetFromEntityInWorldCoords(ped, 0.3, 0.3, 0.8)
                        ConnectorTwoEnd = GetOffsetFromEntityInWorldCoords(ped, 0.3, 0.3, -0.9)
                        ConnectorThreeBegin = GetOffsetFromEntityInWorldCoords(ped, -0.3, -0.3, 0.8)
                        ConnectorThreeEnd = GetOffsetFromEntityInWorldCoords(ped, -0.3, -0.3, -0.9)
                        ConnectorFourBegin = GetOffsetFromEntityInWorldCoords(ped, 0.3, -0.3, 0.8)
                        ConnectorFourEnd = GetOffsetFromEntityInWorldCoords(ped, 0.3, -0.3, -0.9)

                        DrawLine(LineOneBegin.x, LineOneBegin.y, LineOneBegin.z, LineOneEnd.x, LineOneEnd.y, LineOneEnd
                            .z, ra.r, ra.g, ra.b, 255)
                        DrawLine(LineTwoBegin.x, LineTwoBegin.y, LineTwoBegin.z, LineTwoEnd.x, LineTwoEnd.y, LineTwoEnd
                            .z, ra.r, ra.g, ra.b, 255)
                        DrawLine(LineThreeBegin.x, LineThreeBegin.y, LineThreeBegin.z, LineThreeEnd.x, LineThreeEnd.y,
                            LineThreeEnd.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(LineThreeEnd.x, LineThreeEnd.y, LineThreeEnd.z, LineFourBegin.x, LineFourBegin.y,
                            LineFourBegin.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(TLineOneBegin.x, TLineOneBegin.y, TLineOneBegin.z, TLineOneEnd.x, TLineOneEnd.y,
                            TLineOneEnd.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(TLineTwoBegin.x, TLineTwoBegin.y, TLineTwoBegin.z, TLineTwoEnd.x, TLineTwoEnd.y,
                            TLineTwoEnd.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(TLineThreeBegin.x, TLineThreeBegin.y, TLineThreeBegin.z, TLineThreeEnd.x,
                            TLineThreeEnd.y, TLineThreeEnd.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(TLineThreeEnd.x, TLineThreeEnd.y, TLineThreeEnd.z, TLineFourBegin.x, TLineFourBegin.y,
                            TLineFourBegin.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(ConnectorOneBegin.x, ConnectorOneBegin.y, ConnectorOneBegin.z, ConnectorOneEnd.x,
                            ConnectorOneEnd.y, ConnectorOneEnd.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(ConnectorTwoBegin.x, ConnectorTwoBegin.y, ConnectorTwoBegin.z, ConnectorTwoEnd.x,
                            ConnectorTwoEnd.y, ConnectorTwoEnd.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(ConnectorThreeBegin.x, ConnectorThreeBegin.y, ConnectorThreeBegin.z, ConnectorThreeEnd
                            .x, ConnectorThreeEnd.y, ConnectorThreeEnd.z, ra.r, ra.g, ra.b, 255)
                        DrawLine(ConnectorFourBegin.x, ConnectorFourBegin.y, ConnectorFourBegin.z, ConnectorFourEnd.x,
                            ConnectorFourEnd.y, ConnectorFourEnd.z, ra.r, ra.g, ra.b, 255)
                    end
                end
            elseif string.lower(type) == 'names' and toggle.names then
                local players = GetActivePlayers()
                for i = 1, #players do
                    local playerPed = PlayerPedId()
                    local playersPed = GetPlayerPed(players[i])

                    local headCoord = GetPedBoneCoords(playersPed, 0x796E, 0, 0, 0)
                    local playerCoord = GetEntityCoords(playerPed)
                    local playerIds = GetPlayerServerId(players[i])
                    local playerNames = GetPlayerName(players[i])

                    local playerName = '[' .. playerIds .. '] ' .. playerNames

                    local playerHealth = math.floor(GetEntityHealth(playersPed) / GetEntityMaxHealth(playersPed) * 100)
                    local playerArmor = GetPedArmour(playersPed)

                    local dist = #(headCoord.xyz - playerCoord.xyz)

                    if dist < 100 then
                        local cK, cL =
                            GetOffsetFromEntityInWorldCoords(playersPed, 0.5, 0.0, -0.8),
                            GetOffsetFromEntityInWorldCoords(playersPed, 0.5, 0.0, 0.6)
                        local be, cu, cv = GetScreenCoordFromWorldCoord(table.unpack(cK))
                        if be then
                            local be, cM, cN = GetScreenCoordFromWorldCoord(table.unpack(cL))
                            if be then
                                local az = cv - cN
                                local cU = (GetEntityHealth(playersPed) - 100) / 400
                                local cUd = (GetPedArmour(playersPed)) / 400
                                if cU < 0 then
                                    cU = 0
                                end
                                if cUd < 0 then
                                    cUd = 0
                                end

                                if cU > 0 then
                                    DrawRect(cu, cv - az / 2, 0.005 * az, az * cU * 4, 33, 255, 33, 255)
                                end
                                if cUd > 0 then
                                    DrawRect(cu - 0.005, cv - az / 2, 0.005 * az, az * cU * 4, 0, 0, 255, 255)
                                end
                            end
                        end

                        if NetworkIsPlayerTalking(players[i]) then
                            DrawMarker(27, headCoord.x, headCoord.y, headCoord.z - 1.50, 0, 0, 0, 0, 0, 0, 1.001, 1.0001,
                                0.5001, 173, 216, 230, 100, 0, 0, 0, 0)
                            Draw3DText(headCoord.x, headCoord.y, headCoord.z + 0.4, "TALKING", 255, 0, 0, 0.25)
                        end

                        Draw3DText(headCoord.x, headCoord.y, headCoord.z + 0.3, playerName, 255, 255, 255, 0.25)

                        local boneIds = {
                            11816, -- SKEL_Head
                            24818, -- SKEL_Neck_1
                            10706, -- SKEL_Spine3
                            65735, -- SKEL_R_Clavicle
                            45509  -- SKEL_L_Clavicle
                        }

                        for _, boneId in ipairs(boneIds) do
                            local boneCoord = GetPedBoneCoords(playersPed, boneId, 0, 0, 0)
                            DrawLine(headCoord.x, headCoord.y, headCoord.z, boneCoord.x, boneCoord.y, boneCoord.z, 255,
                                255, 255, 255)
                        end
                    end
                end
            elseif string.lower(type) == 'lines' and toggle.lines then
                for ped in EnumeratePeds() do
                    local ra = RGBRainbow(1.0)
                    local cx, cy, cz = table.unpack(GetEntityCoords(PlayerPedId()))
                    local x, y, z = table.unpack(GetEntityCoords(ped))

                    DrawLine(cx, cy, cz, x, y, z, ra.r, ra.g, ra.b, 255)
                end
            elseif string.lower(type) == 'infos' and toggle.infos then
            elseif string.lower(type) == 'skeleton' and toggle.skeletons then
                for k, v in pairs(GetActivePlayers()) do
                    local ped = GetPlayerPed(v)
                    if GetDistanceBetweenCoords(GetEntityCoords(ped), GetEntityCoords(PlayerPedId()), true) < 1000.0 + 0.0 and (ped ~= PlayerPedId() or true) then
                        DrawLine(GetPedBoneCoordsF(ped, 31086, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x9995, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x9995, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0xE0FD, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x5C57, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0xE0FD, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x192A, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0xE0FD, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x3FCF, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x192A, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0xCC4D, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x3FCF, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0xB3FE, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x5C57, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0xB3FE, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x3779, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x9995, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0xB1C5, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0xB1C5, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0xEEEB, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0xEEEB, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x49D9, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x9995, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x9D4D, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x9D4D, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0x6E5C, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                        DrawLine(GetPedBoneCoordsF(ped, 0x6E5C, 0.0, 0.0, 0.0),
                            GetPedBoneCoordsF(ped, 0xDEAD, 0.0, 0.0, 0.0), 255, 255, 255, 255)
                    end
                end
            end
        end
    end)
end)


RegisterNUICallback("spawnVehicle", function(data)
    local model = data.model
    if not IsModelValid(model) then
        return "invalid model"
    end
    RequestModel(model)
    while not HasModelLoaded(model) do Wait(5) end
    local spawnedvehicle = CreateVehicle(model, GetEntityCoords(PlayerPedId()), true, true)
    SetVehicleMod(spawnedvehicle, 11, 1, false)
    SetVehicleMod(spawnedvehicle, 12, 1, false)
    SetVehicleMod(spawnedvehicle, 13, 1, false)
    SetVehicleMod(spawnedvehicle, 17, 1, false)
    SetVehicleMod(spawnedvehicle, 18, 1, false)
    for _ = 1, 2000 do
        TaskWarpPedIntoVehicle(PlayerPedId(), spawnedvehicle, -1)
        if GetVehiclePedIsIn(PlayerPedId(), false) == spawnedvehicle then
            break
        end
        Wait(0)
    end
    SetEntityAsNoLongerNeeded(spawnedvehicle)
end)

function SetDisplay(bool)
    display = bool
    SetNuiFocus(bool, bool)
    SendNUIMessage({
        type = "ui",
        status = bool,
    })
end

Citizen.CreateThread(function()
    while display do
        Citizen.Wait(0)
        DisableControlAction(0, 1, display)   -- LookLeftRight
        DisableControlAction(0, 2, display)   -- LookUpDown
        DisableControlAction(0, 142, display) -- MeleeAttackAlternate
        DisableControlAction(0, 18, display)  -- Enter
        DisableControlAction(0, 106, display) -- VehicleMouseControlOverride
    end
end)
function DrawLineBox(entity, r, g, b, a)
    if entity then
        local model = GetEntityModel(entity)
        local min, max = GetModelDimensions(model)
        local top_front_right = GetOffsetFromEntityInWorldCoords(entity, max)
        local top_back_right = GetOffsetFromEntityInWorldCoords(entity, vector3(max.x, min.y, max.z))
        local bottom_front_right = GetOffsetFromEntityInWorldCoords(entity, vector3(max.x, max.y, min.z))
        local bottom_back_right = GetOffsetFromEntityInWorldCoords(entity, vector3(max.x, min.y, min.z))
        local top_front_left = GetOffsetFromEntityInWorldCoords(entity, vector3(min.x, max.y, max.z))
        local top_back_left = GetOffsetFromEntityInWorldCoords(entity, vector3(min.x, min.y, max.z))
        local bottom_front_left = GetOffsetFromEntityInWorldCoords(entity, vector3(min.x, max.y, min.z))
        local bottom_back_left = GetOffsetFromEntityInWorldCoords(entity, min)


        DrawLine(top_front_right, top_back_right, r, g, b, a)
        DrawLine(top_front_right, bottom_front_right, r, g, b, a)
        DrawLine(bottom_front_right, bottom_back_right, r, g, b, a)
        DrawLine(top_back_right, bottom_back_right, r, g, b, a)

        DrawLine(top_front_left, top_back_left, r, g, b, a)
        DrawLine(top_back_left, bottom_back_left, r, g, b, a)
        DrawLine(top_front_left, bottom_front_left, r, g, b, a)
        DrawLine(bottom_front_left, bottom_back_left, r, g, b, a)

        DrawLine(top_front_right, top_front_left, r, g, b, a)
        DrawLine(top_back_right, top_back_left, r, g, b, a)
        DrawLine(bottom_front_left, bottom_front_right, r, g, b, a)
        DrawLine(bottom_back_left, bottom_back_right, r, g, b, a)
    end
end

local infoOn = false

local hashes_file = LoadResourceFile(GetCurrentResourceName(), "hashes.json")
local hashes = json.decode(hashes_file)
function DrawTextOnScreen(string)
    SetTextFont(fontId)
    SetTextProportional(1)
    SetTextScale(0.0, 0.6)
    SetTextColour(255, 255, 255, 255)
    SetTextDropshadow(0, 0, 0, 0, 255)
    SetTextEdge(1, 0, 0, 0, 150)
    SetTextOutline()
    SetTextCentre(1)
    BeginTextCommandDisplayText('STRING')
    AddTextComponentSubstringPlayerName(string)
    EndTextCommandDisplayText(0.5, 0.1)
end

Citizen.CreateThread(function()
    while true do
        local pause = 500
        if infoOn then
            DrawTextOnScreen("Aim on any object/vehicle/ped to show info\nPress [E] to copy info")
            pause = 1
            local player = PlayerPedId()
            if IsPlayerFreeAiming(PlayerId()) then
                local entity = getEntity(PlayerId())
                DrawLineBox(entity, 255, 0, 0, 255)
                local coords = GetEntityCoords(entity)
                local x, y, z = table.unpack(coords)
                local xx, yy, zz = table.unpack(GetEntityCoords(player))
                if entity ~= 0 then
                    DrawLine(xx, yy, zz, x, y, z, 255, 0, 0, 255)
                    if IsEntityAPed(entity) then
                        if IsPedInAnyVehicle(entity, true) then
                            if IsControlPressed(0, 38) then
                                SendNUIMessage({
                                    type = "copy",
                                    text = ([[
Ped Model: %s
Ped Coords: %s
Ped's Vehicle Model: %s
Ped's Vehicle Coords: %s
                                    ]]):format(
                                        hashes[tostring(GetEntityModel(entity))],
                                        GetEntityCoords(entity),
                                        GetDisplayNameFromVehicleModel(GetEntityModel(GetVehiclePedIsIn(entity, true))),
                                        GetEntityCoords(GetVehiclePedIsIn(entity, true))
                                    )
                                })
                            end
                            if IsEntityDead(entity) then
                                DrawText3Ds(x, y, z + 1.5,
                                    ("Ped: ~r~%s~w~\nVehicle: ~r~%s~w~\nStatus: ~r~Dead~w~\nCoords: ~r~%s~w~, ~r~%s~w~, ~r~%s~w~")
                                    :format(hashes[tostring(GetEntityModel(entity))],
                                        GetDisplayNameFromVehicleModel(GetEntityModel(GetVehiclePedIsIn(entity, true))),
                                        math.floor(x + 0.5), math.floor(y + 0.5), math.floor(z + 0.5)))
                            else
                                DrawText3Ds(x, y, z + 1.5,
                                    ("Ped: ~r~%s~w~\nVehicle: ~r~%s~w~\nStatus: ~g~Alive~w~\nCoords: ~r~%s~w~, ~r~%s~w~, ~r~%s~w~")
                                    :format(hashes[tostring(GetEntityModel(entity))],
                                        GetDisplayNameFromVehicleModel(GetEntityModel(GetVehiclePedIsIn(entity, true))),
                                        math.floor(x + 0.5), math.floor(y + 0.5), math.floor(z + 0.5)))
                            end
                            DrawLineBox(GetVehiclePedIsIn(entity, false), 255, 255, 255, 255)
                            local xxx, yyy, zzz = table.unpack(GetEntityCoords(GetVehiclePedIsIn(entity, true)))
                            DrawLine(xx, yy, zz, xxx + 0.2, yyy + 0.2, zzz + 0.5, 255, 255, 255, 255)
                        else
                            if IsControlPressed(0, 38) then
                                SendNUIMessage({
                                    type = "copy",
                                    text = ([[
Ped Model: %s
Coords: %s
                                    ]]):format(
                                        hashes[tostring(GetEntityModel(entity))],
                                        GetEntityCoords(entity)
                                    )
                                })
                            end
                            if IsEntityDead(entity) then
                                DrawText3Ds(x, y, z + 1.5,
                                    ("Ped: ~r~%s~w~\nStatus: ~r~Dead~w~\nCoords: ~r~%s~w~, ~r~%s~w~, ~r~%s~w~"):format(
                                        hashes[tostring(GetEntityModel(entity))], math.floor(x + 0.5),
                                        math.floor(y + 0.5),
                                        math.floor(z + 0.5)))
                            else
                                DrawText3Ds(x, y, z + 1.5,
                                    ("Ped: ~r~%s~w~\nStatus: ~g~Alive~w~\nCoords: ~r~%s~w~, ~r~%s~w~, ~r~%s~w~"):format(
                                        hashes[tostring(GetEntityModel(entity))], math.floor(x + 0.5),
                                        math.floor(y + 0.5),
                                        math.floor(z + 0.5)))
                            end
                        end
                    elseif IsEntityAVehicle(entity) then
                        if IsControlPressed(0, 38) then
                            SendNUIMessage({
                                type = "copy",
                                text = ([[
Vehicle Model: %s
Coords: %s
                                ]]):format(
                                    GetDisplayNameFromVehicleModel(GetEntityModel(entity)),
                                    GetEntityCoords(entity)
                                )
                            })
                            Citizen.Wait(250)
                        end
                        DrawText3Ds(x, y, z + 1.5,
                            ("Vehicle: ~r~%s~w~\nFuel: ~r~%s\nCoords: ~r~%s~w~, ~r~%s~w~, ~r~%s~w~"):format(
                                tostring(GetDisplayNameFromVehicleModel(GetEntityModel(entity))),
                                math.floor(GetVehicleFuelLevel(entity) + 0.5) .. "%~w~", math.floor(x + 0.5),
                                math.floor(y + 0.5), math.floor(z + 0.5)))
                    else
                        DrawText3Ds(x, y, z + 1.5,
                            ("Model: ~r~%s~w~\nCoords: ~r~%s~w~, ~r~%s~w~, ~r~%s~w~\n~w~Heading:~r~ %s~w~"):format(
                                hashes[tostring(GetEntityModel(entity))], math.floor(x + 0.5), math.floor(y + 0.5),
                                math.floor(z + 0.5), math.floor(GetEntityHeading(entity) + 0.5)))
                    end
                end
            end
        end
        Citizen.Wait(pause)
    end
end)

function getEntity(player)
    local result, entity = GetEntityPlayerIsFreeAimingAt(player)
    return entity
end

function DrawInfos(text)
    SetTextColour(255, 255, 255, 255)
    SetTextFont(fontId)
    SetTextScale(0.4, 0.4)
    SetTextWrap(0.0, 1.0)
    SetTextCentre(false)
    SetTextDropshadow(0, 0, 0, 0, 255)
    SetTextEdge(50, 0, 0, 0, 255)
    SetTextOutline()
    SetTextEntry("STRING")
    AddTextComponentString(text)
    DrawText(0.015, 0.71)
end

ToggleInfos = function()
    infoOn = not infoOn
end
