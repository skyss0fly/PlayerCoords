<?php

namespace skyss0fly\PlayerCoords\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use skyss0fly\PlayerCoords\Main;

class BCCoordsCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("bccoords", "Broadcast your coordinates to everyone", "/bccoords");
        $this->setPermission("PlayerCoords.bccoords");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage("Use this command in-game only!");
            return false;
        }

        $cfg = $this->plugin->getConfig();
        $server = $this->plugin->getServer();
        $name = $sender->getName();
        $r = "§r";

        $pos = $sender->getPosition();
        $x = $pos->getX();
        $y = $pos->getY();
        $z = $pos->getZ();

        if (!$sender->hasPermission("PlayerCoords.bccoords")) {
            $sender->sendMessage("§cYou don't have permission to use this command!");
            return false;
        }

        if ($cfg->get("ColorMode")) {
            $xcolor = str_replace("&", "§", $cfg->get("X"));
            $ycolor = str_replace("&", "§", $cfg->get("Y"));
            $zcolor = str_replace("&", "§", $cfg->get("Z"));
            $server->broadcastMessage("{$name} is broadcasting: Coordinates: X: {$xcolor}{$x}{$r}, Y: {$ycolor}{$y}{$r}, Z: {$zcolor}{$z}");
        } else {
            $server->broadcastMessage("{$name} is broadcasting: Coordinates: X: {$x}, Y: {$y}, Z: {$z}");
        }

        return true;
    }
}
