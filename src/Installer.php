<?php

namespace Swissup\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getInstallPath(PackageInterface $package)
    {
        list($vendor, $name) = explode('/', $package->getPrettyName());

        $vendor = str_replace('-', '', ucwords($vendor, '-'));
        $name = str_replace('-', '', ucwords($name, '-'));

        return getcwd() . '/src/' . $vendor . '/' . $name;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'magento2-module' === $packageType;
    }
}
