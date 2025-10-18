<?php

namespace skyss0fly\PlayerCoords;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use skyss0fly\PlayerCoords\command\CoordsCommand;
use skyss0fly\PlayerCoords\command\FCoordsCommand;
use skyss0fly\PlayerCoords\command\BCCoordsCommand;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        // Register commands
        $commandMap = $this->getServer()->getCommandMap();
        $commandMap->register("playercoords", new CoordsCommand($this));
        $commandMap->register("playercoords", new FCoordsCommand($this));
        $commandMap->register("playercoords", new BCCoordsCommand($this));
    }
}
