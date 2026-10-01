<?php

namespace App\Filament\Resources\TechCategories;

use App\Filament\Resources\TechCategories\Pages\CreateTechCategory;
use App\Filament\Resources\TechCategories\Pages\EditTechCategory;
use App\Filament\Resources\TechCategories\Pages\ListTechCategories;
use App\Filament\Resources\TechCategories\Schemas\TechCategoryForm;
use App\Filament\Resources\TechCategories\Tables\TechCategoriesTable;
use App\Models\TechCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TechCategoryResource extends Resource
{
    protected static ?string $model = TechCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TechCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TechCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTechCategories::route('/'),
            'create' => CreateTechCategory::route('/create'),
            'edit' => EditTechCategory::route('/{record}/edit'),
        ];
    }
}
