<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit685e4a0fb8b2612fb93ef0e81ca47078
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Root\\Go2\\' => 9,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Root\\Go2\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit685e4a0fb8b2612fb93ef0e81ca47078::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit685e4a0fb8b2612fb93ef0e81ca47078::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit685e4a0fb8b2612fb93ef0e81ca47078::$classMap;

        }, null, ClassLoader::class);
    }
}
