<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('lang')
                    ->required(),
                TextInput::make('color')
                    ->placeholder('var(--c-orange)')
                    ->required(),
                TextInput::make('stars')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('desc')
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('tags')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('url')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
