<?php
/**
 * This file is part of phalcon-skeleton
 *
 * @copyright Copyright (C) 2020 Jayson Wang
 * @license   MIT License
 * @link      https://github.com/lsalio/phalcon-skeleton
 */
namespace App\Library\Framework\Dispatcher;

use App\Library\Framework\Feature\Version;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;


/**
 * Class Dispatcher
 *
 * @package App\Library\Framework\Dispatcher
 */
class Dispatcher extends MvcDispatcher {

    /**
     * Overrides forward to detect deeper request
     *
     * @param array $forward
     */
    public function forward($forward) {
        $params = [];
        if (isset($forward['controller']) && strpos($forward['controller'], '/') !== false) {
            $params = explode('/', $forward['controller']);
            $forward['controller'] = array_shift($params);
        }
        if (isset($forward['action']) && strpos($forward['action'], '/') !== false) {
            $params = array_merge($params, explode('/', $forward['action']));
        }
        if (!empty($params)) {
            $forward['action'] = array_shift($params);
        }

        $forward['params'] = $params;
        return parent::forward($forward);
    }

    /**
     * Load config
     *
     * @param array $config
     * @param string $module
     * @return Dispatcher
     */
    public function loadConfig(array $config, string $module = '') {
        $this->setModuleName($module);
        if (!empty($config['controllerNamespace'])) {
            /* @var Version $version */
            $version = container('versionFeature');
            $this->setDefaultNamespace($version->namespaceOf($module, $config['controllerNamespace']));
        }
        return $this;
    }

    /**
     * Gets the name of the module with default
     *
     * @return string
     */
    public function getModuleNameWithDefault(): string {
        return $this->getModuleName() ?: container('app')->getDefaultModule();
    }

    /**
     * Gets the name of the default action
     *
     * @return string
     */
    public function getDefaultAction(): string {
        return $this->_defaultAction;
    }

}