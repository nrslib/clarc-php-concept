<?php


namespace Clarc\Basis\Console\Input\Question;


class ChoiceQuestion extends Question
{
    private $prompt = ' > ';

    /**
     * @var string[]
     */
    private $choices;

    /**
     * ChoiceQuestion constructor.
     * @param string $question
     * @param string[] $choices
     * @param string|null $default
     */
    public function __construct(string $question, array $choices, string $default = null)
    {
        parent::__construct($question, $default);

        $this->choices = $choices;
    }


    public function getPrompt()
    {
        return $this->prompt;
    }

    public function getChoices()
    {
        return $this->choices;
    }
}