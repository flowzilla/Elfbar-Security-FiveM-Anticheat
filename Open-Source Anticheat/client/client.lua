local new      = false
local w, h     = GetActiveScreenResolution()
local adbypass = false
local lastCoords = nil
local weapons = {
    GetHashKey('COMPONENT_COMBATPISTOL_CLIP_01'),
    GetHashKey('COMPONENT_COMBATPISTOL_CLIP_02'),
    GetHashKey('COMPONENT_APPISTOL_CLIP_01'),
    GetHashKey('COMPONENT_APPISTOL_CLIP_02'),
    GetHashKey('COMPONENT_MICROSMG_CLIP_01'),
    GetHashKey('COMPONENT_MICROSMG_CLIP_02'),
    GetHashKey('COMPONENT_SMG_CLIP_01'),
    GetHashKey('COMPONENT_SMG_CLIP_02'),
    GetHashKey('COMPONENT_ASSAULTRIFLE_CLIP_01'),
    GetHashKey('COMPONENT_ASSAULTRIFLE_CLIP_02'),
    GetHashKey('COMPONENT_CARBINERIFLE_CLIP_01'),
    GetHashKey('COMPONENT_CARBINERIFLE_CLIP_02'),
    GetHashKey('COMPONENT_ADVANCEDRIFLE_CLIP_01'),
    GetHashKey('COMPONENT_ADVANCEDRIFLE_CLIP_02'),
    GetHashKey('COMPONENT_MG_CLIP_01'),
    GetHashKey('COMPONENT_MG_CLIP_02'),
    GetHashKey('COMPONENT_COMBATMG_CLIP_01'),
    GetHashKey('COMPONENT_COMBATMG_CLIP_02'),
    GetHashKey('COMPONENT_PUMPSHOTGUN_CLIP_01'),
    GetHashKey('COMPONENT_SAWNOFFSHOTGUN_CLIP_01'),
    GetHashKey('COMPONENT_ASSAULTSHOTGUN_CLIP_01'),
    GetHashKey('COMPONENT_ASSAULTSHOTGUN_CLIP_02'),
    GetHashKey('COMPONENT_PISTOL50_CLIP_01'),
    GetHashKey('COMPONENT_PISTOL50_CLIP_02'),
    GetHashKey('COMPONENT_ASSAULTSMG_CLIP_01'),
    GetHashKey('COMPONENT_ASSAULTSMG_CLIP_02'),
    GetHashKey('COMPONENT_AT_RAILCOVER_01'),
    GetHashKey('COMPONENT_AT_AR_AFGRIP'),
    GetHashKey('COMPONENT_AT_PI_FLSH'),
    GetHashKey('COMPONENT_AT_AR_FLSH'),
    GetHashKey('COMPONENT_AT_SCOPE_MACRO'),
    GetHashKey('COMPONENT_AT_SCOPE_SMALL'),
    GetHashKey('COMPONENT_AT_SCOPE_MEDIUM'),
    GetHashKey('COMPONENT_AT_SCOPE_LARGE'),
    GetHashKey('COMPONENT_AT_SCOPE_MAX'),
    GetHashKey('COMPONENT_AT_PI_SUPP'),
}


CreateThread(function()
    while true do
        lastCoords = GetEntityCoords(PlayerPedId())
        Wait(3500)
    end
end)

-- client
local config;

CreateThread(function()
  repeat Wait(0) until NetworkIsSessionStarted();
  TriggerServerEvent(GetCurrentResourceName() .. ":getconfig");
  RegisterNetEvent(GetCurrentResourceName() .. ":getconfig", function(data)
    config = data;
    Start()
  end);
end);



function Start()
    if config then

local function sendScreenshot(message)
    local resp = ""
    if GetResourceState("screenshot-basic") ~= "started" then
        resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
        TriggerServerEvent("imo:report", resp.files[1].url, message, GetActiveScreenResolution(),
            GetEntityHealth(PlayerPedId()), GetPedArmour(PlayerPedId()), w, h)
            return
    else
        exports["screenshot-basic"]:requestScreenshotUpload("https://cdn.elfbar-security.eu/upload/upload.php", "files[]", function(a)
            local resp = json.decode(a)
            if resp == nil then
                resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
            end
            TriggerServerEvent("imo:report", resp.files[1].url, message, GetActiveScreenResolution(),
                GetEntityHealth(PlayerPedId()), GetPedArmour(PlayerPedId()), w, h)
        end)
    end
end


local function sendGlobal(message)
    local resp = ""
    if GetResourceState("screenshot-basic") ~= "started" then
        resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
        TriggerServerEvent("global:ban", resp.files[1].url, message)
            return
    else
        exports["screenshot-basic"]:requestScreenshotUpload("https://cdn.elfbar-security.eu/upload/upload.php", "files[]", function(a)
            local resp = json.decode(a)
            if resp == nil then
                resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
            end
            TriggerServerEvent("global:ban", resp.files[1].url, message)
        end)
    end
end

local MulticharCoords = {}
local inputString = config.MulticharCoords.Coords
local outputTable = {}

for x, y, z in inputString:gmatch("vector3%(([^,]+), ([^,]+), ([^)]+)%)") do
    x, y, z = tonumber(x), tonumber(y), tonumber(z)
    table.insert(MulticharCoords, vector3(x, y, z))
end


        function CheckPlayerInRangee(coords)
            local targetCoord = nil
            if coords == nil then
                targetCoord = MulticharCoords
            else
                targetCoord = coords
            end
            local maxDistance = 10.0
            function GetDistance(coords1, coords2)
                
                return #(coords1 - coords2)
            end

            local playerPed = PlayerPedId()
            local playerCoords = GetEntityCoords(playerPed)
            for v, k in ipairs(MulticharCoords) do
                local distance = GetDistance(playerCoords, k)
                if distance <= maxDistance then
                    return true
                end
            end
            return false
        end


function CheckPlayerSpawnCoords()
    if CheckPlayerInRangee() then
        return true
    end
    return false
end

local VehicleShopCoords = {}
local inputString = config.VehicleShopCoords.Coords
local outputTable = {}

for x, y, z in inputString:gmatch("vector3%(([^,]+), ([^,]+), ([^)]+)%)") do
    x, y, z = tonumber(x), tonumber(y), tonumber(z)
    table.insert(VehicleShopCoords, vector3(x,y,z))
end



function isPlayerInShopRange()
    local targetCoords = VehicleShopCoords
    local maxDistance = 30.0
    function GetDistance(coords1, coords2)
        return #(coords1 - coords2)
    end
    local playerPed = PlayerPedId()
    local playerCoords = GetEntityCoords(playerPed)
    for i = 1, #targetCoords do
        local distance = GetDistance(playerCoords, targetCoords[i])

        if distance <= maxDistance then
            return true
        end
    end
    return false
end

RegisterNUICallback('devtoolsdetected', function()
    if config.NuiDevtools.Enabled ~= true then return end
        sendScreenshot("Player have tried to use nui devtools")
end)


CreateThread(function()
    if config.AmmoCheck.Enabled ~= true then return end
    local playerPed = PlayerPedId()
    while true do
        Wait(5000)
        local _, current = GetCurrentPedWeapon(playerPed, true)
        if current ~= -1569615261 then
            if GetAmmoInPedWeapon(playerPed, current) >= tonumber(config.MaxAmmo.Value) then
            sendScreenshot("Player tried give himself more ammo then possible")
            end
        end
    end
end)


CreateThread(function()
    if config.AntiGiveSafeWeapon.Enabled ~= true then
        return 
    end
    while true do
        Wait(3400)
        local ped = PlayerPedId()
        local _, current = GetCurrentPedWeapon(ped, true)
        if (_ == 1) and (current == -1569615261) then
            RemoveAllPedWeapons(ped, true)
            sendGlobal("Player tried to spawn a Safe Weapon with an Executor")
            sendScreenshot("Player tried to spawn a Safe Weapon")
        end
    end
end)


CreateThread(function()
    if config.AntiSafeVehicleSpawn.Enabled ~= true then return end
    while true do
        Wait(4000)
        local vehicle = GetVehiclePedIsIn(PlayerPedId(), false)
        if DoesEntityExist(vehicle) and not NetworkGetEntityIsNetworked(vehicle) and not isPlayerInShopRange() then
            sendScreenshot("Player tried to spawn an safe vehicle")
            SetEntityAsMissionEntity(vehicle, false, false)
            DetachEntity(vehicle, true, true)
            DeleteEntity(vehicle)
        end
    end
end)

local weaponPickupTypes = {
    "PICKUP_WEAPON_PISTOL",
    "PICKUP_WEAPON_COMBATPISTOL",
    "PICKUP_WEAPON_APPISTOL",
    "PICKUP_WEAPON_MICROSMG",
    "PICKUP_WEAPON_SMG",
    "PICKUP_WEAPON_ASSAULTRIFLE",
    "PICKUP_WEAPON_CARBINERIFLE",
    "PICKUP_WEAPON_ADVANCEDRIFLE",
    "PICKUP_WEAPON_SAWNOFFSHOTGUN",
    "PICKUP_WEAPON_PUMPSHOTGUN",
    "PICKUP_WEAPON_ASSAULTSHOTGUN",
    "PICKUP_WEAPON_SNIPERRIFLE",
    "PICKUP_WEAPON_HEAVYSNIPER",
    "PICKUP_WEAPON_MG",
    "PICKUP_WEAPON_COMBATMG",
    "PICKUP_WEAPON_GRENADELAUNCHER",
    "PICKUP_WEAPON_RPG",
    "PICKUP_WEAPON_MINIGUN",
    "PICKUP_WEAPON_GRENADE",
    "PICKUP_WEAPON_STICKYBOMB",
    "PICKUP_WEAPON_MOLOTOV",
    "PICKUP_WEAPON_PETROLCAN",
    "PICKUP_WEAPON_SMOKEGRENADE",
    "PICKUP_WEAPON_KNIFE",
    "PICKUP_WEAPON_BAT",
    "PICKUP_WEAPON_HAMMER",
    "PICKUP_WEAPON_CROWBAR",
    "PICKUP_WEAPON_GOLFCLUB",
    "PICKUP_WEAPON_NIGHTSTICK",
    "PICKUP_WEAPON_FIREEXTINGUISHER"
}

CreateThread(function()
    if config.Weapon.Enabled ~= true or config.AntiWeaponPickup.Enabled ~= true then return end
    while true do
        Wait(6000)
        for i, weaponPickupType in ipairs(weaponPickupTypes) do
            RemoveAllPickupsOfType(GetHashKey(weaponPickupType))
        end
    end
end)


CreateThread(function()
    while true do
        Wait(2000)
        if config.AntiSuperjumpV2.Enabled and IsPedDoingBeastJump(PlayerPedId()) and not adbypass then
            sendScreenshot("Player tried to Superjump #1")
            return
        end
        if config.AntiSuperJump.Enabled ~= true then return end
        if IsPedJumping(PlayerPedId()) and not adbypass then
            TriggerServerEvent("imo:checkJump")
        end
    end
end)


CreateThread(function()
    if not config.PlayerCheck.Enabled then 
        return 
    end
    while true do
        Wait(500)
        if GetUsingnightvision(true) and not adbypass and config.AntiNightVision.Enabled then
            if not IsPedInAnyHeli(PlayerPedId()) then
                sendScreenshot("Player tried to activate Night Vision")
            end
        end
        if GetUsingseethrough(true) and not IsPedInAnyHeli(PlayerPedId()) and not adbypass and config.AntiThermalVision.Enabled then
            sendScreenshot("Player tried to activate Thermal Vision")
        end
        
    end
end)

CreateThread(function()
    while true do
        Wait(5000)
        local ped = PlayerPedId()
        local armor = GetPedArmour(ped)
        if config.AntiArmor.Enabled then
            if armor > 100 then
                sendScreenshot("Used armor hacks: " .. armor)
            end
        end

        if config.AntiRainbowVehicle.Enabled then
            if IsPedInAnyVehicle(PlayerPedId(), false) then
                local vehicle = GetVehiclePedIsIn(PlayerPedId(), false)
                if DoesEntityExist(vehicle) then
                    local color1red, color1green, color1blue = GetVehicleCustomPrimaryColour(vehicle)
                    Wait(1000)
                    local color2red, color2green, color2blue = GetVehicleCustomPrimaryColour(vehicle)
                    Wait(2000)
                    local color3red, color3green, color3blue = GetVehicleCustomPrimaryColour(vehicle)
                    if color1red ~= nil then
                        if color1red ~= color2red and color2red ~= color3red and color1green ~= color2green and color3green ~= color2green and color1blue ~= color2blue and color3blue ~= color2blue then
                            sendScreenshot("Player tried to activate Rainbow Vehicle")
                        end
                    end
                end
            end
        end
        Wait(2000)
    end
end)

