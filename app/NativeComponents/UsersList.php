<?php

namespace App\NativeComponents;

use App\Models\User;
use Illuminate\View\View;
use Native\Mobile\Edge\NativeComponent;

class UsersList extends NativeComponent
{
    public $search = '';

    public $users = [];

    public $search_users = [];

    public bool $showSearchResults = false;

    public function mount(): void
    {
        $this->users = User::all();
    }

    public function loadUsers(): void
    {
        $this->users = User::all();

        // Also refresh search results if a search is active
        if ($this->search !== '') {
            $this->search_users = User::where(
                'name',
                'like',
                '%' . $this->search . '%'
            )->get();
        }
    }

    public function refresh(): void
    {
        $this->loadUsers();
    }


    public function updatedSearch($value)
    {
        $this->showSearchResults = !empty($value);

        if (empty($value)) {
            $this->search_users = [];
            return;
        }
        $this->search_users = User::where('name', 'like', '%' . $this->search . '%')->get();
    }

    public function render(): View
    {
        return view('native.users-list');
    }
}
