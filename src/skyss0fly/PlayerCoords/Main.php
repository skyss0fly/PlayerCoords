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
	/** @var Loader $plugin */
	protected $plugin;
add this above the construct function maybe
    public function __construct(Main $plugin) {
		parent::__construct("coord", "Use this to get your coordinates", null, []);
		$this->setPermission("PlayerCoords.use");
		$this->plugin = $plugin;
	}
use this construct



public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if(!$sender instanceof Player){
            $sender->sendMessage("Please Use this command in game!");
            return false;
        }
        $x = $sender->getPosition()->getX();
        $y = $sender->getPosition()->getY();
        $z = $sender->getPosition()->getX();

        switch($command->getName()){
            case "coords":
                $sender->sendMessage($x . $y. $z);

                return true;
            default:
                throw new \AssertionError("This line will never be executed");
        }
    }
}
