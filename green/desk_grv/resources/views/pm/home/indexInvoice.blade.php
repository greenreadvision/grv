@extends('layouts.app')
@section('content')

<div class="col-lg-12 ">
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                    <label class="btn btn-secondary active w-50" style="border-top-left-radius: 25px;border-bottom-left-radius: 25px">
                        <input type="radio" name="options" onchange="changeInvoice(0)" autocomplete="off" checked> 專案
                    </label>
                    <label class="btn btn-secondary w-50" style="border-top-right-radius: 25px;border-bottom-right-radius: 25px">
                        <input type="radio" name="options" onchange="changeInvoice(1)" autocomplete="off"> 其他
                    </label>
                </div>
            </div>
            <div class="card border-0 shadow rounded-pill">
                <div class="card-body show-project-invoice">
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">戶名</label>
                        <div class="col-lg-12">
                            <input placeholder="搜尋" type="text" list="list-account" id="search-account" autocomplete="off" name="search-account" class="rounded-pill form-control" onchange="selectAccount(this.value)">
                            <datalist id="list-account">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">請款人</label>
                        <div class="col-lg-12">
                            <select type="text" id="select-user" name="select-user" onchange="select('user',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=""></option>
                                @foreach($users as $user)
                                <option value="{{$user['user_id']}}">{{$user['name']}}({{$user['nickname']}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">專案</label>
                        <div class="col-lg-12 mb-2">
                            <select type="text" id="select-project-year" name="select-project-year" onchange="selectProjectYears(this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=''></option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <select type="text" id="select-project" name="select-project" onchange="select('project',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=''></option>
                                <optgroup id="select-project-grv" label="綠雷德">
                                <optgroup id="select-project-rv" label="閱野">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">年份</label>
                        <div class="col-lg-12">
                            <select type="text" id="select-year" name="select-year" onchange="select('year',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=''></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">月份</label>
                        <div class="col-lg-12">
                            <select type="text" id="select-month" name="select-month" onchange="select('month',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=''></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <button class="w-100 btn btn-green rounded-pill" onclick="reset()"><span>重置</span> </button>
                    </div>
                </div>
                <div class="card-body show-other-invoice">
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">戶名</label>
                        <div class="col-lg-12">
                            <input placeholder="搜尋" type="text" list="list-other-account" id="search-other-account" autocomplete="off" name="search-other-account" class="rounded-pill form-control" onchange="selectOtherAccount(this.value)">
                            <datalist id="list-other-account">
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">請款人</label>
                        <div class="col-lg-12">
                            <select type="text" id="select-other-user" name="select-other-user" onchange="selectOther('user',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=""></option>
                                @foreach($users as $user)
                                <option value="{{$user['user_id']}}">{{$user['name']}}({{$user['nickname']}})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">類型</label>
                        <div class="col-lg-12 mb-2">
                            <select type="text" id="select-company" name="select-company" onchange="selectOther('company',this.options[this.options.selectedIndex].value)" class=" rounded-pill form-control">
                                <option value=''></option>
                                <option value='grv'>綠雷德</option>
                                <option value='rv'>閱野</option>
                            </select>
                        </div>
                        <div class="col-lg-12">
                            <select type="text" id="select-type" name="select-type" onchange="selectOther('type',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=''></option>
                                <option value='salary'>薪資</option>
                                <option value='insurance'>保險</option>
                                <option value='other'>其他</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label">年份</label>
                        <div class="col-lg-12">
                            <select type="text" id="select-other-year" name="select-other-year" onchange="selectOther('year',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=''></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-12 col-form-label ">月份</label>
                        <div class="col-lg-12">
                            <select type="text" id="select-other-month" name="select-other-month" onchange="selectOther('month',this.options[this.options.selectedIndex].value)" class="rounded-pill form-control">
                                <option value=''></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="w-100 btn btn-green rounded-pill" onclick="resetOther()"><span>重置</span> </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card border-0 shadow" style="min-height: calc(100vh - 135px)">
                <div class="card-body show-project-invoice">
                    <div class="form-group col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <input type="text" name="search-num" id="search-num" class="form-control  rounded-pill" placeholder="請款單號" autocomplete="off" onkeyup="searchNum()">
                            </div>
                            <div class=" col-lg-4">
                                <input type="text" name="search" id="search" class="form-control  rounded-pill" placeholder="請款事項" autocomplete="off" onkeyup="searchInvoice()">
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <button class="btn btn-green rounded-pill" onclick="location.href='{{route('invoice.create')}}'"><span class="mx-2">{{__('customize.Add')}}</span> </button>

                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 d-flex justify-content-between">
                        <div id="invoice-page" class="d-flex align-items-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fas fa-caret-left" style="width:14.4px"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true"><i class="fas fa-caret-right" style="width:14.4px"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <button class="btn btn-blue rounded-pill" onclick='tableToExcel()'><span class="mx-2">匯出 Excel</span></button>

                    </div>
                    <div class="col-lg-12 table-style-invoice ">
                        <table id="search-invoice">

                        </table>
                    </div>

                </div>
                <div class="card-body show-other-invoice">
                    <div class="form-group col-lg-12">
                        <div class="row">
                            <div class="col-lg-2">
                                <input type="text" name="search-other-num" id="search-other-num" class="form-control  rounded-pill" placeholder="請款單號" autocomplete="off" onkeyup="searchOtherNum()">
                            </div>
                            <div class=" col-lg-4">
                                <input type="text" name="search-other" id="search-other" class="rounded-pill form-control" placeholder="請款事項" autocomplete="off" onkeyup="searchOtherInvoice()">
                            </div>
                            <div class="col-lg-6 d-flex justify-content-end">
                                <button class="btn btn-green rounded-pill" onclick="location.href='{{route('invoice.create')}}'"><span>{{__('customize.Add')}}</span> </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 d-flex justify-content-between">
                        <div id="invoice-other-page" class="d-flex align-items-end">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination mb-0">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true"><i class="fas fa-caret-left" style="width:14.4px"></i></span>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true"><i class="fas fa-caret-right" style="width:14.4px"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <button class="btn btn-blue rounded-pill" onclick='tableToExcelOther()'><span>匯出 Excel</span></button>
                    </div>

                    <div class="col-lg-12 table-style-invoice ">
                        <table id="search-other-invoice">

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- <div class="col-lg-12">
    <div class="row">
        <div class="col-lg-6 mb-3">
            <button class=" btn btn-primary btn-primary-style" onclick="location.href='{{route('bank.index')}}'"><span>帳戶</span> </button>
        </div>
        <div class="col-lg-6 mb-3">
            <button class="ml-3 btn btn-primary btn-primary-style float-right mr-3" onclick="location.href='{{route('invoice.create')}}'"><span>{{__('customize.Add')}}</span> </button>
        </div>
    </div>
</div> -->


@stop

@section('script')
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.14.0/dist/xlsx.full.min.js"></script>
<script>
    function tableToExcel() {
        var isReceipt = ''
        var isComplete = ''
        var excel = [
            ['請款單號', '請款日期', '請款人', '專案', '請款廠商', '請款項目', '請款事項', '請款費用', '銀行名稱', '分行', '帳號', '戶名', '是否附上發票', '是否匯款']
        ];
        for (var i = 0; i < invoices.length; i++) {
            isReceipt = ''
            isComplete = ''
            if (invoices[i]['status'] == 'complete') {
                isComplete = '∨'
            }
            if (invoices[i]['receipt'] == 1) {
                isReceipt = '∨'
            }
            excel.push([invoices[i]['finished_id'], invoices[i]['receipt_date'], invoices[i].user['name'], invoices[i].project['name'], invoices[i]['company'], invoices[i]['title'], invoices[i]['content'], invoices[i]['price'], invoices[i]['bank'], invoices[i]['bank_branch'], invoices[i]['bank_account_number'], invoices[i]['bank_account_name'], isReceipt, isComplete])
        }
        var filename = "請款表.xlsx";

        var ws_name = "工作表1";
        var wb = XLSX.utils.book_new(),
            ws = XLSX.utils.aoa_to_sheet(excel);
        XLSX.utils.book_append_sheet(wb, ws, ws_name);
        XLSX.writeFile(wb, filename);


    }
</script>

<script>
    function changeInvoice(i) {
        if (i == 1) {
            document.getElementsByClassName('show-project-invoice')[0].style.display = "none"
            document.getElementsByClassName('show-other-invoice')[0].style.display = "inline"
            document.getElementsByClassName('show-project-invoice')[1].style.display = "none"
            document.getElementsByClassName('show-other-invoice')[1].style.display = "inline"
            reset()
        } else {
            document.getElementsByClassName('show-other-invoice')[0].style.display = "none"
            document.getElementsByClassName('show-project-invoice')[0].style.display = "inline"
            document.getElementsByClassName('show-other-invoice')[1].style.display = "none"
            document.getElementsByClassName('show-project-invoice')[1].style.display = "inline"
            resetOther()
        }
    }
    var user = ""
    var project = ""
    var projectYear = ""
    var year = ""
    var month = ""
    var temp = ""
    var numTemp = ""
    var accountTemp = ""
    var accountName = ""
    var nowPage = 1

    //帳務
    var accountNames = []
    var invoices = []
    var projects = []
    $(document).ready(function() {
        reset()
        resetOther()
        setAccount()
        setOtherAccount()
        document.getElementsByClassName('show-other-invoice')[0].style.display = "none"
        document.getElementsByClassName('show-other-invoice')[1].style.display = "none"
    });

    function selectProjectYears(val) {
        projectYear = val
        project = ''
        $("#select-project-grv").empty();
        $("#select-project-rv").empty();

        if (projectYear == '') {
            reset()
        } else {
            setInvoice()
            projects = getNewProject()
            for (var i = 0; i < projects.length; i++) {
                if (projects[i]['name'] != "其他" && projects[i]['open_date'].substr(0, 4) == projectYear) {
                    if (projects[i]['company_name'] == "grv") {
                        $("#select-project-grv").append("<option value='" + projects[i]['project_id'] + "'>" + projects[i]['name'] + "</option>");
                    } else if (projects[i]['company_name'] == "rv") {
                        $("#select-project-rv").append("<option value='" + projects[i]['project_id'] + "'>" + projects[i]['name'] + "</option>");
                    }
                }
            }
            setYear()
        }
        setSearch()
        listInvoice() //列出符合條件的請款項目
    }

    function select(type, id) {
        switch (type) {
            case 'user':
                user = id
                if (id == '') {
                    reset()
                } else {
                    projectYear = ''
                    project = ''
                    year = ''
                    month = ''
                    nowPage = 1
                    setInvoice()
                    setProject() //設置此人所屬專案
                    setYear()
                    setMonth()
                }
                break;
            case 'project':
                project = id //傳入選取值
                if (id == '') {
                    reset()
                } else {
                    nowPage = 1
                    year = ''
                    month = ''
                    setInvoice()
                    setYear()
                    setMonth()
                }
                break;
            case 'year':
                year = id //傳入選取值
                if (id == '') {
                    reset()
                } else {
                    nowPage = 1
                    month = ''
                    setInvoice()
                    setMonth()
                }
                break;
            case 'month':
                month = id //傳入選取值
                if (id == '') {
                    reset()
                } else {
                    nowPage = 1
                    setInvoice()
                }
                break;
            default:

        }
        if (id != '') {
            setSearchNum()
            setSearch()
            listInvoice() //列出符合條件的請款項目
            listPage()
        }
    }

    function searchInvoice() {
        temp = document.getElementById('search').value
        nowPage = 1
        setInvoice()
        listInvoice()
        listPage()
    }

    function searchNum() {
        numTemp = document.getElementById('search-num').value
        nowPage = 1
        setInvoice()
        listInvoice()
        listPage()
    }

    function selectAccount(id) {
        accountName = id
        if (id == '') {
            reset()
        } else {
            nowPage = 1
            year = ''
            month = ''
            setInvoice()
            setYear()
            setMonth()
            setSearch()
            listInvoice() //列出符合條件的請款項目
            listPage()
        }
    }

    function setInvoice() {
        invoices = getNewInvoice()
        for (var i = 0; i < invoices.length; i++) {
            if (user != '') {
                if (invoices[i]['user_id'] != user) {
                    invoices.splice(i, 1)
                    i--
                    continue
                }
            }
            if (project != '') {
                if (invoices[i]['project_id'] != project) {
                    invoices.splice(i, 1)
                    i--
                    continue
                } else {
                    $('#select-project-year').val(invoices[i].project['open_date'].substr(0, 4))
                }
            }

            if (accountName != '') {
                if (invoices[i]['bank_account_name'] != accountName) {
                    invoices.splice(i, 1)
                    i--
                    continue
                }
            }
            if (year != '') {
                if (invoices[i]['created_at'].substr(0, 4) != year) {
                    invoices.splice(i, 1)
                    i--
                    continue
                }
            }

            if (month != '') {
                if (invoices[i]['created_at'].substr(5, 2) != month) {
                    invoices.splice(i, 1)
                    i--
                    continue
                }
            }

            if (temp != '') {
                if (invoices[i]['title'] == null || invoices[i]['title'].indexOf(temp) == -1) {
                    invoices.splice(i, 1)
                    i--
                    continue
                }
            }

            if (numTemp != '') {
                if (invoices[i]['finished_id'] == null || invoices[i]['finished_id'].indexOf(numTemp) == -1) {
                    invoices.splice(i, 1)
                    i--
                    continue
                }
            }
        }
    }

    function getNewInvoice() {
        data = "{{$invoices}}"
        data = data.replace(/[\n\r]/g, "")
        data = JSON.parse(data.replace(/&quot;/g, '"'));
        return data
    }

    function getNewProject() {
        var temp = []
        var projectTemp = []
        for (var i = 0; i < invoices.length; i++) {
            if (temp.indexOf(invoices[i].project['name']) == -1) {
                temp.push(invoices[i].project['name'])
                projectTemp.push(invoices[i].project)
            }
        }
        return projectTemp
    }

    function changePage(index) {

        var temp = document.getElementsByClassName('page-item')

        $(".page-" + String(nowPage)).removeClass('active')
        nowPage = index
        $(".page-" + String(nowPage)).addClass('active')

        listPage()
        listInvoice()

    }

    function nextPage() {
        var number = Math.ceil(invoices.length / 10)

        if (nowPage < number) {
            var temp = document.getElementsByClassName('page-item')
            $(".page-" + String(nowPage)).removeClass('active')
            nowPage++
            $(".page-" + String(nowPage)).addClass('active')
            listPage()
            listInvoice()
        }

    }

    function previousPage() {
        var number = Math.ceil(invoices.length / 10)

        if (nowPage > 1) {
            var temp = document.getElementsByClassName('page-item')
            $(".page-" + String(nowPage)).removeClass('active')
            nowPage--
            $(".page-" + String(nowPage)).addClass('active')
            listPage()
            listInvoice()
        }

    }

    function listPage() {
        $("#invoice-page").empty();
        var parent = document.getElementById('invoice-page');
        var table = document.createElement("div");
        var number = Math.ceil(invoices.length / 10)
        var data = ''
        if (nowPage < 4) {
            for (var i = 0; i < number; i++) {
                if (i < 5) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                } else {
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                    data = data + '<li class="page-item page-' + number + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + number + ')">' + number + '</a></li>'
                    break
                }
            }
        } else if (nowPage >= 4 && nowPage - 3 <= 2) {
            for (var i = 0; i < number; i++) {
                if (i < nowPage + 2) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                } else {
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                    data = data + '<li class="page-item page-' + number + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + number + ')">' + number + '</a></li>'
                    break
                }
            }
        } else if (nowPage >= 4 && nowPage - 3 > 2 && number - nowPage > 5) {
            for (var i = 0; i < number; i++) {
                if (i == 0) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                } else if (i >= nowPage - 3 && i <= nowPage + 1) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'

                } else if (i > nowPage + 1) {
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                    data = data + '<li class="page-item page-' + number + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + number + ')">' + number + '</a></li>'
                    break
                }


            }
        } else if (number - nowPage <= 5 && number - nowPage >= 4) {
            for (var i = 0; i < number; i++) {
                if (i == 0) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                } else if (i >= nowPage - 3) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                }
            }
        } else if (number - nowPage < 4) {
            for (var i = 0; i < number; i++) {
                if (i == 0) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                } else if (i >= number - 5) {
                    data = data + '<li class="page-item page-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changePage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                }
            }
        }
        var previous = "previous"
        var next = "next"
        table.innerHTML = '<nav aria-label="Page navigation example">' +
            '<ul class="pagination mb-0">' +
            '<li class="page-item">' +
            '<a class="page-link" href="javascript:void(0)" onclick="previousPage()" aria-label="Previous">' +
            '<span aria-hidden="true"><i class="fas fa-caret-left" style="width:14.4px"></i></span>' +
            '</a>' +
            '</li>' +
            data +
            '<li class="page-item">' +
            '<a class="page-link" href="javascript:void(0)" onclick="nextPage()" aria-label="Next">' +
            '<span aria-hidden="true"><i class="fas fa-caret-right" style="width:14.4px"></i></span>' +
            '</a>' +
            '</li>' +
            '</ul>' +
            '</nav>'

        parent.appendChild(table);

        $(".page-" + String(nowPage)).addClass('active')
    }

    function listInvoice() {
        $("#search-invoice").empty();
        var parent = document.getElementById('search-invoice');
        var table = document.createElement("tbody");

        table.innerHTML = '<tr class="text-white">' +
            '<th>請款單號</th>' +
            '<th>請款人</th>' +
            '<th>專案</th>' +
            '<th>請款項目</th>' +
            '<th>請款費用</th>' +
            '<th>請款日期</th>' +
            '<th>狀態</th>' +
            '</tr>'
        var tr, span, name, a


        for (var i = 0; i < invoices.length; i++) {
            if (i >= (nowPage - 1) * 10 && i < nowPage * 10) {
                table.innerHTML = table.innerHTML + setData(i)
            } else if (i >= nowPage * 10) {
                break
            }
        }


        parent.appendChild(table);
    }

    function setData(i) {
        if (invoices[i].status == 'waiting') {
            span = "<div class='progress' data-toggle='tooltip' data-placement='top' title='尚未審核'>" +
                "<div class='progress-bar bg-danger' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>" +
                "</div>" +
                "</div>";

        } else if (invoices[i].status == 'waiting-fix') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='修改中'>" +
                "<div class='progress-bar progress-bar-striped bg-danger progress-bar-animated' role='progressbar' style='width: 25%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (invoices[i].status == 'check') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='等待主管審核'>" +
                "<div class='progress-bar bg-danger' role='progressbar' style='width: 25%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (invoices[i].status == 'check-fix') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='修改中'>" +
                "<div class='progress-bar progress-bar-striped bg-danger progress-bar-animated' role='progressbar' style='width: 50%' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (invoices[i].status == 'managed') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='已審核,等待請款'>" +
                "<div class='progress-bar bg-warning' role='progressbar' style='width: 50%' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (invoices[i].status == 'matched') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='已請款,等待匯款'>" +
                "<div class='progress-bar bg-success' role='progressbar' style='width: 75%' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (invoices[i].status == 'complete') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='已匯款'>" +
                "<div class='progress-bar bg-info' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"
        }



        a = "/invoice/" + invoices[i]['invoice_id'] + "/review"
        tr = "<tr>" +
            "<td width='10%'><a href='" + a + "' target='_blank'>" + invoices[i].finished_id + "</td>" +
            "<td width='10%'><a href='" + a + "' target='_blank'>" + invoices[i].user['name'] + "</td>" +
            "<td width='25%'><a href='" + a + "' target='_blank'>" + invoices[i].project['name'] + "</td>" +
            "<td width='25%'><a href='" + a + "' target='_blank'>" + invoices[i].title + "</a></td>" +
            "<td width='10%'><a href='" + a + "' target='_blank'>" + commafy(invoices[i].price) + "</td>" +
            "<td width='15%'> <a href='" + a + "' target='_blank'>" + invoices[i].created_at.substr(0, 10) + "</td>" +
            "<td width='5%'>" + span + "</td>" +
            "</tr>"


        return tr
    }

    function commafy(num) {
        num = num + "";
        var re = /(-?\d+)(\d{3})/
        while (re.test(num)) {
            num = num.replace(re, "$1,$2")
        }
        return num;
    }

    function reset() {
        invoices = getNewInvoice()
        setUser()
        projectYear = ''
        setProject()
        accountTemp = ''
        $("#search-account").val("");
        accountName = ''
        setYear()
        setMonth()
        setSearch()
        setSearchNum()
        nowPage = 1
        $("#invoice-page").empty();
        listInvoice()
        listPage()
    }

    function setUser() {
        user = ''
        $("#select-user").val("");
    }

    function setProject() {
        projects = getNewProject()
        project = ''
        $("#select-project-grv").empty();
        $("#select-project-rv").empty();

        var projectYears = [] //初始化

        for (var i = 0; i < projects.length; i++) {
            if (projectYears.indexOf(projects[i]['open_date'].substr(0, 4)) == -1) {
                projectYears.push(projects[i]['open_date'].substr(0, 4))
            }
            if (projects[i]['name'] != "其他") {
                if (projects[i]['company_name'] == "grv") {
                    $("#select-project-grv").append("<option value='" + projects[i]['project_id'] + "'>" + projects[i]['name'] + "</option>");
                } else if (projects[i]['company_name'] == "rv") {
                    $("#select-project-rv").append("<option value='" + projects[i]['project_id'] + "'>" + projects[i]['name'] + "</option>");
                }
            }
        }

        $("#select-project-year").val("");
        $("#select-project-year").empty();
        $("#select-project-year").append("<option value=''></option>");
        projectYears.sort()
        projectYears.reverse()
        for (var i = 0; i < projectYears.length; i++) {
            $("#select-project-year").append("<option value='" + projectYears[i] + "'>" + projectYears[i] + "</option>");
        }
    }

    function setAccount() {
        invoices = getNewInvoice()

        accountName = ''
        accountNames = [] //初始化

        for (var i = 0; i < invoices.length; i++) {
            if (accountNames.indexOf(invoices[i]['bank_account_name']) == -1) {
                if (accountTemp != '') {
                    if (invoices[i]['bank_account_name'].indexOf(accountTemp) != -1) {
                        accountNames.push(invoices[i]['bank_account_name'])
                    }
                } else {
                    accountNames.push(invoices[i]['bank_account_name'])
                }
            }
        }
        accountNames.sort(function(a, b) {
            return a.length - b.length;
        });

        for (var i = 0; i < accountNames.length; i++) {
            $("#list-account").append("<option value='" + accountNames[i] + "'>" + accountNames[i] + "</option>");
        }
    }

    function setYear() {
        year = ''
        var years = [] //初始化
        $("#select-year").val("");
        $("#select-year").empty();
        $("#select-year").append("<option value=''></option>");

        for (var i = 0; i < invoices.length; i++) {
            if (years.indexOf(invoices[i]['created_at'].substr(0, 4)) == -1) {
                years.push(invoices[i]['created_at'].substr(0, 4))
                $("#select-year").append("<option value='" + invoices[i]['created_at'].substr(0, 4) + "'>" + invoices[i]['created_at'].substr(0, 4) + "</option>");
            }
        }
    }

    function setMonth() {
        month = ""
        $("#select-month").empty();
        $("#select-month").append("<option value=''></option>");
        for (var i = 0; i < 12; i++) {
            if (i < 9) {
                $("#select-month").append("<option value='0" + (i + 1) + "'>" + "0" + (i + 1) + "</option>");
            } else {
                $("#select-month").append("<option value='" + (i + 1) + "'>" + (i + 1) + "</option>");

            }
        }
    }

    function setSearch() {
        temp = ''
        document.getElementById('search').value = temp
    }

    function setSearchNum() {
        numTemp = ''
        document.getElementById('search-num').value = numTemp
    }
