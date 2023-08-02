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

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $this->getLogger()->warning("Please use this command in-game");
            return false;
        }

        $x = $sender->getPosition()->getX();
        $y = $sender->getPosition()->getY();
        $z = $sender->getPosition()->getZ();

        $color = $this->getConfig()->get("ColorMode");
        $xcolorraw = $this->getConfig()->get("X");
        $xcolor = str_replace("&", "§", $xcolorraw);
        $ycolorraw = $this->getConfig()->get("Y");
        $ycolor = str_replace("&", "§", $ycolorraw);
        $zcolorraw = $this->getConfig()->get("Z");
        $zcolor = str_replace("&", "§", $zcolorraw);
        $r = "§r";

        switch ($command->getName()) {
            case "coords":
                if ($color) {
                    $sender->sendMessage("Coordinates: " . "X: " . $xcolor . $x . $r .  ", " . "Y: " . $ycolor . $y . $r . ", " . "Z: " . $zcolor . $z);
                    return true;
                } else {
                    $sender->sendMessage("Coordinates: " . "X: " . $x . ", " . "Y: "  . $y . ", " . "Z: " . $z);
                    return true;
                }
                return true;
            default:
                throw new \AssertionError("This line will never be executed");
            case "bccoords":
            
                if ($player->hasPermission("PlayerCoords.bccoords")) {
   if ($color) {
          $server = $this->getServer();      
       $server->broadcastMessage($sender . "Is broadcasting: Coordinates: " . "X: " . $xcolor . $x . $r .  ", " . "Y: " . $ycolor . $y . $r . ", " . "Z: " . $zcolor . $z);
       return true;
                }
       
   elseif (!$color) {
                    $server->broadcastMessage($sender . "Is broadcasting: Coordinates: " . "X: " . $x . ", " . "Y: "  . $y . ", " . "Z: " . $z);
                    return true;
                }
                    else{
                    $sender->sendMessage("Hey! you dont have permission!");
                        return false;
                    }
                    }
}
    }

}
