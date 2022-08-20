<?php

namespace SxxCodezx\command;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use SxxCodezx\ItemIds;

class ItemCommand extends Command {

    public function __construct()
    {
        parent::__construct("itemid", "Look at the id of the item you have in hand", null, ["id"]);
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            $playeritem = $player->getInventory()->getItemInHand();
            $meta = $playeritem->getMeta();
            $itemid = $playeritem->getId();
            $prefix = ItemIds::getInstance()->getConfig()->get("Command-Prefix");
            $message = ItemIds::getInstance()->getConfig()->get("Popup-Message");
            $message = str_replace("{META}", $meta, $message);
            $message = str_replace("{ID}", $itemid, $message);
            $player->sendMessage($prefix.$message);
        }else{

        }
    }
}