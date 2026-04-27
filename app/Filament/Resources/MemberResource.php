<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Associados';
    protected static ?string $modelLabel = 'Associado';
    protected static ?string $pluralModelLabel = 'Associados';
    protected static \UnitEnum|string|null $navigationGroup = 'Associados';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Dados pessoais')->schema([
                Forms\Components\TextInput::make('name')->label('Nome completo')->required(),
                Forms\Components\TextInput::make('email')->label('E-mail')->email()->required(),
                Forms\Components\TextInput::make('phone')->label('Telefone / WhatsApp')->required(),
                Forms\Components\TextInput::make('city')->label('Cidade'),
            ])->columns(2),

            Forms\Components\Section::make('Participação')->schema([
                Forms\Components\Select::make('role')
                    ->label('Como quer contribuir')
                    ->options([
                        'family' => 'Pai / Mãe / Familiar',
                        'volunteer' => 'Voluntário(a)',
                        'health_pro' => 'Profissional da saúde',
                        'educator' => 'Educador(a)',
                        'partner' => 'Parceiro(a) / Empresa',
                        'donor' => 'Doador(a)',
                        'other' => 'Outro',
                    ])
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status do cadastro')
                    ->options([
                        'pending' => 'Pendente',
                        'approved' => 'Aprovado',
                        'rejected' => 'Recusado',
                    ])
                    ->default('pending')
                    ->required(),

                Forms\Components\Textarea::make('message')->label('Mensagem do interessado')->rows(3)->columnSpanFull(),
                Forms\Components\Textarea::make('notes')->label('Observações internas (equipe)')->rows(3)->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('email')->label('E-mail')->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('WhatsApp'),
                Tables\Columns\TextColumn::make('role')
                    ->label('Tipo')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'family' => 'Familiar', 'volunteer' => 'Voluntário',
                        'health_pro' => 'Saúde', 'educator' => 'Educador',
                        'partner' => 'Parceiro', 'donor' => 'Doador', default => 'Outro',
                    }),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Cadastrado em')->dateTime('d/m/Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['pending' => 'Pendente', 'approved' => 'Aprovado', 'rejected' => 'Recusado']),
                Tables\Filters\SelectFilter::make('role')
                    ->label('Tipo')
                    ->options([
                        'family' => 'Familiar', 'volunteer' => 'Voluntário',
                        'health_pro' => 'Saúde', 'educator' => 'Educador',
                        'partner' => 'Parceiro', 'donor' => 'Doador',
                    ]),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMembers::route('/'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
