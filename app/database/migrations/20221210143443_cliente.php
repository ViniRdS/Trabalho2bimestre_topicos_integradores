<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Cliente extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('cliente');
        $table->addColumn('nome', 'string',['null'=>true,'limit'=>80])
        ->addColumn('sobrenome', 'string',['null'=>true,'limit'=>80])
        ->addColumn('cpf', 'string',['null'=>true,'limit'=>25])
        ->addColumn('rg', 'string',['null'=>true,'limit'=>20])
        ->addColumn('dtnascimento', 'date')
        ->create();
    }
}