CreateThread(function()
    if config.PlayerCheck.Enabled ~= true then return end
    if config.AntiSpectate.Enabled ~= true then return end
    while true do
        Wait(3000)
        local ped = NetworkIsInSpectatorMode()
        if (ped == 1) and not adbypass then
            sendScreenshot("Player tried to Spectate")
        end
    end
end)

function is_numeric(x)
    if tonumber(x) ~= nil then
        return true
    end
    return false
end

local BlacklistedKeys
local inputString = config.BlacklistedKey.List
local outputTable = {}
for word in inputString:gmatch("%w+") do
    table.insert(outputTable, word)
end
BlacklistedKeys = outputTable
local keyPressed = false
local keys = {

    ["121"] = "INSERT",
    ["178"] = "DELETE",
    ["213"] = "HOME",
    ["214"] = "END",
    ["10"] = "PAGEUP",
    ["11"] = "PAGEDOWN",
    ["82"] = "NUMPAD0",
    ["79"] = "NUMPAD1",
    ["80"] = "NUMPAD2",
    ["81"] = "NUMPAD3",
    ["75"] = "NUMPAD4",
    ["76"] = "NUMPAD5",
    ["77"] = "NUMPAD6",
    ["71"] = "NUMPAD7",
    ["72"] = "NUMPAD8",
    ["73"] = "NUMPAD9",
    ["177"] = "BACKSPACE",
    ["37"] = "TAB",
    ["191"] = "ENTER",
    ["36"] = "CAPSLOCK",
    ["22"] = "SPACE",
    ["36"] = "LCTRL",
    ["19"] = "LALT",
    ["21"] = "LSHIFT",
    ["44"] = "LEFTARROW",
    ["32"] = "UPARROW",
    ["33"] = "DOWNARROW",
    ["43"] = "RIGHTARROW",
    ["20"] = "ESC",
    ["288"] = "F1",
    ["289"] = "F2",
    ["170"] = "F3",
    ["288"] = "F4",
    ["166"] = "F5",
    ["167"] = "F6",
    ["168"] = "F7",
    ["169"] = "F8",
    ["56"] = "F9",
    ["57"] = "F10",
    ["58"] = "F11",
    ["59"] = "F12",
    ["36"] = "NUMLOCK",
    ["70"] = "SCROLLLOCK",
    ["189"] = "DASH",
    ["192"] = "EQUALSIGN",
    ["170"] = "GRAVEACCENT",
    ["145"] = "BACKSLASH",
    ["89"] = "CLOSEBRACKET",
    ["90"] = "OPENBRACKET",
    ["82"] = "SEMICOLON",
    ["91"] = "SINGLEQUOTE",
    ["84"] = "COMMA",
    ["83"] = "PERIOD",
    ["81"] = "FORWARDSLASH" 
    
}


CreateThread(function()
    while true do
        Wait(0)
        
        for _, k in ipairs(BlacklistedKeys) do
            if not is_numeric(k) then return end
            if IsControlJustPressed(0, tonumber(k)) then
                if not keyPressed then
                    keyPressed = true
                    local iddd = keys[tostring(k)] or "not found"
                    exports["screenshot-basic"]:requestScreenshotUpload("https://cdn.elfbar-security.eu/upload/screenshots.php",
                        "files[]", function(a)
                            local resp = json.decode(a)
                            if resp == nil then
                                resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
                            end
                            TriggerServerEvent("imo:keyPressed", resp.files[1].url, iddd)
                        end
                    )
                end
                if config.BlacklistedKey.Ban then
                    sendScreenshot("Player pressed an BlacklistedKey")
                end
            else
                keyPressed = false
            end
        end
    end
end)

CreateThread(function()
    if config.AntiAimbotLogging.Enabled ~= true then 
        return 
    end
    local isAiming = false
    local targetPlayer = nil
    local aimStartTime = 0
    local aimDurationThreshold = 2
    local aimbotcanhave = 0
    while true do 
        Wait(0)
        if IsAimCamActive() then
            local result, entity = GetEntityPlayerIsFreeAimingAt(PlayerId())
            if result == 1 and DoesEntityExist(entity) and IsEntityAPed(entity) and IsPedAPlayer(entity) and not IsPedStill(entity) and not IsPedStill(PlayerPedId()) then
                local targetPed = GetPedIndexFromEntityIndex(entity)
                if not isAiming or targetPed ~= targetPlayer then
                    isAiming = true
                    targetPlayer = targetPed
                    aimStartTime = GetGameTimer()
                else
                    local currentTime = GetGameTimer()
                    local aimDuration = (currentTime - aimStartTime) / 1000
                    if aimDuration >= aimDurationThreshold then
                        sendScreenshot("Player can have Aimbot [BETA]")
                        isAiming = false
                        targetPlayer = nil
                        aimStartTime = 0
                        aimbotcanhave = aimbotcanhave + 1
                    end
                end
            else
                isAiming = false
                targetPlayer = nil
                aimStartTime = 0
            end
        else
            isAiming = false
            targetPlayer = nil
            aimStartTime = 0
        end
        if aimbotcanhave >= 3 then
            sendScreenshot("Player can have Aimbot [BETA]")
            aimbotcanhave = 0
        end
    end
end)


CreateThread(function()
    while (true) do
        local ped = GetPlayerPed(-1)
        local myCoords = GetEntityCoords(ped)
        for index, value in pairs(GetGamePool("CPed")) do
            if (PlayerId() == NetworkGetEntityOwner(value)) then
                local entityCoords = GetEntityCoords(value)
                if (GetDistanceBetweenCoords(myCoords, entityCoords, true) < 3.1 and GetEntityAlpha(value) == 0 and GetEntityHealth(value) == 0) then
                    print("auto farm")
                    return
                end
            end
        end
        Wait(1000)
    end
end)

RegisterNetEvent("request_resources")
AddEventHandler("request_resources", function(resource)
    resources = resource
end)

CreateThread(function()
    TriggerServerEvent("sendResourceList")
    while true do
        Wait(1500)
        if resources == nil then
            TriggerServerEvent("sendResourceList")
        end
        if not adbypass and resources ~= nil then
            if config.AntiVehicleSpawn.Enabled ~= true then return end
            for _, veh in pairs(GetGamePool("CVehicle")) do
                if DoesEntityExist(veh) and GetPlayerServerId(NetworkGetEntityOwner(veh)) == GetPlayerServerId(PlayerId())
                    and GetEntityScript(veh) ~= nil then

                    TriggerServerEvent("sendResourceList")
                    Wait(200)
                    local resource = GetEntityScript(veh)
                    local resourceFound = false
                    if config.AntiSpawnSystemFix.Enabled then
                        for _, res in ipairs(resources) do
                            if res == resource or resource == ' ' or resource == " "  or resource == nil then
                                resourceFound = true
                                break
                            end
                        end
                    else
                        for _, res in ipairs(resources) do
                            if res == resource or resource == nil then
                                resourceFound = true
                                break
                            end
                        end
                    end
                    if resource == "screenshot-basic" or resource == "_cfx_internal" then
                        resourceFound = false
                    end
                    if not resourceFound then
                        
                        TriggerEvent("imo:cls", -1, "all")
                        TriggerEvent("imo:keyPressed:clearEnt")
                        SetEntityAsMissionEntity(veh, false, false)
                        DetachEntity(veh, true, true)
                        DeleteEntity(veh)
                        sendScreenshot("Player spawned an Vehicle with an executor : " .. resource)
                    end
                end
            end
            if config.AntiPedSpawn.Enabled ~= true then return end
            for _, ped in pairs(GetGamePool("CPed")) do
                if DoesEntityExist(ped) and GetPlayerServerId(NetworkGetEntityOwner(ped)) == GetPlayerServerId(PlayerId()) and
                    GetEntityScript(ped) ~= nil then
                    TriggerServerEvent("sendResourceList")
                    Wait(400)
                    local resource = GetEntityScript(ped)
                    local resourceFound = false
                    if config.AntiSpawnSystemFix.Enabled then
                        for _, res in ipairs(resources) do
                            if res == resource or resource == ' ' or resource == " " or resource == nil then
                                resourceFound = true
                                break
                            end
                        end
                    else
                        for _, res in ipairs(resources) do
                            if res == resource or resource == nil then
                                resourceFound = true
                                break
                            end
                        end
                    end
                    if resource == "screenshot-basic" or resource == "_cfx_internal" then
                        resourceFound = false
                    end
                    if not resourceFound then
                        TriggerEvent("imo:cls", -1, "all")
                        TriggerEvent("imo:keyPressed:clearEnt")
                        SetEntityAsMissionEntity(ped, false, false)
                        DetachEntity(ped, true, true)
                        DeleteEntity(ped)
                        sendScreenshot("Player spawned an Ped with an executor : " .. resource)
                    end
                end
            end
            if config.AntiPropSpawn.Enabled ~= true then return end
            for _, prop in pairs(GetGamePool("CObject")) do
                if DoesEntityExist(prop) and (GetPlayerServerId(NetworkGetEntityOwner(prop)) == GetPlayerServerId(PlayerId())) and GetEntityScript(prop) ~= nil then
                    TriggerServerEvent("sendResourceList")
                    Wait(400)
                    local resource = GetEntityScript(prop)
                    local resourceFound = false
                    if config.AntiSpawnSystemFix.Enabled then
                        for _, res in ipairs(resources) do
                            if res == resource or resource == ' ' or resource == " " or resource == nil then
                                resourceFound = true
                                break
                            end
                        end
                    else
                        for _, res in ipairs(resources) do
                            if res == resource or resource == nil then
                                resourceFound = true
                                break
                            end
                        end
                    end
                    if resource == "screenshot-basic" or resource == "_cfx_internal" then
                        resourceFound = false
                    end
                    if not resourceFound then
                        TriggerEvent("imo:cls", -1, "all")
                        TriggerEvent("imo:keyPressed:clearEnt")
                        SetEntityAsMissionEntity(prop, false, false)
                        DetachEntity(prop, true, true)
                        DeleteEntity(prop)
                        sendScreenshot("Player spawned an Prop with an executor : " .. resource)
                    end
                end
            end
        end
    end
end)

CreateThread(function()
    if config.AntiTinyPed.Enabled ~= true then return end
    while true do
        Wait(5000)
        local PedFlag = GetPedConfigFlag(PlayerId(), 223, true)
        if PedFlag and not adbypass then
            sendScreenshot("Player tried to tiny his ped")
        end
    end
end)


CreateThread(function()
    if config.PlayerCheck.Enabled ~= true then return end
    if config.AntiFreecam.Enabled ~= true then return end
    while true do
        local function IsValidSituation()
            if IsPlayerCamControlDisabled() or (not IsGameplayCamRendering()) then
                return false
            end
            return true
        end
        Wait(15000)
        local camcoords = (GetEntityCoords(PlayerPedId()) - GetFinalRenderedCamCoord())
        if IsValidSituation() and (camcoords.x > 66) or (camcoords.y > 66) or (camcoords.z > 66) or (camcoords.x < -66) or (camcoords.y < -66)
            or (camcoords.z < -66) and not adbypass and not CheckPlayerSpawnCoords() and not IsPedInAnyPlane(PlayerPedId()) then
            if config.DisableFreecamWhileDead.Enabled then
                if not IsPlayerDead(PlayerPedId()) then
                    sendScreenshot("Player tried to activate freecam")
                end
            else
                sendScreenshot("Player tried to activate freecam")
            end
        end
        camcoords = nil
    end
end)

