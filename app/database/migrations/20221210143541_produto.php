<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Produto extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('produto');
        $table->addColumn('nome', 'string',['null'=>true,'limit'=>80])
        ->addColumn('marca', 'string',['null'=>true,'limit'=>80])
        ->addColumn('descricao', 'string',['null'=>true,'limit'=>250])
        ->addColumn('preco', 'string',['null'=>true,'limit'=>20])
        ->addColumn('dtfabricacao', 'date')
        ->create();
    }
}
