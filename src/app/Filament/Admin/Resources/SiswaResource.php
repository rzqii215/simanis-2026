<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SiswaResource\Pages;
use App\Filament\Admin\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('nisn')
                    ->maxLength(10)
                    ->default(null),
                Forms\Components\TextInput::make('nis')
                    ->maxLength(15)
                    ->default(null),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('tingkat_id')
                    ->relationship('tingkat', 'id')
                    ->required(),
                Forms\Components\Select::make('jurusan_id')
                    ->relationship('jurusan', 'id')
                    ->default(null),
                Forms\Components\Select::make('kelas_id')
                    ->relationship('kelas', 'id')
                    ->default(null),
                Forms\Components\Select::make('tahun_ajaran_id')
                    ->relationship('tahunAjaran', 'id')
                    ->default(null),
                Forms\Components\Select::make('wali_id')
                    ->relationship('wali', 'id')
                    ->default(null),
                Forms\Components\TextInput::make('status_siswa')
                    ->required(),
                Forms\Components\TextInput::make('nilai_rapor')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('prestasi')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('alasan_nonaktif')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal_lulus'),
                Forms\Components\TextInput::make('nomor_ijazah')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('alasan_drop')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal_drop'),
                Forms\Components\TextInput::make('jalur_masuk')
                    ->required(),
                Forms\Components\TextInput::make('asal_sekolah')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('surat_mutasi')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('nilai_prestasi')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('jenis_prestasi')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Toggle::make('is_yatim_piatu')
                    ->required(),
                Forms\Components\TextInput::make('foto')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nisn')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tingkat.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jurusan.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kelas.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tahunAjaran.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wali.id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_siswa'),
                Tables\Columns\TextColumn::make('nilai_rapor')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('prestasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_lulus')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nomor_ijazah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_drop')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jalur_masuk'),
                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->searchable(),
                Tables\Columns\TextColumn::make('surat_mutasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nilai_prestasi')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis_prestasi')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_yatim_piatu')
                    ->boolean(),
                Tables\Columns\TextColumn::make('foto')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
