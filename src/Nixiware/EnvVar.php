<?php
namespace Nixiware;

class EnvVar {
	const TypeString 		= 0;
	const TypeInt			= 1;
	const TypeBool			= 2;		

	/** 
	 * Fetches an environmental value.
	 *
	 * @param name - string - name of the environmental value
	 * @param required - bool - sets the variable as required / optional for the execution
	 * @param default - string - default value to return
	 * @param explicitCastType - int - explicitly cast the returned value to a type
	 * @return environment variable value
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
		} else if ($required && $default === null) { // aborting execution
			throw new \Exception('Required Container enironment variable "' . $name . '" is not available.');
		}

		// filtering content
		$value = trim(preg_replace('/\s\s+/', ' ', $content));
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