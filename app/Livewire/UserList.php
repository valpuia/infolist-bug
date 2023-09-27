<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

class UserList extends Component implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public $users;

    public function mount(): void
    {
        $this->users = User::limit(5)->get();
    }

    public function userListWithSplit(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'users' => $this->users,
            ])
            ->schema([
                RepeatableEntry::make('users')
                    ->label('Using Split')
                    ->schema([
                        Split::make([
                            TextEntry::make('name'),
                            TextEntry::make('email'),
                        ])->from('md'),
                    ]),
            ]);
    }

    public function userListNormal(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'users' => $this->users,
            ])
            ->schema([
                RepeatableEntry::make('users')
                    ->label('Normal')
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                    ]),
            ]);
    }

    public function render()
    {
        return view('livewire.user-list');
    }
}