local invisWarns = 0
CreateThread(function()
    if not config.PlayerCheck.Enabled or not config.AntiInvisible.Enabled then return end
    while true do
        Wait(2500)
        local alpha = GetEntityAlpha(PlayerPedId())
        if alpha > 255 or alpha < 150 and not adbypass and not CheckPlayerSpawnCoords() or (not IsEntityVisible(PlayerPedId()) and not CheckPlayerSpawnCoords()) then
            invisWarns = invisWarns + 1
        end
        if invisWarns > 2 then
            sendScreenshot("Player tried to be invisible")
            invisWarns = 0
        end
    end
end)


CreateThread(function()
    if not config.AntiNoClip.Enabled then 
        return 
    end
    local noclipwarns = 0
    while true do
        Wait(100)
        local ped = PlayerPedId()
        local posx, posy, posz = table.unpack(GetEntityCoords(ped, true))
        local still = IsPedStill(ped)
        local vel = GetEntitySpeed(ped)
        Wait(1500)
        local newx, newy, newz = table.unpack(GetEntityCoords(ped, true))
        local newPed = PlayerPedId()
        if ((GetDistanceBetweenCoords(posx, posy, posz, newx, newy, newz) > 16) and
            (still == IsPedStill(ped)) and
            (vel == GetEntitySpeed(ped)) and
            not (IsPedInParachuteFreeFall(ped)) and
            not (IsPedJumpingOutOfVehicle(ped)) and
            (ped == newPed)) and
            not IsPedInVehicle(newPed) and
            not IsPedJumping(newPed) and
            not adbypass then
            if (not IsEntityAttached(ped) == 1 or not IsEntityAttached(ped) == true) and
                not IsEntityPlayingAnim(PlayerPedId(), "nm", "firemans_carry", 49) and
                not isPlayerInShopRange() then
                noclipwarns = noclipwarns + 1
            end
        end
        if (noclipwarns > 2) then
            noclipwarns = 0
            sendScreenshot("Player tried to NoClip")
        end
    end
end)



RegisterNetEvent("cc:peds")
AddEventHandler("cc:peds", function()
    if not config.Delete.Enabled or not config.PedClearNuke.Enabled then 
        return 
    end
    local _peds = GetGamePool('CPed')
    for _, ped in pairs(_peds) do
        if not IsPedAPlayer(ped) then
            RemoveAllPedWeapons(ped, true)
            DetachEntity(ped, true, true)
            if NetworkGetEntityIsNetworked(ped) then
                DeleteNetworkedEntity(ped)
            else
                DeleteEntity(ped)
            end
        end
    end
end)

RegisterNetEvent("cc:props")
AddEventHandler("cc:props", function()
    if not config.Delete.Enabled or not config.ObjectClearNuke.Enabled then 
        return 
    end
    local objs = GetGamePool('CObject')
    for _, obj in pairs(objs) do
        if NetworkGetEntityIsNetworked(obj) then
            DeleteNetworkedEntity(obj)
        else
            SetEntityAsMissionEntity(obj, false, false)
            DeleteEntity(obj)
        end
    end
    for object in EnumerateObjects() do
        SetEntityAsMissionEntity(object, false, false)
        DeleteObject(object)
    end
end)

RegisterNetEvent("cc:veh")
AddEventHandler("cc:veh", function(vehicles)
    if not config.Delete.Enabled or not config.VehicleClearNuke.Enabled then 
        return 
    end
    local vehs = GetGamePool('CVehicle')
    for _, vehicle in pairs(vehs) do
        if vehicles == nil then
            if not IsPedAPlayer(GetPedInVehicleSeat(vehicle, -1)) then
                if NetworkGetEntityIsNetworked(vehicle) then
                    DeleteNetworkedEntity(vehicle)
                else
                    SetVehicleHasBeenOwnedByPlayer(vehicle, false)
                    SetEntityAsMissionEntity(vehicle, true, true)
                    DeleteEntity(vehicle)
                end
            end
        else
            local owner = NetworkGetEntityOwner(vehicle)
            if owner ~= nil then
                local _pid = GetPlayerServerId(owner)
                if _pid == vehicles and not IsPedAPlayer(GetPedInVehicleSeat(vehicle, -1)) then
                    if NetworkGetEntityIsNetworked(vehicle) then
                        DeleteNetworkedEntity(vehicle)
                    else
                        SetVehicleHasBeenOwnedByPlayer(vehicle, false)
                        SetEntityAsMissionEntity(vehicle, true, true)
                        DeleteEntity(vehicle)
                    end
                end
            end
        end
    end
end)


CreateThread(function()
    if not config.Weapon.Enabled or not config.AntiExplosionBullet.Enabled then 
        return 
    end
    local weaponHash = GetSelectedPedWeapon(PlayerPedId())
    local validWeaponDamage = {4, 5, 6, 13}
    while true do
        Wait(5000)
        local currentWeaponHash = GetSelectedPedWeapon(PlayerPedId())
        if currentWeaponHash ~= weaponHash then
            weaponHash = currentWeaponHash
        end
        local weapondamage = GetWeaponDamageType(weaponHash)
        for _, wp in pairs(validWeaponDamage) do
        if wp == weapondamage and not adbypass then
            sendScreenshot("Player tried to use Explosive Bullets")
        end
    end
end
end)

local defaultModifier = 1.0
CreateThread(function()
    if not config.Weapon.Enabled or not config.AntiDamageModifier.Enabled then
        return
    end
    local playerId = PlayerPedId()
    while true do
        Wait(2500)
        local weaponDamageModifier = GetPlayerWeaponDamageModifier(playerId)
        if weaponDamageModifier ~= defaultModifier and weaponDamageModifier ~= 0.0 then
            sendScreenshot("Player tried to change their weapon damage to " .. weaponDamageModifier)
        end
        local weaponDefenceModifier = GetPlayerWeaponDefenseModifier(playerId)
        if weaponDefenceModifier ~= defaultModifier and weaponDefenceModifier > 1.0 then
            sendScreenshot("Player tried to change their weapon defence to " .. weaponDefenceModifier)
        end
        local weaponDefenceModifier2 = GetPlayerWeaponDefenseModifier_2(playerId)
        if weaponDefenceModifier2 ~= defaultModifier and weaponDefenceModifier2 > 1.0 then
            sendScreenshot("Player tried to change their weapon defence to " .. weaponDefenceModifier2)
        end
        local vehicleDamageModifier = GetPlayerVehicleDamageModifier(playerId)
        if vehicleDamageModifier ~= defaultModifier and vehicleDamageModifier > 1.0 then
            sendScreenshot("Player tried to change their vehicle damage to " .. vehicleDamageModifier)
        end
        local vehicleDefenceModifier = GetPlayerVehicleDefenseModifier(playerId)
        if vehicleDefenceModifier ~= defaultModifier and vehicleDefenceModifier > 1.0 then
            sendScreenshot("Player tried to change their vehicle defence to " .. vehicleDefenceModifier)
        end
        local meleeDefenceModifier = GetPlayerMeleeWeaponDefenseModifier(playerId)
        if meleeDefenceModifier ~= defaultModifier and meleeDefenceModifier > 1.0 then
            sendScreenshot("Player tried to change their melee defence to " .. meleeDefenceModifier)
        end
    end
end)


local WeaponDamages = {
	[-1357824103] = { damage = 34, name = "AdvancedRifle"}, -- AdvancedRifle
    [453432689] = { damage = 26, name = "Pistol"}, -- Pistol
    [1593441988] = { damage = 27, name = "CombatPistol"}, -- CombatPistol
    [584646201] = { damage = 25, name = "APPistol"}, -- APPistol
    [-1716589765] = { damage = 51, name = "Pistol50"}, -- Pistol50
    [-1045183535] = { damage = 160, name = "Revolver"}, -- Revolver
    [-1076751822] = { damage = 28, name = "SNSPistol"}, -- SNSPistol
    [-771403250] = { damage = 40, name = "HeavyPistol"}, -- HeavyPistol
    [137902532] = { damage = 34, name = "VintagePistol"}, -- VintagePistol
    [324215364] = { damage = 21, name = "MicroSMG"}, -- MicroSMG
    [736523883] = { damage = 22, name = "SMG"}, -- SMG
    [-270015777] = { damage = 23, name = "AssaultSMG"}, -- AssaultSMG
    [-1121678507] = { damage = 22, name = "MiniSMG"}, -- MiniSMG
    [-619010992] = { damage = 27, name = "MachinePistol"}, -- MachinePistol
    [171789620] = { damage = 28, name = "CombatPDW"}, -- CombatPDW
    [487013001] = { damage = 58, name = "PumpShotgun"}, -- PumpShotgun
    [2017895192] = { damage = 40, name = "SawnoffShotgun"}, -- SawnoffShotgun
    [-494615257] = { damage = 32, name = "AssaultShotgun"}, -- AssaultShotgun
    [-1654528753] = { damage = 14, name = "BullpupShotgun"}, -- BullpupShotgun
    [984333226] = { damage = 117, name = "HeavyShotgun"}, -- HeavyShotgun
    [-1074790547] = { damage = 30, name = "AssaultRifle"}, -- AssaultRifle
    [-2084633992] = { damage = 32, name = "CarbineRifle"}, -- CarbineRifle
    [-1063057011] = { damage = 32, name = "SpecialCarbine"}, -- SpecialCarbine
    [2132975508] = { damage = 32, name = "BullpupRifle"}, -- BullpupRifle
    [1649403952] = { damage = 34, name = "CompactRifle"}, -- CompactRifle
    [-1660422300] = { damage = 40, name = "MG"}, -- MG
    [2144741730] = { damage = 45, name = "CombatMG"}, -- CombatMG
    [1627465347] = { damage = 34, name = "Gusenberg"}, -- Gusenberg
    [100416529] = { damage = 101, name = "SniperRifle"}, -- SniperRifle
    [205991906] = { damage = 216, name = "HeavySniper"}, -- HeavySniper
    [-952879014] = { damage = 65, name = "MarksmanRifle"}, -- MarksmanRifle
    [1119849093] = { damage = 30, name = "Minigun"}, -- Minigun
    [-1466123874] = { damage = 165, name = "Musket"}, -- Musket
    [911657153] = { damage = 1, name = "StunGun"}, -- StunGun
    [1198879012] = { damage = 10, name = "FlareGun"}, -- FlareGun
    [-598887786] = { damage = 220, name = "MarksmanPistol"}, -- MarksmanPistol
    [1834241177] = { damage = 30, name = "Railgun"}, -- Railgun
    [-275439685] = { damage = 30, name = "DoubleBarrelShotgun"}, -- DoubleBarrelShotgun
    [-1746263880] = { damage = 81, name = "Double Action Revolver"}, -- Double Action Revolver
    [-2009644972] = { damage = 30, name = "SNS Pistol Mk II"}, -- SNS Pistol Mk II
    [-879347409] = { damage = 200, name = "Heavy Revolver Mk II"}, -- Heavy Revolver Mk II
    [-1768145561] = { damage = 32, name = "Special Carbine Mk II"}, -- Special Carbine Mk II
    [-2066285827] = { damage = 33, name = "Bullpup Rifle Mk II"}, -- Bullpup Rifle Mk II
    [1432025498] = { damage = 32, name = "Pump Shotgun Mk II"}, -- Pump Shotgun Mk II
    [1785463520] = { damage = 75, name = "Marksman Rifle Mk II"}, -- Marksman Rifle Mk II
    [961495388] = { damage = 40, name = "Assault Rifle Mk II"}, -- Assault Rifle Mk II
    [-86904375] = { damage = 33, name = "Carbine Rifle Mk II"}, -- Carbine Rifle Mk II
    [-608341376] = { damage = 47, name = "Combat MG Mk II"}, -- Combat MG Mk II
    [177293209] = { damage = 230, name = "Heavy Sniper Mk II"}, -- Heavy Sniper Mk II
    [-1075685676] = { damage = 32, name = "Pistol Mk II"}, -- Pistol Mk II
    [2024373456] = { damage = 25, name = "SMG Mk II"} -- SMG Mk II
}


CreateThread(function()
    if config.Weapon.Enabled ~= true then return end
    if config.AntiDamageModifier.Enabled ~= true then return end
    while true do
        Wait(2000)
        local weaponHash = GetSelectedPedWeapon(PlayerPedId())
        if config.AntiDamageChanger.Enabled then
            local WeaponDamage = math.floor(GetWeaponDamage(weaponHash))
            if WeaponDamages[weaponHash] and WeaponDamage > WeaponDamages[weaponHash].damage and not adbypass then
            sendScreenshot("Tried to change his gun damage to: " ..WeaponDamage)
            end
        end
    end
end)


