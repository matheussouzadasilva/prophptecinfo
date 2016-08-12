<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1d991266519f241bf3f79efffdddc93b
{
    public static $files = array (
        '2c102faa651ef8ea5874edb585946bce' => __DIR__ . '/..' . '/swiftmailer/swiftmailer/lib/swift_required.php',
    );

    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'matheus\\sistemaRest\\api\\v1\\model\\' => 33,
            'matheus\\sistemaRest\\api\\v1\\lib\\' => 31,
        ),
        'R' => 
        array (
            'Respect\\Validation\\' => 19,
        ),
        'O' => 
        array (
            'Otp\\' => 4,
        ),
        'M' => 
        array (
            'MatthiasMullie\\PathConverter\\' => 29,
            'MatthiasMullie\\Minify\\' => 22,
        ),
        'B' => 
        array (
            'Base32\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'matheus\\sistemaRest\\api\\v1\\model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/api/v1/model',
        ),
        'matheus\\sistemaRest\\api\\v1\\lib\\' => 
        array (
            0 => __DIR__ . '/../..' . '/api/v1/lib',
        ),
        'Respect\\Validation\\' => 
        array (
            0 => __DIR__ . '/..' . '/respect/validation/library',
        ),
        'Otp\\' => 
        array (
            0 => __DIR__ . '/..' . '/christian-riesen/otp/src',
        ),
        'MatthiasMullie\\PathConverter\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/path-converter/src',
        ),
        'MatthiasMullie\\Minify\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/minify/src',
        ),
        'Base32\\' => 
        array (
            0 => __DIR__ . '/..' . '/christian-riesen/base32/src',
        ),
    );

    public static $prefixesPsr0 = array (
        's' => 
        array (
            'sistemaRest/tests' => 
            array (
                0 => __DIR__ . '/../..' . '/',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1d991266519f241bf3f79efffdddc93b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1d991266519f241bf3f79efffdddc93b::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit1d991266519f241bf3f79efffdddc93b::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
