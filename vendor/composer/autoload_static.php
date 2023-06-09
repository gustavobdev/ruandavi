<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit282e951b233a83f8440a0bd32be81a97
{
    public static $files = array (
        'f000b16ed8da556e90f9cc26638a2db7' => __DIR__ . '/../..' . '/source/Config.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Source\\' => 7,
        ),
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
        'J' => 
        array (
            'Jeidison\\JSignPDF\\' => 18,
            'JSignPDF\\JSignPDFBin\\' => 21,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
        'C' => 
        array (
            'CoffeeCode\\Router\\' => 18,
            'CoffeeCode\\Optimizer\\' => 21,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Source\\' => 
        array (
            0 => __DIR__ . '/../..' . '/source',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'Jeidison\\JSignPDF\\' => 
        array (
            0 => __DIR__ . '/..' . '/jeidison/jsignpdf-php/src',
        ),
        'JSignPDF\\JSignPDFBin\\' => 
        array (
            0 => __DIR__ . '/..' . '/jsignpdf/jsignpdf-bin/src',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
        'CoffeeCode\\Router\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/router/src',
        ),
        'CoffeeCode\\Optimizer\\' => 
        array (
            0 => __DIR__ . '/..' . '/coffeecode/optimizer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit282e951b233a83f8440a0bd32be81a97::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit282e951b233a83f8440a0bd32be81a97::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit282e951b233a83f8440a0bd32be81a97::$classMap;

        }, null, ClassLoader::class);
    }
}
