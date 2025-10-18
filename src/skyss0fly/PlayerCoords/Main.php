<?php

namespace skyss0fly\PlayerCoords;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Internet;
use skyss0fly\PlayerCoords\command\CoordsCommand;
use skyss0fly\PlayerCoords\command\FCoordsCommand;
use skyss0fly\PlayerCoords\command\BCCoordsCommand;
use function json_decode;
use function version_compare;
use function basename;
use pocketmine\Server;

class Main extends PluginBase implements Listener {

    private string $pluginName = "PlayerCoords";
    private bool $autoUpdateEnabled = false;
    private int $checkInterval = 3600; // seconds

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        // Load updater settings
        $this->autoUpdateEnabled = $this->getConfig()->getNested("auto-update.enabled", false);
        $this->checkInterval = $this->getConfig()->getNested("auto-update.check-interval", 3600);

        // Register commands
        $commandMap = $this->getServer()->getCommandMap();
        $commandMap->register("playercoords", new CoordsCommand($this));
        $commandMap->register("playercoords", new FCoordsCommand($this));
        $commandMap->register("playercoords", new BCCoordsCommand($this));

        // Schedule update checks
        $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function(): void {
            $this->checkForUpdates();
        }), 20 * $this->checkInterval);
    }

    private function checkForUpdates(): void {
        $url = "https://poggit.pmmp.io/releases.json?name=" . urlencode($this->pluginName);

        Internet::getURL($url, 10, [], function (?string $data): void {
            if ($data === null) {
                $this->getLogger()->warning("Failed to check for updates — no response from Poggit.");
                return;
            }

            $json = json_decode($data, true);
            if (!isset($json[0])) {
                $this->getLogger()->warning("Failed to parse Poggit API response.");
                return;
            }

            $latest = $json[0];
            $latestVersion = $latest["version"] ?? "unknown";
            $pmVersion = $latest["api"][0] ?? "unknown";

            if ($this->isCompatible($pmVersion) && version_compare($latestVersion, $this->getDescription()->getVersion(), ">")) {
                $this->getLogger()->info("§eA new version ($latestVersion) of {$this->pluginName} is available for PM $pmVersion!");

                if ($this->autoUpdateEnabled) {
                    $this->downloadAndInstall($latest["artifact_url"]);
                }
            } else {
                $this->getLogger()->info("§a{$this->pluginName} is up to date.");
            }
        });
    }

    private function isCompatible(string $pmVersion): bool {
        $serverVersion = Server::getInstance()->getVersion();
        return str_starts_with($serverVersion, explode(".", $pmVersion)[0]);
    }

    private function downloadAndInstall(string $artifactUrl): void {
        $this->getLogger()->info("§eDownloading latest version from Poggit...");
        Internet::getURL($artifactUrl, 20, [], function (?string $data) use ($artifactUrl): void {
            if ($data === null) {
                $this->getLogger()->error("Failed to download update from $artifactUrl");
                return;
            }

            $pluginPath = $this->getServer()->getDataPath() . "plugins/" . basename($artifactUrl);
            file_put_contents($pluginPath, $data);
            $this->getLogger()->info("§aSuccessfully downloaded plugin. Restart the server to apply changes.");
        });
    }
}
