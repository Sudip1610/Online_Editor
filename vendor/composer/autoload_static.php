<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1409741a81968f29d21977eb4ff7b1e7
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1409741a81968f29d21977eb4ff7b1e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1409741a81968f29d21977eb4ff7b1e7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}