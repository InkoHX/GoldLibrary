<?php


namespace InkoHX\GoldLibrary;


use pocketmine\utils\Config;

class DataFile
{
    /** @var string $path */
    private $path;

    /** @var Config $config */
    private $config;

    /**
     * DataFile constructor.
     *
     * @param string $file
     */
    public function __construct(string $file)
    {
        $this->path = GoldAPI::getPath().$file;
        @mkdir($this->path, 0755, true);
        $this->config = new Config($this->path.'/data.json', Config::JSON, [
            'gold' => 0
        ]);
    }

    /**
     * @param string $key
     *
     * @return bool|mixed
     */
    public function get(string $key)
    {
        return $this->config->get($key);
    }

    /**
     * @param string $key
     * @param bool|mixed $data
     *
     * @return void
     */
    public function set(string $key, $data): void
    {
        $this->config->set($key, $data);
        $this->config->save();
    }
}