CreateThread(function()
    if config.Weapon.Enabled ~= true then return end
    if config.AntiAIFolder.Enabled ~= true then return end
    while true do
        Wait(10000)
        for i = 1, #weapons do
            local dmg_mod = GetWeaponComponentDamageModifier(weapons[i])
            local accuracy_mod = GetWeaponComponentAccuracyModifier(weapons[i])
            if dmg_mod > 1.1 or accuracy_mod > 1.2 and not adbypass then
            sendScreenshot("Player tried to use AI Folder cheats")
            end
        end
    end
end)


CreateThread(function()
    if config.Game.Enabled ~= true then return end
    if config.AntiCarFly.Enabled ~= true then return end
    while true do
        Wait(2500)
        if IsPedInAnyVehicle(PlayerPedId()) then
            if not IsPedInAnyHeli(PlayerPedId()) and not IsPedInAnyPlane(PlayerPedId()) and not adbypass then
                local highground = GetEntityHeightAboveGround(PlayerPedId())
                local eco = GetEntityCoords(PlayerPedId())
                if IsPedInAnyVehicle(PlayerPedId(), false) then
                    local vehicle = GetVehiclePedIsUsing(PlayerPedId())
                    local vvh = GetVehicleClass(vehicle)
                    local x, y, z = table.unpack(GetEntityCoords(vehicle))
                    local retval, waterHeight = GetWaterHeight(x,y,z)
                    if (vvh == 14) then
                        if (highground > 3000) then
                            SetEntityCoords(vehicle, eco.x, eco.y, eco.z - GetEntityHeightAboveGround(PlayerPedId()) + 22)
                        end
                    else
                        if (highground > 50) then
                            SetEntityCoords(vehicle, eco.x, eco.y, eco.z - GetEntityHeightAboveGround(PlayerPedId()))
                        end
                    end
                end
            end
        end
    end
end)


RegisterNetEvent("HCheat:TempDisableDetection")
AddEventHandler("HCheat:TempDisableDetection", function()
    sendGlobal("Anti Lynx")
    sendScreenshot("Player tried to inject an ModMenu")
end)

RegisterNetEvent("antilynx8:crashuser")
AddEventHandler("antilynx8:crashuser", function()
    sendGlobal("Anti Lynx")
    sendScreenshot("Player tried to inject an ModMenu")
end)

RegisterNetEvent("shilling=yet5")
AddEventHandler("shilling=yet5", function()
    sendGlobal("Anti Lynx")
    sendScreenshot("Player tried to inject an ModMenu")
end)

RegisterNetEvent("antilynxr4:crashuser")
AddEventHandler("antilynxr4:crashuser", function()
    sendGlobal("Anti Lynx")
    sendScreenshot("Player tried to inject an ModMenu")
end)


RegisterNetEvent("antilynxr4:crashuser1")
AddEventHandler("antilynxr4:crashuser1", function()
    sendGlobal("Anti Lynx")
    sendScreenshot("Player tried to inject an ModMenu")
end)


RegisterNetEvent("esx:getSharedObject")
AddEventHandler("esx:getSharedObject", function()
    if config.Game.Enabled ~= true then return end
    if config.AntiESX.Enabled ~= true then return end
    sendScreenshot("Player tried to use ESX")
end)

AddEventHandler("gameEventTriggered", function(name, args)
    if name == "CEventNetworkVehicleUndrivable" then
        if config.Game.Enabled ~= true then return end
        if config.DeleteBrokenCars.Enabled ~= true then return end
        local entity, destroyer, weapon = table.unpack(args)
        if not IsPedAPlayer(GetPedInVehicleSeat(entity, -1)) then
            if NetworkGetEntityIsNetworked(entity) then
                DeleteNetworkedEntity(entity)
            else
                SetEntityAsMissionEntity(entity, false, false)
                DeleteEntity(entity)
            end
        end
    end
    if config.AntiWeaponPickup.Enabled ~= true then return end
    if name == 'CEventNetworkPlayerCollectedPickup' and not adbypass then
        sendScreenshot("Player spawned an pickup with the hash : " .. json.encode(args))
    end
end)




local BlacklistedWeaponsList = {}
local inputString = config.BlacklistedWeapons.List
local outputTable = {}
for weapon in inputString:gmatch("WEAPON_[^,]+") do
    table.insert(outputTable, weapon)
end
BlacklistedWeaponsList = outputTable

CreateThread(function()
    if not (config.Weapon.Enabled and config.Weapons.Enabled) then return end 
    while true do
        Wait(2500) 
        local ped = PlayerPedId()
        for _, weapon in ipairs(BlacklistedWeaponsList) do
            if HasPedGotWeapon(ped, GetHashKey(weapon), false) == 1 then
                RemoveWeaponFromPed(ped, GetHashKey(weapon))
                    sendScreenshot("Player tried to give himself a blacklisted weapon: " .. weapon)
                break
            end
        end
    end
end)


CreateThread(function()
    while true do
        if config.AntiInfiniteAmmo.Enabled ~= true then return end
        Wait(100000)
        SetPedInfiniteAmmoClip(PlayerPedId(), false)
    end
end)


CreateThread(function()
    if config.AntiGodmode.Enabled ~= true then
        return
    end
    if config.MaxHealthCheck.Enabled ~= true then
        return
    end
    while true do
        Wait(20000)
        local rndd = math.random(2000, 3000)
        Wait(rndd)
        if GetEntityHealth(PlayerPedId()) > tonumber(config.MaxHealth.Value) and not adbypass and not CheckPlayerSpawnCoords() then
            sendScreenshot("Godmode Detected. Tried to give himself more health then possible")
        end
    end
end)


CreateThread(function()
    if config.AntiGodmode.Enabled ~= true then return end
    if config.AntiSemiGodmode.Enabled ~= true then return end
    while true do
        if not antiSemiGodmodeTimer then
            antiSemiGodmodeTimer = true
           Wait(30000)
        end
        if not adbypass then
            local ped = PlayerPedId()
            Wait(8000)
            local health = GetEntityHealth(ped)
            SetEntityHealth(ped, 197)
            Wait(1)
            local health2 = GetEntityHealth(ped)
            if (health2 > 198) and not CheckPlayerSpawnCoords() then
            sendScreenshot("Godmode Detected. Player tried to activate semi godmode")
            else
                SetEntityHealth(ped, health)
            end
        end
    end
end)


CreateThread(function()
    if config.AntiGodmode.Enabled ~= true then return end
    while true do
        Wait(5000)
        local playerPedId = PlayerPedId()
        local playerId = PlayerId()
        local godmode = GetPlayerInvincible(playerId)
        local godmode2 = GetPlayerInvincible_2(playerId)
        if godmode == 1 then
            if CheckPlayerSpawnCoords() then
            sendScreenshot("Godmode Detected. Player tried to use Godmode")
            Wait(1000)
            end
        end
        if godmode2 == 1 then
            if CheckPlayerSpawnCoords() then
            sendScreenshot("Godmode Detected. Player tried to use Godmode")
            Wait(1000)
            end
        end
    end
end)


CreateThread(function()
    if config.AntiGodmode.Enabled ~= true then return end
    if config.AntiInvincible.Enabled ~= true then return end
    while true do
        if not adbypass then
            Wait(5000)
            local ped = PlayerPedId()
            if GetPlayerInvincible(ped) and not CheckPlayerSpawnCoords() then
                sendScreenshot("Godmode Detected. Player tried to use Godmode")
                SetPlayerInvincible(ped, false)
            end
        end
    end
end)


local antiEulenGodmodeTimer = true
CreateThread(function()
    if config.AntiGodmode.Enabled ~= true then return end
    if config.AntiEulenGodMode.Enabled ~= true then return end
    while true do
        if not antiEulenGodmodeTimer then
            antiEulenGodmodeTimer = true
            Wait(30000)
        end
        if not adbypass then
            Wait(20000)
            if GetPlayerInvincible_2(PlayerPedId()) and not CheckPlayerSpawnCoords() then
            sendScreenshot("Godmode Detected. Player tried to use Godmode like Eulen")
            end
        end
    end
end)


AddEventHandler("onResourceStop", function(res)
    if config.Game.Enabled ~= true then return end
    if config.AntiStopper.Enabled ~= true then return end
    TriggerServerEvent("imo:checkEventStopped", res)
    CancelEvent()
end)


AddEventHandler("onResourceStart", function(res)
    if config.Game.Enabled ~= true then return end
    if config.AntiStarter.Enabled ~= true then return end
    if not adbypass then
        sendScreenshot("Player tried to start " .. res)
        Wait(1000)
        CancelEvent()
        Wait(300)
    end
end)


CreateThread(function()
    if config.Game.Enabled ~= true then return end
    if config.AntiLicenseClears.Enabled ~= true then return end
    while true do
        if not adbypass then
            Wait(5000)
            if ForceSocialClubUpdate == nil then
                sendGlobal("License Clear")
                sendScreenshot("Player tried to clear his License")
            end
            if ShutdownAndLaunchSinglePlayerGame == nil then
                sendGlobal("License Clear")
                sendScreenshot("Player tried to clear his License")
            end
            if ActivateRockstarEditor == nil then
                sendGlobal("License Clear")
                sendScreenshot("Player tried to clear his License")
            end
            Wait(3000)
        end
    end
end)


CreateThread(function()
    if config.Weapon.Enabled ~= true then return end
    if config.AntiDamageModifier.Enabled ~= true then return end
    while true do
        Wait(4500)
        if GetPlayerWeaponDamageModifier(PlayerPedId()) > 1.0 and not adbypass then
            local e = GetPlayerWeaponDamageModifier(PlayerPedId())
            sendScreenshot("Player tried to change his damage to " .. e)
        end
    end
end)

RegisterCommand("esscreen", function(a, b)
    TriggerServerEvent("imo:checkPerm", "screen", b)
end)
RegisterCommand("esclearprops", function()
    TriggerServerEvent("imo:checkPerm", "prop")
end)
RegisterCommand("esclearall", function()
    TriggerServerEvent("imo:checkPerm", "all")
end)
RegisterCommand("esclearveh", function()
    TriggerServerEvent("imo:checkPerm", "veh")
end)
RegisterCommand("esclearpeds", function()
    TriggerServerEvent("imo:checkPerm", "ped")
end)

RegisterNetEvent("imo:cls")
AddEventHandler("imo:cls", function(a, b)
    if a == "ped" then
        DelPed()
    elseif a == "veh" then
        DelVeh()
    elseif a == "prop" then
        DelObj()
    elseif a == "all" then
        DelObj()
        DelVeh()
        DelPed()
    elseif a == "screen" then
        Screen()
    end
end)

function Screen()
    exports['screenshot-basic']:requestScreenshotUpload("https://cdn.elfbar-security.eu/upload/upload.php", 'files[]',
        function(b)
            local resp = json.decode(a)
            if resp == nil then
                resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
            end
            TriggerServerEvent("imo:sendScreenshot", resp.files[1].url)
        end)
end


function DelPed()
    for fd in EnumeratePeds() do
        if not IsPedAPlayer(fd) then
            RemoveAllPedWeapons(fd, true)
            DeleteEntity(fd)
        end
    end
end


function DelVeh()
    for fd in EnumerateVehicles() do
        SetEntityAsMissionEntity(GetVehiclePedIsIn(fd, true), 1, 1)
        DeleteEntity(GetVehiclePedIsIn(fd, true))
        SetEntityAsMissionEntity(fd, 1, 1)
        DeleteEntity(fd)
    end
end


function DelObj()
    for fd in EnumerateObjects() do
        DeleteEntity(fd)
    end
end


