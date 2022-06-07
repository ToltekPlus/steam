<?php

namespace App\Model;

use Core\Model;

class AccountModel extends Model {
    /**
     * @var string
     */
    protected $table = 'accounts';

    /**
     * @param int $id
     * @return object
     */
    public function find(int $id)   : object
    {
        $company = $this->getByIdFromTable($this->table, $id, 'user_id');
        return array_shift($company);
    }

<<<<<<< HEAD
    /**
     * @param $args
     * @return void
     */
    public function store($args)
    {
        return $this->storeToTable($this->table, $args);
    }
}
=======
}
>>>>>>> parent of 081d758 (Merge branch 'dev' of https://github.com/f0l13N/steam into dev)
