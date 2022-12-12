<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CarrinhoGeral extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('carrinhogeral');
        $table->addColumn('id_produto_carrinho', 'integer')
        ->addForeignKey('id_produto_carrinho', 'produto', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->addColumn('id_venda', 'integer')
        ->addForeignKey('id_venda', 'venda', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->create();
    
    }
}
