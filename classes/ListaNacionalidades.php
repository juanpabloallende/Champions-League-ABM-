<?php

class ListaNacionalidades implements JsonSerializable
{
    protected $id;
    protected $nacionalidad;
    
    public function jsonSerialize()
    {
        return [

            'id'                    => $this->getId(),
            'nacionalidad'            => $this->getNacionalidad(),
        ];
    }
    public function ListarNacionalidades(): array {

        $db = DBConnection::getConnection();

        $query =  'SELECT id, nacionalidad
        FROM nacionalidades
        ORDER BY id ASC;';
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida = [];

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $nac = new self();
            $nac->setId($fila['id']);
            $nac->setNacionalidad($fila['nacionalidad']);

            $salida[] = $nac;
            }
            
        return $salida;
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
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }
        /**
     * @param mixed $nacionalidad
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    }
}   