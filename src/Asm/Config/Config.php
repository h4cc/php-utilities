<?php
/*
 * This file is part of the php-utilities package.
 *
 * (c) Marc Aschmann <maschmann@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Asm\Config;

/**
 * Class ConfigManager
 *
 * @package Asm\Config
 * @author marc aschmann <maschmann@gmail.com>
 */
final class Config
{
    /**
     * @var array
     */
    private static $whitelist = array(
        'ConfigDefault',
        'ConfigEnv',
        'ConfigTimer',
    );

    /**
     * get object of specific class
     *
     * @param  array $param config file name
     * @param  string $class name of class without
     * @throws \ErrorException
     * @throws \InvalidArgumentException
     * @return ConfigInterface
     */
    public static function factory(array $param, $class = 'ConfigDefault')
    {
        // @todo support more filetypes
        if (in_array($class, self::$whitelist)) {
            if (false === strpos($class, 'Asm')) {
                $class = __NAMESPACE__ . '\\' . $class;
            }

            // allow config names without ending
            if (empty($param['file'])) {
                throw new \InvalidArgumentException('config filename missing in param array!');
            }

            return new $class($param);
        } else {
            throw new \ErrorException('could not instantiate ' . $class . ' - not in self::$whitelist');
        }
    }

    /**
     * fordbid instantiation
     *
     * @codeCoverageIgnore
     */
    private function __construct()
    {

    }

    /**
     * forbid cloning
     *
     * @codeCoverageIgnore
     */
    private function __clone()
    {

    }
}