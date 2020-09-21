<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd4f143220bba9e7098c1b1768e5192b2
{
    public static $files = array (
        'c36202a7ae4f6da358466aaea5ae6ae2' => __DIR__ . '/..' . '/iamntz/carbon-fields-urlpicker/field.php',
    );

    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Carbon_Fields\\' => 14,
            'Carbon_Field_UrlPicker\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Carbon_Fields\\' => 
        array (
            0 => __DIR__ . '/..' . '/htmlburger/carbon-fields/core',
        ),
        'Carbon_Field_UrlPicker\\' => 
        array (
            0 => __DIR__ . '/..' . '/iamntz/carbon-fields-urlpicker/core',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd4f143220bba9e7098c1b1768e5192b2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd4f143220bba9e7098c1b1768e5192b2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
