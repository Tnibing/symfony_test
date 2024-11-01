<?php

namespace Proxies\__CG__\App\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Client extends \App\Entity\Client implements \Doctrine\ORM\Proxy\InternalProxy
{
     use \Symfony\Component\VarExporter\LazyGhostTrait {
        initializeLazyObject as private;
        setLazyObjectAsInitialized as public __setInitialized;
        isLazyObjectInitialized as private;
        createLazyGhost as private;
        resetLazyObject as private;
    }

    public function __load(): void
    {
        $this->initializeLazyObject();
    }
    

    private const LAZY_OBJECT_PROPERTY_SCOPES = [
        "\0".parent::class."\0".'accounts' => [parent::class, 'accounts', null],
        "\0".parent::class."\0".'apellidos' => [parent::class, 'apellidos', null],
        "\0".parent::class."\0".'dni' => [parent::class, 'dni', null],
        "\0".parent::class."\0".'fecha_nacimiento' => [parent::class, 'fecha_nacimiento', null],
        "\0".parent::class."\0".'id' => [parent::class, 'id', null],
        "\0".parent::class."\0".'nombre' => [parent::class, 'nombre', null],
        'accounts' => [parent::class, 'accounts', null],
        'apellidos' => [parent::class, 'apellidos', null],
        'dni' => [parent::class, 'dni', null],
        'fecha_nacimiento' => [parent::class, 'fecha_nacimiento', null],
        'id' => [parent::class, 'id', null],
        'nombre' => [parent::class, 'nombre', null],
    ];

    public function __isInitialized(): bool
    {
        return isset($this->lazyObjectState) && $this->isLazyObjectInitialized();
    }

    public function __serialize(): array
    {
        $properties = (array) $this;
        unset($properties["\0" . self::class . "\0lazyObjectState"]);

        return $properties;
    }
}
