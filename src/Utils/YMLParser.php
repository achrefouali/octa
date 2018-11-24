<?php

namespace App\Utils;

use App\Utils\FileParserInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

use Symfony\Component\Finder\Finder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;
use App\Exception\ModelManagerException;


class YMLParser //extends FileLoader //implements FileParserInterface 
{



    static function parse($resource = "parameters.yml", $type = null) //try dirname(__FILE__) instead of __DIR__
    {
        $parameterLoaded = [];
        $finder = new Finder();

        $finder->files()->name('parameters.yml')->in(__DIR__ . '/../../../config');
        foreach ($finder as $file) {   
            $parameterLoaded[] = explode('parameters.yml', $file->getRealPath())[0];
        }

        $parameterLoader = new ParameterLoader(new FileLocator($parameterLoaded));
        $parameters = $parameterLoader->load('parameters.yml', 'yaml');
        return $parameters;
    }

    static function searchIndex($file, $index , array $array){
        $accessor = PropertyAccess::createPropertyAccessor();
        $array = self::parse($file);

        return $accessor->getValue($array, '['.$index.']');
    }


    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}



?>