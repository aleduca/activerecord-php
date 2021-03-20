<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordExecuteInterface;
use app\database\interfaces\ActiveRecordInterface;
use Exception;
use Throwable;

class Update implements ActiveRecordExecuteInterface
{
    public function __construct(private string $field, private string|int $value)
    {
    }
    

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        // "update users set firstName = :firstName, lastName = :lastName where id = :id";
        try {
            $query = $this->createQuery($activeRecordInterface);

            $connection = Connection::connect();

            $attributes = array_merge($activeRecordInterface->getAttributes(), [
                $this->field => $this->value
            ]);

            $prepare = $connection->prepare($query);
            $prepare->execute($attributes);
            return $prepare->rowCount();
        } catch (Throwable $throw) {
            formatExcetion($throw);
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        if (array_key_exists('id', $activeRecordInterface->getAttributes())) {
            throw new Exception('O campo id não pode ser passado para o update');
        }

        $sql = "update {$activeRecordInterface->getTable()} set ";

        foreach ($activeRecordInterface->getAttributes() as $key => $value) {
            $sql.= "{$key}=:{$key},";
        }

        $sql = rtrim($sql, ',');
        $sql.= " where {$this->field} = :{$this->field}";

        return $sql;
    }
}
