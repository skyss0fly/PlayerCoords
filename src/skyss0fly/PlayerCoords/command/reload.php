<?php

namespace skyss0fly\PlayerCoords;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;

class reload extends PluginBase {
public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if(!$sender instanceof Player){
            $sender->sendMessage("Please Use this command in game!");
            return false;
        }
    
        switch($command->getName()){
            case "reloadcoords":
         
                $this->getServer()->broadcastMessage("§l§e+§d[§fPlayerCoords§d]§e+ §r§eSuccessfully reloaded!);
                return true;
            default:
                throw new \AssertionError("This line will never be executed");
        
        }

}
