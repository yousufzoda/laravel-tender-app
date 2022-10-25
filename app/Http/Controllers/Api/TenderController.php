<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TenderResource;
use App\Models\Tender;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index(Request $request)
    {
        $tender = Tender::where(function ($query) use ($request){
            if ($request->has('name')){
                $query->where('tenders.name','like', '%' . $request->input('name') . '%');
            }
            if ($request->has('date')){
                $query->where('tenders.date','like', '%' .$request->input('date') . '%');
            }
        })->get();

        return response()->json([TenderResource::collection($tender), 'Тендеры получены.']);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'external_code' => 'required',
            'number' => 'required',
            'status' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $tender = Tender::create($data);
        return new TenderResource($tender);
    }

    public function show(Tender $tender)
    {
        return new TenderResource($tender);
    }

    public function update(Request $request, Tender $tender)
    {
        $tender->update($request->all());
        return response()->json([new TenderResource($tender), 'Тендер успешно обновлено!']);
    }

    public function destroy(Tender $tender)
    {
        $tender->delete();
        return response()->json([new TenderResource($tender), 'Тендер успешно удалено!']);
    }

}