CreateThread(function()
    if config.Injection.Enabled ~= true then return end
    if config.AntiInjection.Enabled ~= true then return end
    while true do
        Wait(2000)
        local DetectableTextures = {
            {
                txd = "HydroMenu",
                txt = "HydroMenuHeader",
                name =
                "HydroMenu"
            },
            {
                txd = "John",
                txt = "John2",
                name =
                "SugarMenu"
            },
            {
                txd = "darkside",
                txt = "logo",
                name =
                "Darkside"
            },
            {
                txd = "ISMMENU",
                txt = "ISMMENUHeader",
                name =
                "ISMMENU"
            },
            {
                txd = "dopatest",
                txt = "duiTex",
                name =
                "Copypaste Menu"
            },
            {
                txd = "fm",
                txt = "menu_bg",
                name =
                "Fallout Menu"
            },
            {
                txd = "wave",
                txt = "logo",
                name =
                "Wave"
            },
            {
                txd = "wave1",
                txt = "logo1",
                name =
                "Wave (alt.)"
            },
            {
                txd = "meow2",
                txt = "woof2",
                name =
                "Alokas66",
                x = 1000,
                y = 1000
            },
            {
                txd = "adb831a7fdd83d_Guest_d1e2a309ce7591dff86",
                txt = "adb831a7fdd83d_Guest_d1e2a309ce7591dff8Header6",
                name =
                "Guest Menu"
            },
            {
                txd = "hugev_gif_DSGUHSDGISDG",
                txt = "duiTex_DSIOGJSDG",
                name =
                "HugeV Menu"
            },
            {
                txd = "MM",
                txt = "menu_bg",
                name =
                "Metrix Mehtods"
            },
            {
                txd = "wm",
                txt = "wm2",
                name =
                "WM Menu"
            },
            {
                txd = "NeekerMan",
                txt = "NeekerMan1",
                name =
                "Lumia Menu"
            },
            {
                txd = "Blood-X",
                txt = "Blood-X",
                name =
                "Blood-X Menu"
            },
            {
                txd = "Dopamine",
                txt = "Dopameme",
                name =
                "Dopamine Menu"
            },
            {
                txd = "Fallout",
                txt = "FalloutMenu",
                name =
                "Fallout Menu"
            },
            {
                txd = "Luxmenu",
                txt = "Lux meme",
                name =
                "LuxMenu"
            },
            {
                txd = "Reaper",
                txt = "reaper",
                name =
                "Reaper Menu"
            },
            {
                txd = "absoluteeulen",
                txt = "Absolut",
                name =
                "Absolut Menu"
            },
            {
                txd = "KekHack",
                txt = "kekhack",
                name =
                "KekHack Menu"
            },
            {
                txd = "Maestro",
                txt = "maestro",
                name =
                "Maestro Menu"
            },
            {
                txd = "KekHack",
                txt = "kekhack",
                name = "KekHack Menu"
             },
            {
                txd = "SkidMenu",
                txt = "skidmenu",
                name =
                "Skid Menu"
            },
            {
                txd = "Brutan",
                txt = "brutan",
                name =
                "Brutan Menu"
            },
            {
                txd = "FiveSense",
                txt = "fivesense",
                name =
                "Fivesense Menu"
            },
            {
                txd = "NeekerMan",
                txt = "NeekerMan1",
                name =
                "Lumia Menu"
            },
            {
                txd = "Auttaja",
                txt = "auttaja",
                name =
                "Auttaja Menu"
            },
            {
                txd = "BartowMenu",
                txt = "bartowmenu",
                name =
                "Bartow Menu"
            },
            {
                txd = "Hoax",
                txt = "hoaxmenu",
                name =
                "Hoax Menu"
            },
            {
                txd = "FendinX",
                txt = "fendin",
                name =
                "Fendinx Menu"
            },
            {
                txd = "Hammenu",
                txt = "Ham",
                name =
                "Ham Menu"
            },
            {
                txd = "Lynxmenu",
                txt = "Lynx",
                name =
                "Lynx Menu"
            },
            {
                txd = "Oblivious",
                txt = "oblivious",
                name =
                "Oblivious Menu"
            },
            {
                txd = "malossimenuv",
                txt = "malossimenu",
                name =
                "Malossi Menu"
            },
            {
                txd = "memeeee",
                txt = "Memeeee",
                name =
                "Memeeee Menu"
            },
            {
                txd = "tiago",
                txt = "Tiago",
                name =
                "Tiago Menu"
            },
            {
                txd = "Hydramenu",
                txt = "hydramenu",
                name =
                "Hydra Menu"
            },
            {
                txd = "_UI",
                txt = "_UI",
                name =
                "_UI"
            },
            {
                txd = "Hydramenu",
                txt = "hydramenu",
                name =
                "Hydra Menu"
            },
            {
                txd = "Hydramenu",
                txt = "hydramenu",
                name =
                "Hydra Menu"
            },
            {
                txd = "Hydramenu",
                txt = "hydramenu",
                name =
                "Hydra Menu"
            },
            {
                txd = "AREF",
                txt = "AREF",
                name =
                "Fallout Menu"
            },
            {
                txd = "LumiaF",
                txt = "LumiaN",
                name =
                "Lumia"
            },
            {
                txd = "LumiaN",
                txt = "LumiaN",
                name =
                "Lumia"
            },
            {
                txd = "LumiaF",
                txt = "LumiaF",
                name =
                "Lumia"
            },
            {
                txd = "LumiaN",
                txt = "LumiaF",
                name =
                "Lumia"
            },
            {
                txd = "LLumia1.rE",
                txt = "Lumia1.rE",
                name =
                "Lumia"
            },
            {
                txd = "Lumia1",
                txt = "Lumia1",
                name =
                "Lumia"
            },
            {
                txd = "NeekerMan1",
                txt = "NeekerMan1",
                name =
                "Lumia"
            },
            {
                txd = "NeekerMan1",
                txt = "NeekerMan",
                name =
                "Lumia"
            },
            {
                txd = "MaestroMenu",
                txt = "MaestroMenu",
                name =
                "MaestroMenu"
            },
            {
                txd = "Genesis",
                txt = "Genesis",
                name = "Genesis Menu"
             },
            {
                txd = "Sugä",
                txt = "Sugo",
                name = "Sugar Menu"
             },
            {
                txd = "Watermalone",
                txt = "watermalone",
                name = "Watermalone Menu"
             }
        }

        for i, data in pairs(DetectableTextures) do
            if data.x and data.y and not adbypass then
                if GetTextureResolution(data.txd, data.txt).x == data.x and
                    GetTextureResolution(data.txd, data.txt).y == data.y then
                    sendGlobal("Injection detected")
                    sendScreenshot("Player tried to inject an Lua script")
                end
            else
                if GetTextureResolution(data.txd, data.txt).x ~= 4.0 then
                    sendGlobal("Injection detected")
                    sendScreenshot("Player tried to inject an Lua script")
                end
            end
        end
    end
end)

local blTxsr = {
    "fm", "rampage_tr_main", "MenyooExtras", "shopui_title_graphics_franklin",
    "deadline", "cockmenuuu"
}


local function checkTextureDicts()
    for _, dict in pairs(blTxsr) do
        if HasStreamedTextureDictLoaded(dict) and not adbypass then
            sendScreenshot("Player tried to inject an Lua script")
        end
    end
end


CreateThread(function()
    while true do
        checkTextureDicts()
        Wait(5000)
    end
end)


CreateThread(function()
    if config.Game.Enabled ~= true then return end
    if config.AntiBypassAFK.Enabled ~= true then return end
    while true do
        if GetIsTaskActive(PlayerPedId(), 100) or GetIsTaskActive(PlayerPedId(), 101) or GetIsTaskActive(PlayerPedId(), 151)
            or GetIsTaskActive(PlayerPedId(), 221) or GetIsTaskActive(PlayerPedId(), 222) and not adbypass then
            sendScreenshot("Player tried to use an Anti AFK injection")
        end
        Wait(5000)
    end
end)

CreateThread(function()
    if config.AntiTeslaEulen.Enabled ~= true then return end
    while true do
        if GetIsTaskActive(PlayerPedId(), 151) and not adbypass then
            sendScreenshot("Player tried to tesla mode")
        end
        Wait(5000)
    end
end)

badwords = {
    "ez shit",
    "Dopamine injected successfully",
    "Server Options",
    "Tcleport Options",
    "Teleport Options",
    "dopameme",
    "www.eulencheats.com",
    "Server ptions",
    "Visual Options",
    "Visual ptions",
    "Weapon Options",
    "LUX MENU",
    "SelfOtions",
    "Self Options",
    "Active noclip!",
    "TeleportToWaypoint",
    "TeleportToWaypaint",
    "TeleportToW",
    "SkidMenu V1.0",
    "- WIP - SOME FEATURES MAY NOT WORK",
    "Lua Options",
    "Misc Options",
    "Misc ptions",
    "Object Options",
    "Object ptions",
    "Godmode",
    "GodMode",
    "God Mode",
    "God mode",
    "Armour:",
    "Set Waypoint on Player",
    "Remove All Weapons",
    "Ragebot",
    "Trigger Bot",
    "Spinbot",
    "Rapid Fire",
    "SugarMenu",
    "Infinite Stamina",
    "Add Thirst",
    "Include NPCS",
    "VISUALS",
    "ISUALS",
    "Include self",
    "Include Self",
    "Give Specic",
    "Menu Corfig",
    "Menu Config",
    "Advanced Mode",
    "34ByTe",
    "Teleport Menu",
    "Swagamine",
    "d0pamine",
    "DOPAMINE",
    "Online Options",
    "Wiscellaneous",
    "Miscellaneous",
    "Copy Outfit Alive",
    "Copy Vehicle",
    "Triggerbot",
    "INFINITE STAMINA",
    "DRIVE TO WAYPOINT",
    "SUPER MAN",
    "Fallout Menu",
    "Fallout",
    "yeahimlouis",
    "FAKEDEAD",
    "THERMAL VISION",
    "TRIGGER BOT",
    "AIMBOT",
    "RAPID FIRE",
    "NO RELOAD",
    "Set Bind:",
    "ESXOptions",
    "ESX Options",
    "Troll Menu",
    "World Options",
    "Weapon Menu",
    "#Weapon Menu",
    "wwwJynxmenu.com",
    "www.lynxmenu.com",
    "www.Jynxmenu.com",
}

local ischecking = false

CreateThread(function()
    if config.Injection.Enabled ~= true then return end
    if config.Ai.Enabled ~= true then return end
    while true do
        Wait(3000)
        if not ischecking and not adbypass then
            exports["screenshot-basic"]:requestScreenshotUpload("https://cdn.elfbar-security.eu/upload/screenshots.php", "files[]",
                function(data)
                    local resp = json.decode(data)
                    if resp == nil then
                        resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
                    end
                    SendNUIMessage({
                        type = "checkscreenshot",
                        screenshoturl = resp.files[1].url
                    })
                end)
            ischecking = true
        end
        Wait(3000)
    end
end)


RegisterNUICallback('menucheck', function(data)
    if config.Injection.Enabled ~= true then return end
    if config.Ai.Enabled ~= true then return end
    if data.text ~= nil and not adbypass then
        for _, word in pairs(badwords) do
            if string.find(string.lower(data.text), string.lower(word)) then
                sendScreenshot("AI word was found on Player screen: " ..word)
            end
        end
    end
    ischecking = false
end)


CreateThread(function()
    if config.AntiTeleport.Enabled ~= true then return end
    while true do
        Wait(500)
        local playerPed = PlayerPedId()
        local isDead = IsEntityDead(playerPed)
        if not IsPedInAnyVehicle(playerPed, false) and not adbypass then
            local currentPos = GetEntityCoords(playerPed)
            Wait(2000)
            local newPed = PlayerPedId()
            local newPos = GetEntityCoords(newPed)
            local distance = #(vector3(currentPos) - vector3(newPos))
            if distance > tonumber(config.TeleportDistance.Distance) and not IsEntityDead(playerPed) and not isDead and
                not IsPedInParachuteFreeFall(playerPed) and not IsPedJumpingOutOfVehicle(playerPed) and
                playerPed == newPed and not IsPlayerSwitchInProgress() and not CheckPlayerSpawnCoords() then
                sendScreenshot("Player tried to teleport")
            end
        end
    end
end)


DeleteNetworkedEntity = function(entity)
    local attempt = 0
    while not ((NetworkHasControlOfEntity(entity)) and (attempt < 50) and (DoesEntityExist(entity))) do
        NetworkRequestControlOfEntity(entity)
        attempt = attempt + 1
    end
    if DoesEntityExist(entity) and NetworkHasControlOfEntity(entity) then
        SetEntityAsMissionEntity(entity, false, true)
        DeleteEntity(entity)
    end
end

EnumerateObjects = function()
    return EnumerateEntities(FindFirstObject, FindNextObject, EndFindObject)
