<?php

namespace App\Orchid\Screens\Products;

use App\Infrastructure\Models\EloquentCategory;
use App\Infrastructure\Models\EloquentProduct;
use App\Orchid\Layouts\Products\ProductsTableList;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ProductListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'products'=>EloquentProduct::paginate(15),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Список всех продуктов';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make("Создать продукт")->modal('createProduct')->method('create')
        ];
    }

    public function create(Request $request): void
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'code' => 'required|string',
            'photo' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        EloquentProduct::create($data);

        Toast::info('Продукт успешно создан');
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ProductsTableList::class,
            Layout::modal('createProduct', Layout::rows([
                Input::make('name')->required()->title("Название"),
                Input::make('description')->required()->title("Описание"),
                Input::make('price')->required()->type('number')->title("Цена"),
                Input::make('code')->required()->title("Код"),
                Input::make('photo')->title("Ссылка фото"),
                Select::make('category_id')->title("Категория")
                    ->fromModel(EloquentCategory::class, 'name')
                    ->required(),
            ]))->title("Данные продукта")
        ];
    }
}
