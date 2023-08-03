<?php

namespace skyss0fly\PlayerCoords;

use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class Main extends PluginBase{

    public function onEnable(): void {
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $this->getLogger()->warning("Please use this command in-game");
            return false;
        }

        $coords = $this->getPlayerCoords($sender);

        switch ($command->getName()) {
            case "coords":
                $sender->sendMessage($coords);
                return true;

            case "bccoords":
                if (!$sender->hasPermission("PlayerCoords.bccoords")) {
                    $sender->sendMessage("Hey! You don't have permission!");
                    return false;
                }

                $broadcastMessage = "$sender is broadcasting: $coords";
                $this->getServer()->broadcastMessage($broadcastMessage);
                return true;
        }
        return false;
    }
    
    private function getPlayerCoords(Player $player): string {
        $x = $player->getPosition()->getX();
        $y = $player->getPosition()->getY();
        $z = $player->getPosition()->getZ();

        $color = $this->getConfig()->get("ColorMode");
        $xcolor = $this->getColor($this->getConfig()->get("X"));
        $ycolor = $this->getColor($this->getConfig()->get("Y"));
        $zcolor = $this->getColor($this->getConfig()->get("Z"));

        return "Coordinates: X: ${xcolor}${x}§r, Y: ${ycolor}${y}§r, Z: ${zcolor}${z}";
    }

    private function getColor(string $colorCode): string {
        return str_replace("&", "§", $colorCode);
    }
}
