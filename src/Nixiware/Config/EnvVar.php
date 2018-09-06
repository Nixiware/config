<?php
namespace Nixiware\Config;

class EnvVar {
	const TypeString 		= 0;
	const TypeInt			= 1;
	const TypeBool			= 2;		

	/** 
	 * Fetches an environment variable value.
	 *
	 * @param string name - name of the environment variable
	 * @param bool required - sets the variable as required / optional for the execution
	 * @param mixed default - default value to return if environment variable is not set
	 * @param int explicitCastType - explicitly cast the returned value to a type
	 * @return mixed environment variable value
	 */
	public static function get($name, $required = false, $default = null, $explicitCastType = self::TypeString) {
		$content = '';

		if (getenv($name . '_FILE') &&
			strlen(getenv($name . '_FILE')) > 0 && 
			file_exists(getenv($name . '_FILE'))) { // checking if a *_FILE environment variable exists and is usable

			$content = file_get_contents(getenv($name . '_FILE'));
		} else if (getenv($name) &&
				   strlen(getenv($name)) > 0) { // checking if the environment variable exists and is usable
			$content = getenv($name);
		} else if ($default !== null) { // returning default value if possible
			$content = $default;
		} else if ($required && $default === null) { // throwing exception
			throw new Exception('Required enironment variable "' . $name . '" is not available.');
		}

		// filtering value
		$value = trim(preg_replace('/\s\s+/', ' ', $content));

		// casting value
		switch ($explicitCastType) {
			case self::TypeInt:
				return (int)$value;
			break;

			case self::TypeBool:
				return (bool)$value;
			break;

			default:
			case self::TypeString:
				return (string)$value;
			break;
		}
	}
}