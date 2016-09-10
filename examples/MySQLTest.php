<?php

/* 
 * The MIT License
 *
 * Copyright 2016 Pierre HUBERT.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * dbLibrary usages example using MySQL
 * Use these examples to integrate dbLibrary in your project
 * 
 * @author Pierre HUBERT
 */

/*
 * MySQL config
 */
$mysql = array(
    "host" => "localhost",
    "username" => "root",
    "password" => "root",
    "dbName" => "test"
);

/*
 * Library inclusion
 */
require_once("../core/DBLibrary.php");

/*
 * Object creation
 */
$db = new DBLibrary(true);

/*
 * Opening a SQLite DataBase
 */
$db->openMYSQL($mysql['host'], 
        $mysql['username'], 
        $mysql['password'], 
        $mysql['dbName']);

/*
 * Creating a table
 */
$db->execSQL("CREATE TABLE IF NOT EXISTS users (ID INTEGER PRIMARY KEY AUTO_INCREMENT,"
        . " Name TEXT, email TEXT, Age INTEGER)");

/*
 * Adding a line to the DataBase
 */
$values = array(
  "Name" => "Raspberry PI",
  "email" => "name@example.org",
  "age" => 16
);
$db->addLine("users", $values);

/*
 * Adding three lines to the DataBase
 */
$values2 = array(
    array(
        "Name" => "AutoTime - ".time(),
        "email" => "time@auto.org"
    ),
    array(
        "Name" => "AutoTime2 - ".time(),
        "email" => "time2@auto.org"
    ),
    array(
        "Name" => "AutoTime3 - ".time(),
        "email" => "time3@auto.org"
    )
);
$db->addLines("users", $values2);

/*
 * Editing the DB
 */
$modifs = array(
    "email" => "Edited to ".time()." !",
    "age" => 18
);
$condition = "Name = ?";
$condValues = array("Raspberry PI");
$db->updateDB("users", $condition, $modifs, $condValues);

/*
 * Removing an entry from the DB
 */
$db->deleteEntry("users", "Name LIKE ?", array("AutoTime3 %"));

/*
 * Getting datas
 */
echo "<pre>";
print_r($db->select('users'));

/*
 * Retrewing the object to delete every elements of the DataBase
 */
$dbobj = $db->getDBobject();
$dbobj->exec("DELETE FROM users");
echo "<p>Datas where removed from users ! </p>";