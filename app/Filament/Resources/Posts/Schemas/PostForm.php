<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('resumen')
                    ->maxLength(160)
                    ->columnSpanFull(),
                Textarea::make('contenido')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('categoria_id')
                    ->required()
                    ->numeric(),
                Toggle::make('publicado')
                    ->required(),
                TextInput::make('user_id')
                    ->numeric(),
            ]);
    }
}
