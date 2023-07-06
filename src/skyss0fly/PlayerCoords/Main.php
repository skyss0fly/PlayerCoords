<?php

namespace skyss0fly\PlayerCoords;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\world\Position;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

  
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        $coords = $sender->getCoordinates();
		switch($command->getName()){
			case "coords":
				$sender->sendMessage($coords);

				return true;
			default:
				throw new \AssertionError("This line will never be executed");
		}
	}
}
