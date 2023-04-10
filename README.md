# Zeryab Framework
Build Powerful and Magnificent Apps From Your Database Architecture.

Zeryab is a powerful tool for developers to easily create backends and frontends and establish connections between them. It provides the ability to generate databases and can output backend code in various languages such as JavaScript, Python, Rust, Java, C#, PHP, and more. With Zeryab, developers can quickly and efficiently build robust and scalable applications.

## Project Tree:

```bash
zeryab/
├── .config/
│   │── tables.json
│   └── relations.json
│
│── output/
│   │── backend/
│   │   │── PHP/
│   │   │   │── db/
│   │   │   │   └── Connection.php
│   │   │   └── classes/
│   │   │       └── ...(generated backend code)
│   │   │
│   │   │── Python/
│   │   │   │── db/
│   │   │   │   └── Connection.py
│   │   │   └── classes/
│   │   │       └── ...(generated backend code)
│   │   │
│   │   └── Java/
│   │   │   │── db/
│   │   │   │   └── Connection.java
│   │   │   └── classes/
│   │   │       └── ...(generated backend code)
│   │   │
│   │   └── CSharp/
│   │   │   │── db/
│   │   │   │   └── Connection.csharp
│   │   │   └── classes/
│   │   │       └── ...(generated backend code)
│   │   │
│   │   └── ...(other programming languages)
│   │
│   └── databases/
│       │── tables/
│           └── table1.sql
│           └── table1_fk.sql
│           └── table2.sql
│           └── table2_fk.sql
│           └── ...(other tables)
└── src/
    ├── databases/
    │   ├── DataBaseGenerator.php
    │   ├── PHPDataBaseGenerator.php
    │   ├── PythonDataBaseGenerator.php
    │   ├── JavaDataBaseGenerator.php
    │   ├── CSharpDataBaseGenerator.php
    │   ├── ...(other language DB generators)
    │
    ├── connections/
    │   ├── PHPConnectionGenerator.php
    │   ├── PythonConnectionGenerator.php
    │   ├── JavaConnectionGenerator.php
    │   ├── CSharpConnectionGenerator.php
    │   ├── ...(other language connection generators)
    │
    ├── classes/
    │   ├── PHPClassGenerator.php
    │   ├── PythonClassGenerator.php
    │   ├── JavaClassGenerator.php
    │   ├── CSharpClassGenerator.php
    │   ├── ...(other language connection generators)
    │
    ├── Config.php
    ├── Zeryab.php
```

## Note:
The .config/ directory contains two files: tables and relations. These files describe the structure of your database and the relations between tables.
The output/ directory contains the generated code for your backend, including classes.
The src/ directory contains the core files of Zeryab, including the Zeryab file for initializing, the Config file for loading configuration data, and various generator files for generating code.
For more information on how to use Zeryab, please refer to the documentation.

## More Details
### .config/: Contains configuration files for table definitions and table relations.
tables.json: Configuration file containing table definitions.
relations.json: Configuration file containing table relations.

### output/: Stores the generated code files.
#### backend/: Contains subfolders for each supported programming language.

Inside each folder in the programming languages folders, we are going to find the following folders:
- classes/: Stores generated classes.
- db/: Contains the code for connecting to the database.
* Connection.{programming language extension}: Generated code for connecting to the database.

#### databases/: Stores generated SQL files.
- tables/: Contains SQL files for tables and relations.
* table1.sql: Generated SQL file for table1.
* table1_fk.sql: Generated SQL file for table1 foreign keys.
* table2.sql: Generated SQL file for table2.
* table2_fk.sql: Generated SQL file for table2 foreign keys.

### src/: Contains the core files of Zeryab.
#### Zeryab File: 
- This file contains the main class for the project, Zeryab. It is responsible for managing the entire process of generating the backend structure for various programming languages. It has methods to create instances of the Config class, execute the generation process for database tables, relationships, and connections, as well as create class files for each programming language.

#### Config File: 
- This file contains the Config class, which is responsible for parsing and storing configuration data for the backend generation process. It has methods to load and parse JSON, XML, and YAML files, as well as get table and relation information from the parsed configuration. It also has a method to determine the desired output programming language based on the input configuration.

#### classes/: 
- Holds generator classes for each supported programming language.

* PHPClassGenerator.php: Generates PHP classes based on the configuration. This file will contain a class that reads the table definitions and relations, then generates the corresponding PHP classes for the tables, with methods for CRUD operations.
* PythonClassGenerator.php: Generates Python classes based on the configuration. This file will contain a class that reads the table definitions and relations, then generates the corresponding Python classes for the tables, with methods for CRUD operations.
* JavaClassGenerator.php: Generates Java classes based on the configuration. This file will contain a class that reads the table definitions and relations, then generates the corresponding Java classes for the tables, with methods for CRUD operations.
* { ...same thing for the other programming languages... }

#### databases/: 
- Contains generator classes for generating SQL files and database connection code.
* DataBaseGenerator.php: Generates SQL files for tables and relations. This file contains a class that reads the table definitions and relations from the configuration, then generates SQL files for creating the tables and setting up the foreign key constraints.
* PHPDataBaseGenerator.php: Generates PHP code for executing SQL files and creating database connections. This file will contain a class that generates the necessary PHP code to execute the generated SQL files and create a connection to the database.
* PythonDataBaseGenerator.php: Generates Python code for executing SQL files and creating database connections. This file will contain a class that generates the necessary Python code to execute the generated SQL files and create a connection to the database.
* JavaDataBaseGenerator.php: Generates Java code for executing SQL files and creating database connections. This file will contain a class that generates the necessary Java code to execute the generated SQL files and create a connection to the database.
* { ...same thing for the other programming languages... }

#### connections/: 
- Contains the generator classes for creating database connection code for each supported programming language.
* PHPConnectionGenerator.php: Generates PHP code for creating a database connection. This file will contain a class that generates the necessary PHP code to create a connection to the database using the provided configuration. The generated code will be placed in the output/backend/PHP/db/Connection.php file.
* PythonConnectionGenerator.php: Generates Python code for creating a database connection. This file will contain a class that generates the necessary Python code to create a connection to the database using the provided configuration. The generated code will be placed in the output/backend/Python/db/Connection.py file.
* JavaConnectionGenerator.php: Generates Java code for creating a database connection. This file will contain a class that generates the necessary Java code to create a connection to the database using the provided configuration. The generated code will be placed in the output/backend/Java/db/Connection.java file.
* { ...same thing for the other programming languages... }


## Usage
Install Zeryab by cloning the repository or downloading the ZIP file.
Configure your database tables in the .config/tables.json file.
Declare the relationships between your tables in the .config/relations.json file.
Run the Zeryab script to generate your backend code in the language of your choice.

## License
This project is licensed under the MIT License - see the LICENSE file for details.
