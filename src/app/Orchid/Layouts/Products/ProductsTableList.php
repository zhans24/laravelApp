<?php

namespace App\Orchid\Layouts\Products;

use App\Infrastructure\Models\EloquentCategory;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ProductsTableList extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'products';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('id','ID')->cantHide(),
            TD::make('name','Название')->cantHide(),
            TD::make('code','Код'),
            TD::make('price','Цена'),
            TD::make('category_id','Категория')->render(fn($product) =>
            EloquentCategory::find($product->category_id)->name
            )

        ];
    }
}
