/**
 * Created by Adrian on 3/11/2017.
 */
jQuery(document).ready(function($) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="_token"]').attr('content')
        }
    });

    $(".clickable-row").click(function() {
        window.document.location = $(this).data("href");
    });

    $('#market-start, #market-end, #deployment-date-datepicker').datetimepicker({
        format: 'DD.MM.YYYY'
    });

    $('#deployment-end-timepicker, #deployment-star-timepicker').datetimepicker({
        format: 'HH:mm'
    });

    $('#deployment-search-date').datetimepicker({
        format: 'DD.MM.YYYY'
    });

    $('[name="vendor"].member-vendor').click(function(){
        $('.vendor-only').toggleClass('hidden');
        console.log('test');
    });

    $('#visas tbody').on('click', '.visa_save', function(){
        var tr = $(this).parents('tr');
        var dHref = tr.data("href");
        var visa = {};
        visa.id = tr.find('.visa_id').prop('value');
        visa.title = tr.find('.visa_title').prop('value');
        visa.describe  = tr.find('.visa_describe ').val();
        visa.approved = tr.find('.visa_approved').prop('checked') == true ? 1 : 0;
        console.log(visa);
        $.ajax({
            url: dHref,
            method: 'PUT',
            data: visa,
            success: function(data, textStatus, jqXHR){
                console.log(data);
                tr.find('.visa_id').prop('value', data.id);
                tr.find('.visa_title').prop('value', data.title);
                tr.find('.visa_describe ').val(data.describe );
                var checked = data.approved == 1 ? true : false;
                tr.find('.visa_approved').prop('checked', checked);
            },
            error: function(jqXHR,textStatus){
                console.log(jqXHR.responseText);
                console.log(textStatus);
            }
        });
    });

    $('.visa_create').click(function(){
        var dHref = $(this).data("href");
        var lastTr = $('#visas tbody tr').last();
        $.ajax({
            url: dHref,
            method: 'POST',
            success: function(data, textStatus, jqXHR){
                if($('#visas tbody tr').length == 0){
                    console.log('has none');
                    $('#visas tbody').html("<tr data-href='"+ dHref + "/" + data.id + "'>" +
                        "<td><input class='visa_id' type='hidden' name='visa_id' value='"+data.id + "'><input class='visa_title form-control' type='text' name='visa_title' value='"+data.title+"'></td>" +
                        "<td><textarea class='visa_describe  form-control' name='visa_describe '>" + data.describe  + "</textarea></td>" +
                        "<td><input type='checkbox' class='visa_approved form-control' name='visa_approved' " + (data.approved == 1 ? 'checked' : '') + " value='1'></td>" +
                        "<td><button type='button' class='btn btn-default visa_save'><span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span></button>" +
                        "<button type='button' class='btn btn-danger visa_delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td></tr>");
                } else {
                    var trHref = lastTr.data("href");
                    var tr = lastTr.clone();
                    trHref = trHref.substring(0, trHref.lastIndexOf('/')+1) + data.id;
                    tr.find('.visa_id').prop('value', data.id);
                    tr.find('.visa_title').prop('value', '');
                    tr.find('.visa_describe ').val('');
                    tr.find('.visa_approved').prop('checked', false);
                    tr.prop("data-href", trHref);
                    lastTr.after(tr);
                    $('#visas tbody tr').last().data('href', trHref);
                }
            },
            error: function(jqXHR,textStatus){
                console.log(jqXHR.responseText);
                console.log(textStatus);
            }
        });
    });

    $('#visas tbody').on('click', '.visa_delete', function(){
        var tr = $(this).parents('tr');
        var dHref = tr.data("href");
        var visa = {};
        visa.id = tr.find('.visa_id').prop('value');
        $.ajax({
            url: dHref,
            method: 'DELETE',
            success: function(data, textStatus, jqXHR){
                console.log(data);
                tr.remove();
            },
            error: function(jqXHR,textStatus){
                console.log(jqXHR.responseText);
                console.log(textStatus);
            }
        });
    });

    $('.location-select').change(function(){
        var tr = $(this).parents('tr');
        var dHref = tr.data("href");
        var method = 'POST';
        var sendData = {};
        sendData.location_id = $(this).prop('value');
        sendData.old_location_id = tr.find('.location_id').prop('value');

        if(sendData.old_location_id == sendData.location_id){
            console.log('nope');
            return;
        }

        if(sendData.old_location_id == 0){
            method = 'POST';
        } else {
            if(sendData.location_id == 0 ){
                method = 'DELETE';
            } else {
                method = 'PUT';
            }
        }
        $.ajax({
            url: dHref,
            method: method,
            data: sendData,
            success: function(data, textStatus, jqXHR){
                console.log(data);
                if(data.code == 1){
                    tr.find('.location_id').prop('value', sendData.location_id);
                } else if(data.code == 2) {
                    $('.location-select').val("0");
                    tr.find('.location_id').prop('value', 0);
                    addMessage(data.message);
                } else if(data.code == 3 || data.code == 4) {
                    console.log(sendData.old_location_id);
                    tr.find('.location_id').prop('value', sendData.old_location_id);
                    $('.location-select').val(sendData.old_location_id.toString());
                    addMessage(data.message);
                }
            },
            error: function(jqXHR,textStatus){
                //console.log(jqXHR.responseText);
                console.log(textStatus);
            }
        });
    });

    $('body').on('click','.market-member-create' ,function(){
        var dHref = $(this).data("href") + "/" + $('#market-vendor').prop('value');
        console.log(dHref);
        var sendData = {};
        $.ajax({
            url: dHref,
            method: 'PUT',
            success: function(data, textStatus, jqXHR){
                if(data.code == 1){
                    var tdName = $(document.createElement('td'));
                    var tdDelete = $(document.createElement('td'));
                    var tr = $(document.createElement('tr'));
                    tr.data("href", dHref);
                    tr.addClass("marlet-member-"+ data.data.id );
                    tdName.text(data.data.name + " " + data.data.firstname);
                    console.log(data.data);
                    tdDelete.html("<button type='button' class='btn btn-danger market-member-delete'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>");
                    tr.append(tdName);
                    tr.append(tdDelete);
                    $('#market-vendor tbody').append(tr);
                    console.log(tr.html());
                }
            }
        });
    });

    $('body').on('click','.market-member-delete', function(){
        var tr = $(this).parents('tr');
        var dHref = tr.data("href");
        var sendData = {};
        $.ajax({
            url: dHref,
            method: 'DELETE',
            success: function(data, textStatus, jqXHR){
                if(data.code = 1){
                    tr.remove();
                }
            }
        });
    });

});

function addMessage(msg){
    var div = $(document.createElement('div'));
    var message = $(document.createElement('b'));
    message.text(msg);
    div.addClass('alert');
    div.addClass('alert-warning');
    div.addClass('alert-dismissible');
    div.addClass('alert-fixed');
    div.html('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
    div.append(message);
    $('body').append(div);
}