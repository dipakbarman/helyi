@extends('backend.master')
@section('body')
<div class="row">
    <form method="post" action="{{url('order')}}">
        @csrf
        <input type="hidden" name="price" value="1199">
        <input type="hidden" name="amount" value="999">
        <input type="hidden" name="user_id" value="1">
        <input type="hidden" name="email" value="a@g.v">
        <input type="hidden" name="phone" value="7719132119">
        <input type="hidden" name="name" value="amit">
        <input type="hidden" name="currency" value="INR">
<input type="submit" value="complete order">
</form>
</div>
<script>
    $(documnet).ready(function()
{
  $('#order').on('click', function(){
    var price = $('#price').val();
    var amount = $('#amount').val();
    var currency = $('#currency').val();
    var product_id=$('#product_id').val();
    $.ajax({
             type:'POST',
             url:'/order',
             data:{
               '_token = ',
               price:price,
               amount:amount,
               currency:currency,
               product_id:product_id,
             }
             success:function(data) {
                $(".payment").appent(data);
                ('.redirectForm').submit();
             }
          });
  });

});
</script>
@endsection