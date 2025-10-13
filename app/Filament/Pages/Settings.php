<?php

namespace App\Filament\Pages;

// use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\TextEntry;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected string $view = 'filament.pages.settings';

    protected static string| \BackedEnum |null $navigationIcon = Heroicon::OutlinedCog6Tooth;


    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('clinic_name')
                    ->label('Clinic Name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter clinic name'),
                TextInput::make('clinic_address')
                    ->label('Clinic Address')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Enter clinic address'),
                TextInput::make('clinic_phone')
                    ->label('Clinic Phone')
                    ->required()
                    ->maxLength(20)
                    ->placeholder('Enter clinic phone number'),
                TextInput::make('clinic_email')
                    ->label('Clinic Email')
                    ->required()    
                    ->maxLength(255)
                    ->placeholder('Enter clinic email'),
            ]);
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('clinic_name')
                    ->label('Clinic Name'),
            ]);
    }
}