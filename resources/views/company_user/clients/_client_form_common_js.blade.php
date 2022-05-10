<script>
    var live_path = "{{isset($client) ? $client->live_path : '' }}";
    $(document).on('click', '.toggle', function(){
        $('#live_path_div').toggleClass('d-none');
        if($('#path_mode').prop('checked')){
            $('#live_path').attr('required', true);
            $('#live_path').val(live_path);
        }else{
            $('#live_path').attr('required', false);
        }
    });

</script>
