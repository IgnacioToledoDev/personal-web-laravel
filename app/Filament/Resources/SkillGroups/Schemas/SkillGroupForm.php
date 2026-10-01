<?php

namespace App\Filament\Resources\SkillGroups\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SkillGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('group')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Repeater::make('items')
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        Select::make('level')
                            ->options([
                                1 => '1',
                                2 => '2',
                                3 => '3',
                                4 => '4',
                                5 => '5',
                            ])
                            ->required(),
                        TextInput::make('note'),
                    ])
                    ->columns(3)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
