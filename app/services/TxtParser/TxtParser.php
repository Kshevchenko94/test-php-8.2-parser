<?php

namespace App\services\TxtParser;

use App\services\Interfaces\ParserInterface;
use Exception;

readonly class TxtParser implements ParserInterface
{

    public function __construct(
        private string $pathFile,
        private string $separator = ","
    )
    {}

    /**
     * @inheritDoc
     * @throws Exception
     */
    public function parser(): array
    {
        $fileContent = file_get_contents($this->pathFile);
        if (!$fileContent) {
            throw new Exception('File is empty.');
        }

        return explode($this->separator, $fileContent);
    }
}
