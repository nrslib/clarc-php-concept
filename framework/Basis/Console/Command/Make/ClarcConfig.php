<?php


namespace Clarc\Basis\Console\Command\Make;


class ClarcConfig
{
    public const NAMESPACE_APP = 'App';

    public const NAMESPACE_APPLICATION = self::NAMESPACE_APP . '\\' . 'Application';
    public const NAMESPACE_INPUT_PORT = self::NAMESPACE_APPLICATION . '\\' . 'InputPorts';
    public const NAMESPACE_INTERACTOR = self::NAMESPACE_APPLICATION . '\\' . 'Interactors';
    public const NAMESPACE_OUTPUT_PORT = self::NAMESPACE_APPLICATION . '\\' . 'OutputPorts';

    public const NAMESPACE_INTERFACE_ADAPTERS = self::NAMESPACE_APP . '\\' . 'InterfaceAdapters';
    public const NAMESPACE_CONTROLLER = self::NAMESPACE_INTERFACE_ADAPTERS . '\\' . 'Controllers';
    public const NAMESPACE_PRESENTER = self::NAMESPACE_INTERFACE_ADAPTERS . '\\' . 'Presenters';
    public const NAMESPACE_GATEWAYS = self::NAMESPACE_INTERFACE_ADAPTERS . '\\' . 'GateWays';

    public const NAMESPACE_STARTUP = self::NAMESPACE_APP . '\\' . 'Startup';

    public const DIR_APP = 'app/';

    public const DIR_APPLICATION = self::DIR_APP . 'Application/';
    public const DIR_INPUT_PORT = self::DIR_APPLICATION . 'InputPorts/';
    public const DIR_INTERACTOR = self::DIR_APPLICATION . 'Interactors/';
    public const DIR_OUTPUT_PORT = self::DIR_APPLICATION . 'OutputPorts/';

    public const DIR_INTERFACE_ADAPTERS = self::DIR_APP . 'InterfaceAdapters/';
    public const DIR_CONTROLLER = self::DIR_INTERFACE_ADAPTERS . 'Controllers/';
    public const DIR_PRESENTER = self::DIR_INTERFACE_ADAPTERS . 'Presenters/';

    public const DIR_STARTUP = self::DIR_APP . 'Startup/';
    public const FILE_CLARC_STARTUP = self::DIR_STARTUP . 'Startup.php';
}