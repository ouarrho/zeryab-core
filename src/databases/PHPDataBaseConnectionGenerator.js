const fs = require('fs');
const Handlebars = require('handlebars');

/**
 * The PHPDataBaseConnectionGenerator class is responsible for generating PHP code
 * to create a connection to a database using PDO in an object-oriented manner.
 */
class PHPDataBaseConnectionGenerator {
    
  /**
   * Generates PHP code for a database connection using PDO and writes it to the specified output path.
   *
   * @param {string} output The output path where the generated Connection.php file will be saved.
   * @returns {string|boolean} The generated file name if successful, false otherwise.
   */
  generate(output = "../output/backend/PHP/db/") {
    const code = this.#generateCode();
    const outputFile = `${output}Connection.php`;

    try {
      fs.writeFileSync(outputFile, code);
      return outputFile;
    } catch (error) {
      return false;
    }
  }

  /**
   * Generates object-oriented PHP code for a database connection using PDO.
   *
   * @returns {string} The generated PHP code for creating a PDO database connection.
   */
  #generateCode() {
    const templateFile = fs.readFileSync('src/templates/PHPDataBaseConnectionGenerator.hbs', 'utf-8');
    const template = Handlebars.compile(templateFile);
    const code = "<?php\n\n" + template() + "\n\n?>";

    return code;
  }

}

module.exports = PHPDataBaseConnectionGenerator;
