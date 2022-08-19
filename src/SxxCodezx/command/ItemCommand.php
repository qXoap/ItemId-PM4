<?php

namespace SxxCodezx\command;

use pocketmine\player\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\plugin\PluginBase as Main;

class ItemCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("itemid", "Look at the id of the item you have in hand", null, ["id"]);
        $this->api = $plugin;
    }

    public function execute(CommandSender $player, string $commandLabel, array $args)
    {
        if($player instanceof Player){
            $playeritem = $player->getInventory()->getItemInHand();
            $itemid = $playeritem->getId();
            $meta = $playeritem->getMeta();
            $player->sendMessage($this->api->prefix."La Id De El Item es §5".$itemid."§f:§5".$meta);
        }else{

        }
    }
}