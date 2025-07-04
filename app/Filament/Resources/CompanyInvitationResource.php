<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyInvitationResource\Pages;
use App\Filament\Resources\CompanyInvitationResource\RelationManagers;
use App\Models\CompanyInvitation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
class CompanyInvitationResource extends Resource
{
    protected static ?string $model = CompanyInvitation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(1)->schema([
                    TextInput::make('email')
                        ->label('Invitee Email')
                        ->required()
                        ->email(),

                    Select::make('role')
                        ->label('Role')
                        ->options([
                            'admin' => 'Admin',
                            'viewer' => 'Viewer',
                        ])
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->label('Email'),
                TextColumn::make('role')->label('Rol'),
                TextColumn::make('created_at')->dateTime()->label('Creat la'),
            ])
            ->filters([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanyInvitations::route('/'),
            'create' => Pages\CreateCompanyInvitation::route('/create'),
            'edit' => Pages\EditCompanyInvitation::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('company_id', auth()->user()->company_id);
    }
}
