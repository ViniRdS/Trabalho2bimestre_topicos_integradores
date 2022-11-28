<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Venda extends AbstractMigration
{

    public function change()
    {   
        $table = $this->table('venda');
        $table->addColumn->addColumn('id_produto', 'integer')
        ->addColumn('quantidade', 'string',['null'=>false,'limit'=>50])
        ->addColumn('valor_total', 'number',['null'=>false,'limit'=>50])
        ->addForeignKey('id_produto', 'produto', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->create();
    }
}