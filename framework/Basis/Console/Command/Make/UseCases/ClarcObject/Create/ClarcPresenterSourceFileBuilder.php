<?php


namespace Clarc\Basis\Console\Command\Make\UseCases\ClarcObject\Create;


use nrslib\Cfg\ClassRenderer;
use nrslib\Cfg\Meta\Classes\ClassMeta;
use nrslib\Cfg\Meta\Words\AccessLevel;
use nrslib\Clarc\SourceFileBuilder\Presenter\PresenterSourceFileBuilderInterface;
use nrslib\Clarc\UseCases\Commons\Ds\SourceFileData;
use nrslib\Clarc\UseCases\UseCase\Create\UseCaseSchema;
use Clarc\Basis\Console\Command\Make\ClarcConfig;

class ClarcPresenterSourceFileBuilder implements PresenterSourceFileBuilderInterface
{
    /**
     * @var ClassRenderer
     */
    private $classRenderer;

    /**
     * LaravelPresenterSourceFileBuilder constructor.
     * @param ClassRenderer $classRenderer
     */
    public function __construct(ClassRenderer $classRenderer)
    {
        $this->classRenderer = $classRenderer;
    }


    function build(UseCaseSchema $schema, string $namespace, string $outputDataName, string $outputPortName, string $outputPortNamespace): SourceFileData
    {
        $name = $schema->fullName() . 'Presenter';

        $clazz = new ClassMeta($name , $namespace . '\\' . $schema->usecaseName);
        $clazz->setupClass()
            ->addUse($outputPortNamespace . '\\' . $outputPortName)
            ->addUse($outputPortNamespace . '\\' . $outputDataName)
            ->addUse(ClarcConfig::NAMESPACE_PRESENTER . '\\' . $schema->categoryName . '\\' . $schema->usecaseName . '\\' . $schema->fullName() . 'ViewModel')
            ->addImplement($outputPortName);

        $clazz->setupMethods()
            ->addMethod('output', function ($methodDefine) use ($outputDataName, $schema) {
                $methodDefine->addArgument('outputData', $outputDataName)
                    ->setAccessLevel(AccessLevel::public())
                    ->addBody('$viewModel = new ' . $schema->fullName() . 'ViewModel($outputData);')
                    ->addBody('echo view(\'' . lcfirst($schema->categoryName) . '.' . lcfirst($schema->usecaseName)  . '\', compact(\'viewModel\'));');
            });

        $contents = $this->classRenderer->render($clazz);

        return new SourceFileData($name, $contents);
    }
}