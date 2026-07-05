<?php

namespace App\Filament\App\Resources\LinkResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class StatisticsRelationManager extends RelationManager
{
    protected static string $relationship = 'statistics';

    protected static ?string $title = 'Статистика переходов';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('client_ip')
            ->columns([
                Tables\Columns\TextColumn::make('client_ip')
                    ->label('IP-адрес'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата и время перехода')
                    ->dateTime('d.m.Y H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
            ])
            ->actions([
            ]);
    }
}
