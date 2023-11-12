<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit86f88b03209f422ba3cd1da5eedbe6d9
{
    public static $files = array (
        '3917c79c5052b270641b5a200963dbc2' => __DIR__ . '/..' . '/kint-php/kint/init.php',
    );

    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'Kint\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Kint\\' => 
        array (
            0 => __DIR__ . '/..' . '/kint-php/kint/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit86f88b03209f422ba3cd1da5eedbe6d9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit86f88b03209f422ba3cd1da5eedbe6d9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit86f88b03209f422ba3cd1da5eedbe6d9::$classMap;

        }, null, ClassLoader::class);
    }
}