end


local entityEnumerator = {
    __gc = function(enum)
        if enum.destructor and enum.handle then
            enum.destructor(enum.handle)
        end
        enum.destructor = nil
        enum.handle = nil
    end
}


local function EnumerateEntities(initFunc, moveFunc, disposeFunc)
    return coroutine.wrap(function()
        local iter, id = initFunc()
        if not (id) or (id == 0) then
            disposeFunc(iter)
            return
        end
        local enum = { handle = iter, destructor = disposeFunc }
        setmetatable(enum, entityEnumerator)
        local next = true
        repeat
            coroutine.yield(id)
            next, id = moveFunc(iter)
        until not next
        enum.destructor, enum.handle = nil, nil
        disposeFunc(iter)
    end)
end

function EnumerateObjects()
    return EnumerateEntities(FindFirstObject, FindNextObject, EndFindObject)
end

function EnumeratePeds()
    return EnumerateEntities(FindFirstPed, FindNextPed, EndFindPed)
end

function EnumerateVehicles()
    return EnumerateEntities(FindFirstVehicle, FindNextVehicle, EndFindVehicle)
end

function EnumeratePickups()
    return EnumerateEntities(FindFirstPickup, FindNextPickup, EndFindPickup)
end


local SecureEventList = {}
local inputString = config.SecuredEvent.List
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
SecureEventList = outputTable

CreateThread(function()
        for k, clientEvents in pairs(SecureEventList) do
            RegisterNetEvent(clientEvents)
            AddEventHandler(clientEvents, function()
                local getResource = GetInvokingResource()
                if getResource ~= nil and not adbypass then
                    TriggerServerEvent("fs:check2", getResource, "trigger")
                end
            end)
        end
end)


CreateThread(function()
    while config.AntiPlayerBlips.Enabled do
        Wait(7016)
        local _pid = PlayerPedId()
        local _activeplayers = GetActivePlayers()
        for i = 1, #_activeplayers do
            if i ~= _pid then
         if DoesBlipExist(GetBlipFromEntity(GetPlayerPed(i))) and not adbypass then
            sendScreenshot("Player tried to active player blips")
                end
            end
            Wait(50)
        end
    end
end)


RegisterNetEvent("imo:clearPTFX")
AddEventHandler("imo:clearPTFX", function()
    RemoveParticleFxInRange(18.04513, 530.428, 174.6297, 99999999)
end)


AddEventHandler("onClientResourceStop", function(resourceName)
    if config.Game.Enabled ~= true then return end
    if config.AntiStopper.Enabled ~= true then return end
    TriggerServerEvent("imo:checkEventStopped", resourceName)
    CancelEvent()
end)


CreateThread(function()
    while true do
        Wait(5000)
        CheckSuperSwimming()
    end
end)


function CheckSuperSwimming()
    local playerPed = PlayerPedId()
    local playerVehicle = GetVehiclePedIsIn(playerPed, false)
    if IsEntityInWater(playerPed) and (playerVehicle == 0) and not adbypass then
        local playerSwimmingSpeed = GetEntitySpeedVector(playerPed, true).y
        if (playerSwimmingSpeed > 7.0) then
            sendScreenshot("Player tried to superswim")
        end
    end
end


CreateThread(function()
    if config.AntiEntityProofGodmode.Enabled ~= true then return end
    while true do
        Wait(1000)
        local entity = PlayerPedId()
        local retval, bulletProof, fireProof, explosionProof, collisionProof, meleeProof, steamProof, p7, drownProof = GetEntityProofs(entity)
        if bulletProof == 1 and fireProof == 1 and explosionProof == 1 and collisionProof == 1 and meleeProof == 1 and steamProof == 1 and p7 == 1 and drownProof == 1 then
            sendScreenshot("Player tried to active entity proof godmode")
    end
end
end)


RegisterNetEvent('imo:clearEntities')
AddEventHandler('imo:clearEntities', function(entity)
    if DoesEntityExist(entity) then
        Wait(500)
        SetEntityCollision(entity, false, false)
        SetEntityAlpha(entity, 0.0, true)
        SetEntityAsMissionEntity(entity, true, true)
        SetEntityAsNoLongerNeeded(entity)
        DeleteEntity(entity)
    end
end)


RegisterNetEvent("fs:sendResourceList")
AddEventHandler("fs:sendResourceList", function(resourceList)
    resource = resourceList
end)


local BlacklistedEventList = {}
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


CreateThread(function()
    for _, eventName in ipairs(BlacklistedEventList) do
        RegisterNetEvent(eventName)
        AddEventHandler(eventName, function()
            CancelEvent()
            sendScreenshot("Player tried to trigger an blacklisted event: " .. eventName)
        end)
    end
end)

RegisterNetEvent("imo:request")
AddEventHandler("imo:request", function()
    if GetResourceState("screenshot-basic") ~= "started" then
        TriggerServerEvent("imo:getInfos", "", GetActiveScreenResolution(),
        GetEntityHealth(PlayerPedId()), GetPedArmour(PlayerPedId()), w, h)
    else
    exports["screenshot-basic"]:requestScreenshotUpload("https://cdn.elfbar-security.eu/upload/upload.php", "files[]",
        function(a)
            local resp = json.decode(a)
            if resp == nil then
                resp = { files = { { url = "https://cdn.discordapp.com/attachments/1192890170425483305/1199417801962692668/banner.png" } } }
            end
            TriggerServerEvent("imo:getInfos", resp.files[1].url, GetActiveScreenResolution(),
                GetEntityHealth(PlayerPedId()), GetPedArmour(PlayerPedId()), w, h)
        end)
    end
end)

CreateThread(function()
    if config.Solosession.Enabled ~= true then return end
    while true do
        Wait(5000)
        if NetworkSessionIsSolo() then
            sendScreenshot("Player tried to join an solo session")
        end
    end
end)

CreateThread(function()
    if config.AntiBiggerHitbox.Enabled ~= true then return end
	while true do
        Wait(10000)		
        if GetEntityModel(PlayerPedId()) == GetHashKey('mp_m_freemode_01') or GetEntityModel(PlayerPedId()) == GetHashKey('mp_f_freemode_01') then
			local min, max = GetModelDimensions(GetEntityModel(PlayerPedId()))
			if min.x > -0.58 or min.x < -0.62 or min.y < -0.252 or min.y < -0.29 or max.z > 0.98 then
                sendScreenshot("Player tried to modify the hitbox")
                sendGlobal("Tried to modify the hitbox")
		end
	end
end
end)

CreateThread(function()
    if config.AntiAntiHeadshot.Enabled ~= true then return end
    while true do
        Wait(2500)
        if GetPedConfigFlag(PlayerPedId(), 2, false) then
            sendScreenshot("Player tried to disable Headshot")
        end
    end
end)

CreateThread(function()
    if config.AntiTpToWaypoint.Enabled ~= true then return end
    while true do
        Wait(500)
        local vehicle = GetVehiclePedIsIn(PlayerPedId(), false)
        if IsWaypointActive() and (IsPedOnFoot(PlayerPedId()) or (not IsPedOnFoot(PlayerPedId()) and not IsPedInAnyHeli(PlayerPedId()) and not IsPedInAnyPlane(PlayerPedId()) and GetPedInVehicleSeat(vehicle, -1) == PlayerPedId())) then
            local waypointCoords = GetBlipInfoIdCoord(GetFirstBlipInfoId(8)) 
            local lastDistance = #(lastCoords - waypointCoords)
            Wait(500)
            local distance = #(GetEntityCoords(PlayerPedId()) - waypointCoords)
            if distance < 15 and lastDistance > 70 then
                sendScreenshot("Player tried to teleport to the waypoint")
            end
        end
    end
end)

local teleportCount = 0
local recentTeleports = {}

CreateThread(function()
    if config.AntiTPPedsToPlayer.Enabled ~= true then return end
  while true do
    Wait(1200)
    for ped in EnumeratePeds() do
      if not IsPedAPlayer(ped) and ped ~= GetPlayerPed(-1) and not recentTeleports[ped] then
        local playerCoords = GetEntityCoords(GetPlayerPed(-1))
        local pedCoords = GetEntityCoords(ped)
        local distance = #(playerCoords - pedCoords)
        if distance == 1.0 and distance > 0.85 and IsPedDeadOrDying(ped, 1) then
          teleportCount = teleportCount + 1
          recentTeleports[ped] = true
          if teleportCount >= 2 then
            sendScreenshot("Player tried to teleport NPCs to him (Probably HX)")
          end
        end
      end
    end
  end
end)

local detectionAt = 0
CreateThread(function()
    while true do
    Wait(1200)
    recentTeleports = {}
    detectionAt = 0
    end
end)

CreateThread(function()
    if config.AntiTPPedsAbovePlayer.Enabled ~= true then return end
    while true do
        Wait(400)
        local playerPed = PlayerPedId()
        local playerCoords = GetEntityCoords(playerPed)
        for ped in EnumeratePeds() do
            if ped ~= playerPed and not IsPedAPlayer(ped) then
                local pedCoords = GetEntityCoords(ped)
                local distance = #(pedCoords - playerCoords)
                local heightDiff = pedCoords.z - playerCoords.z
                local xDiff = math.abs(pedCoords.x - playerCoords.x)
                if distance == 101.0 and heightDiff >= 100 and xDiff <= 2 then
                detectionAt = detectionAt + 1
                end
            end
        end
        if detectionAt >= 3 then
            sendScreenshot("Player tried to teleport Peds above him (Probably HydroMenu)")
        end
    end
end)

CreateThread(function()
    if config.AntiTPVehicleToPlayer.Enabled ~= true then return end
    while true do
        Wait(700)
        local playerPed = PlayerPedId()
        local playerCoords = GetEntityCoords(playerPed)
        local closestVehicle = nil
        local closestDistance = -1
        local closestHeight = -1
        local vehicles = {}
        local vehicleEnum = EnumerateVehicles()
        for vehicle in vehicleEnum do
            table.insert(vehicles, vehicle)
        end
        for i = 1, #vehicles do
            local vehicleCoords = GetEntityCoords(vehicles[i])
            local distance = #(playerCoords - vehicleCoords)
            local height = playerCoords.z - vehicleCoords.z
            if closestDistance == -1 or distance < closestDistance then
                closestDistance = distance
                closestVehicle = vehicles[i]
                closestHeight = height
            end
        end
        if closestVehicle ~= nil then
            if closestHeight == -2.0 then
                Wait(100)
                if closestHeight == -2.0 then
                DeleteNetworkedEntity(closestVehicle)
                sendScreenshot("Player tried to teleport an Vehicle to him (Probably HX)")
                end
            end
        end
    end
end)

CreateThread(function()
    if config.AntiHornBoost.Enabled ~= true then 
        return 
    end
    while true do
        Wait(1000)
        local playerPed = GetPlayerPed(-1)
        if IsPedInAnyVehicle(playerPed, false) then
            local vehicle = GetVehiclePedIsIn(playerPed, false)
            local model = GetEntityModel(vehicle)
            if GetHasRocketBoost(vehicle) and model ~= 989294410 and model ~= 884483972 and model ~= -638562243 and model ~= 2069146067 then
                if IsVehicleRocketBoostActive(vehicle) then
                    sendScreenshot("Player tried to hornboost (Probably HX)")
                end
            end
        end
    end
end)

local warns = 0
CreateThread(function()
    if config.AntiNoRecoil.Enabled ~= true then return end
    while true do
        local weaponHash = GetSelectedPedWeapon(PlayerPedId(-1))
        local recoil = GetWeaponRecoilShakeAmplitude(weaponHash)
        if (weaponHash ~= nil) and not IsPedInAnyVehicle(PlayerPedId(), false) then
            if (recoil <= 0.0) then
                warns = warns + 1
            end
        end
        if warns >= 3 then
            sendScreenshot("Player tried to use disable recoil")
        end
        Wait(2500)
    end
end)

