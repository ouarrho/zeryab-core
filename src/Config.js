const Parser = require('./utils/Parser');

/**
 * Config class for loading and parsing tables and relations configuration files.
 */
class Config {
  /**
   * Constructs a Config instance.
   * @param {string} tablesFile - Path to the tables configuration file.
   * @param {string} relationsFile - Path to the relations configuration file.
   */
  constructor(tablesFile, relationsFile) {
    this.parser = new Parser();
    this.tables = this.parser.file(tablesFile);
    this.relations = this.parser.file(relationsFile);
  }

  /**
   * Returns the tables configuration data.
   * @returns {object} Tables configuration data.
   */
  getTables() {
    return this.tables;
  }

  /**
   * Returns the relations configuration data.
   * @returns {object} Relations configuration data.
   */
  getRelations() {
    return this.relations;
  }
}

module.exports = Config;
