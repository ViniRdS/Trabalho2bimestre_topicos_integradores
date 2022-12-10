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
        ->addColumn('id_produto_venda', 'integer[]')
        //->addForeignKey('id_produto_venda', 'carrinho', 'id_produto_carrinho', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->addColumn('precoTotal', 'string',['null'=>true,'limit'=>20])
        ->addColumn('dtvenda', 'date')
        ->create();
    }
}
