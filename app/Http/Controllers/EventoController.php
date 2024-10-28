<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::with('participantes')->get();
        return response()->json($eventos);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_hora' => 'required|date',
            'tipo' => 'required|integer',
            'participantes' => 'nullable|array', // Array de IDs de participantes
            'participantes.*' => 'exists:participantes,id'
        ]);

        $evento = Evento::create($validatedData);

        if (!empty($validatedData['participantes'])) {
            $evento->participantes()->attach($validatedData['participantes']);
        }
        return response()->json($evento, 201);
    }

    // Mostrar um evento específico
    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return response()->json($evento);
    }

    // Atualizar um evento existente
    public function update(Request $request, $id)
    {
        $evento = Evento::findOrFail($id);

        $validatedData = $request->validate([
            'nome' => 'string|max:255',
            'descricao' => 'nullable|string',
            'data_hora' => 'date',
            'tipo' => 'integer',
            'participantes' => 'array', // Validar que 'participantes' seja uma lista
            'participantes.*' => 'integer|exists:participantes,id', // Cada participante deve existir na tabela 'participantes'
        ]);

        $evento->update($validatedData);

        // Sincronizar os participantes do evento
        if ($request->has('participantes')) {
            $evento->participantes()->sync($validatedData['participantes']);
        }

        return response()->json($evento->load('participantes'));
    }


    // Deletar um evento
    public function destroy($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();
        return response()->json(['message' => 'Evento deletado com sucesso']);
    }


    public function eventosHoje()
    {
        $hoje = Carbon::today()->toDateString();

        $eventosHoje = Evento::whereDate('data_hora', $hoje)->with('participantes')->get();

        return response()->json($eventosHoje);
    }
}
