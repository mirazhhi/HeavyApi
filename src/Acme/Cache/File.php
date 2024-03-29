<?php
namespace Pool\Acme\Cache;

use Pool\Contracts\Cache;

class File implements Cache
{
    private $client;

    public function __construct(SomeClass $client)
    {
        $this->client = $client;
    }

    public function set(string $key, string $data)
    {
        $this->client->set($key, $data);
    }

    public function get(string $key) : string
    {
        return $this->client->get($key);
    }


    public function clear(string $key)
    {

    }

}