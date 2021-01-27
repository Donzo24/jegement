@php
	//dd(json_decode($demande->variables, true));
@endphp

		
<div class="card">
    {{-- <img class="card-img-top img-fluid" src="../assets/images/small/img-1.jpg" alt="Card image cap"> --}}
    <div class="card-body">
        {{-- <h5 class="card-title">Card title</h5> --}}
        <ol>
        	@foreach ($demande->document->variables() as $variable)
	            @php
	                $v = explode(":", $variable);
                    if (!isset(json_decode($demande->variables, true)[$v[0]])) {
                        continue;
                    }
	            @endphp
	            <li>{{ $v[1] }}: {{ json_decode($demande->variables, true)[$v[0]] }}</li>
	        @endforeach
        </ol>
        <a href="{{ route('demandes.show', $demande->id_demande) }}" class="btn btn-primary waves-effect waves-light">
        	Imprimer
        </a>
        <a href="{{ route('demandes.edit', $demande->id_demande) }}" class="btn btn-success waves-effect waves-light">
            Modifier
        </a>
    </div>
</div>