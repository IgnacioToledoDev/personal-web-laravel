<?php

namespace App\Filament\Resources\Links\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('label')
                    ->required(),
                TextInput::make('display')
                    ->required(),
                TextInput::make('href')
                    ->required()
                    ->rules(['regex:/^(https?:\/\/|mailto:).+/i'])
                    ->validationMessages(['regex' => 'Debe ser una URL http(s) o un mailto:.']),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
