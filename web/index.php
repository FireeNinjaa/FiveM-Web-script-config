<?php
$configFile = "config.json";

function saveConfig($data)
{
	global $configFile;
	file_put_contents($configFile, json_encode($data, JSON_PRETTY_PRINT));
}

function loadConfig()
{
	global $configFile;
	if (file_exists($configFile)) {
		return json_decode(file_get_contents($configFile), true);
	}
	return [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$configData = loadConfig();

	$checkboxOptions = ["AntiGodMode", "betastuff"];
	foreach ($checkboxOptions as $option) {
		$configData[$option] = isset($_POST[$option]);
	}

	$textInputOptions = ["logWebHook", "BanOrKick"];
	foreach ($textInputOptions as $option) {
		$configData[$option] = $_POST[$option];
	}

	saveConfig($configData);
}

$configData = loadConfig();
?>

<!DOCTYPE html>
<html>


<body>
	<form method="post">
		<label for="option1">AntiGodMode:</label>
		<input type="checkbox" name="AntiGodMode" <?php if ($configData["AntiGodMode"]) echo "checked"; ?>>
		<br>
		<label for="option2"> Betastuff:</label>
		<input type="checkbox" name="betastuff" <?php if ($configData["betastuff"]) echo "checked"; ?>>
		<br>

		<label for="value1">Webhhook:</label>
		<input type="text" name="logWebHook" value="<?php echo $configData["logWebHook"]; ?>">
		<br>
		<label for="value2">BanOrKick:</label>
		<input type="text" name="BanOrKick" value="<?php echo $configData["BanOrKick"]; ?>">
		<br>

		<input type="submit" value="Save">
	</form>
</body>

</html>