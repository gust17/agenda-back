<?php

namespace App\Http\Controllers;

use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    // Listar todos os participantes
    public function index()
    {
        $participantes = Participante::all();
        return response()->json($participantes);
    }

    // Criar um novo participante
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:participantes,email',
            'telefone' => 'required|string|unique:participantes,telefone',
        ]);

        $participante = Participante::create($validatedData);
        return response()->json($participante, 201);
    }

    // Mostrar um participante específico
    public function show($id)
    {
        $participante = Participante::findOrFail($id);
        return response()->json($participante);
    }

    // Atualizar um participante existente
    public function update(Request $request, $id)
    {
        $participante = Participante::findOrFail($id);

        $validatedData = $request->validate([
            'nome' => 'string|max:255',
            'email' => 'email|unique:participantes,email,' . $participante->id,
            'telefone' => 'string|unique:participantes,telefone,' . $participante->id,
        ]);

        $participante->update($validatedData);
        return response()->json($participante);
    }

    // Deletar um participante
    public function destroy($id)
    {
        $participante = Participante::findOrFail($id);
        $participante->delete();
        return response()->json(['message' => 'Participante deletado com sucesso']);
    }
}
