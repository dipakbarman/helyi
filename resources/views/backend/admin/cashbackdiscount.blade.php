@extends('backend.master')
@section('body')
<form action="{{ url('cashbackdiscount_form') }}" method="post">
    @csrf
<div class="row">
    @if($count < 1)
    <div class="col-md-6">
        <div class="card p-1">
            <h4 class="card-title">
                Distibutor 
            </h4>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-check form-switch form-check-success">
                
                        <input type="checkbox" class="form-check-input"   name="d_status" id="distibutor"  />
                        <label class="form-check-label" for="distibutor">
                          <span class="switch-icon-left"><i data-feather="check"></i></span>
                          <span class="switch-icon-right"><i data-feather="x"></i></span>
                        </label>
                      </div>
                </div>
                <div class="col-md-4">
                    <label for="">From Date</label>
                    <input type="text" name="d_from_date" required id="from_date" class="form-control flatpickr-basic">
                </div>
                <div class="col-md-4">
                    <label for="">To Date</label>
                    <input type="text" name="d_to_date" required id="to_date" class="form-control flatpickr-basic">
                </div>
                @for ($i = 0; $i < 10; $i++)
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Target Price</label>
                            <input type="number" name="target[]" value="" class="form-control" required>                            
                        </div>
                        <div class="col-md-4">
                            <label for="">Flat</label>
                            <input type="number" name="flat[]" value="" class="form-control" >                            
                        </div>
                        <div class="col-md-4">
                            <label for="">Percentage</label>
                            <input type="number" name="per[]" value="" class="form-control" >                            
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card p-1">
            <h4 class="card-title">
                Master Distibutor
            </h4>
            
            <div class="row">
            <div class="col-md-4">
                <div class="form-check form-switch form-check-success">
                    <input type="checkbox" class="form-check-input"  name="md_status" id="mdistibutor"  />
                    <label class="form-check-label" for="mdistibutor">
                      <span class="switch-icon-left"><i data-feather="check"></i></span>
                      <span class="switch-icon-right"><i data-feather="x"></i></span>
                    </label>
                  </div>
            </div>
            <div class="col-md-4">
                <label for="">From Date</label>
                <input type="text" name="m_from_date" required id="mfrom_date" class="form-control flatpickr-basic">
            </div>
            <div class="col-md-4">
                <label for="">To Date</label>
                <input type="text" name="m_to_date" required  id="mto_date" class="form-control flatpickr-basic">
            </div>
                @for ($j = 0; $j < 10; $j++)
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Target Price</label>
                            <input type="number" name="mtarget[]" value="" class="form-control" required>                            
                        </div>
                        <div class="col-md-4">
                            <label for="">Flat</label>
                            <input type="number" name="mflat[]" value="" class="form-control" >                            
                        </div>
                        <div class="col-md-4">
                            <label for="">Percentage</label>
                            <input type="number" name="mper[]" value="" class="form-control" >                            
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
        @else
        <div class="col-md-6">
            <div class="card p-1">
                <h4 class="card-title">
                    Distibutor
                </h4>
                @php
                        $d = DB::table('discountcashback')->where('utype',1)->get();
                    @endphp
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input"  @if($d[0]->status == 1) checked @endif name="d_status" id="distibutor" />
                            <label class="form-check-label" for="distibutor">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                          </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">From Date</label>
                        <input type="text" name="d_from_date" required value="{{ $d[0]->fd }}" id="from_date" class="form-control flatpickr-basic">
                    </div>
                    <div class="col-md-4">
                        <label for="">To Date</label>
                        <input type="text" name="d_to_date" required value="{{ $d[0]->td }}" id="to_date" class="form-control flatpickr-basic">
                    </div>
                    @foreach ($d as $item)
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Target Price</label>
                                <input type="number" name="target[]" value="{{$item->target_amount}}" class="form-control" required>                            
                            </div>
                            <div class="col-md-4">
                                <label for="">Flat</label>
                                <input type="number" name="flat[]" value="{{$item->flat}}" class="form-control" >                            
                            </div>
                            <div class="col-md-4">
                                <label for="">Percentage</label>
                                <input type="number" name="per[]" value="{{$item->discount}}" class="form-control" >                            
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-1">
                <h4 class="card-title">
                    Master Distibutor
                </h4>
                @php
                        $m_d = DB::table('discountcashback')->where('utype',2)->get();
                    @endphp
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check form-switch form-check-success">
                            <input type="checkbox" class="form-check-input" @if($m_d[0]->status == 1) checked @endif  name="md_status" id="mdistibutor" />
                            <label class="form-check-label" for="mdistibutor">
                              <span class="switch-icon-left"><i data-feather="check"></i></span>
                              <span class="switch-icon-right"><i data-feather="x"></i></span>
                            </label>
                          </div>
                    </div>
                    <div class="col-md-4">
                        <label for="">From Date</label>
                        <input type="text" name="m_from_date" required  value="{{ $m_d[0]->fd }}" id="mfrom_date" class="form-control flatpickr-basic">
                    </div>
                    <div class="col-md-4">
                        <label for="">To Date</label>
                        <input type="text" name="m_to_date" required value="{{ $m_d[0]->td }}" id="mto_date" class="form-control flatpickr-basic">
                    </div>
                    @foreach ($m_d as $item)
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Target Price</label>
                                <input type="number" name="mtarget[]" value="{{$item->target_amount}}" class="form-control" required>                            
                            </div>
                            <div class="col-md-4">
                                <label for="">Flat</label>
                                <input type="number" name="mflat[]" value="{{$item->flat}}" class="form-control" >                            
                            </div>
                            <div class="col-md-4">
                                <label for="">Percentage</label>
                                <input type="number" name="mper[]" value="{{$item->discount}}" class="form-control" >                            
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    
                </div>
            </div>
        @endif
    </div>
    <div class="col-md-12">
        <div class="card p-1">
            @if ($count > 1)
            <button type="submit" class="btn btn-success">Update</button>
            @else
            <button type="submit" class="btn btn-success">Submit</button>
            @endif
        </div>
    </div>
</div>
</form>

@endsection