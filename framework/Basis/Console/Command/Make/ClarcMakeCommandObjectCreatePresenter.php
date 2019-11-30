<?php


namespace Clarc\Basis\Console\Command\Make;


use Clarc\Basis\Console\Command\Make\UseCases\ClarcObject\Create\ClarcObjectCreateOutputData;
use Clarc\Basis\Console\Command\Make\UseCases\ClarcObject\Create\ClarcObjectCreateOutputPortInterface;
use nrslib\Clarc\UseCases\Commons\Ds\SourceFileData;
use nrslib\Clarc\UseCases\UseCase\Create\UseCaseSchema;

class ClarcMakeCommandObjectCreatePresenter implements ClarcObjectCreateOutputPortInterface
{
    /**
     * @var ClarcMakeCommand
     */
    private $command;
    /**
     * @var UseCaseSchema
     */
    private $schema;

    public function __construct(ClarcMakeCommand $command, UseCaseSchema $schema)
    {
        $this->command = $command;
        $this->schema = $schema;
    }

    public function output(ClarcObjectCreateOutputData $outputData)
    {
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_CONTROLLER, true), $outputData->getControllerSourceFile());
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_INPUT_PORT, true), $outputData->getInputDataSourceFile());
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_INPUT_PORT, true), $outputData->getInputPortSourceFile());
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_INTERACTOR, true), $outputData->getInteractorSourceFile());
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_OUTPUT_PORT, true), $outputData->getOutputDataSourceFile());
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_OUTPUT_PORT, true), $outputData->getOutputPortSourceFile());
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_PRESENTER, true), $outputData->getPresenterSourceFile());
        $this->putSourceFile($this->appendSchemaDirectory(ClarcConfig::DIR_PRESENTER, true), $outputData->getViewModelSourceFile());

        $this->command->newline();
    }

    private function appendSchemaDirectory(string $path, bool $appendUsecase = false) {
        if ($appendUsecase) {
            return $path . '\\' . $this->schema->categoryName . '\\' . $this->schema->usecaseName . '\\';
        } else {
            return $path . '\\' . $this->schema->categoryName . '\\';
        }
    }

    public function willBeOverwriteFiles(string $controllerName, string $actionName) {
        $prefix = $controllerName . $actionName;
        $checkTargets = [
            ClarcConfig::DIR_INPUT_PORT . $prefix . 'InputPortInterface.php',
            ClarcConfig::DIR_INPUT_PORT . $prefix . 'InputData.php',
            ClarcConfig::DIR_INTERACTOR . $prefix . 'Interactor.php',
            ClarcConfig::DIR_OUTPUT_PORT . $prefix . 'OutputPortInterface.php',
            ClarcConfig::DIR_OUTPUT_PORT . $prefix . 'OutputData.php',
            ClarcConfig::DIR_PRESENTER . $prefix . 'Presenter.php',
            ClarcConfig::DIR_PRESENTER . $prefix . 'ViewModel.php',
        ];

        $overwrites = [];
        foreach ($checkTargets as $checkTarget) {
            if (file_exists($checkTarget)) {
                array_push($overwrites, $checkTarget);
            }
        }

        return $overwrites;
    }

    private function putSourceFile(string $directory, SourceFileData $sourceFileData)
    {
        if (!file_exists($directory)) {
            mkdir($directory, '0777', true);
        }
        $file = $directory . $sourceFileData->getClassName() . '.php';
        $this->command->info('Creating file ' . $file);
        file_put_contents($file, $sourceFileData->getContents());
        $this->command->info('Wrote ' . realpath($file));
    }
}