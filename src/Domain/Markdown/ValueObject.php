<?php

namespace App\Domain\Markdown;

use Webmozart\Assert\Assert;

class ValueObject
{
    private $markdown;
    /**
     * @var string
     */
    private $html;

    public function __construct(string $markdown, string $html)
    {
        Assert::notEmpty($markdown);
        Assert::notEmpty($html);

        $this->markdown = $markdown;
        $this->html = $html;
    }

    public function getMarkdown(): string
    {
        return $this->markdown;
    }

    public function getHTML(): string
    {
        return $this->html;
    }
}
