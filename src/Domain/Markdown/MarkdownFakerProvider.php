<?php

namespace App\Domain\Markdown;

use Faker\Generator;
use Faker\Provider\Base as BaseProvider;

final class MarkdownFakerProvider extends BaseProvider
{
    /**
     * @var Content
     */
    private $mdContent;

    public function __construct(Generator $generator, Content $mdContent)
    {
        parent::__construct($generator);
        $this->mdContent = $mdContent;
    }

    public function markdown($filename)
    {
        $content = $this->mdContent->fromFilename($filename);

        return $content->getHTML();
    }
}
