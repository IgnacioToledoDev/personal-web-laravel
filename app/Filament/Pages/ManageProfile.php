<?php

namespace App\Filament\Pages;

use App\Models\Profile;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

/**
 * @property-read Schema $form
 */
class ManageProfile extends Page
{
    protected string $view = 'filament.pages.manage-profile';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $title = 'Profile';

    /**
     * @var array<string, mixed>|null
     */
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill($this->getRecord()->attributesToArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    TextInput::make('user')
                        ->required(),
                    TextInput::make('host')
                        ->required(),
                    TextInput::make('path')
                        ->required()
                        ->default('~'),
                    Textarea::make('ascii')
                        ->label('ASCII banner')
                        ->rows(10)
                        ->required()
                        ->columnSpanFull(),
                    TextInput::make('neofetch_title_name')
                        ->label('Neofetch title name')
                        ->required(),
                    TextInput::make('neofetch_title_host')
                        ->label('Neofetch title host')
                        ->required(),
                    Repeater::make('neofetch_rows')
                        ->label('Neofetch rows')
                        ->schema([
                            TextInput::make('label')
                                ->required(),
                            TextInput::make('value')
                                ->helperText('For multiple values, separate with commas.')
                                ->required(),
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                    Textarea::make('about_lead')
                        ->label('About lead')
                        ->helperText('Supports **bold** and <hl>highlight</hl> markdown-lite syntax.')
                        ->rows(5)
                        ->required()
                        ->columnSpanFull(),
                    Repeater::make('about_meta')
                        ->label('About meta')
                        ->schema([
                            TextInput::make('key')
                                ->required(),
                            TextInput::make('value')
                                ->required(),
                            Toggle::make('isAccent')
                                ->label('Accent'),
                        ])
                        ->columns(3)
                        ->columnSpanFull(),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->submit('save')
                                ->keyBindings(['mod+s']),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $record = $this->getRecord();
        $record->fill($data);
        $record->save();

        Notification::make()
            ->success()
            ->title('Saved')
            ->send();
    }

    public function getRecord(): Profile
    {
        return Profile::query()->firstOrNew(['id' => 1]);
    }
}
