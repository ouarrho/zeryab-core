const fs = require('fs');
const path = require('path');
const Handlebars = require('handlebars');

/**
 * The PHPDataBaseSQLExecuterGenerator class is responsible for generating PHP code
 * to execute SQL files created by the DataBaseGenerator class.
 */
class PHPDataBaseSQLExecuterGenerator {

  /**
   * Generates PHP code to execute the given SQL files and writes it to the specified output path.
   *
   * @param {string[]} sqlFiles An array containing the names of the SQL files to execute.
   * @param {string} output The output path where the generated SQLExecuter.php file will be saved.
   * @returns {string|boolean} The generated file name if successful, false otherwise.
   */
  generate(sqlFiles, output = "../output/backend/PHP/db/") {
    const code = this.#generateCode(sqlFiles);
    const outputFile = `${output}SQLExecuter.php`;

    try {
      fs.writeFileSync(outputFile, code);
      return outputFile;
    } catch (error) {
      return false;
    }
  }

  /**
   * Generates object-oriented PHP code to execute the given SQL files.
   *
   * @param {string[]} sqlFiles An array containing the names of the SQL files to execute.
   * @returns {string} The generated PHP code for executing the SQL files.
   */
  #generateCode(sqlFiles) {
    const templateFile = fs.readFileSync('src/templates/PHPDataBaseSQLExecuterGenerator.hbs', 'utf-8');
    const template = Handlebars.compile(templateFile);
    const sqlFileMethods = sqlFiles.map(sqlFile => {
      return {
        fileName: sqlFile,
        methodName: 'execute_' + sqlFile.replace(/\.sql$/, '').toLowerCase()
      };
    });

    const code = "<?php\n\n" + template({ sqlFileMethods }) + "\n\n?>";

    return code;
  }

}

module.exports = PHPDataBaseSQLExecuterGenerator;
