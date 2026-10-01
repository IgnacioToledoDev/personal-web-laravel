<?php

namespace App\Filament\Resources\TechCategories\Pages;

use App\Filament\Resources\TechCategories\TechCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTechCategories extends ListRecords
{
    protected static string $resource = TechCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
