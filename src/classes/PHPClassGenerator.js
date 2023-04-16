const fs = require('fs');
const Handlebars = require('handlebars');
const StringHelper = require('../utils/StringHelper');

class PHPClassGenerator {

  /**
   * Generates PHP classes for the given configuration.
   * @param {Config} config - The configuration object containing table and relation information.
   * @param {string} output - The output path where the generated class files will be saved.
   * @returns {boolean} - True if all class files are successfully created and written, false otherwise.
   */
  generate(config, output = '../output/backend/PHP/classes/') {
    const tables = config.getTables();

    for (const table of tables) {
      if (!this.#generateClass(table.name, table.columns, output)) {
        return false;
      }
    }

    return true;
  }

  /**
   * Generates a class for a given table with methods for CRUD operations
   * and filtering.
   *
   * @param {string} tableName The name of the table to generate the class for.
   * @param {Array} columns An array of column names for the table.
   * @param {string} output The output path where the generated class file will be saved.
   * @return {boolean} True if the file is successfully created and written, false otherwise.
   */
  #generateClass(tableName, columns, output) {
    const className = StringHelper.fromSnakeCaseToPascalCase(tableName);
    const code = this.#generateCode(tableName, columns, className);

    try {
      fs.writeFileSync(`${output}${className}.php`, code);
      return true;
    } catch (error) {
      console.error(error);
      return false;
    }
  }

  /**
   * Generates the code for a PHP class based on the provided table name, columns, and class name.
   *
   * @param {string} tableName The name of the table.
   * @param {Array} columns An array of column names for the table.
   * @param {string} className The name of the PHP class.
   * @returns {string} The generated PHP class code.
   */
  #generateCode(tableName, columns, className) {
    const classTemplate = fs.readFileSync('src/templates/PHPClassGenerator.hbs', 'utf8');
    const compiledClassTemplate = Handlebars.compile(classTemplate);

    const classData = {
      className: className,
      connectionClass: 'Connection',
      tableName: tableName,
      columns: columns
    };

    return compiledClassTemplate(classData);
  }

  /**
   * Generates the code for the insert method of a PHP class.
   *
   * @param {Array} columns An array of column names for the table.
   * @returns {string} The generated PHP insert method code.
   */
  #generateInsertMethod(tableName, columns) {
    const insertMethodTemplate = fs.readFileSync('src/templates/PHPClassMethodInsertGenerator.hbs');
    const compiledInsertMethodTemplate = Handlebars.compile(insertMethodTemplate);

  const methodData = {
      tableName: tableName,
      columns: columns
    };

    return compiledInsertMethodTemplate(methodData);
  }



  // Add other CRUD method generators as needed
}

module.exports = PHPClassGenerator;
