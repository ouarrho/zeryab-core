<?php

declare(strict_types=1);

namespace Zeryab\Output;

class ConnectGenerator
{
    private string $driver;
    private string $host;
    private string $database;
    private string $username;
    private string $password;

    public function __construct(string $driver, string $host, string $database, string $username, string $password)
    {
        $this->driver = $driver;
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function generate(): void
    {
        $dsn = sprintf('%s:host=%s;dbname=%s;charset=utf8', $this->driver, $this->host, $this->database);

        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $pdo = new \PDO($dsn, $this->username, $this->password, $options);

        $file = fopen(__DIR__ . '/connect.php', 'w');

        $content = "<?php\n\n";
        $content .= "declare(strict_types=1);\n\n";
        $content .= "\$pdo = new \\PDO('$dsn', '$this->username', '$this->password', " . var_export($options, true) . ");\n\n";
        $content .= "return \$pdo;\n";

        fwrite($file, $content);
        fclose($file);
    }
}

?>