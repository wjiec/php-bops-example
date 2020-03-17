<?php
/**
 * This file is part of phalcon-skeleton
 *
 * @copyright Copyright (C) 2020 Jayson Wang
 * @license   MIT License
 * @link      https://github.com/wjiec/phalcon-skeleton
 */
namespace App\Provider\Translator;

use App\Library\Framework\Translator\Factory;
use App\Provider\AbstractServiceProvider;


/**
 * Class ServiceProvider
 * @package App\Provider\Translator
 */
class ServiceProvider extends AbstractServiceProvider {

    /**
     * Name of the service
     *
     * @var string
     */
    protected $service_name = 'translator';

    /**
     * @inheritDoc
     */
    public function register() {
        $this->di->set($this->service_name, function(string $language = '', ...$args) {
            $translator = Factory::factory($language);
            if (empty($args)) {
                return $translator;
            }
            return $translator->query(...$args);
        });
    }

}