</script>

<script>
    function tableToExcelOther() {
        var isReceipt = ''
        var isComplete = ''

        var excel = [
            ['請款單號', '請款日期', '請款人', '專案', '請款廠商', '請款項目', '請款事項', '請款費用', '銀行名稱', '分行', '帳號', '戶名', '是否附上發票', '是否匯款']
        ];
        for (var i = 0; i < other_invoices.length; i++) {
            isReceipt = ''
            isComplete = ''
            if (other_invoices[i]['status'] == 'complete') {
                isComplete = '∨'
            }
            if (other_invoices[i]['receipt'] == 1) {
                isReceipt = '∨'
            }
            var lang = [{
                salary: "薪資"
            }, {
                other: "其他"
            }]
            excel.push([other_invoices[i]['finished_id'], other_invoices[i]['receipt_date'], other_invoices[i].user['name'], chinese[other_invoices[i]['type']], other_invoices[i]['company'], other_invoices[i]['title'], other_invoices[i]['content'], other_invoices[i]['price'], other_invoices[i]['bank'], other_invoices[i]['bank_branch'], other_invoices[i]['bank_account_number'], other_invoices[i]['bank_account_name'], isReceipt, isComplete])
        }
        var filename = "請款表.xlsx";

        var ws_name = "工作表1";
        var wb = XLSX.utils.book_new(),
            ws = XLSX.utils.aoa_to_sheet(excel);
        XLSX.utils.book_append_sheet(wb, ws, ws_name);
        XLSX.writeFile(wb, filename);


    }
