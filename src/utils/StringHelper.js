/**
  * StringHelper provides utility methods for string conversions between different
  * naming conventions such as camelCase, PascalCase, snake_case, and kebab-case.
*/
class StringHelper {

  /**
   * Converts snake_case to camelCase.
   * @param {string} input - The snake_case input string.
   * @returns {string} - The converted camelCase string.
   */
  static fromSnakeCaseToCamelCase(input) {
    return input.toString().replace(/_([a-z])/g, (match, p1) => p1.toUpperCase());
  }

  /**
   * Converts snake_case to PascalCase.
   * @param {string} input - The snake_case input string.
   * @returns {string} - The converted PascalCase string.
   */
  static fromSnakeCaseToPascalCase(input) {
    return input.toString()
      .replace(/_([a-z])/g, (match, p1) => p1.toUpperCase())
      .replace(/^([a-z])/, (match, p1) => p1.toUpperCase());
  }

  /**
   * Converts snake_case to kebab-case.
   * @param {string} input - The snake_case input string.
   * @returns {string} - The converted kebab-case string.
   */
  static fromSnakeCaseToKebabCase(input) {
    return input.toString().replace(/_/g, '-');
  }

  /**
   * Converts camelCase to snake_case.
   * @param {string} input - The camelCase input string.
   * @returns {string} - The converted snake_case string.
   */
  static fromCamelCaseToSnakeCase(input) {
    return input.toString().replace(/([A-Z])/g, (match, p1) => '_' + p1.toLowerCase());
  }

  /**
   * Converts camelCase to PascalCase.
   * @param {string} input - The camelCase input string.
   * @returns {string} - The converted PascalCase string.
   */
  static fromCamelCaseToPascalCase(input) {
    return input.toString().replace(/^([a-z])/, (match, p1) => p1.toUpperCase());
  }

  /**
   * Converts camelCase to kebab-case.
   * @param {string} input - The camelCase input string.
   * @returns {string} - The converted kebab-case string.
   */
  static fromCamelCaseToKebabCase(input) {
    return input.toString().replace(/([A-Z])/g, (match, p1) => '-' + p1.toLowerCase());
  }

  /**
   * Converts PascalCase to snake_case.
   * @param {string} input - The PascalCase input string.
   * @returns {string} - The converted snake_case string.
   */
  static fromPascalCaseToSnakeCase(input) {
    return input.toString().replace(/([A-Z])/g, (match, p1) => '_' + p1.toLowerCase()).replace(/^_/, '');
  }

  /**
   * Converts PascalCase to camelCase.
   * @param {string} input - The PascalCase input string.
   * @returns {string} - The converted camelCase string.
   */
  static fromPascalCaseToCamelCase(input) {
    return input.toString().replace(/^([A-Z])/, (match, p1) => p1.toLowerCase());
  }

  /**
   * Converts PascalCase to kebab-case.
   * @param {string} input - The PascalCase input string.
   * @returns {string} - The converted kebab-case string.
   */
  static fromPascalCaseToKebabCase(input) {
    return input.toString().replace(/([A-Z])/g, (match, p1) => '-' + p1.toLowerCase()).replace(/^-/, '');
  }

  /**
   * Converts kebab-case to snake_case.
   * @param {string} input - The kebab-case input string.
   * @returns {string} - The converted snake_case string.
   */
  static fromKebabCaseToSnakeCase(input) {
    return input.toString().replace(/-/g, '_');
  }

  /**
   * Converts kebab-case to camelCase.
   * @param {string} input - The kebab-case input string.
   * @returns {string} - The converted camelCase string.
   */
  static fromKebabCaseToCamelCase(input) {
    return input.toString().replace(/-([a-z])/g, (match, p1) => p1.toUpperCase());
  }

  /**
   * Converts kebab-case to PascalCase.
   * @param {string} input - The kebab-case input string.
   * @returns {string} - The converted PascalCase string.
   */
  static fromKebabCaseToPascalCase(input) {
    return input.toString()
      .replace(/-([a-z])/g, (match, p1) => p1.toUpperCase())
      .replace(/^([a-z])/, (match, p1) => p1.toUpperCase());
  }

}

module.exports = StringHelper;
