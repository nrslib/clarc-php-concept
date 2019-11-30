<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append;


use nrslib\Cfg\ClassRenderer;
use nrslib\Cfg\Parser\ClassParser;
use Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append\Scripts\AppendUseCaseScriptInterface;
use Clarc\Basis\Console\Command\Make\UseCases\Dependency\Append\Scripts\UseCaseSettingScript;

class DependencyAppendUseCaseInteractor implements DependencyAppendUseCaseInputPortInterface
{
    /**
     * @var DependencyAppendUseCaseOutputPortInterface
     */
    private $outputPort;

    /**
     * ClarcProviderAppendUseCaseInteractor constructor.
     * @param DependencyAppendUseCaseOutputPortInterface $outputPort
     */
    public function __construct(DependencyAppendUseCaseOutputPortInterface $outputPort)
    {
        $this->outputPort = $outputPort;
    }


    function handle(DependencyAppendUseCaseInputData $inputData)
    {
        $parser = new ClassParser();
        $classMeta = $parser->parse($inputData->clarcProviderCode);

        $classMeta->setupMethods()
            ->updateMethod('registerUseCases', function ($definition) use ($inputData) {
                $body = $definition->getBody();
                $definition->clearBody();

                $scripts = $this->divideScripts($body);

                $comment = '// ' . $inputData->identifer;
                $controllerBindCode = $this->makeBindCode($inputData->controllerName, $inputData->controllerName);
                $inputPortBindCode = $this->makeBindCode($inputData->inputPortName, $inputData->interactorName);
                $outputPortBindCode = $this->makeBindCode($inputData->outputPortName, $inputData->presenterName);
                $script = new UseCaseSettingScript($comment, $controllerBindCode, $inputPortBindCode, $outputPortBindCode);

                if (!$this->exists($scripts, $script)) {
                    array_push($scripts, $script);
                }

                usort($scripts, function ($l, $r) {
                    return $l->getKey() < $r->getKey() ? -1 : 1;
                });

                foreach ($scripts as $script) {
                    $lines = $script->getScripts();
                    foreach ($lines as $line)
                    {
                        $definition->addBody($line);
                    }
                }
            });

        $renderer = new ClassRenderer();
        $rendered = $renderer->render($classMeta);

        $outputData = new DependencyAppendUseCaseOutputData($rendered);

        $this->outputPort->output($outputData);
    }

    private function makeBindCode(string $interfaceName, string $implementName = null)
    {
        if (is_null($implementName)) {
            return '$serviceCollection->addTransient( ' . $interfaceName . '::class);';
        } else {
            return '$serviceCollection->addTransient( ' . $interfaceName . '::class, ' . $implementName . '::class);';
        }
    }

    /**
     * @param array $lines
     * @return AppendUseCaseScriptInterface[]
     * @throws \Exception
     */
    private function divideScripts(array $lines): array
    {
        $results = [];
        $lineCount = count($lines);
        for ($i = 0; $i < $lineCount; $i++)
        {
            $line = $lines[$i];
            if ($this->startsWith($line, '//')) {
                $comment = $line;
                $bindController = $lines[++$i];
                $bindInputPort = $lines[++$i];
                $bindOutputPort = $lines[++$i];
                array_push($results, new UseCaseSettingScript($comment, $bindController, $bindInputPort, $bindOutputPort));
            } else if ($this->startsWith($line, '$serviceCollection->addTransient')) {
                $bindController = $line;
                $bindInputPort = $lines[++$i];
                $bindOutputPort = $lines[++$i];
                array_push($results, new UseCaseSettingScript(null, $bindController, $bindInputPort, $bindOutputPort));
            } else {
                throw new \Exception();
            }
        }

        return $results;
    }

    private function exists(array $scripts, UseCaseSettingScript $script): bool
    {
        $duplicates = array_filter($scripts, function ($s) use ($script) { return $s->getKey() === $script->getKey(); });
        return !empty($duplicates);
    }

    private function startsWith(string $target, $word): bool
    {
        return strpos($target, $word) === 0;
    }
}

class UseCaseSetting
{
    public $comment;
    public $bindInputPort;
    public $bindOutputPort;

    /**
     * UseCaseSetting constructor.
     * @param $comment
     * @param $bindInputPort
     * @param $bindOutputPort
     */
    public function __construct($comment, $bindInputPort, $bindOutputPort)
    {
        $this->comment = $comment;
        $this->bindInputPort = $bindInputPort;
        $this->bindOutputPort = $bindOutputPort;
    }
}