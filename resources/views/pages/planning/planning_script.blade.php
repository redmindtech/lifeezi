<script>
    $( document ).ready(function() {
   $('#plantype').on('click',function (){
          let length = $('.plantype').length;
          let script = '<div id="plantype_inputs_'+ length +'" class="card plantype" style="margin:5px 0;"><div class="card-body" style="height:auto;"> ' +
               '<div style="position:absolute;right:-5px;top:-13px;cursor:pointer;" onclick=deleteCard('+ length +')>' +
               '<span style="background:red;width:17px;height: 17px; border-radius: 15px; box-shadow: 2px -2px 15px #999;z-index:2;padding:3px 7px;"><i class="fa-solid fa-xmark"></i></span></div>' +
               '<div class="row">' +
               '<div class="col-md-4">' +
               '<label class="form-label">Meal Category<a style="text-decoration: none;color:red">*</a></label><select required name="meal_category[]" id="select_meal_category_'+ length +'" class="form-control" >' +
               '</select> </div>' +
               '<div class="col-md-4"><label class="form-label">Food Details<a style="text-decoration: none;color:red">*</a></label><input type="text" required class="form-control" name="food_details[]" /></div><div class="col-md-4"><label class="form-label">Meal Time<a style="text-decoration: none;color:red">*</a></label><input type="time" required class="form-control" name="meal_time[]" /></div></div>' +
               '</div> </div>'
           $('#planning_div').append(script);
            $.ajax({
               url:"{{ route('getPlanningMeal') }}",
               type: "GET",
               contentType: false,
               cache: false,
               processData: false,
               success:function (data) {
                   $(`#select_meal_category_${length}`).append('<option value="">--Select any one --</option>');
                   $.each(data,function(index,value){
                       for(let k in value) {
                            $(`#select_meal_category_${length}`).append('<option value="'+value[k]+'">'+value[k]+'</option>');
                       }
                   })
               }
           });
           $(`#select_meal_category_${length}`).select2({
             tags:true
           });
           $(`#select_meal_category_${length}`).trigger('focus');
        });
    });

     function deleteCard(value,id){
        if(id) {
            $(`#delete_ids`).append(`<input type="hidden" style="display:none" name="delete[]" value="${id}" /> `);
        }
        $(`#plantype_inputs_${value}`).remove();
    }
      
</script>