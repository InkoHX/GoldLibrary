<?php
/**
 * Copyright (c) 2018 InkoHX. All rights reserved. MIT license.
 *
 * GitHub: https://github.com/InkoHX/GoldLibrary
 */

namespace InkoHX\GoldLibrary;

use InkoHX\GoldLibrary\event\PlayerAddGoldEvent;
use InkoHX\GoldLibrary\event\PlayerGoldChangeEvent;
use InkoHX\GoldLibrary\event\PlayerReduceGoldEvent;
use pocketmine\Player;
use pocketmine\Server;

class GoldAPI
{
    /** @var string $path */
    private static $path;

    /**
     * @return void
     */
    public static function init(): void
    {
        self::$path = Server::getInstance()->getDataPath().'/Library/GoldLibrary/';
    }

    /**
     * @param Player $player
     * @param int    $gold
     *
     * @throws \ReflectionException
     *
     * @return void
     */
    public static function setGold(Player $player, int $gold): void
    {
        $event = new PlayerGoldChangeEvent($player, self::getGold($player), $gold);
        $event->call();
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('gold', $event->getNewGold());
        }
    }

    /**
     * @param Player $player
     * @param int    $gold
     *
     * @throws \ReflectionException
     *
     * @return void
     */
    public static function addGold(Player $player, int $gold): void
    {
        $event = new PlayerAddGoldEvent($player, $gold);
        $event->call();
        if (!$event->isCancelled()) {
            $db = new DataFile($player->getXuid());
            $db->set('gold', self::getGold($player) + $event->getGold());
        }
    }

    /**
     * @param Player $player
     * @param int    $gold
     *
     * @throws \ReflectionException
     *
     * @return bool
     */
    public static function reduceGold(Player $player, int $gold): bool
    {
        $event = new PlayerReduceGoldEvent($player, $gold);
        $event->call();
        if (!$event->isCancelled()) {
            if (self::getGold($player) > $gold) {
                $db = new DataFile($player->getXuid());
                $db->set('gold', self::getGold($player) - $event->getGold());

                return true;
            }
        }

        return false;
    }

    /**
     * @param Player $player
     *
     * @return int
     */
    public static function getGold(Player $player): int
    {
        $db = new DataFile($player->getXuid());

        return $db->get('gold');
    }

    /**
     * @return string
     */
    public static function getPath(): string
    {
        return self::$path;
    }
}
