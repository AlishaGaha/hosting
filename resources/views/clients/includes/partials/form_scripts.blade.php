<script>
    $(function(){
        $('#service_type').change(function () {
            if($(this).val() == 'Domain') {
                $('.domain_section').css('display', 'flex');
                $('.hosting_section').css('display', 'none');
            } else if($(this).val() == 'Hosting') {
                $('.domain_section').css('display', 'none');
                $('.hosting_section').css('display', 'flex');
            } else {
                $('.domain_section').css('display', 'flex');
                $('.hosting_section').css('display', 'flex');
            }
        });
    });
</script>