# DBLibrary

## What is DBLibrary ?

DBLibrary is a library which will help you in your future developpements. It is thought to make the communication with your DataBases easier. The following technologies are currently supported by this library :
- SQLite
- MySQL
Don't hesitate to contribute if you want to add more databases technologies to this library !

## Installation

DBLibrary can be very easily installed. Just download the file located at core/DB/Library.php and integrate it to your scripts using :

```php
require_once('/path/to/DBLibrary.php');
```

## Examples

The two files examples/MySQLTest.php and examples/SQLiteTest.php present usage examples of the library. You can copy code from these files and integrate them to your projects.

Here is a simple example, using SQLite to select datas :
```php
<?php
//Inclusion of DBLibrary
require_once('core/DBLibrary.php');

//Object creation
$db = new DBLibrary();

//Opening a SQLite DataBases
$db->openSQLite("files/test.sqlite");

//Getting datas from the users table
$datas = $db->select('users');

//Showing datas
var_dump($datas);
?>
```