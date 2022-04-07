<div class="col-md-12">
    <div class="card p-2">
        <h4 class="cart-title">
            <a class="back_btn_css" @if(isset($_SERVER['HTTP_REFERER'])) href="<?php echo $_SERVER['HTTP_REFERER'] ?>" @endif><i data-feather='arrow-left'></i></a> 
            Lein Wallet
        </h4>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="alert alert-success mt-1 alert-validation-msg" role="alert">
                            <div class="alert-body d-flex align-items-center">
                              <span>Lein Wallet balance - <span><i class="fas fa-rupee-sign"></i> {{get_lein_wallet_bal()}}</span></span>
                            </div>
                          </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ url('leinwallet_to_main_form') }}" method="post" onsubmit="validbtn()">
                            @csrf
                            <div class="mb-1">
                                <label for="">Enter amount</label>
                            <input type="number" class="form-control" required name="lein_amount" id="">
                            </div>
                            <div class="mb-2">
                                <button type="submit" id="submit_btn" class="btn btn-success">Send to Wallet</button>
                        <button style="display: none;" id="wait_btn" type="button" class="btn btn-success">Please Wait</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>