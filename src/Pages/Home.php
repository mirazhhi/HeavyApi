<?php
namespace Pool\Pages;

use Pool\Acme\Log;
use Pool\Contracts\Cache;

class Home
{
    use Log;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $data;

    /**
     * Undocumented variable
     *
     * @var string
     */
    private $path;

    /**
     * Undocumented function
     *
     * @param Cache $cache
     * @throws \Exception
     */
    public function __construct(Cache $cache)
    {
        $this->logInit();
        $this->cache = $cache;
        $this->path = __DIR__ . '/../Temp/home.php';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function getData()
    {
        $this->cache->get('movies');
        $this->data = $this->cache->get('movies');
        if(is_null($this->data)) $this->data = \json_encode([]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function main()
    {
        try {
            if( !file_exists($this->path) ) {
                throw new \Exception('This file ' . $this->path . ' does not exists');
            }
//            $this->getData();
        } catch (\Throwable $th) {
            // Write log
            dd($th->getMessage());
            $this->log->warning('Error From Hone.php : ' . $th->getMessage(), [
                'options' => $th,
            ]);

            $this->path = __DIR__ . '/../404.php';
            http_response_code (404);
        }

        require $this->path;
    }
}