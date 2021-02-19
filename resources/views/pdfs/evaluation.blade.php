<style>
    * {
        font-family: Helvetica;
    }

    table {
        border-collapse: collapse;
    }

    td {
        padding: 3px;
    }

    table,
    td {
        border: 1px solid black;
    }

    .page_break {
        page-break-before: always;
    }

    body {
        margin-left: 50px;
        margin-top: 120px;
        margin-bottom: 55px;
    }

    .header {
        position: fixed;
        top: -10px;
        left: 0px;
        right: 0px;
        margin-bottom: 10em;
        /* height: 50px; */

        /** Extra personal styles **/
        /* background-color: #03a9f4; */
        /* color: white; */
        text-align: center;
        /* line-height: 35px; */
    }

    thead {
        display: table-row-group;
    }

    /* footer {
        position: fixed;
        bottom: 40px;
        text-align: center;
        font-size: 11px;
        font-weight: bold;
    } */

    footer {
        position: fixed;
        bottom: -20px;
        left: 0px;
        right: 0px;
        height: 50px;

        /** Extra personal styles **/
        /* background-color: #03a9f4; */
        /* color: white; */
        text-align: center;
        line-height: 35px;
        font-size: 11px;
        font-weight: bold;
    }

    div {
        font-size: 14px;
        width: 90%;
    }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div class="header">
    <img width="100%"
        src="data:image/png;base64,' . {{ base64_encode( file_get_contents( url('images/default/evaluation/banner.jpeg') ) ) }} " /><br />
</div>

<footer>
    Calle Chinchón No. 867 – San Isidro<br />
    Correo: alicia@concytec.gob.pe<br />
</footer>

<body>
    <div align="center" style="margin-top: 12em; position: absolute">
        <img src="{{asset('images/default/evaluation/1.jpg')}}" /> <br />
        <br />REPOSITORIO NACIONAL DIGITAL<br /><br /><br /><br /><br /><br />
        <br /><br /><br /><br /><br />AUTOEVALUACI&Oacute;N DEL REPOSITORIO {{strtoupper($repository->name)}}
        <br />
        <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        LIMA<br /><br />
        {{date('Y')}}<br /><br /><br /><br /><br /><br />
    </div>
    <div class="page_break" syu></div>
    {{-- <div style="margin-top: 10em; text-align:justify;"> --}}
    <br><br>
    1. Presentaci&oacute;n<br /><br />
    El presente informe tiene por objetivo remitirle el resultado de la autoevaluación que se
    realizó al repositorio de su institución.<br /><br />
    Los criterios fueron evaluados por {{getenv('APP_NAME')}} el {{\Carbon\Carbon::parse($repository->updated_at)->format('d-m-Y')}}; en la URL:<br />
    <a
        href="{{getenv('APP_URL')}}">{{getenv('APP_URL')}}</a><br /><br /><br />
    2. áreas consideradas<br /><br />
    Las áreas consideradas en esta evaluación preliminar han sido las siguientes:<br />
    
    @foreach (\App\Models\Category::has('questions')->get() as $category)
        - {{$category->name}}<br>
    @endforeach
    <br>
    3. Resultados de la autoevaluación<br /><br />

    A continuaci&oacute;n se presenta los criterios evaluados del repositorio institucional:<br /><br />


    @foreach ($categories as $category)
    <div>
        <h4>
            {{$category->name}}
        </h4>

        <table width="110%" class="table table-striped table-sm">
            @foreach ($subcategories as $subcategory)
            {{-- @if ($subcategory->questions->pluck('answers')->flatten()->count()) --}}
            <thead>
                <tr>
                    <td width="70%" align="left"><b>{{$subcategory->name}}</b></td>
                    <td width="10%" align="center"><b>Resultado</b></td>
                    <td width="30%" align="left"><b>Observaciones</b></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($subcategory->questions->where('category_id',$category->id)->all() as $question)
                <tr>
                    <td>{{$question->description}}</td>
                    <td>
                        {{$question->answers->first() && $question->answers->first()->choice ? $question->answers->first()->choice->description : 'N/A'}}
                    </td>
                        <td>
                            {{$question->answers->first() && $question->answers->first()->observation ? $question->answers->first()->observation->description : ''}}
                    </td>
                </tr>
                @endforeach
            </tbody>
            {{-- @endif --}}
            @endforeach
        </table>

    </div>
    @endforeach

    <br /><br />
    {{-- El repositorio ha sido registrado en los siguientes directorios:<br /> --}}
    Para cualquier duda o aclaración enviar correo a: alicia@concytec.gob.pe <br>
    {{-- <br /><br /> --}}
    {{-- <table width="100%">' . '$tabla_dir' . '</table> --}}
    {{-- <br /> --}}
    Sin otro particular, expreso a usted mi especial consideración.<br /><br />
    Atentamente,
    </div>
</body>