<?php

namespace App\Filament\Resources\Experiences\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExperienceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('hash')
                    ->required(),
                TextInput::make('role')
                    ->required(),
                TextInput::make('company')
                    ->required(),
                TextInput::make('when')
                    ->required(),
                Repeater::make('what')
                    ->simple(
                        TextInput::make('bullet')->required()
                    )
                    ->required()
                    ->columnSpanFull(),
                TagsInput::make('stack')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
