local url = "http://YOURIP/config.json"
PerformHttpRequest(url, function(statusCode, responseText, headers)
    if statusCode == 200 then
        local configData = json.decode(responseText)
        print(configData.logWebHook)
    else
        print("No geht nix. Status code: " .. statusCode)
    end
end)

