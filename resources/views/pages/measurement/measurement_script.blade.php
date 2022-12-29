<script>
    $( document ).ready(function() {
   $('#measurement').on('click',function (){
          let length = $('.measurement').length;
          let script = '<div id="measurement_inputs_'+ length +'" class="card measurement" style="margin: 5px 0;"><div class="card-body" style="height:auto;"> ' +
               '<div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard('+ length +')>' +
               '<span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span></div>' +
               '<div class="row">' +
               '<div class="col-md-4">' +
               '<label class="form-label">Measurement<a style="text-decoration: none;color:red">*</a></label><select required name="measurement_types[]" id="select_measurement_'+ length +'" class="form-control" >' +
               '</select> </div>' +
               '<div class="col-md-4">' +
               '<label class="form-label">Value<a style="text-decoration: none;color:red">*</a></label>' +
               '<input class="form-control" required type="number" id="value_'+ length +'" name="values[]"> </div>' +
               '<div class="col-md-4">' +
               '<label class="form-label">Comments</label>' +
               '<input class="form-control" type="text" id="comments_'+ length +'" name="measurement_comments[]"/> </div>' +
               '</div>'
           $('#measurement_div').append(script);
            $.ajax({
               url:"{{ route('getMeasurement') }}",
               type: "GET",
               contentType: false,
               cache: false,
               processData: false,
               success:function (data) {
                   $(`#select_measurement_${length}`).append('<option value="">--Select any one --</option>');
                   $.each(data,function(index,value){
                       for(let k in value) {
                            $(`#select_measurement_${length}`).append('<option value="'+k+'">'+value[k]+'</option>');
                       }
                   })
               }
           });
           $(`#select_measurement_${length}`).trigger('focus');
        });
    });

     function deleteCard(value,id){
        if(id) {
              $(`#delete_ids`).append(`<input type="hidden" style="display:none" name="delete[]" value="${id}" /> `);
        }
        $(`#measurement_inputs_${value}`).remove();
    }
      
</script>