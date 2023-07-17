<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use App\Models\Project\Type;
use Illuminate\Http\Request;

class TypesController extends Controller {

    private array $validations = [
        'name' => 'required|string|min:5|max:100',
    ];

    private array $validation_messages = [
        'required' => 'The :attribute field is required',
        'min' => 'The :attribute field must be at least :min characters',
        'max' => 'The :attribute field cannot exceed :max characters',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $types = Type::paginate(10);
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate($this->validations, $this->validation_messages);
        $data = $request->all();

        $newType = new Type();
        $newType->name = $data['name'];
        $newType->save();

        return redirect()->route('admin.types.index')->with('success', $newType);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type) {
        foreach ($type->projects() as $project) {
            $project->category_id = 1;
            $project->update();
        }

        $type->delete();


        return to_route('admin.types.index')->with('delete_success', $type);
    }
}
