$.ajax({
    type: type,
    url: my_url,
    data: formData,
    dataType: 'json',
    success: function(data) {
        console.log(data);
        var reparto = '<tr id="reparto' + data.id + '"><td>' + data.id + '</td><td>' + data.nombre + '</td>; 
        reparto += '<button class="btn btn-danger btn-sm delete-reparto fa fa-times" value="' + data.id + '"></button></td></tr>';
        reparto += '<td><button class="btn btn-info btn-sm fa fa-pencil-square-o" value="' + data.id + '"></button>';
        
        
        if (state == "add") { //if user added a new record
            $('#repartos-list').append(reparto);
        } else { //if user updated an existing record
            $("#reparto" + reparto_id).replaceWith(reparto);
        }
        $('#frmTasks').trigger("reset");
        $('#myModal').modal('hide')
    },
    error: function(data) {
        console.log('Error:', data);
    }
});