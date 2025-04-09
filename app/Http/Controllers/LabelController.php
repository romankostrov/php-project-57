<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LabelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labels = Label::paginate();
        return view('label.index', compact('labels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Используем Gate для проверки разрешения 'create' для Label
        if (Gate::allows('create', Label::class)) {
            return view('label.create');
        }

        // Если нет прав, возвращаем 403 Forbidden, а не 401 Unauthorized.
        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $dataFill = $request->validate([
            'name' => 'required|unique:labels|max:20',
            'description' => 'required|unique:labels|max:100',
        ], [''], ['name' => __('label.label')], ['description' => __('label.label')]);
        $label = new Label();
        $label->fill($dataFill);
        $label->save();
        flash(__('label.flashCreate'))->success();
        return redirect()
            ->route('label.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Label $label)
    {
        // Используем Gate для проверки разрешения 'update' для конкретной метки.
        if (Gate::allows('update', $label)) {
            return view('label.edit', ['label' => $label]);
        }

        // Если нет прав, возвращаем 403 Forbidden.
        abort(403);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Label $label): RedirectResponse
    {
        $data = $request->validate([
            'name' => "required|max:20|unique:labels,name,{$label->id}",
            'description' => "required|max:100|unique:labels,name,{$label->id}",
        ], [''], ['name' => __('label.label')], ['description' => __('label.label')]);
        $label->fill($data);
        $label->save();
        flash(__('label.flashChange'))->success();
        return redirect()
            ->route('label.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Label $label)
    {
        // Используем Gate для проверки разрешения 'delete' для конкретной метки.
        if (Gate::allows('delete', $label)) {
            try {
                $label->delete();
            } catch (\Exception $e) {
                flash(__('label.flashNotDelete'))->error();
                return redirect()
                    ->route('label.index');
            }
            flash(__('label.flashDelete'))->success();
            return redirect()->route('label.index');
        }

        // Если нет прав, возвращаем 403 Forbidden.
        abort(403);
    }
}
