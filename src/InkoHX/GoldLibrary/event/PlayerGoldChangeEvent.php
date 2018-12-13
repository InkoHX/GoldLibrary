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

class PlayerGoldChangeEvent extends PlayerEvent implements Cancellable
{
    /** @var int $oldGold */
    private $oldGold;

    /** @var int $newGold */
    private $newGold;

    /**
     * PlayerGoldChangeEvent constructor.
     *
     * @param Player $player
     * @param int    $oldGold
     * @param int    $newGold
     */
    public function __construct(Player $player, int $oldGold, int $newGold)
    {
        $this->player = $player;
        $this->oldGold = $oldGold;
        $this->newGold = $newGold;
    }

    /**
     * @return int
     */
    public function getNewGold(): int
    {
        return $this->newGold;
    }

    /**
     * @param int $newGold
     */
    public function setNewGold(int $newGold): void
    {
        $this->newGold = $newGold;
    }

    /**
     * @return int
     */
    public function getOldGold(): int
    {
        return $this->oldGold;
    }
}
