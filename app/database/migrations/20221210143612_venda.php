<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Venda extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('venda');
        $table->addColumn('nome', 'string',['null'=>true,'limit'=>80])
        ->addColumn('marca', 'string',['null'=>true,'limit'=>80])
        ->addColumn('preco', 'string',['null'=>true,'limit'=>20])
        ->addColumn('dtfabricacao', 'date')
        ->create();
    }
}
