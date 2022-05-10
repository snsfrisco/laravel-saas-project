<script type="text/javascript">
    $(document).ready(function() {

        $('#sites').change(function() {
            var site_id = $(this).val();
            if(site_id !== ""){
                on();
                let _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "POST",
                    url: "{{route('get_labs_by_site')}}",
                    async: true,
                    data: {
                        site_id: site_id,
                        _token: _token
                    },
                    success:function(response){
                        $('#labs').html(response);
                        off();
                    }
                });
            }
        });

    });
</script>
