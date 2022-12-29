<script>
    $( document ).ready(function() {
   $('#observation').on('click',function (){
          let length = $('.observation').length;
          let script = '<div id="observation_inputs_'+ length +'" class="card observation" style="margin:5px 0;"><div class="card-body" style="height:auto;"> ' +
               '<div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard('+ length +')>' +
               '<span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span></div>' +
               '<div class="row">' +
               '<div class="col-md-6">' +
               '<label class="form-label">Meal Type<a style="text-decoration: none;color:red">*</a></label><select required name="meal_type[]" id="select_meal_type_'+ length +'" class="form-control" >' +
               '</select> </div>' +
               '<div class="col-md-6">' +
               '<label class="form-label">Meal Time<a style="text-decoration: none;color:red">*</a></label>' +
               '<input class="form-control" required type="time" id="meal_time_'+ length +'" name="meal_time[]"> </div></div>' +
               '<div class="row"><div class="col-md-6"><label class="form-label">Meal<a style="text-decoration: none;color:red">*</a></label><input type="text" class="form-control" name="meal[]" /></div>' +
               '<div class="col-md-6">' +
               '<label class="form-label">Comments</label>' +
               '<input type="text" class="form-control" type="text" id="comments_'+ length +'" name="comments[]"/> </div>' +
               '</div> </div>'
           $('#observation_div').append(script);
            $.ajax({
               url:"{{ route('getMeals') }}",
               type: "GET",
               contentType: false,
               cache: false,
               processData: false,
               success:function (data) {
                   $(`#select_meal_type_${length}`).append('<option value="">--Select any one --</option>');
                   $.each(data,function(index,value){
                       for(let k in value) {
                            $(`#select_meal_type_${length}`).append('<option value="'+k+'">'+value[k]+'</option>');
                       }
                   })
               }
           });
           $(`#select_meal_type_${length}`).trigger('focus');
        });
    });

     function deleteCard(value,id){
        if(id) {
            $(`#delete_ids`).append(`<input type="hidden" style="display:none" name="delete[]" value="${id}" /> `);
        }
        $(`#observation_inputs_${value}`).remove();
    }
      
</script>