<?php

namespace App;

use Illuminate\Foundation\Application as FoundationApplication;
use RuntimeException;

class Application extends FoundationApplication
{

    protected $appPath;

    public function __construct($basePath = null)
    {
        parent::__construct($basePath);
        $this->appPath = $basePath . DIRECTORY_SEPARATOR . 'app/App/Core';
    }

    public function getNamespace()
    {
        if (!is_null($this->namespace)) {
            return $this->namespace;
        }

        $composer = json_decode(file_get_contents($this->basePath('composer.json')), true);
        foreach ((array) data_get($composer, 'autoload.psr-4') as $namespace => $path) {
            foreach ((array) $path as $pathChoice) {
                if (realpath($this->path()) === realpath($this->basePath($pathChoice))) {
                    return $this->namespace = $namespace;
                }
            }
        }

        throw new RuntimeException('Unable to detect application namespace.');
    }
}
