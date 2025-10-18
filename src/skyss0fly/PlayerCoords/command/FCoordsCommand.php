<?php

namespace skyss0fly\PlayerCoords\command;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use skyss0fly\PlayerCoords\Main;

class FCoordsCommand extends Command {

    private Main $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("fcoords", "Show your floored coordinates", "/fcoords");
        $this->setPermission("PlayerCoords.fcoords");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $label, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage("Use this command in-game only!");
            return false;
        }

        $pos = $sender->getPosition();
        $x = $pos->getFloorX();
        $y = $pos->getFloorY();
        $z = $pos->getFloorZ();

        $cfg = $this->plugin->getConfig();
        $r = "§r";

        if ($cfg->get("ColorMode")) {
            $xcolor = str_replace("&", "§", $cfg->get("X"));
            $ycolor = str_replace("&", "§", $cfg->get("Y"));
            $zcolor = str_replace("&", "§", $cfg->get("Z"));
            $sender->sendMessage("Coordinates: X: {$xcolor}{$x}{$r}, Y: {$ycolor}{$y}{$r}, Z: {$zcolor}{$z}");
        } else {
            $sender->sendMessage("Coordinates: X: {$x}, Y: {$y}, Z: {$z}");
        }
        return true;
    }
}
