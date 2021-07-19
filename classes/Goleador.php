<?php

class Goleador implements JsonSerializable
{
    protected $class = self::class;
    protected $id;
    protected $nombre;
    protected $partidos;
    protected $goles;
    protected $nacionalidad;
    protected $posicion;
    protected $imagen;
    protected $debut;
    protected $retiro;
    
    /**
     * Esta función debe retornar cómo se representa como JSON este objeto.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'id'                    => $this->getId(),
            'nombre'                => $this->getNombre(),
            'partidos'              => $this->getPartidos(),
            'goles'                 => $this->getGoles(),
            'nacionalidades'        => $this->getNacionalidad(),
            'posiciones'            => $this->getPosicion(),
            'debut'                 => $this->getDebut(),
            'retiro'                => $this->getRetiro(),
        ];
    }

    /**
     * Retorna todos los productos de la base de datos.
     *
     * @return array|Goleador[]
     */
    public function traerTodo(): array {
        // Pedimos la conexión a la clase DBConnection...
        $db = DBConnection::getConnection();

        $query = "SELECT goleadores.id, goleadores.nombre, goleadores.partidos, goleadores.goles, nacionalidades.nacionalidad as nacionalidades, posiciones.posicion as posiciones,
		goleadores.debut, goleadores.retiro FROM goleadores
        JOIN nacionalidades ON goleadores.nacionalidades_id = nacionalidades.id
        JOIN posiciones ON goleadores.posiciones_id = posiciones.id
        ORDER BY goleadores.id ASC;";
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida = [];

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //$salida[] = $fila;
            // En cada vuelta, instanciamos un producto para almacenar los datos del registro.
            $gol = new self();
            $gol->setId($fila['id']);
            $gol->setNombre($fila['nombre']);
            $gol->setPartidos($fila['partidos']);
            $gol->setGoles($fila['goles']);
            $gol->setNacionalidades($fila['nacionalidades']);
            $gol->setPosiciones($fila['posiciones']);
            $gol->setDebut($fila['debut']);
            $gol->setRetiro($fila['retiro']);

            $salida[] = $gol;
        }

        return $salida;
        
    }    
    public function traerPorPK($id) {
        $db = DBConnection::getConnection();
        $query= 'SELECT goleadores.*, nacionalidades.nacionalidad as nacionalidad, posiciones.posicion as posicion FROM goleadores
		JOIN nacionalidades ON goleadores.nacionalidades_id = nacionalidades.id
		JOIN posiciones ON goleadores.posiciones_id = posiciones.id
		WHERE goleadores.id = ?;';
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        
        $dato = $stmt->fetchObject($this->class);

        if(!$dato){
            throw new Exception("No se encontró el " . strtolower($this->class) . " con " . $this->pk . " $id");
        }

        return $dato;

    /**
     * Crea un nuevo producto en la base de datos.
     *
     * @param array $data
     * @return bool
     */
    }
    public function crear(array $data)
    {
        $db = DBConnection::getConnection();
        $query = "INSERT INTO goleadores (nombre, partidos, goles, nacionalidades_id, posiciones_id, debut, retiro) 
        VALUES (:nombre, :partidos, :goles, :nacionalidad, :posicion, :debut, :retiro)";
        $stmt = $db->prepare($query);
        

        $exito = $stmt->execute([
   

            'nombre' => $data['nombre'],
            'partidos' => $data['partidos'],
            'goles' => $data['goles'],
            'posicion' => $data['posicion'],
            'nacionalidad' => $data['nacionalidad'],
            'debut' => $data['debut'],
            'retiro' => $data['retiro'],
        ]);

        if($exito) {
            $id = $db->lastInsertId();
            $gol = new Goleador;
            $gol->setId('$id');
            $gol->setNombre($data['nombre']);
            $gol->setPartidos($data['partidos']);
            $gol->setGoles($data['goles']);
            $gol->setNacionalidades($data['nacionalidad']);
            $gol->setPosiciones($data['posicion']);
            $gol->setDebut($data['debut']);
            $gol->setRetiro($data['retiro']);
       

            return $gol;
        } else {
            throw new Exception('Error al agregar el goleador.');
        }



    }   

    public function editar(array $data)
    {
        $db = DBConnection::getConnection();
        $query ="UPDATE goleadores
        SET nombre = :nombre, partidos = :partidos, goles = :goles, nacionalidades_id = :nacionalidad,
        posiciones_id = :posicion, debut = :debut, retiro = :retiro 
        WHERE id = :id";
        
        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            
            'id' => $data['id'],
            'nombre' => $data['nombre'],
            'partidos' => $data['partidos'],
            'goles' => $data['goles'],
            'nacionalidad' => $data['nacionalidad'],
            'posicion' => $data['posicion'],
            'debut' => $data['debut'],
            'retiro' => $data['retiro']
        ]);

        if($exito) {
            $gol = new Goleador;
            $gol->setId($data['id']);
            $gol->setNombre($data['nombre']);
            $gol->setPartidos($data['partidos']);
            $gol->setGoles($data['goles']);
            $gol->setNacionalidades($data['nacionalidad']);
            $gol->setPosiciones($data['posicion']);
            $gol->setDebut($data['debut']);
            $gol->setRetiro($data['retiro']);
       
            return $gol;
        } else {
            throw new Exception('Error al editar el goleador.');
        }
    
    }

    public function eliminar($id)
    {
    
        $query = "DELETE FROM goleadores WHERE id = ?";
        $db = DBConnection::getConnection();
        $stmt = $db->prepare($query);
        $exito = $stmt->execute([$id]);
        // $exito->execute();

        if(!$exito) {
            throw new Exception('Error al borrar el goleador.');
        }
        return true;
    }    

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPartidos()
    {
        return $this->partidos;
    }

    /**
     * @param mixed $partidos
     */
    public function setPartidos($partidos)
    {
        $this->partidos = $partidos;
    }

    /**
     * @return mixed
     */
    public function getGoles()
    {
        return $this->goles;
    }

    /**
     * @param mixed $goles
     */
    public function setGoles($goles)
    {
        $this->goles = $goles;
    }

    /**
     * @return mixed
     */
    public function getNacionalidades()
    {
        return $this->nacionalidades;
    }

    /**
     * @param mixed $nacionalidades
     */
    public function setNacionalidades($nacionalidades)
    {
        $this->nacionalidades = $nacionalidades;
    }

    /**
     * @return mixed
     */
    public function getPosiciones()
    {
        return $this->posiciones;
    }

    /**
     * @param mixed $posiciones
     */
    public function setPosiciones($posiciones)
    {
        $this->posiciones = $posiciones;
    }

    /**
     * @return mixed
     */
    public function getDebut()
    {
        return $this->debut;
    }

    /**
     * @return mixed
     */
    public function getRetiro()
    {
        return $this->retiro;
    }

       /**
     * @param mixed $debut
     */
    public function setDebut($debut)
    {
        $this->debut = $debut;
    }

    /**
     * @param mixed $retiro
     */
    public function setRetiro($retiro)
    {
        $this->retiro = $retiro;
    }
}
