<?php
namespace Pool;

use Pool\Acme\CronTask;
use Pool\Acme\Router;
use Pool\Acme\Application;
use Illuminate\Container\Container;

class App extends Application
{
    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $publisher;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $container;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $page;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $cron;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $router;

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    private $envRequest;

    /**
     * Undocumented function
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        // throw the notice 
        $this->envRequest = $_SERVER['SERVER_NAME'];
    }

    /**
     * Bootstrapin our application
     *
     * @return void
     */
    public function init()
    {
        $this->bindingContracts();
        $this->setInstances();

        $this->selectRequest();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function selectRequest()
    {
        if(isset($this->envRequest)) {
            return $this->buildRouter();
        }
        $this->cron->runTasks();
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function buildRouter()
    {
        dd($this->container->call([$this->router, 'runRouter'], ['container' => $this->container]));
    }

        

    /**
     * Undocumented function
     *
     * @return void
     */
    private function bindingContracts()
    {
        $this->container->bind(\Pool\Contracts\Cache::class, \Pool\Acme\Cache\Redis::class);
        $this->container->bind(\Pool\Contracts\Garbage::class, \Pool\Acme\Garbages\ExampleRequest::class);
        // $this->container->bind(\Psr\Http\Message\RequestInterface::class, \GuzzleHttp\Psr7\Request::class);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    private function setInstances()
    {
        $this->cron   = $this->container->make(CronTask::class);
        $this->router = $this->container->make(Router::class);
    }

}