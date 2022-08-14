<?php

namespace SxxCodezx;

use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class ItemIds extends PluginBase implements Listener {

    public function onEnable(): void{
        $this->getLogger()->info("Item Ids Enable");
        Server::getInstance()->getPluginManager()->registerEvents($this, $this);
    }

    public function getItemId(PlayerItemHeldEvent $ev){
        $player = $ev->getPlayer();
        if($player->hasPermission(DefaultPermissions::ROOT_OPERATOR)){
            $item = $ev->getItem()->getId();
            $meta = $ev->getItem()->getMeta();
            if($item === 0){
                
            }else{
                $player->sendTip("§8ItemId§f §5".$item."§f:§5".$meta);
            }
        }
    }
}