</script>

<script>
    var other_user = ""
    var company = ""
    var other_type = ""
    var other_year = ""
    var other_month = ""
    var other_temp = ""
    var other_num_temp = ""
    var nowOtherPage = 1
    var accountOtherTemp = ""
    var accountOtherName = ""
    //帳務
    var accountOtherNames = []
    var chinese = {
        salary: "薪資",
        insurance: "保險",
        other: "其他",
        grv: "綠雷德",
        rv: "閱野"
    }

    //帳務
    var other_invoices = []

    function selectOther(type, id) {
        switch (type) {
            case 'user':
                other_user = id
                if (id == '') {
                    resetOther()
                } else {
                    company = ''
                    other_type = ''
                    year = ''
                    month = ''
                    nowOtherPage = 1
                    setOtherInvoice()
                    setOtherYear()
                    setOtherMonth()
                }
                break;
            case 'company':
                company = id
                if (id == '') {
                    resetOther()
                } else {
                    other_year = ''
                    other_month = ''
                    nowOtherPage = 1
                    setOtherInvoice()
                    setOtherYear()
                    setOtherMonth()
                }
                break;
            case 'type':
                other_type = id
                if (id == '') {
                    resetOther()
                } else {
                    other_year = ''
                    other_month = ''
                    nowOtherPage = 1
                    setOtherInvoice()
                    setOtherYear()
                    setOtherMonth()
                }
                break;
            case 'year':
                other_year = id
                if (id == '') {
                    resetOther()
                } else {
                    other_month = ''
                    nowOtherPage = 1
                    setOtherInvoice()
                    setOtherMonth()
                }
                break;
            case 'month':
                other_month = id //傳入選取值
                if (id == '') {
                    resetOther()
                } else {
                    nowOtherPage = 1
                    setOtherInvoice()
                }
                break;
            default:

        }
        if (id != "") {
            setOtherNumSearch()
            setOtherSearch()
            listOtherInvoice() //列出符合條件的請款項目
            listOtherPage()
        }
    }

    function selectOtherAccount(id) {
        accountOtherName = id
        if (id == '') {
            resetOther()
        } else {
            nowOtherPage = 1
            other_year = ''
            other_month = ''
            setOtherInvoice()
            setOtherYear()
            setOtherMonth()
            setOtherSearch()
            listOtherInvoice() //列出符合條件的請款項目
            listOtherPage()
        }
    }

    function searchOtherInvoice() {
        other_temp = document.getElementById('search-other').value
        nowOtherPage = 1
        setOtherInvoice()
        listOtherInvoice()
        listOtherPage()
    }
    function searchOtherNum() {
        other_num_temp = document.getElementById('search-other-num').value
        nowOtherPage = 1
        setOtherInvoice()
        listOtherInvoice()
        listOtherPage()
    }
    function setOtherInvoice() {
        other_invoices = getNewOtherInvoice()
        for (var i = 0; i < other_invoices.length; i++) {
            if (other_user != '') {
                if (other_invoices[i]['user_id'] != other_user) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }
            if (company != '') {
                if (other_invoices[i]['company_name'] != company) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }
            if (other_type != '') {
                if (other_invoices[i]['type'] != other_type) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }
            if (accountOtherName != '') {
                if (other_invoices[i]['bank_account_name'] != accountOtherName) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }
            if (other_year != '') {
                if (other_invoices[i]['created_at'].substr(0, 4) != other_year) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }

            if (other_month != '') {
                if (other_invoices[i]['created_at'].substr(5, 2) != other_month) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }

            if (other_temp != '') {
                if (other_invoices[i]['title'] == null || other_invoices[i]['title'].indexOf(other_temp) == -1) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }

            if (other_num_temp != '') {
                if (other_invoices[i]['finished_id'] == null || other_invoices[i]['finished_id'].indexOf(other_num_temp) == -1) {
                    other_invoices.splice(i, 1)
                    i--
                    continue
                }
            }
        }


    }


    function getNewOtherInvoice() {
        data = "{{$otherInvoices}}"
        data = data.replace(/[\n\r]/g, "")
        data = JSON.parse(data.replace(/&quot;/g, '"'));
        return data
    }

    function changeOtherPage(index) {

        var temp = document.getElementsByClassName('page-other-item')

        $(".page-other-" + String(nowOtherPage)).removeClass('active')
        nowOtherPage = index
        $(".page-other-" + String(nowOtherPage)).addClass('active')

        listOtherPage()
        listOtherInvoice()

    }

    function nextOtherPage() {
        var number = Math.ceil(other_invoices.length / 10)

        if (nowOtherPage < number) {
            var temp = document.getElementsByClassName('page-other-item')
            $(".page-other-" + String(nowOtherPage)).removeClass('active')
            nowOtherPage++
            $(".page-other-" + String(nowOtherPage)).addClass('active')
            listOtherPage()
            listOtherInvoice()
        }

    }

    function previousOtherPage() {
        var number = Math.ceil(other_invoices.length / 10)

        if (nowOtherPage > 1) {
            var temp = document.getElementsByClassName('page-other-item')
            $(".page-other-" + String(nowOtherPage)).removeClass('active')
            nowOtherPage--
            $(".page-other-" + String(nowOtherPage)).addClass('active')
            listOtherPage()
            listOtherInvoice()
        }

    }

    function listOtherPage() {
        $("#invoice-other-page").empty();
        var parent = document.getElementById('invoice-other-page');
        var table = document.createElement("div");
        var number = Math.ceil(other_invoices.length / 10)
        var data = ''
        if (nowOtherPage < 4) {
            for (var i = 0; i < number; i++) {
                if (i < 5) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                } else {
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                    data = data + '<li class="page-item page-other-' + number + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + number + ')">' + number + '</a></li>'
                    break
                }
            }
        } else if (nowOtherPage >= 4 && nowOtherPage - 3 <= 2) {
            for (var i = 0; i < number; i++) {
                if (i < nowOtherPage + 2) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                } else {
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                    data = data + '<li class="page-item page-other-' + number + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + number + ')">' + number + '</a></li>'
                    break
                }
            }
        } else if (nowOtherPage >= 4 && nowOtherPage - 3 > 2 && number - nowOtherPage > 5) {
            for (var i = 0; i < number; i++) {
                if (i == 0) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                } else if (i >= nowOtherPage - 3 && i <= nowOtherPage + 1) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'

                } else if (i > nowOtherPage + 1) {
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                    data = data + '<li class="page-item page-other-' + number + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + number + ')">' + number + '</a></li>'
                    break
                }
            }
        } else if (number - nowOtherPage <= 5 && number - nowOtherPage >= 4) {
            for (var i = 0; i < number; i++) {
                if (i == 0) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                } else if (i >= nowOtherPage - 3) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                }
            }
        } else if (number - nowOtherPage < 4) {
            for (var i = 0; i < number; i++) {
                if (i == 0) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                    data = data + '<li class="page-item disabled"><a class="page-link" href="javascript:void(0)" ">...</a></li>'
                } else if (i >= number - 5) {
                    data = data + '<li class="page-item page-other-' + (i + 1) + '"><a class="page-link" href="javascript:void(0)" onclick="changeOtherPage(' + (i + 1) + ')">' + (i + 1) + '</a></li>'
                }
            }
        }

        table.innerHTML = '<nav aria-label="Page navigation example">' +
            '<ul class="pagination mb-0">' +
            '<li class="page-item">' +
            '<a class="page-link" href="javascript:void(0)" onclick="previousOtherPage()" aria-label="Previous">' +
            '<span aria-hidden="true"><i class="fas fa-caret-left" style="width:14.4px"></i></span>' +
            '</a>' +
            '</li>' +
            data +
            '<li class="page-item">' +
            '<a class="page-link" href="javascript:void(0)" onclick="nextOtherPage()" aria-label="Next">' +
            '<span aria-hidden="true"><i class="fas fa-caret-right" style="width:14.4px"></i></span>' +
            '</a>' +
            '</li>' +
            '</ul>' +
            '</nav>'

        parent.appendChild(table);

        $(".page-other-" + String(nowOtherPage)).addClass('active')
    }

    function listOtherInvoice() {

        $("#search-other-invoice").empty();
        var parent = document.getElementById('search-other-invoice');
        var table = document.createElement("tbody");

        table.innerHTML = '<tr class="text-white">' +
            '<th>請款單號</th>' +
            '<th>請款人</th>' +
            '<th>類型</th>' +
            '<th>請款項目</th>' +
            '<th>請款費用</th>' +
            '<th>請款日期</th>' +
            '<th>狀態</th>' +
            '</tr>'
        var tr, span, name, a


        for (var i = 0; i < other_invoices.length; i++) {
            if (i >= (nowOtherPage - 1) * 10 && i < nowOtherPage * 10) {
                table.innerHTML = table.innerHTML + setOtherData(i)
            } else if (i >= nowOtherPage * 10) {
                break
            }
        }


        parent.appendChild(table);
    }

    function setOtherData(i) {
        if (other_invoices[i].status == 'waiting') {
            span = "<div class='progress' data-toggle='tooltip' data-placement='top' title='尚未審核'>" +
                "<div class='progress-bar bg-danger' role='progressbar' style='width: 0%' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>" +
                "</div>" +
                "</div>";

        } else if (other_invoices[i].status == 'waiting-fix') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='修改中'>" +
                "<div class='progress-bar progress-bar-striped bg-danger progress-bar-animated' role='progressbar' style='width: 25%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (other_invoices[i].status == 'check') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='等待主管審核'>" +
                "<div class='progress-bar bg-danger' role='progressbar' style='width: 25%' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (other_invoices[i].status == 'check-fix') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='修改中'>" +
                "<div class='progress-bar progress-bar-striped bg-danger progress-bar-animated' role='progressbar' style='width: 50%' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (other_invoices[i].status == 'managed') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='已審核,等待請款'>" +
                "<div class='progress-bar bg-warning' role='progressbar' style='width: 50%' aria-valuenow='50' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (other_invoices[i].status == 'matched') {

            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='已請款,等待匯款'>" +
                "<div class='progress-bar bg-success' role='progressbar' style='width: 75%' aria-valuenow='75' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"

        } else if (other_invoices[i].status == 'complete') {
            span = " <div class='progress' data-toggle='tooltip' data-placement='top' title='已匯款'>" +
                "<div class='progress-bar bg-info' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>" +
                "</div>"
        }

        a = "/invoice/" + other_invoices[i]['other_invoice_id'] + "/review/other"
        tr = "<tr>" +
            "<td width='10%'><a href='" + a + "' target='_blank'>" + other_invoices[i].finished_id + "</td>" +
            "<td width='10%'><a href='" + a + "' target='_blank'>" + other_invoices[i].user['name'] + "</td>" +
            "<td width='10%'><a href='" + a + "' target='_blank'>" + chinese[other_invoices[i].company_name] + "-" + chinese[other_invoices[i].type] + "</a></td>" +
            "<td><a href='" + a + "' target='_blank'>" + other_invoices[i].title + "</a></td>" +
            "<td width='10%'><a href='" + a + "' target='_blank'>" + commafy(other_invoices[i].price) + "</td>" +
            "<td width='15%'><a href='" + a + "' target='_blank'>" + other_invoices[i].created_at.substr(0, 10) + "</td>" +
            "<td width='5%'>" + span + "</td>" +
            "</tr>"


        return tr
    }

    function resetOther() {
        other_invoices = getNewOtherInvoice()
        setOtherUser()
        company = ''
        $("#select-company").val("");
        accountOtherTemp = ''
        $("#search-other-account").val("");
        accountOtherName = ''
        other_type = ''
        $("#select-type").val("");
        setOtherYear()
        setOtherMonth()
        setOtherSearch()
        setOtherNumSearch()
        nowOtherPage = 1
        $("#invoice-other-page").empty();
        listOtherInvoice()
        listOtherPage()
    }

    function setOtherUser() {
        other_user = ''
        $("#select-other-user").val("");
    }

    function setOtherAccount() {
        other_invoices = getNewOtherInvoice()
        accountOtherName = ''
        accountOtherNames = [] //初始化


        for (var i = 0; i < other_invoices.length; i++) {
            if (accountOtherNames.indexOf(other_invoices[i]['bank_account_name']) == -1) {
                if (accountOtherTemp != '') {
                    if (other_invoices[i]['bank_account_name'].indexOf(accountOtherTemp) != -1) {
                        accountOtherNames.push(other_invoices[i]['bank_account_name'])
                    }
                } else {
                    accountOtherNames.push(other_invoices[i]['bank_account_name'])
                }
            }
        }
        accountOtherNames.sort(function(a, b) {
            return a.length - b.length;
        });
        for (var i = 0; i < accountOtherNames.length; i++) {
            $("#list-other-account").append("<option value='" + accountOtherNames[i] + "'>" + accountOtherNames[i] + "</option>");
        }
    }

    function setOtherYear() {
        other_year = ''
        var years = [] //初始化
        $("#select-other-year").val("");
        $("#select-other-year").empty();
        $("#select-other-year").append("<option value=''></option>");

        for (var i = 0; i < other_invoices.length; i++) {
            if (years.indexOf(other_invoices[i]['created_at'].substr(0, 4)) == -1) {
                years.push(other_invoices[i]['created_at'].substr(0, 4))
                $("#select-other-year").append("<option value='" + other_invoices[i]['created_at'].substr(0, 4) + "'>" + other_invoices[i]['created_at'].substr(0, 4) + "</option>");
            }
        }
    }

    function setOtherMonth() {
        other_month = ""
        $("#select-other-month").empty();
        $("#select-other-month").append("<option value=''></option>");
        for (var i = 0; i < 12; i++) {
            if (i < 9) {
                $("#select-other-month").append("<option value='0" + (i + 1) + "'>" + "0" + (i + 1) + "</option>");
            } else {
                $("#select-other-month").append("<option value='" + (i + 1) + "'>" + (i + 1) + "</option>");

            }
        }
    }

    function setOtherSearch() {
        other_temp = ''
        document.getElementById('search-other').value = other_temp
    }
    function setOtherNumSearch() {
        other_num_temp = ''
        document.getElementById('search-other-num').value = other_num_temp
    }
</script>

@stop