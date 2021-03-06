@extends("admin.layouts.app")

@section("title", "Users - ".config("app.name"))

@section("content")
<div class="card">

    <livewire:users />

</div>

<livewire:user-edit />
<livewire:user-delete />
<livewire:toggle-user-group-status />
<livewire:toggle-user-paid-status />
@endsection