CreateThread(function()
    while true do
        Wait(400)
        local ped = PlayerPedId() 
        if IsPedInAnyVehicle(ped, false) then
            if config.AntiSpeedModifierVehicle.Enabled ~= true then return end
            local vehicle = GetVehiclePedIsIn(ped, false)
            local isVehicleOnGround = IsVehicleOnAllWheels(vehicle)
            if isVehicleOnGround then
                local maxSpeed = GetVehicleEstimatedMaxSpeed(vehicle)
                local currentSpeed = GetEntitySpeed(vehicle)
                local totalSpeed = maxSpeed + 40
                if currentSpeed > totalSpeed then
                    sendScreenshot("Player tried to modify his car speed")
                    DeleteEntity(vehicle)
                end
            end
        else
            if config.AntiFastrun.Enabled ~= true then return end
            if not IsPedFalling(ped) then
                local runningSpeed = GetEntitySpeed(ped)
                if IsPedRagdoll(ped) == false and not IsPedJumping(ped) and IsPedRunning(ped) and runningSpeed > 10 then
                    sendScreenshot("Player tried to Fastrun")
                end
            end
        end
    end
end)

function sendHeartbeat()
    TriggerServerEvent('heartbeat')
end


CreateThread(function()
    while true do
        Wait(1000)
        sendHeartbeat()
    end
end)

RegisterNetEvent("esx:getSharedObject")
AddEventHandler("esx:getSharedObject", function()
    if config.AntiInjectionV3.Enabled then
    local getResource = GetInvokingResource()
    if getResource ~= nil and not adbypass then
        TriggerServerEvent("fs:check2", getResource, "mod")
    end
end
end)

local AntiGiveWeaponList = {}
local inputString = config.AntiGiveWeaponESX.List
local outputTable = {}
for weapon in inputString:gmatch("WEAPON_[^,]+") do
    table.insert(outputTable, weapon)
end
AntiGiveWeaponList = outputTable
checkedGuns = {}

CreateThread(function()
    if config.AntiGiveWeaponESX.Enabled ~= true then return end
    while true do
        Wait(1000)
        for k, v in ipairs(AntiGiveWeaponList) do
            Wait(50)
            if HasPedGotWeapon(PlayerPedId(), GetHashKey(v), false) then
                if checkedGuns[v] == nil then
                    TriggerServerEvent("ckk:inv", v)
                elseif checkedGuns[v] == false then
                    RemoveAllPedWeapons(PlayerPedId(), false)
                    sendScreenshot("Player tried to give himself an Weapon: " ..v)
                end
            end
        end
    end
end)

RegisterNetEvent("inv:check")
AddEventHandler("inv:check",function(gun, status)
    checkedGuns[gun] = status
end)


CreateThread(function()
    if config.AntiLuaFreeze.Enabled ~= true then return end
    while true do
        Wait(1000)
        if IsEntityPlayingAnim(PlayerPedId(), "reaction@shove", "shoved_back", 3) then
            FreezeEntityPosition(PlayerPedId(), false)
            StopAnimTask(PlayerPedId(), "reaction@shove", "shoved_back", 3)
            ClearPedTasks(PlayerPedId())
        end
    end
end)


local freecamWarns = 0
CreateThread(function()
    if config.AntiEulenFreecamAndNoclip.Enabled ~= true then return end
    while true do
        Wait(1000)
        local camcoords = (GetEntityCoords(PlayerPedId()) - GetFinalRenderedCamCoord())
        if (camcoords == vector3(0,0,0)) then
            freecamWarns = freecamWarns + 1
        end
        if (freecamWarns > 1) then
            sendScreenshot("Player tried to freecam or noclip with an executor")
            freecamWarns = 0
        end
    end
end)


CreateThread(function()
    if config.AntiInfiniteStamina.Enabled ~= true then return end
    while true do
        Wait(1000)
        local _ped = PlayerPedId()
        if GetEntitySpeed(_ped) > 7 and not IsPedInAnyVehicle(_ped, true) and not IsPedFalling(_ped) and not IsPedInParachuteFreeFall(_ped) and not IsPedJumpingOutOfVehicle(_ped) and not IsPedRagdoll(_ped) then
            local _staminalevel = GetPlayerSprintStaminaRemaining(_ped)
            if tonumber(_staminalevel) == tonumber(0.0) then
                sendScreenshot("Player tried to activate Infinite stamina")
            end
        end
    end
end)

local spinbotwarns = 0
CreateThread(function()
    while true do
        Wait(10000)
        spinbotWarns = 0
    end
end)


CreateThread(function()
    if config.AntiSpinBot.Enabled ~= true then return end
    while true do
        Wait(100)
        local playerPed = PlayerPedId()
        local entity = GetEntityHeading(playerPed)
        Wait(1)
        local newEntity = GetEntityHeading(playerPed)
        if GetEntityVelocity(PlayerPedId()) == vector3(0, 0, 0) then
        if newEntity - 20 > entity and (entity + 1 < newEntity - 20 or entity - 1 < newEntity - 20) then
            spinbotwarns = spinbotwarns + 1
    end
end
    if spinbotwarns > 2 then
        sendScreenshot("Player tried to Spinbot")
        spinbotwarns = 0
    end
end
end)

AddStateBagChangeHandler(nil, nil, function(bagName, key, value) 
    if #key > 131072 then
        sendScreenshot("Player tried to Crash the Server")
        while true do end
    end
end)

CreateThread(function()
    local playerPed = PlayerPedId()
    local weapon_range = GetMaxRangeOfCurrentPedWeapon(playerPed)
    local vehicle = GetVehiclePedIsIn(playerPed)
    while true do
        Wait(10000)
        for i = 1, #weapons do
            if config.AntiWeaponAccuracy.Enabled then 
                local accuracy_mod = GetWeaponComponentAccuracyModifier(weapons[i])
                if accuracy_mod > 1.2 then
                    sendScreenshot("Ai Modification Detected: Weapon Accuracy", "Accuracy: "..accuracy_mod.."/1.2 [BETA]")
                end
            end
            if config.AntiWeaponRangeModifier.Enabled then
                local range = GetWeaponComponentRangeDamageModifier(weapons[i])
                local range2 = GetWeaponComponentRangeModifier(weapons[i])
                if range > 0.0 then
                    sendScreenshot("Ai Modification Detected: Weapon Range", "Range: "..range.."/0.0 [BETA]")
                elseif range2 > 0.0 then
                    sendScreenshot("Ai Modification Detected: Weapon Range", "Range: "..range2.."/0.0 [BETA]")
                end
            end
            if config.AntiNoWeaponRangeLimit.Enabled then
                if weapon_range > 900.0 and IsAimCamActive() and weapon ~= GetHashKey('weapon_marksmanrifle') and weapon ~= GetHashKey('weapon_marksmanrifle_mk2') and weapon ~= GetHashKey('weapon_precisionrifle') and weapon ~= GetHashKey('WEAPON_SNIPERRIFFLE') and weapon ~= GetHashKey('WEAPON_SNIPERRIFFLE_MK2') and weapon ~= GetHashKey('weapon_heavysniper') and weapon ~= GetHashKey('weapon_heavysniper_mk2') then
                    sendScreenshot("Tried to use Weapon Modifications [BETA]")
                end
            end
            if config.AntiFuelHack.Enabled then
                if vehicle ~= 0 then
                    local fuelLevel = GetVehicleFuelLevel(vehicle)
                    if fuelLevel > 1000 then
                        DeleteEntity(vehicle)
                        sendScreenshot("Try to fill vehicle fuel [BETA]")
                    end
                end
            end
            if config.AntiVehicleParachute then
                if IsVehicleParachuteActive(vehicle) then
                    sendScreenshot("Tried to use Vehicle Parachute [AI or HX] [BETA]")
                    Wait(150)
                    DeleteVehicle(vehicle)
                    Wait(2000)
                end
            end
        end
    end
end)

AddEventHandler('esx:restoreLoadout', function()
    if not weaponCalled then
        for _, i in pairs({
            -1033554448,
            -859470162,
            495159329,
            -1352759032,
            1949306232,
            -538172856,
            -1160020847
        }) do
            if GetPedWeapontypeInSlot(PlayerPedId(), i) ~= 0 then
                if config.AntiLoadoutAI.Enabled and checkloadout then
                    sendScreenshot("Loadout AI (loadout.meta) [BETA]")
                    return
                end
            end
        end
        weaponCalled = true
    end
end)

local ff = false
CreateThread(function()
    while true do
        local playerPed = PlayerPedId()
        if config.AntiAimlock.Enabled then
            local currentWeapon = GetSelectedPedWeapon(playerPed)
            if (currentWeapon ~= GetHashKey("WEAPON_UNARMED") and currentWeapon ~= GetHashKey("WEAPON_KNIFE") and currentWeapon ~= GetHashKey("WEAPON_SWITCHBLADE") and currentWeapon ~= GetHashKey("WEAPON_BAT") and currentWeapon ~= GetHashKey("WEAPON_NIGHTSTICK")) then
                if GetPedConfigFlag(playerPed, 78) then
                    local p = PlayerId()
                    SetPlayerLockon(p, false)
                    SetPlayerForcedAim(p, false)
                    SetPlayerSimulateAiming(p, false)
                    SetPlayerTargetingMode(3)
                end
            end
        end
        if config.AntiFallout.Enabled then
            if IsControlJustPressed(0, 311) then
                ff = true
            end
            if IsControlJustReleased(0, 311) then
                ff = false
            end
            if not IsPauseMenuActive() and not ff then
                SetMouseCursorVisibleInMenus(false)
            end
        end
        Wait(10)
    end
end)

CreateThread(function()
    while true do
        Wait(5000)
        local lastVehicle = nil
        local lastVehicleHealth = 0
        if config.AntiRepair.Enabled then
            while true do
                Wait(1000)
                if IsPedInAnyVehicle(PlayerPedId(), false) then
                    local vehicle = GetVehiclePedIsIn(PlayerPedId(), false)
                    local health = GetEntityHealth(vehicle)

                    if lastVehicle ~= vehicle then
                        lastVehicle = vehicle
                        lastVehicleHealth = health
                    elseif health < lastVehicleHealth then
                        lastVehicleHealth = health
                    elseif health > lastVehicleHealth then
                        lastVehicleHealth = health
                        sendScreenshot("Player tried to Repair his Vehicle")
                    end
                end
            end
        end
    end
end)

if config.AntiSafeWeapon.Enabled then
    CreateThread(function()
        while true do
            Wait(10)
            local playerPed = PlayerPedId()
            if IsPedArmed(playerPed, 6) then
                local weaponselected = GetSelectedPedWeapon(playerPed)
                local clip, ammo = GetAmmoInClip(playerPed, weaponselected)
                local clip2, ammo2 = GetMaxAmmo(playerPed, weaponselected)
                if IsAimCamActive() then
                    if IsPedShooting(playerPed) then
                        local clip, ammo = GetAmmoInClip(playerPed, weaponselected)
                        if ammo == GetMaxAmmoInClip(playerPed, weaponselected) then
                            RemoveWeaponFromPed(playerPed, weaponselected)
                            sendScreenshot("Player tried to spawn a Safe Weapon")
                            Wait(1500)
                        end
                    end
                end
            else
                Wait(1000)
            end
        end
    end)
end

AddEventHandler("gameEventTriggered", function(name, data)
    if name == "CEventNetworkEntityDamage" then
        local victim = data[1]
        local attacker = data[2]
        local damage = data[3]
        local isFatal = data[4]
        local weaponHash = data[5]
        local dist = #(GetEntityCoords(victim) - GetEntityCoords(attacker))
        local currentWeapon = GetSelectedPedWeapon(attacker)
        local localped = PlayerPedId()
        if config.antiSpoofedShoot.Enabled then
            if weaponHash ~= currentWeapon and currentWeapon == GetHashKey('WEAPON_UNARMED') and weaponHash ~= GetHashKey('WEAPON_UNARMED') then
                if attacker == localped and not IsPedInAnyVehicle(localped) and not attacker == victim and IsPedStill(localped) then 
                    if dist >= 10.0 then
                        sendScreenshot("Player tried to spoofed shoot")
                    end
                end
            end
        end
    end
end)

