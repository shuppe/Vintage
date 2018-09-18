<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitbda2079712ddc674c49aad6e46bf91f2
{
    public static $files = array (
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Validator\\' => 28,
            'Symfony\\Component\\Translation\\' => 30,
            'Symfony\\Component\\Finder\\' => 25,
            'Symfony\\Component\\Filesystem\\' => 29,
            'Symfony\\Component\\Console\\' => 26,
            'Symfony\\Component\\Config\\' => 25,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Validator\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/validator',
        ),
        'Symfony\\Component\\Translation\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/translation',
        ),
        'Symfony\\Component\\Finder\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/finder',
        ),
        'Symfony\\Component\\Filesystem\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/filesystem',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Symfony\\Component\\Config\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/config',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'Propel' => 
            array (
                0 => __DIR__ . '/..' . '/propel/propel/src',
            ),
        ),
    );

    public static $classMap = array (
        'Alignement' => __DIR__ . '/../..' . '/model/vhl/Alignement.php',
        'AlignementQuery' => __DIR__ . '/../..' . '/model/vhl/AlignementQuery.php',
        'Arena' => __DIR__ . '/../..' . '/model/vhl/Arena.php',
        'ArenaQuery' => __DIR__ . '/../..' . '/model/vhl/ArenaQuery.php',
        'Base\\Alignement' => __DIR__ . '/../..' . '/model/vhl/Base/Alignement.php',
        'Base\\AlignementQuery' => __DIR__ . '/../..' . '/model/vhl/Base/AlignementQuery.php',
        'Base\\Arena' => __DIR__ . '/../..' . '/model/vhl/Base/Arena.php',
        'Base\\ArenaQuery' => __DIR__ . '/../..' . '/model/vhl/Base/ArenaQuery.php',
        'Base\\Equipe' => __DIR__ . '/../..' . '/model/vhl/Base/Equipe.php',
        'Base\\EquipeQuery' => __DIR__ . '/../..' . '/model/vhl/Base/EquipeQuery.php',
        'Base\\Formation' => __DIR__ . '/../..' . '/model/vhl/Base/Formation.php',
        'Base\\FormationQuery' => __DIR__ . '/../..' . '/model/vhl/Base/FormationQuery.php',
        'Base\\Joueur' => __DIR__ . '/../..' . '/model/vhl/Base/Joueur.php',
        'Base\\JoueurQuery' => __DIR__ . '/../..' . '/model/vhl/Base/JoueurQuery.php',
        'Base\\Partie' => __DIR__ . '/../..' . '/model/vhl/Base/Partie.php',
        'Base\\PartieQuery' => __DIR__ . '/../..' . '/model/vhl/Base/PartieQuery.php',
        'Base\\Position' => __DIR__ . '/../..' . '/model/vhl/Base/Position.php',
        'Base\\PositionJoueur' => __DIR__ . '/../..' . '/model/vhl/Base/PositionJoueur.php',
        'Base\\PositionJoueurQuery' => __DIR__ . '/../..' . '/model/vhl/Base/PositionJoueurQuery.php',
        'Base\\PositionQuery' => __DIR__ . '/../..' . '/model/vhl/Base/PositionQuery.php',
        'Equipe' => __DIR__ . '/../..' . '/model/vhl/Equipe.php',
        'EquipeQuery' => __DIR__ . '/../..' . '/model/vhl/EquipeQuery.php',
        'Formation' => __DIR__ . '/../..' . '/model/vhl/Formation.php',
        'FormationQuery' => __DIR__ . '/../..' . '/model/vhl/FormationQuery.php',
        'Joueur' => __DIR__ . '/../..' . '/model/vhl/Joueur.php',
        'JoueurQuery' => __DIR__ . '/../..' . '/model/vhl/JoueurQuery.php',
        'Map\\AlignementTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/AlignementTableMap.php',
        'Map\\ArenaTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/ArenaTableMap.php',
        'Map\\EquipeTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/EquipeTableMap.php',
        'Map\\FormationTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/FormationTableMap.php',
        'Map\\JoueurTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/JoueurTableMap.php',
        'Map\\PartieTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/PartieTableMap.php',
        'Map\\PositionJoueurTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/PositionJoueurTableMap.php',
        'Map\\PositionTableMap' => __DIR__ . '/../..' . '/model/vhl/Map/PositionTableMap.php',
        'Partie' => __DIR__ . '/../..' . '/model/vhl/Partie.php',
        'PartieQuery' => __DIR__ . '/../..' . '/model/vhl/PartieQuery.php',
        'Position' => __DIR__ . '/../..' . '/model/vhl/Position.php',
        'PositionJoueur' => __DIR__ . '/../..' . '/model/vhl/PositionJoueur.php',
        'PositionJoueurQuery' => __DIR__ . '/../..' . '/model/vhl/PositionJoueurQuery.php',
        'PositionQuery' => __DIR__ . '/../..' . '/model/vhl/PositionQuery.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitbda2079712ddc674c49aad6e46bf91f2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitbda2079712ddc674c49aad6e46bf91f2::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInitbda2079712ddc674c49aad6e46bf91f2::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitbda2079712ddc674c49aad6e46bf91f2::$classMap;

        }, null, ClassLoader::class);
    }
}
