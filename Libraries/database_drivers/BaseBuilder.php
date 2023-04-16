<?php

namespace Libraries\database_drivers;

use Libraries\database_drivers\mysql\Builder;
use JetBrains\PhpStorm\NoReturn;
use Libraries\database_drivers\mysql\Query;

trait BaseBuilder
{
    use Builder;

    public function raw($sql)
    {
        return $this->callRaw($sql);
    }

    public function update($data): bool
    {
        return $this->callUpdate($data);
    }

    public function delete(): bool
    {
        return $this->callDelete();
    }

    public function destroy($ids = []): int
    {
        return $this->callDestroy($ids);
    }

}