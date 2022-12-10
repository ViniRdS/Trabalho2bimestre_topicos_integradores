<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Carrinho extends AbstractMigration
{
    
    public function change()
    {
        $table = $this->table('carrinho');
        $table->addColumn('id_produto_carrinho', 'integer')
        ->addForeignKey('id_produto_carrinho', 'produto', 'id', ['delete'=> 'CASCADE', 'update'=> 'NO_ACTION'])
        ->create();
    }
}
