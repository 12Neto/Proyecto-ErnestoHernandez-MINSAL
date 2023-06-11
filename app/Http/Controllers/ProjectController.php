<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PDF;

class projectController extends Controller
{
    //
    public function index():Renderable
    {
        $projects = Project::paginate(5);
        return view('projects.index', compact('projects'));
    }
    public function create(): Renderable
    {
        $project = new Project;
        $title = __('Crear proyecto');
        $action = route('projects.store');
        $buttonText = __('Crear proyecto');
        return view('projects.form', compact('project', 'title', 'action', 'buttonText'));
    }

    public function store(Request $request): RedirectResponse
    {
        /*
        'nombreProyecto',
        'fuenteFondos',
        'montoPlanificado',
        'montoPatrocinado',
        'montoFondosPropios'
         */
        $request->validate([
            'nombreProyecto' => 'required|unique:projects,nombreProyecto|string|max:100',
            'fuenteFondos' => 'required|string|max:100',
            'montoPlanificado' => 'required|string|max:100',
            'montoPatrocinado' => 'required|string|max:100',
            'montoFondosPropios' => 'required|string|max:100'
        ]);
        Project::create([
            'nombreProyecto' => $request->string('nombreProyecto'),
            'fuenteFondos' => $request->string('fuenteFondos'),
            'montoPlanificado' => $request->string('montoPlanificado'),
            'montoPatrocinado' => $request->string('montoPatrocinado'),
            'montoFondosPropios' => $request->string('montoFondosPropios'),
        ]);
        return redirect()->route('projects.index');
    }

    public function show(Project $project): Renderable
    {
        $project->load('user:id,nombreProyecto');
        return view('projects.form', compact('project'));
    }

    public function edit(Project $project): Renderable
    {
        $title = __('Editar proyecto');
        $action = route('projects.update', $project);
        $buttonText = __('Actualizar proyecto');
        $method = 'PUT';
        return view('projects.form', compact('project', 'title', 'action', 'buttonText', 'method'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $request->validate([
            'nombreProyecto' => 'required|unique:projects,nombreProyecto,' . $project->id . '|string|max:100',
            'fuenteFondos' => 'required|string|max:100',
            'montoPlanificado' => 'required|string|max:100',
            'montoPatrocinado' => 'required|string|max:100',
            'montoFondosPropios' => 'required|string|max:100'
        ]);
        $project->update([
            'nombreProyecto' => $request->string('nombreProyecto'),
            'fuenteFondos' => $request->string('fuenteFondos'),
            'montoPlanificado' => $request->string('montoPlanificado'),
            'montoPatrocinado' => $request->string('montoPatrocinado'),
            'montoFondosPropios' => $request->string('montoFondosPropios')
        ]);
        return redirect()->route('projects.index');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

    public function getPDF()
    {
        $name="Juan Perez";
        $pdf = PDF::loadView('pdf', compact('name'));
        return $pdf->stream('documento.pdf');
    }
}
