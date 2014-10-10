<script type="text/javascript">
    $(function(){
        var oTable = $('#{{ $id }}').dataTable({

        @foreach ($options as $k => $o)
            {{ json_encode($k) }}: {{ json_encode($o) }},
        @endforeach

        @foreach ($callbacks as $k => $o)
            {{ json_encode($k) }}: {{ $o }},
        @endforeach

        });
    });
</script>
