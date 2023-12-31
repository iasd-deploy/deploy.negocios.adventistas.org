<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbc88d34b703f49d335f5f70922dd173f
{
    public static $files = array (
        '413614dbc06bade22a685c0ebe14027c' => __DIR__ . '/..' . '/wordplate/acf/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'E' => 
        array (
            'Extended\\ACF\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Extended\\ACF\\' => 
        array (
            0 => __DIR__ . '/..' . '/wordplate/acf/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbc88d34b703f49d335f5f70922dd173f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbc88d34b703f49d335f5f70922dd173f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitbc88d34b703f49d335f5f70922dd173f::$classMap;

        }, null, ClassLoader::class);
    }
}
