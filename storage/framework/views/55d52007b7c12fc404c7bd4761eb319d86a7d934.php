<?php $__env->startSection('content'); ?>
<? if(Session::has('commonData')){
    $commonData=Session::get('commonData');
    $currency_symbol=$commonData['primaryInfo']->currency_symbol;
    $info=$commonData['primaryInfo'];
    } ?>



<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="<?php echo e(URL::to('/')); ?>">Home</a></li>
				<li class='active'>Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-12">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
<div class="panel panel-default checkout-step-01">

	<!-- panel-heading -->
		<div class="panel-heading">
    	<h4 class="unicase-checkout-title">
	        <a data-toggle="collapse1" class="" data-parent="#accordion" href="">
	          <span>1</span>Checkout Method
	        </a>
	     </h4>
    </div>
    <!-- panel-heading -->

<?php if(Auth::check()!=true): ?>
	<div id="collapseOne" class="panel-collapse collapse in">

		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		

				<!-- guest-login -->			
				<div class="col-md-6 col-sm-6 chackout_login guest-login custom_login">
					<h4 class="checkout-subtitle text-center">LOG INTO YOUR ACCOUNT</h4>
					

					<!-- radio-form  -->
					 <form class="form-horizontal login_form" action="<?php echo e(url('/login')); ?>" method="POST">
                <?php echo e(csrf_field()); ?>

                  <div  class="form-group login_input <?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                    <label class="sr-only" for="email">Email</label>
                    <div class="input-group col-md-8">
                      <div class="input-group-addon"><i class="fa fa-user"></i></div>
                      <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
                  <br>
                  <br>
                  <div class="form-group login_input <?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                    <label class="sr-only" for="password">Password</label>
                    <div class="input-group col-md-8">
                      <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                      <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    </div>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                  </div>
                  <br>
                  <br>
                  <div class="ft-link-p">
                        <a href="<?php echo e(url('/reset-password')); ?>" title="Forgot your password">Forgot your password?</a>
                    </div>
                    <br>
                    <div style="margin-bottom: 10px" class="col-md-8 col-md-offset-4">
                    <button  type="submit" class="text-center btn-upper btn btn-primary checkout-page-button checkout-continue ">Login</button>
                    </div>

                </form>
					<!-- radio-form  -->

					

					
				</div>
				<!-- guest-login -->

				<!-- already-registered-login -->
				<div class="col-md-6 col-sm-6 already-registered-login chackout_login custom_login form.login_form">
					<h4 class="checkout-subtitle text-center">REGISTRATION FOR NEW ACCOUNT</h4>
					
					 <form class="form-horizontal signup_form" role="form" method="POST" action="<?php echo e(url('/register')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('name') ? ' has-error' : ''); ?>">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required autofocus>

                                <?php if($errors->has('name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?>">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                         <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?>">
                            <label for="password-confirm" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-8">
                                <input id="phone" type="number" class="form-control" name="phone" required>

                                <?php if($errors->has('phone')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-info">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
				</div>	
				<!-- already-registered-login -->		

			</div>			
		</div>
		<!-- panel-body  -->

	</div>
	<!-- row -->


 <?php else: ?>
 <h2 class="text-center">Shipping Information Here</h2>
 <hr>


     <div class="row"> 
<?php echo Form::open(array('url' => 'checkout','method'=>'POST')); ?>

<?php if($userInfo!=null): ?>
<div class="col-md-6">
    
 <div class="user_info">
        <p>Address: <?php echo e($userInfo->address); ?></p>
        <p>Region: <?php echo e($userInfo->region); ?></p>
        <p>Country: <?php echo e($userInfo->country); ?></p>
        <input type="hidden" name="country" value="<?php echo e($userInfo->country); ?>">
        <input type="hidden" name="region" value="<?php echo e($userInfo->region); ?>">
        <input type="hidden" name="address" value="<?php echo e($userInfo->address); ?>">
    </div>
    <div  class="load_info">
        <label class="col-md-12">
            <input type="radio" name="is_shipping" value="1" class="different" id="show_form" checked> Use as Shipping address 
        </label>
        <label class="col-md-12">
                <input type="radio" name="is_shipping" value="2" class="different"> Use Different Shipping address
        </label>
    </div>
    <div id="loadShippingAddress"> </div>
</div>
 <?php endif; ?>
        

	 		
                                

                             <?php if($userInfo==null): ?>
                             <div class="col-md-6 no-padding">
                                 <div class="form-group col-md-6"> 
                                    <p>Country<span>*</span></p>
                                    <input value="" class="form-control" name="country" type="text" placeholder="Country" required>
                                </div>
                                <div class="form-group col-md-6">    
                                    <p>Region<span>*</span></p>
                                    <input value="" class="form-control" name="region" type="text" placeholder="Region" required>
                                </div>

                                 <div class="form-group col-md-12"> 
                                    <label class="col-md-12">Address<span>*</span></label>
                                    <textarea value="" class="form-control" name="address" placeholder="Address" rows="2" required></textarea>
                                </div>
                             </div>
                                <?php endif; ?>
                            <div class="col-md-6">
                                
                                

                                   <div class="form-group col-md-12"> 
                                    <label> Select your shipping: </label>
                                        <div class="checkbox">
                                            <label for="doorstep"><input type="radio" name="delivery" value="1" class="delivery" id="doorstep" checked> Delivered in 2 - 5 days at your doorstep(Around Dhaka) for TK:<?php echo e($commonData['primaryInfo']->doorstep); ?>. </label><br>
                                             <label for="pickup"><input type="radio" name="delivery" value="2" class="delivery" id="pickup"> Delivered in 3 - 10 days at nearby pick-up station for TK: <?php echo e($commonData['primaryInfo']->pick_up_station); ?>.</label>
                                            <br>
                                        </div>
                                </div>
                                <? $finalAmount=$commonData['primaryInfo']->doorstep+(floatval(str_replace(',','', Cart::total()))); ?>
                                <div class="form-group col-md-6"> 
                                    <p>Payment Method<span>*</span></p>
                                    <select class="form-control" name="payment_method" onchange="loadBkash(this.value)" required>
                                        <option value="Cash on Delivery">Cash on Delivery</option>
                                        <option value="Bkash">Bkash</option>
                                    </select>
                                </div>
                                <div id="trxID" style="display: none;">
                                     <div class="form-group col-md-12"> 
                                            <p><?php echo e($currency_symbol); ?> <span id="finalAmounts"><?php echo e($finalAmount); ?></span> send to here <b><?php echo e($info->bkash_no); ?></b> . Its a personal account.
                                            <a class="btn btn-link" data-toggle="modal" data-target="#myModal" href="#myModal">Instruction</a>
                                                </p>
                                                <!-- Modal -->
                                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="myModalLabel">Payment with bkash instruction</h4>
                                                      </div>
                                                      <div class="modal-body">
                                                        <p>01. Go to your bKash Mobile Menu by dialing *247#<br>02. Choose “Send Money”<br>03. Enter the bKash Account Number you want to send money to<br>04. Enter the amount you want to send<br>05. Enter a reference about the transaction. (Do not use more than one word, avoid space or special characters)<br>06. Now enter your bKash Mobile Menu PIN to confirm the transaction</p><p>Done! You and the Receiver both will receive a confirmation message from bKash.</p>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <span>BKash trxID</span>
                                                <input type="text" class="form-control" name="ref_id" placeholder="trxID" id="trxidInput" min="0">
                                            </div>
                                        </div>

                            
                            </div>
                             <div class="form-group col-md-12">
                            
                            <p><b>Total Amount with delivery charge : <?php echo e($currency_symbol); ?> <span id="finalAmount"><?php echo e($finalAmount); ?></span></b></p>
                            <input type="hidden" name="total_amount" id="inputFinalAmount" value="<?php echo e($finalAmount); ?>">
                                <button type="submit" class="checkout-button btn-primary">Place Order</button> 
                            
                            </div>
	 		<?php echo Form::close(); ?>

	 	 							
	 </div>

	 


  <?php endif; ?> 
</div>

					  	
					</div>
				</div>
				
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
			</div><!-- /.container -->
</div><!-- /.body-content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
 <script type='text/javascript'>
    function loadBkash(id){
        if(id=='Bkash'){
            $('#trxID').css('display','block');
            $('#trxidInput').attr('required','required');
        }else{
            $('#trxID').css('display','none');
            $('#trxidInput').removeAttr('required');
        }
    }
    $(".different").on('change',function(){
            var val=$(this).val();
            $("#loadShippingAddress").load('<?php echo e(URL::to("shippingAddress")); ?>/'+val);
            
        });
    $("#show_form").on('change',function(){
            
            
            $("#reg_form").css('display','none');
        });

</script>

<script type="text/javascript">
    $('.delivery').on('change',function(){
        var finalAmount;
        var thisValue=this.value;
        if(thisValue!=2){
            finalAmount=<?php echo e($commonData['primaryInfo']->doorstep+(floatval(str_replace(',','', Cart::total())))); ?>;
        }else{
            finalAmount=<?php echo e($commonData['primaryInfo']->pick_up_station+(floatval(str_replace(',','', Cart::total())))); ?>;

        }
        $('#finalAmount').html(finalAmount);
        $('#finalAmounts').html(finalAmount);
        $('#inputFinalAmount').val(finalAmount);
    });
</script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>