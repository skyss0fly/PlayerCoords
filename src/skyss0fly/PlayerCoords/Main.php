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
        if(!$sender instanceof Player){
            $sender->sendMessage("Please Use this command in game!");
            return false;
        }
        $x = $sender->getPosition()->getX();
        $y = $sender->getPosition()->getY();
        $z = $sender->getPosition()->getZ();
        $color = $this->getConfig("ColorMode");
        $xcolorraw = $this->getConfig("X");
  $xcolor = str_replace("&", "§", $xcolorraw);
        $ycolorraw = $this->getConfig("Y");
   $ycolor = str_replace("&", "§", $ycolorraw);
        $zcolorraw = $this->getConfig("Z");
   $zcolor = str_replace("&", "§", $zcolorraw);
  $r = "§r";
        
        switch($command->getName()){
            case "coords":
              if ($color = true){
                $sender->sendMessage("Coordinates: " . "X: " .$xcolor . $x . $r .  ", " . "Y: " . $ycolor . $y . $r . ", " . "Z: " . $zcolor . $z);
               
                return true;
              }
            else {
              $sender->sendMessage("Coordinates: " . "X: " . $x . ", " . "Y: "  . $y . ", " . "Z: " . $z);
            default:
                throw new \AssertionError("This line will never be executed");
        }
}
    public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if(!$sender instanceof Player){
            $sender->sendMessage("Please Use this command in game!");
            return false;
        }
     
        switch($command->getName()){
            case "coordsadmin":
        $sender->sendMessage("§l§e+§d[§aCoords§cAdmin§d]§e+§r: §l§fWhat would you like to work on today?);
                return true;
            
            default:
                throw new \AssertionError("This line will never be executed");
        }
    }
public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
        if(!$sender instanceof Player){
            $sender->sendMessage("Please Use this command in game!");
            return false;
        }
     
        switch($command->getName()){
            case "colormode":
        $sender->sendMessage("§l§e+§d[§aCoords§cAdmin§d]§e+§r: §l§fColorMode: Please select a Color! §cusage: /colormode &c");
                return true;
            
            default:
                throw new \AssertionError("This line will never be executed");
        }
    }
}

