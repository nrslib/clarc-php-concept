<?php


namespace Clarc\Basis\Console\Input\Question;


class Question
{
    /**
     * @var string
     */
    private $question;

    /**
     * @var string
     */
    private $default;

    /**
     * Question constructor.
     * @param string $question
     * @param string|null $default
     */
    public function __construct(string $question, string $default = null)
    {
        $this->question = $question;
        $this->default = $default;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function  getDefault()
    {
        return $this->default;
    }

    public function isTrimmable()
    {
        return true;
    }
}