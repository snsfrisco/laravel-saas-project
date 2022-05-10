<script>
    (function($){

        $('.select_all_modules').on('click',function(){
            $('input[type=checkbox]').prop('checked',true);
        });

        $('.deselect_all_modules').on('click',function(){
            $('input[type=checkbox]').prop('checked',false);
        });

        $('.select_module').on('click',function(){
            $(this).parent().next('.card-body').find('input[type=checkbox]').prop('checked',true);
        });

        $('.deselect_module').on('click',function(){
            $(this).parent().next('.card-body').find('input[type=checkbox]').prop('checked',false);
        });

    })(jQuery);
</script>
