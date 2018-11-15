<?php if(isset($value) && count($subSubCat>0)): ?>    

  <div class="form-group role_select" >
    <label class="control-label col-sm-3">Select Third Level Category * </label>
    <div class="col-sm-9">
      <?php echo e(Form::select('fk_sub_sub_category_id',$subSubCat,'',['class'=>'chosen-select-no-results_sub','id'=>'sub_sub_category','placeholder'=>'Select Third Level Category'])); ?>

    </div>
  </div>

<?php endif; ?>

<script src="<?php echo e(asset('public/backend/js/jquery.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('public/backend/js/chosen.jquery.js')); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(".chosen-select-no-results_sub").chosen({width:"100%"});  
    $('#sub_sub_category').change(function(){
                var value = this.value;
                $('#attributes').load("<?php echo e(URL::to('item/create')); ?>"+'?sub_sub='+value);
            })
  </script>