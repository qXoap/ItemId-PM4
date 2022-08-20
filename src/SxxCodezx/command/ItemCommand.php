<?php

namespace SxxCodezx\command;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\Server;
use SxxCodezx\ItemIds;
use SxxCodezx\Sounds;

class ItemCommand extends Command {

    public function __construct()
    {
        parent::__construct("itemid", "Look at the id of the item you have in hand", null, ["id"]);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            if($player->hasPermission(DefaultPermissions::ROOT_OPERATOR)){
                $playeritem = $player->getInventory()->getItemInHand();
                $meta = $playeritem->getMeta();
                $itemid = $playeritem->getId();
                $prefix = ItemIds::getInstance()->getConfig()->get("Command-Prefix");
                $message = ItemIds::getInstance()->getConfig()->get("Command-Error-Message");
                if($itemid === 0){
                    $player->sendMessage($prefix.$message);
                    if(ItemIds::getInstance()->getConfig()->get("Command-Sound") === true){
                        Sounds::addSound($player, ItemIds::getInstance()->getConfig()->get("Error-Sound"), 50, 1);
                    }
                }else{
                    $prefix = ItemIds::getInstance()->getConfig()->get("Command-Prefix");
                    $message = ItemIds::getInstance()->getConfig()->get("Command-Message");
                    $message = str_replace("{META}", $meta, $message);
                    $message = str_replace("{ID}", $itemid, $message);
                    $player->sendMessage($prefix.$message);
                    if(ItemIds::getInstance()->getConfig()->get("Command-Sound") === true){
                        Sounds::addSound($player, ItemIds::getInstance()->getConfig()->get("Sucess-Sound"), 50, 1);
                    }
                }
            }else{
                $prefix = ItemIds::getInstance()->getConfig()->get("Command-Prefix");
                $message = ItemIds::getInstance()->getConfig()->get("No-Permission-Message");
                $player->sendMessage($prefix.$message);
                if(ItemIds::getInstance()->getConfig()->get("Command-Sound") === true){
                    Sounds::addSound($player, ItemIds::getInstance()->getConfig()->get("No-Permission-Sound"), 50, 1);
                }
            }
        }else{

        }
    }
}