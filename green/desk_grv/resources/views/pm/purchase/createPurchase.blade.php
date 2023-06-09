@extends('layouts.app')
@section('content')
<div class="page_level">
    <div class="page_show">
        <div class="page_title" id="page_title">
            <span class="page_title_span">款項管理</span>
            <i class="fas fa-chevron-right page_title_arrow"></i>
            <a  href="/purchase" class="page_title_a" >採購單</a>
            <i class="fas fa-chevron-right page_title_arrow"></i>
            <span class="page_title_span">建立採購</span>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow rounded-pill">
            <div class="card-body">
                <div class="col-lg-12">
                    <form name="invoiceForm" action="create/review" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="id">採購單號</label>
                                <input autocomplete="off" type="text" id="id" name="id" class="rounded-pill form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" value="{{$id}}" required readOnly>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="title">採購項目</label>
                                <input autocomplete="off" type="title" id="title" name="title" class="rounded-pill form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title') }}" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="applicant">採購人</label>
                                <input autocomplete="off" type="text" id="applicant" name="applicant" class="rounded-pill form-control{{ $errors->has('applicant') ? ' is-invalid' : '' }}" value="{{\Auth::user()->name}}" required>
                                @if ($errors->has('applicant'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('applicant') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group" id="company_select">
                                <label class="label-style col-form-label" for="project_id">{{__('customize.Project')}}</label>
                                <select type="text" id="project_id" name="project_id" class="rounded-pill form-control" onchange="select(this.options[this.options.selectedIndex].value)" required>
                                    <optgroup label="綠雷德創新">
                                        @foreach($grv2 as $gr)
                                        @if($gr['name']!='其他')
                                        <option value="{{$gr['project_id']}}">{{$gr->name}}</option>
                                        @endif

                                        @endforeach
                                    </optgroup>

                                    <optgroup label="綠雷德(舊)">
                                        @foreach($grv as $gr)
                                        @if($gr['name']!='其他')
                                        <option value="{{$gr['project_id']}}">{{$gr->name}}</option>
                                        @endif

                                        @endforeach
                                    </optgroup>
                                    <optgroup label="閱野">
                                        @foreach($rv as $r)
                                        <option value="{{$r['project_id']}}">{{$r->name}}</option>
                                        @endforeach
                                    </optgroup>
                                    <!-- @foreach ($projects as $project)

                                    @if($project['name']!='其他')
                                    <option value="{{$project['project_id']}}">{{$project['name']}}</option>
                                    @endif
                                    @endforeach -->
                                    <optgroup label="其他">
                                        <option value="qs8dXg66gPm">綠雷德-其他</option>
                                        <option value="qs8dXg77gPm">閱野-其他</option>
                                        <option value="qs8dXg88gPm">綠雷德(舊)-其他</option>
                                        <option value="qs8dXg99gPm">州道-其他</option>
                                    </optgroup>
                                </select>
                            </div>
                            <div id="type_group" class="col-lg-3 form-group" style="display: none">
                                <label class="label-style col-form-label" for="type">類型</label>
                                    <select type="text" id="type" name="type" class="form-control rounded-pill" onchange="checkPrice()" required>
                                        <option value="salary">薪資-工讀生/農博駐場</option>
                                        <option value="rent">房租-北科/利多萊</option>
                                        <option value="insurance">勞健保/勞退</option>
                                        <option value="accounting">會計師記帳費</option>
                                        <option value="cash">每月零用金</option>
                                        <option value="tax">公司營業稅</option>
                                        <option value="other">其他</option>
                                    </select>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="purchase_date">採購日期</label>
                                <input type="date" id="purchase_date" name="purchase_date" class="rounded-pill form-control{{ $errors->has('purchase_date') ? ' is-invalid' : '' }}" value="{{ old('purchase_date') }}" required>
                                @if ($errors->has('purchase_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('purchase_date') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="company">廠商名稱</label>
                                <input autocomplete="off" type="text" id="company1" name="company1" class="rounded-pill form-control{{ $errors->has('company1') ? ' is-invalid' : '' }}" value="{{ old('company1') }}" required>
                                @if ($errors->has('company'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="delivery_date">交貨日期</label>
                                <input type="date" id="delivery_date" name="delivery_date" class="rounded-pill form-control{{ $errors->has('delivery_date') ? ' is-invalid' : '' }}" value="{{ old('delivery_date') }}" required>
                                @if ($errors->has('delivery_date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('delivery_date') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="contact_person">聯絡人</label>
                                <input autocomplete="off" type="text" id="contact_person" name="contact_person" class="rounded-pill form-control{{ $errors->has('contact_person') ? ' is-invalid' : '' }}" value="{{ old('contact_person') }}" required>
                                @if ($errors->has('contact_person'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('contact_person') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="address">送貨地址</label>
                                <input autocomplete="off" type="text" id="address" name="address" class="rounded-pill form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" required>
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <div class=" form-group">
                                    <label class="label-style col-form-label" for="phone">電話 </label>
                                    <input autocomplete="off" type="text" id="phone" name="phone" class="rounded-pill form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" value="{{ old('phone') }}" required>
                                    @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>請照範例填寫</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>

                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="fax">傳真</label>
                                <input autocomplete="off" type="text" id="fax" name="fax" class="rounded-pill form-control{{ $errors->has('fax') ? ' is-invalid' : '' }}" value="{{ old('fax') }}">
                                @if ($errors->has('fax'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>請照範例填寫</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-6 form-group">
                                <label class="label-style col-form-label" for="note">備註(50字以內)</label>
                                <textarea id="note" name="note" rows="5" style="resize:none;" class="rounded-pill form-control{{ $errors->has('note') ? ' is-invalid' : '' }}">{{ old('note') }}</textarea>
                                @if ($errors->has('note'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>超出50個字</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-lg-12 form-group">
                                <table id="Itemtable" width="100%">
                                    <thead>
                                        <tr class="bg-dark text-white" style="text-align:center">
                                            <!-- <th class="px-2" width="5%"> -->
                                            <!-- <button type="button" onclick="addElementDiv('addItem')">+</button> -->
                                            <!-- </th> -->
                                            <th class="px-2" width="5%">
                                            <th class="px-2" width="30%"><label class="label-style col-form-label" for="content">品名</label></th>
                                            <th class="px-2" width="10%"><label class="label-style col-form-label" for="quantity">數量</label></th>
                                            <th class="px-2" width="10%"><label class="label-style col-form-label" for="price">單價</label></th>
                                            <th class="px-2" width="15%"><label class="label-style col-form-label" for="amount">單項總價</label></th>
                                            <th class="px-2" width="25%"><label class="label-style col-form-label" for="note">備註</label></th>
                                        </tr>
                                    </thead>

                                </table>

                            </div>
                            <div class="col-lg-3 form-group d-flex justify-content-center align-items-center">
                                <div class="form-check" id="check">
                                    <label class="label-style col-form-label" for="amount">稅率選擇</label>
                                    <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                        <label class="btn btn-secondary active w-33" style="border-top-left-radius: 25px;border-bottom-left-radius: 25px">
                                            <input type="radio" name="options"  onchange="texTypeFunction(0)" autocomplete="off" checked> 未含稅
                                        </label>
                                        <label class="btn btn-secondary">
                                            <input type="radio" name="options"  onchange="texTypeFunction(1)" autocomplete="off"> 已含稅
                                        </label>
                                        <label class="btn btn-secondary w-33" style="border-top-right-radius: 25px;border-bottom-right-radius: 25px">
                                            <input type="radio" name="options"  onchange="texTypeFunction(2)" autocomplete="off"> 零%稅
                                        </label>
                                    </div>
                                    <!--<input class="form-check-input" type="checkbox" value="" id="texCheck" onclick="calculation()">
                                    <label class="form-check-label" for="texCheck">
                                        未稅
                                    </label>-->
                                </div>
                            </div>
                            <div class="col-lg-3 form-group">
                                <label class="label-style col-form-label" for="amount">金額</label>
                                <input autocomplete="off" type="text" id="amount" name="amount" class="rounded-pill form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount') }}" readonly>

                            </div>
                            <div class="col-lg-3 form-group">
                                <label class="label-style col-form-label" for="tex">稅金</label>
                                <input autocomplete="off" type="text" id="tex" name="tex" class="rounded-pill form-control{{ $errors->has('tex') ? ' is-invalid' : '' }}" value="{{ old('tex') }}" readonly>

                            </div>
                            <div class="col-lg-3 form-group">
                                <label class="label-style col-form-label" for="total_amount">總金額</label>
                                <input autocomplete="off" type="text" id="total_amount" name="total_amount" class="rounded-pill form-control{{ $errors->has('total_amount') ? ' is-invalid' : '' }}" value="{{ old('total_amount') }}" readonly>
                                <input autocomplete="off" type="text" id="item_total_num" name="item_total_num" class="rounded-pill form-control{{ $errors->has('item_total_num') ? ' is-invalid' : '' }}" value=9 readonly hidden>
                            </div>

                        </div>
                        <div class="md-5" style="float: right;" >
                            <button type="submit" class="btn btn-green rounded-pill"><span class="mx-2">{{__('customize.Add')}}</span></button>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@stop
@section('script')
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script>
    function select(val){
        var company_select = document.getElementById('company_select');
        if(val =="qs8dXg88gPm" || val =="qs8dXg77gPm" || val =="qs8dXg66gPm"){
            document.getElementById('type_group').style.display = 'block'
            company_select.classList.remove('col-lg-6')
            company_select.classList.add('col-lg-3')
        }
        else{
            document.getElementById('type_group').style.display = 'none'
            company_select.classList.remove('col-lg-3')
            company_select.classList.add('col-lg-6')
        }
    }
</script>
<script>
    var item_num = 9;
    var texType = 'untexed'
    $(document).ready(function() {
        var amount = document.getElementById('amount')
        var tex = document.getElementById('tex')
        var total_amount = document.getElementById('total_amount')
        list_table()
        calculation()

    });



    function list_table(){
        var parent = document.getElementById('Itemtable');
        var body = document.createElement("tbody");
        body.setAttribute("id","Itembody");
        for(var i = 0;i<10;i++ ){
            if(i != 9){
                body.innerHTML = body.innerHTML + '<tr>' +
                    '<th class="p-2">' +
                    '<th class="p-2"><input autocomplete="off" type="text" id="content-' + i + '" name="content-'+ i + '" class="rounded-pill form-control{{ $errors->has("content-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("content-'+ i +'") }}"></th>' +
                    '<th class="p-2"><input oninput="value=value.replace(/[^\d]/g,"")" onkeyup="calculation()" autocomplete="off" type="text" id="quantity-'+ i + '" name="quantity-'+ i +'" class="rounded-pill form-control{{ $errors->has("quantity-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("quantity-'+ i +'") }}"></th>' +
                    '<th class="p-2"><input oninput="value=value.replace(/[^\d\.]/g,"")" onkeyup="calculation()" autocomplete="off" type="text" id="price-'+ i +'" name="price-'+ i +'" class="rounded-pill form-control{{ $errors->has("price-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("price-'+ i +'") }}"></th>' +
                    '<th class="p-2"><input autocomplete="off" type="text" id="amount-'+ i +'" name="amount-'+ i +'" class="rounded-pill form-control{{ $errors->has("amount-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("amount-'+ i +'") }}" readonly></th>' +
                    '<th class="p-2"><input autocomplete="off" type="text" id="note-'+ i +'" name="note-'+ i +'" class="rounded-pill form-control{{ $errors->has("note-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("note-'+ i +'") }}"></th>' +
                    '</tr>'
            }
            else{
                body.innerHTML = body.innerHTML + '<tr>' +
                    '<th class="p-2"><button id="addItemButton" type="button" onclick="additem()" class="w-100 btn btn-green rounded-pill">+</button>' +
                    '<th class="p-2"><input autocomplete="off" type="text" id="content-' + i + '" name="content-'+ i + '" class="rounded-pill form-control{{ $errors->has("content-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("content-'+ i +'") }}"></th>' +
                    '<th class="p-2"><input oninput="value=value.replace(/[^\d]/g,"")" onkeyup="calculation()" autocomplete="off" type="text" id="quantity-'+ i + '" name="quantity-'+ i +'" class="rounded-pill form-control{{ $errors->has("quantity-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("quantity-'+ i +'") }}"></th>' +
                    '<th class="p-2"><input oninput="value=value.replace(/[^\d\.]/g,"")" onkeyup="calculation()" autocomplete="off" type="text" id="price-'+ i +'" name="price-'+ i +'" class="rounded-pill form-control{{ $errors->has("price-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("price-'+ i +'") }}"></th>' +
                    '<th class="p-2"><input autocomplete="off" type="text" id="amount-'+ i +'" name="amount-'+ i +'" class="rounded-pill form-control{{ $errors->has("amount-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("amount-'+ i +'") }}" readonly></th>' +
                    '<th class="p-2"><input autocomplete="off" type="text" id="note-'+ i +'" name="note-'+ i +'" class="rounded-pill form-control{{ $errors->has("note-'+ i +'") ? " is-invalid" : "" }}" value="{{ old("note-'+ i +'") }}"></th>' +
                    '</tr>'
            }

        }
        parent.appendChild(body);
    }

    function additem(){
        var parent = document.getElementById('Itembody');
        var tr = document.createElement('tr');
        $("#addItemButton").remove();
        item_num = item_num + 1;
        document.getElementById("item_total_num").value = item_num;
        tr.innerHTML = '<tr>' +
            '<th class="p-2"><button id="addItemButton" type="button" onclick="additem()" class="w-100 btn btn-green rounded-pill">+</button>' +
            '<th class="p-2"><input autocomplete="off" type="text" id="content-' + item_num + '" name="content-'+ item_num + '" class="rounded-pill form-control{{ $errors->has("content-'+ item_num +'") ? " is-invalid" : "" }}" value="{{ old("content-'+ item_num +'") }}"></th>' +
            '<th class="p-2"><input oninput="value=value.replace(/[^\d]/g,"")" onkeyup="calculation()" autocomplete="off" type="text" id="quantity-'+ item_num + '" name="quantity-'+ item_num +'" class="rounded-pill form-control{{ $errors->has("quantity-'+ item_num +'") ? " is-invalid" : "" }}" value="{{ old("quantity-'+ item_num +'") }}"></th>' +
            '<th class="p-2"><input oninput="value=value.replace(/[^\d\.]/g,"")" onkeyup="calculation()" autocomplete="off" type="text" id="price-'+ item_num +'" name="price-'+ item_num +'" class="rounded-pill form-control{{ $errors->has("price-'+ item_num +'") ? " is-invalid" : "" }}" value="{{ old("price-'+ item_num +'") }}"></th>' +
            '<th class="p-2"><input autocomplete="off" type="text" id="amount-'+ item_num +'" name="amount-'+ item_num +'" class="rounded-pill form-control{{ $errors->has("amount-'+ item_num +'") ? " is-invalid" : "" }}" value="{{ old("amount-'+ item_num +'") }}" readonly></th>' +
            '<th class="p-2"><input autocomplete="off" type="text" id="note-'+ item_num +'" name="note-'+ item_num +'" class="rounded-pill form-control{{ $errors->has("note-'+ item_num +'") ? " is-invalid" : "" }}" value="{{ old("note-'+ item_num +'") }}"></th>' +
            '</tr>'
        parent.appendChild(tr);
        calculation()
    }

    /*function addElementDiv(obj) {
        $i++;
        console.log($i)
        var parent = document.getElementById(obj);
        //新增 div
        var div = document.createElement("tr");
        //設定 div 屬性，如 id

        div.innerHTML = '<th class="p-2"></th>' +
            '<th class="p-2"><input autocomplete="off" type="text" id="content-' + $i + '" name="content-' + $i + '" class="rounded-pill form-control{{ $errors->has("content") ? " is-invalid" : "" }}" value="{{ old("content") }}"></th>' +
            '<th class="p-2"><input autocomplete="off" type="text" id="quantity-' + $i + '" name="quantity-' + $i + '" class="rounded-pill form-control{{ $errors->has("quantity") ? " is-invalid" : "" }}" value="{{ old("quantity") }}"></th>' +
            '<th class="p-2"><input autocomplete="off" type="text" id="price-' + $i + '" name="price-' + $i + '" class="rounded-pill form-control{{ $errors->has("price") ? " is-invalid" : "" }}" value="{{ old("price") }}"></th>' +
            '<th class="p-2"><input autocomplete="off" type="text" id="note-' + $i + '" name="note-' + $i + '" class="rounded-pill form-control{{ $errors->has("note") ? " is-invalid" : "" }}" value="{{ old("note") }}"></th>'
        parent.appendChild(div);
    }*/

    function sum() {
        var quantity, price, sum = 0
        for (var i = 0; i < item_num+1; i++) {
            quantity = document.getElementById('quantity-' + i).value
            price = document.getElementById('price-' + i).value
            amount_one = document.getElementById('amount-' + i)
            amount_one.value = Math.round(quantity * price * 100)/100
            console.log(amount_one)
            sum = sum + quantity * price
        }
        return sum
    }

    function texTypeFunction(val){
        if(val == 0){
            texType = 'untexed'
        }else if(val == 1){
            texType = 'texed'
        }else if(val == 2){
            texType = 'zerotexed'
        }
        calculation()
    }

    function calculation() {
        console.log(texType)
        if (texType == 'untexed') {

            amount.value = Math.round(sum() * 100)/100
            tex.value = Math.ceil(amount.value * 0.05)
            total_amount.value = Math.round(sum()) + Number(tex.value)
        }
        else if(texType == 'texed'){
            total_amount.value = sum()
            amount.value = Math.round((total_amount.value/1.05))
            tex.value = total_amount.value - amount.value
        }else if(texType == 'zerotexed'){
            total_amount.value = sum()
            amount.value = total_amount.value
            tex.value = 0
        }
    }
</script>
<script src="{{ URL::asset('js/grv.js') }}"></script>
@stop
