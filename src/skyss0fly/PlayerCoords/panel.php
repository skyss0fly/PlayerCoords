<?php

namespace skyss0fly\PlayerCoords;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
class panel {
public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $this->getLogger()->warning("Please use this command in-game");
            return false;
        }

     
        switch ($command->getName()) {
            case "panel":
               $colormode = $this->getConfig()->get("ColorMode");
         if ($colormode){
$sender->sendMessage("ColorMode Disabled");
            file_put_contents($colormode,"False");
         }
         $sender->sendMessage("ColorMode Enabled");
     file_put_contents($colormode,"True");
        return false;
}
}
