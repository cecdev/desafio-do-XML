<?xml version="1.0" encoding="UTF-8"?>
<Empresa>
    @foreach ($data_emp as $key => $item)
    <{{ $key }}>{{$item}}</{{ $key }}>
    @endforeach
    @if (!empty($atividade_principal[0]["text"]))
        <AtividadePrincipal>
            <text>{{ $atividade_principal[0]["text"] }}</text>
            <code>{{ $atividade_principal[0]["code"] }}</code>

        </AtividadePrincipal>
    @endif
    @if (!empty($atividades_secundarias[0]["text"]))
        <AtividadesSecundarias>
            @for ($i = 0; $i < count($atividades_secundarias); $i++)
            <Atividade row="{{ $i+1 }}">
                <text>{{ $atividades_secundarias[$i]["text"] }}</text>
                <code>{{ $atividades_secundarias[$i]["code"] }}</code>
            </Atividade>
            @endfor
        </AtividadesSecundarias>
    @endif
</Empresa>
