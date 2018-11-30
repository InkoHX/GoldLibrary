<?php


namespace InkoHX\GoldLibrary\event;


use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerReduceGoldEvent extends PlayerEvent implements Cancellable
{
    /** @var int $gold */
    private $gold;

    public function __construct(Player $player, int $gold)
    {
        $this->player = $player;
        $this->gold = $gold;
    }

    /**
     * @return int
     */
    public function getGold(): int
    {
        return $this->gold;
    }
}