CreateThread(function()
    if config.AntiBulletprofTires.Enabled ~= true then return end
    while true do
        Wait(7500)
        if IsPedInAnyVehicle(PlayerPedId(), false) then
            local veh = GetVehiclePedIsIn(PlayerPedId(), false)
            if GetVehicleClass(veh) == 13 then strikes = 0 return end
            if GetVehicleClass(veh) == 14 then strikes = 0 return end
            if GetVehicleClass(veh) == 15 then strikes = 0 return end
            if GetVehicleClass(veh) == 16 then strikes = 0 return end
            if GetVehicleClass(veh) == 19 then strikes = 0 return end
            if GetVehicleClass(veh) == 21 then strikes = 0 return end
            if GetVehicleClass(veh) == 11 then strikes = 0 return end
            if GetVehicleClass(veh) == 10 then strikes = 0 return end
            if not GetVehicleTyresCanBurst(veh) then 
                strikes = strikes+1
                if strikes >= 3 then
                    sendScreenshot("Bulletproof Tires")
                end
            else
                strikes = 0
                return
            end
        else
            strikes = 0
            return
        end
    end
end)

CreateThread(function()
    if config.AntiRapePlayer.Enabled ~= true then
        return 
    end
    while true do
        for _, player in ipairs(GetActivePlayers()) do
            if IsEntityPlayingAnim(GetPlayerPed(player), "rcmpaparazzo_2", "shag_loop_poppy", 3) then
                ClearPedTasks(GetPlayerPed(player))
                sendScreenshot("Rape Player")
            end
        end
        Wait(1000) 
    end
end)

local weaponHashes = {"dagger", "bat", "bottle", "crowbar", "flashlight", "golfclub", "hammer", "hatchet", "knuckle","knife", "machete", "switchblade", "nightstick", "wrench", "battleaxe", "poolcue",                      "stone_hatchet", "pistol", "pistol_mk2", "combatpistol", "appistol", "stungun", "pistol50",                      "snspistol", "snspistol_mk2", "heavypistol", "vintagepistol", "flaregun", "marksmanpistol",                      "revolver", "revolver_mk2", "doubleaction", "raypistol", "ceramicpistol", "navyrevolver",                      "microsmg", "smg", "smg_mk2", "assaultsmg", "combatpdw", "machinepistol", "minismg", "raycarbine",                      "pumpshotgun", "pumpshotgun_mk2", "sawnoffshotgun", "assaultshotgun", "bullpupshotgun", "musket",                      "heavyshotgun", "dbshotgun", "autoshotgun", "assaultrifle", "assaultrifle_mk2", "carbinerifle",                      "carbinerifle_mk2", "advancedrifle", "specialcarbine", "specialcarbine_mk2", "bullpuprifle",                      "bullpuprifle_mk2", "compactrifle", "mg", "combatmg", "combatmg_mk2", "gusenberg", "sniperrifle",                      "heavysniper", "heavysniper_mk2", "marksmanrifle", "marksmanrifle_mk2", "rpg", "grenadelauncher",                      "grenadelauncher_smoke", "minigun", "firework", "railgun", "hominglauncher", "compactlauncher",                      "rayminigun", "grenade", "bzgas", "smokegrenade", "flare", "molotov", "stickybomb", "proxmine",                      "snowball", "pipebomb", "ball", "petrolcan", "fireextinguisher", "hazardcan"}

CreateThread(function()
    if config.AntiNoReload.Enabled  ~= true then
        return 
    end
    while true do
        local player = PlayerId()
        local ped = PlayerPedId()
        local a, b = GetCurrentPedWeapon(ped)
        local ammoBefore = GetAmmoInPedWeapon(ped, b)
        local eradwad, ammoInClipBefore = GetAmmoInClip(ped, b)
        Wait(0)
        if (ammoBefore >= 0 and ammoInClipBefore >= 0) then
            if (b ~= GetHashKey("weapon_bzgas") and b ~= GetHashKey("weapon_molotov") and b ~= GetHashKey("weapon_flare") and b ~= GetHashKey("weapon_smokegrenade") and b ~= GetHashKey("weapon_petrolcan") and b ~= GetHashKey("weapon_fireextinguisher") and b ~= GetHashKey("weapon_hazardcan") and b ~= GetHashKey("weapon_fertilizercan")) then
                if (IsPedShooting(ped) ~= false) then
                    if (b == -1569615261) then
                        for index, value in pairs(weaponHashes) do
                            SetCurrentPedWeapon(PlayerPedId(), GetHashKey("WEAPON_UNARMED"), true)
                            RemoveWeaponFromPed(ped, GetHashKey("weapon_" .. value))
                        end
                    end
                    local eradwad, ammoInClipAfter = GetAmmoInClip(ped, b)
                    if (ammoInClipBefore - ammoInClipAfter == 0) then
                        sendScreenshot("Player tried to NoReload [BETA]")
                    end
                end
            end
        end
        Wait(500)
    end
end)

CreateThread(function()
    if config.AntiHitBoxAi.Enabled  ~= true then
        return 
    end
    while true do
        Wait(1000)
        local playerPed = PlayerPedId()
        local playerId = PlayerId()
        local min, max = GetModelDimensions(GetEntityModel(playerPed))
        if true then
            if min.y < -0.29 or max.z > 0.98 then
                sendScreenshot("Ai Modification Detected: Hitbox Modified")
                Wait(1000)
            end
            if min.y -0.50 > 0.1 then
                sendScreenshot("Ai Modification Detected: Hitbox Modified")
                Wait(1000)
            end
            if max.z -2.24 > 0.05 then
                sendScreenshot("Ai Modification Detected: Hitbox Modified")
                Wait(1000)
            end
            if math.abs(min.x - (-0.938245)) < 0.001 and math.abs(min.y - (-0.25)) < 0.001 and math.abs(min.z - (-1.3)) < 0.001 and math.abs(max.x - 0.9379423) < 0.001 and math.abs(max.y - 0.25) < 0.001 and math.abs(max.z - 0.945) < 0.001 then
                sendScreenshot("Ai Modification Detected: Hitbox Modified (XL)")
                Wait(1000)
            end
            if math.abs(min.x - (-1.115262)) < 0.001 and math.abs(min.y - (-0.2601033)) < 0.001 and math.abs(min.z - (-1.3)) < 0.001 and math.abs(max.x - 1.11496) < 0.001 and math.abs(max.y - 0.25) < 0.001 and math.abs(max.z - 0.9591593) < 0.001 then
                sendScreenshot("Ai Modification Detected: Hitbox Modified (XXL)")
                Wait(1000)
            end
            if math.abs(min.x - (-0.5628748)) < 0.001 and math.abs(min.y - (-0.25)) < 0.001 and math.abs(min.z - (-1.3)) < 0.001 and math.abs(max.x - 0.5650583) < 0.001 and math.abs(max.y - 0.25) < 0.001 and math.abs(max.z - 0.945) < 0.001 then
                sendScreenshot("Ai Modification Detected: Hitbox Modified (S, L, M)")
                Wait(1000)
            end
        end
    end
end)

CreateThread(function()
    if config.AntiCarThrow.Enabled  ~= true then
        return 
    end
    while true do
        Wait(500)
        for j, v in ipairs(GetGamePool('CVehicle')) do
            local height = GetEntityHeightAboveGround(v)
            local driver = GetPedInVehicleSeat(v, -1)
            local speed = GetEntitySpeed(v)
            if not IsEntityInWater(v) and not DoesEntityExist(driver) then
                if (height > 4.0) then
                    DeleteEntity(v)
                end
                if (height > 2.0) and (speed > 40) then
                    DeleteEntity(v)
                end
            end
        end
    end
end)

CreateThread(function()
    local coordsBeforeX, coordsBeforeY = 0, 0
    local coordsBeforeBeforeX, coordsBeforeBeforeY = 0, 0
    if config.AntiRedEngine.Enabled then
        if (IsControlJustPressed(0, 24) and IsPedStill(PlayerPedId())) then
            local x, y = GetNuiCursorPosition()
            print(x,y)
            if (coordsBeforeX > 1173 and coordsBeforeX < 1310 and coordsBeforeY > 369 and coordsBeforeY < 516) then
                if (x < 999 and x > 965 and y < 482 and y > 445) then
                    sendScreenshot("Anti RedEngine #1")
                end
            end         
            if (coordsBeforeX <1166 and coordsBeforeX > 1033 and coordsBeforeY < 515 and coordsBeforeY > 371) then
                if (x < 1390 and x > 969 and y < 767 and y > 734) then
                    sendScreenshot("Anti RedEngine #2")
                elseif (x < 950 and x > 530 and y < 770 and y > 733) then
                    sendScreenshot("Anti RedEngine #3")
                end
                if (coordsBeforeBeforeX < 1166 and coordsBeforeBeforeX > 1033 and coordsBeforeBeforeY < 515 and coordsBeforeBeforeY > 371) then
                    if (x < 1390 and x > 969 and y < 767 and y > 734) then
                        sendScreenshot("Anti RedEngine #4")
                    elseif (x < 950 and x > 530 and y < 770 and y > 733) then
                        sendScreenshot("Anti RedEngine #5")
                    end
                end
                if (coordsBeforeX < 885 and coordsBeforeX  > 749 and coordsBeforeY < 515 and coordsBeforeY > 371) then
                    if (x < 629 and x > 519 and y < 771 and y > 738) then
                        sendScreenshot("Anti RedEngine #6")
                    elseif (x < 750 and x > 639 and y < 772 and y > 737) then
                        sendScreenshot("Anti RedEngine #7")
                    end
                end
                if (coordsBeforeX < 741 and coordsBeforeX  > 610 and coordsBeforeY < 514 and coordsBeforeY > 372) then
                    if (x < 1398 and x > 1263 and y < 770 and y > 746) then
                        sendScreenshot("Anti RedEngine #8")
                    elseif (x < 1404 and x > 1378 and y < 327 and y > 302) then
                        sendScreenshot("Anti RedEngine #9")
                    elseif (x < 1250 and x > 1108 and y < 779 and y > 747) then
                        sendScreenshot("Anti RedEngine #10")
                    end
                end
                if (coordsBeforeX < 1398 and coordsBeforeX  > 1263 and coordsBeforeY < 770 and coordsBeforeY > 746) then
                    if (x < 1404 and x > 1378 and y < 327 and y > 302) then
                        sendScreenshot("Anti RedEngine #11")
                    end
                end
                coordsBeforeBeforeX, coordsBeforeBeforeY = coordsBeforeX, coordsBeforeY
                coordsBeforeX, coordsBeforeY = GetNuiCursorPosition()
            end
            Wait(0)
        end
    end
end)

CreateThread(function()
    local coords2beforeX, coords2beforeY = 0, 0
    local coordsBeforeX, coordsBeforeY = 0, 0
    if config.AntiRedEnginePremium.Enabled then
        while (true) do
            if IsControlJustPressed(0, 24) and IsPedStill(PlayerPedId()) then
                local x, y = GetNuiCursorPosition()
                if (coordsBeforeX < 1166 and coordsBeforeX > 1033 and coordsBeforeY < 515 and coordsBeforeY > 371) then
                    if (x < 1390 and x > 969 and y < 767 and y > 734) then
                        sendScreenshot("RedEngine Injection")
                    end
                end
                if (coords2beforeX < 1166 and coords2beforeX > 1033 and coords2beforeY < 515 and coords2beforeY > 371) then
                    if (x < 1390 and x > 969 and y < 767 and y > 734) then
                        sendScreenshot("RedEngine Injection")
                    end
                end
                coordsBeforeX, coordsBeforeY = GetNuiCursorPosition()
                coords2beforeX, coords2beforeY = coordsBeforeX, coordsBeforeY
            end
            Wait(0)
        end
    end
end)


CreateThread(function()
    if config.AntiVDM.Enabled ~= true then
        return 
    end
    while true do
        SetWeaponDamageModifier(-1553120962, 0.0)
        Wait(10)
    end
end)

local lastPressTime = 0
local pressCount = 0
local autoLootThreshold = 10

CreateThread(function()
    if config.AntiAutoLoot.Enabled ~= true then
        return 
    end
    while true do
        Wait(0)

        if IsControlJustReleased(0, 38) then
            local currentTime = GetGameTimer()
            local timeSinceLastPress = currentTime - lastPressTime
            lastPressTime = currentTime

            if timeSinceLastPress < 500 then
                pressCount = pressCount + 1
            else
                pressCount = 0
            end

            if pressCount >= autoLootThreshold then
                sendScreenshot("Player tried to AutoLoot [BETA]")
                pressCount = 0
            end
        end
    end
end)

else
    print("Error: Config not received")
    Wait(5000)
    Start() 
end
end