<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Produto extends AbstractMigration
{

    public function change()
    {   
        $table = $this->table('produto');
        $table->addColumn->addColumn('nome_produto', 'string',['null'=>false,'limit'=>70])
        ->addColumn('descricao', 'string',['null'=>false,'limit'=>140])
        ->addColumn('quant_estoque', 'number',['null'=>false,'limit'=>50])
        ->addColumn('valor_unitario', 'number',['null'=>false,'limit'=>50])
        ->create();
    }
}