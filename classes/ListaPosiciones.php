<?php

class ListaPosiciones implements JsonSerializable
{
    protected $id;
    protected $posicion;
    public function jsonSerialize()
    {
        return [

            'id'                    => $this->getId(),
            'posicion'            => $this->getPosicion(),
        ];
    }
    public function ListarPosiciones(): array {

        $db = DBConnection::getConnection();

        $query =  'SELECT id, posicion
        FROM posiciones
        ORDER BY id ASC;';
        $stmt = $db->prepare($query);
        $stmt->execute();

        $salida = [];

        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $pos = new self();
            $pos->setId($fila['id']);
            $pos->setPosicion($fila['posicion']);

            $salida[] = $pos;
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
    public function getPosicion()
    {
        return $this->posicion;
    }
        /**
     * @param mixed $posicion
     */
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;
    }
}    