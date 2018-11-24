<?php
/**
 * Description of RoutingLoader
 * Dynamically Load Routes
 * @author Aymen Amairia <aymen.amairia@wevioo.com>
 */

namespace App\Utils;

use Symfony\Component\Config\FileLocator;

use Symfony\Component\Config\Loader\FileLoader;
use Symfony\Component\Yaml\Yaml;

class ParameterLoader extends FileLoader
{

    public function load($resource, $type = null) //try dirname(__FILE__) instead of __DIR__
    {

        $files = $this->locator->locate($resource, null, false);

        foreach($files as $key => $file){
            if(is_file($file)){

            $parse = Yaml::parse(file_get_contents($file));  
            }

        }

        return $parse;
       
    }

    public function supports($resource, $type = null)
    {
        return is_string($resource) && 'yml' === pathinfo(
            $resource,
            PATHINFO_EXTENSION
        );
    }
}