<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Eventos';
    protected static ?string $modelLabel = 'Evento';
    protected static ?string $pluralModelLabel = 'Eventos';
    protected static \UnitEnum|string|null $navigationGroup = 'Conteúdo';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\Section::make('Informações do evento')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Data e Local')->schema([
                Forms\Components\DateTimePicker::make('date')
                    ->label('Data e hora de início')
                    ->required(),

                Forms\Components\DateTimePicker::make('end_date')
                    ->label('Data e hora de término (opcional)'),

                Forms\Components\TextInput::make('location')
                    ->label('Local')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('address')
                    ->label('Endereço completo')
                    ->maxLength(255),
            ])->columns(2),

            Forms\Components\Section::make('Detalhes adicionais')->schema([
                Forms\Components\Toggle::make('is_free')
                    ->label('Evento gratuito')
                    ->default(true),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'scheduled' => 'Agendado',
                        'done' => 'Realizado',
                        'cancelled' => 'Cancelado',
                    ])
                    ->default('scheduled')
                    ->required(),

                Forms\Components\TextInput::make('registration_link')
                    ->label('Link de inscrição')
                    ->url()
                    ->maxLength(255),

                Forms\Components\FileUpload::make('image')
                    ->label('Imagem do evento')
                    ->image()
                    ->directory('events'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Título')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('date')->label('Data')->dateTime('d/m/Y H:i')->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Local'),
                Tables\Columns\IconColumn::make('is_free')->label('Gratuito')->boolean(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'scheduled' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('date')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['scheduled' => 'Agendado', 'done' => 'Realizado', 'cancelled' => 'Cancelado']),
            ])
            ->actions([Actions\EditAction::make()])
            ->bulkActions([Actions\BulkActionGroup::make([
                Actions\DeleteBulkAction::make(),
            ])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
