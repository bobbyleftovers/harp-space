<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite629e6bb5f5e3da38aaaa11d54546705
{
    public static $files = array (
        '5255c38a0faeba867671b61dfda6d864' => __DIR__ . '/..' . '/paragonie/random_compat/lib/random.php',
        '3109cb1a231dcd04bee1f9f620d46975' => __DIR__ . '/..' . '/paragonie/sodium_compat/autoload.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInite629e6bb5f5e3da38aaaa11d54546705::$classMap;

        }, null, ClassLoader::class);
    }
}
