<?php

namespace SxxCodezx;

use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemHeldEvent;
use pocketmine\permission\DefaultPermissions;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use SxxCodezx\command\ItemCommand;

class ItemIds extends PluginBase implements Listener {

    public function onEnable(): void{
        $this->getLogger()->info("Item Ids Enable");
        Server::getInstance()->getPluginManager()->registerEvents($this, $this);
        Server::getInstance()->getCommandMap()->register("itemid", new ItemCommand($this));
    }

    public function getItemId(PlayerItemHeldEvent $ev){
        $player = $ev->getPlayer();
        if($player->hasPermission(DefaultPermissions::ROOT_OPERATOR)){
            $item = $ev->getItem()->getId();
            $meta = $ev->getItem()->getMeta();
            if($item === 0){
                
            }else{
                if($this->getConfig()->get("Show-Popup") === true){
                    $message = $this->getConfig()->get("Popup-Message");
                    $message = str_replace("{META}", $meta, $message);
                    $message = str_replace("{ID}", $item, $message);
                    $player->sendTip($message);
                }else if($this->getConfig()->get("Show-Popup") === false){

                }
            }
        }
    }
}
