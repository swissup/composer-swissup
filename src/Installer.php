<?php

namespace Swissup\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    const TYPE_MODULE = 'magento2-module';
    const TYPE_THEME  = 'magento2-theme';

    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        list($vendor, $name) = explode('/', $package->getPrettyName());

        $vendor = str_replace('-', '', ucwords($vendor, '-'));
        $path = getcwd() . '/src/';
        switch ($package->getType()) {
            case self::TYPE_MODULE:
                $name = str_replace('-', '', ucwords($name, '-'));
                $path .= 'app/code/' . $vendor . '/' . $name;
                break;
            case self::TYPE_THEME:
                $name = str_replace('theme-', '', $name);
                list($area, $name) = explode('-', $name, 2);
                $path .= 'app/design/' . $area . '/' . $vendor . '/' . $name;
                break;
        }
        return $path;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return in_array($packageType, [
            self::TYPE_MODULE,
            self::TYPE_THEME
        ]);
    }
}
