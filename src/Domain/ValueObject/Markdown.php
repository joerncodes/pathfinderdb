<?php

namespace App\Domain\ValueObject;

use Webmozart\Assert\Assert;

class Markdown
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