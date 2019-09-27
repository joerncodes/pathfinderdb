<?php

namespace App\Domain\Markdown;

use App\Domain\ValueObject\Markdown;

class Content
{
    private $contentPath;

    public function __construct($contentPath)
    {
        $this->contentPath = $contentPath;
    }

    public function fromFilename($fileName)
    {
        $filePath = $this->contentPath.'/'.$fileName;

        if (!file_exists($filePath) || !is_readable($filePath)) {
            throw new Exception();
        }

        $content = file_get_contents($filePath);
        $parser = new \Parsedown();
        $parsed = $parser->parse($content);

        return new Markdown(
            $content,
            $parsed
        );
    }
}
