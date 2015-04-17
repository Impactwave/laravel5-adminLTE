@extends ('layout.main')

@section ('content')

@section ('box-body')
    <table id="tabela1">
        <colgroup>
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
        </colgroup>
        <thead>
        <tr>
            <th>Col 1</th>
            <th>Col 2</th>
            <th>Col 3</th>
            <th>Col 4</th>
        </tr>
        </thead>
    </table>
@stop

@section ('box-footer')
    <div align="right">
        <!--button class="btn btn-primary">Button</button!-->
    </div>
@stop

@include ('partial.box', ['title'=>'Title'])

@stop

@section ('scripts')
    @parent
    <script>
        $(function() {
            $('#tabela1').dataTable({
                ordering: false,
                serverSide: true,
                searching: false,
                language: { url: 'js/datatables/pt-PT.json' },
                ajax: {
                    url: '',
                    type: 'POST',
                    autoWidth: false
                }
            });
        });
    </script>
@overwrite