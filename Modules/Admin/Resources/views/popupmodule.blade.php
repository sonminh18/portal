<style>
    .modal-open .modal {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }
</style>
<form action="#" id="form">
    <div class="modal-body">
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <label>Tên Module:</label>
                    <input type="text" placeholder="Tên Module" class="form-control" value="{{$data_Module['vModName']}}" readonly>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phòng ban kiểm tra quyền:</label>
                        <select multiple="multiple" class="select-border-color border-warning" name="group[]" id="group1">
                                @foreach($Result as $item)
                                    @if($item['Selected'] == 1)
                                        <option value="{{$item['OU']}}" selected>{!! $item['OU'] !!}</option>
                                    @else
                                        <option value="{{$item['OU']}}">{!! $item['OU'] !!}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Phòng ban không kiểm tra quyền:</label>
                        <select multiple="multiple" class="select-border-color border-warning" name="group[]" id="group2">
                            @foreach($Result2 as $item)
                                @if($item['Selected'] == 1)
                                    <option value="{{$item['OU']}}" selected>{!! $item['OU'] !!}</option>
                                @else
                                    <option value="{{$item['OU']}}">{!! $item['OU'] !!}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>