<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Venda extends AbstractMigration
{

    public function change()
    {
        $table = $this->table('venda');
        $table->addColumn('id_cliente', 'integer')
        ->addForeignKey('id_cliente', 'cliente', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->addColumn('precototal', 'string',['null'=>true,'limit'=>20])
        ->addColumn('id_venda', 'integer',['null'=>true])
        ->addColumn('dtvenda', 'date')
        ->create();
    }
}
