@extends('layouts.app')

@section('content')
    <div class="grid col-span-full">
        <h1 class="mb-5">{{ __('views.label.index.header') }}</h1>
        @can('create', App\Models\Label::class)
            <div>
                <x-link-button route="{{ route('labels.create') }}" text="{{ __('views.label.index.create') }}" />
            </div>
        @endcan
        <table class="mt-4">
            <thead class="border-b-2 border-solid border-black text-left">
                <tr>
                    <th>{{ __('views.label.index.id') }}</th>
                    <th>{{ __('views.label.index.name') }}</th>
                    <th>{{ __('views.label.index.description') }}</th>
                    <th>{{ __('views.label.index.created_at') }}</th>
                    @auth
                        <th>{{ __('views.label.index.actions') }}</th>
                    @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($labels as $label)
                    <tr class="border-b border-dashed text-left">
                        <td>{{ $label->id }}</td>
                        <td>{{ $label->name }}</td>
                        <td>{{ $label->description }}</td>
                        <td>{{ $label->created_at->format('d.m.Y') }}</td>
                        <td>
                            @can('delete', $label)
                                <x-link-red route="{{ route('labels.destroy', $label->id) }}"
                                    confirm="{{ __('views.actions.delete_confirm') }}"
                                    text="{{ __('views.actions.delete') }}" />
                            @endcan
                            @can('update', $label)
                                <x-link-blue route="{{ route('labels.edit', $label->id) }}"
                                    text="{{ __('views.actions.edit') }}" />
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $labels->links() }}
        </div>
    </div>
@endsection
