<?php


/**
 * Class DBConnection
 *
 * Wrapper tipo singleton para PDO.
 */
class DBConnection
{
    /** @var PDO|null Variable estática para guardar la conexión de PDO. */
    private static $db;

    // Constantes de conexión.
    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASS = "";
    const DB_BASE = "UEFACL";

    /**
     * DBConnection constructor.
     * Este constructor lo tenemos solo para marcarlo como privado, y evitar que se pueda instanciar
     * libremente la clase.
     */
    private function __construct()
    {}

    /**
     * Abre la conexión a la base instanciando PDO.
     */
    protected static function openConnection()
    {
        $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_BASE . ";charset=utf8mb4";

        try {
            self::$db = new PDO($dsn, self::DB_USER, self::DB_PASS);
        } catch(Exception $e) {
            echo "Error al conectar con la base de datos :(";
        }
    }

    /**
     * Retorna la conexión PDO a la base de datos.
     * Se encarga de siempre retornar la misma exacta conexión para todos.
     * Si no está aún abierta, primero hace la conexión, y luego la retorna.
     *
     * @return PDO
     */
    public static function getConnection()
    {
        // Primero, preguntamos si la conexión ya está creada, y sino, la creamos.
        // self hace referencia a la clase en la que estoy actualmente.
        if(self::$db === null) {
            self::openConnection();
        }

        return self::$db;
    }
}
