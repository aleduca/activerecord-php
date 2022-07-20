<?php

namespace app\database\activerecord;

use app\database\connection\Connection;
use app\database\interfaces\ActiveRecordInterface;
use app\database\interfaces\ActiveRecordExecuteInterface;
use Exception;
use Throwable;

class Delete implements ActiveRecordExecuteInterface
{
    public function __construct(private string $field, private string|int $value)
    {
    }
    

    public function execute(ActiveRecordInterface $activeRecordInterface)
    {
        try {
            $query = $this->createQuery($activeRecordInterface);

            $connection = Connection::connect();

            $prepare = $connection->prepare($query);
            $prepare->execute([
                $this->field => $this->value
            ]);

            return $prepare->rowCount();
        } catch (Throwable $throw) {
            formatExcetion($throw);
        }
    }

    private function createQuery(ActiveRecordInterface $activeRecordInterface)
    {
        if ($activeRecordInterface->getAttributes()) {
            throw new Exception('Para deletar não precisa passar atributos');
        }

        $sql = "delete from {$activeRecordInterface->getTable()}";
        $sql.= " where {$this->field} = :{$this->field}";

        return $sql;
    }
}
