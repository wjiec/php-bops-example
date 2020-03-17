<?php
/**
 * This file is part of phalcon-skeleton
 *
 * @copyright Copyright (C) 2020 Jayson Wang
 * @license   MIT License
 * @link      https://github.com/wjiec/phalcon-skeleton
 */
namespace App\Provider\ErrorHandler;

use App\Library\Framework\Exception\Handler\LoggerHandler;
use App\Provider\AbstractServiceProvider;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;


/**
 * Class ServiceProvider
 * @package App\Provider\ErrorHandler
 */
class ServiceProvider extends AbstractServiceProvider {

    /**
     * Name of the service
     *
     * @var string
     */
    protected $service_name = 'errorHandler';

    /**
     * @inheritDoc
     */
    public function register() {
        $this->di->setShared("{$this->service_name}.loggerHandler", LoggerHandler::class);
        $this->di->setShared("{$this->service_name}.prettyPageHandler", PrettyPageHandler::class);

        $service_name = $this->service_name;
        $this->di->setShared($this->service_name, function() use ($service_name) {
            $run = new Run();
            $run->appendHandler(container("{$service_name}.loggerHandler"));

            if (env('APP_DEBUG', false)) {
                $run->appendHandler(container("{$service_name}.prettyPageHandler"));
            }
            return $run;
        });
    }

    /**
     * @inheritDoc
     */
    public function initialize() {
        /* @var $run Run */
        $run = container($this->service_name);
        $run->register();
    }

}
