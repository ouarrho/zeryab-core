<?php

class Config {
    private array $tables;
    private array $relations;

    public function __construct(
        private string $tablesFile,
        private string $relationsFile,
    ) {
        $this->tables = $this->parseFile(path: $tablesFile);
        $this->relations = $this->parseFile(path: $relationsFile);
    }

    private function parseFile(string $path): array {
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        if (!file_exists($path)) {
            throw new InvalidArgumentException("File not found: {$path}");
        }

        $content = file_get_contents($path);

        return match ($ext) {
            'json' => $this->parseJson(content: $content),
            'xml' => $this->parseXml(content: $content),
            'yaml', 'yml' => $this->parseYaml(content: $content),
            default => throw new InvalidArgumentException("Unsupported file type: {$ext}"),
        };
    }

    private function parseJson(string $content): array {
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidArgumentException("Invalid JSON: " . json_last_error_msg());
        }

        return $data;
    }

    private function parseXml(string $content): array {
        $xml = simplexml_load_string($content, 'SimpleXMLElement', LIBXML_NOCDATA);

        if ($xml === false) {
            throw new InvalidArgumentException("Invalid XML");
        }

        $json = json_encode($xml);
        return $this->parseJson(content: $json);
    }

    private function parseYaml(string $content): array {
        $lines = explode("\n", $content);
        $data = [];

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line) || $line[0] === '#') {
                continue;
            }

            if (preg_match('/^(\w+):\s*(.*)$/', $line, $matches)) {
                [, $key, $value] = $matches;
                $data[$key] = $value;
            }
        }

        return $data;
    }

    public function getTables(): array {
        return $this->tables;
    }

    public function getRelations(): array {
        return $this->relations;
    }
}

?>