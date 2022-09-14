<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ee4091a82a8889a690c151938d32ced
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit1ee4091a82a8889a690c151938d32ced::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1ee4091a82a8889a690c151938d32ced::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1ee4091a82a8889a690c151938d32ced::$classMap;

        }, null, ClassLoader::class);
    }
}