<?php
error_reporting(E_ALL); // будет выводить ошибки

define('DS', DIRECTORY_SEPARATOR); // вводим константу, содержащую разделитель пути, для Windows это «\»
// Узнаём путь к файлам сайта
$site_path = realpath(dirname(__FILE__) . DS) . DS; // realpath() - возвращает канонизированный абсолютный путь к файлу
// C:\OpenServer\domains\eshop.com\


define('SITE_PATH', $site_path); // вводим константу: // C:\OpenServer\domains\eshop.com\

$config = file_get_contents(SITE_PATH . DS . 'config.xml'); // file_get_contents -- Получить содержимое файла в виде одной строки

$configXML = new SimpleXMLElement($config); // массив данных из config.xml (наша БД)

$host = (string)$configXML->db->host;
$dbname = (string)$configXML->db->dbname;
$username = (string)$configXML->db->username;
$password = (string)$configXML->db->password;

try {
    $db = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
}
catch (PDOException $e) {
    echo "Error!: " . $e->getMessage();
}


/**
 * Вызвывается автоматически при обращении к классу или при создании объекта
 */
spl_autoload_register('loadClass'); // позволяет задать несколько реализаций метода автозагрузки описаний классов и интерфейсов

/**
 *
 * Функция, реализующая автозагрузку файла с нужным классом,
 * по принципу: имя класса - это путь к файлу, в котором он хранится
 *
 * @param string $className
 * @throws Exception
 */
function loadClass($className)
{
    $path = explode('_', $className);

    $file = '';
    foreach ($path as $item) {
        $file .= $item . DS;
    }

    $file = substr($file, 0, -1) . '.php';

    if (file_exists($file)) {
        include_once $file;
    } else {
        throw new Exception('File ' . $file . ' not found', 1);
    }
}

try {
    System_Registry:: set('connection', $db);
    $router = new System_Router();
    $router->setPath(SITE_PATH . 'Controller');
    $router->start();
} catch (Exception $e) {
    echo $e->getMessage();
}