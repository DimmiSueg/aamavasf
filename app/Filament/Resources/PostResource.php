<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-document-text';
    protected static \BackedEnum|string|null $navigationLabel = 'Posts do Blog';
    protected static ?string $modelLabel = 'Post';
    protected static ?string $pluralModelLabel = 'Posts do Blog';
    protected static \UnitEnum|string|null $navigationGroup = 'Conteúdo';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informações principais')->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) =>
                        $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Textarea::make('excerpt')
                    ->label('Resumo')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
            ])->columns(2),

            Forms\Components\Section::make('Conteúdo')->schema([
                Forms\Components\RichEditor::make('content')
                    ->label('Conteúdo')
                    ->required()
                    ->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Publicação')->schema([
                Forms\Components\Select::make('category')
                    ->label('Categoria')
                    ->options([
                        'noticias' => 'Notícias',
                        'eventos' => 'Eventos',
                        'dicas' => 'Dicas e Orientações',
                        'conquistas' => 'Conquistas',
                        'parceiros' => 'Parceiros',
                    ])
                    ->default('noticias')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(['draft' => 'Rascunho', 'published' => 'Publicado'])
                    ->default('draft')
                    ->required(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Data de publicação'),

                Forms\Components\FileUpload::make('featured_image')
                    ->label('Imagem de destaque')
                    ->image()
                    ->directory('posts')
                    ->columnSpanFull(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')->label('Imagem'),
                Tables\Columns\TextColumn::make('title')->label('Título')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->label('Categoria')->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'published' => 'success',
                        default => 'warning',
                    }),
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Publicado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['draft' => 'Rascunho', 'published' => 'Publicado']),
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
