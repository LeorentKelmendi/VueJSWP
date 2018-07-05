<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5f73ef927109a14378c6c632201c0eab
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'VuePress\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'VuePress\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5f73ef927109a14378c6c632201c0eab::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5f73ef927109a14378c6c632201c0eab::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}