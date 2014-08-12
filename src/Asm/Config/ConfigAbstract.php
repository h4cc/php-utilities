<?php
/*
 * This file is part of the <package> package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Asm\Config;

use Asm\Data\Data;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigAbstract
 *
 * @package Asm\Config
 * @author marc aschmann <maschmann@gmail.com>
 */
abstract class ConfigAbstract extends Data
{
    /**
     * default constructor
     * calls child's init() method
     *
     * @param array $param
     */
    public function __construct(array $param)
    {
        // default init of child class
        $this->init($param);
    }

    /**
     * abstract init
     * behaves like an interface and enforces implementation in child class
     *
     * @abstract
     * @param array $param
     */
    abstract public function init(array $param);

    /**
     * add named property to config object
     * and insert config as array
     *
     * @param string $name name of property
     * @param string $file string $file absolute filepath/filename.ending
     */
    public function addConfig($name, $file)
    {
        $this->setKey($name, $this->readConfig($file));
    }

    /**
     * read config file via YAML parser
     *
     * @param  string $file absolute filepath/filename.ending
     * @return array  config array
     */
    public function readConfig($file)
    {
        return Yaml::parse($file);
    }

    /**
     * add config to data storage
     *
     * @param string $file absolute filepath/filename.ending
     */
    public function setConfig($file)
    {
        $this->setByArray($this->readConfig($file));
    }
}