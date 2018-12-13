<?php
/**
 * Copyright (c) 2018 InkoHX. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/InkoHX/GoldLibrary
 */

namespace InkoHX\GoldLibrary\event;

use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerEvent;
use pocketmine\Player;

class PlayerReduceGoldEvent extends PlayerEvent implements Cancellable
{
    /** @var int $gold */
    private $gold;

    /**
     * PlayerReduceGoldEvent constructor.
     *
     * @param Player $player
     * @param int    $gold
     */
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
