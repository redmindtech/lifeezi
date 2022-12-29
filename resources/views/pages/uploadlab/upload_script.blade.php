<script>
    $( document ).ready(function() {
   $('#uploadlab').on('click',function (){
          let length = $('.uploadlab').length;
          let script = '<div id="uploadlab_inputs_'+ length +'" class="card uploadlab" style="margin:5px 0;"><div class="card-body" style="height:auto"> ' +
               '<div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard('+ length +')>' +
               '<span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span></div>' +
               '<div class="row">' +
               '<div class="col-md-4">' +
               '<label class="form-label">Report Type<a style="text-decoration: none;color:red">*</a></label><select required name="report_type[]" id="report_type_'+ length +'" class="form-control" >' +
               '</select> </div>' +
               '<div class="col-md-4">' +
               '<label class="form-label">Value<a style="text-decoration: none;color:red">*</a></label>' +
               '<input class="form-control" required type="number" id="value_'+ length +'" name="value[]"> </div>' +
               '<div class="col-md-4">' +
               '<label class="form-label">Benchmark Value</label>' +
               '<input class="form-control" type="text" id="comments_'+ length +'" name="comments[]" /> </div>' +
               '</div> </div>'
           $('#upload_div').append(script);
            $.ajax({
               url:"{{ route('getUpload') }}",
               type: "GET",
               contentType: false,
               cache: false,
               processData: false,
               success:function (data) {
                   $(`#report_type_${length}`).append('<option value="">--Select any one --</option>');
                   $.each(data,function(index,value){
                       for(let k in value) {
                            $(`#report_type_${length}`).append('<option value="'+k+'">'+value[k]+'</option>');
                       }
                   })
               }
           });
           $(`#report_type_${length}`).trigger('focus');
        });
    });

     function deleteCard(value,id){
        if(id) {
            $(`#delete_ids`).append(`<input type="hidden" style="display:none" name="delete[]" value="${id}" /> `);
        }
        $(`#uploadlab_inputs_${value}`).remove();
    }
      
</script>