Config
=======================

## Introduction
When running PHP applications using orchestration systems (like Docker Swarm / Kubernetes) a lot of configuration is done using environment variables.

While PHP comes with ```getenv()``` for reading environmnet variables, a lot of time it proves limited when dealing with [secrets](https://docs.docker.com/engine/swarm/secrets/) (reading values from files) or explicitly casting the values to a certain type.

## Requirements
* PHP 5.3

## Usage
1. Import package namespace ```use Nixiware\Config\EnvVar;```
2. Import environment variables using the static method ```get($name, $required, $default, $explicitCastType)```
  * ```$name``` - name of the environmnet variable
  * ```$required``` - sets the variable as required / optional for the execution
  * ```$default``` - default value to return if environment variable is not set
  * ```$explicitCastType``` - explicitly cast the returned value to a type

**EnvVar** will first look for an environment variable with the suffix ```_FILE```, and if a file path is specified, it will load the contents of that file.

If a variable is specified as required and no default value is provided, a ```Nixiware\Config\Exception``` will be thrown.

## Examples
* Reading a variable named ```DB_HOST```, set as not required with a default value of ```127.0.0.1```

```
EnvVar::get('DB_HOST', false, '127.0.0.1');
```

* Reading a variable named ```REST_API_ENABLED```, set as required with no default value, and casted as a boolean.

```
EnvVar::get('REST_API_ENABLED', true, null, EnvVar::TypeBool);
```

* Reading a variable from a file, named ```DB_PASSWORD```, set as required with no default value.

```
EnvVar::get('DB_PASSWORD', true);
```

Path for the file will be specified using the environment variable ```DB_PASSWORD_FILE```. The variable with the suffix ```_FILE``` is automatically read to allow more flexibility in configuring your application, without requiring to modify the actual configuration files.

## License
Config is available under the MIT license. See the LICENSE file for more info.
