function models_refresh(f,l)
{
    var url= models_refresh_url;
    var param = 'f='+f+'&selected_language='+l;

    $.post(url, param, function(data){
        $('#models_refresh_id').html(data);
    });
}